<?php
/**
 * Front Page Template
 *
 * Versioned homepage structure with a fixed premium conversion flow.
 * SEO-Meta bleibt zentral in inc/seo-meta.php.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$urls = function_exists( 'hu_home_urls' ) ? hu_home_urls() : [];

$request_url             = function_exists( 'nexus_get_primary_request_url' ) ? nexus_get_primary_request_url() : home_url( '/solar-waermepumpen-leadgenerierung/#energie-anfrage' );
$primary_cta_label       = 'System-Diagnose starten (60 Sek.)';
$secondary_cta_label     = 'Schon entschieden? Direkt anfragen.';

$slots_booked = 3; // Verknappung Variable

$hero_metrics = function_exists( 'nexus_get_public_proof_metric_list' ) ? nexus_get_public_proof_metric_list( [ 'lead_count', 'sales_conversion', 'cpl_reduction' ] ) : [
	[
		'value' => '1.750+',
		'label' => 'qualifizierte Anfragen',
	],
	[
		'value' => '12 %',
		'label' => 'Abschlussquote',
	],
	[
		'value' => '-83 %',
		'label' => 'Kosten pro Anfrage',
	],
];

$faq_items = [
	[
		'question' => 'Bauen Sie nur eine Website oder kümmern Sie sich auch um den Traffic?',
		'answer'   => 'Ich baue das komplette System. Die Website ist nur der Motor. Dazu gehören Tracking, Vorqualifizierung und die exakte Steuerung der Werbekanäle, um Sie von Portal-Leads unabhängig zu machen.',
	],
	[
		'question' => 'Arbeiten Sie auch mit bestehenden Websites?',
		'answer'   => 'Ja. In den meisten Fällen reichen gezielte Eingriffe statt eines Relaunches.',
	],
];

get_header();
?>

<main id="main" class="site-main" data-track-section="homepage">
	<div class="cs-page homepage-template">
		<section id="hero" class="wp-hero wp-home-hero">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-hero__grid">
					<div class="wp-hero-copy wp-home-hero__copy">
						<span class="wp-badge">Für Solar- und Wärmepumpen-Betriebe mit 10–25 Mitarbeitern</span>
						<h1 class="wp-hero-title">Schluss mit teuren Portal-Leads, die nicht ans Telefon gehen.</h1>
						<p class="wp-hero-subtitle wp-home-hero__subtitle">
							&minus;83 % Kosten pro Anfrage in 9 Monaten &mdash; Referenz E3 New Energy. Eigenes Anfrage-System statt Portal-Abhängigkeit.
						</p>

						<div class="wp-home-hero__actions">
							<a href="<?php echo esc_url( $request_url ); ?>" class="wp-btn wp-btn-primary wp-home-hero__primary" data-track-action="cta_home_hero_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
							<div style="margin-top: 0.75rem;">
								<a href="<?php echo esc_url( $request_url ); ?>" class="wp-home-hero__secondary" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_hero_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

		<!-- Task 3: Pain-Block -->
		<section id="pain" class="wp-section homepage-pain" data-track-section="homepage_pain" style="background: var(--nx-bg-glass-light, rgba(255, 255, 255, 0.02)); padding: 4rem 0; border-top: 1px solid var(--nx-border, rgba(255, 255, 255, 0.05)); border-bottom: 1px solid var(--nx-border, rgba(255, 255, 255, 0.05));">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<h2 class="wp-section-h2">Die Realität im Lead-Einkauf</h2>
				</div>
				<ul class="premium-list" style="max-width: 600px; margin: 0 auto 2rem; list-style: none; padding: 0;">
					<li style="margin-bottom: 1rem;"><span class="check-icon" style="color: #ff6b6b; margin-right: 10px;">✕</span>80 &euro; pro Lead &mdash; Hälfte geht nicht ans Telefon</li>
					<li style="margin-bottom: 1rem;"><span class="check-icon" style="color: #ff6b6b; margin-right: 10px;">✕</span>Kein Überblick, welcher Kanal wirklich konvertiert</li>
					<li style="margin-bottom: 1rem;"><span class="check-icon" style="color: #ff6b6b; margin-right: 10px;">✕</span>Seit 2024: Anfragen kommen nicht mehr von allein</li>
				</ul>
				<div class="text-center">
					<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_pain_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
					<div style="margin-top: 0.75rem;">
						<a href="<?php echo esc_url( $request_url ); ?>" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_pain_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<section id="proof" class="wp-section homepage-track-record" data-track-section="homepage_proof">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<span class="wp-badge">Proof</span>
					<h2 class="wp-section-h2">Ergebnis statt Behauptung.</h2>
				</div>

				<article class="wp-success-card homepage-track-record__card homepage-track-record__card--primary" aria-labelledby="homepage-proof-case-title">
					<div class="homepage-track-record__case-head">
						<!-- Kundenlogo E3 New Energy -->
						<div style="margin-bottom: 1rem; font-weight: 900; font-size: 1.5rem; letter-spacing: -0.02em;">E3 New Energy</div>
						<h3 id="homepage-proof-case-title" class="wp-success-title">Vom Lead-Einkauf zur Lead-Autonomie.</h3>
					</div>

					<p class="homepage-track-record__summary">
						Ausgangslage: Hohe Leadkosten und unklare Qualität durch eingekaufte Portal-Leads.<br>
						Ergebnis: Eigenes, skalierbares System mit signifikant reduzierten CPL und echten Entscheidungssignalen.
					</p>

					<div class="wp-home-kpi-row" role="list" aria-label="Zentrale Ergebniskennzahlen" style="margin: 2rem 0; display: flex; flex-wrap: wrap; gap: 1rem;">
						<div class="wp-home-kpi-card" role="listitem" style="flex: 1; min-width: 120px;">
							<span class="wp-home-kpi-card__value" style="display: block; font-size: 1.5rem; font-weight: bold;">9 Monate</span>
							<span class="wp-home-kpi-card__label" style="font-size: 0.85rem;">Dauer</span>
						</div>
						<div class="wp-home-kpi-card" role="listitem" style="flex: 1; min-width: 120px;">
							<span class="wp-home-kpi-card__value" style="display: block; font-size: 1.5rem; font-weight: bold;">1.750+</span>
							<span class="wp-home-kpi-card__label" style="font-size: 0.85rem;">Anfragen</span>
						</div>
						<div class="wp-home-kpi-card" role="listitem" style="flex: 1; min-width: 120px;">
							<span class="wp-home-kpi-card__value" style="display: block; font-size: 1.5rem; font-weight: bold;">12 %</span>
							<span class="wp-home-kpi-card__label" style="font-size: 0.85rem;">Abschlussquote</span>
						</div>
						<div class="wp-home-kpi-card" role="listitem" style="flex: 1; min-width: 120px;">
							<span class="wp-home-kpi-card__value" style="display: block; font-size: 1.5rem; font-weight: bold;">&minus;83 %</span>
							<span class="wp-home-kpi-card__label" style="font-size: 0.85rem;">CPL</span>
						</div>
					</div>

					<div class="homepage-track-record__actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_proof_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
						<div style="margin-top: 0.75rem;">
							<a href="<?php echo esc_url( $request_url ); ?>" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_proof_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
						</div>
					</div>
				</article>
			</div>
		</section>

		<section class="wp-section homepage-problem-frame" data-track-section="homepage_models">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<span class="wp-badge">Modell</span>
					<h2 class="wp-section-h2">Zwei Wege. Ein Unterschied.</h2>
				</div>

				<div class="homepage-problem-frame__grid">
					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--muted">
						<p class="wp-success-subtitle">Modell A</p>
						<h3 class="wp-success-title">Nachfrage mieten</h3>
						<ul class="premium-list" aria-label="Modell A">
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Klicks werden teurer, Seite konvertiert nicht mit</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Reports ohne Entscheidungssignale</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Budgetstop = Nachfrage-Stopp</div></li>
						</ul>
						<div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--nx-border-color, rgba(255, 255, 255, 0.1)); font-weight: 600;">
							24 Monate &approx; 26.000 &euro; &middot; 0 &euro; Asset
						</div>
					</article>

					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--accent">
						<p class="wp-success-subtitle">Modell B</p>
						<h3 class="wp-success-title">Infrastruktur aufbauen</h3>
						<ul class="premium-list" aria-label="Modell B">
							<li><span class="check-icon">✓</span><div>Money Pages und Proof werden bleibende Assets</div></li>
							<li><span class="check-icon">✓</span><div>Privacy-first Tracking schafft echte Entscheidungssignale</div></li>
							<li><span class="check-icon">✓</span><div>Ads erst skalieren, wenn das Fundament steht</div></li>
						</ul>
						<div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--nx-border-color-accent, rgba(255,255,255,0.2)); font-weight: 600;">
							24 Monate &approx; 13.200&ndash;19.200 &euro; &middot; aktiviertes Asset
						</div>
					</article>
				</div>

				<div class="homepage-problem-frame__cta text-center" style="margin-top: 3rem;">
					<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_models_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
					<div style="margin-top: 0.75rem;">
						<a href="<?php echo esc_url( $request_url ); ?>" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_models_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<!-- Task 7: System-Sektion ersetzen (3-Schritt-Prozess) -->
		<section id="system" class="wp-section homepage-system-teaser" data-track-section="homepage_system">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<span class="wp-badge">System</span>
					<h2 class="wp-section-h2">Der 3-Schritt-Prozess</h2>
				</div>

				<div class="homepage-system-teaser__card" style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
					<div class="system-step">
						<h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">1. Fundament ordnen</h3>
						<p>Tracking &amp; Datenebene aufsetzen.</p>
					</div>
					<div class="system-step">
						<h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">2. Conversion-Pfade schärfen</h3>
						<p>Formular, Call, Buchung optimieren.</p>
					</div>
					<div class="system-step">
						<h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">3. Skalieren</h3>
						<p>Money Pages, Proof und Unabhängigkeit aufbauen.</p>
					</div>
				</div>
				<div class="text-center" style="margin-top: 3rem;">
					<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_system_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
					<div style="margin-top: 0.75rem;">
						<a href="<?php echo esc_url( $request_url ); ?>" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_system_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<!-- Task 6 & 8: Drei Prüffragen + Trust-Elemente -->
		<section id="prueffragen" class="wp-section homepage-prueffragen" style="background: var(--nx-bg-glass-light, rgba(255, 255, 255, 0.02)); padding: 4rem 0; border-top: 1px solid var(--nx-border, rgba(255, 255, 255, 0.05)); border-bottom: 1px solid var(--nx-border, rgba(255, 255, 255, 0.05));">
			<div class="wp-container wp-home-shell">
				<div style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
					<div style="flex: 1; min-width: 300px;">
						<h2 class="wp-section-h2" style="margin-bottom: 2rem;">Drei Fragen, die klären, ob Sie ein System besitzen oder mieten.</h2>
						<ol style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem; padding-left: 1.5rem;">
							<li style="margin-bottom: 1rem;">Wem gehört der Code Ihrer Landingpage?</li>
							<li style="margin-bottom: 1rem;">Wem gehört das CRM, in dem Ihre Leads liegen?</li>
							<li style="margin-bottom: 1rem;">Wem gehört der Tracking-Account?</li>
						</ol>
						<p style="font-weight: 600; font-size: 1.1rem;">
							Dreimal &bdquo;uns&ldquo;: Sie brauchen mich nicht.<br>
							Dreimal &bdquo;der Agentur&ldquo;: Sie mieten ein System.
						</p>
					</div>
					<div style="flex: 1; min-width: 300px; text-align: center;">
						<img src="https://hasimuener.de/wp-content/uploads/2026/04/Hasim_Uener_Portrait.png" alt="Hasim Üner" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; margin-bottom: 1.5rem; border: 2px solid var(--nx-border, rgba(255, 255, 255, 0.1)); box-shadow: var(--nx-shadow-md, 0 10px 30px rgba(0,0,0,0.5));">
						<div style="text-align: left; max-width: 280px; margin: 0 auto; font-size: 0.95rem; line-height: 1.5; background: var(--nx-bg-glass-light, rgba(255, 255, 255, 0.05)); padding: 2rem; border-radius: 12px; border: 1px solid var(--nx-border, rgba(255, 255, 255, 0.1));">
							<strong>Hasim Üner.</strong><br>
							Experte für B2B-Leadgenerierung und Tracking.<br>
							Baut Systeme, die unabhängig machen.
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="faq" class="homepage-faq-section homepage-faq-section--home" aria-labelledby="faq-heading">
			<div class="nx-container wp-home-shell">
				<div class="wp-home-section-title text-center">
					<span class="nx-badge nx-badge--gold">FAQ</span>
					<h2 id="faq-heading" class="wp-section-h2">Häufige Fragen</h2>
				</div>
				<div class="nx-faq">
					<?php foreach ( $faq_items as $index => $item ) : ?>
						<details class="nx-faq__item"<?php echo 0 === $index ? ' open' : ''; ?>>
							<summary><?php echo esc_html( $item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="cta" class="wp-section homepage-conversion-cta" data-track-section="homepage_cta">
			<div class="wp-container wp-home-shell">
				<div class="nx-cta-box homepage-conversion-cta__box text-center">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Direkt anfragen.</h2>
					<p class="homepage-conversion-cta__lead" style="margin-bottom: 1rem;">Gehen Sie direkt ins qualifizierte Formular.</p>
					
					<!-- Task 9: Verknappung -->
					<p style="font-weight: 600; margin-bottom: 2rem; color: var(--nx-text-muted);">Aktuell <?php echo esc_html( $slots_booked ); ?> von 4 Slots in Q2 2026 vergeben.</p>

					<div class="homepage-track-record__actions">
						<a class="nx-btn nx-btn--primary homepage-conversion-cta__button" href="<?php echo esc_url( $request_url ); ?>" data-track-action="cta_home_final_diagnose" data-track-category="lead_gen"><?php echo esc_html( $primary_cta_label ); ?></a>
						<div style="margin-top: 0.75rem;">
							<a href="<?php echo esc_url( $request_url ); ?>" style="font-size: 0.85rem; text-decoration: underline;" data-track-action="cta_home_final_request" data-track-category="lead_gen"><?php echo esc_html( $secondary_cta_label ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
