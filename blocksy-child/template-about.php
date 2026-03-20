<?php
/**
 * Template Name: Nexus Über Mich
 * Description: Persönliche Positionsseite mit ruhiger CTA-Logik
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$audit_url = home_url( '/growth-audit/' );

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
		'text'  => 'Diagnostisch, priorisiert und ohne Aktionismus',
	],
	[
		'label' => 'Standort',
		'text'  => 'Region Hannover, Projekte im DACH-Raum',
	],
];

$principles = [
	[
		'title' => 'Klarheit vor Aktivität',
		'text'  => 'Eine Website muss verständlich machen, was ein Unternehmen anbietet, für wen das relevant ist und warum man den nächsten Schritt gehen sollte.',
	],
	[
		'title' => 'Struktur vor Zufall',
		'text'  => 'Gute Ergebnisse entstehen nicht durch lose Einzelseiten, sondern durch saubere Informationsarchitektur, klare Nutzerführung und sinnvolle Prioritäten.',
	],
	[
		'title' => 'Ownership vor Blackbox',
		'text'  => 'Digitale Systeme sollten nachvollziehbar, wartbar und kontrolliert weiterentwickelbar sein - ohne unnötige Abhängigkeit von Tools, Dienstleistern oder Intransparenz.',
	],
];

$problem_cards = [
	[
		'title' => 'Vorhanden, aber nicht eindeutig',
		'text'  => 'Viele Unternehmensseiten sind sichtbar, aber nicht klar genug. Sie sagen zu spät, worum es wirklich geht, für wen das Angebot relevant ist und warum genau hier Vertrauen entstehen sollte.',
	],
	[
		'title' => 'Sie informieren, führen aber nicht',
		'text'  => 'Es gibt Inhalte, Seiten und oft auch einzelne gute Ansätze. Aber zwischen Angebot, Nutzerführung, Relevanz und nächster Entscheidung fehlt die verbindende Logik. Die Website ist da, aber sie führt nicht konsequent.',
	],
	[
		'title' => 'Online, aber schwer weiterzuentwickeln',
		'text'  => 'Wenn Struktur, Messbarkeit und technische Grundlage nicht sauber aufgesetzt sind, fehlt die Basis für Lernen, Priorisierung und systematische Verbesserung.',
	],
];

$website_roles = [
	[
		'title' => 'Als Übersetzung von Leistung',
		'text'  => 'Eine Website zeigt, wie klar ein Unternehmen sein Angebot, seine Relevanz und seine Arbeitsweise nach außen vermittelt.',
	],
	[
		'title' => 'Als Nutzerführungssystem',
		'text'  => 'Sie sollte Besucher nicht nur informieren, sondern verständlich durch Inhalte, Angebote und nächste Schritte führen.',
	],
	[
		'title' => 'Als Grundlage für Entscheidungen',
		'text'  => 'Sie sollte sichtbar machen, wo Reibung entsteht, welche Seiten tragen und an welchen Stellen Optimierung überhaupt sinnvoll ist.',
	],
	[
		'title' => 'Als digitale Basis für Weiterentwicklung',
		'text'  => 'Sie sollte technisch sauber, wartbar und kontrolliert ausbaubar sein - statt bei jeder Änderung wieder neue Unsicherheit zu erzeugen.',
	],
];

$practice_areas = [
	[
		'title' => 'Positionierung und Angebotsklarheit',
		'text'  => 'Ich arbeite daran, dass ein Unternehmen verständlich sagen kann, was es anbietet, warum das relevant ist und welche Seiten diese Klarheit tragen müssen.',
	],
	[
		'title' => 'Informationsarchitektur und Nutzerführung',
		'text'  => 'Ich strukturiere Inhalte, Seiten und nächste Schritte so, dass eine Website nicht nur Informationen zeigt, sondern Orientierung gibt und Entscheidungen erleichtert.',
	],
	[
		'title' => 'WordPress als steuerbare Grundlage',
		'text'  => 'Ich nutze WordPress nicht als bloße Oberfläche, sondern als flexible und kontrollierbare Basis für Inhalte, Templates, Performance und operative Weiterentwicklung.',
	],
	[
		'title' => 'Messbarkeit mit Sinn',
		'text'  => 'Ich setze auf privacy-first Messbarkeit, um bessere Entscheidungen zu ermöglichen - nicht, um möglichst viele Daten ohne Nutzen zu sammeln.',
	],
	[
		'title' => 'Technische Qualität',
		'text'  => 'Performance, technische SEO und saubere Systemlogik sind für mich Teil einer Website, die im Alltag funktionieren und langfristig tragen soll.',
	],
	[
		'title' => 'Weiterentwicklung ohne Abhängigkeit',
		'text'  => 'Mein Ziel ist eine Grundlage, auf der Änderungen nachvollziehbar bleiben und Entwicklung nicht jedes Mal wieder bei null beginnt.',
	],
];

$work_principles = [
	[
		'title' => 'Diagnose vor Aktion',
		'text'  => 'Bevor man optimiert, muss klar sein, wo das eigentliche Problem liegt: in Positionierung, Struktur, Nutzerführung, technischer Basis oder Messbarkeit.',
	],
	[
		'title' => 'Priorität vor Maßnahmenstapel',
		'text'  => 'Nicht jede Aufgabe ist gleich wichtig. Entscheidend ist, welche Änderungen zuerst den größten Unterschied machen.',
	],
	[
		'title' => 'Grundlage vor Skalierung',
		'text'  => 'Wenn Angebotsseiten, Messung oder technische Basis nicht tragen, verschärfen zusätzliche Kanäle oft nur vorhandene Probleme.',
	],
	[
		'title' => 'Entwicklung statt Dauer-Relaunch',
		'text'  => 'Ich denke lieber in kontrollierten Schritten mit nachvollziehbarer Logik als in immer neuen Neustarts mit wenig Lerngewinn.',
	],
];

$fit_yes = [
	'Für B2B-Unternehmen, deren Website geschäftlich etwas leisten soll.',
	'Für Entscheider, die Klarheit, Substanz und gute Reihenfolge höher gewichten als schnellen Output.',
	'Für Teams, die Ownership, Datenschutz und eine wartbare Grundlage nicht als Detail, sondern als Vorteil verstehen.',
	'Für Unternehmen, die aus WordPress mehr machen wollen als einen gepflegten Online-Auftritt.',
];

$fit_no = [
	'Nicht passend für reine Kosmetik ohne Ursachenarbeit.',
	'Nicht passend, wenn die Website nur Fassade sein soll und nicht Teil der geschäftlichen Wirklichkeit.',
	'Nicht passend für Maßnahmensammlungen ohne Priorität.',
	'Nicht passend, wenn Intransparenz, Blackboxen oder maximale Dienstleister-Abhängigkeit kein Problem sind.',
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
						<h1 class="about-hero__title">Ich entwickle Websites, die für Unternehmen mehr leisten als Präsenz.</h1>
						<p class="about-hero__lead">
							Eine Website sollte nicht nur gut aussehen oder technisch laufen. Sie sollte verständlich machen, was ein Unternehmen anbietet,
							Vertrauen aufbauen, relevante Anfragen unterstützen und eine belastbare Grundlage für Sichtbarkeit, Nutzerführung und Weiterentwicklung schaffen.
						</p>
						<p class="about-hero__text">
							Genau daran arbeite ich: an WordPress-Systemen, die Klarheit, Struktur, technische Qualität und sinnvolle Messbarkeit miteinander verbinden.
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
								Growth Audit starten
							</a>
						</p>
					</div>

					<aside class="about-profile-card" aria-label="Profil und Arbeitsverständnis">
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
							<p class="about-profile-card__quote">
								Ich arbeite an der Schnittstelle von Kommunikation, Struktur, technischer Umsetzung und geschäftlicher Klarheit.
							</p>
							<ul class="about-profile-card__list">
								<li>Ich übersetze erklärungsbedürftige Leistungen in verständliche digitale Strukturen.</li>
								<li>Ich behandle Kommunikation, Nutzerführung und technische Umsetzung als zusammenhängende Aufgabe.</li>
								<li>Ich denke Web, SEO, Tracking und Projektkoordination nicht nebeneinander, sondern als System.</li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<section id="about-values" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Haltung</span>
					<h2 class="nx-headline-section">Wofür ich stehe</h2>
					<p class="about-section__intro">
						Mich interessiert Website-Arbeit nicht als Sammlung einzelner Maßnahmen, sondern als geschäftlich relevante Klarheitsarbeit.
					</p>
				</div>

				<div class="about-principle-grid">
					<?php foreach ( $principles as $principle ) : ?>
						<article class="about-principle-card">
							<h3><?php echo esc_html( $principle['title'] ); ?></h3>
							<p><?php echo esc_html( $principle['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="about-problem" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Problembild</span>
					<h2 class="nx-headline-section">Warum viele Websites geschäftlich zu wenig leisten</h2>
					<p class="about-section__intro">
						Viele Unternehmensseiten wirken auf den ersten Blick ordentlich. Trotzdem bleiben sie oft unter ihren Möglichkeiten - nicht wegen fehlender Arbeit, sondern wegen eines zu kleinen Verständnisses ihrer eigentlichen Aufgabe.
					</p>
				</div>

				<div class="about-problem-grid">
					<?php foreach ( $problem_cards as $card ) : ?>
						<article class="about-quiet-card">
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>

				<p class="about-section__closing">
					Eine schwache Website ist deshalb nicht nur ein ästhetisches Problem. Sie kostet Klarheit, erschwert Vertrauen und lässt Potenzial ungenutzt, das längst hätte wirksam werden können.
				</p>
			</div>
		</section>

		<section id="about-why" class="nx-section about-section">
			<div class="nx-container">
				<div class="about-personal">
					<div class="about-personal__intro">
						<span class="nx-badge nx-badge--ghost">Persönlicher Hintergrund</span>
						<h2 class="nx-headline-section">Warum ich so arbeite</h2>
						<p class="about-personal__lead">
							Mein Zugang zu Websites kommt nicht aus einer rein visuellen Perspektive. Er kommt aus Kommunikation, digitaler Umsetzung,
							Projektkoordination und der Arbeit in B2B-Kontexten, in denen Anforderungen verstanden, übersetzt und tragfähig umgesetzt werden müssen.
						</p>
					</div>

					<div class="about-personal__body">
						<p>
							Dabei habe ich immer wieder dasselbe gesehen: Digitale Probleme entstehen selten zuerst durch fehlende Tools.
							Sie entstehen durch unklare Sprache, schwache Struktur, fehlende Verbindung zwischen Inhalt und Nutzerführung und eine technische Grundlage,
							auf der sich kaum sinnvoll weiterarbeiten lässt.
						</p>

						<div class="about-personal__signals" aria-label="Folgen fehlender Klarheit">
							<p class="about-personal__signal">Unklare Sprache erzeugt Reibung.</p>
							<p class="about-personal__signal">Schwache Struktur erzeugt Orientierungslosigkeit.</p>
							<p class="about-personal__signal">Fehlende Messbarkeit erschwert Lernen.</p>
						</div>

						<p>
							Und eine unsaubere Grundlage macht Weiterentwicklung teuer, langsam oder beliebig.
						</p>
						<p>
							Deshalb arbeite ich nicht zuerst an Oberfläche, sondern an der Frage, ob eine Website geschäftlich verständlich,
							führend und tragfähig ist.
						</p>
					</div>
				</div>
			</div>
		</section>

		<section id="about-understanding" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Verständnis</span>
					<h2 class="nx-headline-section">Wie ich Websites verstehe</h2>
					<p class="about-section__intro">
						Ich sehe eine professionelle Website nicht als Objekt, das man einmal gestaltet und dann verwaltet.
						Ich sehe sie als geschäftlich relevante Infrastruktur.
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
					Darum beginne ich nicht bei „schöner machen“, sondern bei Struktur, Verständlichkeit, Führung und technischer Tragfähigkeit.
				</p>
			</div>
		</section>

		<section id="about-practice" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<span class="nx-badge nx-badge--ghost">Praxis</span>
					<h2 class="nx-headline-section">Was meine Arbeit in der Praxis ist</h2>
					<p class="about-section__intro">
						Von außen wirkt das oft wie klassische Website-Arbeit. In der Praxis geht es um etwas Konkreteres:
						digitale Kommunikation, Nutzerführung, technische Grundlage und Weiterentwicklung so zu ordnen,
						dass ein Unternehmen online klarer, belastbarer und wirksamer aufgestellt ist.
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
						Ich arbeite diagnostisch und priorisiert. Mich interessiert nicht, möglichst schnell möglichst viele Maßnahmen zu produzieren.
						Mich interessiert, zuerst die richtige Reihenfolge sichtbar zu machen.
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
					<h2 class="nx-headline-section">Für wen das passt — und für wen eher nicht</h2>
					<p class="about-section__intro">
						Diese Art der Arbeit passt gut, wenn eine Website geschäftlich ernst genommen wird - und weniger, wenn sie nur Fassade bleiben soll.
					</p>
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
						Ich arbeite an Websites, die Unternehmen online verständlicher, strukturierter und belastbarer machen.
					</p>
					<p>
						Nicht als reine Oberfläche. Sondern als Grundlage für Sichtbarkeit, Nutzerführung, Vertrauen und Weiterentwicklung.
					</p>
					<p>
						Mich interessiert an digitaler Arbeit nicht, dass sie beschäftigt wirkt. Mich interessiert, dass sie trägt.
					</p>
					<p>
						Wenn Sie das Gefühl haben, dass Ihre Website zwar vorhanden ist, aber geschäftlich noch zu wenig leistet, lässt sich das strukturiert prüfen.
					</p>
					<p class="about-close__actions">
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_final_audit"
							data-track-category="lead_gen"
							data-track-section="about_close"
						>
							Growth Audit starten
						</a>
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
