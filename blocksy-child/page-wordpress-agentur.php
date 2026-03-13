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
$seo_url   = nexus_get_page_url( [ 'wordpress-seo-hannover', 'seo' ] );
$measurement_url = nexus_get_wgos_asset_anchor_url( 'tracking-audit' );
$cro_url   = nexus_get_page_url( [ 'conversion-rate-optimization' ] );

$hero_bullets = [
	'Diagnose vor Umsetzung',
	'Angebotsseiten, Datenebene und KPI-Klarheit statt Aktionismus',
	'Ownership statt Blackbox',
];

$proof_metrics = [
	[
		'value' => '3.000+',
		'label' => 'qualifizierte Leads in 18 Monaten',
	],
	[
		'value' => '-83%',
		'label' => 'Kosten pro Lead',
	],
	[
		'value' => '<0.8s',
		'label' => 'LCP auf Angebotsseiten',
	],
	[
		'value' => '8+',
		'label' => 'Jahre B2B- und Performance-Praxis',
	],
];

$system_map = [
	'section_id' => 'systembild',
	'kicker'     => 'System in der Praxis',
	'title'      => 'Was Sie hier nicht nur beauftragen, sondern aufbauen',
	'intro'      => 'Nicht einfach ein Webprojekt, sondern vier Ebenen, die im Alltag zusammenarbeiten: die sichtbare Website, die Datenebene, ein verständliches Kundencockpit und eine Umgebung, die kontrolliert weiterentwickelt werden kann.',
	'summary'    => [
		'Angebotsseiten mit klarer Führung',
		'Conversion-Signale statt Reporting-Rauschen',
		'Prioritäten statt Dashboard-Theater',
		'Kontrollierte Weiterentwicklung',
	],
	'layers'     => [
		[
			'label'  => 'Ebene 1',
			'title'  => 'Sichtbare Website',
			'text'   => 'Die öffentliche Ebene, auf der Sichtbarkeit, Vertrauen und Anfrageführung tatsächlich entschieden werden.',
			'items'  => [
				'Startseite mit klarer Positionierung',
				'Angebotsseiten und Money Pages',
				'Case- und Proof-Seiten',
				'Klare Wege zum nächsten Schritt',
			],
			'result' => 'Besucher verstehen schneller, ob Sie relevant sind und wo der nächste sinnvolle Schritt liegt.',
		],
		[
			'label'  => 'Ebene 2',
			'title'  => 'Mess- und Datenebene',
			'text'   => 'Die Ebene, die aus Bauchgefühl belastbare Signale macht, statt nur ein weiteres Reporting zu erzeugen.',
			'items'  => [
				'Consent und Tracking sauber abgestimmt',
				'Events und Conversion-Signale entlang des Anfragepfads',
				'SEO- und Performance-Indikatoren',
				'Sauberes Setup statt Datenrauschen',
			],
			'result' => 'Sie sehen, welche Seiten tragen, wo Anfragen abbrechen und welche Maßnahmen echten Einfluss haben.',
		],
		[
			'label'  => 'Ebene 3',
			'title'  => 'Kundencockpit und Prioritäten',
			'text'   => 'Die Übersetzung von Daten in geschäftlich brauchbare Klarheit für Marketing, Vertrieb und Geschäftsführung.',
			'items'  => [
				'Lead-Qualität und Herkunft nachvollziehbar machen',
				'Prioritäten für die nächsten 30 bis 90 Tage',
				'Reibungsverluste auf wichtigen Seiten sichtbar machen',
				'Klarere KPI-Sicht statt Tool-Silo',
			],
			'result' => 'Weniger Reporting, mehr Orientierung für Reviews, Entscheidungen und die nächsten sinnvollen Maßnahmen.',
		],
		[
			'label'  => 'Ebene 4',
			'title'  => 'Kontrollierte Weiterentwicklung',
			'text'   => 'Die operative Basis, damit WordPress nicht bei jedem Eingriff fragiler, teurer oder undurchsichtiger wird.',
			'items'  => [
				'Saubere Codebasis',
				'GitHub und Versionierung',
				'Kontrollierter Stack ohne unnötige Abhängigkeiten',
				'Wartbare Umgebung mit Ownership',
			],
			'result' => 'Änderungen bleiben nachvollziehbar. Sie kaufen kein Blackbox-Setup, sondern ein System, das weitergeführt werden kann.',
		],
	],
	'aside'      => [
		'eyebrow' => 'Warum das kaufnah relevant ist',
		'title'   => 'Gerade lokale B2B-Anfragen scheitern selten nur an der Optik.',
		'text'    => 'Entscheidend ist, ob Angebotsseiten, Datensignale, Proof und der nächste Schritt sauber zusammenspielen. Genau daraus entsteht eine Website, die nicht nur besucht, sondern operativ nutzbar wird.',
		'items'   => [
			'Schneller klar, welche Seiten Nachfrage erzeugen und welche nur Fläche belegen',
			'Bessere Gesprächsgrundlage für Marketing, Vertrieb und Geschäftsführung',
			'Weniger Reibung zwischen erstem Besuch und qualifizierter Anfrage',
			'Keine unnötigen Relaunch-Schleifen, wenn Diagnose und Prioritäten stimmen',
		],
		'actions' => [
			[
				'url'      => $audit_url,
				'label'    => 'Growth Audit starten',
				'class'    => 'nx-btn nx-btn--primary',
				'action'   => 'cta_agentur_system_audit',
				'category' => 'lead_gen',
			],
			[
				'url'      => $wgos_url,
				'label'    => 'WGOS verstehen',
				'class'    => 'nx-btn nx-btn--ghost',
				'action'   => 'cta_agentur_system_wgos',
				'category' => 'navigation',
			],
		],
		'note'    => 'Der Growth Audit zeigt, welche dieser vier Ebenen bei Ihnen zuerst zählt.',
	],
];

$fit_items = [
	'WordPress ist ein echter Geschäftskanal und nicht nur ein Nebenprojekt.',
	'Es gibt ein belastbares Leistungsversprechen und kaufnahe Nachfrage.',
	'Sie wollen Prioritäten für Angebotsseiten, Tracking, Performance und Conversion statt Maßnahmensammlung.',
	'Messbarkeit, Ownership und kontrollierte Weiterentwicklung sind wichtiger als reine Kosmetik.',
];

$local_cards = [
	[
		'title' => 'Nähe, wenn sie echten Wert stiftet',
		'text'  => 'Kick-offs, Strategieworkshops und Review-Termine sind in Hannover und der Region unkompliziert persönlich möglich.',
		'items' => [
			'Persönliche Abstimmungen bei komplexeren B2B-Themen',
			'Workshops mit Marketing, Vertrieb und Geschäftsführung an einem Tisch',
			'Schnelle Reviews ohne unnötigen Reiseaufwand',
		],
	],
	[
		'title' => 'Entscheidend bleibt die Systemqualität',
		'text'  => 'Die eigentliche Entscheidung sollte nicht auf Postleitzahl beruhen, sondern darauf, ob Ihre WordPress-Seite als Nachfrage-System gebaut und weiterentwickelt wird.',
		'items' => [
			'Klare Reihenfolge statt Aktionismus',
			'Messbare Signale statt Vermutungen',
			'Ownership statt Blackbox',
		],
	],
];

$faq_items = [
	[
		'question' => 'Was ist der Unterschied zu einer klassischen WordPress-Agentur?',
		'answer'   => 'Ich liefere nicht nur Seiten, sondern ordne Angebotsseiten, technische SEO, privacy-first Measurement und Conversion-Führung zu einem WordPress-System. Die Reihenfolge ist Teil der Leistung, nicht nur die Umsetzung.',
	],
	[
		'question' => 'Ist das nur Webdesign mit neuen Worten?',
		'answer'   => 'Nein. Design ist nur ein sichtbarer Teil. Entscheidend ist, ob Seitenrollen, Proof, Tracking, CTA-Logik und Weiterentwicklung sauber verbunden sind. Genau daran scheitern viele B2B-Seiten trotz ordentlicher Optik.',
	],
	[
		'question' => 'Brauchen wir dafür wirklich einen Audit?',
		'answer'   => 'Ja, wenn Sie nicht die falsche Maßnahme einkaufen wollen. Der Audit verhindert Aktionismus: erst Reibung verstehen, dann entscheiden, ob Relaunch, SEO-Arbeit, Measurement-Fix oder Conversion-Überarbeitung wirklich nötig sind.',
	],
	[
		'question' => 'Arbeiten Sie auch mit bestehenden WordPress-Websites?',
		'answer'   => 'Ja. Oft ist kein kompletter Neuaufbau nötig. Häufig reichen priorisierte Eingriffe an Money Pages, Datenebene, Proof oder technischer Reibung, bevor größer gedacht werden muss.',
	],
	[
		'question' => 'Ist das eher SEO, Tracking, CRO oder Relaunch?',
		'answer'   => 'Die Trennung klingt sauberer als die Realität. In der Praxis hängen Sichtbarkeit, Messbarkeit, Nutzerführung und technisches Fundament direkt zusammen. Ich arbeite an der Verbindung statt an isolierten Gewerken.',
	],
	[
		'question' => 'Ist das für uns zu groß oder zu technisch?',
		'answer'   => 'Nicht, wenn WordPress ein echter Geschäftskanal ist. Der Einstieg bleibt bewusst schlank: Audit, klare Prioritäten, dann nur die nächsten sinnvollen Schritte. Kein aufgeblasenes Transformationsprojekt.',
	],
	[
		'question' => 'Sind persönliche Termine in Hannover möglich?',
		'answer'   => 'Ja. Strategie-Workshops, Kick-offs und Reviews sind in Hannover und Umgebung persönlich möglich. Die Zusammenarbeit funktioniert aber genauso sauber remote im gesamten DACH-Raum.',
	],
];

get_header();
?>

<main id="main" class="site-main">
	<div class="cs-page wp-agentur-page-wrapper" data-track-section="agentur_landing">

		<section id="hero" class="nx-section nx-hero wp-agentur-hero">
			<div class="nx-container">
				<span class="nx-badge nx-badge--gold">WordPress Agentur Hannover für B2B</span>
				<h1 class="nx-hero__title">WordPress Agentur Hannover für B2B-Websites, die Sichtbarkeit, Daten und Anfragen zusammenführen.</h1>
				<p class="nx-hero__subtitle">
					Für Unternehmen aus Hannover und der Region, die mit WordPress mehr wollen als einen Relaunch:
					klare Angebotsseiten, belastbare Messung, bessere Lead-Führung und eine Umgebung,
					die kontrolliert weiterentwickelt werden kann.
				</p>
				<ul class="hero-bullets">
					<?php foreach ( $hero_bullets as $hero_bullet ) : ?>
						<li><?php echo esc_html( $hero_bullet ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="hero-cta-block wp-agentur-actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_hero_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<a href="<?php echo esc_url( $cases_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_agentur_hero_results" data-track-category="trust">Ergebnisse ansehen</a>
				</div>
				<p class="wp-agentur-hero-support">
					Workshops und Reviews in Hannover möglich. Entscheidend bleibt die Systemqualität dahinter.
					<a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_agentur_hero_wgos" data-track-category="navigation">WGOS verstehen</a>
				</p>
			</div>
		</section>

		<section id="proof-bar" class="nx-section wp-agentur-proof">
			<div class="nx-container">
				<div class="nx-grid nx-grid-4 wp-agentur-proof-grid">
					<?php foreach ( $proof_metrics as $proof_metric ) : ?>
						<div class="nx-card nx-card--flat wp-agentur-proof-item">
							<span class="wp-agentur-proof-value"><?php echo esc_html( $proof_metric['value'] ); ?></span>
							<span class="wp-agentur-proof-label"><?php echo esc_html( $proof_metric['label'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="problem" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Warum viele WordPress-Seiten trotz Sichtbarkeit keine belastbaren Anfragen liefern</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Das Problem ist selten nur Design. Meist fehlt die Verbindung zwischen Angebotsseiten, sauberer Messung, Proof und dem nächsten sinnvollen Schritt. Dann produziert WordPress zwar Seitenaufrufe, aber kein steuerbares Nachfrage-System.</p>
					<h3>1. Sichtbarkeit ohne Richtung</h3>
					<p>Es gibt Inhalte, aber keine klare Informationsarchitektur, keine priorisierten Money Pages und keine saubere Verbindung zwischen Suchintention, Angebotsseite und nächstem Schritt. Genau dort greifen <a href="<?php echo esc_url( $seo_url ); ?>">technische SEO</a> und Angebotslogik ineinander.</p>
					<h3>2. Daten ohne Entscheidungswert</h3>
					<p>Tracking ist installiert, aber nicht belastbar. Consent, Events und Attribution erzeugen Rauschen statt Klarheit. Dann sehen Sie zwar Zahlen, aber nicht, welche Seite trägt, wo Anfragen abbrechen oder welche Quelle nur Budget verbrennt. Deshalb ist <a href="<?php echo esc_url( $measurement_url ); ?>">privacy-first Measurement</a> kein Add-on, sondern Fundament.</p>
					<h3>3. Seiten ohne Conversion-Führung</h3>
					<p>Kontaktformulare am Seitenende sind keine Funnel-Logik. Wenn Proof, CTA-Reihenfolge und Einwandabbau fehlen, verliert die Seite Nachfrage genau in dem Moment, in dem sie wertvoll werden könnte. Dort setzt <a href="<?php echo esc_url( $cro_url ); ?>">Conversion-Architektur</a> an: auf Seitenebene, nicht erst im Formular.</p>
				</div>
			</div>
		</section>

		<section id="unterschied" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Klassische WordPress-Agentur vs. Growth-Architect-Logik</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Wenn Sie einfach eine neue Website einkaufen wollen, gibt es viele Anbieter. Wenn Sie WordPress als echten Nachfragekanal mit sauberer Datenlage und kontrollierter Weiterentwicklung aufbauen wollen, brauchen Sie eine andere Logik.</p>
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
					<p>Die Differenz liegt nicht in mehr Output, sondern in weniger Reibung, klareren Signalen und besseren Entscheidungen im kompletten Nachfrageweg.</p>
				</div>
			</div>
		</section>

		<?php
		set_query_var( 'service_system_map', $system_map );
		get_template_part( 'template-parts/service-system-map' );
		set_query_var( 'service_system_map', [] );
		?>

		<section id="angebot" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Der sinnvolle Einstieg für B2B in Hannover ist nicht der Relaunch, sondern der Audit</h2>
				</div>
				<div class="nx-grid nx-grid-3 wp-agentur-process-grid">
					<article class="nx-step">
						<div class="nx-step__number">1</div>
						<h3>Growth Audit</h3>
						<p>Der Einstieg. Sie bekommen eine erste Einschätzung, wo Angebotsseiten, Datenlage, CTA-Führung oder technische Reibung aktuell bremsen.</p>
					</article>
					<article class="nx-step nx-step--highlight">
						<div class="nx-step__number">2</div>
						<h3>Priorisierung im direkten Austausch</h3>
						<p>Danach ist klar, ob zuerst Seitenlogik, Measurement, Proof, Performance oder ein größerer Umbau zählt. Der nächste Schritt entsteht erst nach Rückmeldung und persönlichem Kontakt.</p>
					</article>
					<article class="nx-step">
						<div class="nx-step__number">3</div>
						<h3>WGOS Umsetzung und Retainer</h3>
						<p>Erst dann werden die passenden Bausteine aufgebaut oder weiterentwickelt: Money Pages, Datenebene, Proof-Struktur, technisches Fundament und kontrollierter Betrieb.</p>
					</article>
				</div>
				<div class="wp-agentur-actions wp-agentur-actions--center mt-2">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_prozess_audit" data-track-category="lead_gen">Mit dem Growth Audit starten</a>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_agentur_prozess_wgos" data-track-category="navigation">WGOS ansehen</a>
				</div>
			</div>
		</section>

		<section id="fit" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Woran Sie merken, ob diese Zusammenarbeit passt</h2>
				</div>
				<div class="nx-prose wp-agentur-prose">
					<p>Die Zusammenarbeit passt für B2B-Unternehmen, die WordPress bereits einsetzen oder bewusst als Kernsystem nutzen wollen und deren Website Anfragen liefern soll, nicht nur Präsenz.</p>
					<ul>
						<?php foreach ( $fit_items as $fit_item ) : ?>
							<li><?php echo esc_html( $fit_item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<p>Nicht passend ist es für Billig-Setups, reine Visitenkarten oder Organisationen, die zehn Einzelmaßnahmen parallel starten wollen, ohne Reihenfolge, Ownership oder saubere Messung mitzudenken.</p>
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
					<p>Ansatz: Erst Fundament, dann Aktivierung. Speed, Tracking, Seitenstruktur und Conversion-Pfade wurden geordnet, bevor Skalierung auf dem neuen Setup stattfand. Das Ergebnis war nicht nur eine bessere Website, sondern ein sauber geführtes Nachfrage-System.</p>
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
									<td>Qualifizierte Leads im System</td>
									<td>eingekauft</td>
									<td>1.750+ im System</td>
								</tr>
								<tr>
									<td>Sales-Conversion</td>
									<td>&lt; 2%</td>
									<td>12&nbsp;%</td>
								</tr>
								<tr>
									<td>Fazit</td>
									<td>Reibung nach dem Klick</td>
									<td>Mehr Wirkung aus denselben Kanälen</td>
								</tr>
							</tbody>
						</table>
					</div>
					<p><a href="<?php echo esc_url( $cases_url ); ?>" class="cs-internal-link" data-track-action="cta_agentur_case_results" data-track-category="trust">Weitere Ergebnisse ansehen</a></p>
				</div>
			</div>
		</section>

		<section id="hannover" class="nx-section">
			<div class="nx-container">
				<div class="nx-section-header">
					<h2 class="nx-headline-section">Hannover ist ein Vorteil, aber nicht der eigentliche Grund</h2>
				</div>
				<div class="nx-grid nx-grid-2 wp-agentur-local-grid">
					<?php foreach ( $local_cards as $local_card ) : ?>
						<article class="wp-agentur-local-card nx-card">
							<h3><?php echo esc_html( $local_card['title'] ); ?></h3>
							<p><?php echo esc_html( $local_card['text'] ); ?></p>
							<ul>
								<?php foreach ( $local_card['items'] as $local_item ) : ?>
									<li><?php echo esc_html( $local_item ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>
				<p class="wp-agentur-location-note"><strong>Standort:</strong> Pattensen bei Hannover. <strong>Arbeitsgebiet:</strong> Hannover, Niedersachsen und DACH remote.</p>
				<p class="wp-agentur-location-note wp-agentur-location-note--muted">Lokale Nähe ist hilfreich. Die Entscheidung sollte trotzdem an Systemqualität, Messbarkeit und operativer Klarheit hängen.</p>
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
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_agentur_final_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<p class="wp-cta-desc mt-1">Kein Pitch. Klare Priorisierung. Sinnvoller nächster Schritt.</p>
					<p class="wp-cta-desc mb-0"><a href="<?php echo esc_url( $about_url ); ?>" data-track-action="cta_agentur_final_about" data-track-category="navigation">Mehr über meine Arbeitsweise</a></p>
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
