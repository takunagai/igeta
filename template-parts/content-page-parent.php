<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php igeta_post_thumbnail(); ?>
    </header>


    <div class="entry-content">
        <?php the_content(); ?>

        <?php
        /**
         * 子ページ一覧を表示
         */
        $child_posts = query_posts( 'numberposts=-1&order=ASC&orderby=post_title&post_type=page&post_parent=' . $post->ID );
        if ( $child_posts ) {
            echo ( '<div class="container"><div class="grid grid--mobile-2col card--base">' );
            foreach ( $child_posts as $child ) {
                $child_posttitle = apply_filters( 'the_title', $child->post_title );
                $child_permalink = apply_filters( 'the_permalink', get_permalink( $child->ID ) );
                $child_excerpt   = apply_filters( 'the_excerpt', $child->post_excerpt );
                $child_image_id  = get_post_thumbnail_id( $child->ID );
                if ( empty( $child_image_id ) || ! isset( $child_image_id ) ) {
                    $child_image_url = get_template_directory_uri() . '/img/no-image.png';
                }
                else {
                    $child_image_url = wp_get_attachment_image_src( $child_image_id, 'medium' );
                    $child_image_url = $child_image_url[0]; // 1 は幅、2 は高さ、3はリサイズされてたら true
                }
            ?>
                <div class="child-page card">
                    <a href="<?php echo $child_permalink; ?>">
                        <img src="<?php echo $child_image_url; ?>" class="card__img child-page__img">
                    </a>
                    <div class="card__body child-page__content">
                        <h2 class="card__title child-page__title"><a href="<?php echo $child_permalink; ?>"><?php echo $child_posttitle; ?></a></h2>
                        <div class="card__body child-page__excerpt"><?php echo $child_excerpt; ?></div>
                    </div>
                </div>
        <?php
            }
            echo ( '</div></div>' );
        }
        else {
        ?>

                <div class="alert alert-warning">
                    <p>子ページがありません</p>
                </div>

        <?php
        }
        wp_reset_query();
        ?>

    </div>

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
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
