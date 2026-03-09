(function () {
    function initContactForm() {
        var form = document.querySelector('[data-contact-form]');

        if (!form || typeof window.fetch !== 'function') {
            return;
        }

        var feedback = form.querySelector('[data-contact-feedback]');
        var submitButton = form.querySelector('button[type="submit"]');
        var defaultLabel = submitButton ? submitButton.textContent : '';
        var endpoint = window.NexusContactConfig && window.NexusContactConfig.restEndpoint;

        if (!endpoint) {
            return;
        }

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
            submitButton.textContent = isPending ? 'Wird gesendet …' : defaultLabel;
        }

        function getPayload() {
            var formData = new window.FormData(form);
            var payload = {};

            formData.forEach(function (value, key) {
                payload[key] = typeof value === 'string' ? value.trim() : value;
            });

            if (!payload.focus) {
                payload.focus = 'other';
            }

            return payload;
        }

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
                            : (window.NexusContactConfig && window.NexusContactConfig.errorMessage) || 'Die Nachricht konnte gerade nicht gesendet werden.';

                        throw new Error(errorMessage);
                    }

                    form.reset();
                    var successMessage = result.data.message
                        || (window.NexusContactConfig && window.NexusContactConfig.successMessage)
                        || 'Danke. Ihre Nachricht ist eingegangen.';

                    setFeedback(successMessage, 'success');
                })
                .catch(function (error) {
                    setFeedback(error && error.message ? error.message : 'Die Nachricht konnte gerade nicht gesendet werden.', 'error');
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
