<?php
/**
 * igeta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package igeta
 */

date_default_timezone_set('Asia/Tokyo');


if ( ! function_exists( 'igeta_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function igeta_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on igeta, use a find and replace
		 * to change 'igeta' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'igeta', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary_menu'   => esc_html__( 'Primary', 'igeta' ),
			'secondary_menu' => esc_html__( 'Secondary', 'igeta' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'igeta_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		/* --------- 追加 ここから --------- */

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add Editor Style and prevent cache
		 *    テーマディレクトリ直下の editor-style.css を適用 (パスを指定したい場合は引数にセット)
		 *
		 * @link https://wpdocs.osdn.jp/Editor_Style
		 * @link https://tenman.info/labo/css/?p=6033
		 */
		add_editor_style();

		function extend_tiny_mce_before_init( $mce_init ) {
			$mce_init['cache_suffix'] = 'v='.time();
			return $mce_init;
		}
		add_filter( 'tiny_mce_before_init', 'extend_tiny_mce_before_init' );


		/**
		 * 固定ページでスラッグと斎場の祖先ページのスラッグを body_class() にクラスとして追加
		 * @link https://www.nxworld.net/wordpress/wp-add-page-slug-body-class.html (fix necessary)
		 */
		function add_page_slug_class_name( $classes ) {
			if ( is_page() ) {
				$page = get_post( get_the_ID() );
				$classes[] = $page->post_name;

				$parent_id = $page->post_parent;
				if ( 0 == $parent_id ) {
					$classes[] = get_post($parent_id)->post_name;
				} else {
					$ancestorsArray = get_ancestors( $page->ID, 'page', 'post_type' );
					$progenitor_id = array_pop( $ancestorsArray );
					$classes[] = get_post($progenitor_id)->post_name . '-child';
				}
			}
			return $classes;
		}
		add_filter( 'body_class', 'add_page_slug_class_name' );

		/**
		 * 固定ページで抜粋を使えるようにする
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * 不要なmetaタグを表示させない
		 */
		remove_action( 'wp_head', 'wp_generator' ); // WordPress のバージョン
		remove_action( 'wp_head', 'rsd_link' ); // XML-RPC を利用する外部サービス向け
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // アーカイブ等のrss2フィード
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer 用
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // 前後記事へのリンク。先読みで使うブラウザあり
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		// remove_action( 'wp_head', 'feed_links', 2 ); // サイト全体のrss2フィード
		// remove_action( 'wp_head', 'rel_canonical' );
		// remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // Embed対応用
		// remove_action( 'wp_head', 'wp_oembed_add_host_js' ); // Embed対応用


		/**
		 * 日付アーカイブのタイトルを調整
		 * @link http://morilog.com/wordpress/tips/jp_date_wp_title/
		 */
		if ( ! function_exists('jp_date_wp_title') ) {
			function jp_date_wp_title( $title, $sep, $seplocation ) {
				if ( is_date() ) {
					$m = get_query_var('m');
					if ( $m ) {
						$year = substr($m, 0, 4);
						$month = intval(substr($m, 4, 2));
						$day = intval(substr($m, 6, 2));
					} else {
						$year = get_query_var('year');
						$month = get_query_var('monthnum');
						$day = get_query_var('day');
					}

					$title = ($seplocation != 'right' ? " $sep " : '') .
						($year ? $year . '年' : '') .
						($month ? $month . '月' : '') .
						($day ? $day . '日' : '') .
						($seplocation == 'right' ? " $sep " : '');
				}
				return $title;
			}
			add_filter( 'wp_title', 'jp_date_wp_title', 10, 3 );
		}


		/**
		 * 現在のページ数とページ総数の表示。単ページなら何も表示しない
		 *     使用：テンプレート中で <? show_current_page_number(); ?>
		 *     参考：http://www.kxh-web.com/pagebunkatu/
		 *     参考(
		 */
		//投稿ページ分割用
		function show_page_number() {
			global $pages, $page, $numpages, $multipage; // グローバル変数：https://wpdocs.osdn.jp/グローバル変数
			$current_page_num = ( get_query_var('page') ) ? get_query_var('page') : 1; // 1ページ目なら 0 が返るので 1 を返す
			if ( $multipage ) {
				return ' (' . $current_page_num.' / '.$numpages . ')';
			}
		}

		/**
		 * 冒頭コメントで記事ごとに wpautop を無効にする
		 * @link https://elearn.jp/wpman/column/c20130813_01.html
		 */
		function noautop( $content ) {
			if ( strpos( $content, '<!--noautop-->' ) !== false ) {
				remove_filter( 'the_content', 'wpautop' );
				$content = preg_replace( "/\s*\<!--noautop-->\s*(\r\n|\n|\r)?/u", "", $content );
			}
			return $content;
		}
		add_filter( 'the_content', 'noautop', 1 );

		/* --------- 追加 ここまで --------- */
	}
endif;
add_action( 'after_setup_theme', 'igeta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function igeta_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'igeta_content_width', 640 );
}
add_action( 'after_setup_theme', 'igeta_content_width', 0 );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/**
 * Implement the Custom Logo feature. // 追加
 */
// require get_template_directory() . '/inc/custom-logo.php';

/**
 * Custom functions that act independently of the theme templates. // 追加
 */
require get_template_directory() . '/inc/extras.php';

/**
 * enqueue scripts and css files // 追加
 */
if ( !is_admin() ) {
	require get_template_directory() . '/inc/enqueue.php';
}

/**
 * enqueue scripts and css files // 追加
 */
require get_template_directory() . '/inc/dashboard.php';
require get_template_directory() . '/inc/tinymce.php';

/**
 * Widgets // 追加
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom functions for plugins. // 追加
 */
require get_template_directory() . '/inc/plugins.php';
