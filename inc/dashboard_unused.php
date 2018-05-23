<?php
/**
 * 自動整形機能の調整 ※TinyMCE のカスタマイズも設定すること
 *   ビジュアルエディタからテキストエディタに切り替えると、<hr> → <hr />のように
 *     XHTML準拠の形式に変換されるタグがあるが、表示ページでは前者の閉じタグ無しのHTML5表記になる
 *   @link: https://webkikaku.co.jp/blog/wordpress/wordpress-automatic-forming-control/
 *   @link: http://wp-setting.info/setting/stop-wptexturize.html
 *   @link: http://on-ze.com/archives/2967
 *   @link: http://itsmy.first-pclife.com/web-wordpress/webdesign-coding/106
 *   @link: http://qiita.com/jyokyoku/items/c560b0d1eacc1df61620
 */
add_action('init', function() {
    remove_filter('the_title', 'wpautop'); // 自動形成機能を停止
    remove_filter('the_excerpt', 'wpautop');
    // remove_filter('the_content', 'wpautop');
    // remove_filter('comment_text', 'wpautop');

    add_filter('run_wptexturize', '__return_false'); // 引用符、省略記号(...)、ダッシュ等の変換を無効化。pre や code 内はスキップ

    // remove_filter('the_editor_content', 'wp_richedit_pre'); // 4.3.0 で廃止
});

/**
 * TinyMCE のカスタマイズ
 *   デフォルト設定は /wp-includes/class-wp-editor.php を参照
 *   @link: https://wpdocs.osdn.jp/TinyMCE
 *   さらなるカスタマイズ
 *    http://wordpress.stackexchange.com/questions/141534/how-to-customize-tinymce4-in-wp-3-9-the-old-way-for-styles-and-formats-doesnt
 *    http://g3xerau6.hatenablog.com/entry/2014/04/21/185007
 */
// 自動形成機能を停止
add_filter('tiny_mce_before_init', function($init) {
    $init['block_formats'] = '段落=p;見出し2=h2;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6';
    $init['wpautop'] = false;
//自作クラスをプルダウンメニューで追加
$style_formats = array (
    array( 'title' => '参照リンク(左寄)', 'block' => 'p', 'classes' => 'reference' ),
    array( 'title' => '参照リンク(右寄)', 'block' => 'p', 'classes' => 'reference2' ),
    array( 'title' => 'アロー', 'inline' => 'a', 'classes' => 'inline_arrow' )
    );

$init['style_formats'] = json_encode( $style_formats );

$init['style_formats_merge'] = false;
    return $init;
});


/**
 * ダッシュボード：ビジュアルエディタのボタンに"ページ分割(<!–nextpage–>を挿入)"ボタン追加
 * link@ http://www.411.co.jp/article/2010/12/wordpress-vediter/
 * link@ https://gist.github.com/gatespace/3891254
 */
function ilc_mce_buttons($buttons){
    array_push($buttons, "wp_page");// wp_page はページ分割ボタン。「, "cleanup"」を追加でタグの閉じ忘れ等を整形するボタン
    return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons"); // mce_buttons_2 なら列の2行目に表示される


/**
 * TinyMCE Advanced を使う場合のカスタマイズ
 */
// // TMAより後に実行されるように、10000番ぐらいにフック登録
// add_filter('tiny_mce_before_init', 'litleflag_my_tinymce', 10000);
// function litleflag_my_tinymce($initArray) {
//  //選択できるブロック要素を変更
//  $initArray['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,div,pre';
//  //ボタン追加
//  $initArray['theme_advanced_buttons1'] .= ',hr';
//  $initArray['theme_advanced_buttons2'] .= ',sub, sup';
//  return $initArray;
// }


/**
 * 投稿画面のメニュー等の文言を変更
 * @link https://ja.forums.wordpress.org/topic/85984
 * @link http://code.tutsplus.com/tutorials/customizing-your-wordpress-admin--wp-24941
 */
// function change_admin_cpt_text_filter( $translated_text, $untranslated_text, $domain ) {
//  global $typenow;
//  if( is_admin() && 'post' == $typenow ) {
//      switch( $untranslated_text ) {
//          case 'Save Draft':
//          $translated_text = 'げんこうをほぞん';
//          break;
//          case 'Save as Pending':
//          $translated_text = 'ぺんでぃんぐとしてせーぶ';
//          break;
//      }
//      return $translated_text;
//  }
// }
// add_filter('gettext', 'change_admin_cpt_text_filter', 20, 3);

?>