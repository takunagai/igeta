<?php
/**
 * the widget area below content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */
?>
<?php if ( is_active_sidebar( 'main-bottom' ) ) : ?>
  <aside class="widget-area-main-bottom">
  <?php dynamic_sidebar( 'main-bottom' ); ?>
  </aside>
<?php endif; ?>
