<?php
/**
 * Template part for displaying the main navigation in header.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package igeta
 */

?>

<button id="primary-menu-toggle-button" aria-label="Toggle navigation" aria-controls="primary-menu" aria-expanded="false"></button>

<nav id="primary-menu" role="navigation">
	<?php
		wp_nav_menu( array(
			'menu'           => 'primary-menu',
			// 'menu_id'        => 'primary-menu',
			'theme_location' => 'primary_menu',
			'container'      => false,
			'depth'          => 2, // 0　で無制限
			'fallback_cb'    => false,
			// 'menu_class'     => 'menu', // デフォルト値 menu
			'items_wrap'     => '<ul>%3$s</ul>', // <ul id="%1$s" class="%2$s">%3$s</ul>
		) );
	 ?>
</nav>

