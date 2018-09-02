<?php
/**
 * Template part for displaying the main navigation in header.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package igeta
 *
 *
 * Support plugins
 *     Breadcrumb NavXT
 *     Markup (JSON-LD) structured in schema.org
 *
 * If express schema.org by html tag add attribute to breadcrumbs class div tag
 *     typeof="BreadcrumbList" vocab="https://schema.org/"
 */
?>

<?php if ( ! is_front_page() && function_exists( 'bcn_display' ) ) : ?>
<div class="container my-0">
	<div class="breadcrumbs breadcrumb-navxt">
		<ol>
		<?php bcn_display(); // Breadcrumb NavXT Plugin ?>
	</ol>
	</div>
</div>

<?php elseif (  ! is_front_page() && shortcode_exists( 'wp-structuring-markup-breadcrumb' ) ) : ?>
<div class="container my-0">
	<div class="breadcrumbs">
    <?php echo do_shortcode( '[wp-structuring-markup-breadcrumb]' ); // Markup (JSON-LD) structured in schema.org ?>
	</div>
</div>
<?php endif ; ?>

