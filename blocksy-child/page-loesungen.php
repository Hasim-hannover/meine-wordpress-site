<?php
/**
 * Template Name: Alle Lösungen
 *
 * Interne Angebotsübersicht mit fokussierter 3-Stufen-Logik.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$audit_url     = nexus_get_audit_url();
$wgos_url      = nexus_get_page_url( [ 'wordpress-growth-operating-system', 'wgos' ] );
$cases_url     = nexus_get_results_url();

get_header();
?>
<main class="solutions-overview">
	<section class="container" style="max-width:1120px; padding:5rem 20px 6rem;">
		<div style="text-align:center; max-width:760px; margin:0 auto 3rem;">
			<span class="nx-badge nx-badge--gold">Angebotsarchitektur</span>
			<h1 style="margin:1rem 0 1rem;">Drei Schritte. Ein klarer Einstieg.</h1>
			<p style="font-size:1.12rem; color:#64748b; line-height:1.7;">
				Diese Seite ist keine Leistungsbibliothek. Sie zeigt den sinnvollen Weg,
				mit dem aus einer WordPress-Präsenz ein planbares Anfrage- und Wachstumssystem wird. Der öffentliche Fokus bleibt bewusst auf dem Growth Audit.
			</p>
		</div>

		<div class="solutions-list">
			<ul style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1.5rem; list-style:none; padding:0; margin:0;">
				<li class="solution-item">
					<a href="<?php echo esc_url( $audit_url ); ?>">
						<h2>1. Growth Audit</h2>
						<p>Diagnose-Einstieg für B2B-Unternehmen mit bestehender WordPress-Seite. Wir machen sichtbar, wo Sichtbarkeit, Vertrauen oder Conversion wegbrechen.</p>
						<span class="cta-btn">Audit starten</span>
					</a>
				</li>
				<li class="solution-item">
					<a href="<?php echo esc_url( $audit_url ); ?>">
						<h2>2. Priorisierte Folgeentscheidung</h2>
						<p>Kein öffentlicher Einstieg. Wenn der Fall tiefer geht, ergibt sich der nächste vertiefte Schritt erst nach Growth Audit, Rückmeldung und persönlichem Kontakt.</p>
						<span class="cta-btn">Ergibt sich nach dem Audit</span>
					</a>
				</li>
				<li class="solution-item">
					<a href="<?php echo esc_url( $wgos_url ); ?>">
						<h2>3. Kontrollierte Umsetzung &amp; laufende Weiterentwicklung</h2>
						<p>Umsetzung und laufende Optimierung in der richtigen Reihenfolge: Technik, SEO, Tracking, Content und Conversion auf WordPress-Basis.</p>
						<span class="cta-btn">System ansehen</span>
					</a>
				</li>
			</ul>
		</div>

		<div style="max-width:760px; margin:3rem auto 0; text-align:center;">
			<p style="color:#64748b; font-size:1rem; line-height:1.7; margin-bottom:1.5rem;">
				Wenn Sie erst sehen wollen, wie sich dieser Ansatz in der Praxis auswirkt, starten Sie nicht bei Einzelleistungen, sondern bei den dokumentierten Ergebnissen.
			</p>
			<div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem;">
				<a href="<?php echo esc_url( $cases_url ); ?>" class="cta-btn" style="font-size:1rem; padding:14px 28px;">Ergebnisse ansehen</a>
				<a href="<?php echo esc_url( $audit_url ); ?>" class="cta-btn" style="font-size:1rem; padding:14px 28px;">Direkt mit dem Audit starten</a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
