<?php
/**
 * ページのヘッダー
 *
 * 必要なら子テーマで上書き
 *
 * @package igeta
 */


 // アイキャッチ画像をCSS背景に
 // 出力：echo $post_thumnail_bg_style;
if ( is_singular( 'post' ) ) {
	if ( has_post_thumbnail() ) {
		echo '<div class="bg--post-thumbnail bg--post-thumbnail--large" style="background-image:url(' . wp_get_attachment_url( get_post_thumbnail_id() ) . ');"></div>';
	} else {
		echo '<div class="bg--post-thumbnail"><p class="parent-title">Blog</p></div>';
	}


	// $post_thumnail_bg_style = '';
	// if ( has_post_thumbnail() ) {
	// $post_thumnail_bg_style = ' style="background-image: '
	// . wp_get_attachment_url( get_post_thumbnail_id() )
	// . ');"';
	// }
} elseif ( is_home() || ( 'post' === get_post_type() && ( is_category() || is_tag() || is_month() || is_author() ) ) ) {
	echo '<div class="bg--post-thumbnail"><p class="parent-title">Blog</p></div>';
}

// elseif ( is_singular( 'member' ) || is_post_type_archive( 'member' ) ) {
// echo '<div class="bg--post-thumbnail"><p class="parent-title">プライベート・ギャラリー</p></div>';
// }

elseif ( is_singular( 'lesson' ) || is_post_type_archive( 'lesson' ) ) {
	echo '<div class="bg--post-thumbnail"><p class="parent-title">予約受付中のレッスン</p></div>';
}
