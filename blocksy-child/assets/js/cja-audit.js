(function () {
  'use strict';

  var refs = {};
  var state = {
    loadingPromise: null,
    loadingTimeouts: [],
    revealObserver: null,
    activeController: null
  };
  var DEFAULT_POLL_INTERVAL = 4500;
  var DEFAULT_POLL_TIMEOUT = 180000;
  var DEFAULT_REQUEST_TIMEOUT = 20000;
  var DEFAULT_LEGACY_TIMEOUT = 120000;
  var LOADING_STEP_DELAY = 1200;
  var steps = [
    'Website wird geladen...',
    'Performance wird gemessen...',
    'Messbarkeit & Datenschutz wird geprüft...',
    'SEO-Grundlagen werden analysiert...',
    'Conversion & Klarheit wird bewertet...',
    'Inhalt & Positionierung wird ausgewertet...',
    'Ergebnis wird zusammengestellt...'
  ];
  var loadingProgressMarks = [10, 24, 38, 52, 66, 80, 92];
  var statusLabels = {
    red: 'kritisch',
    yellow: 'mittel',
    green: 'ok'
  };

  document.addEventListener('DOMContentLoaded', init);

  function init() {
    refs.app = document.getElementById('cja-app');
    if (!refs.app) return;

    refs.inputPhase = document.getElementById('cja-input');
    refs.loadingPhase = document.getElementById('cja-loading');
    refs.resultsPhase = document.getElementById('cja-results');
    refs.urlInput = document.getElementById('cja-url-input');
    refs.submit = document.getElementById('cja-submit');
    refs.error = document.getElementById('cja-error');
    refs.loadingStep = document.getElementById('cja-loading-step');
    refs.loadingUrl = document.getElementById('cja-loading-url');
    refs.progress = document.getElementById('cja-progress-bar');
    refs.scoreHeader = document.getElementById('cja-score-header');
    refs.modules = document.getElementById('cja-modules');
    refs.revenue = document.getElementById('cja-revenue');

    if (!refs.urlInput || !refs.submit) return;

    showInput();

    refs.submit.addEventListener('click', handleSubmit);
    refs.urlInput.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        handleSubmit();
      }
    });
  }

  function handleSubmit() {
    if (refs.submit.disabled) return;

    clearError();

    if (!hasWebhookConfig()) {
      showError('Die Analyse ist gerade nicht verfügbar. Bitte versuchen Sie es später erneut.');
      return;
    }

    var cleanedUrl = normalizeUrl(refs.urlInput.value);
    if (!cleanedUrl) {
      showError('Bitte geben Sie eine gültige Website-URL ein, z. B. beispiel.de.');
      refs.urlInput.focus();
      return;
    }

    runAnalysis(cleanedUrl);
  }

  function hasWebhookConfig() {
    var config = getConfig();
    return Boolean((config.webhookStartUrl && config.webhookStatusUrl) || getLegacyWebhookUrl());
  }

  function getConfig() {
    return window.cjaConfig || {};
  }

  function getLegacyWebhookUrl() {
    var config = getConfig();
    return String(config.legacyWebhookUrl || config.webhookUrl || '').trim();
  }

  function getPollInterval() {
    return sanitizeDuration(getConfig().pollInterval, DEFAULT_POLL_INTERVAL);
  }

  function getPollTimeout() {
    return sanitizeDuration(getConfig().pollTimeout, DEFAULT_POLL_TIMEOUT);
  }

  function sanitizeDuration(value, fallback) {
    var parsed = Number(value);
    return !isNaN(parsed) && parsed > 0 ? parsed : fallback;
  }

  function normalizeUrl(value) {
    var input = String(value || '').trim();
    if (!input) return '';

    if (!/^https?:\/\//i.test(input)) {
      input = 'https://' + input;
    }

    try {
      var parsed = new URL(input);
      var host = parsed.hostname.toLowerCase().replace(/^www\./, '');
      var path = parsed.pathname && parsed.pathname !== '/' ? parsed.pathname.replace(/\/+$/, '') : '';

      if (host.indexOf('.') === -1) return '';

      return host + path;
    } catch (error) {
      return '';
    }
  }

  async function runAnalysis(url) {
    showLoading(url);

    try {
      var data = await requestAnalysis(url);
      await waitForMinLoadingTime();
      showResults(data || {});
    } catch (error) {
      showError(resolveUserErrorMessage(error));
    }
  }

  async function requestAnalysis(url) {
    var config = getConfig();

    if (config.webhookStartUrl && config.webhookStatusUrl) {
      try {
        return await runAsyncAnalysis(url);
      } catch (error) {
        if (!shouldFallbackToLegacy(error) || !getLegacyWebhookUrl()) {
          throw error;
        }
      }
    }

    if (!getLegacyWebhookUrl()) {
      var configError = new Error('Die Analyse ist gerade nicht verfügbar. Bitte versuchen Sie es später erneut.');
      configError.code = 'CONFIG_MISSING';
      throw configError;
    }

    return runLegacyAnalysis(url);
  }

  async function runAsyncAnalysis(url) {
    var data = await fetchJson(
      getConfig().webhookStartUrl,
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url }),
        mode: 'cors'
      },
      DEFAULT_REQUEST_TIMEOUT,
      'ASYNC_START'
    );

    if (looksLikeAuditResult(data)) {
      return unwrapAuditPayload(data);
    }

    if (!data || data.ok !== true || !data.jobId) {
      var invalidError = new Error('Die Analyse konnte nicht gestartet werden.');
      invalidError.code = 'ASYNC_START_INVALID';
      throw invalidError;
    }

    return pollAnalysis(data.jobId, data.pollUrl);
  }

  async function runLegacyAnalysis(url) {
    return fetchJson(
      getLegacyWebhookUrl(),
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url }),
        mode: 'cors'
      },
      DEFAULT_LEGACY_TIMEOUT,
      'LEGACY'
    );
  }

  async function pollAnalysis(jobId, pollUrl) {
    var startedAt = Date.now();

    while (Date.now() - startedAt < getPollTimeout()) {
      await delay(getPollInterval());

      try {
        var data = await fetchJson(
          buildStatusUrl(jobId, pollUrl),
          {
            method: 'GET',
            mode: 'cors'
          },
          DEFAULT_REQUEST_TIMEOUT,
          'ASYNC_STATUS'
        );

        if (data && data.status === 'done' && data.data) {
          return data.data;
        }

        if (looksLikeAuditResult(data)) {
          return unwrapAuditPayload(data);
        }

        if (!data || !data.status || data.status === 'processing' || data.status === 'queued') {
          continue;
        }

        if (data.status === 'error' || data.status === 'expired') {
          var resultError = new Error(data.error || 'Die Analyse konnte nicht abgeschlossen werden.');
          resultError.code = 'ASYNC_RESULT_ERROR';
          throw resultError;
        }
      } catch (error) {
        if (error && error.name === 'AbortError') {
          throw error;
        }

        if (error && error.code && (/_HTTP$/.test(error.code) || /_PARSE$/.test(error.code))) {
          throw error;
        }
      }
    }

    var timeoutError = new Error('Die Analyse braucht heute länger als erwartet. Bitte versuchen Sie es in ein bis zwei Minuten erneut.');
    timeoutError.code = 'POLL_TIMEOUT';
    throw timeoutError;
  }

  async function fetchJson(url, options, timeoutMs, context) {
    if (!url) {
      var missingUrlError = new Error('Webhook-URL fehlt.');
      missingUrlError.code = context + '_CONFIG';
      throw missingUrlError;
    }

    var controller = createRequestController();
    var timeout = window.setTimeout(function () {
      controller.abort();
    }, timeoutMs);

    try {
      var response = await fetch(url, Object.assign({}, options, { signal: controller.signal }));

      if (!response.ok) {
        var httpError = new Error('Server-Fehler: ' + response.status);
        httpError.code = context + '_HTTP';
        httpError.status = response.status;
        throw httpError;
      }

      try {
        return await response.json();
      } catch (error) {
        var parseError = new Error('Die Server-Antwort ist ungültig.');
        parseError.code = context + '_PARSE';
        throw parseError;
      }
    } catch (error) {
      if (error && error.name === 'AbortError') {
        throw error;
      }

      if (error && error.code) {
        throw error;
      }

      var fetchError = new Error('Netzwerkfehler.');
      fetchError.code = context + '_FETCH';
      throw fetchError;
    } finally {
      window.clearTimeout(timeout);
      if (state.activeController === controller) {
        state.activeController = null;
      }
    }
  }

  function buildStatusUrl(jobId, pollUrl) {
    var config = getConfig();

    if (pollUrl) {
      try {
        return new URL(pollUrl, config.webhookStatusUrl).toString();
      } catch (error) {
        return String(pollUrl);
      }
    }

    try {
      var statusUrl = new URL(config.webhookStatusUrl);
      statusUrl.searchParams.set('jobId', jobId);
      return statusUrl.toString();
    } catch (error) {
      return String(config.webhookStatusUrl) + (String(config.webhookStatusUrl).indexOf('?') === -1 ? '?' : '&') + 'jobId=' + encodeURIComponent(jobId);
    }
  }

  function createRequestController() {
    abortActiveRequest();
    state.activeController = new AbortController();
    return state.activeController;
  }

  function abortActiveRequest() {
    if (!state.activeController) return;

    state.activeController.abort();
    state.activeController = null;
  }

  function shouldFallbackToLegacy(error) {
    return Boolean(error && typeof error.code === 'string' && error.code.indexOf('ASYNC_START_') === 0);
  }

  function resolveUserErrorMessage(error) {
    if (error && error.code === 'CONFIG_MISSING') {
      return error.message;
    }

    if (error && error.code === 'POLL_TIMEOUT') {
      return error.message;
    }

    if (error && error.name === 'AbortError') {
      return 'Die Verbindung wurde unterbrochen. Bitte versuchen Sie es erneut.';
    }

    if (error && error.code && error.code.indexOf('ASYNC_RESULT_ERROR') === 0) {
      return error.message || 'Die Analyse konnte nicht abgeschlossen werden. Bitte versuchen Sie es erneut.';
    }

    if (error && error.code && error.code.indexOf('ASYNC_STATUS_') === 0) {
      return 'Die Analyse konnte nicht sauber zugestellt werden. Bitte versuchen Sie es erneut.';
    }

    return 'Die Analyse konnte nicht durchgeführt werden. Bitte versuchen Sie es erneut.';
  }

  function delay(duration) {
    return new Promise(function (resolve) {
      window.setTimeout(resolve, duration);
    });
  }

  function showInput() {
    abortActiveRequest();
    stopLoadingAnimation();
    resetLoadingState();

    setPhaseVisibility(refs.inputPhase, true, 'flex');
    setPhaseVisibility(refs.loadingPhase, false, 'flex');
    setPhaseVisibility(refs.resultsPhase, false, 'block');
    refs.submit.disabled = false;
  }

  function showLoading(url) {
    clearResults();
    clearError();

    setPhaseVisibility(refs.inputPhase, false, 'flex');
    setPhaseVisibility(refs.loadingPhase, true, 'flex');
    setPhaseVisibility(refs.resultsPhase, false, 'block');
    refs.submit.disabled = true;
    refs.loadingUrl.textContent = 'Analysiert: ' + url;

    startLoadingAnimation();
    scrollAppToTop();
  }

  function startLoadingAnimation() {
    stopLoadingAnimation();

    if (refs.progress) {
      refs.progress.style.width = '0%';
    }

    state.loadingPromise = new Promise(function (resolve) {
      var index = 0;
      var minResolved = false;

      function advance() {
        if (refs.loadingStep) {
          refs.loadingStep.textContent = steps[index];
        }

        if (refs.progress) {
          refs.progress.style.width = loadingProgressMarks[index] + '%';
        }

        if (!minResolved && index === steps.length - 1) {
          minResolved = true;
          resolve();
        }

        index = (index + 1) % steps.length;
        state.loadingTimeouts.push(window.setTimeout(advance, LOADING_STEP_DELAY));
      }

      advance();
    });
  }

  function stopLoadingAnimation() {
    while (state.loadingTimeouts.length) {
      window.clearTimeout(state.loadingTimeouts.pop());
    }

    state.loadingPromise = null;
  }

  function waitForMinLoadingTime() {
    return state.loadingPromise || Promise.resolve();
  }

  function showResults(data) {
    stopLoadingAnimation();
    setPhaseVisibility(refs.inputPhase, false, 'flex');
    setPhaseVisibility(refs.loadingPhase, false, 'flex');
    setPhaseVisibility(refs.resultsPhase, true, 'block');
    refs.submit.disabled = false;

    if (refs.progress) {
      refs.progress.style.width = '100%';
    }

    renderResults(data || {});
    initReveals();
    window.requestAnimationFrame(scrollAppToTop);
  }

  function showError(message) {
    showInput();

    refs.error.innerHTML = '';
    refs.error.hidden = false;

    var text = document.createElement('div');
    text.textContent = message;

    var retry = document.createElement('button');
    retry.type = 'button';
    retry.textContent = 'Erneut versuchen';
    retry.addEventListener('click', function () {
      clearError();
      refs.urlInput.focus();
    });

    refs.error.appendChild(text);
    refs.error.appendChild(retry);
    window.requestAnimationFrame(scrollAppToTop);
  }

  function clearError() {
    refs.error.hidden = true;
    refs.error.textContent = '';
  }

  function clearResults() {
    refs.scoreHeader.innerHTML = '';
    refs.modules.innerHTML = '';
    refs.revenue.innerHTML = '';
  }

  function resetLoadingState() {
    if (refs.loadingStep) {
      refs.loadingStep.textContent = steps[0];
    }

    if (refs.loadingUrl) {
      refs.loadingUrl.textContent = '';
    }

    if (refs.progress) {
      refs.progress.style.width = '0%';
    }
  }

  function setPhaseVisibility(element, isVisible, displayValue) {
    if (!element) return;

    element.hidden = !isVisible;
    element.style.display = isVisible ? displayValue : 'none';
  }

  function scrollAppToTop() {
    var behavior = prefersReducedMotion() ? 'auto' : 'smooth';

    if (refs.app && typeof refs.app.scrollIntoView === 'function') {
      refs.app.scrollIntoView({
        behavior: behavior,
        block: 'start'
      });
      return;
    }

    window.scrollTo({
      top: 0,
      behavior: behavior
    });
  }

  function renderResults(data) {
    var normalized = normalizeAuditPayload(data);

    clearResults();
    renderScoreHeader(normalized);
    renderModules(normalized.modules || {});
    renderInsightCard(normalized.strategic_assessment, (normalized.modules || {}).revenue);
  }

  function renderScoreHeader(data) {
    var wrap = document.createDocumentFragment();
    var ring = createScoreRing(toScore(data.overall_score), 132, 8);
    var meta = document.createElement('div');
    var kicker = document.createElement('div');
    var title = document.createElement('h2');
    var subtitle = document.createElement('p');
    var timestamp = formatTimestamp(data.timestamp);
    var quickWins = Array.isArray(data.quickWins) ? data.quickWins.slice(0, 3) : [];
    var displayUrl = data.url || stripUrlProtocol(data.fullUrl) || 'Ihre Website';

    meta.className = 'cja-score-meta';
    kicker.className = 'cja-score-kicker';
    title.className = 'cja-score-title';
    subtitle.className = 'cja-score-sub';

    kicker.textContent = 'System-Diagnose Ergebnis';
    title.textContent = displayUrl + ' im Überblick';
    subtitle.textContent = timestamp ? 'Stand: ' + timestamp + ' · priorisierte Hebel über alle Diagnose-Bereiche hinweg.' : 'Wo Ihre Website heute Nachfrage verliert und welche Bereiche zuerst Wirkung versprechen.';

    wrap.appendChild(ring);
    meta.appendChild(kicker);
    meta.appendChild(title);
    meta.appendChild(subtitle);
    wrap.appendChild(meta);

    if (quickWins.length) {
      var quickWinsWrap = document.createElement('div');
      var quickWinsHeader = document.createElement('div');
      var quickWinsIcon = document.createElement('span');
      var quickWinsCopy = document.createElement('div');
      var quickWinsTitle = document.createElement('h2');
      var quickWinsSubtitle = document.createElement('p');
      var quickWinsList = document.createElement('div');

      quickWinsWrap.className = 'cja-quickwins';
      quickWinsHeader.className = 'cja-quickwins-header';
      quickWinsIcon.className = 'cja-quickwins-icon';
      quickWinsIcon.textContent = '🎯';
      quickWinsTitle.className = 'cja-quickwins-title';
      quickWinsTitle.textContent = 'Priorisierte Hebel';
      quickWinsSubtitle.className = 'cja-quickwins-subtitle';
      quickWinsSubtitle.textContent = 'Keine generische Scorecard, sondern die nächsten sinnvollen Eingriffe für Nachfrage, Leads und Klarheit.';
      quickWinsList.className = 'cja-quickwins-list';

      quickWins.forEach(function (item) {
        var card = document.createElement('div');
        card.className = 'cja-quickwin';
        card.textContent = formatDisplayText(item);
        quickWinsList.appendChild(card);
      });

      quickWinsCopy.appendChild(quickWinsTitle);
      quickWinsCopy.appendChild(quickWinsSubtitle);
      quickWinsHeader.appendChild(quickWinsIcon);
      quickWinsHeader.appendChild(quickWinsCopy);
      quickWinsWrap.appendChild(quickWinsHeader);
      quickWinsWrap.appendChild(quickWinsList);
      wrap.appendChild(quickWinsWrap);
    }

    refs.scoreHeader.appendChild(wrap);
  }

  function renderModules(modules) {
    var keys = ['performance', 'tracking', 'seo', 'conversion', 'content'];
    var fallbackKeys = Object.keys(modules).filter(function (key) {
      return key !== 'revenue';
    });
    var order = keys.filter(function (key) {
      return modules[key];
    });

    fallbackKeys.forEach(function (key) {
      if (order.indexOf(key) === -1) {
        order.push(key);
      }
    });

    if (!order.length) {
      refs.modules.appendChild(createEmptyState('Für diese Analyse wurden keine Modul-Daten geliefert.'));
      return;
    }

    order.forEach(function (key, index) {
      var card = renderModuleCard(modules[key], index);
      refs.modules.appendChild(card);
      if (index === 0) {
        toggleModule(card, true);
      }
    });
  }

  function renderModuleCard(module, index) {
    var root = document.createElement('section');
    var header = document.createElement('button');
    var icon = document.createElement('span');
    var copy = document.createElement('div');
    var label = document.createElement('div');
    var problems = document.createElement('div');
    var ring = createScoreRing(toScore(module && module.score), 52, 5);
    var chevron = document.createElement('span');
    var body = document.createElement('div');
    var items = module && Array.isArray(module.items) ? module.items : [];

    root.className = 'cja-module cja-reveal';
    root.style.transitionDelay = index * 150 + 'ms';

    header.type = 'button';
    header.className = 'cja-module-header';
    header.setAttribute('aria-expanded', 'false');

    icon.className = 'cja-module-icon';
    icon.textContent = module && module.icon ? module.icon : '•';

    copy.className = 'cja-module-copy';
    label.className = 'cja-module-label';
    label.textContent = formatDisplayText(module && module.label ? module.label : 'Modul');
    problems.className = 'cja-module-problems';
    problems.textContent = items.length ? buildProblemLabel(items.length) : 'Keine Detailpunkte verfügbar';

    chevron.className = 'cja-module-chevron';
    chevron.textContent = '⌄';

    body.className = 'cja-module-body';

    copy.appendChild(label);
    copy.appendChild(problems);
    header.appendChild(icon);
    header.appendChild(copy);
    header.appendChild(ring);
    header.appendChild(chevron);
    root.appendChild(header);

    if (module && module.note) {
      var note = document.createElement('div');
      note.className = 'cja-module-note';
      note.textContent = formatDisplayText(module.note);
      body.appendChild(note);
    }

    if (items.length) {
      items.forEach(function (item) {
        body.appendChild(renderItem(item));
      });
    } else {
      body.appendChild(createEmptyState('Für dieses Modul liegen noch keine Einzelwerte vor.'));
    }

    root.appendChild(body);
    header.addEventListener('click', function () {
      toggleModule(root);
    });

    return root;
  }

  function renderItem(item) {
    var status = normalizeStatus(item && item.status);
    var card = document.createElement('div');
    var head = document.createElement('div');
    var copy = document.createElement('div');
    var metric = document.createElement('div');
    var value = document.createElement('div');
    var badge = document.createElement('span');

    card.className = 'cja-item';
    card.setAttribute('data-status', status);

    head.className = 'cja-item-header';
    copy.className = 'cja-item-copy';
    metric.className = 'cja-item-metric';
    metric.textContent = formatDisplayText(item && item.metric ? item.metric : 'Prüfpunkt');
    copy.appendChild(metric);

    badge.className = 'cja-item-badge';
    badge.textContent = statusLabels[status];
    copy.appendChild(badge);

    value.className = 'cja-item-value';
    value.textContent = formatDisplayText(item && item.value ? item.value : 'n/a');

    head.appendChild(copy);
    head.appendChild(value);
    card.appendChild(head);

    if (item && item.hint) {
      var hint = document.createElement('div');
      hint.className = 'cja-item-hint';
      hint.textContent = formatDisplayText(item.hint);
      card.appendChild(hint);
    }

    if (item && item.target) {
      var target = document.createElement('div');
      target.className = 'cja-item-target';
      target.textContent = 'Ziel: ' + formatDisplayText(item.target);
      card.appendChild(target);
    }

    return card;
  }

  function renderInsightCard(strategicAssessment, revenue) {
    if (hasStrategicAssessment(strategicAssessment)) {
      renderStrategicCard(strategicAssessment);
      return;
    }

    renderRevenueCard(revenue);
  }

  function renderStrategicCard(strategy) {
    if (!hasStrategicAssessment(strategy)) return;

    var card = document.createElement('section');
    var head = document.createElement('div');
    var icon = document.createElement('span');
    var title = document.createElement('h2');
    var biggest = strategy.biggest_bottleneck;
    var priorities = Array.isArray(strategy.priorities) ? strategy.priorities : [];

    card.className = 'cja-strategic cja-reveal';
    card.style.transitionDelay = '600ms';

    head.className = 'cja-strategic-header';
    icon.textContent = strategy.icon || '💡';
    title.textContent = formatDisplayText(strategy.label || 'Strategische Einschätzung');
    head.appendChild(icon);
    head.appendChild(title);
    card.appendChild(head);

    if (biggest && (biggest.area || biggest.description)) {
      var bottleneck = document.createElement('div');
      var bottleneckLabel = document.createElement('div');
      var labelText = document.createTextNode('Größter Hebel: ');
      var area = document.createElement('strong');
      var description = document.createElement('p');

      bottleneck.className = 'cja-bottleneck';
      bottleneckLabel.className = 'cja-bottleneck-label';
      area.textContent = formatDisplayText(biggest.area || 'Unklar');
      description.textContent = formatDisplayText(biggest.description || 'Für diesen Hebel liegt noch keine Beschreibung vor.');

      bottleneckLabel.appendChild(labelText);
      bottleneckLabel.appendChild(area);
      bottleneckLabel.appendChild(createPriorityBadge(biggest.priority));
      bottleneck.appendChild(bottleneckLabel);
      bottleneck.appendChild(description);
      card.appendChild(bottleneck);
    }

    if (priorities.length) {
      var prioritiesWrap = document.createElement('div');
      var prioritiesTitle = document.createElement('h3');

      prioritiesWrap.className = 'cja-priorities';
      prioritiesTitle.textContent = 'Alle Bereiche nach Priorität';
      prioritiesWrap.appendChild(prioritiesTitle);

      priorities.forEach(function (item) {
        var row = document.createElement('div');
        var area = document.createElement('span');

        row.className = 'cja-priority-row';
        area.className = 'cja-priority-area';
        area.textContent = formatDisplayText(item.area || 'Bereich');

        if (item.bottleneck) {
          row.title = item.bottleneck;
        }

        row.appendChild(area);
        row.appendChild(createPriorityBadge(item.priority));
        prioritiesWrap.appendChild(row);
      });

      card.appendChild(prioritiesWrap);
    }

    if (strategy.summary) {
      var summary = document.createElement('div');
      var summaryText = document.createElement('p');

      summary.className = 'cja-strategic-summary';
      summaryText.textContent = formatDisplayText(strategy.summary);
      summary.appendChild(summaryText);
      card.appendChild(summary);
    }

    refs.revenue.appendChild(card);
  }

  function createPriorityBadge(priority) {
    var badge = document.createElement('span');
    var normalized = normalizePriority(priority);

    badge.className = 'cja-priority-badge priority-' + normalized;
    badge.textContent = normalized;
    return badge;
  }

  function hasStrategicAssessment(strategy) {
    return Boolean(
      strategy &&
      (
        strategy.summary ||
        (strategy.biggest_bottleneck && (strategy.biggest_bottleneck.area || strategy.biggest_bottleneck.description)) ||
        (Array.isArray(strategy.priorities) && strategy.priorities.length)
      )
    );
  }

  function renderRevenueCard(revenue) {
    if (!revenue || !revenue.summary) return;

    var card = document.createElement('section');
    var head = document.createElement('div');
    var icon = document.createElement('span');
    var titleWrap = document.createElement('div');
    var title = document.createElement('h2');
    var subtitle = document.createElement('p');
    var stats = document.createElement('div');
    var detail = document.createElement('div');
    var uplift = document.createElement('div');
    var note = document.createElement('p');
    var summary = revenue.summary;
    var statItems = [
      { label: 'Traffic-Schätzung', value: normalizeRevenueValue(summary.estimated_traffic) },
      { label: 'Conversion-Schätzung', value: normalizeRevenueValue(summary.estimated_conversion) },
      { label: 'Leads aktuell', value: normalizeRevenueValue(summary.current_leads) },
      { label: 'Leads Potenzial', value: normalizeRevenueValue(summary.potential_leads), highlight: true }
    ];

    card.className = 'cja-revenue cja-reveal';
    card.style.transitionDelay = '600ms';

    head.className = 'cja-revenue-head';
    icon.className = 'cja-module-icon';
    icon.textContent = normalizeRevenueIcon(revenue.icon);

    title.textContent = formatDisplayText(normalizeRevenueTitle(revenue.label));
    subtitle.textContent = 'Modellierte Orientierung auf Basis der gelieferten Daten, keine Forecast-Zusage.';
    titleWrap.appendChild(title);
    titleWrap.appendChild(subtitle);
    head.appendChild(icon);
    head.appendChild(titleWrap);
    card.appendChild(head);

    stats.className = 'cja-revenue-stats';
    statItems.forEach(function (item) {
      stats.appendChild(createRevenueStat(item.label, item.value, item.highlight));
    });
    card.appendChild(stats);

    detail.className = 'cja-revenue-detail';
    detail.textContent = formatDisplayText(summary.detail || 'Für dieses Potenzial liegt keine Zusatzbeschreibung vor.');
    card.appendChild(detail);

    uplift.className = 'cja-revenue-uplift';
    uplift.textContent = formatDisplayText(formatRevenueUplift(summary.potential_uplift));
    card.appendChild(uplift);

    note.className = 'cja-revenue-note';
    note.textContent = 'Orientierungswert auf Basis der gelieferten Daten und heuristischer Annahmen. Keine Umsatzgarantie.';
    card.appendChild(note);

    refs.revenue.appendChild(card);
  }

  function createRevenueStat(label, value, highlight) {
    var card = document.createElement('div');
    var amount = document.createElement('div');
    var text = document.createElement('div');

    card.className = 'cja-revenue-stat' + (highlight ? ' highlight' : '');
    amount.className = 'cja-revenue-stat-value';
    text.className = 'cja-revenue-stat-label';

    amount.textContent = value || 'n/a';
    text.textContent = label;

    card.appendChild(amount);
    card.appendChild(text);
    return card;
  }

  function normalizeRevenueIcon(icon) {
    var value = String(icon || '').trim();

    if (!value || value === '$' || value === '💰' || value === '💵' || value === '💲') {
      return '€';
    }

    return value;
  }

  function normalizeRevenueTitle(label) {
    var value = normalizePlainText(label);

    if (!value || value === 'revenue impact' || value === 'opportunity') {
      return 'Lead-Potenzial';
    }

    return label;
  }

  function normalizeRevenueValue(value) {
    if (typeof value === 'number' && !isNaN(value)) {
      return String(Math.round(value));
    }

    if (value === null || typeof value === 'undefined' || value === '') {
      return 'n/a';
    }

    return String(value).replace(/\d+\.\d{1,2}|\d+,\d{1,2}/g, function (match) {
      var parsed = parseFloat(match.replace(',', '.'));
      return isNaN(parsed) ? match : String(Math.round(parsed));
    });
  }

  function formatRevenueUplift(value) {
    var normalized = normalizeRevenueValue(value).trim();

    if (!normalized || normalized === 'n/a') {
      return '';
    }

    if (/potenzial/i.test(normalized)) {
      return normalized;
    }

    if (/mehr\s+leads\s+m[öo]glich/i.test(normalized)) {
      return normalized.replace(/mehr\s+leads\s+m[öo]glich/i, 'zusätzliche Leads als Orientierungswert');
    }

    return 'Potenzial laut Modell: ' + normalized;
  }

  function normalizeAuditPayload(data) {
    var payload = unwrapAuditPayload(data);

    if (looksLikeV3Payload(payload)) {
      return normalizeV3Payload(payload);
    }

    return normalizeCurrentPayload(payload || {});
  }

  function unwrapAuditPayload(data) {
    if (data && data.data && (looksLikeCurrentPayload(data.data) || looksLikeV3Payload(data.data))) {
      return data.data;
    }

    if (data && data.frontendData && looksLikeV3Payload(data.frontendData)) {
      return data.frontendData;
    }

    return data || {};
  }

  function looksLikeAuditResult(data) {
    return looksLikeCurrentPayload(data) || looksLikeV3Payload(data) || Boolean(data && data.data && (looksLikeCurrentPayload(data.data) || looksLikeV3Payload(data.data)));
  }

  function looksLikeCurrentPayload(data) {
    return Boolean(data && (typeof data.overall_score !== 'undefined' || data.modules || Array.isArray(data.quickWins)));
  }

  function looksLikeV3Payload(data) {
    return Boolean(data && data.verdict && Array.isArray(data.findings));
  }

  function normalizeCurrentPayload(data) {
    var modules = data && typeof data.modules === 'object' && data.modules ? Object.assign({}, data.modules) : {};
    var fallbackRevenue = normalizeRevenueModule(data && data.revenue ? data.revenue : null);

    if (!modules.revenue && fallbackRevenue) {
      modules.revenue = fallbackRevenue;
    }

    return {
      overall_score: parseScore(data.overall_score),
      timestamp: data.timestamp || data.generatedAt || '',
      fullUrl: String(data.fullUrl || data.url || data.domain || '').trim(),
      url: stripUrlProtocol(data.url || data.fullUrl || data.domain || ''),
      quickWins: normalizeTextList(data.quickWins),
      strategic_assessment: normalizeStrategicAssessment(data.strategic_assessment),
      modules: modules
    };
  }

  function normalizeV3Payload(data) {
    var meta = data.meta || {};
    var sections = data.details && Array.isArray(data.details.sections) ? data.details.sections : [];
    var modules = buildV3Modules(sections);
    var revenue = normalizeRevenueModule(data.opportunity || data.revenue);
    var scores = Object.keys(modules)
      .filter(function (key) { return key !== 'revenue'; })
      .map(function (key) { return parseScore(modules[key].score); })
      .filter(function (score) { return typeof score === 'number'; });
    var overallScore = scores.length ? Math.round(average(scores)) : scoreFromTone(data.verdict && data.verdict.status);

    if (revenue) {
      modules.revenue = revenue;
    }

    return {
      overall_score: overallScore,
      timestamp: meta.generatedAt || '',
      fullUrl: String(meta.url || meta.domain || '').trim(),
      url: stripUrlProtocol(meta.url || meta.domain || ''),
      quickWins: buildV3QuickWins(data),
      strategic_assessment: null,
      modules: modules
    };
  }

  function normalizeStrategicAssessment(strategy) {
    if (!strategy || typeof strategy !== 'object') {
      return null;
    }

    var biggest = strategy.biggest_bottleneck && typeof strategy.biggest_bottleneck === 'object'
      ? {
        area: String(strategy.biggest_bottleneck.area || '').trim(),
        description: String(strategy.biggest_bottleneck.description || '').trim(),
        priority: normalizePriority(strategy.biggest_bottleneck.priority)
      }
      : null;
    var priorities = (Array.isArray(strategy.priorities) ? strategy.priorities : [])
      .map(function (item) {
        return {
          area: String(item && item.area || '').trim(),
          priority: normalizePriority(item && item.priority),
          bottleneck: String(item && item.bottleneck || '').trim()
        };
      })
      .filter(function (item) {
        return item.area;
      });
    var summary = String(strategy.summary || '').trim();
    var label = String(strategy.label || '').trim();
    var icon = String(strategy.icon || '').trim();

    if (!summary && !priorities.length && !(biggest && (biggest.area || biggest.description))) {
      return null;
    }

    return {
      label: label || 'Strategische Einschätzung',
      icon: icon || '💡',
      biggest_bottleneck: biggest,
      priorities: priorities,
      summary: summary
    };
  }

  function buildV3Modules(sections) {
    var modules = {};

    sections.forEach(function (section, index) {
      var key = getSectionKey(section.title, index);
      var rows = Array.isArray(section.rows) ? section.rows : [];

      modules[key] = {
        label: formatSectionTitle(section.title),
        icon: getSectionIcon(section.title),
        score: getSectionScore(rows),
        note: section.note || '',
        items: rows.map(function (row) {
          return {
            metric: row.label || 'Prüfpunkt',
            value: row.value || 'n/a',
            status: mapItemStatus(row.status),
            hint: row.help || ''
          };
        })
      };
    });

    return modules;
  }

  function normalizeRevenueModule(revenue) {
    if (!revenue || !revenue.summary) {
      return null;
    }

    return {
      label: revenue.label || 'Lead-Potenzial',
      icon: revenue.icon || '€',
      summary: revenue.summary
    };
  }

  function buildV3QuickWins(data) {
    var wins = normalizeTextList((data.findings || []).map(function (item) {
      return item && (item.action || item.summary || item.title);
    }));

    if (wins.length) {
      return wins;
    }

    return normalizeTextList((data.highlights || []).map(function (item) {
      return item && (item.help || item.value || item.label);
    }));
  }

  function normalizeTextList(list) {
    return (Array.isArray(list) ? list : [])
      .map(function (item) {
        return String(item || '').trim();
      })
      .filter(Boolean)
      .slice(0, 3);
  }

  function getSectionKey(title, index) {
    var normalized = normalizePlainText(title);

    if (normalized === 'versprechen') return 'promise';
    if (normalized === 'proof') return 'proof';
    if (normalized === 'naechster schritt') return 'next_step';
    if (normalized === 'mobiler eindruck') return 'mobile';

    return 'module_' + index;
  }

  function formatSectionTitle(title) {
    var normalized = normalizePlainText(title);

    if (normalized === 'naechster schritt') return 'Nächster Schritt';
    if (normalized === 'mobiler eindruck') return 'Mobiler Eindruck';
    if (normalized === 'versprechen') return 'Versprechen';
    if (normalized === 'proof') return 'Proof';

    return formatDisplayText(title || 'Modul');
  }

  function getSectionIcon(title) {
    var normalized = normalizePlainText(title);

    if (normalized === 'versprechen') return '✍️';
    if (normalized === 'proof') return '🤝';
    if (normalized === 'naechster schritt') return '🎯';
    if (normalized === 'mobiler eindruck') return '📱';

    return '•';
  }

  function normalizePlainText(value) {
    return String(value || '')
      .toLowerCase()
      .replace(/ä/g, 'ae')
      .replace(/ö/g, 'oe')
      .replace(/ü/g, 'ue')
      .replace(/ß/g, 'ss')
      .replace(/\s+/g, ' ')
      .trim();
  }

  // Backend payloads can arrive ASCII-transliterated; restore German copy without touching hosts or URLs.
  function formatDisplayText(value) {
    var text = String(value || '').trim();

    if (!text || looksLikeProtectedText(text)) {
      return text;
    }

    return text.replace(/\b[A-Za-z][A-Za-z-]*\b/g, function (word) {
      return restoreGermanWord(word);
    });
  }

  function looksLikeProtectedText(text) {
    return /^(https?:\/\/|www\.|#)/i.test(text) ||
      /^[\w.-]+\.[a-z]{2,}(?:[/?#].*)?$/i.test(text) ||
      /^[A-Z0-9_-]+$/.test(text) ||
      /^[\w/-]+\.(?:css|js|json|php|html?|svg|png|jpe?g|webp)$/i.test(text);
  }

  function restoreGermanWord(word) {
    if (!/(ae|oe|ue|ss)/i.test(word) || /[ÄÖÜäöüß]/.test(word)) {
      return word;
    }

    var lower = word.toLowerCase();
    var restored = lower
      .replace(/ae/g, 'ä')
      .replace(/oe/g, 'ö');

    if (!shouldKeepUe(lower)) {
      restored = restored.replace(/ue/g, 'ü');
    }

    restored = restored
      .replace(/gröss/g, 'größ')
      .replace(/gross/g, 'groß')
      .replace(/heiss/g, 'heiß')
      .replace(/weiss/g, 'weiß')
      .replace(/ausser/g, 'außer')
      .replace(/strass/g, 'straß')
      .replace(/massnahm/g, 'maßnahm')
      .replace(/fliess/g, 'fließ');

    return applyWordCase(word, restored);
  }

  function shouldKeepUe(word) {
    return /^neu/.test(word) ||
      /(eue|euer|euen|euem|eues|uell|queue|teuer|feuer|steuer|treu|reue|heuer|abenteuer|ungeheuer)/.test(word);
  }

  function applyWordCase(source, target) {
    if (!target) {
      return source;
    }

    if (source === source.toUpperCase()) {
      return target.toUpperCase();
    }

    if (source.charAt(0) === source.charAt(0).toUpperCase()) {
      return target.charAt(0).toUpperCase() + target.slice(1);
    }

    return target;
  }

  function normalizePriority(value) {
    var normalized = normalizePlainText(value);

    if (normalized === 'hoch' || normalized === 'high') return 'hoch';
    if (normalized === 'niedrig' || normalized === 'low') return 'niedrig';
    return 'mittel';
  }

  function mapItemStatus(status) {
    if (status === 'green' || status === 'yellow' || status === 'red') {
      return status;
    }

    if (status === 'good') return 'green';
    if (status === 'bad') return 'red';

    return 'yellow';
  }

  function getSectionScore(rows) {
    var values = (Array.isArray(rows) ? rows : [])
      .map(function (row) {
        return scoreFromTone(row && row.status);
      })
      .filter(function (score) {
        return typeof score === 'number';
      });

    return values.length ? Math.round(average(values)) : scoreFromTone('warning');
  }

  function scoreFromTone(status) {
    if (status === 'green' || status === 'good') return 84;
    if (status === 'red' || status === 'bad') return 32;
    return 58;
  }

  function average(values) {
    if (!values.length) return null;

    var sum = values.reduce(function (total, value) {
      return total + value;
    }, 0);

    return sum / values.length;
  }

  function parseScore(value) {
    if (typeof value === 'number' && !isNaN(value)) {
      return value;
    }

    var parsed = Number(value);
    return !isNaN(parsed) ? parsed : null;
  }

  function createScoreRing(score, size, strokeWidth) {
    var safeScore = typeof score === 'number' && !isNaN(score) ? Math.max(0, Math.min(score, 100)) : null;
    var radius = (size - strokeWidth) / 2;
    var circumference = 2 * Math.PI * radius;
    var color = safeScore === null ? 'rgba(255,255,255,0.2)' : getScoreColor(safeScore);
    var container = document.createElement('div');
    var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    var bgCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    var scoreCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    var label = document.createElement('div');
    var strong = document.createElement('strong');
    var span = document.createElement('span');

    container.className = 'cja-score-ring' + (size <= 60 ? ' is-compact' : '');

    svg.setAttribute('width', String(size));
    svg.setAttribute('height', String(size));

    setCircleAttrs(bgCircle, size, radius, strokeWidth, 'rgba(255,255,255,0.06)');
    setCircleAttrs(scoreCircle, size, radius, strokeWidth, color);
    scoreCircle.style.strokeDasharray = String(circumference);
    scoreCircle.style.strokeDashoffset = String(circumference);
    scoreCircle.style.strokeLinecap = 'round';
    scoreCircle.style.transition = prefersReducedMotion() ? 'none' : 'stroke-dashoffset 1.2s cubic-bezier(0.16, 1, 0.3, 1)';

    svg.appendChild(bgCircle);
    svg.appendChild(scoreCircle);

    label.className = 'cja-score-ring-label';
    strong.textContent = safeScore === null ? '–' : String(Math.round(safeScore));
    span.textContent = 'von 100';
    label.appendChild(strong);
    label.appendChild(span);

    container.appendChild(svg);
    container.appendChild(label);

    window.setTimeout(function () {
      if (safeScore === null) return;
      scoreCircle.style.strokeDashoffset = String(circumference - (safeScore / 100) * circumference);
    }, prefersReducedMotion() ? 0 : 400);

    return container;
  }

  function setCircleAttrs(circle, size, radius, strokeWidth, stroke) {
    circle.setAttribute('cx', String(size / 2));
    circle.setAttribute('cy', String(size / 2));
    circle.setAttribute('r', String(radius));
    circle.setAttribute('fill', 'none');
    circle.setAttribute('stroke', stroke);
    circle.setAttribute('stroke-width', String(strokeWidth));
  }

  function initReveals() {
    if (state.revealObserver) {
      state.revealObserver.disconnect();
    }

    if (!('IntersectionObserver' in window)) {
      document.querySelectorAll('.cja-reveal').forEach(function (node) {
        node.classList.add('is-visible');
      });
      return;
    }

    state.revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          state.revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.cja-reveal').forEach(function (node) {
      state.revealObserver.observe(node);
    });
  }

  function toggleModule(root, forceOpen) {
    var header = root.querySelector('.cja-module-header');
    var body = root.querySelector('.cja-module-body');
    var willOpen = typeof forceOpen === 'boolean' ? forceOpen : !root.classList.contains('is-open');

    if (!header || !body) return;

    if (willOpen) {
      root.classList.add('is-open');
      header.setAttribute('aria-expanded', 'true');
      body.style.maxHeight = body.scrollHeight + 'px';
      return;
    }

    body.style.maxHeight = body.scrollHeight + 'px';
    window.requestAnimationFrame(function () {
      root.classList.remove('is-open');
      header.setAttribute('aria-expanded', 'false');
      body.style.maxHeight = '0px';
    });
  }

  function createEmptyState(text) {
    var node = document.createElement('div');
    node.className = 'cja-empty';
    node.textContent = text;
    return node;
  }

  function stripUrlProtocol(value) {
    return String(value || '').replace(/^https?:\/\//i, '');
  }

  function toScore(value) {
    return parseScore(value);
  }

  function normalizeStatus(status) {
    return status === 'green' || status === 'yellow' || status === 'red' ? status : 'yellow';
  }

  function buildProblemLabel(count) {
    return count + ' ' + (count === 1 ? 'Prüfpunkt' : 'Prüfpunkte');
  }

  function getScoreColor(score) {
    if (score >= 70) return '#22c55e';
    if (score >= 45) return '#eab308';
    return '#ef4444';
  }

  function formatTimestamp(value) {
    if (!value) return '';

    try {
      return new Date(value).toLocaleString('de-DE', {
        dateStyle: 'medium',
        timeStyle: 'short'
      });
    } catch (error) {
      return '';
    }
  }

  function prefersReducedMotion() {
    return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }
})();
