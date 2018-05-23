<?php
/**
 * enqueue scripts and css files.
 *
 * @link https://nagaishouten.com/
 *
 * @package igeta
 */


/**
 * Enqueue scripts and styles. (JavaScript と CSS の読み込み)
 *
 * - get_template_directory_uri() は親テーマ、get_stylesheet_directory_uri() は有効化しているテーマのディレクトリを指す
 * - WordPress内のjQueryの読み込みを停止し、CDNから取得した最新版を使用
 *     CDNのバージョンリスト：https://developers.google.com/speed/libraries/#jquery
 * - 補足：WordPress本体組み込みのjQueryを使う場合は、カプセル化して使う必要がある (例：jQuery(function($) {//処理})
 */
function igeta_scripts() {

  // CSS, JSの読み込み
  //   引数：識別名, URL, 依存CSSの識別名, バージョン文字列, メディア指定
  //   ログイン時はキャッシュを使わない
  if ( is_user_logged_in() ) {
    wp_enqueue_style( 'igeta-style', get_stylesheet_uri() . '?' . filemtime( get_stylesheet_directory() ) );
  } else {
    wp_enqueue_style( 'igeta-style', get_stylesheet_uri() );
  }

  // JavaScript の設定
  // 引数：識別名, URL, 依存スクリプトの識別名, バージョン文字列, body閉じタグ直前かどうか

  wp_enqueue_script( 'vender-bundle', get_template_directory_uri() . '/js/vendor.bundle.js', array(), '0.0.1', true );
  wp_enqueue_script( 'common-bundle', get_template_directory_uri() . '/js/common.bundle.js', array('vender-bundle'), '0.0.1', true );
  wp_enqueue_script( 'unique-bundle', get_stylesheet_directory_uri() . '/js/unique.bundle.js', array( 'common-bundle' ), '0.0.1', true );

  // Comment
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  // Contact Form 7 (設置ページのスラッグが contact)
  if ( is_page( array( 'contact' ) )  ) {
    wp_enqueue_script( 'yubinbbango', '//yubinbango.github.io/yubinbango/yubinbango.js', array(), '1.0', false );
  }
}
add_action( 'wp_enqueue_scripts', 'igeta_scripts' );
