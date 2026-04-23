/**
 * LinkedIn Audit Landing Page — Form Handling
 *
 * Lean single-step form that submits to the existing nexus/v1/audit-request
 * endpoint. Reuses the same CRM pipeline as the main System-Diagnose funnel.
 *
 * @package Blocksy_Child
 */
(function () {
	'use strict';

	var config = window.NexusAuditLinkedInConfig || {};
	var form = document.getElementById('ali-audit-form');
	var successEl = document.getElementById('ali-form-success');

	if (!form || !config.restEndpoint) {
		return;
	}

	/* ── UTM / session tracking ─────────────────────────────────── */

	function getSessionParam(key) {
		try {
			return sessionStorage.getItem(key) || '';
		} catch (e) {
			return '';
		}
	}

	function getTrackingFields() {
		return {
			utm_source: getSessionParam('utm_source') || 'linkedin',
			utm_medium: getSessionParam('utm_medium') || 'social',
			utm_campaign: getSessionParam('utm_campaign') || 'audit-linkedin',
			utm_content: getSessionParam('utm_content') || '',
		};
	}

	/* ── DataLayer helper ───────────────────────────────────────── */

	function pushEvent(eventName, extra) {
		if (typeof window.dataLayer === 'undefined') {
			return;
		}
		var data = { event: eventName };
		if (extra && typeof extra === 'object') {
			for (var k in extra) {
				if (extra.hasOwnProperty(k)) {
					data[k] = extra[k];
				}
			}
		}
		window.dataLayer.push(data);
	}

	/* ── Validation ─────────────────────────────────────────────── */

	var validators = {
		name: function (v) {
			return v.trim() ? '' : 'Bitte deinen Namen angeben.';
		},
		email: function (v) {
			if (!v.trim()) return 'Bitte eine E-Mail-Adresse angeben.';
			if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())) return 'Bitte eine gültige E-Mail-Adresse angeben.';
			return '';
		},
		page_url: function (v) {
			if (!v.trim()) return 'Bitte die URL deiner Website angeben.';
			return '';
		},
		consent_privacy: function () {
			var cb = form.querySelector('[name="consent_privacy"]');
			return cb && cb.checked ? '' : 'Bitte der Datenschutzerklärung zustimmen.';
		},
	};

	function showFieldError(name, message) {
		var field = form.querySelector('[name="' + name + '"]');
		if (!field) return;

		var wrapper = field.closest('.ali-form__field');
		if (!wrapper) return;

		var errorEl = wrapper.querySelector('.ali-form__error');

		if (message) {
			field.classList.add('is-invalid');
			if (errorEl) errorEl.textContent = message;
		} else {
			field.classList.remove('is-invalid');
			if (errorEl) errorEl.textContent = '';
		}
	}

	function clearAllErrors() {
		var invalids = form.querySelectorAll('.is-invalid');
		for (var i = 0; i < invalids.length; i++) {
			invalids[i].classList.remove('is-invalid');
		}
		var errors = form.querySelectorAll('.ali-form__error');
		for (var j = 0; j < errors.length; j++) {
			errors[j].textContent = '';
		}
	}

	function validateAll() {
		var firstInvalid = null;
		var isValid = true;

		for (var fieldName in validators) {
			if (!validators.hasOwnProperty(fieldName)) continue;

			var input = form.querySelector('[name="' + fieldName + '"]');
			var value = input ? (input.type === 'checkbox' ? '' : input.value) : '';
			var error = validators[fieldName](value);

			showFieldError(fieldName, error);

			if (error) {
				isValid = false;
				if (!firstInvalid && input) {
					firstInvalid = input;
				}
			}
		}

		if (firstInvalid) {
			firstInvalid.focus();
		}

		return isValid;
	}

	/* ── URL normalisation ──────────────────────────────────────── */

	function normalizeUrl(raw) {
		var url = raw.trim();
		if (!url) return '';
		if (!/^https?:\/\//i.test(url)) {
			url = 'https://' + url;
		}
		return url;
	}

	/* ── Submit ─────────────────────────────────────────────────── */

	var isSubmitting = false;

	form.addEventListener('submit', function (e) {
		e.preventDefault();

		if (isSubmitting) return;

		clearAllErrors();

		if (!validateAll()) {
			pushEvent('audit_linkedin_form_validation_error');
			return;
		}

		isSubmitting = true;
		var submitBtn = form.querySelector('[type="submit"]');
		if (submitBtn) {
			submitBtn.disabled = true;
			submitBtn.classList.add('ali-btn--loading');
		}

		pushEvent('audit_linkedin_form_submit_started');

		var tracking = getTrackingFields();
		var payload = {
			name: form.querySelector('[name="name"]').value.trim(),
			email: form.querySelector('[name="email"]').value.trim(),
			page_url: normalizeUrl(form.querySelector('[name="page_url"]').value),
			current_challenge: (form.querySelector('[name="current_challenge"]').value || '').trim(),
			consent_privacy: 'accepted',
			audit_type: 'growth_audit',
			focus_area: form.querySelector('[name="focus_area"]').value || 'not_sure_yet',
			primary_goal: form.querySelector('[name="primary_goal"]').value || 'more_qualified_inquiries',
			company_website: form.querySelector('[name="company_website"]').value || '',
			source: 'linkedin',
			campaign: 'audit-linkedin',
			utm_source: tracking.utm_source,
			utm_medium: tracking.utm_medium,
			utm_campaign: tracking.utm_campaign,
			utm_content: tracking.utm_content,
		};

		fetch(config.restEndpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(payload),
		})
			.then(function (response) {
				return response.json().then(function (data) {
					return { status: response.status, data: data };
				});
			})
			.then(function (result) {
				if (result.data && result.data.ok) {
					form.style.display = 'none';
					if (successEl) {
						successEl.hidden = false;
					}

					pushEvent('audit_linkedin_form_submit_success', {
						audit_source: 'linkedin',
					});
				} else {
					var errorMsg = (result.data && result.data.error) || config.errorMessage || 'Ein Fehler ist aufgetreten. Bitte versuche es erneut.';
					showGlobalError(errorMsg);

					pushEvent('audit_linkedin_form_submit_failed', {
						audit_error: errorMsg,
					});
				}
			})
			.catch(function () {
				showGlobalError(config.errorMessage || 'Verbindungsfehler. Bitte versuche es gleich noch einmal.');
				pushEvent('audit_linkedin_form_submit_failed', {
					audit_error: 'network_error',
				});
			})
			.finally(function () {
				isSubmitting = false;
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.classList.remove('ali-btn--loading');
				}
			});
	});

	function showGlobalError(message) {
		var existing = form.querySelector('.ali-form__global-error');
		if (existing) {
			existing.textContent = message;
			return;
		}

		var el = document.createElement('div');
		el.className = 'ali-form__global-error';
		el.setAttribute('role', 'alert');
		el.style.cssText = 'padding: 0.75rem 1rem; border-radius: 8px; background: hsl(0 65% 55% / 0.1); border: 1px solid hsl(0 65% 55% / 0.25); color: hsl(0 65% 60%); font-size: 0.875rem; margin-top: 0.5rem;';
		el.textContent = message;

		var submitWrap = form.querySelector('.ali-form__submit-wrap');
		if (submitWrap) {
			submitWrap.after(el);
		} else {
			form.appendChild(el);
		}
	}

	/* ── Live validation on blur ────────────────────────────────── */

	var fieldNames = ['name', 'email', 'page_url'];
	fieldNames.forEach(function (fieldName) {
		var input = form.querySelector('[name="' + fieldName + '"]');
		if (!input) return;

		input.addEventListener('blur', function () {
			if (!input.value.trim()) return;
			var error = validators[fieldName] ? validators[fieldName](input.value) : '';
			showFieldError(fieldName, error);
		});

		input.addEventListener('input', function () {
			if (input.classList.contains('is-invalid')) {
				var error = validators[fieldName] ? validators[fieldName](input.value) : '';
				showFieldError(fieldName, error);
			}
		});
	});

	/* ── Track page view ────────────────────────────────────────── */

	pushEvent('audit_linkedin_page_view', {
		audit_source: 'linkedin',
	});
})();
