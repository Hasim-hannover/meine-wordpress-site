<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System - kompakte Sales-Page
 *
 * Content bleibt template-driven; SEO-Meta liegt zentral in inc/seo-meta.php.
 *
 * @package Blocksy_Child
 */

get_header();

$audit_url = nexus_get_audit_url();
$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
$page_url  = get_permalink( get_queried_object_id() );

if ( ! $page_url ) {
	$page_url = home_url( '/wgos/' );
}

$nav_items = [
	[
		'id'    => 'system',
		'label' => 'System',
	],
	[
		'id'    => 'proof',
		'label' => 'Proof',
	],
	[
		'id'    => 'pakete',
		'label' => 'Pakete',
	],
	[
		'id'    => 'module',
		'label' => 'Module',
	],
	[
		'id'    => 'ablauf',
		'label' => 'Ablauf',
	],
	[
		'id'    => 'faq',
		'label' => 'FAQ',
	],
];

$diagram_steps = [
	[
		'number' => '01',
		'title'  => 'Performance',
		'text'   => 'Speed, Stabilitaet und Core Web Vitals.',
	],
	[
		'number' => '02',
		'title'  => 'Security',
		'text'   => 'WordPress-Haertung, Backups und Betriebssicherheit.',
	],
	[
		'number' => '03',
		'title'  => 'Measurement',
		'text'   => 'Saubere Daten, Consent und serverseitige Signale.',
	],
	[
		'number' => '04',
		'title'  => 'Technical SEO',
		'text'   => 'Indexierung, interne Struktur und Suchmaschinenklarheit.',
	],
	[
		'number' => '05',
		'title'  => 'Content Engine',
		'text'   => 'Money Pages, Cluster und Proof-Assets.',
	],
	[
		'number' => '06',
		'title'  => 'CRO Engineering',
		'text'   => 'Angebot, CTA-Fuehrung und Conversion-Reibung senken.',
	],
	[
		'number' => '07',
		'title'  => 'Automation',
		'text'   => 'Routing, Reporting und Follow-up als Verstaerker.',
	],
];

$proof_cards = [
	[
		'value' => '1.750+',
		'label' => 'qualifizierte B2B-Leads in einem aufgebauten System',
	],
	[
		'value' => '-83%',
		'label' => 'Kosten pro Lead nach besserem Fundament und sauberer Messung',
	],
	[
		'value' => '98/100',
		'label' => 'Mobile Performance auf Kernseiten nach fokussierter Optimierung',
	],
];

$packages = [
	[
		'name'     => 'Fundament',
		'tagline'  => 'Technik, Sicherheit und Measurement stabilisieren',
		'price'    => 'ab 1.500 EUR',
		'credits'  => '30 Credits / Monat',
		'featured' => false,
		'features' => [
			'3 Monate Laufzeit',
			'1 Strategietermin pro Monat',
			'Performance, Security und Tracking priorisieren',
			'Monatlicher Fortschrittsreport',
		],
		'ideal'    => 'Fuer Teams, die zuerst technische und datenbezogene Reibung entfernen muessen.',
	],
	[
		'name'     => 'Aufbau',
		'tagline'  => 'Sichtbarkeit, Content und Conversion systematisch ausbauen',
		'price'    => 'ab 2.800 EUR',
		'credits'  => '60 Credits / Monat',
		'featured' => true,
		'features' => [
			'6 Monate Laufzeit',
			'2 Strategietermine pro Monat',
			'Fundament plus SEO-, Content- und CRO-Layer',
			'Review alle zwei Wochen',
		],
		'ideal'    => 'Fuer Unternehmen, die aus WordPress ein belastbares Lead-System machen wollen.',
	],
	[
		'name'     => 'Expansion',
		'tagline'  => 'Reichweite, Reporting und Automationen erweitern',
		'price'    => 'ab 4.500 EUR',
		'credits'  => '100+ Credits / Monat',
		'featured' => false,
		'features' => [
			'12 Monate Laufzeit',
			'Woeschentlicher Strategie-Slot',
			'Automation, Reporting und Skalierungshebel',
			'Dashboard und laufende Priorisierung',
		],
		'ideal'    => 'Fuer Teams mit stabilem Fundament, die Nachfrage und Prozesse konsequent skalieren wollen.',
	],
];

$credit_examples = [
	[
		'asset'   => 'CWV Optimierung',
		'focus'   => 'Performance',
		'credits' => '15',
	],
	[
		'asset'   => 'sGTM Setup',
		'focus'   => 'Measurement',
		'credits' => '15',
	],
	[
		'asset'   => 'Technical SEO Audit',
		'focus'   => 'SEO',
		'credits' => '10',
	],
	[
		'asset'   => 'Pillar Page',
		'focus'   => 'Content Engine',
		'credits' => '25',
	],
	[
		'asset'   => 'Landing Page (Neu)',
		'focus'   => 'CRO Engineering',
		'credits' => '20',
	],
];

$modules = [
	[
		'number'  => '01',
		'title'   => 'Performance',
		'bullets' => [
			'Core Web Vitals, Caching und technische Stabilitaet.',
			'Schnellere Seiten fuer Nutzer, SEO und Conversion.',
		],
	],
	[
		'number'  => '02',
		'title'   => 'Security',
		'bullets' => [
			'WordPress-Haertung, Backup-Logik und Update-Sicherheit.',
			'Weniger Risiko fuer Betrieb, Vertrauen und Leadfluss.',
		],
	],
	[
		'number'  => '03',
		'title'   => 'Measurement',
		'bullets' => [
			'GA4, GTM, Consent Mode und serverseitige Signale.',
			'Belastbare Daten fuer Priorisierung statt Reporting-Rauschen.',
		],
	],
	[
		'number'  => '04',
		'title'   => 'Technical SEO',
		'bullets' => [
			'Crawlbarkeit, Indexierung, interne Struktur und Schema.',
			'Die technische Basis fuer kaufnahe Sichtbarkeit.',
		],
	],
	[
		'number'  => '05',
		'title'   => 'Content Engine',
		'bullets' => [
			'Money Pages, Cluster-Inhalte und Case-Study-Proof.',
			'Assets, die Anfragen vorbereiten und weiterarbeiten.',
		],
	],
	[
		'number'  => '06',
		'title'   => 'CRO Engineering',
		'bullets' => [
			'Landing Pages, Proof-Layer, Formulare und CTA-Fuehrung.',
			'Weniger Reibung zwischen Besuch, Vertrauen und Anfrage.',
		],
	],
	[
		'number'  => '07',
		'title'   => 'Automation',
		'bullets' => [
			'Lead-Routing, Reporting und operative Entlastung.',
			'Automationen erst dann, wenn der Funnel sauber arbeitet.',
		],
	],
];

$process_steps = [
	[
		'number' => '1',
		'title'  => 'Growth Audit',
		'text'   => 'Wir erfassen Ausgangslage, Reibung und die groessten Hebel Ihrer WordPress-Seite.',
	],
	[
		'number' => '2',
		'title'  => '90-Tage-Roadmap',
		'text'   => 'Sie sehen Reihenfolge, Paketempfehlung und die KPIs, die wirklich beobachtet werden.',
	],
	[
		'number' => '3',
		'title'  => 'Monatliche Umsetzung',
		'text'   => 'Die priorisierten Assets werden gebaut, gemessen und im Report transparent weiterentwickelt.',
	],
];

$faq_items = [
	[
		'question' => 'Fuer wen passt das WGOS?',
		'answer'   => 'Fuer B2B-Unternehmen, die WordPress als echten Demand- und Vertriebs-Kanal nutzen und nicht nur als gepflegte Unternehmensseite.',
	],
	[
		'question' => 'Warum Credits statt Stunden?',
		'answer'   => 'Credits machen Umfang und Prioritaet planbar. Sie kaufen keinen offenen Zeitverbrauch, sondern klar bewertete Assets mit messbarer Rolle im System.',
	],
	[
		'question' => 'Brauche ich Ads, um Ergebnisse zu sehen?',
		'answer'   => 'Nein. Performance, Measurement, SEO, Content und CRO funktionieren ohne Werbebudget. Ads sind erst sinnvoll, wenn Fundament und Conversion-Pfade stehen.',
	],
	[
		'question' => 'Wie schnell werden Effekte sichtbar?',
		'answer'   => 'Performance- und Measurement-Hebel wirken oft in Tagen oder wenigen Wochen. SEO und Content brauchen mehrere Monate. Conversion-Verbesserungen werden meist frueh sichtbar.',
	],
	[
		'question' => 'Was passiert bei einer Kuendigung?',
		'answer'   => 'Code, Inhalte, Tracking-Setups und Zugaenge bleiben bei Ihnen. Das WGOS ist auf Ownership gebaut, nicht auf Lock-in.',
	],
];

$faq_schema = [
	'@context'    => 'https://schema.org',
	'@type'       => 'FAQPage',
	'@id'         => trailingslashit( $page_url ) . '#faq',
	'url'         => $page_url,
	'inLanguage'  => 'de',
	'publisher'   => [
		'@id' => home_url( '/#organization' ),
	],
	'mainEntity'  => [],
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
	<div class="wgos-container wgos-hero__inner">
		<span class="wgos-kicker">WordPress Growth Operating System</span>
		<h1 class="wgos-hero__title">WordPress Wachstumssystem fuer B2B-Leads</h1>
		<p class="wgos-hero__subtitle">Performance, Tracking, SEO und Conversion. Ein System statt isolierter Massnahmen.</p>

		<ul class="wgos-hero__bullets">
			<li>Klare Prioritaeten statt Aktionismus</li>
			<li>Owned Leads statt Plattform-Abhaengigkeit</li>
			<li>Volle Ownership statt Lock-in</li>
		</ul>

		<div class="wgos-hero__actions">
			<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Audit starten</a>
		</div>

		<p class="wgos-hero__support">Fuer B2B-Unternehmen, die WordPress nicht nur pflegen, sondern als verlaessliches Anfragesystem ausbauen wollen.</p>

		<div class="wgos-trust-stack">
			<div class="wgos-trust-item">
				<span class="wgos-trust-value nx-counter" data-value="98" data-fallback="98">98</span>
				<span class="wgos-trust-label">Mobile Performance</span>
			</div>
			<div class="wgos-trust-item">
				<span class="wgos-trust-value">-83%</span>
				<span class="wgos-trust-label">Kosten pro Lead</span>
			</div>
			<div class="wgos-trust-item">
				<span class="wgos-trust-value">&lt;&nbsp;0.8s</span>
				<span class="wgos-trust-label">LCP auf Kernseiten</span>
			</div>
			<div class="wgos-trust-item">
				<span class="wgos-trust-value nx-counter" data-value="100" data-suffix="%" data-fallback="100%">100%</span>
				<span class="wgos-trust-label">Ownership</span>
			</div>
		</div>

		<p class="wgos-hero__risk-note">Der Growth Audit bleibt bewusst der erste Schritt. Er klaert, welche Reihenfolge fuer Ihre Ausgangslage Sinn ergibt.</p>
	</div>
</section>

<section id="system" class="wgos-section wgos-section--gray nx-reveal">
	<div class="wgos-container">
		<div class="wgos-principle-shell">
			<div class="wgos-system-grid">
				<div>
					<span class="wgos-principle-kicker">Das Prinzip</span>
					<h2 class="wgos-h2">Ein Retainer mit klarer Reihenfolge.</h2>
					<div class="wgos-prose">
						<p>WGOS setzt nicht zehn Massnahmen parallel um. Es entfernt zuerst technische und datenbezogene Reibung, baut dann Sichtbarkeit, Content und Conversion aus und ergaenzt Automationen erst, wenn das Fundament traegt.</p>
						<p>Sie investieren in priorisierte Assets statt in offene Stunden. So entsteht ein Owned-Lead-System auf WordPress-Basis, das Ihnen gehoert und Monat fuer Monat wertvoller wird.</p>
					</div>

					<ul class="wgos-checklist wgos-checklist--system">
						<li><strong>Assets statt Kampagnen:</strong> Seiten, Tracking und Content arbeiten weiter.</li>
						<li><strong>Owned Leads:</strong> bessere Signale, klarere Pfade, weniger Reibung.</li>
						<li><strong>Ads als Verstaerker:</strong> sinnvoll, wenn Fundament und Conversion sauber stehen.</li>
					</ul>

					<p class="wgos-inline-cta wgos-inline-cta--principle">
						<a href="<?php echo esc_url( $audit_url ); ?>" data-track="cta_click_audit">Im Audit die richtige Reihenfolge klaeren</a>
					</p>
				</div>

				<div class="wgos-diagram-shell" aria-labelledby="wgos-diagram-title">
					<span class="wgos-diagram-shell__kicker">System-Diagramm</span>
					<h3 id="wgos-diagram-title">Vom Fundament zum Growth-Flywheel</h3>
					<ol class="wgos-diagram">
						<?php foreach ( $diagram_steps as $step ) : ?>
							<li class="wgos-diagram__step">
								<span class="wgos-diagram__number"><?php echo esc_html( $step['number'] ); ?></span>
								<div class="wgos-diagram__content">
									<strong><?php echo esc_html( $step['title'] ); ?></strong>
									<p><?php echo esc_html( $step['text'] ); ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="proof" class="wgos-section wgos-section--white nx-reveal">
	<div class="wgos-container">
		<span class="wgos-principle-kicker">Proof</span>
		<h2 class="wgos-h2">Bevor Pakete ins Spiel kommen, muss das System glaubwuerdig sein.</h2>
		<p class="wgos-section-intro">Saubere Reihenfolge verbessert meist zuerst Performance, Datenqualitaet und Conversion-Reibung. Wie weit das in Ihrem Fall traegt, klaert der Audit.</p>

		<div class="wgos-proof-grid">
			<?php foreach ( $proof_cards as $proof_card ) : ?>
				<article class="wgos-proof-card">
					<strong class="wgos-proof-card__value"><?php echo esc_html( $proof_card['value'] ); ?></strong>
					<p class="wgos-proof-card__label"><?php echo esc_html( $proof_card['label'] ); ?></p>
				</article>
			<?php endforeach; ?>

			<article class="wgos-proof-card wgos-proof-card--quote">
				<span class="wgos-proof-card__eyebrow">Sekundaerer CTA</span>
				<h3>Case Studies vor Detailfragen</h3>
				<p>Wenn Sie Proof sehen wollen, schauen Sie nicht auf Leistungslisten, sondern auf Vorher-Nachher-Effekte und die geaenderte Reihenfolge.</p>
				<a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Case Studies ansehen</a>
			</article>
		</div>
	</div>
</section>

<section id="pakete" class="wgos-section wgos-section--gray">
	<div class="wgos-container">
		<span class="wgos-principle-kicker">Pakete</span>
		<h2 class="wgos-h2">Pakete nach Ausgangslage, nicht nach Bauchgefuehl.</h2>
		<p class="wgos-section-intro">Der Growth Audit bleibt der Einstieg. Erst danach wird klar, ob Fundament, Aufbau oder Expansion die richtige Tiefe fuer Ihr System hat.</p>

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
					<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn <?php echo $package['featured'] ? 'wgos-btn--primary' : 'wgos-btn--outline'; ?>" data-track="cta_click_audit">Mit dem Audit starten</a>
				</article>
			<?php endforeach; ?>
		</div>

		<div id="credits" class="wgos-credit-summary nx-reveal">
			<div class="wgos-credit-summary__copy">
				<h3>Credits erklaeren den Umfang nur einmal.</h3>
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

			<p class="wgos-credit-summary__note">Die genaue Priorisierung entsteht im Audit und in der 90-Tage-Roadmap, nicht ueber starre Tabellen.</p>
		</div>
	</div>
</section>

<section id="module" class="wgos-section wgos-section--white nx-reveal">
	<div class="wgos-container">
		<span class="wgos-principle-kicker">Module</span>
		<h2 class="wgos-h2">Sieben Module, scanbar statt ausgeschrieben.</h2>
		<p class="wgos-section-intro">Jedes Modul hat einen klaren Job. Die Tiefe priorisieren wir nach Engpass, nicht nach Vollstaendigkeit auf der Seite.</p>

		<div class="wgos-module-grid">
			<?php foreach ( $modules as $module ) : ?>
				<article class="wgos-module-card nx-reveal">
					<div class="wgos-module-card__top">
						<span class="wgos-module-card__number"><?php echo esc_html( $module['number'] ); ?></span>
						<h3><?php echo esc_html( $module['title'] ); ?></h3>
					</div>
					<ul class="wgos-module-card__bullets">
						<?php foreach ( $module['bullets'] as $bullet ) : ?>
							<li><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>

		<p class="wgos-inline-cta wgos-inline-cta--center">
			<a href="<?php echo esc_url( $audit_url ); ?>" data-track="cta_click_audit">Module im Audit priorisieren</a>
		</p>
	</div>
</section>

<section id="ablauf" class="wgos-section wgos-section--gray nx-reveal">
	<div class="wgos-container">
		<span class="wgos-principle-kicker">Naechster Schritt</span>
		<h2 class="wgos-h2">Der Conversion-Pfad bleibt bewusst einfach.</h2>
		<p class="wgos-section-intro">Kein Direktverkauf eines Retainers ohne Diagnose. Erst Klarheit, dann Roadmap, dann laufende Umsetzung.</p>

		<div class="wgos-process-grid">
			<?php foreach ( $process_steps as $process_step ) : ?>
				<article class="wgos-process-step nx-reveal">
					<span class="wgos-process-step__number"><?php echo esc_html( $process_step['number'] ); ?></span>
					<h3><?php echo esc_html( $process_step['title'] ); ?></h3>
					<p><?php echo esc_html( $process_step['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<ul class="wgos-checklist wgos-checklist--system">
			<li><strong>Transparenz:</strong> monatliche Priorisierung, Output-Review und KPI-Blick.</li>
			<li><strong>Keine Parallel-Baustellen:</strong> erst Fundament, dann Sichtbarkeit und Conversion.</li>
			<li><strong>Volle Ownership:</strong> Code, Inhalte, Tracking und Zugaenge bleiben bei Ihnen.</li>
		</ul>
	</div>
</section>

<section id="faq" class="wgos-section wgos-section--white">
	<div class="wgos-container">
		<span class="wgos-principle-kicker">FAQ</span>
		<h2 class="wgos-h2">Die wichtigsten Fragen, ohne Whitepaper-Antworten.</h2>

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
	<div class="wgos-container wgos-final-cta__inner">
		<h2 class="wgos-h2">Erst Klarheit. Dann Retainer.</h2>
		<p class="wgos-prose">Wenn Ihre WordPress-Seite mehr leisten soll als gepflegt zu werden, starten wir mit dem Growth Audit und priorisieren dann das passende WGOS-Setup.</p>

		<div class="wgos-hero__actions">
			<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Audit starten</a>
		</div>

		<div class="wgos-final__links">
			<a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Case Studies ansehen</a>
		</div>
	</div>
</section>

</div>

<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ); ?></script>

<?php get_footer(); ?>
