(function () {
    function initContactForm() {
        var form = document.querySelector('[data-contact-form]');

        if (!form || typeof window.fetch !== 'function') {
            return;
        }

        var feedback = form.querySelector('[data-contact-feedback]');
        var submitButton = form.querySelector('[data-contact-submit]');
        var endpoint = window.NexusContactConfig && window.NexusContactConfig.restEndpoint;
        var isProjectLanding = window.NexusContactConfig && window.NexusContactConfig.isProjectLanding;
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
        var errorSummary = document.querySelector('[data-contact-error-summary]');
        var errorList = document.querySelector('[data-contact-error-list]');
        var intentFieldset = form.querySelector('[data-contact-intent]');
        var typeStatusBar = document.querySelector('[data-contact-type-status]');
        var typeExpandBtn = document.querySelector('[data-contact-type-expand]');
        var currentSubmitLabel = submitButton ? submitButton.textContent : '';

        if (!endpoint) {
            return;
        }

        // ── Attribution: direct URL param capture (no sessionStorage) ──
        var urlParams = new URLSearchParams(window.location.search);
        var paramMap = {
            'utm_source': 'ads_source',
            'ads_source': 'ads_source',
            'keyword': 'ads_keyword',
            'ads_keyword': 'ads_keyword',
            'utm_medium': 'utm_medium',
            'utm_campaign': 'utm_campaign',
            'gclid': 'gclid',
            'matchtype': 'matchtype'
        };

        Object.keys(paramMap).forEach(function (urlKey) {
            var val = urlParams.get(urlKey);
            if (val) {
                var field = form.querySelector('#' + paramMap[urlKey]);
                if (field) {
                    field.value = val;
                }
            }
        });

        // ── Auto-scroll to form when type/focus is in URL ──
        if (document.querySelector('[data-contact-autoscroll]')) {
            var formPanel = document.getElementById('kontakt-form');
            if (formPanel) {
                requestAnimationFrame(function () {
                    formPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }
        }

        // ── Type status bar toggle (project landing) ──
        if (typeExpandBtn && intentFieldset) {
            typeExpandBtn.addEventListener('click', function () {
                var isCollapsed = intentFieldset.classList.contains('contact-intent--collapsed');
                intentFieldset.classList.toggle('contact-intent--collapsed', !isCollapsed);
                typeExpandBtn.setAttribute('aria-expanded', isCollapsed ? 'true' : 'false');

                if (isCollapsed && typeStatusBar) {
                    typeStatusBar.classList.add('is-hidden');
                }
            });
        }

        // ── Type content definitions ──
        var typeContent = {
            project: {
                focusLabel: 'Wobei benötigen Sie Unterstützung?',
                focusHelp: 'Wählen Sie den Hebel, der fachlich am nächsten an Ihrem Anliegen liegt.',
                messageLabel: 'Kurzbeschreibung',
                messageHelp: 'Was ist das Ziel? Was ist die aktuelle Hürde? Welches Ergebnis wünschen Sie sich?',
                messagePlaceholder: '1. Ziel: Was soll erreicht werden?\n2. Hürde: Was steht aktuell im Weg?\n3. Ergebnis: Was soll sich konkret verbessern?',
                submitLabel: 'Unverbindlich Projekt anfragen',
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

        // ── Field-level error helpers ──
        var fieldErrorMap = {
            request_type: { label: 'Anfragetyp', errorId: null },
            focus: { label: 'Thema', errorId: 'contact-focus-error' },
            message: { label: 'Nachricht', errorId: 'contact-message-error' },
            name: { label: 'Name', errorId: 'contact-name-error' },
            email: { label: 'E-Mail', errorId: 'contact-email-error' },
            consent: { label: 'Datenschutz', errorId: 'contact-consent-error' }
        };

        function clearFieldErrors() {
            var errorEls = form.querySelectorAll('.contact-field__error');
            Array.prototype.forEach.call(errorEls, function (el) {
                el.textContent = '';
                el.classList.add('is-hidden');
            });

            var invalidEls = form.querySelectorAll('[aria-invalid]');
            Array.prototype.forEach.call(invalidEls, function (el) {
                el.removeAttribute('aria-invalid');
            });

            if (errorSummary) {
                errorSummary.classList.add('is-hidden');
            }
            if (errorList) {
                errorList.innerHTML = '';
            }
        }

        function setFieldError(fieldName, message) {
            var meta = fieldErrorMap[fieldName];
            if (!meta) {
                return;
            }

            var errorEl = meta.errorId ? document.getElementById(meta.errorId) : null;
            if (errorEl) {
                errorEl.textContent = message;
                errorEl.classList.remove('is-hidden');
            }

            // Set aria-invalid on the control
            var control = null;
            if (fieldName === 'request_type') {
                control = form.querySelector('[data-contact-type-input]');
            } else if (fieldName === 'consent') {
                control = form.querySelector('input[name="consent"]');
            } else {
                control = form.querySelector('[name="' + fieldName + '"]');
            }

            if (control) {
                control.setAttribute('aria-invalid', 'true');
            }

            return control;
        }

        function showErrorSummary(errors) {
            if (!errorSummary || !errorList || !errors.length) {
                return;
            }

            errorList.innerHTML = '';
            errors.forEach(function (err) {
                var li = document.createElement('li');
                var controlId = null;
                if (err.field === 'request_type') {
                    controlId = form.querySelector('[data-contact-type-input]') ? form.querySelector('[data-contact-type-input]').id : null;
                } else if (err.field === 'consent') {
                    controlId = null;
                } else {
                    var ctrl = form.querySelector('[name="' + err.field + '"]');
                    controlId = ctrl ? ctrl.id : null;
                }

                if (controlId) {
                    var link = document.createElement('a');
                    link.href = '#' + controlId;
                    link.textContent = err.message;
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        var target = document.getElementById(controlId);
                        if (target) {
                            target.focus();
                            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                    li.appendChild(link);
                } else {
                    li.textContent = err.message;
                }

                errorList.appendChild(li);
            });

            errorSummary.classList.remove('is-hidden');
            errorSummary.scrollIntoView({ behavior: 'smooth', block: 'center' });
            errorSummary.focus();
        }

        function validateForm() {
            clearFieldErrors();
            var errors = [];
            var firstInvalid = null;

            // request_type
            var hasType = false;
            Array.prototype.forEach.call(typeInputs, function (input) {
                if (input.checked) hasType = true;
            });
            if (!hasType) {
                var ctrl = setFieldError('request_type', 'Bitte auswählen, worum es geht.');
                errors.push({ field: 'request_type', message: 'Bitte auswählen, worum es geht.' });
                if (!firstInvalid) firstInvalid = ctrl;
            }

            // focus
            if (focusSelect && !focusSelect.value) {
                var ctrl = setFieldError('focus', 'Bitte ein passendes Thema auswählen.');
                errors.push({ field: 'focus', message: 'Bitte ein passendes Thema auswählen.' });
                if (!firstInvalid) firstInvalid = ctrl || focusSelect;
            }

            // message
            var messageMinlen = 24;
            var content = typeContent[getSelectedType()];
            if (content) messageMinlen = content.messageMinlength;
            var msgVal = messageField ? messageField.value.trim() : '';
            if (!msgVal || msgVal.length < messageMinlen) {
                var ctrl = setFieldError('message', 'Bitte Ihr Anliegen kurz und konkret beschreiben (mind. ' + messageMinlen + ' Zeichen).');
                errors.push({ field: 'message', message: 'Bitte Ihr Anliegen kurz beschreiben.' });
                if (!firstInvalid) firstInvalid = ctrl || messageField;
            }

            // name
            var nameField = form.querySelector('[name="name"]');
            if (nameField && !nameField.value.trim()) {
                var ctrl = setFieldError('name', 'Bitte Ihren Namen angeben.');
                errors.push({ field: 'name', message: 'Bitte Ihren Namen angeben.' });
                if (!firstInvalid) firstInvalid = ctrl || nameField;
            }

            // email
            var emailField = form.querySelector('[name="email"]');
            var emailVal = emailField ? emailField.value.trim() : '';
            if (!emailVal || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
                var ctrl = setFieldError('email', 'Bitte eine gültige E-Mail-Adresse angeben.');
                errors.push({ field: 'email', message: 'Bitte eine gültige E-Mail-Adresse angeben.' });
                if (!firstInvalid) firstInvalid = ctrl || emailField;
            }

            // consent
            var consentInput = form.querySelector('input[name="consent"]');
            if (consentInput && !consentInput.checked) {
                var ctrl = setFieldError('consent', 'Bitte der Verarbeitung Ihrer Nachricht zustimmen.');
                errors.push({ field: 'consent', message: 'Bitte der Verarbeitung zustimmen.' });
                if (!firstInvalid) firstInvalid = ctrl || consentInput;
            }

            if (errors.length > 0) {
                showErrorSummary(errors);
                if (firstInvalid && firstInvalid.focus) {
                    firstInvalid.focus();
                }
                return false;
            }

            return true;
        }

        function setFeedback(message, type) {
            if (!feedback) {
                return;
            }

            feedback.textContent = '';
            feedback.classList.remove('is-error', 'is-success');

            if (message && type === 'success') {
                // Rich success message
                feedback.innerHTML = '';
                var strong = document.createElement('strong');
                strong.textContent = message;
                feedback.appendChild(strong);

                var nextStep = document.createElement('span');
                nextStep.className = 'contact-form__feedback-next';
                nextStep.textContent = 'Nächster Schritt: Prüfen Sie Ihr Postfach für die Bestätigung.';
                feedback.appendChild(nextStep);

                feedback.classList.add('is-success');
                feedback.setAttribute('tabindex', '-1');
                feedback.focus();
            } else if (message) {
                feedback.textContent = message;
                if (type) {
                    feedback.classList.add(type === 'error' ? 'is-error' : 'is-success');
                }
            }
        }

        function setPending(isPending) {
            if (!submitButton) {
                return;
            }

            submitButton.disabled = isPending;
            submitButton.textContent = isPending ? 'Ihre Anfrage wird übermittelt …' : currentSubmitLabel;
            form.setAttribute('aria-busy', isPending ? 'true' : 'false');
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

            field.classList.toggle('is-hidden', !shouldShow);

            var control = field.querySelector('input, select, textarea');
            if (!control) {
                return;
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
                timelineLabel.textContent = content.timelineLabel + ' ';
                var span = document.createElement('span');
                span.textContent = 'optional';
                timelineLabel.appendChild(span);
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

            // Update type status bar if present
            if (typeStatusBar) {
                var typeLabel = typeContent[requestType] ? typeContent[requestType].submitLabel : '';
                var statusValue = typeStatusBar.querySelector('.contact-type-status__value');
                if (statusValue) {
                    var labels = { project: 'Projektanfrage', general: 'Allgemeine Anfrage', client: 'Bestehender Kunde' };
                    statusValue.textContent = labels[requestType] || 'Projektanfrage';
                }
            }
        }

        Array.prototype.forEach.call(typeInputs, function (input) {
            input.addEventListener('change', syncFormExperience);
        });

        syncFormExperience();

        // ── Submit handler ──
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            clearFieldErrors();
            setFeedback('', '');

            if (!validateForm()) {
                return;
            }

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

                        // Try to map server-side field errors
                        if (result.data && result.data.error_code) {
                            var codeFieldMap = {
                                'missing_name': 'name',
                                'invalid_email': 'email',
                                'missing_request_type': 'request_type',
                                'missing_focus': 'focus',
                                'invalid_focus_type': 'focus',
                                'missing_timeline': 'timeline',
                                'invalid_budget': 'budget',
                                'message_too_short': 'message',
                                'missing_consent': 'consent'
                            };
                            var fieldName = codeFieldMap[result.data.error_code];
                            if (fieldName) {
                                setFieldError(fieldName, errorMessage);
                            }
                        }

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

        // Clear field errors on input
        form.addEventListener('input', function (e) {
            var fieldWrap = e.target.closest('[data-contact-field]');
            if (!fieldWrap) return;
            var errorEl = fieldWrap.querySelector('.contact-field__error');
            if (errorEl) {
                errorEl.textContent = '';
                errorEl.classList.add('is-hidden');
            }
            e.target.removeAttribute('aria-invalid');
        });

        form.addEventListener('change', function (e) {
            if (e.target.name === 'consent') {
                var errorEl = document.getElementById('contact-consent-error');
                if (errorEl) {
                    errorEl.textContent = '';
                    errorEl.classList.add('is-hidden');
                }
                e.target.removeAttribute('aria-invalid');
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initContactForm);
    } else {
        initContactForm();
    }
})();
