<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">ブログ Top</h1>
				</header>


				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="container--narrow">
						<ul class="media--thumbnail">

						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content-archive', get_post_type() );

						endwhile;

						the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
						</ul>
					</div>
				</section>
			</main>

			<?php get_template_part( 'template-parts/widget-main-bottom' ); ?>
		</div>
	</div>

<?php
get_sidebar();
get_footer();


