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
	$prefix                = 'woo-shop';
	$style1_context        = array(
		'setting' => $prefix . '-layout',
		'value'   => 'woo-style1',
	);
	$addon_general_options = array(
		$prefix . '-layout'                    => array(
			'type'     => 'kmt-select',
			'priority' => 6,
			'label'    => __( 'Shop Layout', 'kemet-addons' ),
			'choices'  => array(
				'woo-style1' => __( 'Style 1', 'kemet-addons' ),
				'woo-style2' => __( 'Style 2', 'kemet-addons' ),
			),
		),
		$prefix . '-quick-view'                => array(
			'type'     => 'kmt-title',
			'priority' => 30,
			'label'    => __( 'Quick View Settings', 'kemet-addons' ),
		),
		$prefix . '-enable-quick-view'         => array(
			'type'     => 'kmt-switcher',
			'priority' => 35,
			'label'    => __( 'Enable Quick View', 'kemet-addons' ),
		),
		$prefix . '-pagination-group'          => array(
			'type'     => 'kmt-title',
			'priority' => 40,
			'label'    => __( 'Pagination Settings', 'kemet-addons' ),
		),
		$prefix . '-pagination-style'          => array(
			'type'     => 'kmt-select',
			'priority' => 45,
			'label'    => __( 'Pagination Style', 'kemet-addons' ),
			'choices'  => array(
				'standard'        => __( 'Standard', 'kemet-addons' ),
				'infinite-scroll' => __( 'Infinite Scroll', 'kemet-addons' ),
			),
		),
		$prefix . '-load-more-style'           => array(
			'type'     => 'kmt-select',
			'priority' => 50,
			'default'  => 'dots',
			'label'    => __( 'Load More Style', 'kemet-addons' ),
			'choices'  => array(
				'dots'   => __( 'Dots', 'kemet-addons' ),
				'button' => __( 'Button', 'kemet-addons' ),
			),
			'context'  => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
		$prefix . '-load-more-text'            => array(
			'type'     => 'kmt-text',
			'priority' => 55,
			'label'    => __( 'Load More Text', 'kemet-addons' ),
			'context'  => array(
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
		$prefix . '-infinite-scroll-last-text' => array(
			'type'     => 'kmt-text',
			'priority' => 65,
			'label'    => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
			'context'  => array(
				array(
					'setting' => $prefix . '-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
		$prefix . '-filter'                    => array(
			'type'     => 'kmt-title',
			'priority' => 70,
			'label'    => __( 'Filter Settings', 'kemet-addons' ),
		),
		$prefix . '-enable-filter-button'      => array(
			'type'     => 'kmt-switcher',
			'priority' => 75,
			'label'    => __( 'Enable Filter Button', 'kemet-addons' ),
		),
		$prefix . '-off-canvas-filter-label'   => array(
			'type'     => 'kmt-text',
			'priority' => 80,
			'label'    => __( 'Filter Button Text', 'kemet-addons' ),
			'context'  => array(
				array(
					'setting' => $prefix . '-enable-filter-button',
					'value'   => true,
				),
			),
		),
	);

	$addon_design_options = array(
		$prefix . '-summary-bg-color'          => array(
			'type'      => 'kmt-color',
			'priority'  => 25,
			'transport' => 'postMessage',
			'label'     => __( 'Product Summary Background Color', 'kemet' ),
			'pickers'   => array(
				array(
					'id'    => 'initial',
					'title' => __( 'Initial', 'kemet' ),
				),
			),
			'preview'   => array(
				'initial' => array(
					'selector' => '.woo-style2 ul.products li.product',
					'property' => '--backgroundColor',
				),
			),
			'context'   => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-button-style'              => array(
			'type'     => 'kmt-radio',
			'priority' => 30,
			'default'  => 'text',
			'label'    => __( 'Button Style', 'kemet' ),
			'choices'  => array(
				'text'   => __( 'Text', 'kemet' ),
				'button' => __( 'Button', 'kemet' ),
			),
			'context'  => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-style2-icons-color'        => array(
			'type'      => 'kmt-color',
			'priority'  => 35,
			'transport' => 'postMessage',
			'label'     => __( 'Icons Color', 'kemet' ),
			'pickers'   => array(
				array(
					'id'    => 'initial',
					'title' => __( 'Initial', 'kemet' ),
				),
				array(
					'id'    => 'hover',
					'title' => __( 'Hover', 'kemet' ),
				),
			),
			'preview'   => array(
				'initial' => array(
					'selector' => '.woo-style2 ul.products li.product .kemet-shop-product-buttons a:not(.added_to_cart):not(.add_to_cart_button), .woo-style2 ul.products li.product .kemet-shop-product-buttons .yith-wcwl-wishlistexistsbrowse',
					'property' => '--linksColor',
				),
				'hover'   => array(
					'selector' => '.woo-style2 ul.products li.product .kemet-shop-product-buttons a:not(.added_to_cart):not(.add_to_cart_button), .woo-style1 ul.products li.product .kemet-shop-product-buttons .yith-wcwl-wishlistexistsbrowse',
					'property' => '--linksHoverColor',
				),
			),
			'context'   => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-product-button'            => array(
			'type'     => 'kmt-title',
			'priority' => 49,
			'label'    => __( 'Button Style', 'kemet' ),
			'context'  => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-product-button-typography' => array(
			'type'      => 'kmt-typography',
			'priority'  => 49,
			'transport' => 'postMessage',
			'label'     => __( 'Typography', 'kemet' ),
			'preview'   => array(
				'selector' => '.woo-style2 ul.products li.product .kemet-shop-product-buttons .add_to_cart_button ,.woo-style2 ul.products li.product .kemet-shop-product-buttons .added_to_cart',
			),
			'context'   => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-product-button-spacing'    => array(
			'type'           => 'kmt-spacing',
			'priority'       => 49,
			'transport'      => 'postMessage',
			'responsive'     => true,
			'label'          => __( 'Padding', 'kemet' ),
			'linked_choices' => true,
			'unit_choices'   => array( 'px' ),
			'choices'        => array(
				'top'    => __( 'Top', 'kemet' ),
				'right'  => __( 'Right', 'kemet' ),
				'bottom' => __( 'Bottom', 'kemet' ),
				'left'   => __( 'Left', 'kemet' ),
			),
			'preview'        => array(
				'selector'   => '.woo-style2 ul.products li.product .kemet-shop-product-buttons>:first-child',
				'property'   => '--padding',
				'responsive' => true,
				'sides'      => false,
			),
			'context'        => array(
				array(
					'setting' => $prefix . '-layout',
					'value'   => 'woo-style2',
				),
			),
		),
		$prefix . '-quick-view-style'          => array(
			'type'     => 'kmt-title',
			'priority' => 120,
			'label'    => __( 'Quick View Style', 'kemet-addons' ),
			'context'  => array(
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
		$prefix . '-loader-color'              => array(
			'type'      => 'kmt-color',
			'priority'  => 125,
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
	);

	$options[ $prefix . '-tabs' ]['tabs']['design']['options'][ $prefix . '-overlay-bg-color' ]['context'][] = $style1_context;
	$options[ $prefix . '-tabs' ]['tabs']['design']['options'][ $prefix . '-icons-style' ]['context'][]      = $style1_context;
	$options[ $prefix . '-tabs' ]['tabs']['design']['options'][ $prefix . '-icons-color' ]['context'][]      = $style1_context;
	$options[ $prefix . '-tabs' ]['tabs']['design']['options'][ $prefix . '-icons-bg-color' ]['context'][]   = $style1_context;
	$options[ $prefix . '-tabs' ]['tabs']['design']['options'][ $prefix . '-icons-border' ]['context'][]     = $style1_context;
	$options[ $prefix . '-tabs' ]['tabs']['general']['options'] = $addon_general_options + $options[ $prefix . '-tabs' ]['tabs']['general']['options'];
	$options[ $prefix . '-tabs' ]['tabs']['design']['options']  = $addon_design_options + $options[ $prefix . '-tabs' ]['tabs']['design']['options'];

	return $options;
}

