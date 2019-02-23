<?php
/**
Template Name: 親ページ (子ページ一覧)
Template Post Type: page
*/

/**
 * The template for parent pages show child page list.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kunai
 */

get_header(); ?>

    <div id="content" class="site-content page--parent">

        <div id="primary" class="content-area">
        	<div id="primary__inner">
	            <main id="main" class="site-main" role="main">
	                <?php get_template_part( 'template-parts/content', 'page-parent' ); ?>
	            </main>
	        </div>
        </div>
        <?php get_sidebar(); ?>
    </div>

    <a href="#top" id="move-to-page-top"><i class="fa fa-chevron-up" aria-hidden="true"></i> Top</a>

<?php get_footer(); ?>
