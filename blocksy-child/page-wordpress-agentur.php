<?php
/**
 * Template Name: Agentur Service (Hannover)
 * Description: Lokale SEO-Landingpage für WordPress Growth Architect Hannover
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$audit_url = nexus_get_audit_url();
$wgos_url  = nexus_get_page_url( [ 'wordpress-growth-operating-system', 'wgos' ] );
$cases_url = nexus_get_results_url();
$about_url = nexus_get_page_url( [ 'uber-mich' ] );
$contact_url = function_exists( 'nexus_get_contact_url' ) ? nexus_get_contact_url() : home_url( '/kontakt/' );
$implementation_contact_url = add_query_arg(
	[
		'type' => 'implementation',
	],
	$contact_url
);
$e3_url    = nexus_get_page_url( [ 'e3-new-energy' ] );
$seo_url   = nexus_get_primary_public_url( 'seo', home_url( '/wordpress-seo-hannover/' ) );
$wartung_url = nexus_get_primary_public_url( 'wartung', home_url( '/wordpress-wartung-hannover/' ) );
$measurement_url = nexus_get_wgos_asset_anchor_url( 'tracking-audit' );
$cro_url   = nexus_get_page_url( [ 'conversion-rate-optimization' ] );
$proof_metrics = function_exists( 'nexus_get_public_proof_metric_list' ) ? nexus_get_public_proof_metric_list( [ 'lead_count', 'sales_conversion', 'cpl_reduction' ] ) : [];
$canonical_ownership_sentence = function_exists( 'nexus_get_public_ownership_sentence' ) ? nexus_get_public_ownership_sentence() : 'Code, Inhalte, Zugänge und Setups bleiben bei Ihnen. Laufende Zusammenarbeit bedeutet Weiterentwicklung, nicht Abhängigkeit.';
$primary_term                = function_exists( 'nexus_get_public_primary_term' ) ? nexus_get_public_primary_term() : 'WordPress als Nachfrage-System für B2B';
$audit_cta_label             = function_exists( 'nexus_get_audit_cta_label' ) ? nexus_get_audit_cta_label() : 'Growth Audit starten';
$audit_compact_microcopy     = function_exists( 'nexus_get_audit_compact_microcopy' ) ? nexus_get_audit_compact_microcopy() : '0 € · Rückmeldung in 48h · kein Pflicht‑Call';

$hero_highlights = [
	[
		'label' => 'Für wen',
		'text'  => 'B2B-Unternehmen in Hannover und der Region, für die WordPress oder WooCommerce ein echter Nachfragekanal ist.',
	],
	[
		'label' => 'Typisches Ergebnis',
		'text'  => 'Klarere Angebotsseiten, belastbare Datensignale und weniger Reibung zwischen erstem Besuch und qualifizierter Anfrage.',
	],
	[
		'label' => 'Nächster Schritt',
		'text'  => 'Erst ein Growth Audit. Danach erst die Entscheidung, welche Maßnahme wirklich zuerst zählt.',
	],
];

$pain_cards = [
	[
		'icon'  => '01',
		'title' => 'Sichtbarkeit ohne Richtung',
		'text'  => 'Es gibt Inhalte, aber keine saubere Verbindung zwischen Suchintention, Angebotsseite und nächstem Schritt. Genau dort greifen <a href="' . esc_url( $seo_url ) . '">technische SEO</a> und Angebotslogik ineinander.',
	],
	[
		'icon'  => '02',
		'title' => 'Daten ohne Entscheidungswert',
		'text'  => 'Tracking ist installiert, aber nicht belastbar. Consent, Events und Attribution erzeugen Rauschen statt Klarheit. Deshalb ist <a href="' . esc_url( $measurement_url ) . '">privacy-first Measurement</a> Fundament und kein Add-on.',
	],
	[
		'icon'  => '03',
		'title' => 'Seiten ohne Conversion-Führung',
		'text'  => 'Kontaktformulare am Seitenende sind keine Funnel-Logik. Wenn Proof, CTA-Reihenfolge und Einwandabbau fehlen, verliert die Seite Nachfrage genau dann, wenn sie wertvoll werden könnte. Dort setzt <a href="' . esc_url( $cro_url ) . '">Conversion-Architektur</a> an.',
	],
];

$case_teaser_cards = [
	[
		'eyebrow' => 'Ausgangslage',
		'title'   => 'Hoher CPL, schwache Daten, Reibung nach dem Klick',
		'text'    => 'E3 New Energy kaufte Leads teuer ein, ohne saubere Leadqualität und ohne robuste Conversion-Führung auf der Website.',
	],
	[
		'eyebrow' => 'Maßnahme',
		'title'   => 'Erst Fundament, dann Aktivierung',
		'text'    => 'Speed, Tracking, Seitenstruktur und Conversion-Pfade wurden geordnet, bevor neue Skalierung auf das Setup geschaltet wurde.',
	],
];

$fit_items = [
	'WordPress ist ein echter Geschäftskanal und nicht nur ein Nebenprojekt.',
	'Es gibt ein belastbares Leistungsversprechen und kaufnahe Nachfrage.',
	'Sie wollen Prioritäten für Angebotsseiten, Tracking, Performance und Conversion statt Maßnahmensammlung.',
	'Messbarkeit, Ownership und kontrollierte Weiterentwicklung sind wichtiger als reine Kosmetik.',
];

$service_items = [
	'WordPress-Websites, die Anfragen generieren — nicht nur gut aussehen',
	'Technische SEO für regionale und überregionale Sichtbarkeit',
	'Tracking-Setups, die DSGVO-konform echte Entscheidungen ermöglichen',
	'Conversion-Optimierung bestehender Seiten ohne Relaunch',
	'Laufende Weiterentwicklung mit klarer Priorisierung statt Relaunch-Zyklen',
];

$faq_items = [
	[
		'question' => 'Sind persönliche Termine in Hannover möglich?',
		'answer'   => 'Ja. Strategie-Workshops, Kick-offs und Reviews sind in Hannover und Umgebung persönlich möglich. Die Zusammenarbeit funktioniert aber genauso sauber remote im gesamten DACH-Raum.',
	],
	[
		'question' => 'Arbeiten Sie auch mit Unternehmen außerhalb von Hannover?',
		'answer'   => 'Ja. Die Zusammenarbeit funktioniert remote im gesamten DACH-Raum. Der Standort Hannover ermöglicht persönliche Termine, wenn das Projekt es sinnvoll macht.',
	],
	[
		'question' => 'Wie startet die Zusammenarbeit?',
		'answer'   => 'Mit dem Growth Audit. Danach ist klar, was zuerst zählt und ob ein tieferer Folgeprozess sinnvoll ist.',
	],
];

get_header();
?>

<main id="main" class="site-main">
	<div class="cs-page wp-agentur-page-wrapper" data-track-section="agentur_landing">

		<section id="hero" class="nx-section nx-hero wp-agentur-hero">
			<div class="nx-container">
				<div class="wp-agentur-hero__grid">
					<div class="wp-agentur-hero__copy">
						<span class="nx-badge nx-badge--gold">WordPress Agentur Hannover für B2B</span>
						<h1 class="nx-hero__title">WordPress Agentur Hannover: B2B-Websites, die Anfragen liefern.</h1>
						<p class="nx-hero__subtitle">
							WordPress Agentur in Hannover heißt hier: <?php echo esc_html( $primary_term ); ?> statt Einzelmaßnahmen. Angebotsseiten, technische SEO, Tracking und Conversion-Führung greifen als ein sauberes System zusammen, auch bei WooCommerce- oder Hybrid-Setups mit echtem Anfragebezug.
						</p>
						<div class="wp-agentur-actions wp-agentur-actions--hero">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary wp-agentur-hero__primary" data-track-action="cta_agentur_hero_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
							<a href="<?php echo esc_url( $cases_url ); ?>" class="wp-agentur-text-link" data-track-action="cta_agentur_hero_results" data-track-category="trust">Ergebnisse ansehen</a>
						</div>
						<p class="nx-cta-microcopy"><?php echo esc_html( $audit_compact_microcopy ); ?></p>
						<figure class="wp-agentur-hero-portrait">
							<img
								src="https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp"
								alt="Haşim Üner – WordPress Agentur Hannover, Growth Architect für B2B-Websites"
								loading="eager"
								fetchpriority="high"
								width="120"
								height="148"
							/>
							<figcaption>Haşim Üner · Growth Architect · Hannover<br/>Workshops und Reviews vor Ort möglich. DACH-weit remote umsetzbar.</figcaption>
						</figure>
					</div>

					<aside class="wp-agentur-hero-card" aria-labelledby="agentur-hero-card-title">
						<span class="wp-agentur-hero-card__eyebrow">Sofort orientiert</span>
						<h2 id="agentur-hero-card-title" class="wp-agentur-hero-card__title">Für wen, mit welchem Ergebnis und wie der Einstieg aussieht.</h2>
						<div class="wp-agentur-hero-card__items" aria-label="Hero Zusammenfassung">
							<?php foreach ( $hero_highlights as $highlight ) : ?>
								<div class="wp-agentur-hero-card__item">
									<span class="wp-agentur-hero-card__label"><?php echo esc_html( $highlight['label'] ); ?></span>
									<p><?php echo esc_html( $highlight['text'] ); ?></p>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="wp-agentur-hero-card__proof" role="list" aria-label="Frühe Proof-Signale">
							<?php foreach ( $proof_metrics as $proof_metric ) : ?>
								<span role="listitem"><?php echo esc_html( $proof_metric['value'] . ' ' . $proof_metric['label'] ); ?></span>
							<?php endforeach; ?>
						</div>
						<p class="wp-agentur-hero-card__note">Lokale Nähe hilft. Entscheidend bleibt, ob aus WordPress ein steuerbares Nachfrage-System wird.</p>
					</aside>
				</div>
			</div>
		</section>

		<section id="problem" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Warum viele WordPress-Seiten trotz Sichtbarkeit keine belastbaren Anfragen liefern</h2>
					<p class="wp-agentur-section-intro">Das Problem ist selten nur Design. Meist fehlt die Verbindung zwischen Angebotsseiten, sauberer Messung, Proof und dem nächsten sinnvollen Schritt.</p>
				</div>
				<div class="wp-agentur-pain-grid">
					<?php foreach ( $pain_cards as $pain_card ) : ?>
						<article class="wp-agentur-pain-card nx-card">
							<span class="wp-agentur-pain-card__icon" aria-hidden="true"><?php echo esc_html( $pain_card['icon'] ); ?></span>
							<h3><?php echo esc_html( $pain_card['title'] ); ?></h3>
							<p><?php echo wp_kses_post( $pain_card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
				<div class="wp-agentur-solution-card">
					<span class="wp-agentur-solution-card__eyebrow">Die Lösung</span>
					<h3>Erst die Bremsen ordnen. Dann erst über Umsetzungstiefe sprechen.</h3>
					<p>Wenn Angebotsseiten, Datensignale, Proof und CTA-Führung wieder zusammenarbeiten, entsteht kein schöneres Webprojekt, sondern eine Website mit klarerem Nachfrageweg.</p>
					<ul>
						<li>klare Prioritäten statt Relaunch-Reflex</li>
						<li>belastbare Signale statt Tool-Rauschen</li>
						<li>bessere Anfrageführung auf kaufnahen Seiten</li>
					</ul>
					<p><?php echo esc_html( $canonical_ownership_sentence ); ?></p>
				</div>
			</div>
		</section>

		<section id="unterschied" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Was hier anders läuft.</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<div class="wp-agentur-table-wrap">
						<table class="wp-agentur-table">
							<thead>
								<tr>
									<th></th>
									<th>Agentur-Logik</th>
									<th>Growth-Architect-Logik</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Ziel</td>
									<td>Website liefern</td>
									<td>WordPress als Nachfrage-System aufbauen</td>
								</tr>
								<tr>
									<td>Lieferbild</td>
									<td>Seitenpaket und Übergabe</td>
									<td>Angebotsseiten, Datenebene, KPI-Klarheit und Weiterentwicklung</td>
								</tr>
								<tr>
									<td>Reihenfolge</td>
									<td>Design, dann später Optimierung</td>
									<td>Diagnose, Priorisierung, dann Umsetzung</td>
								</tr>
								<tr>
									<td>SEO</td>
									<td>Plugin und Grundoptimierung</td>
									<td>IA, Money Pages, Proof und Suchintention als Verbund</td>
								</tr>
								<tr>
									<td>Tracking</td>
									<td>Einrichtung für Reports</td>
									<td>Conversion-Signale und Klarheit für echte Entscheidungen</td>
								</tr>
								<tr>
									<td>Conversion</td>
									<td>CTA am Ende</td>
									<td>Argumentationsstruktur über die ganze Seite</td>
								</tr>
								<tr>
									<td>Betrieb</td>
									<td>Tool- und Plugin-Mix mit hoher Abhängigkeit</td>
									<td>Kontrollierter Stack, nachvollziehbare Änderungen, Ownership</td>
								</tr>
								<tr>
									<td>Nach Go-Live</td>
									<td>Projekt abgeschlossen</td>
									<td>Gezielte Iteration auf die größten Hebel</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>

		<section id="angebot" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Was ich für B2B-Unternehmen umsetze.</h2>
				</div>
				<div class="wp-agentur-solution-card">
					<ul>
						<?php foreach ( $service_items as $service_item ) : ?>
							<li><?php echo esc_html( $service_item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="wp-agentur-actions wp-agentur-actions--center">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_services_audit" data-track-category="lead_gen">Audit starten</a>
						<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_agentur_services_wgos" data-track-category="navigation">WGOS ansehen</a>
					</div>
				</div>
			</div>
		</section>

		<section id="fit" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Für wen ich arbeite.</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Die Zusammenarbeit passt für B2B-Unternehmen, die WordPress bereits einsetzen oder bewusst als Kernsystem nutzen wollen und deren Website Anfragen liefern soll, nicht nur Präsenz.</p>
					<ul>
						<?php foreach ( $fit_items as $fit_item ) : ?>
							<li><?php echo esc_html( $fit_item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>

		<section id="case-study" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">WordPress Agentur Hannover: Was passiert, wenn die Reihenfolge stimmt</h2>
					<p class="wp-agentur-section-intro">Kurzer Blick auf die gleiche Logik in der Praxis: Ausgangslage, Eingriff, Ergebnis und nächster sinnvoller Vertiefungsschritt.</p>
				</div>
				<div class="wp-agentur-case-grid">
					<?php foreach ( $case_teaser_cards as $case_teaser_card ) : ?>
						<article class="wp-agentur-case-card">
							<span class="wp-agentur-case-card__eyebrow"><?php echo esc_html( $case_teaser_card['eyebrow'] ); ?></span>
							<h3><?php echo esc_html( $case_teaser_card['title'] ); ?></h3>
							<p><?php echo esc_html( $case_teaser_card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
					<article class="wp-agentur-case-card wp-agentur-case-card--result">
						<span class="wp-agentur-case-card__eyebrow">Ergebnis</span>
						<h3>Mehr Wirkung aus denselben Kanälen</h3>
						<div class="wp-agentur-case-card__metrics" role="list" aria-label="Case Kennzahlen">
							<div role="listitem">
								<strong>-83 %</strong>
								<span>CPL</span>
							</div>
							<div role="listitem">
								<strong>1.750+</strong>
								<span>Leads im System</span>
							</div>
							<div role="listitem">
								<strong>12%</strong>
								<span>Sales-Conversion</span>
							</div>
						</div>
					</article>
					<article class="wp-agentur-case-card wp-agentur-case-card--cta">
						<span class="wp-agentur-case-card__eyebrow">CTA</span>
						<h3>Die Fallstudie im Detail lesen</h3>
						<p>Wenn Sie sehen wollen, wie Reihenfolge, Tracking und Conversion-Pfad zusammengewirkt haben, gehen Sie in die offene E3 Case Study.</p>
						<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_agentur_case_e3" data-track-category="trust">Case Study lesen</a>
						<p class="wp-agentur-case-card__support"><a href="<?php echo esc_url( $cases_url ); ?>" data-track-action="cta_agentur_case_results" data-track-category="trust">Weitere Ergebnisse ansehen</a></p>
					</article>
				</div>
			</div>
		</section>

		<section id="hannover" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Standort Hannover. Arbeitsgebiet DACH.</h2>
				</div>
				<p class="wp-agentur-location-note">Persönliche Termine, Workshops und Reviews sind in Hannover und Umgebung jederzeit möglich. Die Zusammenarbeit funktioniert genauso sauber remote.</p>
				<p class="wp-agentur-location-note"><strong>Standort:</strong> Pattensen bei Hannover.</p>
			</div>
		</section>

		<section id="faq" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Häufige Fragen</h2>
				</div>
				<div class="nx-faq wp-faq">
					<?php foreach ( $faq_items as $index => $item ) : ?>
						<details class="nx-faq__item"<?php echo 0 === $index ? ' open' : ''; ?>>
							<summary><?php echo esc_html( $item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="cta-final" class="nx-section">
			<div class="nx-container">
				<div class="nx-cta-box wp-agentur-cta-box">
					<h2>Prüfen wir, an welcher Stelle Ihr WordPress-System heute Nachfrage verliert.</h2>
					<p>Der Growth Audit zeigt, ob Angebotsseiten, Datenlage, CTA-Führung oder technische Reibung zuerst angegangen werden sollten und ob ein tieferer Umbau überhaupt sinnvoll ist.</p>
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_final_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
					<p class="wp-cta-desc mt-1">Kein Pitch. Klare Priorisierung. Wenn fachlich sinnvoll, kann daraus als nächster Schritt eine vertiefte Analyse, eine fokussierte Korrektur oder eine laufende Weiterentwicklung entstehen.</p>
					<p class="wp-cta-desc mb-0">
						<a href="<?php echo esc_url( $about_url ); ?>" data-track-action="cta_agentur_final_about" data-track-category="navigation">Mehr über meine Arbeitsweise</a>
						<span aria-hidden="true"> · </span>
						Wenn der Scope schon klar ist:
						<a href="<?php echo esc_url( $implementation_contact_url ); ?>" data-track-action="cta_agentur_final_contact" data-track-category="navigation">direkt Kontakt</a>
						<span aria-hidden="true"> · </span>
						Für Betrieb und Stabilisierung:
						<a href="<?php echo esc_url( $wartung_url ); ?>" data-track-action="cta_agentur_final_wartung" data-track-category="navigation">WordPress Wartung Hannover</a>
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php
$current_permalink = get_permalink();
$faq_schema        = [
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'@id'        => trailingslashit( $current_permalink ) . '#faq',
	'url'        => $current_permalink,
	'inLanguage' => 'de',
	'publisher'  => [ '@id' => home_url( '/#organization' ) ],
	'mainEntity' => array_map(
		static function ( $item ) {
			return [
				'@type'          => 'Question',
				'name'           => $item['question'],
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text'  => $item['answer'],
				],
			];
		},
		$faq_items
	),
];
?>
<script type="application/ld+json">
<?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

<?php
get_footer();
