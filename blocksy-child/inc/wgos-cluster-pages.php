<?php
/**
 * Versioned WGOS cluster pages and blog-to-asset bridges.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the versioned cluster-page definitions that replace editor drift.
 *
 * @return array<string, array<string, mixed>>
 */
function nexus_get_wgos_cluster_page_data() {
	static $pages = null;

	if ( null !== $pages ) {
		return $pages;
	}

	$pages = [
		'wordpress-seo-hannover' => [
			'eyebrow'          => 'Sichtbarkeit im WGOS',
			'title'            => 'Technisches SEO für WordPress in Hannover',
			'lead'             => 'Diese Seite ist der Einstieg für technisches SEO auf WordPress: Crawlability, Seitenstruktur, interne Verlinkung und priorisierte Fixes statt losem SEO-Aktionismus.',
			'intro'            => [
				'Viele B2B-Websites investieren in Inhalte, ohne zuerst die technischen Bremsen zu lösen. Dann entstehen Seiten, die zwar vorhanden sind, aber weder stabil ranken noch qualifizierte Anfragen sauber vorbereiten.',
				'WordPress SEO wird dadurch schnell zur To-do-Liste aus Meta-Titeln, Plugins und Blogideen. Was oft fehlt, ist die Reihenfolge: Erst Crawlability, Struktur, interne Verlinkung und technische Sauberkeit, dann Themenarchitektur und conversion-nahe Seiten.',
				'Genau dort setzt diese Seite an. Sie ist kein Sammelbegriff für eine komplette WordPress-Agenturleistung, sondern der technische SEO-Einstieg innerhalb des WGOS für sichtbare, belastbare Seitentypen.',
			],
			'system'           => [
				'Im WGOS ist SEO kein Solobaustein. Sichtbarkeit folgt auf ein tragfähiges Fundament aus Performance, Messbarkeit und klarer Angebotslogik.',
				'Statt eine einzige SEO-Leistung zu verkaufen, ordnen wir die richtigen Bausteine für Ihre Lage. Das kann mit einem Technical SEO Audit starten, mit einer Keyword-Strategie weitergehen und später in Pillar Pages, Content Hubs oder interne Verlinkung münden.',
				'Wenn Sie nicht nur technisches SEO, sondern eine breitere WordPress-Agenturleistung für Angebotsseiten, Tracking, Conversion und Betrieb suchen, ist die Agentur-Seite der bessere Einstieg.',
			],
			'assets'           => [
				'technical-seo-audit' => 'Findet Indexierungs- und Strukturprobleme, die Rankings bereits heute ausbremsen.',
				'keyword-strategie'   => 'Ordnet Nachfrage in Themen, Suchintentionen und priorisierte Seitentypen.',
				'pillar-page'         => 'Baut die zentrale Money Page für ein Kernthema mit klarer interner Verlinkung.',
				'content-hub'         => 'Verbindet Hauptseite und Cluster-Inhalte zu einem belastbaren Themen-System.',
				'on-page-seo'         => 'Schärft Snippets, Seitentitel, Headlines und inhaltliche Führung an der Suchintention.',
				'interne-verlinkung'  => 'Stärkt die wichtigsten Seiten über klare Pfade für Nutzer und Suchmaschine.',
				'schema-markup'       => 'Ergänzt strukturierte Daten dort, wo sie Suchergebnisse und Verständnis verbessern.',
				'local-seo'           => 'Sichert lokale Relevanz für Hannover und regionale Nachfragepfade ab.',
			],
			'blogs'            => [
				[
					'title' => 'Warum Performance Marketing ohne technisches SEO Geld verbrennt',
					'url'   => home_url( '/technisches-seo-performance-fundament/' ),
				],
				[
					'title' => 'Performance ist Profit: Core Web Vitals',
					'url'   => home_url( '/core-web-vitals-wachstum-seo-und-roas/' ),
				],
			],
			'supporting_link'  => [
				'kicker' => 'Breiterer Einstieg',
				'label'  => 'WordPress für B2B in Hannover',
				'url'    => nexus_get_primary_public_url( 'agentur', home_url( '/wordpress-agentur-hannover/' ) ),
				'text'   => 'Wenn der Bedarf über technisches SEO hinausgeht und auch Angebotsseiten, Tracking, Conversion und Betrieb umfasst, ist die Agentur-Seite der klarere Startpunkt.',
			],
			'meta_title'       => 'WordPress SEO Hannover | Technisches SEO für WordPress',
			'meta_description' => 'Technisches SEO für WordPress in Hannover: Diagnose, Crawlability, interne Verlinkung und priorisierte SEO-Fixes für B2B-Websites.',
			'schema_name'      => 'Technisches SEO für WordPress in Hannover',
			'schema_description' => 'WGOS-Cluster für technisches SEO auf WordPress in Hannover: technische Basis, Seitenstruktur und conversion-nahe Sichtbarkeit für B2B-Websites.',
		],
		'wordpress-wartung-hannover' => [
			'eyebrow'          => 'Betrieb im WGOS',
			'title'            => 'WordPress Wartung Hannover',
			'lead'             => 'WordPress-Wartung ist hier kein isolierter Wartungsvertrag, sondern der laufende Betriebsblock aus Updates, Sicherheit, Stabilität und klaren Rollback-Prozessen.',
			'intro'            => [
				'Viele Wartungsangebote versprechen Ruhe, meinen aber nur Plugin-Updates. Für Unternehmen mit relevanter Website reicht das nicht. Entscheidend ist, ob Updates, Sicherheit, Backups, Performance und Wiederherstellung zusammen als belastbarer Betriebszustand funktionieren.',
				'Genau dort kippen viele WordPress-Setups: zu viele Plugins, unklare Zuständigkeiten, fehlende Rollback-Routinen und eine Website, die unter Last, nach Updates oder bei Vorfällen nicht kontrollierbar bleibt.',
				'Im WGOS wird Wartung deshalb nicht als Nebenvertrag behandelt, sondern als Fundament. Erst wenn der Betrieb stabil ist, lohnen sich Investitionen in SEO, Conversion und bezahlte Nachfrage wirklich.',
			],
			'system'           => [
				'Das Thema gehört im WGOS in den Betriebs- und Fundament-Layer. Statt nur Tickets abzuarbeiten, ordnen wir WordPress-Wartung in eine klare Reihenfolge aus Härtung, Update-Management, Plugin-Reduktion, Performance-Diagnose und verlässlicher Wiederherstellung ein.',
				'So entsteht kein Billig-Wartungsvertrag, sondern ein kontrollierbarer Betriebszustand. Genau das ist für kaufnahe Seiten, Lead-Gen-Setups und B2B-Websites relevanter als reine Checklistenpflege.',
			],
			'assets'           => [
				'security-hardening' => 'Härtet WordPress, Zugriffe und Wiederherstellungswege so ab, dass der laufende Betrieb nicht an vermeidbaren Risiken scheitert.',
				'update-management'  => 'Macht Updates planbar, testbar und rollback-fähig statt zu einem Risiko im Tagesgeschäft.',
				'plugin-audit'       => 'Reduziert Wartungslast und Konflikte, indem unnötige oder problematische Plugins aus dem Stack verschwinden.',
				'cwv-speed-audit'    => 'Prüft, ob technische Langsamkeit bereits Vertrauen, Rankings oder Conversion mit belastet.',
				'server-tuning'      => 'Greift tiefer ein, wenn Hosting, TTFB, Cache oder Infrastruktur der eigentliche Engpass im Betrieb sind.',
			],
			'blogs'            => [
				[
					'title' => 'Performance ist Profit: Core Web Vitals',
					'url'   => home_url( '/core-web-vitals-wachstum-seo-und-roas/' ),
				],
				[
					'title' => 'Warum Performance Marketing ohne technisches SEO Geld verbrennt',
					'url'   => home_url( '/technisches-seo-performance-fundament/' ),
				],
			],
			'meta_title'       => 'WordPress Wartung Hannover | Betrieb, Updates und Sicherheit',
			'meta_description' => 'WordPress Wartung in Hannover als Teil des WGOS-Fundaments: Updates, Sicherheit, Backups, Performance und stabile Betriebsroutinen für B2B-Websites.',
			'schema_name'      => 'WordPress Wartung Hannover',
			'schema_description' => 'WGOS-Cluster für WordPress-Wartung in Hannover: Betrieb, Updates, Sicherheit und technische Stabilität für B2B-Websites.',
		],
		'core-web-vitals' => [
			'eyebrow'          => 'Technisches Fundament im WGOS',
			'title'            => 'Core Web Vitals',
			'lead'             => 'Performance ist kein Kosmetikthema. Langsame WordPress-Seiten kosten Sichtbarkeit, Vertrauen und Anfragen.',
			'intro'            => [
				'Wenn wichtige Seiten zu langsam laden, verliert Ihre Website an drei Stellen gleichzeitig: Rankings, Nutzererlebnis und Conversion. Das Problem steckt selten in einem einzelnen Detail.',
				'Meist ist es ein Mix aus Theme-Last, Plugins, Bildern, Dritt-Skripten, Server-Setup und unklarer Priorisierung. Genau deshalb greifen pauschale Speed-Tipps fast nie sauber.',
				'Im WGOS wird Performance zuerst diagnostiziert und dann in der richtigen Reihenfolge korrigiert. So wird aus einem technischen Problem wieder eine betriebsrelevante Verbesserung.',
			],
			'system'           => [
				'Core Web Vitals gehören klar ins technische Fundament. Erst wenn LCP, Stabilität und Reaktionszeit auf kaufnahen Seitentypen stimmen, lohnen sich größere Investitionen in SEO, Content und Landing Pages wirklich.',
				'Wir behandeln Performance deshalb nicht als Plugin-Thema, sondern als Systemarbeit zwischen Audit, Optimierung, Server-Layer und laufender Stabilisierung.',
			],
			'assets'           => [
				'cwv-speed-audit'  => 'Zeigt, welche Bremsen auf relevanten Seitentypen tatsächlich zuerst gelöst werden müssen.',
				'cwv-optimierung'  => 'Setzt die Diagnose in konkrete technische Korrekturen für Ladezeit und Nutzererlebnis um.',
				'server-tuning'    => 'Greift tiefer in Caching, TTFB und Infrastruktur ein, wenn das Hosting limitiert.',
				'security-hardening' => 'Sichert den Betrieb ab, damit eine schnelle Seite nicht durch technische Risiken kippt.',
				'plugin-audit'     => 'Räumt unnötige oder konfliktträchtige Plugins aus dem Stack, bevor sie weiter bremsen.',
				'update-management' => 'Hält Performance-Gewinne stabil, weil Updates kontrolliert und testbar ausgerollt werden.',
			],
			'blogs'            => [
				[
					'title' => 'Performance ist Profit: Core Web Vitals',
					'url'   => home_url( '/core-web-vitals-wachstum-seo-und-roas/' ),
				],
				[
					'title' => 'Warum Performance Marketing ohne technisches SEO Geld verbrennt',
					'url'   => home_url( '/technisches-seo-performance-fundament/' ),
				],
			],
			'meta_title'       => 'Core Web Vitals für WordPress | WGOS von Haşim Üner',
			'meta_description' => 'Core Web Vitals als WGOS-Cluster: Audit, Optimierung, Server-Tuning und Stabilisierung für schnellere WordPress-Seiten.',
			'schema_name'      => 'Core Web Vitals für WordPress',
			'schema_description' => 'WGOS-Cluster für Core Web Vitals: Performance-Diagnose, Optimierung und technisches Fundament für B2B-WordPress-Websites.',
		],
		'ga4-tracking-setup' => [
			'eyebrow'          => 'Messbarkeit im WGOS',
			'title'            => 'GA4 Tracking Setup',
			'lead'             => 'Tracking soll Entscheidungen ermöglichen, nicht nur Dashboards füllen. Ohne saubere Daten bleibt Optimierung Vermutung.',
			'intro'            => [
				'Viele Unternehmen haben GA4, GTM und Consent technisch installiert. Trotzdem fehlen belastbare Antworten auf einfache Fragen: Welche Seiten erzeugen Nachfrage, welcher Kanal bringt die besseren Leads und wo bricht die Nutzerfuehrung weg?',
				'Das Problem liegt selten in einem einzigen Tag. Meist fehlen Event-Logik, Consent-Verhalten, UTM-Standards und eine sinnvolle Management-Sicht auf dieselben Daten.',
				'Im WGOS wird Messbarkeit deshalb als eigener Kernbereich behandelt. Erst mit sauberen Signalen wird aus Website-Arbeit eine steuerbare Wachstumslogik.',
			],
			'system'           => [
				'Messbarkeit folgt im WGOS auf ein stabiles technisches Fundament und läuft vor größeren Conversion- oder Reporting-Schritten. Sonst werden Entscheidungen auf verrauschten Daten getroffen.',
				'Wir koppeln Tracking nicht von der Website ab. Audit, Event-Blueprint, Consent, serverseitige Signalverarbeitung und Dashboards gehören zusammen.',
			],
			'assets'           => [
				'tracking-audit'       => 'Prüft, wo Daten fehlen, doppelt feuern oder an Consent und Setups scheitern.',
				'ga4-event-blueprint'  => 'Definiert Events, KPI-Logik und Funnel-Schritte für echte Entscheidungsfähigkeit.',
				'consent-mode-v2'      => 'Bringt Datenschutz und Signalqualität in ein sauberes technisches Modell.',
				'server-side-tracking' => 'Stabilisiert Messung über Browser-Grenzen hinweg mit sGTM oder Matomo.',
				'kpi-dashboard'        => 'Verdichtet Rohdaten in eine Führungssicht für Management und Marketing.',
				'utm-framework'        => 'Sichert Benennung und Attribution über Kampagnen und Teams hinweg.',
			],
			'blogs'            => [
				[
					'title' => 'Datenhoheit mit Server-Side GTM',
					'url'   => home_url( '/server-side-tracking-gtm/' ),
				],
			],
			'meta_title'       => 'GA4 Tracking Setup | WGOS-Cluster von Haşim Üner',
			'meta_description' => 'GA4 Tracking Setup als WGOS-Cluster: Tracking Audit, Event-Blueprint, Consent und serverseitige Messung für belastbare Daten.',
			'schema_name'      => 'GA4 Tracking Setup',
			'schema_description' => 'WGOS-Cluster für GA4, GTM und Tracking: belastbare Messbarkeit für B2B-WordPress-Websites.',
		],
		'conversion-rate-optimization' => [
			'eyebrow'          => 'Conversion im WGOS',
			'title'            => 'Conversion Rate Optimization',
			'lead'             => 'Conversion entsteht nicht am Formularende. Sie beginnt dort, wo Besucher in wenigen Sekunden verstehen, warum sie hier richtig sind.',
			'intro'            => [
				'Viele Seiten haben Traffic, aber keine klare Nutzerführung. Angebot, Proof, CTA und Einwandabbau arbeiten dann nicht als System, sondern nebeneinander.',
				'Das führt zu vermeidbaren Verlusten: zu viele irrelevante Klicks, zu wenig qualifizierte Anfragen und eine Website, die zwar informiert, aber nicht führt.',
				'Im WGOS behandeln wir Conversion deshalb als Architektur. Die richtige Seite, das richtige Versprechen und der nächste sinnvolle Schritt müssen zusammenpassen.',
			],
			'system'           => [
				'Conversion folgt im WGOS auf ein technisches und messbares Fundament. Erst wenn Daten und Performance stimmen, lassen sich Angebotsseiten, Landing Pages und Formulare belastbar optimieren.',
				'Wir denken CRO dabei nicht als Testlabor ohne Kontext, sondern als Verbindung aus Angebotslogik, Seitenrollen, Botschaft, Proof und klarer CTA-Hierarchie.',
			],
			'assets'           => [
				'landing-page-neu'            => 'Baut neue Landing Pages mit sauberem Message Match und klarer Zielhandlung auf.',
				'landing-page-optimierung'    => 'Hebt bestehende Seiten an den Engpässen aus Headline, Aufbau und Reibung an.',
				'cta-formular-optimierung'    => 'Prüft Formulare, Hürden und CTA-Logik dort, wo Nachfrage verloren geht.',
				'angebotsseiten-architektur'  => 'Ordnet Angebotsseiten so, dass Nutzen, Proof und nächster Schritt zusammenarbeiten.',
				'social-proof'                => 'Setzt Vertrauenssignale gezielt ein, statt sie lose über die Seite zu verteilen.',
				'lead-magnet'                 => 'Schafft risikoarme Einstiege für Besucher, die noch nicht direkt anfragen wollen.',
			],
			'blogs'            => [
				[
					'title' => 'B2B Landingpage optimieren',
					'url'   => home_url( '/b2b-landingpage-optimieren/' ),
				],
				[
					'title' => 'Design ist kein Geschmack. Es ist Architektur.',
					'url'   => home_url( '/design-ist-mehr-als-aesthetik/' ),
				],
				[
					'title' => 'Die 150-Euro-pro-Lead-Falle',
					'url'   => home_url( '/owned-leads-statt-ad-miete/' ),
				],
			],
			'meta_title'       => 'Conversion Rate Optimization | WGOS von Haşim Üner',
			'meta_description' => 'CRO als WGOS-Cluster: Landing Pages, Angebotsseiten, Formulare und Proof für mehr qualifizierte WordPress-Anfragen.',
			'schema_name'      => 'Conversion Rate Optimization',
			'schema_description' => 'WGOS-Cluster für Conversion Rate Optimization: Angebotslogik, Landing Pages und CTA-Führung für B2B-WordPress-Websites.',
		],
		'performance-marketing' => [
			'eyebrow'          => 'Paid-Kontext im WGOS',
			'title'            => 'Performance Marketing',
			'lead'             => 'Paid darf Nachfrage verstärken, aber keine strukturellen Fehler verdecken. Ohne Fundament wird Budget nur schneller verbrannt.',
			'intro'            => [
				'Viele Teams starten mit Kampagnen, bevor technische Basis, Tracking und Angebotsseite stabil stehen. Dann werden Klicks eingekauft, aber Reibung bleibt unangetastet.',
				'Das Ergebnis sind teure Leads, unsaubere Attribution und Landing Pages, die den Traffic nicht in qualifizierte Gespräche übersetzen.',
				'Im WGOS ist Performance Marketing deshalb kein Startpunkt, sondern ein Aktivierungslayer. Erst wenn Seite und Messbarkeit tragen, lohnt sich Reichweite wirklich.',
			],
			'system'           => [
				'Performance Marketing sitzt im WGOS nie isoliert vor Technik und Messbarkeit. Die bezahlte Verstärkung kommt erst dann nach vorne, wenn die wichtigen Signale und Seitentypen bereits stabil laufen.',
				'Wir betrachten deshalb immer die Kombination aus Diagnose, Tracking, Angebot und Landing Page. Paid wird so zum Hebel für ein System, nicht zum Ersatz dafür.',
			],
			'assets'           => [
				'growth-audit'              => 'Klärt zuerst, ob wirklich Paid der Engpass ist oder ob Fundament und Angebot bremsen.',
				'tracking-audit'            => 'Sichert, dass Kampagnendaten und Conversion-Signale überhaupt belastbar sind.',
				'ga4-event-blueprint'       => 'Definiert, welche Events und KPI-Schritte für Kampagnensteuerung wirklich zählen.',
				'technical-seo-audit'       => 'Verhindert, dass bezahlter Traffic auf technisch schwache Seiten trifft.',
				'landing-page-neu'          => 'Baut die Seite, die Kampagnenversprechen sauber in eine Anfrage überführt.',
				'landing-page-optimierung'  => 'Hebt bestehende Kampagnenseiten an den größten Conversion-Bremsen an.',
			],
			'blogs'            => [
				[
					'title' => 'Warum Performance Marketing ohne technisches SEO Geld verbrennt',
					'url'   => home_url( '/technisches-seo-performance-fundament/' ),
				],
				[
					'title' => 'Die 150-Euro-pro-Lead-Falle',
					'url'   => home_url( '/owned-leads-statt-ad-miete/' ),
				],
			],
			'meta_title'       => 'Performance Marketing im WGOS | Haşim Üner',
			'meta_description' => 'Performance Marketing als WGOS-Aktivierungslayer: erst Tracking, Technik und Landing Page, dann Reichweite mit sauberer Priorisierung.',
			'schema_name'      => 'Performance Marketing für B2B-WordPress-Websites',
			'schema_description' => 'WGOS-Cluster für Performance Marketing: Paid-Aktivierung erst nach technischem Fundament, Tracking und conversion-starken Zielseiten.',
		],
	];

	return $pages;
}

/**
 * Resolve one cluster page by slug or current post.
 *
 * @param string|WP_Post|null $value Page slug or post object.
 * @return array<string, mixed>|null
 */
function nexus_get_wgos_cluster_page( $value = null ) {
	if ( null === $value ) {
		$value = get_post();

		if ( ! ( $value instanceof WP_Post ) && function_exists( 'nexus_get_current_wgos_cluster_route_slug' ) ) {
			$value = nexus_get_current_wgos_cluster_route_slug();
		}
	}

	if ( $value instanceof WP_Post ) {
		$value = $value->post_name;
	}

	$slug  = sanitize_title( (string) $value );
	$pages = nexus_get_wgos_cluster_page_data();

	return $pages[ $slug ] ?? null;
}

/**
 * Check whether the current request belongs to a versioned cluster page.
 *
 * @param string|WP_Post|null $value Page slug or post object.
 * @return bool
 */
function nexus_is_wgos_cluster_page( $value = null ) {
	return is_array( nexus_get_wgos_cluster_page( $value ) );
}

/**
 * Get SEO defaults for a cluster page.
 *
 * @param string|WP_Post|null $value Page slug or post object.
 * @return array<string, string>|null
 */
function nexus_get_wgos_cluster_page_seo_defaults( $value = null ) {
	$page = nexus_get_wgos_cluster_page( $value );

	if ( ! is_array( $page ) ) {
		return null;
	}

	return [
		'title'       => (string) ( $page['meta_title'] ?? '' ),
		'description' => (string) ( $page['meta_description'] ?? '' ),
	];
}

/**
 * Build render-ready asset cards for a cluster page.
 *
 * @param array<string, mixed> $page Cluster page definition.
 * @return array<int, array<string, string>>
 */
function nexus_get_wgos_cluster_page_asset_cards( $page ) {
	$cards = [];

	foreach ( (array) ( $page['assets'] ?? [] ) as $slug => $context ) {
		$asset = function_exists( 'nexus_get_wgos_asset_definition' ) ? nexus_get_wgos_asset_definition( (string) $slug ) : null;

		$cards[] = [
			'title'   => is_array( $asset ) && ! empty( $asset['title'] ) ? (string) $asset['title'] : ucwords( str_replace( '-', ' ', (string) $slug ) ),
			'url'     => function_exists( 'nexus_get_wgos_asset_anchor_url' ) ? nexus_get_wgos_asset_anchor_url( (string) $slug ) : home_url( '/wgos-systemlandkarte/#asset-' . sanitize_title( (string) $slug ) ),
			'context' => (string) $context,
		];
	}

	return $cards;
}

/**
 * Return the shared public proof metrics for WGOS cluster pages.
 *
 * @return array<int, array<string, string>>
 */
function nexus_get_wgos_cluster_page_proof_metrics() {
	return [
		[
			'value' => '1.750+',
			'label' => 'qualifizierte Leads im aufgebauten System',
		],
		[
			'value' => '-83%',
			'label' => 'Cost per Lead nach Neuordnung',
		],
		[
			'value' => '<0.8s',
			'label' => 'LCP auf Angebotsseiten',
		],
	];
}

/**
 * Return the shared three-step method for cluster pages.
 *
 * @return array<int, array<string, string>>
 */
function nexus_get_wgos_cluster_page_method_steps() {
	return [
		[
			'title' => '1. Diagnose vor Ausbau',
			'text'  => 'Wir starten nicht mit Content, Kampagnen oder neuen Seiten, solange Canonical, Tracking, Performance oder Angebotslogik gegeneinander laufen.',
		],
		[
			'title' => '2. Bausteine nach Hebel ordnen',
			'text'  => 'Im WGOS bekommt nicht jede Idee Prioritaet. Zuerst zaehlt, was Sichtbarkeit, Trust und Conversion auf den kaufnahen Seiten wirklich entsperrt.',
		],
		[
			'title' => '3. Wirkung an echten Signalen messen',
			'text'  => 'Fortschritt wird nicht ueber Aktivitaet bewertet, sondern ueber belastbare Signale wie Anfragequalitaet, CPL, Ladezeit und technische Stabilitaet.',
		],
	];
}

/**
 * Render the shared WGOS cluster page layout.
 *
 * @param array<string, mixed> $page Cluster page definition.
 * @return string
 */
function nexus_render_wgos_cluster_page( $page ) {
	$audit_url     = nexus_get_audit_url();
	$wgos_url      = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wordpress-growth-operating-system/' );
	$asset_hub_url = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : home_url( '/wgos-systemlandkarte/' );
	$results_url   = nexus_get_primary_public_url( 'results', home_url( '/ergebnisse/' ) );
	$cards         = nexus_get_wgos_cluster_page_asset_cards( $page );
	$blogs         = isset( $page['blogs'] ) && is_array( $page['blogs'] ) ? $page['blogs'] : [];
	$proof_metrics = nexus_get_wgos_cluster_page_proof_metrics();
	$method_steps  = nexus_get_wgos_cluster_page_method_steps();

	ob_start();
	?>
	<div class="nx-cluster-page" data-track-section="wgos_cluster_page">
		<section class="nx-section nx-cluster-hero">
			<div class="nx-container">
				<div class="nx-cluster-hero__shell">
					<div class="nx-cluster-hero__copy">
						<span class="nx-badge nx-badge--gold"><?php echo esc_html( (string) $page['eyebrow'] ); ?></span>
						<h1 class="nx-cluster-hero__title"><?php echo esc_html( (string) $page['title'] ); ?></h1>
						<p class="nx-cluster-hero__lead"><?php echo esc_html( (string) $page['lead'] ); ?></p>
						<div class="nx-cluster-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_cluster_audit" data-track-category="lead_gen">Growth Audit starten</a>
							<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost">WGOS verstehen</a>
						</div>
					</div>

					<aside class="nx-card nx-card--flat nx-cluster-hero__card">
						<span class="nx-cluster-hero__card-kicker">So ist die Seite gebaut</span>
						<p>Diese Seite ist keine isolierte Service-Landingpage mehr. Sie ordnet das Thema in die WGOS-Logik ein und zeigt die passenden Bausteine für den nächsten sinnvollen Schritt.</p>
						<p class="nx-cluster-hero__card-link"><a href="<?php echo esc_url( $asset_hub_url ); ?>">Zur Asset-Landkarte</a></p>
					</aside>
				</div>
			</div>
		</section>

		<section class="nx-section nx-cluster-section">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--ghost">Einordnung</span>
					<h2 class="nx-headline-section">Warum dieses Thema relevant ist</h2>
				</div>

				<div class="nx-prose nx-cluster-prose">
					<?php foreach ( (array) ( $page['intro'] ?? [] ) as $paragraph ) : ?>
						<p><?php echo esc_html( (string) $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section nx-cluster-section nx-cluster-section--alt">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--gold">WGOS-Logik</span>
					<h2 class="nx-headline-section">Wie wir das im WGOS lösen</h2>
				</div>

				<div class="nx-prose nx-cluster-prose">
					<?php foreach ( (array) ( $page['system'] ?? [] ) as $paragraph ) : ?>
						<p><?php echo esc_html( (string) $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $page['supporting_link'] ) && is_array( $page['supporting_link'] ) ) : ?>
					<div class="nx-card nx-card--flat nx-cluster-hero__card">
						<span class="nx-cluster-hero__card-kicker"><?php echo esc_html( (string) ( $page['supporting_link']['kicker'] ?? 'Weiterer Einstieg' ) ); ?></span>
						<p><?php echo esc_html( (string) ( $page['supporting_link']['text'] ?? '' ) ); ?></p>
						<?php if ( ! empty( $page['supporting_link']['url'] ) && ! empty( $page['supporting_link']['label'] ) ) : ?>
							<p class="nx-cluster-hero__card-link"><a href="<?php echo esc_url( (string) $page['supporting_link']['url'] ); ?>"><?php echo esc_html( (string) $page['supporting_link']['label'] ); ?></a></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<section class="nx-section nx-cluster-section">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--ghost">Proof</span>
					<h2 class="nx-headline-section">Oeffentliche Wirkung statt Behauptungen</h2>
					<p class="nx-subheadline">Die zentralen Zahlen stammen aus veroeffentlichten Fallbeispielen und dem sichtbaren Proof-Layer, nicht aus anonymen Benchmark-Folien.</p>
				</div>

				<div class="nx-card nx-card--flat nx-cluster-proof">
					<div class="nx-metrics nx-cluster-proof__metrics">
						<?php foreach ( $proof_metrics as $metric ) : ?>
							<div class="nx-metric">
								<span class="nx-metric__value"><?php echo esc_html( $metric['value'] ); ?></span>
								<span class="nx-metric__label"><?php echo esc_html( $metric['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
					<p class="nx-cluster-proof__note">Wenn Sie die oeffentlichen Beispiele und die Herleitung dazu sehen wollen, gehen Sie zuerst in die Ergebnisse. Der Growth Audit klaert danach, welche dieser Hebel in Ihrer Lage wirklich zuerst zahlen.</p>
					<div class="nx-cluster-hero__actions">
						<a href="<?php echo esc_url( $results_url ); ?>" class="nx-btn nx-btn--ghost">Ergebnisse ansehen</a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_cluster_proof_audit" data-track-category="lead_gen">Growth Audit starten</a>
					</div>
				</div>
			</div>
		</section>

		<section class="nx-section nx-cluster-section nx-cluster-section--alt">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--gold">Vorgehen</span>
					<h2 class="nx-headline-section">Was vor neuen Inhalten oder Kampagnen zuerst passiert</h2>
				</div>

				<ol class="nx-cluster-method">
					<?php foreach ( $method_steps as $step ) : ?>
						<li class="nx-card nx-card--flat nx-cluster-method__step">
							<h3 class="nx-cluster-method__title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p class="nx-cluster-method__text"><?php echo esc_html( $step['text'] ); ?></p>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</section>

		<section class="nx-section nx-cluster-section">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--ghost">Cluster</span>
					<h2 class="nx-headline-section">Die passenden WGOS-Bausteine</h2>
					<p class="nx-subheadline">Jeder Baustein löst einen klaren Teil des Problems. Gemeinsam entsteht daraus ein belastbares Cluster statt einer losen Leistungssammlung.</p>
				</div>

				<div class="nx-cluster-grid">
					<?php foreach ( $cards as $card ) : ?>
						<article class="nx-card nx-card--flat nx-cluster-asset-card">
							<h3 class="nx-cluster-asset-card__title"><a href="<?php echo esc_url( $card['url'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a></h3>
							<p class="nx-cluster-asset-card__text"><?php echo esc_html( $card['context'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section nx-cluster-section nx-cluster-section--alt">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--gold">Insights</span>
					<h2 class="nx-headline-section">Passende Artikel und Vertiefungen</h2>
				</div>

				<ul class="nx-cluster-blog-list">
					<?php foreach ( $blogs as $blog ) : ?>
						<li class="nx-cluster-blog-list__item">
							<a href="<?php echo esc_url( (string) $blog['url'] ); ?>"><?php echo esc_html( (string) $blog['title'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

		<section class="nx-section nx-cluster-section">
			<div class="nx-container">
				<div class="nx-card nx-card--flat nx-cluster-cta">
					<span class="nx-cluster-cta__kicker">Nächster Schritt</span>
					<h2 class="nx-headline-section">Erst die Lage klären. Dann den richtigen Baustein priorisieren.</h2>
					<p>Der Growth Audit zeigt, ob dieses Cluster jetzt dran ist oder ob Fundament, Messbarkeit oder Angebotslogik zuerst korrigiert werden müssen.</p>
					<div class="nx-cluster-hero__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_cluster_footer_audit" data-track-category="lead_gen">Growth Audit starten</a>
						<a href="<?php echo esc_url( $asset_hub_url ); ?>" class="nx-btn nx-btn--ghost">Alle WGOS-Assets ansehen</a>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php

	return trim( (string) ob_get_clean() );
}

/**
 * Return the slug-to-template mapping for versioned cluster routes.
 *
 * @return array<string, string>
 */
function nexus_get_wgos_cluster_route_templates() {
	return [
		'wordpress-seo-hannover'       => get_stylesheet_directory() . '/page-seo.php',
		'wordpress-wartung-hannover'   => get_stylesheet_directory() . '/page-wordpress-wartung-hannover.php',
		'core-web-vitals'              => get_stylesheet_directory() . '/page-cwv.php',
		'conversion-rate-optimization' => get_stylesheet_directory() . '/page-cro.php',
		'ga4-tracking-setup'           => get_stylesheet_directory() . '/page-ga4.php',
		'performance-marketing'        => get_stylesheet_directory() . '/page-performance.php',
	];
}

/**
 * Return the active cluster slug for the current request path if available.
 *
 * @return string
 */
function nexus_get_current_wgos_cluster_route_slug() {
	if ( ! function_exists( 'nexus_get_current_request_path' ) ) {
		return '';
	}

	$request_path = nexus_get_current_request_path();

	foreach ( array_keys( nexus_get_wgos_cluster_route_templates() ) as $slug ) {
		if ( trailingslashit( '/' . $slug ) === $request_path ) {
			return $slug;
		}
	}

	return '';
}

/**
 * Prevent canonical redirects from fighting virtual cluster routes.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function nexus_disable_canonical_redirect_for_cluster_routes( $redirect_url ) {
	if ( '' !== nexus_get_current_wgos_cluster_route_slug() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'nexus_disable_canonical_redirect_for_cluster_routes' );

/**
 * Turn cluster routes into virtual pages when no published page owns the slug.
 *
 * @param bool     $preempt  Existing preempt flag.
 * @param WP_Query $wp_query Current query.
 * @return bool
 */
function nexus_preempt_cluster_404( $preempt, $wp_query ) {
	if ( is_admin() || wp_doing_ajax() || ! ( $wp_query instanceof WP_Query ) ) {
		return $preempt;
	}

	$slug = nexus_get_current_wgos_cluster_route_slug();

	// `pre_handle_404` fires before WordPress marks the request as 404.
	// Virtual cluster routes must therefore key off the route slug alone.
	if ( '' === $slug ) {
		return $preempt;
	}

	$wp_query->is_404                = false;
	$wp_query->is_page               = true;
	$wp_query->is_singular           = true;
	$wp_query->is_home               = false;
	$wp_query->is_archive            = false;
	$wp_query->is_posts_page         = false;
	$wp_query->queried_object        = null;
	$wp_query->queried_object_id     = 0;
	$wp_query->query_vars['pagename'] = $slug;
	unset( $wp_query->query['error'], $wp_query->query_vars['error'] );

	status_header( 200 );

	return true;
}
add_filter( 'pre_handle_404', 'nexus_preempt_cluster_404', 10, 2 );

/**
 * Force key legacy routes onto versioned cluster templates.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_force_cluster_route_templates( $template ) {
	if ( is_admin() ) {
		return $template;
	}

	$current_slug     = nexus_get_current_wgos_cluster_route_slug();
	$route_templates  = nexus_get_wgos_cluster_route_templates();

	foreach ( $route_templates as $slug => $forced_template ) {
		if ( ( is_page( $slug ) || $current_slug === $slug ) && file_exists( $forced_template ) ) {
			return $forced_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'nexus_force_cluster_route_templates', 97 );

/**
 * Remove 404 body classes for virtual cluster routes.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function nexus_add_virtual_cluster_body_class( $classes ) {
	$slug = nexus_get_current_wgos_cluster_route_slug();

	if ( '' === $slug ) {
		return $classes;
	}

	$classes   = array_diff( $classes, [ 'error404' ] );
	$classes[] = 'page';
	$classes[] = 'page-' . sanitize_html_class( $slug );
	$classes[] = 'page-template-default';

	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'nexus_add_virtual_cluster_body_class', 20 );

/**
 * Return the versioned mapping from blog articles to WGOS asset recommendations.
 *
 * @return array<string, array<string, mixed>>
 */
function nexus_get_wgos_blog_asset_bridge_data() {
	static $bridges = null;

	if ( null !== $bridges ) {
		return $bridges;
	}

	$agentur_url             = nexus_get_primary_public_url( 'agentur', home_url( '/wordpress-agentur-hannover/' ) );
	$tracking_url            = nexus_get_primary_public_url( 'tracking', home_url( '/ga4-tracking-setup/' ) );
	$cwv_url                 = nexus_get_primary_public_url( 'cwv', home_url( '/core-web-vitals/' ) );
	$cro_url                 = nexus_get_primary_public_url( 'cro', home_url( '/conversion-rate-optimization/' ) );
	$performance_marketing_url = nexus_get_primary_public_url( 'performance_marketing', home_url( '/performance-marketing/' ) );

	$seo_foundation_bridge = [
		'title' => 'Passende WGOS-Bausteine zu diesem Thema',
		'intro' => 'Wenn Performance Marketing an technischer Reibung und einer instabilen SEO-Basis scheitert, sind diese Bausteine meist der nächste sinnvolle Schritt:',
		'assets' => [
			'technical-seo-audit' => 'Macht technische Indexierungs-, Redirect- und Strukturprobleme sichtbar, die Rankings und Kampagnenwirkung ausbremsen.',
			'cwv-speed-audit'      => 'Zeigt, ob Ladezeit, Layout Shifts oder Render-Blocking die Nachfrage schon vor dem Angebot ausbremsen.',
			'cwv-optimierung'      => 'Setzt die größten Performance-Fixes dort um, wo sie Rankings und Conversion direkt entlasten.',
		],
		'supporting_link' => [
			'label' => 'WordPress für B2B in Hannover',
			'url'   => $agentur_url,
			'text'  => 'Wenn Sie für dieses Thema einen lokalen Einstieg suchen, ist die Agentur-Seite der direkte Anschluss zwischen SEO, Technik und Conversion.',
		],
	];

	$bridges = [
		'technisches-seo-performance-fundament' => $seo_foundation_bridge,
		'warum-performance-marketing-ohne-technisches-seo-geld-verbrennt' => $seo_foundation_bridge,
		'owned-leads-statt-ad-miete' => [
			'title' => 'Passende WGOS-Bausteine zu diesem Thema',
			'intro' => 'Wenn das Problem nicht nur mehr Traffic, sondern die falsche Nachfrage-Logik ist, sind das die nächsten sinnvollen Bausteine:',
			'assets' => [
				'growth-audit'             => 'Klärt zuerst, ob Angebot, Tracking oder Seitenlogik die Anfragequalität bremsen.',
				'angebotsseiten-architektur' => 'Ordnet Angebotsseiten so, dass aus Nachfrage ein klar geführter nächster Schritt wird.',
				'landing-page-neu'         => 'Baut den Einstieg neu auf, wenn bezahlte oder organische Nachfrage bisher auf die falsche Zielseite trifft.',
			],
		],
		'b2b-landingpage-optimieren' => [
			'title' => 'Passende WGOS-Bausteine zu diesem Artikel',
			'intro' => 'Wenn Sie die Gedanken aus dem Artikel konkret in Ihre Website übersetzen wollen, starten meist diese Bausteine:',
			'assets' => [
				'landing-page-optimierung' => 'Hebt bestehende Landing Pages an Headline, Struktur und Reibung an.',
				'cta-formular-optimierung' => 'Prüft Formulare und CTA-Hürden dort, wo qualifizierte Besucher heute aussteigen.',
				'angebotsseiten-architektur' => 'Sichert, dass einzelne Landing Pages in eine konsistente Angebotslogik eingebettet sind.',
			],
			'supporting_link' => [
				'label' => 'WordPress für B2B in Hannover',
				'url'   => $agentur_url,
				'text'  => 'Wenn Landing Pages Teil eines größeren WordPress-Systems werden sollen, führt die lokale Agentur-Seite direkt in den passenden Kontext.',
			],
		],
		'meta-ads-fuer-b2b' => [
			'title' => 'WGOS-Bausteine für kampagnenfähige Zielseiten',
			'intro' => 'Kampagnenstrukturen wirken nur so gut wie Tracking und Zielseite. Diese Bausteine sind meist der nächste Hebel:',
			'assets' => [
				'landing-page-neu'         => 'Baut Seiten mit sauberem Message Match für bezahlte Nachfrage auf.',
				'landing-page-optimierung' => 'Verbessert bestehende Zielseiten, wenn Kampagnen zwar klicken, aber nicht sauber konvertieren.',
				'tracking-audit'           => 'Prüft, ob Kampagnendaten und Conversion-Signale überhaupt belastbar ankommen.',
			],
			'supporting_link' => [
				'label' => 'Performance Marketing',
				'url'   => $performance_marketing_url,
				'text'  => 'Wenn Kampagnen schon laufen oder vorbereitet werden, ist die Performance-Marketing-Seite der saubere Anschluss zwischen Zielseite, Tracking und Paid-Aktivierung.',
			],
		],
		'design-ist-mehr-als-aesthetik' => [
			'title' => 'WGOS-Bausteine für Conversion-Architektur',
			'intro' => 'Wenn Design die Orientierung und den nächsten Schritt verbessern soll, sind diese Bausteine die konkrete Übersetzung:',
			'assets' => [
				'angebotsseiten-architektur' => 'Ordnet Seiten, Botschaften und Proof in eine klare Angebotslogik.',
				'cta-formular-optimierung' => 'Reduziert Reibung im letzten Schritt zwischen Interesse und Anfrage.',
			],
			'supporting_link' => [
				'label' => 'Conversion Rate Optimization',
				'url'   => $cro_url,
				'text'  => 'Wenn aus guter Gestaltung auch eine klarere Nutzerführung werden soll, führt die CRO-Seite direkt in den passenden Service-Kontext.',
			],
		],
		'server-side-tracking-gtm' => [
			'title' => 'WGOS-Bausteine für belastbare Messbarkeit',
			'intro' => 'Server-Side Tracking ist selten der erste Schritt. Diese Bausteine sorgen für die richtige Reihenfolge:',
			'assets' => [
				'server-side-tracking' => 'Setzt serverseitige Signalverarbeitung technisch sauber um.',
				'tracking-audit'       => 'Klärt vorher, wo Browser-Tracking, Event-Setup und Datenqualität heute brechen.',
				'consent-mode-v2'      => 'Ordnet Datenschutz und Signalverluste, damit die Umsetzung fachlich belastbar bleibt.',
			],
			'supporting_link' => [
				'label' => 'GA4 Tracking Setup',
				'url'   => $tracking_url,
				'text'  => 'Wenn Tracking nicht nur technisch, sondern als stabile Entscheidungsgrundlage aufgebaut werden soll, ist die Tracking-Seite der direkte Einstieg.',
			],
		],
		'core-web-vitals-wachstum-seo-und-roas' => [
			'title' => 'WGOS-Bausteine für Performance als Hebel',
			'intro' => 'Wenn Performance nicht nur ein Symptom, sondern ein Wachstumshebel ist, greifen meist diese drei Bausteine ineinander:',
			'assets' => [
				'cwv-speed-audit' => 'Zeigt, welche technischen Bremsen auf den wichtigen Seitentypen wirklich Priorität haben.',
				'cwv-optimierung' => 'Setzt die größten Performance-Fixes gezielt um.',
				'server-tuning'   => 'Geht tiefer in Infrastruktur, Caching und TTFB, wenn der Bottleneck nicht im Frontend endet.',
			],
			'supporting_link' => [
				'label' => 'Core Web Vitals',
				'url'   => $cwv_url,
				'text'  => 'Wenn Sie das Thema als kaufnahe Service-Seite statt nur als Insight vertiefen wollen, ist die Core-Web-Vitals-Seite der direkte Anschluss.',
			],
		],
	];

	return $bridges;
}

/**
 * Resolve one blog-to-asset bridge by post slug or current post.
 *
 * @param string|WP_Post|null $value Post slug or post object.
 * @return array<string, mixed>|null
 */
function nexus_get_wgos_blog_asset_bridge( $value = null ) {
	if ( null === $value ) {
		$value = get_post();
	}

	if ( ! ( $value instanceof WP_Post ) ) {
		$value = get_post();
	}

	if ( ! ( $value instanceof WP_Post ) || 'post' !== $value->post_type ) {
		return null;
	}

	$slug    = sanitize_title( (string) $value->post_name );
	$bridges = nexus_get_wgos_blog_asset_bridge_data();

	return $bridges[ $slug ] ?? null;
}

/**
 * Render the blog-to-asset bridge block for single posts.
 *
 * @param array<string, mixed> $bridge Bridge definition.
 * @return string
 */
function nexus_render_wgos_blog_asset_bridge( $bridge ) {
	$cards = nexus_get_wgos_cluster_page_asset_cards( $bridge );
	$supporting_link = isset( $bridge['supporting_link'] ) && is_array( $bridge['supporting_link'] ) ? $bridge['supporting_link'] : [];

	ob_start();
	?>
	<section class="nx-asset-bridge" data-track-section="blog_asset_bridge">
		<div class="nx-asset-bridge__inner">
			<span class="nx-asset-bridge__kicker">WGOS-Anschluss</span>
			<h2 class="nx-asset-bridge__title"><?php echo esc_html( (string) $bridge['title'] ); ?></h2>
			<p class="nx-asset-bridge__intro"><?php echo esc_html( (string) $bridge['intro'] ); ?></p>

			<div class="nx-asset-bridge__grid">
				<?php foreach ( $cards as $card ) : ?>
					<article class="nx-asset-bridge__card">
						<h3><a href="<?php echo esc_url( $card['url'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a></h3>
						<p><?php echo esc_html( $card['context'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<?php if ( ! empty( $supporting_link['url'] ) && ! empty( $supporting_link['label'] ) ) : ?>
				<p class="nx-asset-bridge__supporting-link">
					<?php if ( ! empty( $supporting_link['text'] ) ) : ?>
						<?php echo esc_html( (string) $supporting_link['text'] ); ?>
						<?php echo ' '; ?>
					<?php endif; ?>
					<a href="<?php echo esc_url( (string) $supporting_link['url'] ); ?>"><?php echo esc_html( (string) $supporting_link['label'] ); ?></a>
				</p>
			<?php endif; ?>
		</div>
	</section>
	<?php

	return trim( (string) ob_get_clean() );
}
