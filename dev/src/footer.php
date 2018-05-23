<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */

?>
    <!--/.site-content (in header.php)-->
    </div>



    <div class="footer-information bg-light">
        <div class="container">

            <?php if ( is_active_sidebar( 'footer' ) ){ dynamic_sidebar( 'footer' ); } ?>

            <address>
                <?php
                // カスタムロゴが設定されていればカスタムロゴ、なければサイト名のテキストを表示
                if ( has_custom_logo() ) {
                    $igeta_site_title = get_custom_logo();
                } else {
                    $igeta_site_title = '<a href="' . get_bloginfo('url', 'display') . '" class="custom-logo-link">' . get_bloginfo('name', 'display') . "</a>";
                }
                ?>

                <p class="site-title"><?php echo $igeta_site_title ?></p>
                <?php if ( is_active_sidebar( 'footer-address' ) ){ dynamic_sidebar( 'footer-address' ); } ?>
            </address>

        </div>
    </div>


    <?php
    /**
     * カスタムメニューで"footer-nav"を指定して使う場合
     *   パラメーター: https://wpdocs.osdn.jp/テンプレートタグ/wp_nav_menu
     *   出力HTML: div.menu-footer_nav-container > ul#menu-footer_nav.menu > li#.menu-item
     */
    // wp_nav_menu( array(
    //  'theme_location' => 'footer-nav'
    // ) );
    ?>


    <footer class="site-footer" role="contentinfo">
        <p>Copyright © 2018 <span>© Amana Nursery school.</span> <span>All rights reserved.</span><?php // <span class="separator"> | </span>WordPress Theme "igeta" by <a href="http://nagaishouten.com" rel="designer">taku_nagai</a> ?></p>
    </footer>


<!-- /.site (in header.php) -->
</div>


<?php wp_footer(); ?>
</body>
</html>
