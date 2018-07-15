<?php
/**
 * Layout Column-setting
 *
 * If you need, Override same file in Child Page
 *
 * @package igeta
 */

if ( ( is_singular() && ( ! is_singular( 'page' ) ) ) || is_archive() || is_home() ) {
	$layout_classes = ' container';
}
?>
