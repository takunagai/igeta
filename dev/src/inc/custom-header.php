<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
    <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package igeta
 */


if ( ! function_exists( 'igeta_custom_header_setup' ) ) :
    /**
     * Set up the WordPress core custom header feature.
     * _s original
     *
     * @uses igeta_header_style()
     */
    function igeta_custom_header_setup() {
        add_theme_support( 'custom-header', apply_filters( 'igeta_custom_header_args', array(
            'width'              => 1920,
            'height'             => 1080,
            // 'flex-width'         => true,
            'flex-height'        => true,
            'default-text-color' => '333',
            'default-image'      => get_template_directory_uri() . '/img/custom-header-dummy-image.png',
            'video'              => true,
            'wp-head-callback'   => 'igeta_header_style',
        ) ) );
    }
    add_action( 'after_setup_theme', 'igeta_custom_header_setup' );
endif;



if ( ! function_exists( 'igeta_header_style' ) ) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see igeta_custom_header_setup().
     *
     * // _s default CSS
     * if ( ! display_header_text() ) :
     *   ?>
     *   .site-title,
     *   .site-description {
     *    position: absolute;
     *     clip: rect(1px, 1px, 1px, 1px);
     *    }
     * <?php
     * // If the user has set a custom color for the text use that.
     * else :
     *   ?>
     *   .site-title a,
     *   .site-description {
     *     color: #<?php echo esc_attr( $header_text_color ); ?>;
     *   }
     * <?php endif; ?>
     */
    function igeta_header_style() {
        $header_text_color = get_header_textcolor();

        // // 子テーマで表示されなくなる問題があるため、一旦コメントアウトしてある
        // if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        //   return;
        // }

        ?>
        <style type="text/css">
            .hero-image {
                width: <?php echo get_custom_header()->width; ?>px;
                height: <?php echo get_custom_header()->height; ?>px;
                background-image: url(<?php header_image(); ?>);
            }
        <?php
        if ( ! display_header_text() ) :
            // サイト基本情報 > サイトのタイトルとキャッチフレーズを表示 のチェックがOFFの場合
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

        <?php
        else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }
        <?php endif; ?>
        </style>
        <?php
    }
endif;
