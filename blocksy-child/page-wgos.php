<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System - strategische Systemseite
 *
 * Content bleibt template-driven; SEO-Meta liegt zentral in inc/seo-meta.php.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url    = nexus_get_audit_url();
$calendar_url = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : 'https://cal.com/hasim/30min';
$cases_url    = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
$asset_hub_url = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : home_url( '/wgos-systemlandkarte/' );
$page_url     = get_permalink( get_queried_object_id() );

if ( ! $page_url ) {
	$page_url = home_url( '/wordpress-growth-operating-system/' );
}

$nav_items = [
	[
		'id'    => 'problem',
		'label' => 'Problem',
	],
	[
		'id'    => 'system',
		'label' => 'System',
	],
	[
		'id'    => 'module',
		'label' => 'Kernbereiche',
	],
	[
		'id'    => 'workflow',
		'label' => 'Ablauf',
	],
	[
		'id'    => 'proof',
		'label' => 'Wirkung',
	],
	[
		'id'    => 'audit',
		'label' => 'Audit',
	],
	[
		'id'    => 'pakete',
		'label' => 'Pakete',
	],
	[
		'id'    => 'faq',
		'label' => 'FAQ',
	],
];

$hero_summary = [
	[
		'term'        => 'Was ist WGOS?',
		'description' => 'Ein strukturiertes Wachstumssystem fuer WordPress-Websites.',
	],
	[
		'term'        => 'Fuer wen?',
		'description' => 'Fuer Unternehmen mit bestehender Website und ernsthaftem Nachfragepotenzial.',
	],
	[
		'term'        => 'Welches Problem?',
		'description' => 'Fehlende Reihenfolge zwischen Strategie, Technik, Daten, Sichtbarkeit und Anfrage.',
	],
	[
		'term'        => 'Was ist anders?',
		'description' => 'Kein Leistungsbaukasten, sondern ein zusammenhaengendes Nachfrage-System.',
	],
];

$problem_points = [
	'Es kommt Traffic, aber kaum qualifizierte Anfragen.',
	'SEO, Tracking und Inhalte laufen nebeneinander her.',
	'Entscheidungen basieren auf unklaren oder falschen Daten.',
	'Seiten sehen ordentlich aus, fuehren aber nicht konsequent zur Anfrage.',
	'Massnahmen werden umgesetzt, ohne klare Reihenfolge und ohne gemeinsames Ziel.',
];

$system_nodes = [
	[
		'step'  => '01',
		'title' => 'Strategie',
		'text'  => 'Setzt Zielbild, Angebotslogik und Prioritaeten.',
	],
	[
		'step'  => '02',
		'title' => 'Fundament',
		'text'  => 'Sichert Stabilitaet, Performance und technische Tragfaehigkeit.',
	],
	[
		'step'  => '03',
		'title' => 'Messbarkeit',
		'text'  => 'Macht Entscheidungen entlang des Anfragepfads belastbar.',
	],
	[
		'step'  => '04',
		'title' => 'Sichtbarkeit',
		'text'  => 'Baut relevante Nachfrage auf einer sauberen Basis auf.',
	],
	[
		'step'  => '05',
		'title' => 'Conversion',
		'text'  => 'Fuehrt Besucher klarer in Richtung Anfrage.',
	],
	[
		'step'  => '06',
		'title' => 'Anfragen',
		'text'  => 'Sind Ergebnis des Systems, nicht eines Einzeltricks.',
	],
];

$sequence_steps = [
	[
		'title' => 'Stabilitaet zuerst',
		'text'  => 'WordPress, Performance und Angebotsgrundlage muessen tragen, bevor Wachstum sinnvoll skaliert.',
	],
	[
		'title' => 'Messbarkeit sauber setzen',
		'text'  => 'Nur mit klaren Daten lassen sich Prioritaeten, Engpaesse und Wirkung sauber beurteilen.',
	],
	[
		'title' => 'Nutzerfuehrung ordnen',
		'text'  => 'Angebotslogik, Proof und CTA-Struktur werden vor weiteren Reichweitenhebeln sauber gebaut.',
	],
	[
		'title' => 'Sichtbarkeit gezielt ausbauen',
		'text'  => 'SEO und Inhalte werden dann ausgebaut, wenn das System sie auch in Nachfrage uebersetzen kann.',
	],
	[
		'title' => 'Weiterentwicklung steuern',
		'text'  => 'Optimierung folgt auf echte Signale, nicht auf Aktionismus oder Vermutungen.',
	],
];

$core_areas = [
	[
		'number'  => '01',
		'title'   => 'Strategie',
		'intro'   => 'Sie definiert, wie die Website Nachfrage aufnehmen und weiterfuehren soll.',
		'bullets' => [
			'Angebotslogik und Positionierung schaerfen',
			'Engpaesse und Hebel sauber priorisieren',
			'Seitenrollen und Zielpfade definieren',
			'Roadmap statt losem Massnahmenstapel',
		],
	],
	[
		'number'  => '02',
		'title'   => 'Technisches Fundament',
		'intro'   => 'Es sorgt dafuer, dass WordPress traegt, statt Wachstum auszubremsen.',
		'bullets' => [
			'Performance und Core Web Vitals stabilisieren',
			'Sicherheits- und Update-Logik absichern',
			'Technische Reibung fuer Nutzer und Pflege reduzieren',
			'Eine tragfaehige Basis fuer Sichtbarkeit und Conversion schaffen',
		],
	],
	[
		'number'  => '03',
		'title'   => 'Messbarkeit',
		'intro'   => 'Erst saubere Daten machen gute Entscheidungen moeglich.',
		'bullets' => [
			'Tracking entlang des Anfragepfads sauber aufsetzen',
			'Consent, Signale und Datenqualitaet abstimmen',
			'Relevante KPIs statt Reporting-Rauschen definieren',
			'Grundlage fuer Priorisierung und Optimierung schaffen',
		],
	],
	[
		'number'  => '04',
		'title'   => 'Sichtbarkeit',
		'intro'   => 'Sichtbarkeit folgt auf Klarheit, Substanz und technische Ordnung.',
		'bullets' => [
			'Wichtige Suchintentionen und Angebotsseiten priorisieren',
			'Technische SEO und Seitenstruktur zusammenfuehren',
			'Inhalte entlang echter Nachfrage entwickeln',
			'Sichtbarkeit auf kaufnahe Themen konzentrieren',
		],
	],
	[
		'number'  => '05',
		'title'   => 'Conversion',
		'intro'   => 'Besucher muessen verstehen, vertrauen und handeln koennen.',
		'bullets' => [
			'Nutzerfuehrung und Seitenhierarchie klaeren',
			'Proof frueher und sauberer platzieren',
			'CTA-Logik und Formulare entschlacken',
			'Reibung zwischen Besuch und Anfrage senken',
		],
	],
	[
		'number'  => '06',
		'title'   => 'Weiterentwicklung',
		'intro'   => 'Das System wird nicht fertig, sondern kontrolliert besser.',
		'bullets' => [
			'Wirkung regelmaessig auswerten',
			'Prioritaeten auf Basis echter Signale anpassen',
			'Neue Hebel erst nach sauberer Diagnose anfassen',
			'Das System Schritt fuer Schritt ausbauen',
		],
	],
];

$workflow_steps = [
	[
		'number' => '01',
		'title'  => 'Analyse',
		'text'   => 'Ausgangslage, Engpaesse und Potenziale der WordPress-Seite werden sichtbar gemacht.',
	],
	[
		'number' => '02',
		'title'  => 'Priorisierung',
		'text'   => 'Die naechsten Schritte werden nach Wirkung und Reihenfolge sortiert.',
	],
	[
		'number' => '03',
		'title'  => 'Umsetzung',
		'text'   => 'Es wird gebaut, was fuer das System gerade wirklich sinnvoll ist.',
	],
	[
		'number' => '04',
		'title'  => 'Messung',
		'text'   => 'Wirkung und Reibung werden entlang klarer Signale beobachtet.',
	],
	[
		'number' => '05',
		'title'  => 'Optimierung',
		'text'   => 'Das System wird fortlaufend nachgeschaerft statt immer neu gestartet.',
	],
];

$difference_cards = [
	[
		'title'  => 'Klassische Umsetzung',
		'points' => [
			'Leistungen werden einzeln beauftragt und nebeneinander umgesetzt.',
			'SEO, Tracking und Conversion folgen oft verschiedenen Logiken.',
			'Erfolg haengt stark von Einzelaktionen statt vom Gesamtsystem ab.',
			'Die Website bleibt eher digitale Praesenz als Nachfrage-Struktur.',
		],
	],
	[
		'title'  => 'WGOS',
		'points' => [
			'Alle Bausteine werden ueber ein gemeinsames Ziel geordnet.',
			'Die Reihenfolge ist Teil der Leistung, nicht nur die Umsetzung.',
			'Messbarkeit und Nutzerfuehrung gehoeren zum Fundament.',
			'Die Website entwickelt sich zu einem strukturierten Nachfrage-System.',
		],
	],
];

$fit_items = [
	'Es gibt bereits eine Website, aber sie ist strategisch zu schwach aufgebaut.',
	'Anfragen bleiben trotz solider Substanz hinter dem Potenzial zurueck.',
	'SEO, Tracking und Inhalte sind vorhanden, aber nicht sauber verbunden.',
	'Es laufen zu viele Einzelmassnahmen und zu wenig klare Prioritaeten.',
];

$not_fit_items = [
	'Wenn nur eine schnelle Einzelmassnahme ohne strategischen Kontext gesucht wird.',
	'Wenn die Website ausschliesslich als digitale Visitenkarte gedacht ist.',
	'Wenn keine Bereitschaft fuer Messung, Priorisierung und saubere Reihenfolge besteht.',
];

$proof_metrics = [
	[
		'value'   => '1.750+',
		'label'   => 'qualifizierte B2B-Leads in einem aufgebauten System',
		'context' => 'als Ergebnis sauber verbundener Seiten, Daten und Nachfragepfade',
	],
	[
		'value'   => '-83%',
		'label'   => 'Kosten pro Lead nach besserem Fundament und sauberer Messung',
		'context' => 'weil Sichtbarkeit und Conversion nicht mehr gegeneinander gearbeitet haben',
	],
	[
		'value'   => '98/100',
		'label'   => 'Mobile Performance auf Kernseiten nach technischer Bereinigung',
		'context' => 'als Grundlage fuer Nutzererlebnis, SEO und Conversion',
	],
];

$impact_items = [
	'klarere Positionierung',
	'bessere technische Grundlage',
	'sauberere Daten',
	'bessere Sichtbarkeit',
	'staerkere Seiten',
	'hoehere Anfragewahrscheinlichkeit',
];

$audit_outcomes = [
	'Ein klares Bild von Fundament, Engpaessen und Systemluecken.',
	'Eindeutige Prioritaeten statt weiterer digitaler Baustellen.',
	'Eine belastbare Reihenfolge fuer die naechsten 90 Tage.',
];

$packages = [
	[
		'name'     => 'Fundament',
		'tagline'  => 'Grundlage, Messbarkeit und Stabilitaet ordnen',
		'price'    => 'ab 1.500 EUR',
		'credits'  => '30 Credits / Monat',
		'featured' => false,
		'features' => [
			'3 Monate Fokus auf Technik, Tracking und Priorisierung',
			'1 Strategietermin pro Monat',
			'Roadmap fuer Fundament, Messbarkeit und erste Conversion-Bremsen',
			'Monatlicher Review mit klaren Entscheidungen',
		],
		'ideal'    => 'Sinnvoll, wenn die Website zuerst tragfaehig und messbar werden muss.',
	],
	[
		'name'     => 'Systemaufbau',
		'tagline'  => 'Sichtbarkeit und Conversion auf saubere Basis setzen',
		'price'    => 'ab 2.800 EUR',
		'credits'  => '60 Credits / Monat',
		'featured' => true,
		'features' => [
			'6 Monate fuer Reihenfolge, Sichtbarkeit und Conversion',
			'2 Strategietermine pro Monat',
			'Ausbau von Angebotsseiten, SEO-Struktur und Nutzerfuehrung',
			'Regelmaessige Review- und Priorisierungsschleifen',
		],
		'ideal'    => 'Sinnvoll, wenn aus einer Website ein belastbares Nachfrage-System werden soll.',
	],
	[
		'name'     => 'Weiterentwicklung',
		'tagline'  => 'System kontrolliert ausbauen und weiter nachschaerfen',
		'price'    => 'ab 4.500 EUR',
		'credits'  => '100+ Credits / Monat',
		'featured' => false,
		'features' => [
			'12 Monate fuer kontinuierliche Systempflege und Ausbau',
			'Woechentlicher Strategie-Slot',
			'Weiterentwicklung von Reporting, Automationen und Engpass-Themen',
			'Laufende Priorisierung auf Basis echter Signale',
		],
		'ideal'    => 'Sinnvoll, wenn Fundament und Kernlogik stehen und das System weiter wachsen soll.',
	],
];

$credit_examples = [
	[
		'asset'   => 'CWV Optimierung',
		'focus'   => 'Technisches Fundament',
		'credits' => '15',
	],
	[
		'asset'   => 'sGTM Setup',
		'focus'   => 'Messbarkeit',
		'credits' => '15',
	],
	[
		'asset'   => 'Technical SEO Audit',
		'focus'   => 'Sichtbarkeit',
		'credits' => '10',
	],
	[
		'asset'   => 'Pillar Page',
		'focus'   => 'Sichtbarkeit',
		'credits' => '25',
	],
	[
		'asset'   => 'Landing Page (Neu)',
		'focus'   => 'Conversion',
		'credits' => '20',
	],
];

$guarantee_points = [
	'Klare Priorisierung statt blinder Umsetzungslisten.',
	'Volle Ownership von Code, Inhalten, Tracking und Zugaengen.',
	'Transparente Entscheidungen statt Black-Box-Retainer.',
];

$faq_items = [
	[
		'question' => 'Fuer wen ist das WGOS gebaut?',
		'answer'   => 'Fuer Unternehmen mit bestehender WordPress-Website, die aus ihrer Seite mehr als Praesenz machen wollen: naemlich ein strukturiertes System fuer Nachfrage, Sichtbarkeit und Anfragen.',
	],
	[
		'question' => 'Brauche ich davor einen Relaunch?',
		'answer'   => 'In vielen Faellen nein. Oft fehlt nicht zuerst ein neuer Look, sondern eine saubere Reihenfolge zwischen Fundament, Daten, Sichtbarkeit und Conversion.',
	],
	[
		'question' => 'Ist das eher SEO, Tracking oder Conversion?',
		'answer'   => 'In der Praxis ist es genau die Verbindung dieser Ebenen. WGOS ordnet sie so, dass sie auf ein gemeinsames Ziel hinarbeiten, statt nebeneinander zu laufen.',
	],
	[
		'question' => 'Warum beginnt alles mit dem Growth Audit?',
		'answer'   => 'Weil die richtige Reihenfolge nie pauschal ist. Der Audit zeigt, wo das System traegt, wo es bricht und was zuerst sinnvoll ist.',
	],
	[
		'question' => 'Warum Credits statt Stunden?',
		'answer'   => 'Credits machen Prioritaeten, Umfang und Systemlogik sichtbarer. Sie kaufen keine diffuse Zeit, sondern klar bewertete Bausteine innerhalb eines strukturierten Rahmens.',
	],
	[
		'question' => 'Bleibt das System nach der Zusammenarbeit bei uns?',
		'answer'   => 'Ja. Code, Inhalte, Setups und Zugaenge bleiben bei Ihnen. WGOS ist auf Ownership gebaut, nicht auf Abhaengigkeit.',
	],
];

$faq_schema = [
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'@id'        => trailingslashit( $page_url ) . '#faq',
	'url'        => $page_url,
	'inLanguage' => 'de',
	'publisher'  => [
		'@id' => home_url( '/#organization' ),
	],
	'mainEntity' => [],
];

foreach ( $faq_items as $faq_item ) {
	$faq_schema['mainEntity'][] = [
		'@type'          => 'Question',
		'name'           => $faq_item['question'],
		'acceptedAnswer' => [
			'@type' => 'Answer',
			'text'  => $faq_item['answer'],
		],
	];
}
?>

<main id="main" class="site-main">
	<div class="wgos-wrapper">

		<nav class="wgos-smart-nav" id="wgos-nav" aria-label="WGOS Seitennavigation">
			<ul>
				<?php foreach ( $nav_items as $nav_item ) : ?>
					<li>
						<a href="#<?php echo esc_attr( $nav_item['id'] ); ?>">
							<span class="wgos-nav-dot"></span>
							<span class="wgos-nav-text"><?php echo esc_html( $nav_item['label'] ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<section class="wgos-hero">
			<div class="wgos-container">
				<div class="wgos-hero-grid">
					<div class="wgos-hero-copy">
						<span class="wgos-kicker">WordPress Wachstumssystem</span>
						<h1 class="wgos-hero__title">Aus Websites werden Nachfrage-Systeme.</h1>
						<p class="wgos-hero__subtitle">Das WordPress Growth Operating System verbindet Strategie, SEO, Tracking, Performance und Conversion zu einem klaren System - damit aus Ihrer WordPress-Website nicht nur eine schoene Praesenz, sondern ein verlaesslicher Anfragemotor wird.</p>

						<ul class="wgos-hero__bullets">
							<li>Klare Reihenfolge statt digitalem Aktionismus</li>
							<li>Messbare Entwicklung statt Vermutungen</li>
							<li>Ein System, das Ihnen gehoert</li>
						</ul>

						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
							<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespraech vereinbaren</a>
						</div>

						<p class="wgos-hero__microcopy">Keine leeren Versprechen. Erst Diagnose, dann Prioritaeten, dann saubere Umsetzung.</p>
					</div>

					<aside class="wgos-hero-card" aria-label="WGOS in Kurzform">
						<span class="wgos-principle-kicker">WGOS in Kurzform</span>
						<dl class="wgos-hero-card__list">
							<?php foreach ( $hero_summary as $summary_item ) : ?>
								<div class="wgos-hero-card__row">
									<dt><?php echo esc_html( $summary_item['term'] ); ?></dt>
									<dd><?php echo esc_html( $summary_item['description'] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>
					</aside>
				</div>

				<div class="wgos-trust-strip" aria-label="Wirkungsbeispiele">
					<div class="wgos-trust-item">
						<span class="wgos-trust-value">1.750+</span>
						<span class="wgos-trust-label">qualifizierte Leads in einem aufgebauten System</span>
					</div>
					<div class="wgos-trust-item">
						<span class="wgos-trust-value">-83%</span>
						<span class="wgos-trust-label">Kosten pro Lead nach sauberer Reihenfolge</span>
					</div>
					<div class="wgos-trust-item">
						<span class="wgos-trust-value">98/100</span>
						<span class="wgos-trust-label">Mobile Performance auf Kernseiten</span>
					</div>
				</div>
			</div>
		</section>

		<section id="problem" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Problem</span>
					<h2 class="wgos-h2">Die meisten Websites sind online. Aber nicht wirklich wirksam.</h2>
				</div>

				<div class="wgos-problem-grid">
					<div class="wgos-prose">
						<p>Viele WordPress-Websites sind technisch in Ordnung, gestalterisch solide und trotzdem strategisch schwach. Nicht weil einzelne Bausteine grundsaetzlich fehlen, sondern weil sie nicht als System zusammenarbeiten.</p>
						<p class="wgos-bold-statement">Das Problem ist in den meisten Faellen nicht der einzelne Kanal. Das Problem ist das fehlende System.</p>
					</div>

					<div class="wgos-issue-list" aria-label="Typische Probleme">
						<?php foreach ( $problem_points as $problem_point ) : ?>
							<article class="wgos-issue-card">
								<p><?php echo esc_html( $problem_point ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-definition-shell">
					<span class="wgos-principle-kicker">WGOS-Definition</span>
					<h2 class="wgos-h2">Was ist das WGOS?</h2>
					<p class="wgos-section-intro">Das WordPress Growth Operating System ist ein strukturiertes Wachstumssystem fuer Unternehmen, die ihre WordPress-Website strategisch entwickeln wollen.</p>
					<p class="wgos-definition__statement">Erst das Fundament. Dann Sichtbarkeit. Dann Conversion. Dann Skalierung.</p>
				</div>
			</div>
		</section>

		<section id="system" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Systemstruktur</span>
					<h2 class="wgos-h2">WGOS macht die Logik sichtbar.</h2>
					<p class="wgos-section-intro">Nicht mehr SEO hier, Tracking dort und Conversion irgendwann spaeter. Sondern ein System, das aufeinander aufbaut.</p>
				</div>

				<div class="wgos-visual-grid">
					<div class="wgos-system-visual-shell">
						<ol class="wgos-system-flow" aria-label="WGOS folgt der Reihenfolge Strategie, Fundament, Messbarkeit, Sichtbarkeit, Conversion und Anfragen.">
							<?php foreach ( $system_nodes as $system_node ) : ?>
								<li class="wgos-system-flow__item">
									<span class="wgos-system-flow__step"><?php echo esc_html( $system_node['step'] ); ?></span>
									<div class="wgos-system-flow__body">
										<strong><?php echo esc_html( $system_node['title'] ); ?></strong>
										<p><?php echo esc_html( $system_node['text'] ); ?></p>
									</div>
								</li>
							<?php endforeach; ?>
						</ol>
					</div>

					<div class="wgos-note-card">
						<h3>Warum diese Reihenfolge traegt</h3>
						<p>Wenn Strategie, Fundament und Messbarkeit nicht stehen, produziert jede weitere Massnahme vor allem neues Rauschen. Sichtbarkeit und Conversion werden erst dann belastbar, wenn die Basis stimmt.</p>
						<ul class="wgos-checklist wgos-checklist--compact">
							<li>Das System erklaert, woran zuerst gearbeitet wird.</li>
							<li>Es reduziert Reibung zwischen Technik, Inhalt und Anfragepfad.</li>
							<li>Es macht Wachstum planbarer, weil Entscheidungen nachvollziehbar werden.</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-sequence-grid">
					<div>
						<span class="wgos-principle-kicker">Systemlogik</span>
						<h2 class="wgos-h2">Nicht mehr machen. Sondern das Richtige in der richtigen Reihenfolge.</h2>
						<div class="wgos-prose">
							<p>Viele Unternehmen investieren in SEO, Inhalte, Ads oder Relaunches, bevor die Grundlage sauber steht. Genau dadurch werden Massnahmen teuer, schwer messbar und in ihrer Wirkung unscharf.</p>
							<p>WGOS dreht diese Logik um: zuerst Stabilitaet, Messbarkeit, Nutzerfuehrung und Angebotslogik. Erst danach entsteht belastbares Wachstum.</p>
						</div>
					</div>

					<ol class="wgos-sequence-list" aria-label="Reihenfolge im WGOS">
						<?php foreach ( $sequence_steps as $sequence_index => $sequence_step ) : ?>
							<li class="wgos-sequence-card">
								<span class="wgos-sequence-card__index"><?php echo esc_html( str_pad( (string) ( $sequence_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<h3><?php echo esc_html( $sequence_step['title'] ); ?></h3>
								<p><?php echo esc_html( $sequence_step['text'] ); ?></p>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</section>

		<section id="module" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Die 6 Kernbereiche</span>
					<h2 class="wgos-h2">Sechs Bausteine. Ein zusammenhaengendes System.</h2>
					<p class="wgos-section-intro">Jeder Bereich hat eine klare Rolle. Entscheidend ist nicht, alles gleichzeitig zu machen, sondern die richtige Tiefe zur richtigen Zeit.</p>
				</div>

				<div class="wgos-core-grid">
					<?php foreach ( $core_areas as $core_area ) : ?>
						<article class="wgos-core-card nx-reveal">
							<div class="wgos-core-card__top">
								<span class="wgos-core-card__number"><?php echo esc_html( $core_area['number'] ); ?></span>
								<h3><?php echo esc_html( $core_area['title'] ); ?></h3>
							</div>
							<p class="wgos-core-card__intro"><?php echo esc_html( $core_area['intro'] ); ?></p>
							<ul class="wgos-core-card__list">
								<?php foreach ( $core_area['bullets'] as $core_bullet ) : ?>
									<li><?php echo esc_html( $core_bullet ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="wgos-asset-hub-bridge">
					<div class="wgos-note-card">
						<h3>Alle Bausteine gesammelt sehen?</h3>
						<p>Die WGOS-Seite erklaert das System. Die separate Systemlandkarte zeigt alle vorhandenen Assets klickbar, nach Abschnitten geordnet und direkt mit ihren Detailseiten verbunden.</p>
						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $asset_hub_url ); ?>" class="wgos-btn wgos-btn--outline">Zur WGOS Asset-Landkarte</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="workflow" class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Arbeitsweise</span>
					<h2 class="wgos-h2">Kontrollierte Entwicklung statt loser To-dos.</h2>
					<p class="wgos-section-intro">Die Zusammenarbeit folgt keinem Sammelbecken aus Aufgaben, sondern einem klar gefuehrten Ablauf.</p>
				</div>

				<ol class="wgos-workflow" aria-label="WGOS Workflow">
					<?php foreach ( $workflow_steps as $workflow_step ) : ?>
						<li class="wgos-workflow__item">
							<span class="wgos-workflow__number"><?php echo esc_html( $workflow_step['number'] ); ?></span>
							<h3><?php echo esc_html( $workflow_step['title'] ); ?></h3>
							<p><?php echo esc_html( $workflow_step['text'] ); ?></p>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</section>

		<section class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Abgrenzung</span>
					<h2 class="wgos-h2">Was WGOS von klassischer Umsetzung unterscheidet</h2>
				</div>

				<div class="wgos-contrast-grid">
					<?php foreach ( $difference_cards as $difference_card ) : ?>
						<article class="wgos-contrast-card">
							<h3><?php echo esc_html( $difference_card['title'] ); ?></h3>
							<ul class="wgos-checklist wgos-checklist--compact">
								<?php foreach ( $difference_card['points'] as $difference_point ) : ?>
									<li><?php echo esc_html( $difference_point ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>

				<p class="wgos-bold-statement">Ich optimiere nicht nur Seiten. Ich entwickle Systeme, die Nachfrage strukturieren.</p>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Fit</span>
					<h2 class="wgos-h2">Fuer wen das WGOS sinnvoll ist</h2>
				</div>

				<div class="wgos-fit-grid">
					<article class="wgos-fit-card">
						<h3>Sinnvoll, wenn ...</h3>
						<ul class="wgos-checklist wgos-checklist--compact">
							<?php foreach ( $fit_items as $fit_item ) : ?>
								<li><?php echo esc_html( $fit_item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>

					<article class="wgos-fit-card">
						<h3>Nicht ideal, wenn ...</h3>
						<ul class="wgos-checklist wgos-checklist--compact">
							<?php foreach ( $not_fit_items as $not_fit_item ) : ?>
								<li><?php echo esc_html( $not_fit_item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				</div>
			</div>
		</section>

		<section id="proof" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Proof / Wirkung</span>
					<h2 class="wgos-h2">Ruhige Wirkung statt grosser Versprechen.</h2>
					<p class="wgos-section-intro">WGOS ist kein Heilsversprechen. Es ist eine saubere Systemlogik, aus der haeufig diese Arten von Ergebnissen entstehen.</p>
				</div>

				<div class="wgos-proof-layout">
					<div class="wgos-proof-grid">
						<?php foreach ( $proof_metrics as $proof_metric ) : ?>
							<article class="wgos-proof-card">
								<strong class="wgos-proof-card__value"><?php echo esc_html( $proof_metric['value'] ); ?></strong>
								<p class="wgos-proof-card__label"><?php echo esc_html( $proof_metric['label'] ); ?></p>
								<p class="wgos-proof-card__context"><?php echo esc_html( $proof_metric['context'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>

					<div class="wgos-impact-card">
						<h3>Typische Resultat-Typen</h3>
						<ul class="wgos-impact-list">
							<?php foreach ( $impact_items as $impact_item ) : ?>
								<li><?php echo esc_html( $impact_item ); ?></li>
							<?php endforeach; ?>
						</ul>
						<p class="wgos-impact-card__footer">Wenn Sie sehen wollen, wie sich diese Logik in der Praxis auswirkt, schauen Sie auf Vorher-Nachher-Effekte statt auf Leistungslisten.</p>
						<a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Case Studies ansehen</a>
					</div>
				</div>
			</div>
		</section>

		<section id="audit" class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-audit-shell">
					<div class="wgos-audit-copy">
						<span class="wgos-principle-kicker">Audit-Bridge</span>
						<h2 class="wgos-h2">Der richtige Startpunkt: erst verstehen, dann umbauen</h2>
						<div class="wgos-prose">
							<p>Die Zusammenarbeit beginnt nicht mit blindem Umsetzen, sondern mit Audit, Klarheit und Priorisierung. Erst wenn Fundament, Engpaesse und Reihenfolge sauber sichtbar sind, ergibt die naechste Entscheidung wirklich Sinn.</p>
						</div>

						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
							<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespraech vereinbaren</a>
						</div>
					</div>

					<div class="wgos-audit-results">
						<h3>Was danach klar ist</h3>
						<ul class="wgos-checklist wgos-checklist--compact">
							<?php foreach ( $audit_outcomes as $audit_outcome ) : ?>
								<li><?php echo esc_html( $audit_outcome ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section id="pakete" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Pakete</span>
					<h2 class="wgos-h2">Wenn die Diagnose steht, folgt die passende Systemtiefe.</h2>
					<p class="wgos-section-intro">Die Pakete verkaufen nicht das System. Sie geben dem System nach dem Audit den passenden Umfang.</p>
				</div>

				<div class="wgos-pricing-grid">
					<?php foreach ( $packages as $package ) : ?>
						<article class="wgos-pricing-card<?php echo $package['featured'] ? ' wgos-pricing-card--featured' : ''; ?> nx-reveal">
							<?php if ( $package['featured'] ) : ?>
								<span class="wgos-pricing-badge">Empfohlen</span>
							<?php endif; ?>

							<div class="wgos-pricing-card__head">
								<h3><?php echo esc_html( $package['name'] ); ?></h3>
								<p class="wgos-pricing-card__tagline"><?php echo esc_html( $package['tagline'] ); ?></p>
							</div>

							<div class="wgos-pricing-card__price"><?php echo esc_html( $package['price'] ); ?><small>/Monat</small></div>
							<div class="wgos-pricing-card__credits"><?php echo esc_html( $package['credits'] ); ?></div>

							<ul class="wgos-pricing-card__features">
								<?php foreach ( $package['features'] as $feature ) : ?>
									<li><?php echo esc_html( $feature ); ?></li>
								<?php endforeach; ?>
							</ul>

							<p class="wgos-pricing-card__ideal"><?php echo esc_html( $package['ideal'] ); ?></p>
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn <?php echo $package['featured'] ? 'wgos-btn--primary' : 'wgos-btn--outline'; ?>" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
						</article>
					<?php endforeach; ?>
				</div>

				<div id="credits" class="wgos-credit-summary nx-reveal">
					<div class="wgos-credit-summary__copy">
						<h3>Credits ordnen den Umfang, nicht die Strategie.</h3>
						<p>Credits schaffen Planbarkeit: Ein Asset hat einen festen Wert, unabhaengig vom realen Zeitaufwand. So sprechen wir ueber Prioritaet und Wirkung, nicht ueber Minuten.</p>
					</div>

					<div class="wgos-table-wrap">
						<table class="wgos-credits-table wgos-credits-table--compact">
							<thead>
								<tr>
									<th>Beispiel-Asset</th>
									<th>Fokus</th>
									<th>Credits</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $credit_examples as $credit_example ) : ?>
									<tr>
										<td><?php echo nexus_render_wgos_asset_label( $credit_example['asset'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
										<td><?php echo esc_html( $credit_example['focus'] ); ?></td>
										<td><?php echo esc_html( $credit_example['credits'] ); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

					<p class="wgos-credit-summary__note">Die genaue Priorisierung entsteht im Audit und in der laufenden Systemarbeit, nicht ueber starre Tabellen.</p>
				</div>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-principle-shell wgos-guarantee-shell">
					<span class="wgos-principle-kicker">Garantie</span>
					<h2 class="wgos-h2">Was ich zusage</h2>
					<ul class="wgos-checklist wgos-checklist--guarantee">
						<?php foreach ( $guarantee_points as $guarantee_point ) : ?>
							<li><?php echo esc_html( $guarantee_point ); ?></li>
						<?php endforeach; ?>
					</ul>
					<p class="wgos-expectation">Keine Garantie auf fixe Lead-Zahlen. Die Zusage ist eine andere: saubere Diagnose, klare Reihenfolge, nachvollziehbare Umsetzung und ein System, das Ihnen gehoert.</p>
				</div>
			</div>
		</section>

		<section id="faq" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">FAQ</span>
					<h2 class="wgos-h2">Die wichtigsten Fragen, kurz und klar.</h2>
				</div>

				<div class="wgos-faq">
					<?php foreach ( $faq_items as $faq_item ) : ?>
						<details class="nx-faq__item">
							<summary><?php echo esc_html( $faq_item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $faq_item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray wgos-final-cta nx-reveal">
			<div class="wgos-container">
				<div class="wgos-final-cta__inner">
					<span class="wgos-principle-kicker">Naechster Schritt</span>
					<h2 class="wgos-h2">Erst Klarheit. Dann die richtige Reihenfolge.</h2>
					<p class="wgos-prose">Wenn Sie aus Ihrer WordPress-Website kein loses Sammelbecken digitaler Massnahmen mehr machen wollen, sondern ein strukturiertes Nachfrage-System, dann ist der naechste sinnvolle Schritt ein gemeinsamer Blick auf Fundament, Engpaesse und Prioritaeten.</p>

					<div class="wgos-hero__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
						<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespraech vereinbaren</a>
					</div>

					<p class="wgos-hero__microcopy">Kurz, klar, ohne Verkaufsdruck. Erst pruefen, ob es fachlich und strategisch wirklich passt.</p>
				</div>
			</div>
		</section>

	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ); ?></script>

<?php get_footer(); ?>
