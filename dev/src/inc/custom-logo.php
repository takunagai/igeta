<?php
/**
 * Custom Logo
 *
 * You can add an optional custom Logo image to header.php like so ...
 *
	<?php the_custom_logo(); ?>
 *
		// Codex Sample
		function theme_prefix_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
 *
 * @link http://codex.wordpress.org/Theme_Logo
 *
 * @package igeta
 */

/**
 * Set up the WordPress core custom Logo feature.
 */
function igeta_custom_logo_setup() {
	add_theme_support(
		'custom-logo',
		apply_filters(
			'igeta_custom_logo_args',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		)
	);
}
add_action( 'after_setup_theme', 'igeta_custom_logo_setup' );


/**
 * Alt 修正
 * TODO: 効かない
 */
add_filter( 'tc_logo_alt', 'my_alt_logo' );
function my_alt_logo( $content ) {
	return 'my logo alt'; // CHANGE
}
// function avf_logo_alt_new($alt) {
// $alt = 'my new alt text';
// return $alt;
// }
// add_filter('avf_logo_alt', 'avf_logo_alt_new');
