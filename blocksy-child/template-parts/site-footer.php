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
$blog_url    = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' );
$seo_url     = nexus_get_page_url(
	[ 'wordpress-seo-hannover', 'seo' ],
	home_url( '/wordpress-seo-hannover/' )
);
$cwv_url     = nexus_get_page_url(
	[ 'core-web-vitals', 'core-web-vitals-optimierung' ],
	home_url( '/core-web-vitals/' )
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

<footer id="footer" class="ft" aria-labelledby="ft-heading" role="contentinfo">
	<h2 id="ft-heading" class="ft__sr">Footer-Navigation</h2>

	<div class="ft__top">
		<div class="ft__brand">
			<a class="ft__logo site-logo site-logo--accent" href="<?php echo esc_url( $home_url ); ?>" aria-label="Startseite - HAŞIM ÜNER">HAŞIM ÜNER</a>
			<p class="ft__tag">WordPress als Nachfrage-System für B2B.</p>
			<a class="ft__cta" href="<?php echo esc_url( $audit_url ); ?>">Growth Audit starten</a>
			<p class="ft__privacy-note">
				<span class="ft__privacy-badge">Privacy</span>
				Keine Cookies bei öffentlichen Seitenaufrufen.
				<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz ansehen</a>
			</p>
		</div>

		<nav class="ft__cols" aria-label="Footer-Navigation">
			<section class="ft__col" aria-labelledby="ft-einstieg">
				<h3 id="ft-einstieg">Einstieg</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $audit_url ); ?>">Audit</a></li>
					<li><a class="ft__link-strong" href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a></li>
					<li><a href="<?php echo esc_url( $wgos_url ); ?>">WGOS</a></li>
				</ul>
			</section>

			<section class="ft__col" aria-labelledby="ft-proof">
				<h3 id="ft-proof">Proof &amp; Wissen</h3>
				<ul class="ft__list">
					<li><a class="ft__link-strong" href="<?php echo esc_url( $cases_url ); ?>">Ergebnisse</a></li>
					<li><a href="<?php echo esc_url( $blog_url ); ?>">Insights</a></li>
					<li><a href="<?php echo esc_url( $seo_url ); ?>">SEO</a></li>
					<li><a href="<?php echo esc_url( $cwv_url ); ?>">Core Web Vitals</a></li>
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
		<p>&copy; <time class="ft__year" datetime="<?php echo esc_attr( $current_year ); ?>"><?php echo esc_html( $current_year ); ?></time> Hasim Üner - Growth Architect</p>
		<div class="ft__social" aria-label="Profile">
			<a href="https://www.linkedin.com/in/hasim-%C3%BCner/" aria-label="LinkedIn-Profil" rel="me noopener noreferrer" target="_blank">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 2h-17A1.5 1.5 0 0 0 2 3.5v17A1.5 1.5 0 0 0 3.5 22h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 20.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 1 1 8.3 6.5a1.78 1.78 0 0 1-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0 0 13 14.19V19h-3v-9h2.9v1.3a3.11 3.11 0 0 1 2.7-1.4c1.55 0 3.36.86 3.36 3.66z"/></svg>
				LinkedIn
			</a>
			<a href="https://www.instagram.com/hasimuener/" aria-label="Instagram-Profil" rel="me noopener noreferrer" target="_blank">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.2c2.7 0 3 0 4.1.06a5.6 5.6 0 0 1 1.9.35 3.4 3.4 0 0 1 1.9 1.9 5.6 5.6 0 0 1 .35 1.9c.05 1.1.06 1.4.06 4.1s0 3-.06 4.1a5.6 5.6 0 0 1-.35 1.9 3.4 3.4 0 0 1-1.9 1.9 5.6 5.6 0 0 1-1.9.35c-1.1.05-1.4.06-4.1.06s-3 0-4.1-.06a5.6 5.6 0 0 1-1.9-.35 3.4 3.4 0 0 1-1.9-1.9 5.6 5.6 0 0 1-.35-1.9C3.7 15 3.7 14.7 3.7 12s0-3 .06-4.1a5.6 5.6 0 0 1 .35-1.9A3.4 3.4 0 0 1 6 4.1a5.6 5.6 0 0 1 1.9-.35C9 3.7 9.3 3.7 12 3.7M12 1c-3 0-3.3 0-4.4.07A7.1 7.1 0 0 0 5.2 1.5a5.1 5.1 0 0 0-2.9 2.9A7.1 7.1 0 0 0 1.8 6.8C1.7 7.9 1.7 8.3 1.7 12s0 4.1.07 5.2a7.1 7.1 0 0 0 .46 2.4 5.1 5.1 0 0 0 2.9 2.9 7.1 7.1 0 0 0 2.4.46c1.1.05 1.4.07 4.4.07s3.3 0 4.4-.07a7.1 7.1 0 0 0 2.4-.46 5.1 5.1 0 0 0 2.9-2.9 7.1 7.1 0 0 0 .46-2.4c.05-1.1.07-1.4.07-5.2s0-4.1-.07-5.2a7.1 7.1 0 0 0-.46-2.4 5.1 5.1 0 0 0-2.9-2.9 7.1 7.1 0 0 0-2.4-.46C15.3 1 15 1 12 1zm0 5.3a5.7 5.7 0 1 0 0 11.4 5.7 5.7 0 0 0 0-11.4zm0 9.4a3.7 3.7 0 1 1 0-7.4 3.7 3.7 0 0 1 0 7.4zm5.9-9.7a1.3 1.3 0 1 1-2.6 0 1.3 1.3 0 0 1 2.6 0z"/></svg>
				Instagram
			</a>
			<a href="https://github.com/Hasim-hannover" aria-label="GitHub-Profil" rel="me noopener noreferrer" target="_blank">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1.3a11 11 0 0 0-3.5 21.4c.5.1.7-.2.7-.5v-1.7C6 21.1 5.4 19 5.4 19a2.8 2.8 0 0 0-1.1-1.5c-.9-.6.1-.6.1-.6a2.1 2.1 0 0 1 1.5 1 2.1 2.1 0 0 0 2.9.8 2.1 2.1 0 0 1 .6-1.3c-2.2-.3-4.6-1.1-4.6-5a3.9 3.9 0 0 1 1-2.7 3.6 3.6 0 0 1 .1-2.7s.8-.3 2.8 1a9.7 9.7 0 0 1 5.1 0c2-1.3 2.8-1 2.8-1a3.6 3.6 0 0 1 .1 2.7 3.9 3.9 0 0 1 1 2.7c0 3.9-2.4 4.7-4.6 5a2.4 2.4 0 0 1 .7 1.8v2.7c0 .3.2.6.7.5A11 11 0 0 0 12 1.3z"/></svg>
				GitHub
			</a>
		</div>
	</div>
</footer>
