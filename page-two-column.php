<?php
/**
 * Template Name: ２カラム (サイドメニュー付)
 * Template Post Type: page
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */

get_header();
?>

		<div id="primary" class="content-area">
			<div id="primary__inner">

				<main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
				?>
				</main>

				<?php get_template_part( 'template-parts/widget-main-bottom' ); ?>
			</div>
		</div>

<?php
get_sidebar();
get_footer();
