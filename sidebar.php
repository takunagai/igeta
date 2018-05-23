<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */

// 2カラムレイアウトなら表示
if ( is_single() || is_archive() || is_home() || is_page_template( 'page-two-column.php' ) ) :
?>

	<aside id="secondary" class="widget-area sticky-sidebar" role="complementary">
		<div class="sticky-sidebar__inner">

			<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
			<div class="sidebar sidebar-1">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="sidebar sidebar-2">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
			<?php endif; ?>

		</div>
	</aside>

<?php
endif;
?>
