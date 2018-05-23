<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <p class="entry-category"><?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->cat_name " ;} ?></p>
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', show_page_number() . '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                igeta_posted_on(); // in inc/template-tags.php
                // igeta_posted_by(); // in inc/template-tags.php
                ?>
            </div>
        <?php endif; ?>
    </header>


    <?php // igeta_post_thumbnail(); ?>


    <div class="entry-content">
        <?php
        the_content( sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'igeta' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ) );


    /**
     * 改ページ <!--nextpage--> でページ分けした時に表示されるページナビゲーション
     *   @link https://wpdocs.osdn.jp/テンプレートタグ/wp_link_pages
     */
        // 次のページへ、前のページへ
        wp_link_pages( array(
            'before'         => '<p class="page-links_next-previous">',
            'after'          => '</p>',
            'next_or_number' => 'next',
        ) );

        // ナンバリング
        wp_link_pages( array(
            'before' => '<div class="page-links_by_number">',
            'after'  => '</div>',
            'link_before' => '<span class="page-links__number">',
            'link_after' => '</span>'
        ) );

        // _s 元
        // wp_link_pages( array(
        //  'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'igeta' ),
        //  'after'  => '</div>',
        // ) );
        ?>
    </div>

    <footer class="entry-footer">
        <?php igeta_entry_footer(); ?>
    </footer>
</article>
