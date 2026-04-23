/**
 * Tools page logic.
 *
 * Handles interactive calculators and simulators on the tools page.
 */
(function () {
  'use strict';

  function initToolsPage() {
    initLeadCostCalculator();
    initConversionSimulator();
    initTrackingScanner();
    initSpeedPenaltyCalculator();
  }

  function initLeadCostCalculator() {
    var portalLeads = document.getElementById('portal-leads');
    var portalCostPerLead = document.getElementById('portal-cost-per-lead');
    var organicLeads = document.getElementById('organic-leads');
    var organicCostPerLead = document.getElementById('organic-cost-per-lead');

    if (!portalLeads || !portalCostPerLead || !organicLeads || !organicCostPerLead) return;

    function calculate() {
      var portalTotal = parseFloat(portalLeads.value || 0) * parseFloat(portalCostPerLead.value || 0);
      var organicTotal = parseFloat(organicLeads.value || 0) * parseFloat(organicCostPerLead.value || 0);
      var savings = portalTotal - organicTotal;
      var costDiffPerLead = parseFloat(portalCostPerLead.value || 0) - parseFloat(organicCostPerLead.value || 0);

      document.getElementById('portal-total-cost').textContent = formatCurrency(portalTotal);
      document.getElementById('organic-total-cost').textContent = formatCurrency(organicTotal);
      document.getElementById('savings-potential').textContent = formatCurrency(savings);
      document.getElementById('cost-difference-per-lead').textContent = formatCurrency(costDiffPerLead);
    }

    [portalLeads, portalCostPerLead, organicLeads, organicCostPerLead].forEach(function (el) {
      el.addEventListener('input', calculate);
    });

    calculate();
  }

  function initConversionSimulator() {
    var monthlyVisitors = document.getElementById('monthly-visitors');
    var currentConversionRate = document.getElementById('current-conversion-rate');
    var conversionImprovement = document.getElementById('conversion-improvement');
    var conversionImprovementValue = document.getElementById('conversion-improvement-value');

    if (!monthlyVisitors || !currentConversionRate || !conversionImprovement) return;

    function calculate() {
      var visitors = parseFloat(monthlyVisitors.value || 0);
      var currentRate = parseFloat(currentConversionRate.value || 0) / 100;
      var improvement = parseFloat(conversionImprovement.value || 0) / 100;

      if (conversionImprovementValue) {
        conversionImprovementValue.textContent = (improvement * 100).toFixed(1).replace('.', ',') + '%';
      }

      var currentConversions = Math.round(visitors * currentRate);
      var improvedRate = currentRate + improvement;
      var improvedConversions = Math.round(visitors * improvedRate);
      var additionalConversions = improvedConversions - currentConversions;
      var improvementValue = additionalConversions * 10; // Annahme: 10€ pro Konversion

      document.getElementById('current-conversions').textContent = currentConversions.toLocaleString('de-DE');
      document.getElementById('improved-conversions').textContent = improvedConversions.toLocaleString('de-DE');
      document.getElementById('additional-conversions').textContent = additionalConversions.toLocaleString('de-DE');
      document.getElementById('improvement-value').textContent = formatCurrency(improvementValue);
    }

    [monthlyVisitors, currentConversionRate, conversionImprovement].forEach(function (el) {
      el.addEventListener('input', calculate);
    });

    calculate();
  }

  function initTrackingScanner() {
    var scanButton = document.getElementById('scan-button');
    var websiteUrl = document.getElementById('website-url');
    var placeholder = document.querySelector('.scan-results-placeholder');
    var content = document.querySelector('.scan-results-content');

    if (!scanButton || !websiteUrl) return;

    scanButton.addEventListener('click', function () {
      var url = websiteUrl.value.trim();
      if (!url) {
        websiteUrl.focus();
        return;
      }

      // Simuliere Scan
      scanButton.disabled = true;
      scanButton.textContent = 'Scanne...';

      setTimeout(function () {
        if (placeholder) placeholder.hidden = true;
        if (content) content.hidden = false;
        scanButton.disabled = false;
        scanButton.textContent = 'Scan starten';
      }, 1500);
    });
  }

  function initSpeedPenaltyCalculator() {
    var monthlyVisitors = document.getElementById('monthly-visitors-speed');
    var currentLoadTime = document.getElementById('current-load-time');
    var industryType = document.getElementById('industry-type');

    if (!monthlyVisitors || !currentLoadTime || !industryType) return;

    function calculate() {
      var visitors = parseFloat(monthlyVisitors.value || 0);
      var loadTime = parseFloat(currentLoadTime.value || 0);
      var industry = industryType.value;

      // Branchenspezifische Abbruchraten
      var bounceRates = {
        ecommerce: 0.3 + (loadTime - 2) * 0.1,
        b2b: 0.25 + (loadTime - 2) * 0.08,
        blog: 0.2 + (loadTime - 2) * 0.06,
        saas: 0.28 + (loadTime - 2) * 0.09
      };

      var bounceRate = Math.max(0.1, Math.min(0.9, bounceRates[industry] || 0.3));
      var lostVisitors = Math.round(visitors * bounceRate);
      var revenueLoss = lostVisitors * 10; // Annahme: 10€ pro verlorenem Besucher
      var lostLeads = Math.round(lostVisitors * 0.1); // 10% der verlorenen Besucher wären Leads geworden

      document.getElementById('bounce-rate').textContent = Math.round(bounceRate * 100) + '%';
      document.getElementById('lost-visitors').textContent = lostVisitors.toLocaleString('de-DE');
      document.getElementById('revenue-loss').textContent = formatCurrency(revenueLoss);
      document.getElementById('lost-leads').textContent = lostLeads.toLocaleString('de-DE');
    }

    [monthlyVisitors, currentLoadTime, industryType].forEach(function (el) {
      el.addEventListener('input', calculate);
      el.addEventListener('change', calculate);
    });

    calculate();
  }

  function formatCurrency(value) {
    return new Intl.NumberFormat('de-DE', {
      style: 'currency',
      currency: 'EUR',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(value);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initToolsPage);
  } else {
    initToolsPage();
  }
})();