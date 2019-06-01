<?php
/**
 * Template part for displaying the main navigation in header.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package igeta
 */

?>
<div class="hero-image-wrapper">
	<?php // the_custom_header_markup(); // カスタムヘッダー(動画 or 画像) ?>
	<div class="hero-image">
		<?php if ( is_active_sidebar( 'content-in-hero-image' ) ) : ?>
			<?php dynamic_sidebar( 'content-in-hero-image' ); ?>
		<?php endif; ?>
	</div>
</div>
