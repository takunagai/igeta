<?php
/**
 * お客様用ダッシュボード(管理画面)のカスタマイズ
 * 参考1：http://htdsn.com/blog/archives/wordpress-admin-customize.html
 * 参考2：http://qiita.com/konweb/items/5483efbe87087eff5cc8
 * 参考3：http://hijiriworld.com/web/wordpress-admin-customize/
 * 参考4：http://0017.org/672.html
 * 参考5：http://www.tam-tam.co.jp/tipsnote/cms/post6887.html
 * 参考6：https://wpdocs.osdn.jp/ダッシュボードウィジェット_API
 * 参考7：http://while-creation.com/customize-wp-admin-menu/
 * 参考8：http://wpcj.net/1171
 * 参考9：http://log.noiretaya.com/165
 * 参考10：http://www.warna.info/archives/2439/
 * 参考11：http://qiita.com/konweb/items/e84209922c6d830f627a
 *
 * TODO:  プラグインのメニューを非表示にする方法は 参考2 を参照
 * ユーザーレベルによる分岐方法もありますが、WordPress 3.0以降で非推奨なので使わない
 * メニューのリンクは3.5以降は非表示となった http://www.locomoco-dou.jp/archives/1053
 */


/**
 * ログイン画面のカスタマイズ
 *
 * @link https://www.nxworld.net/wordpress/wp-custom-login-page.html
 */

// ロゴをカスタムロゴに
function login_logo_custom_logo() {
	$logo_url = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );
	if ( false !== $logo_url ) {
		echo '<style>#login h1 a { background-image:url( ' . $logo_url . ' );width:260px;background-size:contain; }</style>';
	}
}
add_action( 'login_enqueue_scripts', 'login_logo_custom_logo', 11 );

// ロゴのリンク先を WordPress.org から自サイトトップページに変更
function custom_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

// ポップオーバーラベルの文言の変更
function login_logo_title() {
	return get_bloginfo( 'name' ) . 'トップページへ';
}
add_filter( 'login_headertitle', 'login_logo_title' );



/**
 * バージョン更新を非表示にし、バージョンチェックの通信をさせない
 */
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'pre_site_transient_update_core', '__return_zero' );
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );
}


/**
 * アドミンバーから指定項目を消す
 */
function remove_admin_bar_menu() {
	if ( ! current_user_can( 'administrator' ) ) {
		global $wp_admin_bar;
		// var_dump($wp_admin_bar); //開発用：全ての値を表示
		$wp_admin_bar->remove_menu( 'wp-logo' ); // ロゴ
		// $wp_admin_bar->remove_node( 'site-name' ); // 左上のサイト名 (子にサイトを表示 view-site)
		$wp_admin_bar->remove_menu( 'comments' ); // コメント
		$wp_admin_bar->remove_menu( 'new-content' ); // 新規追加ボタン
		$wp_admin_bar->remove_menu( 'updates' ); // 更新
	}
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 99 );


/**
 * 右上の「表示オプション」と「ヘルプ」を非表示
 */
function hide_display_option_and_help() {
	if ( ! current_user_can( 'administrator' ) ) {
		echo '<style>#contextual-help-link-wrap,#screen-options-link-wrap{display:none;}</style>';
	}
}
add_action( 'admin_head', 'hide_display_option_and_help' );


/**
 * フッターの "WordPress のご利用ありがとうございます。" を差し替え
 */
function custom_admin_footer() {
	echo '<a href="mainto:info@nagaishouten.com" target="_blank">お問合せ</a>';
}
add_filter( 'admin_footer_text', 'custom_admin_footer' );


/**
 * 権限グループ毎に権限を追加/削除
 *     追加は add_cap()、削除は remove_cap()
 *     管理者 : administrator
 *     編集 : editor
 *     投稿者 : author
 *     寄稿者 : contributor
 *     購読者 : subscriber
 */

// "編集者"権限で「外観」メニュー有効化
function add_theme_caps() {
	if ( ! current_user_can( 'administrator' ) ) {
		get_role( 'editor' )->add_cap( 'edit_theme_options' );
	}
}
add_action( 'admin_init', 'add_theme_caps', 102 );


/**
 * 管理者以外は指定メニューを非表示
 */
function remove_menus() {
	if ( ! current_user_can( 'administrator' ) ) {
		// remove_menu_page( 'index.php' ); // ダッシュボード
		remove_submenu_page( 'index.php', 'update-core.php' ); // 更新
		// remove_menu_page( 'edit.php' ); // 投稿
		// remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // カテゴリー
		// remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // 投稿タグ
		// remove_menu_page( 'upload.php' ); // メディア
		// remove_submenu_page( 'upload.php', 'media-new.php' ); // 新規追加
		// remove_menu_page( 'edit.php?post_type=page' ); // 固定ページ
		// remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' ); // 新規追加
		// remove_menu_page( 'edit-comments.php' ); // コメント
		// remove_menu_page( 'themes.php' ); // 外観
		// remove_submenu_page( 'themes.php', 'widgets.php' ); // ウィジェット
		// remove_submenu_page( 'themes.php', 'theme-editor.php' ); // テーマ編集
		remove_submenu_page( 'themes.php', 'themes.php' ); // テーマ
		remove_menu_page( 'plugins.php' ); // プラグイン
		// remove_menu_page( 'users.php' ); // (管理者のみ)ユーザー
		// remove_submenu_page( 'users.php', 'user-new.php' ); // (管理者のみ)新規追加
		// remove_submenu_page( 'users.php', 'profile.php' ); // (管理者のみ)あなたのプロフィール
		// remove_menu_page( 'profile.php' ); // (管理者以外のみ)プロフィール
		remove_menu_page( 'tools.php' ); // ツール
		remove_menu_page( 'options-general.php' ); // 設定

		// プラグイン
		// remove_menu_page( 'edit.php?post_type=logbook' );
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'edit.php?post_type=acf' ); // Advanced Custom Fields (http://on-ze.com/archives/3178)
	}
}
add_action( 'admin_menu', 'remove_menus', 102 );


/**
 * メニューの並び替え
 */
if ( ! function_exists( 'igeta_custom_menu_order' ) ) {
	function igeta_custom_menu_order( $menu_ord ) {
		if ( ! current_user_can( 'administrator' ) ) {
			if ( ! $menu_ord ) {
				return true;
			}
			return array(
				'index.php', // ダッシュボード
				'edit.php', // 投稿
				'edit.php?post_type=member', // プライベートギャラリー
				'edit.php?post_type=page', // 固定ページ
				'upload.php', // メディア
				'themes.php', // 外観
				'edit-comments.php', // コメント
				'users.php', // ユーザー
				'profile.php', // プロフィール
				'edit.php?post_type=logbook', // ログ (プラグイン)
				'admin.php?page=manual', // マニュアル
			);
		}
	}
	add_filter( 'custom_menu_order', 'igeta_custom_menu_order' );
	add_filter( 'menu_order', 'igeta_custom_menu_order' );
}



/**
 * メニューのデフォルト投稿タイプ(デフォルトは「投稿」)のラベルを変更
 */
// 投稿 → ブログ に名称変更
function custom_post_labels( $labels ) {
	$labels->name                  = 'ブログ'; // 投稿
	$labels->singular_name         = 'ブログ'; // 投稿
	$labels->add_new               = '新規追加'; // 新規追加
	$labels->add_new_item          = 'ブログを追加'; // 新規投稿を追加
	$labels->edit_item             = '投稿の編集'; // 投稿の編集
	$labels->new_item              = '新規ブログ'; // 新規投稿
	$labels->view_item             = 'ブログを表示'; // 投稿を表示
	$labels->search_items          = 'ブログを検索'; // 投稿を検索
	$labels->not_found             = 'ブログが見つかりませんでした。'; // 投稿が見つかりませんでした。
	$labels->not_found_in_trash    = 'ゴミ箱内にブログが見つかりませんでした。'; // ゴミ箱内に投稿が見つかりませんでした。
	$labels->parent_item_colon     = ''; // (なし)
	$labels->all_items             = 'ブログ一覧'; // 投稿一覧
	$labels->archives              = 'ブログアーカイブ'; // 投稿アーカイブ
	$labels->insert_into_item      = 'ブログに挿入'; // 投稿に挿入
	$labels->uploaded_to_this_item = 'このブログへのアップロード'; // この投稿へのアップロード
	$labels->featured_image        = 'アイキャッチ画像'; // アイキャッチ画像
	$labels->set_featured_image    = 'アイキャッチ画像を設定'; // アイキャッチ画像を設定
	$labels->remove_featured_image = 'アイキャッチ画像を削除'; // アイキャッチ画像を削除
	$labels->use_featured_image    = 'アイキャッチ画像として使用'; // アイキャッチ画像として使用
	$labels->filter_items_list     = 'ブログリストの絞り込み'; // 投稿リストの絞り込み
	$labels->items_list_navigation = 'ブログリストナビゲーション'; // 投稿リストナビゲーション
	$labels->items_list            = 'ブログリスト'; // 投稿リスト
	$labels->menu_name             = 'ブログ'; // 投稿
	$labels->name_admin_bar        = 'ブログ'; // 投稿
	return $labels;
}
add_filter( 'post_type_labels_post', 'custom_post_labels' );


/**
 * ダッシュボードウィジェットの非表示
 */
// ようこそ画面の非表示
function hide_welcome_panel() {
	$user_id = get_current_user_id();
	if ( get_user_meta( $user_id, 'show_welcome_panel', true ) ) {
		update_user_meta( $user_id, 'show_welcome_panel', false );
	}
}
add_action( 'load-index.php', 'hide_welcome_panel' );

// 各ウィジェットの非表示
function custom_remove_dashboard_widgets() {
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );        // 概要
	// remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );      // 被リンク
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );             // プラグイン
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );               // WordPressブログ
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );           // WordPressフォーラム
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );           // クイックドラフト
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );     // 下書き
	// remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );             // アクティビティ
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // 最近のコメント
}
add_action( 'wp_dashboard_setup', 'custom_remove_dashboard_widgets' );



/**
 * 投稿画面の項目(非表示・表示)
 */

// デフォルト投稿タイプ
if ( ! function_exists( 'remove_default_post_screen_metaboxes' ) ) :
	function remove_default_post_screen_metaboxes() {
		if ( ! current_user_can( 'administrator' ) ) {
			remove_meta_box( 'slugdiv', 'post', 'normal' );            // スラッグ
			remove_meta_box( 'postcustom', 'post', 'normal' );         // カスタムフィールド
			remove_meta_box( 'commentstatusdiv', 'post', 'normal' );   // ディスカッション (コメント、トラックバック、ピンバックの投稿を許可するの選択)
			remove_meta_box( 'trackbacksdiv', 'post', 'normal' );      // トラックバック
			remove_meta_box( 'revisionsdiv', 'post', 'normal' );       // リビジョン

			// remove_meta_box( 'postexcerpt','post','normal' );        // 抜粋
			// remove_meta_box( 'commentsdiv','post','normal' );        // コメント
			// remove_meta_box( 'authordiv','post','normal' );          // 投稿者
			// remove_meta_box( 'categorydiv', 'post', 'normal' );      // カテゴリー
			// remove_meta_box( 'tagsdiv-post_tag', 'post', 'normal' ); // タグ
			remove_meta_box( 'formatdiv', 'post', 'normal' );        // フォーマット設定

			// 以下不明
			// remove_meta_box( 'linktargetdiv', 'link', 'normal' );
			// remove_meta_box( 'linkxfndiv', 'link', 'normal' );
			// remove_meta_box( 'linkadvanceddiv', 'link', 'normal' );
			// remove_meta_box( 'sqpt-meta-tags', 'post', 'normal' );
		}
	}
endif;
add_action( 'admin_menu', 'remove_default_post_screen_metaboxes' );


// 固定ページ
function remove_page_screen_metaboxes() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_meta_box( 'slugdiv', 'page', 'normal' );            // スラッグ
		remove_meta_box( 'postcustom', 'page', 'normal' );         // カスタムフィールド
		remove_meta_box( 'commentstatusdiv', 'page', 'normal' );   // ディスカッション (コメント、トラックバック、ピンバックの投稿を許可するの選択)
		remove_meta_box( 'commentsdiv', 'page', 'normal' );        // コメント
		remove_meta_box( 'authordiv', 'page', 'normal' );          // 投稿者
		remove_meta_box( 'trackbacksdiv', 'page', 'normal' );      // トラックバック
		remove_meta_box( 'revisionsdiv', 'page', 'normal' );       // リビジョン TODO: 効かない

		// remove_meta_box( 'pageparentdiv','page','side' );         // 固定ページの属性
	}
}
add_action( 'admin_menu', 'remove_page_screen_metaboxes' );

 // 固定ページに抜粋(概要)を追加
add_post_type_support( 'page', 'excerpt' );


/**
 * 記事投稿画面
 * ------------------------------------------------------------
 */

 /**
  * ビジュアルエディタのに指定のスタイルシートを適用
  * ※TinyMCE Advanced の設定で読み込ませているのでここでは不要
  */
// add_action( 'admin_init', function() {
// add_editor_style( 'editor-style.css' );
// });


/**
 * カテゴリ選択ボックスの階層を選択状況で並び替えさせない
 * (デフォルトではチェックしたカテゴリが上部に移動されるためそれを無効に)
 */
function solecolor_wp_terms_checklist_args( $args, $post_id ) {
	if ( ! isset( $args['checked_ontop'] ) ) {
		$args['checked_ontop'] = false;
	}
	return $args;
}
add_filter( 'wp_terms_checklist_args', 'solecolor_wp_terms_checklist_args', 10, 2 );



/**
 * 記事タイトル上下と本文入力欄の下に説明文を追加
 */
// 記事タイトル上 (2カラムにまたがり幅いっぱい)
function add_mgs_above_title() {
	global $typenow;
	if ( is_admin() && 'post' == $typenow ) {
		echo '<p style="display:inline-block;font-size:10px;color:#FFF;background-color:rgba(0,0,0,.5);border-radius:3px;">↓ 可能なら、"自然に"キーワードを入れた簡潔な記事タイトルを全角28文字以内で作成してください (不自然は☓)</p>';
	}
	if ( is_admin() && 'page' == $typenow ) {
		echo '<p>このページを的確に表す簡潔なページタイトルを作成してください。</p>';
	}
}
add_action( 'edit_form_top', 'add_mgs_above_title' );

// // 記事タイトル下のパーマリンクの下
// function add_mgs_after_title() {
// global $typenow;
// if( is_admin() && 'post' == $typenow ) {
// echo '<p style="display:inline-block;font-size:10px;color:#FFF;background-color:rgba(0,0,0,.5);border-radius:3px;">↓(post)<a href="#">» 投稿方法の説明</a></p>';
// }
// if( is_admin() && 'page' == $typenow ) {
// echo '<p>page キーワードを入れた簡潔な記事タイトルを全角28文字以内で作成してください。</p>';
// }
// }
// add_action( 'edit_form_after_title', 'add_mgs_after_title' );

// function add_mgs_after_editor() {
// global $typenow;
// if( is_admin() && 'post' == $typenow ) {
// echo '<p style="display:inline-block;font-size:10px;color:#FFF;background-color:rgba(0,0,0,.5);border-radius:3px;">↓(post)記事個別ページではリード文、一覧ページでは概要文となります。簡潔な概要をご記入ください。</p>';
// }
// if( is_admin() && 'page' == $typenow ) {
// echo '<p>ページの下部の説明。</p>';
// }
// }
// add_action( 'edit_form_after_editor', 'add_mgs_after_editor' );


/**
 * アイキャッチ画像設定エリアに補足テキストを表示
 *
 * @link https://www.nxworld.net/wordpress/wp-admin-customize-hack5.html
 */
function add_post_thumbnail_description( $content ) {
	return $content .= '<p>この記事のメイン写真。一覧ページ(Top,カテゴリ等)のサムネイル写真、個別ページ上部のメイン写真となります。必須ではありません。</p>';
}
add_filter( 'admin_post_thumbnail_html', 'add_post_thumbnail_description' );



/**
 * デフォルト投稿タイプの記事一覧ページから「作成者」の項目を削除
 *     表示オプションで消せる項目もある
 */
function custom_post_columns( $columns ) {
	// unset($columns['cb']); // チェックボックス
	// unset($columns['title']); // 投稿タイトル
	unset( $columns['author'] ); // 投稿者名
	// unset($columns['categories']); // カテゴリ
	// unset($columns['tags']); // タグ
	// unset($columns['comments']); // コメント
	// unset($columns['date']); // 投稿日時
	return $columns;
}
add_filter( 'manage_posts_columns', 'custom_post_columns' );



/**
 * 固定ページの記事一覧ページから任意の表示項目を削除
 *     表示オプションでも消せる
 */
function custom_page_columns( $columns ) {
	// unset($columns['cb']); // チェックボックス
	// unset($columns['title']); // タイトル
	unset( $columns['author'] ); // 作成者名
	unset( $columns['comments'] ); // コメント
	// unset($columns['date']); // 作成日時
	return $columns;
}
add_filter( 'manage_pages_columns', 'custom_page_columns' );


/**
 * メディア、画像関係
 * ------------------------------------------------------------
 */

/**
 * メディアライブラリで他のユーザーがアップロードした画像を表示させない
 */
function display_only_self_uploaded_medias( $wp_query ) {
	if ( ! current_user_can( 'administrator' ) ) {
		global $userdata;
		if ( is_admin() && $wp_query->is_main_query() && $wp_query->get( 'post_type' ) == 'attachment' ) {
			$wp_query->set( 'author', $userdata->ID );
		}
	}
}
add_action( 'pre_get_posts', 'display_only_self_uploaded_medias' );


/**
 * ギャラリーのデフォルトのリンク先を"添付ファイルのページ"から"メディアファイル"に変更
 */
function image_gallery_default_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file'; // file を none にすればリンクなし
	return $settings;
}
add_filter( 'media_view_settings', 'image_gallery_default_link' );

