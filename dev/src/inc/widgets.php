<?php
/**
 * Widgets
 * Register widget area.
 *
 * @link https://nagaishouten.com/
 *
 * @package igeta
 *
 *
 * ウィジェットの登録
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * 自作ウィジェットは別紙参照
 */
function igeta_widgets_init() {

    // フロントページのヒーローイメージ
    register_sidebar( array(
        'id'            => 'content-in-hero-image',
        'name'          => esc_html__( 'ヒーローイメージのコンテンツ', 'igeta' ),
        'description'   => esc_html__( 'トップページのヒーローイメージ(メイン画像)中のコンテンツ (ID: content-in-hero-image)', 'igeta' ),
        'before_widget' => '<div class="hero-image__content">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="hero-image__content__title">',
        'after_title'   => '</p>'
    ) );

    // フロントページのコンテンツ
    // register_sidebar( array(
    //     'id'            => 'front-page-contents',
    //     'name'          => esc_html__( 'トップページ (front-page)', 'igeta' ),
    //     'description'   => esc_html__( 'Content Blocks で編集 (ID: front-page-contents)', 'igeta' ),
    //     'before_widget' => '<div class="container-wrapper container-wrapper-%1$s widget_front-page-contents"><section class="widget %2$s container">',
    //     'after_widget'  => '</section></div>',
    //     'before_title'  => '<h2 class="widget-title">',
    //     'after_title'   => '</h2>'
    // ) );

    // サイドバー 1〜2
    //     第一引数の数値で数を調整できる
    //     idは 'sidebar', 'sidebar-2', 'sidebar-3' ... となる
    register_sidebars( 2, array(
        'id'            => 'sidebar',
        'name'          => esc_html__( 'サイドバー%d', 'igeta' ),
        'description'   => esc_html__( '1カラムレイアウトの場合はページ下部に表示 (ID: sidebar%d)', 'igeta' ),
        'before_widget' => '<div class="widget-area-%1$s widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ) );

    // ページヘッダーの下
    register_sidebar( array(
        'id'            => 'under-page-header',
        'name'          => esc_html__( 'ページヘッダーの下', 'igeta' ),
        'description'   => esc_html__( 'ページヘッダーの下 (ID: under-page-header)', 'igeta' ),
        'before_widget' => '<aside id="%1$s" class="widget-area-under-page-header widget %2$s">', // default: <li id="%1$s" class="widget %2$s">
        'after_widget'  => '</aside>',
        'before_title'  => '<p class="widget-title">', // default: <h2 class="widgettitle">
        'after_title'   => '</p>'
    ) );

    // 投稿ページ、固定ページの the_contentの直前
    //     フィルターを使用し挿入するので(このファイル下記)、テンプレート中に挿入コードは書かない
    register_sidebar( array(
        'id'          => 'before-post',
        'name'        => '記事本文の上 (ID: before-post)',
        'description' => esc_html__( '記事本文の上部エリア', 'igeta' ),
        'before_widget' => '<div class="widget-area-before-post widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ) );

    // 投稿ページ、固定ページの the_contentの直後
    //     フィルターを使用し挿入するので(このファイル下記)、テンプレート中に挿入コードは書かない
    register_sidebar( array(
        'id'          => 'after-post',
        'name'        => '記事本文の下 (ID: after-post)',
        'description' => esc_html__( '記事本文の下部エリア', 'igeta' ),
        'before_widget' => '<div class="widget-area-after-post widget %2$s container width-50">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ) );

    // メインカラムの最下部
    //     問い合わせ欄等
    register_sidebar( array(
        'id'          => 'main-bottom',
        'name'        => 'メインカラム最下部 (ID: main-bottom)',
        'description' => esc_html__( 'メインカラム最下部', 'igeta' ),
        'before_widget' => '<div id="%1$s" class="widget-area-main-bottom widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ) );

    // フッターメニュー (1〜3くらいのウィジェットの登録を想定)
    register_sidebar( array(
        'id'            => 'footer-nav',
        'name'          => esc_html__( 'フッターメニュー', 'igeta' ),
        'description'   => esc_html__( 'フッターメニュー (ID: footer-nav)', 'igeta' ),
        'before_widget' => '<aside id="%1$s" class="widget-area-footer-nav footer-nav widget %2$s">', // default: <li id="%1$s" class="widget %2$s">
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">', // default: <h2 class="widgettitle">
        'after_title'   => '</h2>'
    ) );

    // フッター連絡先
    register_sidebar( array(
        'id'            => 'footer-address',
        'name'          => esc_html__( 'フッター連絡先', 'igeta' ),
        'description'   => esc_html__( 'フッター連絡先 (ID: footer-address)', 'igeta' ),
        'before_widget' => '', // default: <li id="%1$s" class="widget %2$s">
        'after_widget'  => ''
    ) );

    // フッターコピーライト
    register_sidebar( array(
        'id'            => 'footer-copyright',
        'name'          => esc_html__( 'フッターコピーライト', 'igeta' ),
        'description'   => esc_html__( 'フッターコピーライト (ID: footer-copyright)', 'igeta' ),
        'before_widget' => '', // default: <li id="%1$s" class="widget %2$s">
        'after_widget'  => ''
    ) );
}
add_action( 'widgets_init', 'igeta_widgets_init' );


/**
 * ウィジェットの表示
 * サイドバーは sidebar.php、フッターは footer.php から呼び出す。
 * the_content 前後はフィルターを使用し挿入する
 */

/**
 * 投稿ページ、固定ページの the_contentの直前のウィジェット
 * @link https://wpdocs.osdn.jp/テーマのウィジェット対応
 */
function igeta_before_post_widget( $content ) {
    if ( is_singular() && is_active_sidebar( 'before-post' ) && ! is_front_page() && is_main_query() ) {
        dynamic_sidebar( 'before-post' );
    }
    return $content;
}
add_filter( 'the_content', 'igeta_before_post_widget' );


/**
 * 投稿ページ、固定ページの the_contentの直後のウィジェット
 * the_contentをフィルターでフックするプラグインが先に表示されないよう、
 *     表示(dynamic_sidebar('before-post');)でなく一旦バッファリングして返すようにする
 * @link http://incloop.com/the_contentのすぐ後にウィジェットを追加する方法/
 */
// ウィジェットの出力を返す関数
function get_dynamic_sidebar( $index = 1 ) {
        $contents = "";
        ob_start();
        dynamic_sidebar($index);
        $contents = ob_get_clean();
        return $contents;
}
// 本文と本文直後のウィジェットを返す
function igeta_after_post_widget( $content ) {
    if ( is_singular() && is_active_sidebar( 'after-post' ) && ! is_front_page() && ! is_page_template( 'page-parent.php' ) && is_main_query() ) {
        $addText = '<aside class="widget-area-after-post">' . get_dynamic_sidebar( 'after-post' ) . '</aside>';
    }
    else {
        $addText = '';
    }
    return $content.$addText;
}
add_filter( 'the_content', 'igeta_after_post_widget', '10' );
?>
