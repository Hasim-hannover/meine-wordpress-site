<?php
/**
 * Global site footer.
 *
 * Focused footer for CRO: one primary CTA, a small set of decision paths
 * and direct trust/support links.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_year = wp_date( 'Y' );
$primary_urls = function_exists( 'nexus_get_primary_public_url_map' ) ? nexus_get_primary_public_url_map() : [];
$home_url     = $primary_urls['home'] ?? home_url( '/' );
$audit_url    = $primary_urls['audit'] ?? nexus_get_audit_url();
$agentur_url  = $primary_urls['agentur'] ?? home_url( '/wordpress-agentur-hannover/' );
$wgos_url     = $primary_urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' );
$cases_url    = $primary_urls['results'] ?? nexus_get_results_url();
$blog_url     = $primary_urls['blog'] ?? home_url( '/blog/' );
$seo_url      = $primary_urls['seo'] ?? home_url( '/wordpress-seo-hannover/' );
$cwv_url      = $primary_urls['cwv'] ?? home_url( '/core-web-vitals/' );
$tools_url    = $primary_urls['tools'] ?? home_url( '/kostenlose-tools/' );
$about_url    = $primary_urls['about'] ?? home_url( '/uber-mich/' );
$contact_url  = $primary_urls['contact'] ?? nexus_get_contact_url();
$project_request_url = add_query_arg(
	[
		'type' => 'implementation',
	],
	$contact_url
);
$whitelabel_url   = $primary_urls['whitelabel'] ?? home_url( '/whitelabel-retainer/' );
$imprint_url      = $primary_urls['impressum'] ?? home_url( '/impressum/' );
$privacy_url      = $primary_urls['datenschutz'] ?? home_url( '/datenschutz/' );
$hide_primary_cta = function_exists( 'nexus_should_hide_footer_primary_cta' ) && nexus_should_hide_footer_primary_cta();
$footer_class     = $hide_primary_cta ? 'ft ft--no-primary-cta ft--mobile-cta' : 'ft';
$audit_cta_label  = function_exists( 'nexus_get_audit_cta_label' ) ? nexus_get_audit_cta_label() : 'Growth Audit starten';
$audit_footer_note = function_exists( 'nexus_get_audit_footer_note' ) ? nexus_get_audit_footer_note() : 'Growth Audit: persönliche Ersteinschätzung, schriftliche Rückmeldung in 48 Stunden, kein Pflicht-Call.';
?>

<?php if ( function_exists( 'nexus_is_audit_linkedin_page' ) && nexus_is_audit_linkedin_page() ) : ?>
<?php /* Footer rendered inline in audit-linkedin-shell.php */ ?>
<?php return; endif; ?>

<?php if ( function_exists( 'nexus_is_audit_page' ) && nexus_is_audit_page() ) : ?>
<footer id="footer" class="ft ft--audit-minimal" aria-labelledby="ft-heading" role="contentinfo">
	<h2 id="ft-heading" class="ft__sr">Footer-Navigation</h2>
	<div class="ft__audit-shell">
		<p class="ft__audit-note"><?php echo esc_html( $audit_footer_note ); ?></p>
		<nav class="ft__audit-links" aria-label="Audit-Footer-Navigation">
			<a href="<?php echo esc_url( $cases_url ); ?>" data-track-action="cta_audit_footer_results" data-track-category="trust">Ergebnisse</a>
			<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
			<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
		</nav>
	</div>
</footer>
<?php return; endif; ?>

<footer id="footer" class="<?php echo esc_attr( $footer_class ); ?>" aria-labelledby="ft-heading" role="contentinfo">
	<h2 id="ft-heading" class="ft__sr">Footer-Navigation</h2>

	<div class="ft__top">
		<div class="ft__brand">
			<a class="ft__logo site-logo site-logo--accent" href="<?php echo esc_url( $home_url ); ?>" aria-label="Startseite - HAŞIM ÜNER">HAŞIM ÜNER</a>
			<p class="ft__tag">WordPress als Nachfrage-System für B2B.</p>
			<?php if ( ! $hide_primary_cta ) : ?>
			<a class="ft__cta" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_footer_audit" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
			<?php else : ?>
			<a class="ft__cta ft__cta--mobile-only" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_footer_audit_mobile" data-track-category="lead_gen"><?php echo esc_html( $audit_cta_label ); ?></a>
			<?php endif; ?>
			<p class="ft__privacy-note">
				<span class="ft__privacy-badge" aria-hidden="true">
					<svg viewBox="0 0 24 24" focusable="false">
						<path d="M12 3L19 6V11C19 15.67 16.11 19.86 12 21C7.89 19.86 5 15.67 5 11V6L12 3Z" fill="currentColor" fill-opacity="0.14"/>
						<path d="M12 3L19 6V11C19 15.67 16.11 19.86 12 21C7.89 19.86 5 15.67 5 11V6L12 3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
						<path d="M9.4 11.8L11.2 13.6L14.9 9.9" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</span>
				Keine Cookies bei öffentlichen Seitenaufrufen.
				<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz ansehen</a>
			</p>
		</div>

		<nav class="ft__cols" aria-label="Footer-Navigation">
			<section class="ft__col" aria-labelledby="ft-einstieg">
				<h3 id="ft-einstieg">Einstieg</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_footer_nav_audit" data-track-category="lead_gen">Growth Audit</a></li>
					<li><a class="ft__link-strong" href="<?php echo esc_url( $agentur_url ); ?>" data-track-action="cta_footer_nav_agentur" data-track-category="navigation">WordPress Agentur Hannover</a></li>
					<li><a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_footer_nav_wgos" data-track-category="navigation">Systemlogik (WGOS)</a></li>
					<li><a href="<?php echo esc_url( $whitelabel_url ); ?>" data-track-action="cta_footer_nav_whitelabel" data-track-category="navigation">Whitelabel &amp; Weiterentwicklung</a></li>
					<li><a href="<?php echo esc_url( home_url( '/loesungen/' ) ); ?>" data-track-action="cta_footer_nav_loesungen" data-track-category="navigation">Alle Lösungen</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-proof-wissen">
				<h3 id="ft-proof-wissen">Proof &amp; Wissen</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $cases_url ); ?>" data-track-action="cta_footer_nav_results" data-track-category="trust">Ergebnisse</a></li>
					<li><a href="<?php echo esc_url( $blog_url ); ?>" data-track-action="cta_footer_nav_insights" data-track-category="navigation">Insights</a></li>
					<li><a href="<?php echo esc_url( $seo_url ); ?>" data-track-action="cta_footer_nav_seo" data-track-category="navigation">WordPress SEO</a></li>
					<li><a href="<?php echo esc_url( $cwv_url ); ?>" data-track-action="cta_footer_nav_cwv" data-track-category="navigation">Core Web Vitals</a></li>
					<li><a href="<?php echo esc_url( $tools_url ); ?>" data-track-action="cta_footer_nav_tools" data-track-category="navigation">Kostenlose Tools</a></li>
					<li><a href="<?php echo esc_url( home_url( '/ki-integration/' ) ); ?>" data-track-action="cta_footer_nav_ki" data-track-category="navigation">KI-Integration</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-unternehmen">
				<h3 id="ft-unternehmen">Unternehmen</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $project_request_url ); ?>" data-track-action="cta_footer_nav_project" data-track-category="lead_gen">Umsetzung / Optimierung</a></li>
					<li><a href="<?php echo esc_url( $about_url ); ?>" data-track-action="cta_footer_nav_about" data-track-category="navigation">Über mich</a></li>
					<li><a href="<?php echo esc_url( $contact_url ); ?>" data-track-action="cta_footer_nav_contact" data-track-category="navigation">Kontakt</a></li>
				</ul>

				<nav class="ft__legal" aria-label="Rechtliches">
					<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
					<span aria-hidden="true">·</span>
					<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
				</nav>
			</section>
		</nav>
	</div>

	<div class="ft__bottom">
		<p>&copy; <time class="ft__year" datetime="<?php echo esc_attr( $current_year ); ?>"><?php echo esc_html( $current_year ); ?></time> Haşim Üner - Growth Architect</p>
		<div class="ft__social" aria-label="Profile">
			<a href="https://www.linkedin.com/in/hasim-%C3%BCner/" aria-label="LinkedIn-Profil" rel="me noopener noreferrer" target="_blank">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 2h-17A1.5 1.5 0 0 0 2 3.5v17A1.5 1.5 0 0 0 3.5 22h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 20.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 1 1 8.3 6.5a1.78 1.78 0 0 1-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0 0 13 14.19V19h-3v-9h2.9v1.3a3.11 3.11 0 0 1 2.7-1.4c1.55 0 3.36.86 3.36 3.66z"/></svg>
				LinkedIn
			</a>
			<a href="https://github.com/Hasim-hannover" aria-label="GitHub-Profil" rel="me noopener noreferrer" target="_blank">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1.3a11 11 0 0 0-3.5 21.4c.5.1.7-.2.7-.5v-1.7C6 21.1 5.4 19 5.4 19a2.8 2.8 0 0 0-1.1-1.5c-.9-.6.1-.6.1-.6a2.1 2.1 0 0 1 1.5 1 2.1 2.1 0 0 0 2.9.8 2.1 2.1 0 0 1 .6-1.3c-2.2-.3-4.6-1.1-4.6-5a3.9 3.9 0 0 1 1-2.7 3.6 3.6 0 0 1 .1-2.7s.8-.3 2.8 1a9.7 9.7 0 0 1 5.1 0c2-1.3 2.8-1 2.8-1a3.6 3.6 0 0 1 .1 2.7 3.9 3.9 0 0 1 1 2.7c0 3.9-2.4 4.7-4.6 5a2.4 2.4 0 0 1 .7 1.8v2.7c0 .3.2.6.7.5A11 11 0 0 0 12 1.3z"/></svg>
				GitHub
			</a>
		</div>
	</div>
</footer>
