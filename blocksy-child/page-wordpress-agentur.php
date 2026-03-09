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
$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
$about_url = nexus_get_page_url( [ 'uber-mich' ] );
$cwv_url   = nexus_get_page_url( [ 'core-web-vitals', 'core-web-vitals-optimierung' ] );
$seo_url   = nexus_get_page_url( [ 'wordpress-seo-hannover', 'seo' ] );
$ga4_url   = nexus_get_page_url( [ 'ga4-tracking-setup' ] );
$cro_url   = nexus_get_page_url( [ 'conversion-rate-optimization' ] );

$faq_items = [
	[
		'question' => 'Was ist der Unterschied zu einer klassischen WordPress-Agentur?',
		'answer'   => 'Ich verkaufe nicht zuerst Seiten oder Paketlisten. Ich arbeite an WordPress als Growth-Infrastruktur für B2B: Positionierung, technische SEO, privacy-first Measurement und Conversion-Logik als ein System.',
	],
	[
		'question' => 'Arbeiten Sie auch mit bestehenden WordPress-Websites?',
		'answer'   => 'Ja. In vielen Fällen ist kein kompletter Relaunch nötig. Der Einstieg ist bewusst über Diagnose und Priorisierung aufgebaut, damit zuerst die größten Reibungsverluste verschwinden.',
	],
	[
		'question' => 'Ist das eher SEO, Tracking oder CRO?',
		'answer'   => 'In der Praxis immer alles zusammen. Ich greife dort ein, wo diese Ebenen sich gegenseitig blockieren. Genau daraus entsteht später die bessere Lead-Qualität.',
	],
	[
		'question' => 'Brauchen wir danach noch Ads?',
		'answer'   => 'Nicht als Grundmodell. Wenn Fundament, Messbarkeit und Conversion-Pfade stehen, können Ads sinnvoll als Verstärker dienen. Vorher beschleunigen sie oft nur vorhandene Reibung.',
	],
	[
		'question' => 'Sind persönliche Termine in Hannover möglich?',
		'answer'   => 'Ja. Strategie-Workshops, Kick-offs und Reviews sind in Hannover und Umgebung persönlich möglich. Die Zusammenarbeit funktioniert aber genauso sauber remote im gesamten DACH-Raum.',
	],
	[
		'question' => 'Wie startet die Zusammenarbeit?',
		'answer'   => 'Mit dem Growth Audit. Danach ist klar, ob ein tieferer Blueprint sinnvoll ist oder ob kleinere strukturelle Eingriffe bereits genügen.',
	],
];

get_header();
?>

<main id="main" class="site-main">
	<div class="cs-page wp-agentur-page-wrapper" data-track-section="agentur_landing">

		<section id="hero" class="nx-section nx-hero wp-agentur-hero">
			<div class="nx-container">
				<span class="nx-badge nx-badge--gold">WordPress Growth Architect in Hannover</span>
				<h1 class="nx-hero__title">WordPress für B2B, das Anfragen nicht nur anzieht, sondern führt.</h1>
				<p class="nx-hero__subtitle">
					Für Unternehmen aus Hannover und dem DACH-Raum, die aus ihrer WordPress-Präsenz
					ein planbares Anfrage- und Wachstumssystem machen wollen:
					mit klarer Positionierung, technischer SEO, privacy-first Measurement und Conversion-Logik.
				</p>
				<ul class="hero-bullets">
					<li>Diagnose vor Relaunch</li>
					<li>WordPress als Growth-Infrastruktur</li>
					<li>Eigene Anfragen statt Kanalabhängigkeit</li>
				</ul>
				<div class="hero-cta-block" style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem;">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_hero_audit" data-track-category="lead_gen">Audit starten</a>
					<a href="<?php echo esc_url( $cases_url ); ?>" class="nx-btn nx-btn--ghost">Case Studies ansehen</a>
				</div>
			</div>
		</section>

		<section id="proof-bar" class="nx-section wp-agentur-proof">
			<div class="nx-container">
				<div class="nx-grid nx-grid-4 wp-agentur-proof-grid">
					<div class="nx-card nx-card--flat wp-agentur-proof-item">
						<span class="wp-agentur-proof-value">1.750+</span>
						<span class="wp-agentur-proof-label">qualifizierte Leads</span>
					</div>
					<div class="nx-card nx-card--flat wp-agentur-proof-item">
						<span class="wp-agentur-proof-value">-83%</span>
						<span class="wp-agentur-proof-label">CPL</span>
					</div>
					<div class="nx-card nx-card--flat wp-agentur-proof-item">
						<span class="wp-agentur-proof-value">&lt;0.8s</span>
						<span class="wp-agentur-proof-label">LCP auf Kernseiten</span>
					</div>
					<div class="nx-card nx-card--flat wp-agentur-proof-item">
						<span class="wp-agentur-proof-value">8+</span>
						<span class="wp-agentur-proof-label">Jahre B2B-Praxis</span>
					</div>
				</div>
			</div>
		</section>

		<section id="problem" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Warum viele WordPress-Seiten trotz Traffic keine belastbaren Anfragen bringen</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Das Problem ist selten nur Design. Meist fehlen Struktur, Daten und klare Nutzerführung im Zusammenspiel. Dann produziert WordPress zwar Seiten, aber kein System.</p>
					<h3>1. Sichtbarkeit ohne Richtung</h3>
					<p>Es gibt Inhalte, aber keine klare Informationsarchitektur, keine priorisierten Money Pages und keine saubere interne Verbindung zwischen Suchintention und nächstem Schritt. Genau dort greifen <a href="<?php echo esc_url( $seo_url ); ?>">technische SEO</a> und Angebotslogik ineinander.</p>
					<h3>2. Daten ohne Entscheidungswert</h3>
					<p>Tracking ist installiert, aber nicht belastbar. Consent, Events und Attribution erzeugen Rauschen statt Klarheit. Ohne funktionierende Messung ist jede Optimierung eine Vermutung. Deshalb ist <a href="<?php echo esc_url( $ga4_url ); ?>">privacy-first Measurement</a> kein Add-on, sondern Fundament.</p>
					<h3>3. Seiten ohne Conversion-Führung</h3>
					<p>Kontaktformulare am Seitenende sind keine Funnel-Logik. Wenn Proof, CTA-Reihenfolge und Einwandabbau fehlen, verliert die Seite Nachfrage genau in dem Moment, in dem sie wertvoll werden könnte. Dort setzt <a href="<?php echo esc_url( $cro_url ); ?>">Conversion-Architektur</a> an.</p>
				</div>
			</div>
		</section>

		<section id="unterschied" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Was Sie hier bekommen und was bewusst nicht</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Wenn Sie eine Agentur suchen, die einfach eine neue Website liefert, gibt es viele Anbieter. Wenn Sie WordPress als echten Nachfragekanal aufbauen wollen, brauchen Sie eine andere Logik.</p>
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
									<td>WordPress als Anfragesystem aufbauen</td>
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
									<td>Messbarkeit für echte Entscheidungen</td>
								</tr>
								<tr>
									<td>Conversion</td>
									<td>CTA am Ende</td>
									<td>Argumentationsstruktur über die ganze Seite</td>
								</tr>
								<tr>
									<td>Nach Go-Live</td>
									<td>Projekt abgeschlossen</td>
									<td>Gezielte Iteration auf die größten Hebel</td>
								</tr>
							</tbody>
						</table>
					</div>
					<p>Das Ergebnis ist nicht mehr Funktionalität, sondern weniger Reibung im kompletten Nachfrageweg.</p>
				</div>
			</div>
		</section>

		<section id="angebot" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Die sinnvolle Angebotslogik für B2B-WordPress</h2>
				</div>
				<div class="nx-grid nx-grid-3 wp-agentur-process-grid">
					<article class="nx-step">
						<div class="nx-step__number">1</div>
						<h3>Growth Audit</h3>
						<p>Der Einstieg. Wir prüfen, wo Sichtbarkeit, Vertrauen oder Lead-Capture wegbrechen und ob ein tieferer Eingriff wirtschaftlich Sinn ergibt.</p>
					</article>
					<article class="nx-step nx-step--highlight">
						<div class="nx-step__number">2</div>
						<h3>360 Grad Growth Blueprint</h3>
						<p>Der Deep Dive. Ergebnis ist eine priorisierte Roadmap für Positionierung, Informationsarchitektur, Measurement und Conversion-Pfade.</p>
					</article>
					<article class="nx-step">
						<div class="nx-step__number">3</div>
						<h3>WGOS Umsetzung und Retainer</h3>
						<p>Technische Umsetzung, Content-Aufbau und fortlaufende Optimierung in einer Reihenfolge, die Nachfrage robuster und günstiger macht.</p>
					</article>
				</div>
				<div class="wp-btn-wrapper mt-2" style="gap:1rem; flex-wrap:wrap;">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_prozess_audit" data-track-category="lead_gen">Mit dem Audit starten</a>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost">WGOS ansehen</a>
				</div>
			</div>
		</section>

		<section id="fit" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Für wen ich arbeite</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Die Zusammenarbeit passt für B2B-Unternehmen, die WordPress bereits einsetzen oder bewusst als Kernsystem nutzen wollen und deren Website Anfragen liefern soll, nicht nur Präsenz.</p>
					<ul>
						<li>WordPress ist ein echter Geschäftskanal, kein Nebenprojekt.</li>
						<li>Es gibt ein klares Leistungsversprechen und kaufnahe Nachfrage.</li>
						<li>Das Team will Prioritäten statt Aktionismus.</li>
						<li>Messbarkeit und Ownership sind wichtig, nicht nur Optik.</li>
					</ul>
					<p>Nicht passend ist es für Billig-Setups, reine Visitenkarten oder Organisationen, die zehn Einzelmaßnahmen parallel starten wollen.</p>
				</div>
			</div>
		</section>

		<section id="case-study" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Was passiert, wenn die Reihenfolge stimmt</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<h3>Case Study: E3 New Energy</h3>
					<p>Ausgangslage: teuer eingekaufte Leads, unsaubere Datenlage, keine robuste Conversion-Führung nach dem Klick.</p>
					<p>Ansatz: Erst Fundament, dann Aktivierung. Speed, Tracking, Seitenstruktur und Conversion-Pfade wurden geordnet, bevor Skalierung auf dem neuen Setup stattfand.</p>
					<div class="wp-agentur-table-wrap">
						<table class="wp-agentur-table">
							<thead>
								<tr>
									<th>KPI</th>
									<th>Vorher</th>
									<th>Nachher</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Cost per Lead</td>
									<td>150 EUR</td>
									<td>25 EUR</td>
								</tr>
								<tr>
									<td>Qualifizierte Leads</td>
									<td>eingekauft</td>
									<td>1.750+ im System</td>
								</tr>
								<tr>
									<td>Sales-Conversion</td>
									<td>&lt; 2%</td>
									<td>12-15%</td>
								</tr>
								<tr>
									<td>Fazit</td>
									<td>Reibung nach dem Klick</td>
									<td>Mehr Wirkung aus denselben Kanälen</td>
								</tr>
							</tbody>
						</table>
					</div>
					<p><a href="<?php echo esc_url( $cases_url ); ?>" class="cs-internal-link">Weitere Case Studies ansehen</a></p>
				</div>
			</div>
		</section>

		<section id="hannover" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Warum Hannover hier relevant ist und warum es nicht die Hauptbotschaft ist</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Wenn Sie in Hannover oder der Region sitzen, sind persönliche Termine, Workshops und Reviews unkompliziert möglich. Das kann bei komplexeren B2B-Projekten sinnvoll sein.</p>
					<p>Die eigentliche Entscheidung sollte aber nicht lokal, sondern strategisch sein: ob Sie WordPress als echten Nachfragekanal aufbauen wollen. Genau deshalb bleibt die Hauptbotschaft systemisch und nicht lokal-werblich.</p>
					<p><strong>Standort:</strong> Pattensen bei Hannover. <strong>Arbeitsgebiet:</strong> Hannover, Niedersachsen und DACH remote.</p>
				</div>
			</div>
		</section>

		<section id="faq" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Häufige Fragen</h2>
				</div>
				<div class="nx-faq wp-faq">
					<?php foreach ( $faq_items as $item ) : ?>
						<details class="nx-faq__item">
							<summary><?php echo esc_html( $item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="cta-final" class="nx-section">
			<div class="nx-container">
				<div class="nx-cta-box">
					<h2>Prüfen wir Ihren Status quo.</h2>
					<p>Der Growth Audit zeigt, wo Ihre WordPress-Seite Nachfrage verliert und ob ein tieferer Umbau sinnvoll ist.</p>
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_final_audit" data-track-category="lead_gen">Audit starten</a>
					<p class="wp-cta-desc mt-1">Kein Pitch. Klare Einschätzung. Sinnvoller nächster Schritt.</p>
					<p class="wp-cta-desc mb-0"><a href="<?php echo esc_url( $about_url ); ?>">Mehr über meine Arbeitsweise</a></p>
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
