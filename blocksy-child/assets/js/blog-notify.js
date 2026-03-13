(function () {
    function initBlogNotifyForms() {
        var forms = document.querySelectorAll('[data-blog-notify-form]');
        var config = window.NexusBlogNotifyConfig || {};
        var endpoint = config.restEndpoint;

        if (!forms.length || !endpoint || typeof window.fetch !== 'function') {
            return;
        }

        function setFeedback(form, message, type) {
            var feedback = form.querySelector('[data-blog-notify-feedback]');

            if (!feedback) {
                return;
            }

            feedback.textContent = message || '';
            feedback.classList.remove('is-error', 'is-success');

            if (type) {
                feedback.classList.add(type === 'error' ? 'is-error' : 'is-success');
            }
        }

        function setPending(form, isPending) {
            var button = form.querySelector('button[type="submit"]');

            if (!button) {
                return;
            }

            if (!button.hasAttribute('data-default-label')) {
                button.setAttribute('data-default-label', button.textContent || '');
            }

            button.disabled = isPending;
            button.textContent = isPending ? 'Wird gesendet ...' : button.getAttribute('data-default-label');
        }

        function serializeForm(form) {
            var data = new window.FormData(form);
            var payload = {};

            data.forEach(function (value, key) {
                payload[key] = typeof value === 'string' ? value.trim() : value;
            });

            return payload;
        }

        forms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                setFeedback(form, '', '');
                setPending(form, true);

                var payload = serializeForm(form);
                var nonce = payload.nonce || config.nonce || '';

                window.fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Nexus-Nonce': nonce
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
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
                            throw new Error((result.data && result.data.error) || config.errorMessage || 'Das hat gerade nicht funktioniert.');
                        }

                        setFeedback(
                            form,
                            result.data.message || config.successMessage || 'Fast geschafft. Bitte bestaetigen Sie Ihre Anmeldung ueber die E-Mail in Ihrem Postfach.',
                            'success'
                        );

                        form.reset();

                        var nonceInput = form.querySelector('input[name="nonce"]');
                        if (nonceInput && nonce) {
                            nonceInput.value = nonce;
                        }
                    })
                    .catch(function (error) {
                        setFeedback(
                            form,
                            error && error.message ? error.message : (config.errorMessage || 'Das hat gerade nicht funktioniert.'),
                            'error'
                        );
                    })
                    .finally(function () {
                        setPending(form, false);
                    });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBlogNotifyForms);
    } else {
        initBlogNotifyForms();
    }
})();
