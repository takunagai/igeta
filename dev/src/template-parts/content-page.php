<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */
?>

<?php
// header.php のものと同じ、まとめること
// アイキャッチ画像をCSS背景に
//   echo $post_thumnail_bg_style;
$post_thumnail_bg_style = '';
if ( has_post_thumbnail() ) {
    $post_thumnail_bg_style = ' style="background-image:url('
    . wp_get_attachment_url( get_post_thumbnail_id() )
    . ');"';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header bg--post-thumbnail"<?php echo $post_thumnail_bg_style; // header.php で設定 ?>>
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php // igeta_post_thumbnail(); ?>
    </header>

    <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	<?php if ( is_active_sidebar( 'under-page-header' ) ) : ?>
		<div class="container mb-0">
			<?php dynamic_sidebar( 'under-page-header' ); ?>
		</div>
	<?php endif; ?>


    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'igeta' ),
            'after' => '</div>',
        ) );
        ?>
    </div>

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'igeta' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer>
    <?php endif; ?>
</article>

