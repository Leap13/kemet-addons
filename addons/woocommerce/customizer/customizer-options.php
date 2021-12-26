<?php
/**
 * WooCommerce customizer options
 *
 * @package Kemet Addons
 */

add_filter( 'woo_shop_options', 'woo_shop_options' );
/**
 * woo_shop_options
 *
 * @param  array $options
 * @return array
 */
function woo_shop_options( $options ) {
	$prefix        = 'woo-shop';
	$addon_options = array(
		$prefix . '-title'                     => array(
			'type'  => 'kmt-title',
			'label' => __( 'Shop Settings', 'kemet-addons' ),
		),
		$prefix . '-layout'                    => array(
			'type'    => 'kmt-select',
			'label'   => __( 'Shop Layout', 'kemet-addons' ),
			'choices' => array(
				'woo-style1' => __( 'Style 1', 'kemet-addons' ),
				'woo-style2' => __( 'Style 2', 'kemet-addons' ),
			),
		),
		$prefix . '-quick-view'                => array(
			'type'  => 'kmt-title',
			'label' => __( 'Quick View Settings', 'kemet-addons' ),
		),
		$prefix . '-enable-quick-view'         => array(
			'type'  => 'kmt-switcher',
			'label' => __( 'Enable Quick View', 'kemet-addons' ),
		),
		$prefix . '-pagination-group'          => array(
			'type'  => 'kmt-title',
			'label' => __( 'Pagination Settings', 'kemet-addons' ),
		),
		$prefix . '-pagination-style'          => array(
			'type'    => 'kmt-select',
			'label'   => __( 'Pagination Style', 'kemet-addons' ),
			'choices' => array(
				'standard'        => __( 'Standard', 'kemet-addons' ),
				'infinite-scroll' => __( 'Infinite Scroll', 'kemet-addons' ),
			),
		),
		$prefix . '-load-more-style'           => array(
			'type'    => 'kmt-select',
			'default' => 'dots',
			'label'   => __( 'Load More Style', 'kemet-addons' ),
			'choices' => array(
				'dots'   => __( 'Dots', 'kemet-addons' ),
				'button' => __( 'Button', 'kemet-addons' ),
			),
			'context' => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
		$prefix . '-load-more-text'            => array(
			'type'    => 'kmt-text',
			'label'   => __( 'Load More Text', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
				array(
					'setting' => $prefix . '-load-more-style',
					'value'   => 'button',
				),
			),
		),
		$prefix . '-loader-color'              => array(
			'type'      => 'kmt-color',
			'transport' => 'postMessage',
			'label'     => __( 'Infinite Scroll Loader Color', 'kemet-addons' ),
			'pickers'   => array(
				array(
					'id'    => 'initial',
					'title' => __( 'Color', 'kemet-addons' ),
				),
			),
			'preview'   => array(
				'initial' => array(
					'selector' => '.kmt-woo-infinite-scroll-loader .kmt-woo-infinite-scroll-dots .kmt-woo-loader',
					'property' => 'background-color',
				),
			),
			'context'   => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
				array(
					'setting' => $prefix . '-load-more-style',
					'value'   => 'dots',
				),
			),
		),
		$prefix . '-infinite-scroll-last-text' => array(
			'type'    => 'kmt-text',
			'label'   => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
		$prefix . '-filter'                    => array(
			'type'  => 'kmt-title',
			'label' => __( 'Filter Settings', 'kemet-addons' ),
		),
		$prefix . '-enable-filter-button'      => array(
			'type'  => 'kmt-switcher',
			'label' => __( 'Enable Filter Button', 'kemet-addons' ),
		),
		$prefix . '-off-canvas-filter-label'   => array(
			'type'    => 'kmt-text',
			'label'   => __( 'Filter Button Text', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => $prefix . '-enable-filter-button',
					'value'   => true,
				),
			),
		),
	);

	return $addon_options + $options;
}


// /**
// * Option: Single Product
// */
// $wp_customize->add_control(
// new Kemet_Control_Title(
// $wp_customize,
// KEMET_THEME_SETTINGS . '[kmt-single-product-title]',
// array(
// 'type'     => 'kmt-title',
// 'label'    => __( 'Single Product Settings', 'kemet-addons' ),
// 'section'  => 'section-woo-shop-single',
// 'priority' => 1,
// 'settings' => array(),
// )
// )
// );

// /**
// * Option: Ajax Add To Cart (َJquery)
// */
// $wp_customize->add_setting(
// KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]',
// array(
// 'default'           => $defaults['enable-single-ajax-add-to-cart'],
// 'type'              => 'option',
// 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
// )
// );
// $wp_customize->add_control(
// KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]',
// array(
// 'type'     => 'checkbox',
// 'section'  => 'section-woo-shop-single',
// 'label'    => __( 'Enable Ajax Add To Cart', 'kemet-addons' ),
// 'priority' => 15,
// )
// );
