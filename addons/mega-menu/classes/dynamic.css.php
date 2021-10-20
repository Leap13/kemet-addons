<?php
/**
 * Mega Menu - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_mega_menu_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_mega_menu_dynamic_css( $dynamic_css ) {
	$css_content = array(
		'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item .mega-menu-full-wrap' => array(
			'background-color' => 'var(--globalBackgroundColor)',
			'border-top-width' => 'var(--borderTopWidth)',
			'border-top-color' => 'var(--borderTopColor)',
		),
		'.main-navigation .kemet-megamenu .heading-item>a' => array(
			'font-size' => 'var(--fontSize)',
		),
	);

	$parse_css = kemet_parse_css( $css_content );

	return $dynamic_css . $parse_css;
}
