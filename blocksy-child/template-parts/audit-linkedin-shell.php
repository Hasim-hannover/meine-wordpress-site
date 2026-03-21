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
	</div>
</div>

<main id="main" class="ali" role="main">

	<section class="ali-hero" aria-labelledby="ali-hero-heading">
		<div class="ali-container">
			<div class="ali-hero__grid">
				<div class="ali-hero__intro">
					<p class="ali-eyebrow">Audit für Websites mit Conversion-Fokus</p>

					<h1 id="ali-hero-heading" class="ali-hero__h1">
						Deine Website bekommt Besucher, aber zu wenig Anfragen?
					</h1>

					<p class="ali-hero__sub">
						Ich analysiere Klarheit, Vertrauen und Conversion-Logik — du bekommst priorisierte Hebel. Schriftlich, in 48 h, kostenlos.
					</p>

					<ol class="ali-process" aria-label="Ablauf">
						<li class="ali-process__step">
							<span class="ali-process__number" aria-hidden="true">①</span>
							<span class="ali-process__label">Website einreichen</span>
						</li>
						<li class="ali-process__step">
							<span class="ali-process__number" aria-hidden="true">②</span>
							<span class="ali-process__label">Ich analysiere</span>
						</li>
						<li class="ali-process__step">
							<span class="ali-process__number" aria-hidden="true">③</span>
							<span class="ali-process__label">Hebel per Mail</span>
						</li>
					</ol>
				</div>

				<div class="ali-hero__form-column">
					<div id="audit-form" class="ali-form-card" aria-label="Audit-Formular">
						<div class="ali-form-card__head">
							<p class="ali-form-card__eyebrow">Website einreichen</p>
							<p class="ali-form-card__note">Schriftliche Ersteinschätzung innerhalb von 48 Stunden.</p>
						</div>

						<form id="ali-audit-form" class="ali-form" novalidate>
							<div class="ali-form__hp" aria-hidden="true" tabindex="-1">
								<label for="ali-hp">Website</label>
								<input type="text" id="ali-hp" name="company_website" autocomplete="off" tabindex="-1">
							</div>

							<input type="hidden" name="source" value="linkedin">
							<input type="hidden" name="campaign" value="audit-linkedin">
							<input type="hidden" name="audit_type" value="growth_audit">
							<input type="hidden" name="focus_area" value="not_sure_yet">
							<input type="hidden" name="primary_goal" value="more_qualified_inquiries">

							<div class="ali-form__field ali-form__field--half">
								<label for="ali-name" class="ali-form__label">Name <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
								<input type="text" id="ali-name" name="name" required autocomplete="name" class="ali-form__input" placeholder="Dein Name">
								<span class="ali-form__error" role="alert" aria-live="polite"></span>
							</div>

							<div class="ali-form__field ali-form__field--half">
								<label for="ali-email" class="ali-form__label">E-Mail <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
								<input type="email" id="ali-email" name="email" required autocomplete="email" class="ali-form__input" placeholder="deine@email.de">
								<span class="ali-form__error" role="alert" aria-live="polite"></span>
							</div>

							<div class="ali-form__field ali-form__field--full">
								<label for="ali-url" class="ali-form__label">Website-URL <span class="ali-form__req" aria-label="Pflichtfeld">*</span></label>
								<input type="url" id="ali-url" name="page_url" required autocomplete="url" class="ali-form__input" placeholder="https://deine-website.de">
								<span class="ali-form__error" role="alert" aria-live="polite"></span>
							</div>

							<div class="ali-form__field ali-form__field--full">
								<label for="ali-challenge" class="ali-form__label">Was ist aktuell das größte Problem? <span class="ali-form__opt">(optional)</span></label>
									<textarea id="ali-challenge" name="current_challenge" rows="2" class="ali-form__textarea" placeholder="z. B. Wir haben Besucher, aber kaum Anfragen …"></textarea>
							</div>

							<div class="ali-form__field ali-form__field--full ali-form__consent">
								<label class="ali-form__checkbox-label">
									<input type="checkbox" name="consent_privacy" value="accepted" required class="ali-form__checkbox">
									<span>Ich stimme der <a href="<?php echo esc_url( $privacy_url ); ?>" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> zu. <span class="ali-form__req" aria-label="Pflichtfeld">*</span></span>
								</label>
								<span class="ali-form__error" role="alert" aria-live="polite"></span>
							</div>

							<div class="ali-form__submit-wrap ali-form__field--full">
								<button type="submit" class="ali-btn ali-btn--primary ali-btn--full" data-track-action="cta_form_submit_audit_linkedin" data-track-category="lead_gen" data-track-section="audit_linkedin_form">
									<span class="ali-btn__label">Audit anfragen</span>
									<span class="ali-btn__spinner" aria-hidden="true"></span>
								</button>
								<p class="ali-form__microcopy">Schriftliche Rückmeldung in 48h. Kein Pflicht-Call.</p>
							</div>
						</form>

						<div id="ali-form-success" class="ali-form-success" hidden>
							<div class="ali-form-success__icon" aria-hidden="true">
								<svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2.5"/><path d="M15 24l6 6 12-14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</div>
							<h2 class="ali-form-success__h3">Anfrage eingegangen.</h2>
							<p class="ali-form-success__text">Ich melde mich innerhalb von 48 Stunden.</p>
							<a href="<?php echo esc_url( home_url( '/ergebnisse/' ) ); ?>" class="ali-form-success__link" data-track-action="cta_audit_li_success_results" data-track-category="trust">Ergebnisse ansehen</a>
						</div>
					</div>
				</div>
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
