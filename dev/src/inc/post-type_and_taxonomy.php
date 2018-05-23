<?php
/**
 * Custom Post Type, and Custom Taxonomy
 *
 * カスタム投稿タイプとカスタムタクソノミーは Custom Post Type UI プラグインで実装
 *
 * @link https://nagaishouten.com/
 *
 * @package igeta
 */


/**
 * カスタム投稿タイプのRSS配信
 */
//function custom_post_rss_set ($query) {
//  if (is_feed()) {
//    $post_type = $query->get( 'post_type' );
//    if (empty($post_type)) {
//      $query->set('post_type', array('post', 'voice'));
//    }
//    return $query;
//  }
//}
//add_filter('pre_get_posts', 'custom_post_rss_set');


/**
 * カスタム投稿のパーマリンク末尾に拡張子.htmlを付ける
 *
 * @link http://blog.shnr.net/custompost-permalink/
 * Custom Post Type Permalinks プラグインでも可能
*/

//// rewrite_rules_array フィルターにcustom post type分のrewrite ruleを追加
//function rewrite_rules($rules) {
//    $new_rules = array();
//    foreach (get_post_types() as $t)
//        $new_rules[$t . '/(.+?)\.html$'] = 'index.php?post_type=' . $t . '&name=$matches[1]';
//    return $new_rules + $rules;
//}
//add_action('rewrite_rules_array', 'rewrite_rules');
//
//// custom post type でのURLフォーマットを指定。　post_type_linkフィルターを利用
//// for custom post type, post_type_link (rather than post_link)
//function custom_post_permalink ($post_link) {
//    global $post;
//    $type = get_post_type($post->ID);
//    return home_url() . '/' . $type . '/' . $post->post_name . '.html';
//}
//add_filter('post_type_link', 'custom_post_permalink');



/**
 * Simple Tagsプラグインのクリックタグ機能をカスタム投稿でも使用できるように
 *
 * @link http://wordpress.org/support/topic/plugin-simple-tags-click-tags-and-suggested-tags-boxes-not-showing-up-for-custom-post-type
 * Custom Post Type Permalinks プラグインでも可能
*/
//function add_clicktags() {
//  add_meta_box('st-clicks-tags', __('Click tags', 'simpletags'), array(&$this, 'boxClickTags'), '[★カスタム投稿タイプ名]', 'advanced', 'core');
//}
//add_action('admin_init', 'add_clicktags');



/**
 * 検索結果にカスタム投稿タイプを含める
 *
 * $query->set 第2引数に、適用したいカスタム投稿タイプを指定
 * @link http://wpdocs.sourceforge.jp/プラグイン_API/アクションフック一覧/pre_get_posts
*/
//function search_filter($query) {
//  if ( !is_admin() && $query->is_main_query() ) {
//    if ($query->is_search) {
//      $query->set('post_type', array( 'post', 'examples' ) );
//    }
//  }
//}
//add_action('pre_get_posts','search_filter');



/**
 * 新着情報表示にカスタム投稿タイプを含める
 *
 * @link http://www.warna.info/archives/1703/
*/
//function chample_latest_posts( $wp_query ) {
//  if ( is_home() && ! isset( $wp_query->query_vars['suppress_filters'] ) ) {
//    $wp_query->query_vars['post_type'] = array( 'post', 'page' );
//  }
//}
//add_action( 'parse_query', 'chample_latest_posts' );



/**
 * カスタム投稿タイプのアーカイブ表示で、カスタム分類での絞り込み検索
 *
 * @author: jim912
 * @link http://www.warna.info/archives/2421/
 */

// カスタム投稿タイプのアーカイブページで、カスタム分類による複合検索を可能にします。
// フォームのname属性は、カスタム分類のスラッグ + アンダースコア２個（__） + tax_queryのオペレーター + []となります。
// オペレーターは、以下の３種類が指定可能です。
//   in     : いずれかに合致
//   not_in : いずれにも合致しない
//   and    : 全てに合致
// カスタム分類のスラッグが color でいずれかに合致させたい場合、フォームのname属性は color__in[] です。
// 検索条件は、cookieに保存され、ページ送りを行った際にも条件を引き継ぐようになります。
function custom_post_type_search ($wp_query) {
    global $search_cond;
    $search_cond = array();
    if (! is_admin() && $wp_query->is_main_query()) {
        if ($wp_query->is_post_type_archive()) {
            $post_type = $wp_query->get('post_type');
            $taxonomies = get_object_taxonomies($post_type);
            if ($taxonomies) {
                $tax_query = array();
                foreach ($taxonomies as $taxonomy) {
                    foreach (array('in', 'not_in', 'and') as $operator) {
                        $_post = array();
                        $name = $taxonomy . '__' . $operator;
                        $cookie_name = $post_type . '-' . $name;
                        if (
                                ($_SERVER['REQUEST_METHOD'] == 'POST')
                                ||
                                (get_query_var('paged') && isset($_COOKIE[$cookie_name]) && ! empty($_COOKIE[$cookie_name]))
                        ) {
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    if (isset($_POST[$name]) && ! empty($_POST[$name])) {
                                        $_post = stripslashes_deep($_POST[$name]);
                                        setcookie($cookie_name, serialize($_post), 0, '/');
                                    }
                                    elseif (isset($_COOKIE[$cookie_name])) {
                                        setcookie($cookie_name, serialize($_post), 0, '/');
                                    }
                                }
                                else {
                                    $_post = maybe_unserialize(stripslashes_deep($_COOKIE[$cookie_name]));
                                }
                                if ($_post) {
                                    $tax_query[] = array(
                                        'taxonomy' => $taxonomy,
                                        'terms'    => $_post,
                                        'field'    => 'slug',
                                        'operator' => strtoupper(str_replace( '_', ' ', $operator))
                                    );
                                    $search_cond[$name] = $_post;
                                }
                        }
                    }
                }
                $wp_query->set('tax_query', $tax_query);
            }
        }
    }
}
add_action( 'pre_get_posts', 'custom_post_type_search' );


// デフォルトでは、アーカイブの１ページ目でページ送りのパラメーターがあると、
// パラメーターなしのページにリダイレクトするようになっている。
// この場合、最初に訪れたのか検索後の表示かが判別できないため
// １ページ目でページ送り用のパラメーターが付いている場合のリダイレクトを停止させます。
function fix_first_paged_redirect ($redirect_url, $requested_url) {
    if (is_post_type_archive() && get_query_var('paged') == 1) {
        $redirect_url = $requested_url;
    }
    return $redirect_url;
}
add_filter('redirect_canonical', 'fix_first_paged_redirect', 10, 2);


// ページ送りのリンクで１ページ目にパラメーターが付くように
// これによって、最初に訪れたのか、検索後に戻ってきたのかを判断できるようになる
function add_first_paged_query ($result) {
    global $wp_rewrite;
    if (is_post_type_archive()) {
        if ($wp_rewrite->using_permalinks()) {
            if (!preg_match('#/page/[0-9]+/?#', $result)) {
                $result = user_trailingslashit(rtrim($result, '/') . '/page/1');
            }
        }
        elseif (!preg_match('#(&|\?)paged=[0-9]+#', $result)) {
            $result = add_query_arg(array('paged' => 1), $result);
        }
    }
    return $result;
}
add_filter('get_pagenum_link', 'add_first_paged_query');
?>
