<?php
/**
 * Extra Header Elements - Customizer options.
 *
 * @package Kemet Addons
 */

add_filter( 'header_desktop_items', 'extra_header_elements' );
add_filter( 'header_mobile_items', 'extra_header_elements' );

/**
 * extra_header_elements
 *
 * @param  array $options
 * @return array
 */
function extra_header_elements( $options ) {
	$addon_options = array(
		'elementor-template' => array(
			'name'    => __( 'Elementor Template', 'kemet-addons' ),
			'icon'    => 'admin-appearance',
			'section' => 'section-header-elementor-template',
		),
		'reusable-block'     => array(
			'name'    => __( 'Reusable Block', 'kemet-addons' ),
			'icon'    => 'admin-appearance',
			'section' => 'section-header-reusable-block',
		),
	);

	return array_merge( $options, $addon_options );
}

