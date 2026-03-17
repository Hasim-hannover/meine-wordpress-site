(function () {
    function initContactForm() {
        var form = document.querySelector('[data-contact-form]');

        if (!form || typeof window.fetch !== 'function') {
            return;
        }

        var feedback = form.querySelector('[data-contact-feedback]');
        var submitButton = form.querySelector('button[type="submit"]');
        var endpoint = window.NexusContactConfig && window.NexusContactConfig.restEndpoint;
        var typeInputs = form.querySelectorAll('[data-contact-type-input]');
        var focusSelect = form.querySelector('[data-contact-focus-select]');
        var focusLabel = form.querySelector('[data-contact-focus-label]');
        var focusHelp = form.querySelector('[data-contact-focus-help]');
        var timelineField = form.querySelector('[data-contact-context-field="timeline"]');
        var timelineSelect = form.querySelector('[data-contact-timeline-select]');
        var timelineLabel = form.querySelector('[data-contact-timeline-label]');
        var budgetField = form.querySelector('[data-contact-context-field="budget"]');
        var messageLabel = form.querySelector('[data-contact-message-label]');
        var messageHelp = form.querySelector('[data-contact-message-help]');
        var messageField = form.querySelector('[data-contact-message]');
        var currentSubmitLabel = submitButton ? submitButton.textContent : '';

        if (!endpoint) {
            return;
        }

        var urlParams = new URLSearchParams(window.location.search);
        var utmSource = urlParams.get('utm_source');
        var utmKeyword = urlParams.get('keyword');

        if (utmSource) {
            sessionStorage.setItem('ads_source', utmSource);
        }
        if (utmKeyword) {
            sessionStorage.setItem('ads_keyword', utmKeyword);
        }

        var adsSourceField = form.querySelector('#ads_source');
        var adsKeywordField = form.querySelector('#ads_keyword');

        if (adsSourceField) {
            adsSourceField.value = sessionStorage.getItem('ads_source') || '';
        }
        if (adsKeywordField) {
            adsKeywordField.value = sessionStorage.getItem('ads_keyword') || '';
        }

        var typeContent = {
            project: {
                focusLabel: 'Wobei benötigen Sie Unterstützung?',
                focusHelp: 'Wählen Sie den Hebel, der fachlich am nächsten an Ihrem Anliegen liegt.',
                messageLabel: 'Kurzbeschreibung',
                messageHelp: 'Beschreiben Sie Ziel, Hürde und das gewünschte Ergebnis.',
                messagePlaceholder: 'Worum geht es im Projekt, was ist das Ziel und was soll sich konkret verbessern?',
                submitLabel: 'Projektanfrage senden',
                messageMinlength: 24,
                timelineLabel: 'Zeitfenster',
                showTimeline: true,
                showBudget: true
            },
            general: {
                focusLabel: 'Worum geht es?',
                focusHelp: 'Wählen Sie den Bereich, damit das Anliegen direkt passend eingeordnet werden kann.',
                messageLabel: 'Ihre Frage oder Nachricht',
                messageHelp: 'Schildern Sie kurz Ihre Frage, Anfrage oder den Anlass.',
                messagePlaceholder: 'Worum geht es und welche Rückmeldung wäre hilfreich?',
                submitLabel: 'Anfrage senden',
                messageMinlength: 18,
                timelineLabel: 'Zeitfenster',
                showTimeline: false,
                showBudget: false
            },
            client: {
                focusLabel: 'Wobei kann ich unterstützen?',
                focusHelp: 'Wählen Sie den Bereich, damit Priorisierung und Rückmeldung direkt anschließen können.',
                messageLabel: 'Kurzbeschreibung',
                messageHelp: 'Beschreiben Sie kurz Status, Blocker oder die nächste Entscheidung.',
                messagePlaceholder: 'Worum geht es gerade, was blockiert und was soll als Nächstes entschieden werden?',
                submitLabel: 'Kundenanliegen senden',
                messageMinlength: 24,
                timelineLabel: 'Dringlichkeit',
                showTimeline: true,
                showBudget: false
            }
        };

        function setFeedback(message, type) {
            if (!feedback) {
                return;
            }

            feedback.textContent = message || '';
            feedback.classList.remove('is-error', 'is-success');

            if (type) {
                feedback.classList.add(type === 'error' ? 'is-error' : 'is-success');
            }
        }

        function setPending(isPending) {
            if (!submitButton) {
                return;
            }

            submitButton.disabled = isPending;
            submitButton.textContent = isPending ? 'Wird gesendet ...' : currentSubmitLabel;
        }

        function getPayload() {
            var formData = new window.FormData(form);
            var payload = {};

            formData.forEach(function (value, key) {
                payload[key] = typeof value === 'string' ? value.trim() : value;
            });

            return payload;
        }

        function getSelectedType() {
            var selected = 'project';

            Array.prototype.forEach.call(typeInputs, function (input) {
                if (input.checked) {
                    selected = input.value;
                }
            });

            return selected;
        }

        function toggleContextField(field, shouldShow) {
            if (!field) {
                return;
            }

            var control = field.querySelector('input, select, textarea');

            field.classList.toggle('is-hidden', !shouldShow);

            if (!control) {
                return;
            }

            if (control.hasAttribute('data-required-when-visible')) {
                control.required = shouldShow;
            }

            if (!shouldShow) {
                control.value = '';
            }
        }

        function syncFocusOptions(requestType) {
            if (!focusSelect) {
                return;
            }

            Array.prototype.forEach.call(focusSelect.options, function (option) {
                if (!option.value) {
                    option.hidden = false;
                    option.disabled = false;
                    return;
                }

                var types = (option.getAttribute('data-types') || '').split(',');
                var isAllowed = types.indexOf(requestType) !== -1;

                option.hidden = !isAllowed;
                option.disabled = !isAllowed;
            });

            if (focusSelect.selectedOptions.length && focusSelect.selectedOptions[0].disabled) {
                focusSelect.value = '';
            }
        }

        function syncFormExperience() {
            var requestType = getSelectedType();
            var content = typeContent[requestType] || typeContent.project;

            syncFocusOptions(requestType);
            toggleContextField(timelineField, content.showTimeline);
            toggleContextField(budgetField, content.showBudget);

            if (focusLabel) {
                focusLabel.textContent = content.focusLabel;
            }

            if (focusHelp) {
                focusHelp.textContent = content.focusHelp;
            }

            if (timelineLabel) {
                timelineLabel.textContent = content.timelineLabel;
            }

            if (messageLabel) {
                messageLabel.textContent = content.messageLabel;
            }

            if (messageHelp) {
                messageHelp.textContent = content.messageHelp;
            }

            if (messageField) {
                messageField.placeholder = content.messagePlaceholder;
                messageField.minLength = content.messageMinlength;
            }

            currentSubmitLabel = content.submitLabel;

            if (submitButton && !submitButton.disabled) {
                submitButton.textContent = currentSubmitLabel;
            }

            if (timelineSelect && !content.showTimeline) {
                timelineSelect.value = '';
            }
        }

        Array.prototype.forEach.call(typeInputs, function (input) {
            input.addEventListener('change', syncFormExperience);
        });

        syncFormExperience();

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            setFeedback('', '');
            setPending(true);

            window.fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(getPayload())
            })
                .then(function (response) {
                    return response.json().catch(function () {
                        return {};
                    }).then(function (data) {
                        return {
                            ok: response.ok,
                            data: data
                        };
                    });
                })
                .then(function (result) {
                    if (!result.ok || !result.data || result.data.ok === false) {
                        var errorMessage = result.data && result.data.error
                            ? result.data.error
                            : (window.NexusContactConfig && window.NexusContactConfig.errorMessage) || 'Die Anfrage konnte gerade nicht gesendet werden.';

                        throw new Error(errorMessage);
                    }

                    form.reset();
                    syncFormExperience();

                    var successMessage = result.data.message
                        || (window.NexusContactConfig && window.NexusContactConfig.successMessage)
                        || 'Danke. Ihre Anfrage ist eingegangen.';

                    setFeedback(successMessage, 'success');
                })
                .catch(function (error) {
                    setFeedback(error && error.message ? error.message : 'Die Anfrage konnte gerade nicht gesendet werden.', 'error');
                })
                .finally(function () {
                    setPending(false);
                });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initContactForm);
    } else {
        initContactForm();
    }
})();
