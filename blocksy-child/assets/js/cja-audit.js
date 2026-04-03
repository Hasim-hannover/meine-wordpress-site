(function () {
  'use strict';

  var refs = {};
  var state = {
    loadingPromise: null,
    loadingTimeouts: [],
    revealObserver: null
  };
  var steps = [
    'Website wird geladen...',
    'Performance wird gemessen...',
    'Tracking & Datenschutz wird geprüft...',
    'SEO-Grundlagen werden analysiert...',
    'Content wird ausgewertet...',
    'Revenue Impact wird berechnet...'
  ];
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
    refs.retry = document.getElementById('cja-retry');

    if (!refs.urlInput || !refs.submit) return;

    showInput();

    refs.submit.addEventListener('click', handleSubmit);
    if (refs.retry) {
      refs.retry.addEventListener('click', handleRetry);
    }
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

    if (!window.cjaConfig || !window.cjaConfig.webhookUrl) {
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
      var controller = new AbortController();
      var timeout = window.setTimeout(function () {
        controller.abort();
      }, 60000);

      var response = await fetch(window.cjaConfig.webhookUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url }),
        mode: 'cors',
        signal: controller.signal
      });

      window.clearTimeout(timeout);

      if (!response.ok) {
        throw new Error('Server-Fehler: ' + response.status);
      }

      var data = await response.json();
      await waitForMinLoadingTime();
      showResults(data);
    } catch (error) {
      if (error && error.name === 'AbortError') {
        showError('Die Analyse dauert ungewöhnlich lange. Bitte versuchen Sie es später erneut.');
      } else {
        showError('Die Analyse konnte nicht durchgeführt werden. Bitte versuchen Sie es erneut.');
      }
    }
  }

  function showInput() {
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
    refs.progress.style.width = '0%';

    state.loadingPromise = new Promise(function (resolve) {
      var index = 0;

      function advance() {
        refs.loadingStep.textContent = steps[index];
        refs.progress.style.width = Math.round(((index + 1) / steps.length) * 100) + '%';

        if (index === steps.length - 1) {
          state.loadingTimeouts.push(window.setTimeout(resolve, 700));
          return;
        }

        index += 1;
        state.loadingTimeouts.push(window.setTimeout(advance, 700));
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

  function handleRetry() {
    clearResults();
    clearError();
    showInput();

    if (state.revealObserver) {
      state.revealObserver.disconnect();
      state.revealObserver = null;
    }

    if (refs.urlInput) {
      refs.urlInput.value = '';
    }

    window.requestAnimationFrame(function () {
      scrollAppToTop();

      if (refs.urlInput) {
        window.setTimeout(function () {
          refs.urlInput.focus();
        }, prefersReducedMotion() ? 0 : 180);
      }
    });
  }

  function renderResults(data) {
    renderScoreHeader(data);
    renderModules(data.modules || {});
    renderRevenueCard((data.modules || {}).revenue);
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

    meta.className = 'cja-score-meta';
    kicker.className = 'cja-score-kicker';
    title.className = 'cja-score-title';
    subtitle.className = 'cja-score-sub';

    kicker.textContent = 'Growth Audit Ergebnis';
    title.textContent = (data.fullUrl || data.url || 'Ihre Website') + ' im Überblick';
    subtitle.textContent = timestamp ? 'Stand: ' + timestamp : 'Die stärksten Hebel aus Performance, Tracking, SEO und Content.';

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
      quickWinsTitle.textContent = 'Ihre Top 3 Quick Wins';
      quickWinsSubtitle.className = 'cja-quickwins-subtitle';
      quickWinsSubtitle.textContent = 'Die wirkungsvollsten Maßnahmen für sofortige Verbesserungen.';
      quickWinsList.className = 'cja-quickwins-list';

      quickWins.forEach(function (item) {
        var card = document.createElement('div');
        card.className = 'cja-quickwin';
        card.textContent = item;
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
    var keys = ['performance', 'tracking', 'seo', 'content'];
    var fallbackKeys = Object.keys(modules).filter(function (key) {
      return key !== 'revenue';
    });
    var order = keys.filter(function (key) { return modules[key]; });

    if (!order.length) {
      order = fallbackKeys;
    }

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
    label.textContent = module && module.label ? module.label : 'Modul';
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
    metric.textContent = item && item.metric ? item.metric : 'Prüfpunkt';
    copy.appendChild(metric);

    badge.className = 'cja-item-badge';
    badge.textContent = statusLabels[status];
    copy.appendChild(badge);

    value.className = 'cja-item-value';
    value.textContent = item && item.value ? item.value : 'n/a';

    head.appendChild(copy);
    head.appendChild(value);
    card.appendChild(head);

    if (item && item.hint) {
      var hint = document.createElement('div');
      hint.className = 'cja-item-hint';
      hint.textContent = item.hint;
      card.appendChild(hint);
    }

    if (item && item.target) {
      var target = document.createElement('div');
      target.className = 'cja-item-target';
      target.textContent = 'Ziel: ' + item.target;
      card.appendChild(target);
    }

    return card;
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
    var summary = revenue.summary;
    var statItems = [
      { label: 'Traffic', value: normalizeRevenueValue(summary.estimated_traffic) },
      { label: 'Conversion', value: normalizeRevenueValue(summary.estimated_conversion) },
      { label: 'Leads aktuell', value: normalizeRevenueValue(summary.current_leads) },
      { label: 'Leads Potenzial', value: normalizeRevenueValue(summary.potential_leads), highlight: true }
    ];

    card.className = 'cja-revenue cja-reveal';
    card.style.transitionDelay = '600ms';

    head.className = 'cja-revenue-head';
    icon.className = 'cja-module-icon';
    icon.textContent = normalizeRevenueIcon(revenue.icon);

    title.textContent = revenue.label || 'Revenue Impact';
    subtitle.textContent = 'Welcher Hebel geschäftlich am meisten wirken kann.';
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
    detail.textContent = summary.detail || 'Für dieses Modul liegt keine Zusatzbeschreibung vor.';
    card.appendChild(detail);

    uplift.className = 'cja-revenue-uplift';
    uplift.textContent = formatRevenueUplift(summary.potential_uplift);
    card.appendChild(uplift);

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

    if (/mehr\s+leads\s+m[öo]glich/i.test(normalized)) {
      return normalized;
    }

    return normalized + ' mehr Leads möglich';
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

  function toScore(value) {
    return typeof value === 'number' ? value : null;
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
