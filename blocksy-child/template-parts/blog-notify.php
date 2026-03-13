<?php
/**
 * Reusable blog notification subscribe component.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args          = wp_parse_args( $args ?? [], [ 'variant' => 'full' ] );
$variant       = in_array( $args['variant'], [ 'full', 'compact' ], true ) ? $args['variant'] : 'full';
$copy          = function_exists( 'nexus_get_blog_notify_copy' ) ? nexus_get_blog_notify_copy() : [];
$privacy_url   = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) ) : home_url( '/datenschutz/' );
$context_post  = is_singular( 'post' ) ? get_the_ID() : 0;
$form_nonce    = wp_create_nonce( 'nexus_blog_notify_subscribe' );
$eyebrow_label = 'compact' === $variant ? 'Artikel-Updates' : 'Blog-Benachrichtigungen';
?>

<section class="nexus-blog-notify nexus-blog-notify--<?php echo esc_attr( $variant ); ?>" aria-labelledby="nexus-blog-notify-title-<?php echo esc_attr( $variant ); ?>">
	<div class="nexus-blog-notify__inner">
		<div class="nexus-blog-notify__copy">
			<span class="nexus-blog-notify__eyebrow"><?php echo esc_html( $eyebrow_label ); ?></span>
			<h2 id="nexus-blog-notify-title-<?php echo esc_attr( $variant ); ?>" class="nexus-blog-notify__title"><?php echo esc_html( $copy['headline'] ?? 'Neue Artikel per E-Mail' ); ?></h2>
			<p class="nexus-blog-notify__body"><?php echo esc_html( $copy['body'] ?? '' ); ?></p>
		</div>

		<form class="nexus-blog-notify__form" data-blog-notify-form novalidate>
			<div class="nexus-blog-notify__honeypot" aria-hidden="true">
				<label for="nexus-blog-notify-website-<?php echo esc_attr( $variant ); ?>">Website</label>
				<input id="nexus-blog-notify-website-<?php echo esc_attr( $variant ); ?>" type="text" name="website" tabindex="-1" autocomplete="off">
			</div>

			<input type="hidden" name="nonce" value="<?php echo esc_attr( $form_nonce ); ?>">
			<input type="hidden" name="contextPostId" value="<?php echo esc_attr( (string) $context_post ); ?>">

			<label class="screen-reader-text" for="nexus-blog-notify-email-<?php echo esc_attr( $variant ); ?>">E-Mail-Adresse</label>
			<div class="nexus-blog-notify__controls">
				<input
					id="nexus-blog-notify-email-<?php echo esc_attr( $variant ); ?>"
					class="nexus-blog-notify__input"
					type="email"
					name="email"
					placeholder="<?php echo esc_attr( $copy['placeholder'] ?? 'Ihre E-Mail-Adresse' ); ?>"
					autocomplete="email"
					required
				>
				<button type="submit" class="nexus-blog-notify__button"><?php echo esc_html( $copy['button'] ?? 'Neue Artikel erhalten' ); ?></button>
			</div>

			<p class="nexus-blog-notify__hint">
				<?php echo esc_html( $copy['hint'] ?? '' ); ?>
				<a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutz</a>
			</p>
			<div class="nexus-blog-notify__feedback" data-blog-notify-feedback aria-live="polite"></div>
		</form>
	</div>
</section>
