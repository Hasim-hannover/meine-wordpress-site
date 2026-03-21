<?php
/**
 * Template Name: Nexus Über Mich
 * Description: Persönliche Positionsseite — kompakt, praxisnah, 5 Sektionen
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$audit_url   = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$contact_url = function_exists( 'nexus_get_contact_url' ) ? nexus_get_contact_url() : home_url( '/kontakt/' );
$analysis_contact_url = add_query_arg(
	[
		'type' => 'analysis',
	],
	$contact_url
);

$hero_facts = [
	[
		'label' => 'Rolle',
		'text'  => 'Growth Architect mit B2B-Fokus',
	],
	[
		'label' => 'Fokus',
		'text'  => 'WordPress, technische SEO, privacy-first Messbarkeit und klare Nutzerführung',
	],
	[
		'label' => 'Arbeitsweise',
		'text'  => 'Diagnostisch und priorisiert',
	],
	[
		'label' => 'Standort',
		'text'  => 'Region Hannover, Projekte im DACH-Raum',
	],
];

$project_phases = [
	[
		'label' => 'Woche 1–2',
		'title' => 'Audit',
		'text'  => [
			'Ein Maschinenbauer aus Niedersachsen, 40 Mitarbeiter. Website seit 2019, nie strategisch angefasst. Ich schaue mir Startseite, Angebotsseiten, Tracking-Setup und Search Console an.',
			'Ergebnis: Die Website rankt für den Firmennamen, aber für kein kaufnahes Keyword. Das Kontaktformular hat kein Event-Tracking. Die Startseite erzählt die Firmengeschichte statt das Angebot.',
		],
	],
	[
		'label' => 'Woche 3–4',
		'title' => 'Priorisierung',
		'text'  => [
			'Drei Hebel zuerst: H1 und Subtext auf allen Angebotsseiten umschreiben. Tracking-Events für Formular und Telefonklicks einrichten. Eine Pillar Page für das Haupt-Keyword aufbauen.',
		],
	],
	[
		'label' => 'Monat 2–3',
		'title' => 'Umsetzung',
		'text'  => [
			'Angebotsseiten umgebaut, Tracking live, Pillar Page veröffentlicht. Erste organische Anfragen nach 8 Wochen.',
		],
	],
	[
		'label' => 'Monat 4+',
		'title' => 'Weiterentwicklung',
		'text'  => [
			'Datenbasiert weiterarbeiten: Welche Seiten konvertieren? Wo springen Besucher ab? Was ist der nächste Hebel?',
		],
	],
];

$services = [
	'Positionierung und Angebotsklarheit auf Startseiten und Angebotsseiten',
	'Informationsarchitektur und Seitenstruktur',
	'Technische SEO und Core Web Vitals',
	'Privacy-first Tracking und Consent',
	'Conversion-Optimierung bestehender Seiten',
	'WordPress als steuerbare, wartbare Infrastruktur',
];

get_header();
?>

<main id="main" class="site-main">
	<div class="nexus-about" data-track-section="about_page">

		<!-- Sektion 1: Hero -->
		<section id="about-hero" class="nx-section about-hero">
			<div class="nx-container">
				<div class="about-hero__grid">
					<div class="about-hero__copy">
						<span class="nx-badge nx-badge--gold">Über mich</span>
						<h1 class="about-hero__title">Ich entwickle Websites, die für Unternehmen mehr leisten als Präsenz.</h1>
						<p class="about-hero__lead">
							WordPress-Systeme für B2B, die Klarheit, Struktur und messbare Wirkung verbinden.
						</p>

						<dl class="about-hero__facts">
							<?php foreach ( $hero_facts as $fact ) : ?>
								<div class="about-hero__fact">
									<dt><?php echo esc_html( $fact['label'] ); ?></dt>
									<dd><?php echo esc_html( $fact['text'] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<p class="about-hero__actions">
							<a
								href="<?php echo esc_url( $audit_url ); ?>"
								class="nx-btn nx-btn--ghost"
								data-track-action="cta_about_hero_audit"
								data-track-category="lead_gen"
								data-track-section="about_hero"
							>
								<?php echo esc_html( nexus_get_audit_cta_label() ); ?>
							</a>
						</p>
					</div>

					<aside class="about-profile-card" aria-label="Profil">
						<figure class="about-profile-card__media">
							<img
								src="https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp"
								alt="Haşim Üner, Growth Architect"
								loading="eager"
								width="340"
								height="420"
							/>
						</figure>
						<div class="about-profile-card__body">
							<span class="about-profile-card__eyebrow">Haşim Üner</span>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<!-- Sektion 2: Ein typisches Projekt -->
		<section id="about-project" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Wie ein Projekt mit mir aussieht.</h2>
				</div>

				<div class="about-project-timeline">
					<?php foreach ( $project_phases as $phase ) : ?>
						<div class="about-project-phase">
							<span class="about-project-phase__label"><?php echo esc_html( $phase['label'] ); ?></span>
							<h3><?php echo esc_html( $phase['title'] ); ?></h3>
							<?php foreach ( $phase['text'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- Sektion 3: Was ich anfasse -->
		<section id="about-services" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Was ich anfasse.</h2>
				</div>

				<ul class="about-services-list">
					<?php foreach ( $services as $service ) : ?>
						<li><?php echo esc_html( $service ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

		<!-- Sektion 4: Hintergrund -->
		<section id="about-background" class="nx-section about-section">
			<div class="nx-container">
				<div class="about-background">
					<h2 class="nx-headline-section">Hintergrund.</h2>
					<p>
						Mein Zugang kommt aus Medienwissenschaften und B2B-Projektarbeit, nicht aus Design.
						Ich denke in Systemen: Kommunikation, Technik, Daten und Nutzerführung als zusammenhängende Aufgabe.
					</p>
					<dl class="about-background__meta">
						<div class="about-background__meta-item">
							<dt>Standort</dt>
							<dd>Pattensen bei Hannover.</dd>
						</div>
						<div class="about-background__meta-item">
							<dt>Projekte</dt>
							<dd>DACH-weit, remote und vor Ort.</dd>
						</div>
					</dl>
				</div>
			</div>
		</section>

		<!-- Sektion 5: Finaler CTA -->
		<section id="about-close" class="nx-section about-close">
			<div class="nx-container">
				<div class="about-close__inner">
					<h2 class="nx-headline-section">Prüfen wir Ihren Status quo.</h2>
					<p>Der Growth Audit zeigt, wo Ihre Website geschäftlich mehr leisten kann.</p>
					<p class="about-close__actions">
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_final_audit"
							data-track-category="lead_gen"
							data-track-section="about_close"
						>
							<?php echo esc_html( nexus_get_audit_cta_label() ); ?>
						</a>
						<a
							href="<?php echo esc_url( $analysis_contact_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_final_contact"
							data-track-category="navigation"
							data-track-section="about_close"
						>
							Kontakt
						</a>
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
