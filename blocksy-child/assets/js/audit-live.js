/**
 * AUDIT LIVE — Form Submit → n8n Polling → On-Site Result Rendering
 * ================================================================
 * Ersetzt den FluentForm-Flow: Formular geht direkt an n8n,
 * Ergebnisse werden live auf der Seite gerendert.
 *
 * v2: Bridge-CTA zum 360° Deep-Dive + Fluent Form Integration
 *
 * Benötigt: audit-results.css für Styling
 * Kompatibel mit: NexusCore (ScrollSpy, Reveal)
 */
(function () {
  'use strict';

  // ─── CONFIG ──────────────────────────────────────────────
  var CONFIG = {
    webhookStart: 'https://hasim.app.n8n.cloud/webhook/audit',
    webhookStatus: 'https://hasim.app.n8n.cloud/webhook/audit-status',
    pollInterval: 5000,
    pollTimeout: 180000,
    animDelay: 120
  };

  // ─── STATE ───────────────────────────────────────────────
  var state = {
    jobId: null,
    pollTimer: null,
    pollStart: null,
    auditUrl: null,
    phase: 'idle'
  };

  // ─── LOADER MESSAGES ─────────────────────────────────────
  var loaderSteps = [
    { icon: '🔍', text: 'Google-Sichtbarkeit wird geprüft …', sub: 'Wir checken 6 kaufrelevante Keywords' },
    { icon: '⚡', text: 'Lighthouse analysiert Ihre Seite …', sub: 'Mobile Performance & Core Web Vitals' },
    { icon: '🤝', text: 'Trust-Signale werden ausgewertet …', sub: 'Cases, Testimonials, Bewertungen' },
    { icon: '🎯', text: 'Lead-Capture wird geprüft …', sub: 'Kontaktformular, Lead-Magneten, CTA' },
    { icon: '📊', text: 'Revenue Gap wird berechnet …', sub: 'Verlorenes Potenzial in Euro/Monat' },
    { icon: '✍️', text: 'Strategische Einordnung wird erstellt …', sub: 'KI-gestützte Analyse Ihrer Schwachstellen' }
  ];

  // ─── INIT ────────────────────────────────────────────────
  function init() {
    var form = document.getElementById('audit-live-form');
    if (!form) return;

    form.addEventListener('submit', handleSubmit);

    var urlInput = form.querySelector('[name="url"]');
    if (urlInput) {
      urlInput.addEventListener('blur', function () {
        var v = this.value.trim();
        if (v && !/^https?:\/\//i.test(v)) {
          this.value = 'https://' + v;
        }
      });
    }
  }

  // ─── FORM SUBMIT ─────────────────────────────────────────
  function handleSubmit(e) {
    e.preventDefault();
    if (state.phase === 'submitting' || state.phase === 'polling') return;

    var form = e.target;
    var url = form.querySelector('[name="url"]').value.trim();

    if (!url) {
      showFormError('Bitte URL eingeben.');
      return;
    }
    if (!/^https?:\/\/.+\..+/.test(url)) {
      showFormError('Bitte eine gültige URL eingeben (z. B. https://example.de).');
      return;
    }

    state.auditUrl = url;

    clearFormError();
    setPhase('submitting');
    showLoader();

    fetch(CONFIG.webhookStart, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ url: url })
    })
    .then(function (res) { return parseJsonResponse(res, 'Audit-Start'); })
    .then(function (data) {
      if (!data.ok) {
        throw new Error(data.error || 'Ungültige Anfrage.');
      }
      state.jobId = data.jobId;
      setPhase('polling');
      state.pollStart = Date.now();
      startPolling();
    })
    .catch(function (err) {
      setPhase('error');
      showLoaderError(err.message || 'Verbindungsfehler. Bitte erneut versuchen.');
    });
  }

  // ─── POLLING ─────────────────────────────────────────────
  function startPolling() {
    var msgIndex = 0;
    var pollFailures = 0;
    updateLoaderStep(loaderSteps[0]);

    state.pollTimer = setInterval(function () {
      if (Date.now() - state.pollStart > CONFIG.pollTimeout) {
        clearInterval(state.pollTimer);
        state.pollTimer = null;
        setPhase('error');
        showLoaderError('Die Analyse dauert länger als erwartet. Der Report wird per E-Mail zugestellt.');
        return;
      }

      msgIndex = (msgIndex + 1) % loaderSteps.length;
      updateLoaderStep(loaderSteps[msgIndex]);

      fetch(CONFIG.webhookStatus + '?jobId=' + encodeURIComponent(state.jobId))
        .then(function (res) { return parseJsonResponse(res, 'Audit-Status'); })
        .then(function (data) {
          pollFailures = 0;
          if (data.status === 'done' && data.data) {
            clearInterval(state.pollTimer);
            state.pollTimer = null;
            setPhase('rendering');
            renderResults(data.data);
          } else if (data.status === 'error' || data.status === 'expired') {
            clearInterval(state.pollTimer);
            state.pollTimer = null;
            setPhase('error');
            showLoaderError(data.error || 'Fehler bei der Analyse.');
          }
        })
        .catch(function (err) {
          pollFailures += 1;

          if (err && /keine JSON-Antwort|ungültiges JSON/i.test(err.message || '')) {
            clearInterval(state.pollTimer);
            state.pollTimer = null;
            setPhase('error');
            showLoaderError(err.message + ' Bitte n8n-Webhook prüfen.');
            return;
          }

          if (pollFailures >= 3) {
            var sub = document.getElementById('loader-sub');
            if (sub) sub.textContent = 'Verbindung instabil. Wir versuchen es erneut …';
          }
        });
    }, CONFIG.pollInterval);
  }

  // ─── UI: LOADER ──────────────────────────────────────────
  function showLoader() {
    var formWrap = document.getElementById('audit-form-inner');
    var loader = document.getElementById('audit-loader');
    if (formWrap) formWrap.style.display = 'none';
    if (loader) {
      loader.style.display = 'block';
      loader.classList.add('is-active');
    }
  }

  function updateLoaderStep(step) {
    var icon = document.getElementById('loader-icon');
    var text = document.getElementById('loader-text');
    var sub = document.getElementById('loader-sub');
    var progress = document.getElementById('loader-progress');

    if (icon) icon.textContent = step.icon;
    if (text) {
      text.style.opacity = '0';
      setTimeout(function () {
        text.textContent = step.text;
        text.style.opacity = '1';
      }, 200);
    }
    if (sub) {
      sub.style.opacity = '0';
      setTimeout(function () {
        sub.textContent = step.sub;
        sub.style.opacity = '1';
      }, 300);
    }

    if (progress && state.pollStart) {
      var elapsed = Date.now() - state.pollStart;
      var pct = Math.min(95, (elapsed / CONFIG.pollTimeout) * 100);
      progress.style.width = pct + '%';
    }
  }

  function showLoaderError(msg) {
    var loader = document.getElementById('audit-loader');
    if (!loader) return;
    loader.innerHTML =
      '<div class="loader-error">' +
        '<div class="loader-error-icon">⚠️</div>' +
        '<p class="loader-error-text">' + escapeHtml(msg) + '</p>' +
        '<button class="audit-retry-btn" onclick="location.reload()">Erneut versuchen</button>' +
      '</div>';
  }

  // ─── UI: FORM ERRORS ────────────────────────────────────
  function showFormError(msg) {
    var el = document.getElementById('audit-form-error');
    if (el) {
      el.textContent = msg;
      el.style.display = 'block';
    }
  }

  function clearFormError() {
    var el = document.getElementById('audit-form-error');
    if (el) el.style.display = 'none';
  }

  // ─── RENDER RESULTS ──────────────────────────────────────
  function renderResults(data) {
    var loader = document.getElementById('audit-loader');
    var results = document.getElementById('audit-results');
    var wrapper = document.getElementById('audit-main-wrapper');
    var progress = document.getElementById('loader-progress');
    if (loader) loader.style.display = 'none';
    if (progress) progress.style.width = '100%';

    if (!results) return;
    if (wrapper) wrapper.classList.add('view-mode-results');
    results.style.display = 'block';

    var html = '';

    // ── Result Header
    html += renderResultHeader(data);

    // ── Score Overview
    html += renderScoreOverview(data);

    // ── Journey Steps
    html += renderJourneySteps(data);

    // ── Revenue Gap
    html += renderRevenueGap(data);

    // ── Story
    html += renderStory(data);

    // ── Bridge CTA → Deep-Dive (NEU: ersetzt alten Strategiecall-CTA)
    html += renderCTA(data);

    // ── Email Capture
    html += renderEmailCapture();

    // ── 360° Deep-Dive Section (NEU)
    html += renderDeepDiveSection();

    results.innerHTML = html;

    // Trigger animations
    setTimeout(function () {
      results.classList.add('is-visible');
      staggerReveal(results.querySelectorAll('.result-animate'));
    }, 100);

    // Scroll to results
    results.scrollIntoView({ behavior: 'smooth', block: 'start' });

    // Bind email capture
    var emailForm = document.getElementById('audit-email-capture');
    if (emailForm) emailForm.addEventListener('submit', handleEmailCapture);

    // Bind Deep-Dive CTA smooth scroll
    var deepDiveBtn = results.querySelector('.result-cta-deepdive');
    if (deepDiveBtn) {
      deepDiveBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var target = document.getElementById('deep-dive-section');
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }

    // Move pre-rendered Fluent Form into Deep-Dive placeholder
    var formSource = document.getElementById('deepdive-fluent-form');
    var formTarget = document.getElementById('deepdive-form-placeholder');
    if (formSource && formTarget) {
      formTarget.innerHTML = '';
      formSource.style.display = 'block';
      formTarget.appendChild(formSource);

      // Inject jobId into hidden field
      var hiddenJobId = formSource.querySelector('input[name="audit_job_id"]');
      if (hiddenJobId && state.jobId) {
        hiddenJobId.value = state.jobId;
      }
    }

    // Update nav
    updateNavForResults();

    setPhase('done');
  }

  // ── Result Header
  function renderResultHeader(data) {
    var m = data.meta || {};
    return (
      '<div class="result-header result-animate">' +
        '<div class="result-pill">Growth Audit</div>' +
        '<h2 class="result-title">Die wichtigsten Reibungspunkte Ihrer Website</h2>' +
        '<div class="result-meta">' +
          '<span class="result-domain">' + escapeHtml(m.domain || '') + '</span>' +
          (m.branche ? ' · ' + escapeHtml(m.branche) : '') +
          (m.standort ? ' · ' + escapeHtml(m.standort) : '') +
        '</div>' +
      '</div>'
    );
  }

  // ── Score Overview
  function renderScoreOverview(data) {
    var perf = data.performance || {};
    var serp = data.serpResults || [];
    var rev = data.revenue || {};

    var mobileScore = perf.mobileScore || 0;
    var mobileStatus = mobileScore >= 90 ? 'good' : mobileScore >= 50 ? 'warning' : 'bad';

    var visibleKws = serp.filter(function (r) { return r.status !== 'not_found'; }).length;
    var totalKws = serp.length || 6;
    var kwStatus = visibleKws === totalKws ? 'good' : visibleKws >= totalKws / 2 ? 'warning' : 'bad';

    var revMonth = rev.lostRevenueMonth || 0;

    return (
      '<div class="score-grid result-animate">' +
        renderScoreCard('⚡', 'Mobile Score', mobileScore + '/100', mobileStatus, formatScoreRing(mobileScore)) +
        renderScoreCard('🔍', 'Google Top 10', visibleKws + ' von ' + totalKws, kwStatus, formatScoreRing((visibleKws / totalKws) * 100)) +
        renderScoreCard('💰', 'Revenue Gap', '~' + formatEuro(revMonth) + '/Mo', 'bad', '') +
      '</div>'
    );
  }

  function renderScoreCard(icon, label, value, status, ring) {
    return (
      '<div class="score-card score-' + status + '">' +
        '<div class="score-card-icon">' + icon + '</div>' +
        '<div class="score-card-label">' + label + '</div>' +
        '<div class="score-card-value">' + value + '</div>' +
        (ring ? '<div class="score-ring-wrap">' + ring + '</div>' : '') +
      '</div>'
    );
  }

  function formatScoreRing(pct) {
    pct = Math.max(0, Math.min(100, pct));
    var r = 36;
    var c = 2 * Math.PI * r;
    var offset = c - (pct / 100) * c;
    var color = pct >= 90 ? '#22c55e' : pct >= 50 ? '#eab308' : '#ef4444';
    return (
      '<svg width="80" height="80" viewBox="0 0 80 80">' +
        '<circle cx="40" cy="40" r="' + r + '" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="6"/>' +
        '<circle cx="40" cy="40" r="' + r + '" fill="none" stroke="' + color + '" stroke-width="6" ' +
          'stroke-dasharray="' + c + '" stroke-dashoffset="' + offset + '" ' +
          'stroke-linecap="round" transform="rotate(-90 40 40)" ' +
          'style="transition: stroke-dashoffset 1.5s cubic-bezier(0.16,1,0.3,1)"/>' +
        '<text x="40" y="44" text-anchor="middle" fill="' + color + '" font-size="16" font-weight="900" font-family="Satoshi,sans-serif">' + Math.round(pct) + '</text>' +
      '</svg>'
    );
  }

  // ── Funnel Steps
  function renderJourneySteps(data) {
    var steps = data.journeySteps || [];
    if (!steps.length) return '';

    var html = '<div class="result-journey result-animate">';
    html += '<h3 class="result-section-title">Die 4 Schritte Ihres Anfragewegs</h3>';

    for (var i = 0; i < steps.length; i++) {
      html += renderJourneyStep(steps[i], i);
    }

    html += '</div>';
    return html;
  }

  function renderJourneyStep(step, index) {
    var statusClass = step.status || 'warning';
    var statusIcon = { good: '✅', warning: '⚠️', bad: '❌' };
    var icon = step.icon || statusIcon[statusClass] || '•';

    var html = '<div class="result-step result-step-' + statusClass + ' result-animate" style="animation-delay:' + (index * CONFIG.animDelay) + 'ms">';

    html += '<div class="result-step-head">';
    html += '<span class="result-step-nr">' + step.nr + '</span>';
    html += '<span class="result-step-icon">' + icon + '</span>';
    html += '<span class="result-step-title">' + escapeHtml(step.title) + '</span>';
    html += '<span class="result-step-badge result-badge-' + statusClass + '">' + statusLabel(statusClass) + '</span>';
    html += '</div>';

    html += '<div class="result-step-body">';

    if (step.nr === 1 && step.results) {
      html += '<div class="serp-table">';
      for (var r = 0; r < step.results.length; r++) {
        html += renderSerpRow(step.results[r]);
      }
      html += '</div>';
    }

    if (step.details) {
      for (var d = 0; d < step.details.length; d++) {
        html += renderDetailRow(step.details[d]);
      }
    }

    html += '<div class="result-step-summary result-summary-' + statusClass + '">';
    html += escapeHtml(step.summary);
    html += '</div>';

    html += '</div></div>';
    return html;
  }

  function renderSerpRow(r) {
    var icon = r.status === 'not_found' ? '❌' : r.status === 'top3' ? '✅' : '⚠️';
    var statusText = r.status === 'not_found' ? 'Nicht auf Seite 1' : r.status === 'top3' ? 'Top 3' : 'Position ' + r.position;
    var statusClass = r.status === 'not_found' ? 'bad' : r.status === 'top3' ? 'good' : 'warning';

    var html = '<div class="serp-row">';
    html += '<div class="serp-kw">';
    html += '<span class="serp-kw-text">„' + escapeHtml(r.keyword) + '"</span>';
    html += '<span class="serp-vol">~' + r.volume + '/Mo</span>';
    html += '</div>';
    html += '<div class="serp-pos serp-pos-' + statusClass + '">' + icon + ' ' + statusText + '</div>';
    html += '</div>';

    if (r.competitors && r.competitors.length > 0 && r.status === 'not_found') {
      html += '<div class="serp-competitors">Stattdessen gefunden: ' +
        r.competitors.map(function (c) { return escapeHtml(c.name); }).join(', ') +
        '</div>';
    }

    return html;
  }

  function renderDetailRow(det) {
    var icon = { good: '✅', warning: '⚠️', bad: '❌' }[det.status] || '•';
    return (
      '<div class="result-detail-row">' +
        '<span class="result-detail-label">' + escapeHtml(det.label) + '</span>' +
        '<span class="result-detail-value result-val-' + det.status + '">' + icon + ' ' + escapeHtml(det.value) + '</span>' +
      '</div>'
    );
  }

  // ── Revenue Gap
  function renderRevenueGap(data) {
    var rev = data.revenue || {};
    return (
      '<div class="result-revenue result-animate">' +
        '<div class="result-revenue-label">Geschätzter Revenue Gap</div>' +
        '<div class="result-revenue-grid">' +
          renderRevenueStat('Verlorener Traffic', '~' + (rev.totalLostTraffic || 0) + ' Besucher/Mo') +
          renderRevenueStat('× Conversion Rate', rev.conversionRate || '2%') +
          renderRevenueStat('× Ø Kundenwert', formatEuro(rev.kundenwert || 0)) +
        '</div>' +
        '<div class="result-revenue-divider"></div>' +
        '<div class="result-revenue-totals">' +
          '<div class="result-revenue-big">' +
            '<span class="rev-label">Potenzial / Monat</span>' +
            '<span class="rev-amount">~' + formatEuro(rev.lostRevenueMonth || 0) + '</span>' +
          '</div>' +
          '<div class="result-revenue-big">' +
            '<span class="rev-label">Potenzial / Jahr</span>' +
            '<span class="rev-amount rev-amount-year">~' + formatEuro(rev.lostRevenueYear || 0) + '</span>' +
          '</div>' +
        '</div>' +
        '<p class="result-revenue-disclaimer">Basierend auf geschätzten Suchvolumen und branchentypischen Conversion Rates. Tatsächliche Werte können abweichen.</p>' +
      '</div>'
    );
  }

  function renderRevenueStat(label, value) {
    return (
      '<div class="rev-stat">' +
        '<span class="rev-stat-label">' + label + '</span>' +
        '<span class="rev-stat-value">' + value + '</span>' +
      '</div>'
    );
  }

  // ── Story
  function renderStory(data) {
    var story = data.story || '';
    if (!story || story.length < 50) return '';

    var paras = story.split(/\n\n+/).filter(function (p) { return p.trim().length > 20; });
    var html = '<div class="result-story result-animate">';
    html += '<h3 class="result-section-title">Strategische Einordnung</h3>';
    for (var i = 0; i < paras.length; i++) {
      html += '<p>' + escapeHtml(paras[i].replace(/\n/g, ' ').trim()) + '</p>';
    }
    html += '</div>';
    return html;
  }

  // ── CTA: Bridge zum 360° Deep-Dive (v2 — ersetzt alten Strategiecall)
  function renderCTA(data) {
    var rev = data.revenue || {};
    var serp = data.serpResults || [];

    var notFound = serp.filter(function (r) { return r.status === 'not_found'; });
    var topKw = notFound.length > 0 ? notFound[0].keyword : '';

    // Dynamische Headline
    var line1 = rev.lostRevenueYear > 50000
      ? '~' + formatEuro(rev.lostRevenueYear) + ' Jahrespotenzial liegen auf dem Tisch.'
      : 'Jeden Monat gehen Ihnen planbare Anfragen verloren.';

    var line2 = topKw
      ? 'Allein für „' + escapeHtml(topKw) + '" suchen potenzielle Kunden aktiv — und finden Ihre Wettbewerber.'
      : 'Ihre Wettbewerber sind dort sichtbar, wo Ihre Kunden suchen.';

    return (
      '<div class="result-cta result-animate">' +
        '<h3>' + line1 + '</h3>' +
        '<p>' + line2 + '</p>' +
        '<p class="result-cta-bridge">' +
          'Dieser Report zeigt, wo Ihr Anfrageweg Lücken hat. ' +
          'Was er nicht zeigen kann: ob Ihr Tracking saubere Daten liefert, ' +
          'wie Ihre Lead-Qualität wirklich aussieht und welche Hebel den größten ROI bringen.' +
        '</p>' +
        '<a href="#deep-dive-section" class="cta-btn result-cta-btn result-cta-deepdive">' +
          '360° Deep-Dive starten' +
        '</a>' +
        '<span class="result-cta-sub">5 gezielte Fragen · Kein Sales-Call · Persönliche Analyse in 48h</span>' +
        '<div class="result-cta-alt">' +
          '<span>Oder direkt:</span> ' +
          '<a href="https://cal.com/hasim/30min" target="_blank" rel="noopener">Strategiecall buchen →</a>' +
        '</div>' +
      '</div>'
    );
  }

  // ── Email Capture (nach Live-Ergebnis)
  function renderEmailCapture() {
    return (
      '<div class="result-email-capture result-animate" id="audit-email-capture-wrap">' +
        '<form id="audit-email-capture" novalidate>' +
          '<p class="email-capture-label">Report per E-Mail sichern <span style="opacity:0.5;font-weight:400;">(optional)</span></p>' +
          '<div class="email-capture-row">' +
            '<input type="email" name="email" placeholder="ihre@email.de" autocomplete="email" class="email-capture-input" />' +
            '<button type="submit" class="email-capture-btn">Senden</button>' +
          '</div>' +
          '<p class="email-capture-note">Nur Report. Kein Spam. Öffentliche Daten + konservative Euro-Schätzung.</p>' +
          '<div id="email-capture-feedback" style="display:none;"></div>' +
        '</form>' +
      '</div>'
    );
  }

  function handleEmailCapture(e) {
    e.preventDefault();
    var form = e.target;
    var email = form.querySelector('[name="email"]').value.trim();
    var feedback = document.getElementById('email-capture-feedback');

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      if (feedback) {
        feedback.textContent = 'Bitte eine gültige E-Mail-Adresse eingeben.';
        feedback.style.display = 'block';
        feedback.style.color = '#f87171';
      }
      return;
    }

    fetch(CONFIG.webhookStart, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: email, jobId: state.jobId, url: state.auditUrl, step: 'email_capture' })
    })
    .then(function (res) { return parseJsonResponse(res, 'Report-Versand'); })
    .then(function (data) {
      if (!data.ok) {
        throw new Error(data.error || 'Fehler beim Senden.');
      }

      if (data.status === 'processing') {
        if (feedback) {
          feedback.textContent = data.message || 'Audit läuft noch. Bitte gleich erneut versuchen.';
          feedback.style.display = 'block';
          feedback.style.color = '#f59e0b';
        }
        return;
      }

      var wrap = document.getElementById('audit-email-capture-wrap');
      if (wrap) {
        wrap.innerHTML =
          '<p class="email-capture-success">Report wird zugestellt. Prüfen Sie Ihren Posteingang.</p>';
      }
    })
    .catch(function (err) {
      if (feedback) {
        feedback.textContent = err && err.message ? err.message : 'Fehler beim Senden. Bitte erneut versuchen.';
        feedback.style.display = 'block';
        feedback.style.color = '#f87171';
      }
    });
  }

  // ── 360° Deep-Dive Section (NEU — erscheint nach CJA-Ergebnis)
  function renderDeepDiveSection() {
    return (
      '<div id="deep-dive-section" class="result-deepdive result-animate">' +
        '<div class="deepdive-header">' +
          '<span class="deepdive-pill">Nächster Schritt</span>' +
          '<h3 class="deepdive-title">360° Deep-Dive: Ursachen statt Symptome</h3>' +
          '<p class="deepdive-sub">' +
            'Sie kennen jetzt die Schwachstellen. Mit 5 gezielten Fragen zu Ihrem Setup ' +
            'erstelle ich eine persönliche Analyse mit konkreten Hebeln — priorisiert nach Impact.' +
          '</p>' +
        '</div>' +
        '<div class="deepdive-form-wrap">' +
          '<div class="deepdive-trust">' +
            '<span>✓ Kein Sales-Pitch</span>' +
            '<span>✓ Persönliche Analyse in 48h</span>' +
            '<span>✓ Konkreter Maßnahmenplan</span>' +
          '</div>' +
          '<div id="deepdive-form-placeholder">' +
            '<p style="text-align:center;color:#666;padding:2rem 0;">Formular wird geladen…</p>' +
          '</div>' +
        '</div>' +
      '</div>'
    );
  }

  // ─── HELPERS ─────────────────────────────────────────────
  function formatEuro(n) {
    if (!n) return '0 €';
    return n.toLocaleString('de-DE') + ' €';
  }

  function parseJsonResponse(res, label) {
    return res.text().then(function (text) {
      var body = (text || '').trim();
      var http = res && typeof res.status === 'number' ? ' (HTTP ' + res.status + ')' : '';

      if (!body) {
        throw new Error(label + ' liefert keine JSON-Antwort' + http + '.');
      }

      try {
        return JSON.parse(body);
      } catch (e) {
        throw new Error(label + ' liefert ungültiges JSON' + http + '.');
      }
    });
  }

  function statusLabel(s) {
    return { good: 'Gut', warning: 'Verbesserbar', bad: 'Kritisch' }[s] || s;
  }

  function escapeHtml(str) {
    if (!str) return '';
    var div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function setPhase(p) {
    state.phase = p;
    var wrapper = document.querySelector('.audit-wrapper');
    if (wrapper) wrapper.setAttribute('data-audit-phase', p);
  }

  function staggerReveal(elements) {
    for (var i = 0; i < elements.length; i++) {
      (function (el, delay) {
        setTimeout(function () {
          el.classList.add('is-revealed');
        }, delay);
      })(elements[i], i * CONFIG.animDelay);
    }
  }

  function updateNavForResults() {
    var nav = document.querySelector('.smart-nav');
    if (nav) nav.classList.add('is-visible');
  }

  // ─── BOOT ────────────────────────────────────────────────
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
