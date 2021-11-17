<?php
/**
 * Woocommerce - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_woocommerce_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css css.
 * @return string
 */
function kemet_woocommerce_dynamic_css( $dynamic_css ) {
	// Global.
	$theme_color = kemet_get_sub_option( 'theme-color', 'initial' );
	$btn_color   = kemet_get_sub_option( 'button-color', 'initial', '#ffffff' );

	// Shop.
	$loader_color        = kemet_get_sub_option( 'woo-shop-loader-color', 'initial', $theme_color );
	$inifinte_text_color = kemet_get_option( 'woo-shop-infinite-text-color', $btn_color );

	$css_content = array(
		'.woocommerce .kmt-qv-icon,.kmt-qv-icon'      => array(
			'background-color' => 'var(--globalBackgroundColor)',
			'border-color'     => 'var(--borderColor)',
		),
		'.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn , .shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn' => array(
			'background-color' => 'var(--buttonBackgroundColor)',
			'color'            => 'var(--buttonColor)',
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .kemet-shop-summary-wrap .kmt-qv-on-list' => array(
			'border-color' => 'var(--borderColor)',
			'color'        => 'var(--textColor)',
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn' => array(
			'border-color' => 'var(--borderColor)',
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn .yith-wcwl-add-to-wishlist > *' => array(
			'color' => 'var(--textColor)',
		),
		'.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn:hover a' => array(
			'color' => 'var(--textColor)',
		),
		'div.product .summary .yith-wcwl-wishlistexistsbrowse:hover' => array(
			'color' => 'var(--themeColor)',
		),
		'.single-product div.product .entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-icon, .single-product div.product .entry-summary .compare:before' => array(
			'background-color' => 'var(--globalBackgroundColor)',
		),
		'.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn:hover' => array(
			'background-color' => 'var(--buttonBackgroundHoverColor)',
			'color'            => 'var(--buttonHoverColor, var(--buttonColor))',
		),
		'.product-list-img a.kmt-qv-on-image, .add-to-cart-group .added_to_cart' => array(
			'background-color' => 'var(--buttonBackgroundColor)',
			'color'            => 'var(--buttonColor)',
		),
		'.product-list-img a.kmt-qv-on-image:hover, .add-to-cart-group .added_to_cart:hover' => array(
			'background-color' => 'var(--buttonBackgroundHoverColor)',
			'color'            => 'var(--buttonHoverColor, var(--buttonColor))',
		),
		'.kmt-woo-infinite-scroll-loader .kmt-woo-infinite-scroll-dots .kmt-woo-loader' => array(
			'background-color' => esc_attr( $loader_color ),
		),
		'a.plus, a.minus'                             => array(
			'border-color'     => 'var(--borderColor)',
			'background-color' => 'var(--inputBackgroundColor)',
		),
		'.kmt-woo-load-more .woo-load-more-text'      => array(
			'color' => esc_attr( $inifinte_text_color ),
		),
		'.shop-grid .yith-wcwl-add-to-wishlist'       => array(
			'color' => 'var(--headingLinksColor)',
		),
		'.shop-grid .yith-wcwl-add-to-wishlist:hover' => array(
			'color' => 'var(--themeColor)',
		),
	);
	$parse_css   = kemet_parse_css( $css_content );
	return $dynamic_css . $parse_css;
}
