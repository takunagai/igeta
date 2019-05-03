<?php
/**
 * Custom functions for plugins.
 *
 * @package igeta
 */


/**
 * Contact Form 7
 * 確認用メールアドレスのフィールドを追加
 *
 * @link http://kotori-blog.com/wordpress/contact-form-7/
 */
add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2 );
function wpcf7_text_validation_filter_extend( $result, $tag ) {
	$type           = $tag['type'];
	$name           = $tag['name'];
	$_POST[ $name ] = trim( strtr( (string) $_POST[ $name ], "\n", ' ' ) );
	if ( 'email' == $type || 'email*' == $type ) {
		if ( preg_match( '/(.*)_confirm$/', $name, $matches ) ) {
			$target_name = $matches[1];
			if ( $_POST[ $name ] != $_POST[ $target_name ] ) {
				if ( method_exists( $result, 'invalidate' ) ) {
					$result->invalidate( $tag, '確認用のメールアドレスが一致していません' );
				} else {
					$result['valid']           = false;
					$result['reason'][ $name ] = '確認用のメールアドレスが一致していません';
				}
			}
		}
	}
	return $result;
}


/**
 * Contact Form 7
 * 送信ボタンを押すと送信完了ページに移動
 * -> メールフォームの固定ページに埋め込み
 */
