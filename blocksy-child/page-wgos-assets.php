<?php
/**
 * Template Name: WGOS Asset Hub
 * Description: Klickbare WGOS Asset-Landkarte
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url    = nexus_get_audit_url();
$calendar_url = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' );
$wgos_url     = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wordpress-growth-operating-system/' );
$payload      = function_exists( 'nexus_get_wgos_asset_explorer_payload' ) ? nexus_get_wgos_asset_explorer_payload() : [
	'wgosAssetPhases'  => [],
	'wgosAssetModules' => [],
	'wgosAssets'       => [],
	'summary'          => [],
];
$summary      = isset( $payload['summary'] ) && is_array( $payload['summary'] ) ? $payload['summary'] : [];
$asset_count  = isset( $summary['totalAssets'] ) ? (int) $summary['totalAssets'] : count( $payload['wgosAssets'] );
$publish_count = isset( $summary['publishedAssets'] ) ? (int) $summary['publishedAssets'] : 0;
$draft_count   = isset( $summary['draftAssets'] ) ? (int) $summary['draftAssets'] : 0;
$phase_count   = isset( $payload['wgosAssetPhases'] ) && is_array( $payload['wgosAssetPhases'] ) ? count( $payload['wgosAssetPhases'] ) : 0;
$module_count  = isset( $payload['wgosAssetModules'] ) && is_array( $payload['wgosAssetModules'] ) ? count( $payload['wgosAssetModules'] ) : 0;
$hub_sections  = function_exists( 'nexus_get_wgos_asset_hub_sections' ) ? nexus_get_wgos_asset_hub_sections() : [];

$nav_items = [
	[
		'id'    => 'context',
		'label' => 'Struktur',
	],
	[
		'id'    => 'explorer',
		'label' => 'Explorer',
	],
	[
		'id'    => 'library',
		'label' => 'Assets',
	],
	[
		'id'    => 'proof',
		'label' => 'Proof',
	],
	[
		'id'    => 'audit',
		'label' => 'Audit',
	],
];

$hero_layers = [
	[
		'phase' => 'Ebene 01',
		'title' => 'Phasen',
		'text'  => 'zeigen die Reihenfolge, in der operative Tiefe im System sinnvoll wird.',
	],
	[
		'phase' => 'Ebene 02',
		'title' => 'Module',
		'text'  => 'gruppieren Assets nach Funktion statt nach losen Einzelleistungen.',
	],
	[
		'phase' => 'Ebene 03',
		'title' => 'Assets',
		'text'  => 'sind die konkreten Eingriffe, die später priorisiert und umgesetzt werden.',
	],
];

$problem_points = [
	'Ohne Struktur wirken Assets wie ein Katalog statt wie ein System.',
	'Credits und Detailseiten verlieren an Klarheit, wenn die Reihenfolge fehlt.',
	'Zu viele operative Optionen erzeugen eher Reibung als Entscheidungssicherheit.',
	'Die strategische Hauptseite wird schnell zu dicht, wenn sie jede Tiefe mittragen soll.',
];

$logic_cards = [
	[
		'step'    => '01',
		'label'   => 'Strategische Ebene',
		'title'   => 'WGOS-System',
		'copy'    => 'Die Hauptseite erklärt das Operating Model, die Reihenfolge und die Logik hinter dem System.',
		'outcome' => 'Sie verstehen, warum die Ebenen zusammenspielen.',
	],
	[
		'step'    => '02',
		'label'   => 'Operative Ebene',
		'title'   => 'Systemlandkarte',
		'copy'    => 'Diese Seite zeigt alle vorhandenen Bausteine nach Phasen und Modulen sortiert.',
		'outcome' => 'Sie sehen schnell, welche Assets überhaupt verfügbar sind.',
	],
	[
		'step'    => '03',
		'label'   => 'Entscheidungs-Ebene',
		'title'   => 'Growth Audit',
		'copy'    => 'Der Audit priorisiert, welcher Einstieg in Ihrer Lage zuerst Sinn ergibt.',
		'outcome' => 'Aus Übersicht wird eine belastbare Reihenfolge.',
	],
];

$authority_cards = [
	[
		'title' => $publish_count > 0
			? sprintf( '%d operative Bausteine', $publish_count )
			: 'Operative Bausteine',
		'copy'  => 'Jedes Asset hat eine eigene Detailseite mit Ergebnis, Voraussetzung und klarem nächsten Schritt.',
	],
	[
		'title' => 'Feste Reihenfolge statt Bauchladen',
		'copy'  => 'Drei Phasen geben vor, wann welcher Baustein Sinn ergibt, damit nichts auf Verdacht umgesetzt wird.',
	],
	[
		'title' => 'Ein System, keine Einzelleistungen',
		'copy'  => 'Alle Assets greifen ineinander. Credits, Abhängigkeiten und Ergebnisse sind transparent dokumentiert.',
	],
];

$audit_outcomes = [
	'Welcher Kernbereich zuerst zählt und welcher bewusst warten sollte.',
	'Welche Assets echte Priorität haben und welche nur später sinnvoll werden.',
	'Ob eine kleine Korrektur, Folgeanalyse oder direkte Umsetzung der nächste richtige Schritt ist.',
];

$draft_note = $draft_count > 0
	? sprintf( '%d weitere Assets sind intern vorbereitet, aber bewusst nicht als fertige Detailseiten vorausgeschoben.', $draft_count )
	: '';
?>

<main id="main" class="site-main">
	<div class="wgos-wrapper">
		<nav class="wgos-smart-nav" id="wgos-nav" aria-label="WGOS Asset Hub Navigation">
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
						<span class="wgos-kicker">WGOS Systemlandkarte</span>
						<h1 class="wgos-hero__title">WGOS Systemlandkarte für klare Prioritäten und operative Tiefe.</h1>
						<p class="wgos-hero__subtitle">Die Systemlandkarte übersetzt WGOS in Phasen, Module und Assets, damit operative Optionen sofort verständlicher werden und nicht wie ein loses Leistungsmenü wirken.</p>

						<ul class="wgos-hero__bullets">
							<li>Phasen statt Katalogdenken</li>
							<li>Module statt Einzelleistungen</li>
							<li>Assets mit direkter Tiefe</li>
						</ul>

						<div class="wgos-trust-strip wgos-trust-strip--hero" aria-label="Strukturelle Kennzahlen">
							<div class="wgos-trust-item">
								<span class="wgos-trust-value"><?php echo esc_html( (string) $phase_count ); ?></span>
								<span class="wgos-trust-label">Phasen</span>
							</div>
							<div class="wgos-trust-item">
								<span class="wgos-trust-value"><?php echo esc_html( (string) $module_count ); ?></span>
								<span class="wgos-trust-label">Kernmodule</span>
							</div>
							<div class="wgos-trust-item">
								<span class="wgos-trust-value"><?php echo esc_html( (string) $asset_count ); ?></span>
								<span class="wgos-trust-label">versionierte Assets</span>
							</div>
						</div>

						<div class="wgos-hero__actions">
							<a href="#explorer" class="wgos-btn wgos-btn--primary" data-track="cta_click_explorer">Explorer öffnen</a>
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit_hero">Growth Audit starten</a>
						</div>

						<p class="wgos-hero__microcopy">Erst die strategische Logik sehen? <a href="<?php echo esc_url( $wgos_url ); ?>">Zum WGOS-System</a>.</p>
					</div>

					<aside class="wgos-hero-card" aria-label="So lesen Sie die Landkarte">
						<span class="wgos-principle-kicker">So lesen Sie die Landkarte</span>
						<div class="wgos-phase-list">
							<?php foreach ( $hero_layers as $hero_layer ) : ?>
								<article class="wgos-phase-list__item">
									<span class="wgos-phase-list__label"><?php echo esc_html( $hero_layer['phase'] ); ?></span>
									<p class="wgos-phase-list__title"><?php echo esc_html( $hero_layer['title'] ); ?></p>
									<p><?php echo esc_html( $hero_layer['text'] ); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
						<p class="wgos-hero-card__note">Die Hauptseite erklärt die Logik. Diese Seite zeigt die operative Ebene darunter.</p>
					</aside>
				</div>
			</div>
		</section>

		<section id="context" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Warum diese Struktur</span>
					<h2 class="wgos-h2">Operative Tiefe braucht Reihenfolge, nicht nur Auswahl.</h2>
					<p class="wgos-section-intro">Viele Leistungsübersichten scheitern nicht an fehlender Tiefe, sondern an fehlender Struktur. Die Systemlandkarte sortiert deshalb alle Bausteine nach drei Ebenen:</p>
				</div>

				<div class="wgos-phase-grid" aria-label="Drei Ebenen der Systemlandkarte">
					<?php foreach ( $logic_cards as $logic_card ) : ?>
						<article class="wgos-phase-card">
							<div class="wgos-phase-card__top">
								<span class="wgos-phase-card__step"><?php echo esc_html( $logic_card['step'] ); ?></span>
								<div>
									<span class="wgos-phase-card__eyebrow"><?php echo esc_html( $logic_card['label'] ); ?></span>
									<h3><?php echo esc_html( $logic_card['title'] ); ?></h3>
								</div>
							</div>
							<p><?php echo esc_html( $logic_card['copy'] ); ?></p>
							<div class="wgos-phase-card__meta">
								<span>Ergebnis</span>
								<p><?php echo esc_html( $logic_card['outcome'] ); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="explorer" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Asset Explorer</span>
					<h2 class="wgos-h2">Schneller Einstieg: klicken, vergleichen, vertiefen.</h2>
					<p class="wgos-section-intro">Der Explorer ist die schnellste Lesart dieser Seite. Er zeigt Phasen, Module und Assets in einer klickbaren Übersicht, ohne Sie sofort in Detailseiten zu ziehen.</p>
				</div>

				<div class="wgos-map-guide" aria-label="Explorer Nutzung">
					<span>1. Phase lesen</span>
					<span>2. Modul vergleichen</span>
					<span>3. Asset vertiefen</span>
				</div>

				<div id="wgos-asset-explorer-root" class="wgos-asset-explorer-root"></div>
				<noscript>
					<p class="wgos-section-intro">Der Explorer benötigt JavaScript. Die einzelnen Assets sind weiterhin über die WGOS Asset-Detailseiten erreichbar.</p>
				</noscript>
			</div>
		</section>

		<section id="library" class="wgos-section wgos-section--gray">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Arbeitsansicht</span>
					<h2 class="wgos-h2">Alle Assets fest gruppiert, lesbar und sofort einordenbar.</h2>
					<p class="wgos-section-intro">Unter dem Explorer folgt die ruhigere Arbeitsansicht für Menschen, die lieber scannen als klicken: nach Modulen gruppiert, mit Credits, Ergebnis und nächstem sinnvollen Kontext.</p>
				</div>

				<div class="wgos-hub-sections">
					<?php $prev_phase_step = ''; ?>
					<?php $hub_index = 0; ?>
					<?php foreach ( $hub_sections as $section ) : ?>
						<?php if ( '' !== $prev_phase_step && $prev_phase_step !== (string) $section['phase_step'] ) : ?>
							<div class="wgos-hub-phase-bridge">
								<p>Wissen Sie bereits, welche Assets für Sie Priorität haben?</p>
								<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit_bridge">Growth Audit starten</a>
							</div>
						<?php endif; ?>
						<?php $prev_phase_step = (string) $section['phase_step']; ?>
						<details class="wgos-hub-section-card nx-reveal"<?php echo 0 === $hub_index ? ' open' : ''; ?> style="--wgos-module-accent: <?php echo esc_attr( (string) $section['accent'] ); ?>;">
						<?php ++$hub_index; ?>
							<summary class="wgos-hub-section-card__head" aria-labelledby="<?php echo esc_attr( $section['module_id'] . '-list' ); ?>">
								<div>
									<span class="wgos-hub-section-card__phase"><?php echo esc_html( (string) $section['phase_step'] ); ?> · <?php echo esc_html( (string) $section['phase_label'] ); ?></span>
									<h3 id="<?php echo esc_attr( $section['module_id'] . '-list' ); ?>">
										<span class="wgos-hub-section-card__number"><?php echo esc_html( (string) $section['module_no'] ); ?></span>
										<?php echo esc_html( (string) $section['module'] ); ?>
									</h3>
								</div>
								<div class="wgos-hub-section-card__side">
									<p><?php echo esc_html( (string) $section['summary'] ); ?></p>
									<span class="wgos-hub-section-card__count"><?php echo esc_html( (string) count( (array) $section['items'] ) ); ?> Assets</span>
								</div>
							</summary>

							<div class="wgos-hub-asset-grid">
								<?php foreach ( (array) $section['items'] as $item ) : ?>
									<?php
									$is_live          = 'publish' === (string) $item['status'];
									$status_label     = $is_live ? 'Live' : 'Im Aufbau';
									$asset_link       = $is_live ? (string) $item['url'] : '#audit';
									$asset_cta_label  = $is_live ? 'Asset im Detail' : 'Im Audit einordnen';
									?>
									<article id="<?php echo esc_attr( (string) $item['id'] ); ?>" class="wgos-hub-asset-card">
										<div class="wgos-hub-asset-card__top">
											<div>
												<?php if ( $is_live ) : ?>
													<h4><a href="<?php echo esc_url( $asset_link ); ?>"><?php echo esc_html( (string) $item['title'] ); ?></a></h4>
												<?php else : ?>
													<h4><?php echo esc_html( (string) $item['title'] ); ?></h4>
												<?php endif; ?>
												<p><?php echo esc_html( (string) $item['goal'] ); ?></p>
											</div>
											<div class="wgos-hub-asset-card__meta">
												<span><?php echo esc_html( (string) $item['credits'] ); ?> Credits</span>
												<span class="wgos-hub-asset-card__status<?php echo $is_live ? ' is-live' : ' is-draft'; ?>"><?php echo esc_html( $status_label ); ?></span>
											</div>
										</div>

										<dl class="wgos-hub-asset-card__facts">
											<div>
												<dt>Ergebnis</dt>
												<dd><?php echo esc_html( (string) $item['result'] ); ?></dd>
											</div>
											<div>
												<dt>Voraussetzung</dt>
												<dd><?php echo esc_html( (string) $item['prerequisite'] ); ?></dd>
											</div>
											<div>
												<dt>Fokus</dt>
												<dd><?php echo esc_html( (string) $item['keyword'] ); ?></dd>
											</div>
										</dl>

										<div class="wgos-hub-asset-card__actions">
											<a href="<?php echo esc_url( $asset_link ); ?>" class="wgos-btn wgos-btn--outline"><?php echo esc_html( $asset_cta_label ); ?></a>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="wgos-asset-hub-bridge">
				<div class="wgos-note-card">
					<h3>KI-Bausteine im WGOS</h3>
					<p>Vier neue Assets für KI-Integration: Chatbot, Lead-Qualifizierung, Wissenssuche und Automatisierung – DSGVO-konform, auf eigener Infrastruktur.</p>
					<a href="<?php echo esc_url( home_url( '/ki-integration-wordpress/' ) ); ?>" class="wgos-link--arrow">KI-Integration ansehen</a>
				</div>
			</div>
		</section>

		<section id="proof" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Struktureller Proof</span>
					<h2 class="wgos-h2">Diese Karte wirkt belastbar, weil sie nicht nur schön gruppiert ist, sondern systemisch sauber gebaut ist.</h2>
				</div>

				<div class="wgos-proof-grid">
					<?php foreach ( $authority_cards as $authority_card ) : ?>
						<article class="wgos-proof-card">
							<p class="wgos-proof-card__label"><?php echo esc_html( $authority_card['title'] ); ?></p>
							<p class="wgos-proof-card__context"><?php echo esc_html( $authority_card['copy'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>

				<?php if ( '' !== $draft_note ) : ?>
					<p class="wgos-section-note"><?php echo esc_html( $draft_note ); ?></p>
				<?php endif; ?>
			</div>
		</section>

		<section id="audit" class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-audit-shell">
					<div class="wgos-audit-copy">
						<span class="wgos-principle-kicker">Audit-Einstieg</span>
						<h2 class="wgos-h2">Die Landkarte zeigt Möglichkeiten. Der Audit klärt, womit Sie beginnen sollten.</h2>
						<div class="wgos-prose">
							<p>Wenn Sie nicht nur die vorhandenen Assets sehen, sondern die richtige Reihenfolge für Ihre Situation wollen, ist der Growth Audit der sinnvolle Übergang von Orientierung zu Entscheidung.</p>
						</div>

						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Growth Audit starten</a>
						</div>

						<p class="wgos-hero__microcopy">Lieber erst sprechen? <a href="<?php echo esc_url( $calendar_url ); ?>" data-track="cta_click_calendar">Strategiegespräch vereinbaren</a>.</p>
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
	</div>
</main>

<?php get_footer(); ?>
