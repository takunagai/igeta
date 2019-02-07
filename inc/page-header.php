<?php
/**
 * Layout Column Setting
 *
 * If you need, Override same function (without if statement) in child theme
 *
 * @package igeta
 */
if ( ! function_exists( 'igeta_wrapper_container_setting' ) ) :
function igeta_page_header_setting(){
	if ( is_single() || is_archive() ) {
		// ( is_singular() && ( ! is_singular( 'page' ) ) ) || is_archive() || is_home()
		echo ' container';
	}
}
endif;
?>

<?php
/**
 * Page Header Setting
 *
 * If you need, Override same function (without if statement) in child theme
 *
 * @package igeta
 */

// アイキャッチ画像をCSS背景に
//   出力：echo $post_thumnail_bg_style;
if ( is_singular( 'post' ) ) {
	if ( has_post_thumbnail() ) {
		echo '<div class="bg--post-thumbnail bg--post-thumbnail--large" style="background-image:url(' . wp_get_attachment_url( get_post_thumbnail_id() ) . ');"></div>';
	} else {
		echo '<div class="bg--post-thumbnail"><p class="parent-title">Blog</p></div>';
	}

	get_template_part( 'template-parts/breadcrumbs' );

	// $post_thumnail_bg_style = '';
	// if ( has_post_thumbnail() ) {
	// 	$post_thumnail_bg_style = ' style="background-image: '
	// 	. wp_get_attachment_url( get_post_thumbnail_id() )
	// 	. ');"';
	// }
}

?>
<?php if ( is_home() || ( 'post' === get_post_type() && ( is_category() || is_tag() || is_month() || is_author() ) ) ) : ?>
	<div class="bg--post-thumbnail">
		<p class="parent-title">Blog</p>
	</div>
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php elseif ( is_singular( 'member' ) || is_post_type_archive( 'member' ) ) : ?>
	<div class="bg--post-thumbnail">
		<p class="parent-title">プライベート・ギャラリー</p>
	</div>
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php elseif ( is_singular( 'lesson' ) || is_post_type_archive( 'lesson' ) ) : ?>
	<div class="bg--post-thumbnail">
		<p class="parent-title">予約受付中のレッスン</p>
	</div>
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php endif ; ?>
