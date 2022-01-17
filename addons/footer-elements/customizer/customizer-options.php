<?php
/**
 * Extra Footer Elements - Customizer options.
 *
 * @package Kemet Addons
 */

add_filter( 'footer_items', 'extra_footer_elements' );

/**
 * extra_footer_elements
 *
 * @param  array $options
 * @return array
 */
function extra_footer_elements( $options ) {
	$addon_options = array(
		'elementor-template' => array(
			'name'    => __( 'Elementor Template', 'kemet-addons' ),
			'icon'    => 'admin-appearance',
			'section' => 'section-footer-elementor-template',
		),
		'reusable-block'     => array(
			'name'    => __( 'Reusable Block', 'kemet-addons' ),
			'icon'    => 'admin-appearance',
			'section' => 'section-footer-reusable-block',
		),
	);

	return array_merge( $options, $addon_options );
}

