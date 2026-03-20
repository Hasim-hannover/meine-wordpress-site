<?php
/**
 * Template Name: Ergebnisse Hub
 * Description: Hub für E3, DOMDAR und Whitelabel-Arbeit mit laufender Weiterentwicklung.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url      = nexus_get_audit_url();
$wgos_url       = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
$e3_url         = nexus_get_page_url(
	[ 'e3-new-energy', 'case-studies/e3-new-energy', 'case-e3' ],
	home_url( '/e3-new-energy/' )
);
$domdar_url     = nexus_get_page_url(
	[ 'case-study-domdar', 'domdar' ],
	home_url( '/case-study-domdar/' )
);
$whitelabel_url = nexus_get_whitelabel_page_url();

$hero_highlights = [
	[
		'label' => 'E3 zuerst',
		'copy'  => 'für B2B-Leadgen, Angebotsseiten und Nachfrage-Systeme',
	],
	[
		'label' => 'DOMDAR',
		'copy'  => 'für Commerce, CRO, AOV und Profitabilität im Shop-Kontext',
	],
	[
		'label' => 'Whitelabel',
		'copy'  => 'für Rolle, Eingriffe und Zusammenarbeit im Hintergrund',
	],
	[
		'label' => 'Danach',
		'copy'  => 'eigene Seite prüfen oder die Systemlogik hinter den Ergebnissen verstehen',
	],
];

$proof_cards = [
	[
		'badge'  => 'Stärkster B2B-Case',
		'title'  => 'E3 New Energy',
		'copy'   => 'Relevant für B2B-Seiten, Leadgen und Angebotslogik. Hier sehen Sie den offensten Case im Hub: Ausgangslage, Eingriffe, Kennzahlen und Systemlogik.',
		'stats'  => [
			'für B2B Leadgen und Angebotsseiten',
			'öffentlicher Deep Dive mit Zahlen und Reihenfolge',
			'1.750+ Leads, -83 % CPL, 12 % Sales-Conversion',
		],
		'cta'    => 'E3-Case ansehen',
		'url'    => $e3_url,
		'accent' => 'success featured',
		'button' => 'primary',
		'track'  => 'cta_results_card_e3',
	],
	[
		'badge'  => 'Commerce-/CRO-Proof',
		'title'  => 'DOMDAR',
		'copy'   => 'Relevant für Shops, Conversion und Profitabilität. Der Case zeigt, wie Bundle-Logik, Recovery-Loops und operative Entlastung ohne Mehrbudget zusammenspielen.',
		'stats'  => [
			'für Shops, CRO und Profitabilität',
			'Commerce-Case mit klarer Hebellogik',
			'120 € AOV, 4,6 % Conversion Rate, 0 € mehr Ad-Spend',
		],
		'cta'    => 'DOMDAR-Case ansehen',
		'url'    => $domdar_url,
		'accent' => 'gold',
		'button' => 'ghost',
		'track'  => 'cta_results_card_domdar',
	],
	[
		'badge'  => 'Anonymisierter Vertrauensbeleg',
		'title'  => 'Whitelabel & Weiterentwicklung',
		'copy'   => 'Relevant, wenn Sie wissen wollen, wie ich im Hintergrund für Agenturen und Teams arbeite: Landingpages, Tracking, CRO-nahe Eingriffe, Systempflege und Sparring.',
		'stats'  => [
			'für Rolle, Verantwortung und Zusammenarbeit',
			'anonymisierte Einblicke statt öffentlicher Logos',
			'Landingpages, Tracking, CRO und laufende Systempflege',
		],
		'cta'    => 'Whitelabel-Proof ansehen',
		'url'    => $whitelabel_url,
		'accent' => 'highlight',
		'button' => 'ghost',
		'track'  => 'cta_results_card_whitelabel',
	],
];

$detail_sections = [
	[
		'id'      => 'bereich-e3',
		'eyebrow' => 'Empfohlener Einstieg',
		'title'   => 'E3 New Energy',
		'intro'   => 'Wenn Sie B2B-Anfragen, Leadqualität oder Angebotsseiten verbessern wollen, ist das der sinnvollste erste Case. E3 zeigt öffentlich, wie aus externem Lead-Einkauf ein eigenes Nachfrage-System wurde.',
		'note'    => 'Wenn Sie nur einen Case ansehen, sollte es dieser sein.',
		'bullets' => [
			'zeigt offen, welche Ausgangslage vorlag und welche Eingriffe zuerst gemacht wurden',
			'relevant für B2B-Leadgen, Angebotsseiten, Tracking und Conversion-Architektur',
			'macht Ursache, Reihenfolge und Ergebnis nachvollziehbar statt nur einzelne Zahlen zu zeigen',
		],
		'stats'   => [ 'Öffentlicher B2B-Deep Dive', '1.750+ Leads', '-83 % CPL', '12 % Sales-Conversion' ],
		'url'     => $e3_url,
		'link'    => 'Öffentlichen B2B-Case öffnen',
		'accent'  => 'success',
		'track'   => 'cta_results_detail_e3',
	],
	[
		'id'      => 'bereich-domdar',
		'eyebrow' => 'Commerce- und CRO-Proof',
		'title'   => 'DOMDAR',
		'intro'   => 'Wenn Ihr Kontext eher Shop, AOV, Checkout-Reibung oder Profitabilität ist, ergänzt DOMDAR den Hub sinnvoll. Der Case zeigt, wie Conversion- und Recovery-Hebel ohne zusätzliches Mediabudget zusammenspielen.',
		'note'    => 'Relevant, wenn Shop-Optimierung wichtiger ist als klassisches B2B-Leadgen.',
		'bullets' => [
			'zeigt, wie Profitabilität aus Angebotslogik, Bundle-Struktur und Recovery entsteht',
			'relevant für Shops, CRO, AOV und operative Reibungsverluste im Conversion-Pfad',
			'ergänzt E3 logisch, statt mit einem zweiten B2B-Case um Aufmerksamkeit zu konkurrieren',
		],
		'stats'   => [ 'Commerce-/CRO-Case', '120 € AOV', '4,6 % Conversion Rate', '0 € mehr Ad-Spend' ],
		'url'     => $domdar_url,
		'link'    => 'Commerce-CRO-Case öffnen',
		'accent'  => 'gold',
		'track'   => 'cta_results_detail_domdar',
	],
	[
		'id'      => 'bereich-whitelabel',
		'eyebrow' => 'Vertrauensvertiefung',
		'title'   => 'Whitelabel & Weiterentwicklung',
		'intro'   => 'Wenn Sie nicht nur öffentliche Cases, sondern die Art der Zusammenarbeit prüfen wollen, ist dieser Proof relevant. Er macht sichtbar, welche Rolle ich im Hintergrund für Agenturen und Teams übernehme.',
		'note'    => 'Relevant, wenn Sie Verantwortung, Eingriffstiefe und Verlässlichkeit prüfen wollen.',
		'bullets' => [
			'konkretisiert typische Arbeit im Hintergrund: Landingpages, Funnel-Teile, Tracking, SEO-nahe Eingriffe und Systempflege',
			'zeigt, in welcher Rolle ich andocke: operative Umsetzung, laufende Weiterentwicklung und strategisch-operatives Sparring',
			'macht nachvollziehbar, warum wiederholte Zusammenarbeit auch ohne öffentliche Logos ein relevanter Vertrauensbeleg ist',
		],
		'stats'   => [ 'Anonymisierte Whitelabel-Arbeit', 'Landingpages & Funnelpflege', 'Tracking & technische Eingriffe', 'Sparring & Systempflege' ],
		'url'     => $whitelabel_url,
		'link'    => 'Whitelabel-Proof öffnen',
		'accent'  => 'highlight',
		'track'   => 'cta_results_detail_whitelabel',
	],
];
?>

<main id="main" class="site-main results-hub" data-track-section="results_hub">
	<section class="nx-section results-hero">
		<div class="nx-container">
			<div class="results-hero__inner">
				<span class="nx-badge nx-badge--gold">Ergebnisse</span>
				<h1 class="results-hero__title">Ergebnisse aus echten Projekten, öffentlich, anonymisiert und nachvollziehbar.</h1>
				<p class="results-hero__subtitle">
					Hier sehen Sie, wie WordPress, CRO, Tracking und Nachfrage-Systeme in der Praxis wirken:
					als öffentlicher B2B-Case, als Commerce-CRO-Case und als anonymisierte Whitelabel-Arbeit.
				</p>
				<p class="results-hero__note">
					Wenn Sie nur einen Case zuerst ansehen wollen, starten Sie mit
					<a href="<?php echo esc_url( $e3_url ); ?>" data-track-action="cta_results_hero_note_e3" data-track-category="trust">E3 New Energy</a>.
				</p>

				<div class="results-metrics" role="list" aria-label="Schnelle Orientierung">
					<?php foreach ( $hero_highlights as $highlight ) : ?>
						<div class="results-metric" role="listitem">
							<strong><?php echo esc_html( $highlight['label'] ); ?></strong>
							<span><?php echo esc_html( $highlight['copy'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="results-hero__actions">
					<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_hero_e3" data-track-category="trust">Mit E3 starten</a>
					<a href="#proof-grid" class="nx-btn nx-btn--ghost" data-track-action="cta_results_hero_select" data-track-category="trust">Proof-Typ auswählen</a>
				</div>
			</div>
		</div>
	</section>

	<section class="nx-section results-grid-section" id="proof-grid">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--ghost">Schnelle Auswahl</span>
				<h2 class="nx-headline-section">Welcher Proof passt zuerst zu Ihrer Situation?</h2>
				<p class="nx-subheadline">Die Karten helfen bei der Selbstselektion. Für die meisten kaufnahen B2B-Besucher ist E3 der beste Einstieg.</p>
			</div>

			<div class="results-card-grid">
				<?php foreach ( $proof_cards as $card ) : ?>
					<article class="nx-card results-card results-card--<?php echo esc_attr( $card['accent'] ); ?>">
						<span class="results-card__badge"><?php echo esc_html( $card['badge'] ); ?></span>
						<h3 class="results-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="results-card__copy"><?php echo esc_html( $card['copy'] ); ?></p>
						<ul class="results-card__stats" aria-label="<?php echo esc_attr( $card['title'] . ' Orientierung' ); ?>">
							<?php foreach ( $card['stats'] as $stat ) : ?>
								<li><?php echo esc_html( $stat ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="results-card__actions">
							<a href="<?php echo esc_url( $card['url'] ); ?>" class="nx-btn nx-btn--<?php echo esc_attr( $card['button'] ); ?>" data-track-action="<?php echo esc_attr( $card['track'] ); ?>" data-track-category="trust"><?php echo esc_html( $card['cta'] ); ?></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section results-detail-sections">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--gold">Kurze Einordnung</span>
				<h2 class="nx-headline-section">Was zeigt jeder Proof konkret?</h2>
				<p class="nx-subheadline">Oben wählen Sie schnell. Unten sehen Sie, warum E3 zuerst kommt, wie DOMDAR ergänzt und wofür der Whitelabel-Proof relevant ist.</p>
			</div>

			<div class="results-detail-sections__stack">
				<?php foreach ( $detail_sections as $section ) : ?>
					<article id="<?php echo esc_attr( $section['id'] ); ?>" class="results-detail-card results-detail-card--<?php echo esc_attr( $section['accent'] ); ?>">
						<div class="results-detail-card__content">
							<span class="results-detail-card__eyebrow"><?php echo esc_html( $section['eyebrow'] ); ?></span>
							<h2 class="results-detail-card__title"><?php echo esc_html( $section['title'] ); ?></h2>
							<p class="results-detail-card__intro"><?php echo esc_html( $section['intro'] ); ?></p>
							<ul class="results-bullet-list">
								<?php foreach ( $section['bullets'] as $bullet ) : ?>
									<li><?php echo esc_html( $bullet ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<div class="results-detail-card__sidebar">
							<p class="results-detail-card__note"><?php echo esc_html( $section['note'] ); ?></p>
							<div class="results-detail-card__statbox">
								<?php foreach ( $section['stats'] as $stat ) : ?>
									<span><?php echo esc_html( $stat ); ?></span>
								<?php endforeach; ?>
							</div>
							<div class="results-detail-card__actions">
								<a href="<?php echo esc_url( $section['url'] ); ?>" class="nx-btn nx-btn--primary" data-track-action="<?php echo esc_attr( $section['track'] ); ?>" data-track-category="trust"><?php echo esc_html( $section['link'] ); ?></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section results-cta">
		<div class="nx-container">
			<div class="results-cta__shell">
				<div>
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2 class="results-cta__title">Wenn der Proof passt, gibt es zwei sinnvolle nächste Wege.</h2>
					<p class="results-cta__copy">
						Nicht jeder Besucher ist sofort audit-ready. Wer die eigene Seite einordnen will,
						sollte mit dem Audit starten. Wer erst verstehen will, wie die Systemlogik hinter
						diesen Ergebnissen aufgebaut ist, geht über die WGOS-Seite tiefer.
					</p>
				</div>
				<div class="results-cta__choices" aria-label="Nächste Schritte">
					<div class="results-cta__choice">
						<span class="results-cta__choice-copy">Wenn Sie Ihre eigene Seite prüfen und priorisieren lassen wollen.</span>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_footer_audit" data-track-category="lead_gen">Mit dem Growth Audit starten</a>
					</div>
					<div class="results-cta__choice">
						<span class="results-cta__choice-copy">Wenn Sie erst die Systemlogik hinter den Ergebnissen verstehen wollen.</span>
						<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_results_footer_wgos" data-track-category="trust">Systemlogik hinter den Ergebnissen verstehen</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
