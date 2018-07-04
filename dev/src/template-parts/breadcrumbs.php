<?php
/**
 * Template part for displaying the main navigation in header.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package igeta
 */

?>
<?php if ( ! is_front_page() && function_exists( 'bcn_display' ) ) : ?>
<div class="container my-0">
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<?php bcn_display(); // Breadcrumb NavXT Plugin ?>
	</div>
</div>
<?php endif ; ?>
