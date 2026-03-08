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

$audit_url = nexus_get_page_url( [ 'customer-journey-audit', 'audit' ] );
?>

<div class="deepdive-page" data-track-section="deepdive_landing">

	<!-- 1. HERO SECTION -->
	<section class="deepdive-hero">
		<span class="deepdive-pill">Stufe 2 nach dem Audit</span>
		<h1 class="deepdive-hero-title">360 Grad Growth Blueprint</h1>
		<p class="deepdive-hero-sub">
			Sie kennen die groben Engpaesse aus dem Customer Journey Audit.<br>
			Mit wenigen gezielten Angaben verdichte ich das Bild zu einer persoenlichen Analyse<br>
			mit klarer Reihenfolge statt losem Massnahmenstapel.
		</p>
		<div class="deepdive-trust">
			<span>✓ Diagnose statt Pitch</span>
			<span>✓ Persoenliche Analyse in 48h</span>
			<span>✓ Priorisierter Blueprint</span>
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
					<strong>Sie beantworten wenige gezielte Fragen</strong>
					<span>(60 Sek.)</span>
				</div>
			</div>
			<div class="deepdive-step">
				<span class="deepdive-step-num">2</span>
				<div class="deepdive-step-text">
					<strong>Ich verbinde Audit-Daten und Kontext</strong>
					<span>damit Positionierung, Technik und Funnel zusammen lesbar werden</span>
				</div>
			</div>
			<div class="deepdive-step">
				<span class="deepdive-step-num">3</span>
				<div class="deepdive-step-text">
					<strong>Sie erhalten einen priorisierten Blueprint</strong>
					<span>mit Hebeln, Reihenfolge und naechster Entscheidung</span>
				</div>
			</div>
		</div>
	</section>

	<!-- 4. VERTRAUENS-SECTION -->
		<section class="deepdive-trust-section">
			<h2 class="deepdive-section-title">Warum dieser Zwischenschritt?</h2>
			<p class="deepdive-trust-text">
			Weil die meisten Teams nicht an fehlenden Ideen scheitern, sondern an fehlender Reihenfolge.
			Der Blueprint macht sichtbar, was zuerst geloest werden muss und ob eine Umsetzung wirtschaftlich Sinn ergibt.
			Kein Follow-up-Spam, kein Leistungsdumping, sondern eine belastbare Entscheidungsvorlage.
			</p>
		</section>

	<!-- 5. ALTERNATIVE CTA -->
	<section class="deepdive-alt-cta">
			<p class="deepdive-alt-label">Wenn der Kontext schon klar ist:</p>
			<a href="https://cal.com/hasim/30min" class="deepdive-alt-link" target="_blank" rel="noopener">
			-> Strategiecall buchen (30 Min, kostenlos)
			</a>
		</section>

	<!-- 6. RÜCKLINK ZUM CJA -->
	<section class="deepdive-cja-link">
			<p class="deepdive-cja-label">Noch keinen Customer Journey Audit gemacht?</p>
			<a href="<?php echo esc_url( $audit_url ); ?>" class="deepdive-cja-btn">
			-> Erst mit dem Audit starten
			</a>
		</section>

</div>

<?php get_footer(); ?>
