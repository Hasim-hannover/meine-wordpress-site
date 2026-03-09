/**
 * Growth-Audit-Funnel
 *
 * Multi-step intake form that stores requests directly in WordPress.
 */
(function () {
  'use strict';

  var config = window.NexusReviewConfig || {};
  var auditLabel = config.auditLabel || 'Growth Audit';
  var state = {
    stepIndex: 0,
    steps: [],
    submitting: false,
    lastTrackedStepIndex: null
  };

  function init() {
    var form = document.getElementById('review-request-form');
    if (!form) return;

    state.steps = Array.prototype.slice.call(form.querySelectorAll('.review-step'));
    if (!state.steps.length) return;

    form.classList.add('review-funnel--js');

    var startedField = form.querySelector('[name="started_at"]');
    if (startedField) {
      startedField.value = String(Date.now());
    }

    var urlInput = form.querySelector('[name="page_url"]');
    if (urlInput) {
      urlInput.addEventListener('blur', function () {
        var value = this.value.trim();
        if (value && !/^https?:\/\//i.test(value)) {
          this.value = 'https://' + value;
        }
      });
    }

    form.addEventListener('click', handleClick);
    form.addEventListener('submit', handleSubmit);
    form.addEventListener('input', handleFieldChange);
    form.addEventListener('change', handleFieldChange);

    updateStepUi();
    syncSummary(form);
  }

  function getStepLabel(index) {
    var form = document.getElementById('review-request-form');
    if (!form) return String(index + 1);

    var labels = form.querySelectorAll('.review-progress-steps li');
    var label = labels[index];

    return label ? label.textContent.trim() : String(index + 1);
  }

  function getDomainFromUrl(url) {
    if (!url) return '';

    try {
      return new URL(url).hostname || '';
    } catch (error) {
      return '';
    }
  }

  function pushDataLayerEvent(payload) {
    if (typeof window === 'undefined' || !window.dataLayer || typeof window.dataLayer.push !== 'function') {
      return;
    }

    window.dataLayer.push(payload);
  }

  function trackStepView() {
    if (state.lastTrackedStepIndex === state.stepIndex) {
      return;
    }

    state.lastTrackedStepIndex = state.stepIndex;

    pushDataLayerEvent({
      event: 'review_step_view',
      review_step_index: state.stepIndex + 1,
      review_step_name: getStepLabel(state.stepIndex)
    });
  }

  function trackStepNavigation(direction, fromIndex, toIndex) {
    pushDataLayerEvent({
      event: 'review_step_navigation',
      review_step_direction: direction,
      review_step_from: fromIndex + 1,
      review_step_to: toIndex + 1,
      review_step_name: getStepLabel(toIndex)
    });
  }

  function trackValidationError(message, fieldName) {
    pushDataLayerEvent({
      event: 'review_validation_error',
      review_step_index: state.stepIndex + 1,
      review_step_name: getStepLabel(state.stepIndex),
      review_field: fieldName || '',
      review_message: message || ''
    });
  }

  function handleClick(event) {
    var nextButton = event.target.closest('[data-review-next]');
    var prevButton = event.target.closest('[data-review-prev]');

    if (nextButton) {
      event.preventDefault();
      goToNextStep();
      return;
    }

    if (prevButton) {
      event.preventDefault();
      goToPrevStep();
    }
  }

  function handleFieldChange(event) {
    var form = document.getElementById('review-request-form');
    if (!form) return;

    syncSummary(form);

    var field = event.target;
    if (!field || field.type !== 'radio' || field.name !== 'biggest_issue') {
      return;
    }

    if (state.stepIndex === state.steps.length - 1) {
      return;
    }

    window.setTimeout(function () {
      if (state.stepIndex === 3) {
        goToNextStep();
      }
    }, 160);
  }

  function goToNextStep() {
    if (!validateCurrentStep()) {
      return;
    }

    if (state.stepIndex < state.steps.length - 1) {
      var previousIndex = state.stepIndex;
      state.stepIndex += 1;
      updateStepUi();
      trackStepNavigation('next', previousIndex, state.stepIndex);
    }
  }

  function goToPrevStep() {
    clearFeedback();

    if (state.stepIndex > 0) {
      var previousIndex = state.stepIndex;
      state.stepIndex -= 1;
      updateStepUi();
      trackStepNavigation('prev', previousIndex, state.stepIndex);
    }
  }

  function handleSubmit(event) {
    event.preventDefault();

    if (state.submitting) {
      return;
    }

    if (!validateCurrentStep()) {
      return;
    }

    submitRequest(event.target);
  }

  function submitRequest(form) {
    var submitButton = form.querySelector('[data-review-submit]');
    var payload = serializeForm(form);

    if (!payload.page_url) {
      var urlError = 'Bitte zuerst eine gültige URL angeben.';

      showFeedback(urlError, 'error');
      trackValidationError(urlError, 'page_url');
      state.stepIndex = 0;
      updateStepUi();
      return;
    }

    state.submitting = true;
    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = 'Wird gesendet ...';
    }

    clearFeedback();

    pushDataLayerEvent({
      event: 'review_request_submit_started',
      review_step_index: state.stepIndex + 1,
      review_step_name: getStepLabel(state.stepIndex),
      review_domain: getDomainFromUrl(payload.page_url)
    });

    fetch(config.restEndpoint || '/wp-json/nexus/v1/audit-request', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(payload)
    })
      .then(function (response) {
        return response.text().then(function (text) {
          var data = {};

          try {
            data = text ? JSON.parse(text) : {};
          } catch (error) {
            throw new Error('Die Anfrage konnte nicht verarbeitet werden. Bitte später erneut versuchen.');
          }

          if (!response.ok || !data.ok) {
            throw new Error(data.error || 'Die Anfrage konnte nicht gespeichert werden.');
          }

          return data;
        });
      })
      .then(function (data) {
        renderSuccess(payload, data);
      })
      .catch(function (error) {
        var message = error.message || 'Die Anfrage konnte nicht gesendet werden.';

        showFeedback(message, 'error');
        pushDataLayerEvent({
          event: 'review_request_submit_failed',
          review_step_index: state.stepIndex + 1,
          review_step_name: getStepLabel(state.stepIndex),
          review_domain: getDomainFromUrl(payload.page_url),
          review_message: message
        });
      })
      .finally(function () {
        state.submitting = false;
        if (submitButton) {
          submitButton.disabled = false;
          submitButton.textContent = auditLabel + ' anfordern';
        }
      });
  }

  function validateCurrentStep() {
    var currentStep = state.steps[state.stepIndex];
    if (!currentStep) {
      return true;
    }

    clearFeedback();

    var radios = currentStep.querySelectorAll('input[type="radio"][name="biggest_issue"]');
    if (radios.length) {
      var isRadioChecked = Array.prototype.some.call(radios, function (radio) {
        return radio.checked;
      });

      if (!isRadioChecked) {
        var radioMessage = 'Bitte den größten Blocker auswählen.';

        showFeedback(radioMessage, 'error');
        trackValidationError(radioMessage, 'biggest_issue');
        return false;
      }
    }

    var fields = currentStep.querySelectorAll('input, textarea, select');
    for (var i = 0; i < fields.length; i += 1) {
      var field = fields[i];
      if (field.type === 'radio' || field.type === 'hidden') {
        continue;
      }

      if (!field.checkValidity()) {
        var validationMessage = field.validationMessage || 'Bitte das Feld korrekt ausfüllen.';

        showFeedback(validationMessage, 'error');
        trackValidationError(validationMessage, field.name || field.id || 'unknown');
        field.focus();
        return false;
      }
    }

    return true;
  }

  function updateStepUi() {
    var form = document.getElementById('review-request-form');
    if (!form) return;

    var prevButton = form.querySelector('[data-review-prev]');
    var nextButton = form.querySelector('[data-review-next]');
    var submitButton = form.querySelector('[data-review-submit]');
    var progressFill = document.getElementById('review-progress-fill');
    var progressSteps = form.querySelectorAll('.review-progress-steps li');

    state.steps.forEach(function (step, index) {
      step.classList.toggle('is-active', index === state.stepIndex);
    });

    Array.prototype.forEach.call(progressSteps, function (step, index) {
      step.classList.toggle('is-active', index <= state.stepIndex);
    });

    if (progressFill) {
      progressFill.style.width = (((state.stepIndex + 1) / state.steps.length) * 100) + '%';
    }

    if (prevButton) {
      prevButton.hidden = state.stepIndex === 0;
    }

    if (nextButton) {
      nextButton.hidden = state.stepIndex === state.steps.length - 1;
    }

    if (submitButton) {
      submitButton.hidden = state.stepIndex !== state.steps.length - 1;
    }

    trackStepView();
  }

  function renderSuccess(payload, data) {
    var form = document.getElementById('review-request-form');
    var success = document.getElementById('review-request-success');
    var successMessage = document.getElementById('review-success-message');
    var successUrl = document.getElementById('review-success-url');
    var focusTarget = success || form;

    if (successUrl) {
      successUrl.textContent = payload.page_url || 'der Seite';
    }

    if (successMessage && data && data.message) {
      successMessage.textContent = data.message;
    }

    if (form) {
      form.hidden = true;
    }

    if (success) {
      success.hidden = false;
    }

    pushDataLayerEvent({
      event: 'review_request_submit_success',
      review_request_id: data.requestId || null,
      review_domain: getDomainFromUrl(payload.page_url)
    });
    pushDataLayerEvent({
      event: 'review_request_submitted',
      review_request_id: data.requestId || null
    });

    if (focusTarget && typeof focusTarget.scrollIntoView === 'function') {
      focusTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  function serializeForm(form) {
    var formData = new FormData(form);
    var payload = {};

    formData.forEach(function (value, key) {
      payload[key] = typeof value === 'string' ? value.trim() : value;
    });

    return payload;
  }

  function showFeedback(message, type) {
    var feedback = document.getElementById('review-form-feedback');
    if (!feedback) return;

    feedback.textContent = message;
    feedback.className = 'review-form-feedback is-visible';
    feedback.classList.add(type === 'error' ? 'is-error' : 'is-success');
  }

  function clearFeedback() {
    var feedback = document.getElementById('review-form-feedback');
    if (!feedback) return;

    feedback.textContent = '';
    feedback.className = 'review-form-feedback';
  }

  function syncSummary(form) {
    var summaryFields = form.querySelectorAll('[data-review-summary]');

    Array.prototype.forEach.call(summaryFields, function (node) {
      var key = node.getAttribute('data-review-summary');
      if (!key) return;

      var value = readSummaryValue(form, key);
      node.textContent = formatSummaryValue(key, value);
    });
  }

  function readSummaryValue(form, key) {
    if (key === 'biggest_issue') {
      var selected = form.querySelector('input[name="biggest_issue"]:checked');
      if (!selected) return '';

      var option = selected.closest('.review-option');
      var label = option ? option.querySelector('span') : null;

      return label ? label.textContent.trim() : selected.value;
    }

    var field = form.querySelector('[name="' + key + '"]');
    return field && typeof field.value === 'string' ? field.value.trim() : '';
  }

  function formatSummaryValue(key, value) {
    if (!value) {
      return 'Noch offen';
    }

    if (key === 'page_url') {
      return getDomainFromUrl(value) || value;
    }

    return truncateValue(value, key === 'offer' ? 84 : 70);
  }

  function truncateValue(value, maxLength) {
    if (!value || value.length <= maxLength) {
      return value;
    }

    return value.slice(0, maxLength - 1).trim() + '…';
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
