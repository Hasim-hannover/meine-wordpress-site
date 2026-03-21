<?php
/**
 * LinkedIn Audit Landing Page Shell.
 *
 * Kampagnenscharfe Conversion-Landingpage für LinkedIn-Traffic.
 * Fokussierter Microfunnel: Post → Landingpage → Audit-Anfrage.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$privacy_url = function_exists( 'nexus_get_primary_public_url' )
	? nexus_get_primary_public_url( 'datenschutz', home_url( '/datenschutz/' ) )
	: home_url( '/datenschutz/' );

$imprint_url = function_exists( 'nexus_get_primary_public_url' )
	? nexus_get_primary_public_url( 'impressum', home_url( '/impressum/' ) )
	: home_url( '/impressum/' );

$brand_text = function_exists( 'hu_get_site_wordmark_text' ) ? hu_get_site_wordmark_text() : 'HAŞIM ÜNER';
$home_label = sprintf( __( 'Startseite - %s', 'blocksy-child' ), $brand_text );
?>

<div class="ali-topbar">
	<div class="ali-container">
		<a class="ali-topbar__logo site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( $home_label ); ?>">
			<?php echo esc_html( $brand_text ); ?>
		</a>
		<div class="ali-topbar__actions">
			<?php
			if ( function_exists( 'nexus_get_theme_toggle_html' ) ) {
				echo nexus_get_theme_toggle_html( [ 'source' => 'audit-linkedin-topbar' ] );
			}
			?>
		</div>
	</div>
</div>

<main id="main" class="ali" role="main">

	<!-- ═══════════════════════════════════════════════════
	     1. HERO
	     ═══════════════════════════════════════════════════ -->
	<section class="ali-hero" aria-labelledby="ali-hero-heading">
		<div class="ali-container">
			<p class="ali-eyebrow">Audit für Websites mit Conversion-Fokus</p>

			<h1 id="ali-hero-heading" class="ali-hero__h1">
				Deine Website bekommt Besucher,<br class="ali-br-desktop"> aber zu wenig Anfragen?
			</h1>

			<p class="ali-hero__sub">
				Ich analysiere, wo Klarheit, Vertrauen und Conversion-Logik bremsen — und welche Hebel zuerst Wirkung bringen.
			</p>

			<ul class="ali-hero__bullets" role="list">
				<li>Schriftliche Ersteinschätzung</li>
				<li>Klare Prioritäten statt allgemeiner Tipps</li>
				<li>Kein Pflicht-Call</li>
			</ul>

			<div class="ali-hero__cta-wrap">
				<a href="#audit-form" class="ali-btn ali-btn--primary" data-track-action="cta_hero_audit_linkedin" data-track-category="lead_gen">
					Website für Audit einreichen
				</a>
			</div>
		</div>
	</section>

	<!-- ═══════════════════════════════════════════════════
	     2. FORMULAR
	     ═══════════════════════════════════════════════════ -->
	<section id="audit-form" class="ali-section ali-form-section" aria-labelledby="ali-form-heading">
		<div class="ali-container ali-container--narrow">
			<h2 id="ali-form-heading" class="ali-section__h2">Reich deine Website ein</h2>

			<p class="ali-form-section__intro">
				Wenn du wissen willst, warum deine Website noch unter ihrem Potenzial bleibt, reich sie hier ein.
			</p>

			<form id="ali-audit-form" class="ali-form" novalidate>
				<!-- Honeypot -->
				<div class="ali-form__hp" aria-hidden="true" tabindex="-1">
					<label for="ali-hp">Website</label>
					<input type="text" id="ali-hp" name="company_website" autocomplete="off" tabindex="-1">
				</div>

				<!-- Hidden tracking fields -->
				<input type="hidden" name="source" value="linkedin">
				<input type="hidden" name="campaign" value="audit-linkedin">
				<input type="hidden" name="audit_type" value="growth_audit">
				<input type="hidden" name="focus_area" value="not_sure_yet">
				<input type="hidden" name="primary_goal" value="more_qualified_inquiries">

				<div class="ali-form__field">
					<label for="ali-name" class="ali-form__label">Name <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
					<input type="text" id="ali-name" name="name" required autocomplete="name" class="ali-form__input" placeholder="Dein Name">
					<span class="ali-form__error" role="alert" aria-live="polite"></span>
				</div>

				<div class="ali-form__field">
					<label for="ali-email" class="ali-form__label">E-Mail <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
					<input type="email" id="ali-email" name="email" required autocomplete="email" class="ali-form__input" placeholder="deine@email.de">
					<span class="ali-form__error" role="alert" aria-live="polite"></span>
				</div>

				<div class="ali-form__field">
					<label for="ali-url" class="ali-form__label">Website-URL <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
					<input type="url" id="ali-url" name="page_url" required autocomplete="url" class="ali-form__input" placeholder="https://deine-website.de">
					<span class="ali-form__error" role="alert" aria-live="polite"></span>
				</div>

				<div class="ali-form__field">
					<label for="ali-challenge" class="ali-form__label">Was ist aktuell das größte Problem? <span class="ali-form__opt">(optional)</span></label>
					<textarea id="ali-challenge" name="current_challenge" rows="3" class="ali-form__textarea" placeholder="z. B. Wir haben Besucher, aber kaum Anfragen …"></textarea>
				</div>

				<div class="ali-form__field ali-form__consent">
					<label class="ali-form__checkbox-label">
						<input type="checkbox" name="consent_privacy" value="accepted" required class="ali-form__checkbox">
						<span>Ich stimme der <a href="<?php echo esc_url( $privacy_url ); ?>" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> zu. <span class="ali-form__req" aria-label="Pflichtfeld">*</span></span>
					</label>
					<span class="ali-form__error" role="alert" aria-live="polite"></span>
				</div>

				<div class="ali-form__submit-wrap">
					<button type="submit" class="ali-btn ali-btn--primary ali-btn--full" data-track-action="cta_form_submit_audit_linkedin" data-track-category="lead_gen">
						<span class="ali-btn__label">Audit anfragen</span>
						<span class="ali-btn__spinner" aria-hidden="true"></span>
					</button>
				</div>

				<p class="ali-form__micro">
					Kurze Prüfung. Klare Rückmeldung. Ohne Pflicht-Call.
				</p>
			</form>

			<!-- Success state -->
			<div id="ali-form-success" class="ali-form-success" hidden>
				<div class="ali-form-success__icon" aria-hidden="true">
					<svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2.5"/><path d="M15 24l6 6 12-14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</div>
				<h3 class="ali-form-success__h3">Deine Anfrage ist eingegangen.</h3>
				<p class="ali-form-success__text">Ich prüfe deine Website persönlich und melde mich innerhalb von 48 Stunden mit einer schriftlichen Ersteinschätzung.</p>
			</div>
		</div>
	</section>

	<!-- ═══════════════════════════════════════════════════
	     3. FÜR WEN / FÜR WEN NICHT
	     ═══════════════════════════════════════════════════ -->
	<section class="ali-section ali-fit" aria-labelledby="ali-fit-heading">
		<div class="ali-container">
			<h2 id="ali-fit-heading" class="ali-section__h2">Für wen dieses Audit sinnvoll ist</h2>

			<div class="ali-fit__grid">
				<div class="ali-fit__col ali-fit__col--yes">
					<p class="ali-fit__label">Passt, wenn du …</p>
					<ul class="ali-fit__list" role="list">
						<li>eine Website hast, aber zu wenig Anfragen generierst</li>
						<li>vermutest, dass Klarheit, Vertrauen oder Struktur bremsen</li>
						<li>konkrete Hebel statt allgemeiner Tipps willst</li>
						<li>deine Website wirksamer machen willst</li>
					</ul>
				</div>

				<div class="ali-fit__col ali-fit__col--no">
					<p class="ali-fit__label">Eher nicht ideal, wenn du …</p>
					<ul class="ali-fit__list" role="list">
						<li>nur kostenloses Allgemein-Feedback suchst</li>
						<li>noch keine Website oder kein klares Angebot hast</li>
						<li>nur mehr Traffic willst, ohne die Basis zu verbessern</li>
						<li>nur eine schnelle Design-Meinung suchst</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══════════════════════════════════════════════════
	     4. ABLAUF IN 3 SCHRITTEN
	     ═══════════════════════════════════════════════════ -->
	<section class="ali-section ali-steps" aria-labelledby="ali-steps-heading">
		<div class="ali-container ali-container--narrow">
			<h2 id="ali-steps-heading" class="ali-section__h2">So läuft es ab</h2>

			<ol class="ali-steps__list" role="list">
				<li class="ali-steps__item">
					<span class="ali-steps__index" aria-hidden="true">1</span>
					<div class="ali-steps__copy">
						<strong>Du reichst deine Website ein</strong>
						<span>Kurzes Formular, vier Felder, fertig.</span>
					</div>
				</li>
				<li class="ali-steps__item">
					<span class="ali-steps__index" aria-hidden="true">2</span>
					<div class="ali-steps__copy">
						<strong>Ich prüfe Struktur, Nutzerführung und Conversion-Logik</strong>
						<span>Persönlich, keine automatisierte Massenprüfung.</span>
					</div>
				</li>
				<li class="ali-steps__item">
					<span class="ali-steps__index" aria-hidden="true">3</span>
					<div class="ali-steps__copy">
						<strong>Du bekommst eine Einschätzung mit priorisierten Hebeln</strong>
						<span>Schriftlich, umsetzungsnah, innerhalb von 48h.</span>
					</div>
				</li>
			</ol>
		</div>
	</section>

	<!-- ═══════════════════════════════════════════════════
	     5. FAQ
	     ═══════════════════════════════════════════════════ -->
	<section class="ali-section ali-faq" aria-labelledby="ali-faq-heading">
		<div class="ali-container ali-container--narrow">
			<h2 id="ali-faq-heading" class="ali-section__h2">Häufige Fragen</h2>

			<div class="ali-faq__list">
				<details class="ali-faq__item">
					<summary class="ali-faq__question">Ist das Audit kostenlos?</summary>
					<div class="ali-faq__answer">
						<p>Ja. Du bekommst eine fundierte Ersteinschätzung, damit du siehst, wo die größten Hebel liegen.</p>
					</div>
				</details>

				<details class="ali-faq__item">
					<summary class="ali-faq__question">Muss ich danach einen Call buchen?</summary>
					<div class="ali-faq__answer">
						<p>Nein. Die Einschätzung kommt schriftlich, ohne Pflicht-Call.</p>
					</div>
				</details>

				<details class="ali-faq__item">
					<summary class="ali-faq__question">Wie schnell bekomme ich Rückmeldung?</summary>
					<div class="ali-faq__answer">
						<p>In der Regel innerhalb von 48 Stunden.</p>
					</div>
				</details>
			</div>
		</div>
	</section>

	<!-- ═══════════════════════════════════════════════════
	     6. ABSCHLUSS-CTA
	     ═══════════════════════════════════════════════════ -->
	<section class="ali-section ali-final-cta" aria-labelledby="ali-final-heading">
		<div class="ali-container ali-container--narrow">
			<h2 id="ali-final-heading" class="ali-section__h2">
				Bereit? Reich deine Website ein.
			</h2>

			<div class="ali-final-cta__wrap">
				<a href="#audit-form" class="ali-btn ali-btn--primary" data-track-action="cta_final_audit_linkedin" data-track-category="lead_gen">
					Website für Audit einreichen
				</a>
			</div>
		</div>
	</section>

</main>

<footer class="ali-footer" role="contentinfo">
	<div class="ali-container">
		<nav class="ali-footer__links" aria-label="Footer-Navigation">
			<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
			<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
		</nav>
	</div>
</footer>
