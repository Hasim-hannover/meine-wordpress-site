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
$home_url     = home_url( '/' );
$blog_page_id = (int) get_option( 'page_for_posts' );

$audit_url   = nexus_get_audit_url();
$agentur_url = nexus_get_page_url(
	[ 'wordpress-agentur-hannover', 'wordpress-agentur' ],
	home_url( '/wordpress-agentur-hannover/' )
);
$wgos_url    = nexus_get_page_url(
	[ 'wordpress-growth-operating-system' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$cases_url   = nexus_get_results_url();
$e3_url      = nexus_get_page_url(
	[ 'e3-new-energy', 'case-studies/e3-new-energy', 'case-e3' ],
	home_url( '/e3-new-energy/' )
);
$domdar_url  = nexus_get_page_url(
	[ 'case-study-domdar', 'domdar' ],
	home_url( '/case-study-domdar/' )
);
$whitelabel_url = nexus_get_whitelabel_page_url();
$blog_url    = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' );
$seo_url     = nexus_get_page_url(
	[ 'wordpress-seo-hannover', 'seo' ],
	home_url( '/wordpress-seo-hannover/' )
);
$cwv_url     = nexus_get_page_url(
	[ 'core-web-vitals', 'core-web-vitals-optimierung' ],
	home_url( '/core-web-vitals/' )
);
$tools_url   = nexus_get_page_url(
	[ 'kostenlose-tools', 'tools' ],
	home_url( '/kostenlose-tools/' )
);
$about_url   = nexus_get_page_url( [ 'uber-mich' ], home_url( '/uber-mich/' ) );
$contact_url = nexus_get_contact_url();
$project_request_url = add_query_arg(
	[
		'type' => 'project',
	],
	$contact_url
);
$imprint_url = nexus_get_page_url( [ 'impressum' ], home_url( '/impressum/' ) );
$privacy_url = nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) );
?>

<?php if ( function_exists( 'nexus_is_audit_page' ) && nexus_is_audit_page() ) : ?>
<footer id="footer" class="ft ft--audit-minimal" aria-labelledby="ft-heading" role="contentinfo">
	<h2 id="ft-heading" class="ft__sr">Footer-Navigation</h2>
	<div class="ft__audit-shell">
		<p class="ft__audit-note">Growth Audit: persönliche Ersteinschätzung, schriftliche Rückmeldung in 48 Stunden, kein Pflicht-Call.</p>
		<nav class="ft__audit-links" aria-label="Audit-Footer-Navigation">
			<a href="<?php echo esc_url( $cases_url ); ?>">Einblicke</a>
			<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
			<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
		</nav>
	</div>
</footer>
<?php return; endif; ?>

<footer id="footer" class="ft" aria-labelledby="ft-heading" role="contentinfo">
	<h2 id="ft-heading" class="ft__sr">Footer-Navigation</h2>

	<div class="ft__top">
		<div class="ft__brand">
			<a class="ft__logo site-logo site-logo--accent" href="<?php echo esc_url( $home_url ); ?>" aria-label="Startseite - HAŞIM ÜNER">HAŞIM ÜNER</a>
			<p class="ft__tag">WordPress als Nachfrage-System für B2B.</p>
			<a class="ft__cta" href="<?php echo esc_url( $audit_url ); ?>">Growth Audit starten</a>
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
					<li><a class="ft__link-strong" href="<?php echo esc_url( $audit_url ); ?>">Growth Audit</a></li>
					<li><a class="ft__link-strong" href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a></li>
					<li><a href="<?php echo esc_url( $wgos_url ); ?>">WGOS</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-proof">
				<h3 id="ft-proof">Proof</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $cases_url ); ?>">Ergebnisse</a></li>
					<li><a href="<?php echo esc_url( $e3_url ); ?>">E3 New Energy</a></li>
					<li><a href="<?php echo esc_url( $domdar_url ); ?>">DOMDAR</a></li>
					<li><a href="<?php echo esc_url( $whitelabel_url ); ?>">Whitelabel Proof</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-wissen">
				<h3 id="ft-wissen">Wissen</h3>
				<ul class="ft__list">
					<li><a href="<?php echo esc_url( $blog_url ); ?>">Insights</a></li>
					<li><a href="<?php echo esc_url( $seo_url ); ?>">SEO</a></li>
					<li><a href="<?php echo esc_url( $cwv_url ); ?>">Core Web Vitals</a></li>
					<li><a href="<?php echo esc_url( $tools_url ); ?>">Kostenlose Tools</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-unternehmen">
				<h3 id="ft-unternehmen">Unternehmen</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $project_request_url ); ?>">Projektanfrage</a></li>
					<li><a href="<?php echo esc_url( $about_url ); ?>">Über mich</a></li>
					<li><a href="<?php echo esc_url( $contact_url ); ?>">Kontakt</a></li>
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
