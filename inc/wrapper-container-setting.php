<?php
/**
 * Layout Column Setting
 *
 * If you need, Override same file in Child Page
 *
 * @package igeta
 */

if ( ! function_exists( 'igeta_wrapper_container_setting' ) ) :
function igeta_wrapper_container_setting(){
	if ( is_single() || is_archive() || is_home() ) {
		// ( is_singular() && ( ! is_singular( 'page' ) ) ) || is_archive() || is_home()
		echo ' container';
	}
}
endif;
?>
