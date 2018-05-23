<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package igeta
 */


/**
 * Loop Settings
 */

// HOME (Post Index)
function change_posts_per_page_on_home($query) {
    // 管理画面、メインクエリーでない場合は、ここで処理を中止、以降のコードは実行されないようにする。
    // これがないと、管理画面の一覧もサイドバーのウィジェットも全て設定した件数ずつの表示になってしまう
    if ( is_admin() || ! $query->is_main_query() || is_preview() ) {
        return;
    }
    if ( $query->is_home() ) {
        $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'change_posts_per_page_on_home' );

// Archive
function change_posts_per_page_on_archive($query) {
    if ( is_admin() || ! $query->is_main_query() || is_preview() ) {
        return;
    }
    if ( $query->is_archive() ) {
        $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'change_posts_per_page_on_archive' );


/**
 * Archive of Custom Post Type
 */

// examples
function index_examples_mainloop($wp_query) {
    if ( !is_admin() && $wp_query->is_main_query() && ( $wp_query->is_post_type_archive(array('examples') ) || $wp_query->is_tax('examples-tag'))) { // 該当のページを指定するなら is_page(969)
        $wp_query->set( 'posts_per_page', 12 );
    }
}
add_action('pre_get_posts', 'index_examples_mainloop');


// events (開催予定のもののみ表示)
function change_posts_per_page_on_events($query) {
    if ( is_admin() || ! $query->is_main_query() || is_preview() ) {
        return;
    }
    if ( is_post_type_archive( 'events' ) ) {
        $current_date = date_i18n( 'Y/m/d' );
        $query->set( 'posts_per_page', 12 );
        $query->set( 'order', 'ASC');
        $query->set( 'orderby', 'meta_value' ); //meta_keyで指定するカスタムフィールドの順に並び替え
        $query->set( 'meta_key', 'end_date' ); //並び替えに使用したいカスタムフィールドで作ったフィールドスラッグ
        $query->set(
            'meta_query', // カスタムフィールドのフィールド
            array(
                array(
                    'key' => 'end_date', // 'meta_key' と同じもの
                    'value' => $current_date,
                    'compare' => '>=',
                    'type' => 'DATE'
                )
            )
        );
        return;
    }
}
add_action( 'pre_get_posts', 'change_posts_per_page_on_events' );
