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

$audit_url               = $urls['audit'] ?? home_url( '/growth-audit/' );
$request_url             = function_exists( 'nexus_get_primary_request_url' ) ? nexus_get_primary_request_url() : home_url( '/solar-waermepumpen-leadgenerierung/#energie-anfrage' );
$request_cta_label       = function_exists( 'nexus_get_primary_request_cta_label' ) ? nexus_get_primary_request_cta_label() : 'Anfrage stellen';
$audit_compact_microcopy = function_exists( 'nexus_get_audit_compact_microcopy' ) ? nexus_get_audit_compact_microcopy() : '60 Sek. · priorisierte Hebel · keine E-Mail';

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
		'question' => 'Was unterscheidet Sie von einer klassischen WordPress-Agentur?',
		'answer'   => 'Ich ordne WordPress als B2B-Anfrage-System — Positionierung, Tracking, Conversion und kontrollierte Weiterentwicklung statt Seiten-Produktion.',
	],
	[
		'question' => 'Was passiert nach dem Growth Audit?',
		'answer'   => 'Sie bekommen eine klare Einschätzung, wo Ihre Website Nachfrage verliert. Daraus kann eine fokussierte Korrektur oder laufende Weiterentwicklung entstehen — muss aber nicht.',
	],
	[
		'question' => 'Arbeiten Sie auch mit bestehenden WordPress-Websites?',
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
							Ich baue Solar- und Wärmepumpen-Anbietern ein eigenes Anfrage-System — damit Ihr Vertrieb nur noch mit Interessenten spricht, die wirklich kaufen wollen.
						</p>

						<div class="wp-home-hero__actions">
							<a href="<?php echo esc_url( $request_url ); ?>" class="wp-btn wp-btn-primary wp-home-hero__primary" data-track-action="cta_home_hero_request" data-track-category="lead_gen"><?php echo esc_html( $request_cta_label ); ?></a>
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-home-text-link wp-home-text-link--quiet" data-track-action="cta_home_hero_audit" data-track-category="lead_gen">Audit starten</a>
						</div>
						<p class="nx-cta-microcopy">Wenn der Fit klar ist, direkt anfragen. Wenn zuerst die Hebel priorisiert werden sollen, Audit starten.</p>

						<?php if ( ! empty( $hero_metrics ) ) : ?>
							<div class="wp-home-kpi-row" role="list" aria-label="Zentrale Ergebniskennzahlen">
								<?php foreach ( $hero_metrics as $metric ) : ?>
									<div class="wp-home-kpi-card" role="listitem">
										<span class="wp-home-kpi-card__value"><?php echo esc_html( $metric['value'] ); ?></span>
										<span class="wp-home-kpi-card__label"><?php echo esc_html( $metric['label'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<section id="proof" class="wp-section homepage-track-record" data-track-section="homepage_proof">
			<div id="audit" class="homepage-legacy-anchor" aria-hidden="true"></div>
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<span class="wp-badge">Proof</span>
					<h2 class="wp-section-h2">Ergebnis statt Behauptung.</h2>
				</div>

				<article class="wp-success-card homepage-track-record__card homepage-track-record__card--primary" aria-labelledby="homepage-proof-case-title">
					<div class="homepage-track-record__case-head">
						<p class="wp-success-subtitle">E3 New Energy</p>
						<h3 id="homepage-proof-case-title" class="wp-success-title">Hohe Leadkosten, unklare Qualität, Reibung im Anfragepfad.</h3>
					</div>

					<p class="homepage-track-record__summary">Erst Fundament und Tracking ordnen, dann Conversion-Pfade schärfen, dann skalieren. Wenn diese Ausgangslage nach Ihrem Markt klingt, ist der nächste sinnvolle Schritt nicht noch ein Proof-Klick, sondern Anfrage oder Audit.</p>

					<div class="homepage-track-record__actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_proof_request" data-track-category="lead_gen"><?php echo esc_html( $request_cta_label ); ?></a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_proof_audit" data-track-category="lead_gen">Audit starten</a>
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
					</article>

					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--accent">
						<p class="wp-success-subtitle">Modell B</p>
						<h3 class="wp-success-title">Infrastruktur aufbauen</h3>
						<ul class="premium-list" aria-label="Modell B">
							<li><span class="check-icon">✓</span><div>Money Pages und Proof werden bleibende Assets</div></li>
							<li><span class="check-icon">✓</span><div>Privacy-first Tracking schafft echte Entscheidungssignale</div></li>
							<li><span class="check-icon">✓</span><div>Ads erst skalieren, wenn das Fundament steht</div></li>
						</ul>
					</article>
				</div>

				<div class="homepage-problem-frame__cta">
					<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_models_request" data-track-category="lead_gen"><?php echo esc_html( $request_cta_label ); ?></a>
					<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_models_audit" data-track-category="lead_gen">Audit starten</a>
				</div>
			</div>
		</section>

		<section id="system" class="wp-section homepage-system-teaser" data-track-section="homepage_wgos">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center">
					<span class="wp-badge">System</span>
					<h2 class="wp-section-h2">Das System muss nicht Ihr erster Klick sein.</h2>
				</div>

				<div class="homepage-system-teaser__card">
					<p class="homepage-system-teaser__lead">Die Logik dahinter ist immer gleich: erst Anfragepfad und Datenebene ordnen, dann skalieren.</p>
					<p class="homepage-system-teaser__text">Sie müssen dafür nicht erst durch ein Framework klicken. Wenn der Fit passt, geht es direkt ins Formular. Wenn noch unklar ist, wo der größte Hebel liegt, zuerst ins Audit.</p>
					<div class="homepage-track-record__actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_system_request" data-track-category="lead_gen"><?php echo esc_html( $request_cta_label ); ?></a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_system_audit" data-track-category="lead_gen">Audit starten</a>
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
				<div class="nx-cta-box homepage-conversion-cta__box">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Erst Anfrage. Oder zuerst Audit.</h2>
					<p class="homepage-conversion-cta__lead">Wenn der Fit klar ist, gehen Sie direkt ins qualifizierte Formular. Wenn erst die Hebel priorisiert werden sollen, starten Sie das KI-Audit.</p>
					<div class="homepage-track-record__actions">
						<a class="nx-btn nx-btn--primary homepage-conversion-cta__button" href="<?php echo esc_url( $request_url ); ?>" data-track-action="cta_home_final_request" data-track-category="lead_gen"><?php echo esc_html( $request_cta_label ); ?></a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_final_audit" data-track-category="lead_gen">Audit starten</a>
					</div>
					<p class="homepage-conversion-cta__microcopy"><?php echo esc_html( $audit_compact_microcopy ); ?></p>
				</div>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
