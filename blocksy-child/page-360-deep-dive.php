<?php
/**
 * Template Name: 360° Deep-Dive
 * Description: Landing Page — 360° Deep-Dive Qualifizierungs-Formular
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="deepdive-page" data-track-section="deepdive_landing">

	<!-- 1. HERO SECTION -->
	<section class="deepdive-hero">
		<span class="deepdive-pill">Nächster Schritt</span>
		<h1 class="deepdive-hero-title">360° Deep-Dive: Ursachen statt Symptome</h1>
		<p class="deepdive-hero-sub">
			Sie kennen die Schwachstellen aus dem Customer Journey Audit.<br>
			Mit 5 gezielten Fragen erstelle ich eine persönliche Analyse<br>
			mit konkreten Hebeln — priorisiert nach Impact.
		</p>
		<div class="deepdive-trust">
			<span>✓ Kein Sales-Pitch</span>
			<span>✓ Persönliche Analyse in 48h</span>
			<span>✓ Konkreter Maßnahmenplan</span>
		</div>
	</section>

	<!-- 2. FORMULAR SECTION -->
	<section class="deepdive-form-section">
		<div class="deepdive-form-wrap">
			<?php echo do_shortcode( '[fluentform id="33"]' ); ?>
		</div>
	</section>

	<!-- 3. ERWARTUNGSMANAGEMENT -->
	<section class="deepdive-steps-section">
		<div class="deepdive-steps">
			<div class="deepdive-step">
				<span class="deepdive-step-num">1</span>
				<div class="deepdive-step-text">
					<strong>Sie beantworten 5 kurze Fragen</strong>
					<span>(60 Sek.)</span>
				</div>
			</div>
			<div class="deepdive-step">
				<span class="deepdive-step-num">2</span>
				<div class="deepdive-step-text">
					<strong>Ich analysiere Ihr Setup</strong>
					<span>anhand der CJA-Daten + Ihrer Antworten</span>
				</div>
			</div>
			<div class="deepdive-step">
				<span class="deepdive-step-num">3</span>
				<div class="deepdive-step-text">
					<strong>Sie erhalten eine persönliche Analyse</strong>
					<span>mit Hebeln per E-Mail (48h)</span>
				</div>
			</div>
		</div>
	</section>

	<!-- 4. VERTRAUENS-SECTION -->
	<section class="deepdive-trust-section">
		<h2 class="deepdive-section-title">Warum kostenlos?</h2>
		<p class="deepdive-trust-text">
			Weil ich lieber mit Unternehmen spreche, die ihre Engpässe kennen.
			Der Deep-Dive zeigt mir, ob und wie ich helfen kann.
			Kein Anruf, kein Follow-Up-Spam — nur eine ehrliche Analyse per E-Mail.
		</p>
	</section>

	<!-- 5. ALTERNATIVE CTA -->
	<section class="deepdive-alt-cta">
		<p class="deepdive-alt-label">Lieber direkt sprechen?</p>
		<a href="https://cal.com/hasim/30min" class="deepdive-alt-link" target="_blank" rel="noopener">
			→ Strategiecall buchen (30 Min, kostenlos)
		</a>
	</section>

	<!-- 6. RÜCKLINK ZUM CJA -->
	<section class="deepdive-cja-link">
		<p class="deepdive-cja-label">Noch keinen Customer Journey Audit gemacht?</p>
		<a href="/customer-journey-audit/" class="deepdive-cja-btn">
			→ Jetzt kostenlos starten (dauert 60 Sekunden)
		</a>
	</section>

</div>

<?php get_footer(); ?>
