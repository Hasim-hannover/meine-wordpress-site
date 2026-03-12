<?php
/**
 * Template Name: Kostenlose Tools
 * Description: Tool Hub — Audit, ROI-Rechner und weitere kostenlose Tools
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="tools-hub-page" data-track-section="tools_hub">
	<?php
	while ( have_posts() ) :
		the_post();
		$content = apply_filters( 'the_content', get_the_content() );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$legacy_audit_labels = [
			'Customer Journey Audit',
			'customer journey audit',
			'Coustomer Journey Audit',
			'coustomer journey audit',
			'Customer Joourney Audit',
			'customer joourney audit',
			'Coustomer Joourney Audit',
			'coustomer joourney audit',
		];

		$legacy_audit_urls = [
			home_url( '/customer-journey-audit/' ),
			trailingslashit( home_url( '/customer-journey-audit' ) ),
			'/customer-journey-audit/',
		];

		$content = str_ireplace( $legacy_audit_labels, 'Growth Audit', $content );
		$content = str_replace( $legacy_audit_urls, nexus_get_audit_url(), $content );

		echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	endwhile;
	?>
</div>

<?php get_footer(); ?>
