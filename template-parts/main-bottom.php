<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */
?>
<?php if ( is_active_sidebar( 'after-post' ) ) : ?>
<aside class="after-post">
  <div class="widget-area container">
    <?php dynamic_sidebar( 'after-post' ); ?>
  </div>
</aside>
<?php endif; ?>
