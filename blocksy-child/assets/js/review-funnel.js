/**
 * Startseiten-Review Funnel
 *
 * Multi-step intake form that stores requests directly in WordPress.
 */
(function () {
  'use strict';

  var config = window.NexusReviewConfig || {};
  var state = {
    stepIndex: 0,
    steps: [],
    submitting: false
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

    updateStepUi();
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

  function goToNextStep() {
    if (!validateCurrentStep()) {
      return;
    }

    if (state.stepIndex < state.steps.length - 1) {
      state.stepIndex += 1;
      updateStepUi();
    }
  }

  function goToPrevStep() {
    clearFeedback();

    if (state.stepIndex > 0) {
      state.stepIndex -= 1;
      updateStepUi();
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
      showFeedback('Bitte zuerst eine gueltige URL angeben.', 'error');
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

    fetch(config.restEndpoint || '/wp-json/nexus/v1/review-request', {
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
            throw new Error('Die Anfrage konnte nicht verarbeitet werden. Bitte spaeter erneut versuchen.');
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
        showFeedback(error.message || 'Die Anfrage konnte nicht gesendet werden.', 'error');
      })
      .finally(function () {
        state.submitting = false;
        if (submitButton) {
          submitButton.disabled = false;
          submitButton.textContent = 'Review anfordern';
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
        showFeedback('Bitte den groessten Blocker auswaehlen.', 'error');
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
        showFeedback(field.validationMessage || 'Bitte das Feld korrekt ausfuellen.', 'error');
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
  }

  function renderSuccess(payload, data) {
    var form = document.getElementById('review-request-form');
    var success = document.getElementById('review-request-success');
    var successUrl = document.getElementById('review-success-url');
    var focusTarget = success || form;

    if (successUrl) {
      successUrl.textContent = payload.page_url || 'der Seite';
    }

    if (form) {
      form.hidden = true;
    }

    if (success) {
      success.hidden = false;
    }

    if (typeof window !== 'undefined' && window.dataLayer) {
      window.dataLayer.push({
        event: 'review_request_submitted',
        review_request_id: data.requestId || null
      });
    }

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

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
