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
			'title'            => 'WordPress SEO Hannover',
			'lead'             => 'SEO fuer WordPress sollte keine lose Einzelleistung sein. Sichtbarkeit entsteht, wenn Technik, Themenstruktur und Conversion zusammenspielen.',
			'intro'            => [
				'Viele B2B-Websites investieren in Inhalte, ohne die eigentlichen Bremsen zu loesen. Dann entstehen Seiten, die zwar da sind, aber weder sauber ranken noch qualifizierte Anfragen vorbereiten.',
				'WordPress SEO wird dadurch schnell zur To-do-Liste aus Meta-Titeln, Blogartikeln und Plugin-Einstellungen. Was fehlt, ist die Reihenfolge: Erst die technische Basis, dann die Themenarchitektur und danach die conversion-nahe Seite.',
				'Genau dort setzt WGOS an. Wir bauen Sichtbarkeit nicht als Content-Fleissaufgabe, sondern als Nachfrage-System fuer wichtige Seitentypen auf.',
			],
			'system'           => [
				'Im WGOS ist SEO kein Solobaustein. Sichtbarkeit folgt auf ein tragfaehiges Fundament aus Performance, Messbarkeit und klarer Angebotslogik.',
				'Statt eine einzige SEO-Leistung zu verkaufen, ordnen wir die richtigen Bausteine fuer Ihre Lage. Das kann mit einem Technical SEO Audit starten, mit einer Keyword-Strategie weitergehen und spaeter in Pillar Pages, Content Hubs oder interne Verlinkung muenden.',
			],
			'assets'           => [
				'technical-seo-audit' => 'Findet Indexierungs- und Strukturprobleme, die Rankings bereits heute ausbremsen.',
				'keyword-strategie'   => 'Ordnet Nachfrage in Themen, Suchintentionen und priorisierte Seitentypen.',
				'pillar-page'         => 'Baut die zentrale Money Page fuer ein Kernthema mit klarer interner Verlinkung.',
				'content-hub'         => 'Verbindet Hauptseite und Cluster-Inhalte zu einem belastbaren Themen-System.',
				'on-page-seo'         => 'Schaerft Snippets, Seitentitel, Headlines und inhaltliche Fuehrung an der Suchintention.',
				'interne-verlinkung'  => 'Staerkt die wichtigsten Seiten ueber klare Pfade fuer Nutzer und Suchmaschine.',
				'schema-markup'       => 'Ergaenzt strukturierte Daten dort, wo sie Suchergebnisse und Verstaendnis verbessern.',
				'local-seo'           => 'Sichert lokale Relevanz fuer Hannover und regionale Nachfragepfade ab.',
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
			'meta_title'       => 'WordPress SEO Hannover | WGOS-System von Hasim Uener',
			'meta_description' => 'WordPress SEO Hannover als WGOS-Cluster: Technical SEO, Keyword-Strategie, Pillar Pages und klare Priorisierung statt Einzelleistungen.',
			'schema_name'      => 'WordPress SEO Hannover',
			'schema_description' => 'WGOS-Cluster fuer WordPress SEO in Hannover: technische Basis, Themenarchitektur und conversion-nahe Sichtbarkeit fuer B2B-Websites.',
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
				'Core Web Vitals gehoeren klar ins technische Fundament. Erst wenn LCP, Stabilitaet und Reaktionszeit auf kaufnahen Seitentypen stimmen, lohnen sich groessere Investitionen in SEO, Content und Landing Pages wirklich.',
				'Wir behandeln Performance deshalb nicht als Plugin-Thema, sondern als Systemarbeit zwischen Audit, Optimierung, Server-Layer und laufender Stabilisierung.',
			],
			'assets'           => [
				'cwv-speed-audit'  => 'Zeigt, welche Bremsen auf relevanten Seitentypen tatsaechlich zuerst geloest werden muessen.',
				'cwv-optimierung'  => 'Setzt die Diagnose in konkrete technische Korrekturen fuer Ladezeit und Nutzererlebnis um.',
				'server-tuning'    => 'Greift tiefer in Caching, TTFB und Infrastruktur ein, wenn das Hosting limitiert.',
				'security-hardening' => 'Sichert den Betrieb ab, damit eine schnelle Seite nicht durch technische Risiken kippt.',
				'plugin-audit'     => 'Raeumt unnoetige oder konflikttraechtige Plugins aus dem Stack, bevor sie weiter bremsen.',
				'update-management' => 'Haelt Performance-Gewinne stabil, weil Updates kontrolliert und testbar ausgerollt werden.',
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
			'meta_title'       => 'Core Web Vitals fuer WordPress | WGOS von Hasim Uener',
			'meta_description' => 'Core Web Vitals als WGOS-Cluster: Audit, Optimierung, Server-Tuning und Stabilisierung fuer schnellere WordPress-Seiten.',
			'schema_name'      => 'Core Web Vitals fuer WordPress',
			'schema_description' => 'WGOS-Cluster fuer Core Web Vitals: Performance-Diagnose, Optimierung und technisches Fundament fuer B2B-WordPress-Websites.',
		],
		'ga4-tracking-setup' => [
			'eyebrow'          => 'Messbarkeit im WGOS',
			'title'            => 'GA4 Tracking Setup',
			'lead'             => 'Tracking soll Entscheidungen ermoeglichen, nicht nur Dashboards fuellen. Ohne saubere Daten bleibt Optimierung Vermutung.',
			'intro'            => [
				'Viele Unternehmen haben GA4, GTM und Consent technisch installiert. Trotzdem fehlen belastbare Antworten auf einfache Fragen: Welche Seiten erzeugen Nachfrage, welcher Kanal bringt die besseren Leads und wo bricht die Nutzerfuehrung weg?',
				'Das Problem liegt selten in einem einzigen Tag. Meist fehlen Event-Logik, Consent-Verhalten, UTM-Standards und eine sinnvolle Management-Sicht auf dieselben Daten.',
				'Im WGOS wird Messbarkeit deshalb als eigener Kernbereich behandelt. Erst mit sauberen Signalen wird aus Website-Arbeit eine steuerbare Wachstumslogik.',
			],
			'system'           => [
				'Messbarkeit folgt im WGOS auf ein stabiles technisches Fundament und laeuft vor groesseren Conversion- oder Reporting-Schritten. Sonst werden Entscheidungen auf verrauschten Daten getroffen.',
				'Wir koppeln Tracking nicht von der Website ab. Audit, Event-Blueprint, Consent, serverseitige Signalverarbeitung und Dashboards gehoeren zusammen.',
			],
			'assets'           => [
				'tracking-audit'       => 'Prueft, wo Daten fehlen, doppelt feuern oder an Consent und Setups scheitern.',
				'ga4-event-blueprint'  => 'Definiert Events, KPI-Logik und Funnel-Schritte fuer echte Entscheidungsfaehigkeit.',
				'consent-mode-v2'      => 'Bringt Datenschutz und Signalqualitaet in ein sauberes technisches Modell.',
				'server-side-tracking' => 'Stabilisiert Messung ueber Browser-Grenzen hinweg mit sGTM oder Matomo.',
				'kpi-dashboard'        => 'Verdichtet Rohdaten in eine Fuehrungssicht fuer Management und Marketing.',
				'utm-framework'        => 'Sichert Benennung und Attribution ueber Kampagnen und Teams hinweg.',
			],
			'blogs'            => [
				[
					'title' => 'Datenhoheit mit Server-Side GTM',
					'url'   => home_url( '/server-side-tracking-gtm/' ),
				],
			],
			'meta_title'       => 'GA4 Tracking Setup | WGOS-Cluster von Hasim Uener',
			'meta_description' => 'GA4 Tracking Setup als WGOS-Cluster: Tracking Audit, Event-Blueprint, Consent und serverseitige Messung fuer belastbare Daten.',
			'schema_name'      => 'GA4 Tracking Setup',
			'schema_description' => 'WGOS-Cluster fuer GA4, GTM und Tracking: belastbare Messbarkeit fuer B2B-WordPress-Websites.',
		],
		'conversion-rate-optimization' => [
			'eyebrow'          => 'Conversion im WGOS',
			'title'            => 'Conversion Rate Optimization',
			'lead'             => 'Conversion entsteht nicht am Formularende. Sie beginnt dort, wo Besucher in wenigen Sekunden verstehen, warum sie hier richtig sind.',
			'intro'            => [
				'Viele Seiten haben Traffic, aber keine klare Nutzerfuehrung. Angebot, Proof, CTA und Einwandabbau arbeiten dann nicht als System, sondern nebeneinander.',
				'Das fuehrt zu vermeidbaren Verlusten: zu viele irrelevante Klicks, zu wenig qualifizierte Anfragen und eine Website, die zwar informiert, aber nicht fuehrt.',
				'Im WGOS behandeln wir Conversion deshalb als Architektur. Die richtige Seite, das richtige Versprechen und der naechste sinnvolle Schritt muessen zusammenpassen.',
			],
			'system'           => [
				'Conversion folgt im WGOS auf ein technisches und messbares Fundament. Erst wenn Daten und Performance stimmen, lassen sich Angebotsseiten, Landing Pages und Formulare belastbar optimieren.',
				'Wir denken CRO dabei nicht als Testlabor ohne Kontext, sondern als Verbindung aus Angebotslogik, Seitenrollen, Botschaft, Proof und klarer CTA-Hierarchie.',
			],
			'assets'           => [
				'landing-page-neu'            => 'Baut neue Landing Pages mit sauberem Message Match und klarer Zielhandlung auf.',
				'landing-page-optimierung'    => 'Hebt bestehende Seiten an den Engpaessen aus Headline, Aufbau und Reibung an.',
				'cta-formular-optimierung'    => 'Prueft Formulare, Huerden und CTA-Logik dort, wo Nachfrage verloren geht.',
				'angebotsseiten-architektur'  => 'Ordnet Angebotsseiten so, dass Nutzen, Proof und naechster Schritt zusammenarbeiten.',
				'social-proof'                => 'Setzt Vertrauenssignale gezielt ein, statt sie lose ueber die Seite zu verteilen.',
				'lead-magnet'                 => 'Schafft risikoarme Einstiege fuer Besucher, die noch nicht direkt anfragen wollen.',
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
			'meta_title'       => 'Conversion Rate Optimization | WGOS von Hasim Uener',
			'meta_description' => 'CRO als WGOS-Cluster: Landing Pages, Angebotsseiten, Formulare und Proof fuer mehr qualifizierte WordPress-Anfragen.',
			'schema_name'      => 'Conversion Rate Optimization',
			'schema_description' => 'WGOS-Cluster fuer Conversion Rate Optimization: Angebotslogik, Landing Pages und CTA-Fuehrung fuer B2B-WordPress-Websites.',
		],
		'performance-marketing' => [
			'eyebrow'          => 'Paid-Kontext im WGOS',
			'title'            => 'Performance Marketing',
			'lead'             => 'Paid darf Nachfrage verstaerken, aber keine strukturellen Fehler verdecken. Ohne Fundament wird Budget nur schneller verbrannt.',
			'intro'            => [
				'Viele Teams starten mit Kampagnen, bevor technische Basis, Tracking und Angebotsseite stabil stehen. Dann werden Klicks eingekauft, aber Reibung bleibt unangetastet.',
				'Das Ergebnis sind teure Leads, unsaubere Attribution und Landing Pages, die den Traffic nicht in qualifizierte Gespraeche uebersetzen.',
				'Im WGOS ist Performance Marketing deshalb kein Startpunkt, sondern ein Aktivierungslayer. Erst wenn Seite und Messbarkeit tragen, lohnt sich Reichweite wirklich.',
			],
			'system'           => [
				'Performance Marketing sitzt im WGOS nie isoliert vor Technik und Messbarkeit. Die bezahlte Verstaerkung kommt erst dann nach vorne, wenn die wichtigen Signale und Seitentypen bereits stabil laufen.',
				'Wir betrachten deshalb immer die Kombination aus Diagnose, Tracking, Angebot und Landing Page. Paid wird so zum Hebel fuer ein System, nicht zum Ersatz dafuer.',
			],
			'assets'           => [
				'growth-audit'              => 'Klaert zuerst, ob wirklich Paid der Engpass ist oder ob Fundament und Angebot bremsen.',
				'tracking-audit'            => 'Sichert, dass Kampagnendaten und Conversion-Signale ueberhaupt belastbar sind.',
				'ga4-event-blueprint'       => 'Definiert, welche Events und KPI-Schritte fuer Kampagnensteuerung wirklich zaehlen.',
				'technical-seo-audit'       => 'Verhindert, dass bezahlter Traffic auf technisch schwache Seiten trifft.',
				'landing-page-neu'          => 'Baut die Seite, die Kampagnenversprechen sauber in eine Anfrage ueberfuehrt.',
				'landing-page-optimierung'  => 'Hebt bestehende Kampagnenseiten an den groessten Conversion-Bremsen an.',
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
			'meta_title'       => 'Performance Marketing im WGOS | Hasim Uener',
			'meta_description' => 'Performance Marketing als WGOS-Aktivierungslayer: erst Tracking, Technik und Landing Page, dann Reichweite mit sauberer Priorisierung.',
			'schema_name'      => 'Performance Marketing fuer B2B-WordPress-Websites',
			'schema_description' => 'WGOS-Cluster fuer Performance Marketing: Paid-Aktivierung erst nach technischem Fundament, Tracking und conversion-starken Zielseiten.',
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
 * Render the shared WGOS cluster page layout.
 *
 * @param array<string, mixed> $page Cluster page definition.
 * @return string
 */
function nexus_render_wgos_cluster_page( $page ) {
	$audit_url    = nexus_get_audit_url();
	$wgos_url     = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wordpress-growth-operating-system/' );
	$asset_hub_url = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : home_url( '/wgos-systemlandkarte/' );
	$cards        = nexus_get_wgos_cluster_page_asset_cards( $page );
	$blogs        = isset( $page['blogs'] ) && is_array( $page['blogs'] ) ? $page['blogs'] : [];

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
						<p>Diese Seite ist keine isolierte Service-Landingpage mehr. Sie ordnet das Thema in die WGOS-Logik ein und zeigt die passenden Bausteine fuer den naechsten sinnvollen Schritt.</p>
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
					<h2 class="nx-headline-section">Wie wir das im WGOS loesen</h2>
				</div>

				<div class="nx-prose nx-cluster-prose">
					<?php foreach ( (array) ( $page['system'] ?? [] ) as $paragraph ) : ?>
						<p><?php echo esc_html( (string) $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section nx-cluster-section">
			<div class="nx-container nx-cluster-stack">
				<div class="nx-section-header">
					<span class="nx-badge nx-badge--ghost">Cluster</span>
					<h2 class="nx-headline-section">Die passenden WGOS-Bausteine</h2>
					<p class="nx-subheadline">Jeder Baustein loest einen klaren Teil des Problems. Gemeinsam entsteht daraus ein belastbares Cluster statt einer losen Leistungssammlung.</p>
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
					<span class="nx-cluster-cta__kicker">Naechster Schritt</span>
					<h2 class="nx-headline-section">Erst die Lage klaeren. Dann den richtigen Baustein priorisieren.</h2>
					<p>Der Growth Audit zeigt, ob dieses Cluster jetzt dran ist oder ob Fundament, Messbarkeit oder Angebotslogik zuerst korrigiert werden muessen.</p>
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
 * Force key legacy routes onto versioned cluster templates.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_force_cluster_route_templates( $template ) {
	if ( is_admin() || ! is_page() ) {
		return $template;
	}

	$route_templates = [
		'wordpress-seo-hannover'      => get_stylesheet_directory() . '/page-seo.php',
		'core-web-vitals'             => get_stylesheet_directory() . '/page-cwv.php',
		'conversion-rate-optimization' => get_stylesheet_directory() . '/page-cro.php',
		'ga4-tracking-setup'          => get_stylesheet_directory() . '/page-ga4.php',
		'performance-marketing'       => get_stylesheet_directory() . '/page-performance.php',
	];

	foreach ( $route_templates as $slug => $forced_template ) {
		if ( is_page( $slug ) && file_exists( $forced_template ) ) {
			return $forced_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'nexus_force_cluster_route_templates', 97 );

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

	$seo_foundation_bridge = [
		'title' => 'Passende WGOS-Bausteine zu diesem Thema',
		'intro' => 'Wenn Performance Marketing an technischer Reibung und einer instabilen SEO-Basis scheitert, sind diese Bausteine meist der naechste sinnvolle Schritt:',
		'assets' => [
			'technical-seo-audit' => 'Macht technische Indexierungs-, Redirect- und Strukturprobleme sichtbar, die Rankings und Kampagnenwirkung ausbremsen.',
			'cwv-speed-audit'      => 'Zeigt, ob Ladezeit, Layout Shifts oder Render-Blocking die Nachfrage schon vor dem Angebot ausbremsen.',
			'cwv-optimierung'      => 'Setzt die groessten Performance-Fixes dort um, wo sie Rankings und Conversion direkt entlasten.',
		],
		'supporting_link' => [
			'label' => 'WordPress Agentur Hannover',
			'url'   => nexus_get_page_url( [ 'wordpress-agentur-hannover', 'wordpress-agentur' ], home_url( '/wordpress-agentur-hannover/' ) ),
			'text'  => 'Wenn Sie fuer dieses Thema einen lokalen Einstieg suchen, ist die Agentur-Seite der direkte Anschluss zwischen SEO, Technik und Conversion.',
		],
	];

	$bridges = [
		'technisches-seo-performance-fundament' => $seo_foundation_bridge,
		'warum-performance-marketing-ohne-technisches-seo-geld-verbrennt' => $seo_foundation_bridge,
		'owned-leads-statt-ad-miete' => [
			'title' => 'Passende WGOS-Bausteine zu diesem Thema',
			'intro' => 'Wenn das Problem nicht nur mehr Traffic, sondern die falsche Nachfrage-Logik ist, sind das die naechsten sinnvollen Bausteine:',
			'assets' => [
				'growth-audit'             => 'Klaert zuerst, ob Angebot, Tracking oder Seitenlogik die Anfragequalitaet bremsen.',
				'angebotsseiten-architektur' => 'Ordnet Angebotsseiten so, dass aus Nachfrage ein klar gefuehrter naechster Schritt wird.',
				'landing-page-neu'         => 'Baut den Einstieg neu auf, wenn bezahlte oder organische Nachfrage bisher auf die falsche Zielseite trifft.',
			],
		],
		'b2b-landingpage-optimieren' => [
			'title' => 'Passende WGOS-Bausteine zu diesem Artikel',
			'intro' => 'Wenn Sie die Gedanken aus dem Artikel konkret in Ihre Website uebersetzen wollen, starten meist diese Bausteine:',
			'assets' => [
				'landing-page-optimierung' => 'Hebt bestehende Landing Pages an Headline, Struktur und Reibung an.',
				'cta-formular-optimierung' => 'Prueft Formulare und CTA-Huerden dort, wo qualifizierte Besucher heute aussteigen.',
				'angebotsseiten-architektur' => 'Sichert, dass einzelne Landing Pages in eine konsistente Angebotslogik eingebettet sind.',
			],
			'supporting_link' => [
				'label' => 'WordPress Agentur Hannover',
				'url'   => nexus_get_page_url( [ 'wordpress-agentur-hannover', 'wordpress-agentur' ], home_url( '/wordpress-agentur-hannover/' ) ),
				'text'  => 'Wenn Landing Pages Teil eines groesseren WordPress-Systems werden sollen, fuehrt die lokale Agentur-Seite direkt in den passenden Kontext.',
			],
		],
		'meta-ads-fuer-b2b' => [
			'title' => 'WGOS-Bausteine fuer kampagnenfaehige Zielseiten',
			'intro' => 'Kampagnenstrukturen wirken nur so gut wie Tracking und Zielseite. Diese Bausteine sind meist der naechste Hebel:',
			'assets' => [
				'landing-page-neu'         => 'Baut Seiten mit sauberem Message Match fuer bezahlte Nachfrage auf.',
				'landing-page-optimierung' => 'Verbessert bestehende Zielseiten, wenn Kampagnen zwar klicken, aber nicht sauber konvertieren.',
				'tracking-audit'           => 'Prueft, ob Kampagnendaten und Conversion-Signale ueberhaupt belastbar ankommen.',
			],
		],
		'design-ist-mehr-als-aesthetik' => [
			'title' => 'WGOS-Bausteine fuer Conversion-Architektur',
			'intro' => 'Wenn Design die Orientierung und den naechsten Schritt verbessern soll, sind diese Bausteine die konkrete Uebersetzung:',
			'assets' => [
				'angebotsseiten-architektur' => 'Ordnet Seiten, Botschaften und Proof in eine klare Angebotslogik.',
				'cta-formular-optimierung' => 'Reduziert Reibung im letzten Schritt zwischen Interesse und Anfrage.',
			],
		],
		'server-side-tracking-gtm' => [
			'title' => 'WGOS-Bausteine fuer belastbare Messbarkeit',
			'intro' => 'Server-Side Tracking ist selten der erste Schritt. Diese Bausteine sorgen fuer die richtige Reihenfolge:',
			'assets' => [
				'server-side-tracking' => 'Setzt serverseitige Signalverarbeitung technisch sauber um.',
				'tracking-audit'       => 'Klaert vorher, wo Browser-Tracking, Event-Setup und Datenqualitaet heute brechen.',
				'consent-mode-v2'      => 'Ordnet Datenschutz und Signalverluste, damit die Umsetzung fachlich belastbar bleibt.',
			],
		],
		'core-web-vitals-wachstum-seo-und-roas' => [
			'title' => 'WGOS-Bausteine fuer Performance als Hebel',
			'intro' => 'Wenn Performance nicht nur ein Symptom, sondern ein Wachstumshebel ist, greifen meist diese drei Bausteine ineinander:',
			'assets' => [
				'cwv-speed-audit' => 'Zeigt, welche technischen Bremsen auf den wichtigen Seitentypen wirklich Prioritaet haben.',
				'cwv-optimierung' => 'Setzt die groessten Performance-Fixes gezielt um.',
				'server-tuning'   => 'Geht tiefer in Infrastruktur, Caching und TTFB, wenn der Bottleneck nicht im Frontend endet.',
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
