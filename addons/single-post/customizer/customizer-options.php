<?php
/**
 * Extra Blogs - Customizer options.
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_single_blog_options', 'extra_single_blog_options' );

/**
 * extra_single_blog_options
 *
 * @param  array $options
 * @return array
 */
function extra_single_blog_options( $options ) {
	$addon_options = array(
		'single-featured-image-title'       => array(
			'type'  => 'kmt-title',
			'label' => __( 'Featured image settings', 'kemet-addons' ),
		),
		'single-post-featured-image-width'  => array(
			'type'  => 'kmt-number',
			'label' => __( 'Featured Image Custom Width', 'kemet' ),
			'min'   => 0,
			'step'  => 1,
			'max'   => 1200,
		),
		'single-post-featured-image-height' => array(
			'type'  => 'kmt-number',
			'label' => __( 'Featured Image Custom Height', 'kemet' ),
			'min'   => 0,
			'step'  => 1,
			'max'   => 1200,
		),
	);

	return array_merge( $options, $addon_options );
}

