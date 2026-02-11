/**
 * AUDIT LIVE — Form Submit → n8n Polling → On-Site Result Rendering
 * ================================================================
 * Ersetzt den FluentForm-Flow: Formular geht direkt an n8n,
 * Ergebnisse werden live auf der Seite gerendert.
 *
 * Benötigt: audit-results.css für Styling
 * Kompatibel mit: NexusCore (ScrollSpy, Reveal)
 */
(function () {
  'use strict';

  // ─── CONFIG ──────────────────────────────────────────────
  var CONFIG = {
    // WICHTIG: Ersetze mit deiner echten n8n-URL
    webhookStart: 'https://DEINE-N8N-INSTANZ.app.n8n.cloud/webhook/audit',
    webhookStatus: 'https://DEINE-N8N-INSTANZ.app.n8n.cloud/webhook/audit-status',
    pollInterval: 5000,    // 5 Sekunden
    pollTimeout: 180000,   // 3 Minuten max
    animDelay: 120         // ms zwischen Step-Animationen
  };

  // ─── STATE ───────────────────────────────────────────────
  var state = {
    jobId: null,
    pollTimer: null,
    pollStart: null,
    phase: 'idle' // idle | submitting | polling | rendering | done | error
  };

  // ─── LOADER MESSAGES (rotieren während Polling) ──────────
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

    // URL-Feld: auto-prefix https://
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
    var email = form.querySelector('[name="email"]').value.trim();

    // Basic validation
    if (!url || !email) {
      showFormError('Bitte URL und E-Mail-Adresse eingeben.');
      return;
    }
    if (!/^https?:\/\/.+\..+/.test(url)) {
      showFormError('Bitte eine gültige URL eingeben (z. B. https://example.de).');
      return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFormError('Bitte eine gültige E-Mail-Adresse eingeben.');
      return;
    }

    clearFormError();
    setPhase('submitting');
    showLoader();

    fetch(CONFIG.webhookStart, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ url: url, email: email })
    })
    .then(function (res) { return res.json(); })
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
    // Rotate loader messages
    var msgIndex = 0;
    updateLoaderStep(loaderSteps[0]);

    state.pollTimer = setInterval(function () {
      // Timeout check
      if (Date.now() - state.pollStart > CONFIG.pollTimeout) {
        clearInterval(state.pollTimer);
        showLoaderError('Die Analyse dauert länger als erwartet. Der Report wird per E-Mail zugestellt.');
        return;
      }

      // Rotate message
      msgIndex = (msgIndex + 1) % loaderSteps.length;
      updateLoaderStep(loaderSteps[msgIndex]);

      // Poll
      fetch(CONFIG.webhookStatus + '?jobId=' + encodeURIComponent(state.jobId))
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (data.status === 'done' && data.data) {
            clearInterval(state.pollTimer);
            setPhase('rendering');
            renderResults(data.data);
          } else if (data.status === 'error' || data.status === 'expired') {
            clearInterval(state.pollTimer);
            showLoaderError(data.error || 'Fehler bei der Analyse.');
          }
          // status === 'processing' → keep polling
        })
        .catch(function () {
          // Network error → keep trying (don't stop polling)
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

    // Progress bar
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
    // Hide loader, show results
    var loader = document.getElementById('audit-loader');
    var results = document.getElementById('audit-results');
    if (loader) loader.style.display = 'none';

    if (!results) return;
    results.style.display = 'block';

    // Build all result HTML
    var html = '';

    // ── Result Header
    html += renderResultHeader(data);

    // ── Score Overview (big numbers)
    html += renderScoreOverview(data);

    // ── Journey Steps (Timeline)
    html += renderJourneySteps(data);

    // ── Revenue Gap
    html += renderRevenueGap(data);

    // ── Strategische Einordnung (Story)
    html += renderStory(data);

    // ── CTA
    html += renderCTA(data);

    results.innerHTML = html;

    // Trigger animations
    setTimeout(function () {
      results.classList.add('is-visible');
      staggerReveal(results.querySelectorAll('.result-animate'));
    }, 100);

    // Scroll to results
    results.scrollIntoView({ behavior: 'smooth', block: 'start' });

    // Update nav
    updateNavForResults();

    setPhase('done');
  }

  // ── Result Header
  function renderResultHeader(data) {
    var m = data.meta || {};
    return (
      '<div class="result-header result-animate">' +
        '<div class="result-pill">Customer Journey Audit</div>' +
        '<h2 class="result-title">Die Reise Ihres nächsten Kunden</h2>' +
        '<div class="result-meta">' +
          '<span class="result-domain">' + escapeHtml(m.domain || '') + '</span>' +
          (m.branche ? ' · ' + escapeHtml(m.branche) : '') +
          (m.standort ? ' · ' + escapeHtml(m.standort) : '') +
        '</div>' +
      '</div>'
    );
  }

  // ── Score Overview (3 big score cards)
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

  // ── Journey Steps
  function renderJourneySteps(data) {
    var steps = data.journeySteps || [];
    if (!steps.length) return '';

    var html = '<div class="result-journey result-animate">';
    html += '<h3 class="result-section-title">Die 4 Schritte Ihrer Customer Journey</h3>';

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

    // Step header
    html += '<div class="result-step-head">';
    html += '<span class="result-step-nr">' + step.nr + '</span>';
    html += '<span class="result-step-icon">' + icon + '</span>';
    html += '<span class="result-step-title">' + escapeHtml(step.title) + '</span>';
    html += '<span class="result-step-badge result-badge-' + statusClass + '">' + statusLabel(statusClass) + '</span>';
    html += '</div>';

    // Step body
    html += '<div class="result-step-body">';

    // SERP results (Step 1)
    if (step.nr === 1 && step.results) {
      html += '<div class="serp-table">';
      for (var r = 0; r < step.results.length; r++) {
        html += renderSerpRow(step.results[r]);
      }
      html += '</div>';
    }

    // Detail items (Steps 2-4)
    if (step.details) {
      for (var d = 0; d < step.details.length; d++) {
        html += renderDetailRow(step.details[d]);
      }
    }

    // Summary
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

    // Competitors
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

  // ── CTA
  function renderCTA(data) {
    var cta = data.cta || {};
    var rev = data.revenue || {};
    var serp = data.serpResults || [];

    var notFound = serp.filter(function (r) { return r.status === 'not_found'; });
    var topKw = notFound.length > 0 ? notFound[0].keyword : '';

    var line1 = rev.lostRevenueYear > 50000
      ? '~' + formatEuro(rev.lostRevenueYear) + ' Jahrespotenzial liegen auf dem Tisch.'
      : 'Jeden Monat gehen Ihnen planbare Anfragen verloren.';

    var line2 = topKw
      ? 'Allein für „' + escapeHtml(topKw) + '" suchen potenzielle Kunden aktiv — und finden Ihre Wettbewerber.'
      : 'Ihre Wettbewerber sind dort sichtbar, wo Ihre Kunden suchen.';

    return (
      '<div class="result-cta result-animate">' +
        '<h3>' + escapeHtml(line1) + '</h3>' +
        '<p>' + escapeHtml(line2) + '</p>' +
        '<a href="' + (cta.url || 'https://cal.com/hasim/30min') + '" class="cta-btn result-cta-btn" target="_blank" rel="noopener">' +
          (cta.label || 'Kostenloser Strategiecall') +
        '</a>' +
        '<span class="result-cta-sub">' + (cta.sublabel || '30 Min · Ihre Daten, Ihr Plan, Ihre Entscheidung') + '</span>' +
      '</div>'
    );
  }

  // ─── HELPERS ─────────────────────────────────────────────
  function formatEuro(n) {
    if (!n) return '0 €';
    return n.toLocaleString('de-DE') + ' €';
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
    // Update nav to highlight results section
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