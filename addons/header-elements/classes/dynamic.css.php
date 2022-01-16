<?php
/**
 * Header Elements - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_header_elements_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css dynamic css.
 * @return string
 */
function kemet_header_elements_dynamic_css( $dynamic_css ) {

	return $dynamic_css;

}
