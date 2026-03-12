<?php
/**
 * Template Name: Nexus Über Mich
 * Description: Ruhige Vertrauens- und Positionierungsseite ohne harte CTA-Logik
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wgos_url = nexus_get_page_url(
	[ 'wordpress-growth-operating-system', 'wgos' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$cases_url = nexus_get_results_url();
$agentur_url = nexus_get_page_url(
	[ 'wordpress-agentur-hannover', 'wordpress-agentur' ],
	home_url( '/wordpress-agentur-hannover/' )
);

$hero_facts = [
	[
		'label' => 'Rolle',
		'text'  => 'Growth Architect mit B2B-Fokus',
	],
	[
		'label' => 'Fokus',
		'text'  => 'WordPress, technische SEO, privacy-first Messbarkeit und Conversion-Logik',
	],
	[
		'label' => 'Arbeitsweise',
		'text'  => 'Diagnostisch, priorisiert und ohne Aktionismus',
	],
	[
		'label' => 'Standort',
		'text'  => 'Pattensen bei Hannover, Projekte im DACH-Raum',
	],
];

$website_roles = [
	[
		'title' => 'Außendarstellung',
		'text'  => 'Eine Website zeigt, wie klar ein Unternehmen sein Angebot, seine Relevanz und seine Haltung nach außen übersetzt.',
	],
	[
		'title' => 'Vertriebsoberfläche',
		'text'  => 'Sie führt Besucher über Angebotsseiten, Proof und den nächsten sinnvollen Schritt nicht zufällig, sondern mit Absicht.',
	],
	[
		'title' => 'Signal- und Datenquelle',
		'text'  => 'Sie macht sichtbar, welche Seiten tragen, wo Reibung entsteht und welche Signale für Entscheidungen wirklich zählen.',
	],
	[
		'title' => 'Digitale Infrastruktur',
		'text'  => 'Sie sollte wartbar, nachvollziehbar und kontrolliert weiterentwickelbar sein und nicht in einer Blackbox enden.',
	],
];

$practice_areas = [
	[
		'title' => 'Positionierung und Klarheit',
		'text'  => 'Ich schärfe, was ein Unternehmen anbietet, wie es sich einordnet und welche Seiten diese Klarheit tragen müssen.',
	],
	[
		'title' => 'Struktur und Nutzerführung',
		'text'  => 'Ich arbeite an Informationsarchitektur, Angebotsseiten, Proof und Nutzerwegen, damit eine Website nicht nur informiert, sondern führt.',
	],
	[
		'title' => 'WordPress als steuerbares System',
		'text'  => 'Ich nutze WordPress nicht als bloße Oberfläche, sondern als kontrollierbare Basis für Inhalte, Templates, Performance und operative Weiterentwicklung.',
	],
	[
		'title' => 'Messbarkeit und Signale',
		'text'  => 'Ich verbinde privacy-first Measurement mit echter KPI-Klarheit, damit Teams nicht mehr Daten sammeln, sondern bessere Entscheidungen treffen.',
	],
	[
		'title' => 'Ownership und Weiterentwicklung',
		'text'  => 'Ich arbeite auf eine wartbare Umgebung hin: nachvollziehbare Änderungen, weniger unnötige Abhängigkeiten und keine künstliche Blackbox.',
	],
	[
		'title' => 'Technische Grundlage',
		'text'  => 'Performance, technische SEO und saubere Systemlogik sind für mich kein Spezialthema nebenbei, sondern Teil einer tragfähigen Website-Arbeit.',
	],
];

$work_principles = [
	[
		'title' => 'Diagnose vor Meinung',
		'text'  => 'Ich versuche nicht früh zu verkaufen, sondern früh zu verstehen, wo Klarheit fehlt, wo Struktur bricht und wo Reibung tatsächlich entsteht.',
	],
	[
		'title' => 'Priorisierung vor Aktionismus',
		'text'  => 'Nicht jede Maßnahme ist gleich wichtig. Entscheidend ist, welche Eingriffe zuerst die größte Wirkung auf Verständnis, Signale und Anfrageführung haben.',
	],
	[
		'title' => 'Saubere Grundlage vor Skalierung',
		'text'  => 'Wenn Angebotsseiten, Messung oder technische Basis nicht tragen, verschärfen zusätzliche Kanäle oft nur vorhandene Probleme.',
	],
	[
		'title' => 'Weiterentwicklung statt Dauer-Relaunch',
		'text'  => 'Ich denke lieber in kontrollierten Schritten mit nachvollziehbarer Logik als in immer neuen Neustarts mit wenig Lerngewinn.',
	],
];

$fit_yes = [
	'Für B2B-Unternehmen, deren Website geschäftlich etwas leisten soll.',
	'Für Entscheider, die Klarheit, Substanz und gute Reihenfolge höher gewichten als schnellen Output.',
	'Für Teams, die Ownership, Datenschutz und eine wartbare Grundlage als echten Vorteil verstehen.',
	'Für Unternehmen, die aus WordPress mehr machen wollen als einen gepflegten Online-Auftritt.',
];

$fit_no = [
	'Nichterstkontakt für reine Visitenkarten oder schnelle Kosmetik ohne Ursachenarbeit.',
	'Nicht passend, wenn die Website nur Fassade sein soll und nicht Teil der operativen Wirklichkeit.',
	'Nicht passend für Tool-Stapel und Maßnahmensammlungen ohne Priorität.',
	'Nicht passend, wenn maximale Abhängigkeit von Dienstleistern oder Blackboxen kein Problem ist.',
];

get_header();
?>

<main id="main" class="site-main">
	<div class="nexus-about" data-track-section="about_page">

		<section id="about-hero" class="nx-section about-hero">
			<div class="nx-container">
				<div class="about-hero__grid">
					<div class="about-hero__copy">
						<span class="nx-badge nx-badge--gold">Über mich</span>
						<h1 class="about-hero__title">Ich bin Hasim Üner. Ich arbeite an WordPress-Systemen, nicht an dekorativen Oberflächen.</h1>
						<p class="about-hero__lead">
							Als Growth Architect verbinde ich Positionierung, Struktur, WordPress, technische SEO,
							privacy-first Messbarkeit und kontrollierte Weiterentwicklung. Mich interessiert nicht nur,
							wie eine Website aussieht, sondern ob sie für ein Unternehmen geschäftlich etwas trägt.
						</p>
						<p class="about-hero__text">
							Für mich ist eine Website heute nicht nur Außendarstellung. Sie ist Business-Plattform,
							Vertriebsoberfläche, Datenpunkt und digitale Infrastruktur für bessere Entscheidungen.
						</p>

						<dl class="about-hero__facts">
							<?php foreach ( $hero_facts as $fact ) : ?>
								<div class="about-hero__fact">
									<dt><?php echo esc_html( $fact['label'] ); ?></dt>
									<dd><?php echo esc_html( $fact['text'] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<p class="about-hero__context">
							Mehr Kontext dazu finden Sie dezent bei
							<a href="<?php echo esc_url( $wgos_url ); ?>">WGOS</a>,
							<a href="<?php echo esc_url( $cases_url ); ?>">Ergebnisse</a>
							und
							<a href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a>.
						</p>
					</div>

					<aside class="about-profile-card" aria-label="Profil und Arbeitsverständnis">
						<figure class="about-profile-card__media">
							<img
								src="https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp"
								alt="Hasim Üner, Growth Architect"
								loading="eager"
								width="340"
								height="420"
							/>
						</figure>
						<div class="about-profile-card__body">
							<span class="about-profile-card__eyebrow">Wofür ich stehe</span>
							<p class="about-profile-card__quote">
								Klarheit vor Aktionismus. Substanz vor Oberfläche. Ownership statt Blackbox.
							</p>
							<ul class="about-profile-card__list">
								<li>WordPress als Nachfrage-System statt digitaler Dekoration.</li>
								<li>Messbarkeit nur dort, wo sie Entscheidungen wirklich verbessert.</li>
								<li>Saubere, wartbare Grundlage statt Flickenteppich aus Zufallslösungen.</li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<section id="about-problem" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Denkrahmen</span>
					<h2 class="nx-headline-section">Warum viele Websites zu wenig leisten</h2>
					<p class="about-section__intro">
						Die meisten Websites sind nicht komplett schlecht. Sie sind nur zu isoliert gedacht.
						Sie sind da, aber sie führen zu wenig. Sie informieren, aber sie ordnen nicht sauber genug.
					</p>
				</div>

				<div class="about-problem-grid">
					<article class="about-quiet-card">
						<h3>Präsent, aber nicht führend</h3>
						<p>Viele Seiten beantworten zu spät, worum es eigentlich geht, für wen das Angebot relevant ist und warum man hier Vertrauen aufbauen sollte.</p>
					</article>
					<article class="about-quiet-card">
						<h3>Informativ, aber nicht steuerbar</h3>
						<p>Es gibt Inhalte und Tools, aber keine klare Verbindung zwischen Angebotsseiten, Nutzerführung, Signalen und nächster Entscheidung.</p>
					</article>
					<article class="about-quiet-card">
						<h3>Ordentlich, aber operativ zu schwach</h3>
						<p>Gerade im B2B entsteht Vertrauen oft vor dem ersten Gespräch. Wenn eine Website dort zu wenig Substanz zeigt, verliert sie schon sehr früh Wirkung.</p>
					</article>
				</div>
			</div>
		</section>

		<section id="about-understanding" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Website-Verständnis</span>
					<h2 class="nx-headline-section">Wie ich Websites verstehe</h2>
					<p class="about-section__intro">
						Ich sehe eine professionelle Website nicht als Objekt, das man einmal gestaltet und dann verwaltet.
						Ich sehe sie als geschäftlich relevante Business-Plattform mit mehreren Rollen gleichzeitig.
					</p>
				</div>

				<div class="about-role-grid">
					<?php foreach ( $website_roles as $role ) : ?>
						<article class="about-role-card">
							<h3><?php echo esc_html( $role['title'] ); ?></h3>
							<p><?php echo esc_html( $role['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>

				<p class="about-section__closing">
					Deshalb beginne ich nicht bei „schöner machen“, sondern bei Logik, Struktur, Führung, Signalen und der Frage,
					ob diese Website für das Unternehmen heute und später wirklich tragfähig ist.
				</p>
			</div>
		</section>

		<section id="about-practice" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Praxis</span>
					<h2 class="nx-headline-section">Was meine Arbeit in der Praxis ist</h2>
					<p class="about-section__intro">
						Nach außen wirkt das oft wie Website-Arbeit. In der Praxis ist es eher das Ordnen einer digitalen Betriebsfläche,
						damit Sichtbarkeit, Klarheit, Nutzerführung, Signale und Weiterentwicklung endlich zusammenpassen.
					</p>
				</div>

				<div class="about-practice-grid">
					<?php foreach ( $practice_areas as $area ) : ?>
						<article class="about-practice-card">
							<h3><?php echo esc_html( $area['title'] ); ?></h3>
							<p><?php echo esc_html( $area['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="about-method" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Arbeitsweise</span>
					<h2 class="nx-headline-section">Wie ich arbeite</h2>
					<p class="about-section__intro">
						Ich arbeite eher diagnostisch als agenturhaft. Mich interessiert nicht, möglichst früh Maßnahmen zu produzieren,
						sondern möglichst früh die richtige Reihenfolge sichtbar zu machen.
					</p>
				</div>

				<div class="about-method-grid">
					<?php foreach ( $work_principles as $index => $principle ) : ?>
						<article class="about-method-card">
							<span class="about-method-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h3><?php echo esc_html( $principle['title'] ); ?></h3>
							<p><?php echo esc_html( $principle['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="about-fit" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Passung</span>
					<h2 class="nx-headline-section">Für wen das passt und für wen eher nicht</h2>
				</div>

				<div class="about-fit-grid">
					<article class="about-fit-card about-fit-card--yes">
						<span class="about-fit-card__label">Passt</span>
						<ul>
							<?php foreach ( $fit_yes as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>

					<article class="about-fit-card about-fit-card--no">
						<span class="about-fit-card__label">Eher nicht</span>
						<ul>
							<?php foreach ( $fit_no as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				</div>
			</div>
		</section>

		<section id="about-close" class="nx-section about-close">
			<div class="nx-container">
				<div class="about-close__inner">
					<h2 class="nx-headline-section">Darauf läuft es hinaus</h2>
					<p>
						Ich baue keine Bühnenbilder für das Internet. Ich arbeite an WordPress-Systemen, die klarer machen,
						was ein Unternehmen anbietet, wie Nutzer geführt werden, welche Signale wirklich zählen und wie sich eine Website kontrolliert weiterentwickeln lässt.
					</p>
					<p>
						Wichtiger als eine schnelle Anfrage ist mir auf dieser Seite, dass klar wird, ob diese Art von Arbeit zu Ihrer Situation passt.
						Wenn Sie mehr Kontext wollen, finden Sie ihn bei
						<a href="<?php echo esc_url( $wgos_url ); ?>">WGOS</a>,
						<a href="<?php echo esc_url( $cases_url ); ?>">Ergebnisse</a>
						und
						<a href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a>.
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
