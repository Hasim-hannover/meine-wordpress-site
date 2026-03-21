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

$audit_url             = $urls['audit'] ?? home_url( '/growth-audit/' );
$wgos_url              = $urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' );
$cases_url             = $urls['cases'] ?? home_url( '/ergebnisse/' );
$blog_url              = $urls['blog'] ?? home_url( '/blog/' );
$e3_url                = $urls['e3'] ?? home_url( '/e3-new-energy/' );
$audit_cta_label       = function_exists( 'nexus_get_audit_cta_label' ) ? nexus_get_audit_cta_label() : 'Growth Audit starten';
$audit_compact_microcopy = function_exists( 'nexus_get_audit_compact_microcopy' ) ? nexus_get_audit_compact_microcopy() : '0 € · Rückmeldung in 48h · kein Pflicht‑Call';

$hero_metrics = function_exists( 'nexus_get_public_proof_metric_list' ) ? nexus_get_public_proof_metric_list( [ 'lead_count', 'sales_conversion', 'cpl_reduction' ] ) : [
	[
		'value' => '1.750+',
		'label' => 'qualifizierte Leads',
	],
	[
		'value' => '12 %',
		'label' => 'Sales-Conversion',
	],
	[
		'value' => '-83 %',
		'label' => 'CPL',
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
						<span class="wp-badge nx-reveal">WordPress Growth Architect für B2B</span>
						<h1 class="wp-hero-title nx-reveal">Ich mache aus Ihrer WordPress-Website ein planbares Nachfrage-System für B2B.</h1>
						<p class="wp-hero-subtitle wp-home-hero__subtitle nx-reveal">
							Für Unternehmen, die klare Positionierung, belastbare Messbarkeit und einen nächsten Schritt brauchen, der aus Besuchern qualifizierte Anfragen macht.
						</p>

						<div class="wp-home-hero__actions nx-reveal">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-btn wp-btn-primary wp-home-hero__primary" data-track-action="cta_home_hero_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
							<a href="<?php echo esc_url( $cases_url ); ?>" class="wp-home-text-link wp-home-text-link--quiet" data-track-action="cta_home_hero_results" data-track-category="trust">Ergebnisse ansehen</a>
						</div>
						<p class="nx-cta-microcopy nx-reveal"><?php echo esc_html( $audit_compact_microcopy ); ?></p>

						<?php if ( ! empty( $hero_metrics ) ) : ?>
							<div class="wp-home-kpi-row nx-reveal" role="list" aria-label="Zentrale Ergebniskennzahlen">
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
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Proof</span>
					<h2 class="wp-section-h2">Ergebnis statt Behauptung.</h2>
				</div>

				<article class="wp-success-card homepage-track-record__card homepage-track-record__card--primary nx-reveal" aria-labelledby="homepage-proof-case-title">
					<div class="homepage-track-record__case-head">
						<p class="wp-success-subtitle">E3 New Energy</p>
						<h3 id="homepage-proof-case-title" class="wp-success-title">Ausgangslage</h3>
						<p class="homepage-track-record__lead">Hohe Leadkosten, unklare Qualität, Reibung im Anfragepfad.</p>
					</div>

					<p class="homepage-track-record__summary">Ergebnis nach Neuordnung von Positionierung, Tracking und Conversion-Führung:</p>

					<div class="homepage-track-record__metrics" role="list" aria-label="E3 Kennzahlen">
						<?php foreach ( $hero_metrics as $metric ) : ?>
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value"><?php echo esc_html( $metric['value'] ); ?></span>
								<span class="homepage-track-record__metric-label"><?php echo esc_html( $metric['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="homepage-track-record__actions">
						<a href="<?php echo esc_url( $e3_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_proof_case" data-track-category="trust">Case Study lesen</a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_proof_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
					</div>
				</article>
			</div>
		</section>

		<section class="wp-section homepage-problem-frame" data-track-section="homepage_models">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Modell</span>
					<h2 class="wp-section-h2">Zwei Wege. Ein Unterschied.</h2>
				</div>

				<div class="homepage-problem-frame__grid">
					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--muted nx-reveal">
						<p class="wp-success-subtitle">Modell A</p>
						<h3 class="wp-success-title">Nachfrage mieten</h3>
						<ul class="premium-list" aria-label="Modell A">
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Klicks werden teurer, Seite konvertiert nicht mit</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Reports ohne Entscheidungssignale</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Budgetstop = Nachfrage-Stopp</div></li>
						</ul>
					</article>

					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--accent nx-reveal">
						<p class="wp-success-subtitle">Modell B</p>
						<h3 class="wp-success-title">Infrastruktur aufbauen</h3>
						<ul class="premium-list" aria-label="Modell B">
							<li><span class="check-icon">✓</span><div>Money Pages und Proof werden bleibende Assets</div></li>
							<li><span class="check-icon">✓</span><div>Privacy-first Tracking schafft echte Entscheidungssignale</div></li>
							<li><span class="check-icon">✓</span><div>Ads erst skalieren, wenn das Fundament steht</div></li>
						</ul>
					</article>
				</div>
			</div>
		</section>

		<section id="system" class="wp-section homepage-system-teaser" data-track-section="homepage_wgos">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">WGOS</span>
					<h2 class="wp-section-h2">Das System dahinter: WGOS</h2>
				</div>

				<div class="homepage-system-teaser__card nx-reveal">
					<p class="homepage-system-teaser__lead">Drei Ebenen, eine Logik:</p>
					<p class="homepage-system-teaser__text">Erst den Anfragepfad klären, dann Messbarkeit schaffen, dann kontrolliert umsetzen.</p>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_system_wgos" data-track-category="navigation">WGOS im Detail ansehen</a>
				</div>
			</div>
		</section>

		<section id="faq" class="homepage-faq-section homepage-faq-section--home" aria-labelledby="faq-heading">
			<div class="nx-container wp-home-shell">
				<div class="wp-home-section-title text-center nx-reveal">
					<span class="nx-badge nx-badge--gold">FAQ</span>
					<h2 id="faq-heading" class="wp-section-h2">Häufige Fragen</h2>
					<p class="wp-section-p">Klarheit vor dem nächsten Schritt.</p>
				</div>
				<div class="nx-faq">
					<?php foreach ( $faq_items as $index => $item ) : ?>
						<details class="nx-faq__item nx-reveal"<?php echo 0 === $index ? ' open' : ''; ?>>
							<summary><?php echo esc_html( $item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="cta" class="wp-section homepage-conversion-cta" data-track-section="homepage_cta">
			<div class="wp-container wp-home-shell">
				<div class="nx-cta-box nx-reveal homepage-conversion-cta__box">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Klarheit vor dem nächsten Schritt.</h2>
					<p class="homepage-conversion-cta__lead">Eine URL reicht. Schriftlich, manuell geprüft, in 48 Stunden.</p>
					<a class="nx-btn nx-btn--primary homepage-conversion-cta__button" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_home_final_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
					<p class="homepage-conversion-cta__microcopy"><?php echo esc_html( $audit_compact_microcopy ); ?></p>
				</div>
			</div>
		</section>

		<section id="knowledge" class="wp-section homepage-blog-section homepage-blog-section--quiet" data-track-section="homepage_knowledge">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-section-title text-center nx-reveal">
					<span class="nx-badge nx-badge--ghost">Knowledge Base</span>
					<h2 class="wp-section-h2">Wenn Sie zuerst die Denkweise prüfen wollen: hier sind die Analysen.</h2>
					<p class="wp-section-p">Die Artikel sind bewusst der längere Nebenpfad. Der direkte Einstieg bleibt das Growth Audit.</p>
				</div>

				<div class="homepage-blog-grid">
					<?php
					$blog_query = new WP_Query(
						[
							'post_type'           => 'post',
							'posts_per_page'      => 3,
							'post_status'         => 'publish',
							'ignore_sticky_posts' => true,
						]
					);

					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) :
							$blog_query->the_post();
							$thumb_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
							$categories = get_the_category();
							$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Knowledge Base';
							?>
							<article class="homepage-blog-card nx-reveal">
								<a href="<?php the_permalink(); ?>" class="homepage-blog-card__link">
									<?php if ( $thumb_url ) : ?>
										<div class="homepage-blog-card__media">
											<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
										</div>
									<?php endif; ?>
									<div class="homepage-blog-card__body">
										<span class="homepage-blog-card__eyebrow"><?php echo esc_html( $cat_name ); ?></span>
										<h3><?php the_title(); ?></h3>
										<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
										<span class="homepage-blog-card__cta">Analyse lesen</span>
									</div>
								</a>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						?>
						<p class="homepage-blog-section__empty">Aktuell werden neue Analysen vorbereitet.</p>
						<?php
					endif;
					?>
				</div>

				<p class="homepage-blog-section__link nx-reveal"><a href="<?php echo esc_url( $blog_url ); ?>" data-track-action="cta_home_blog_archive" data-track-category="navigation">Zum vollständigen Knowledge Base Archiv</a></p>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
