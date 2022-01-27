<?php
/**
 * Extra Blogs - Customizer options.
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_blog_options', 'extra_blog_options' );

/**
 * extra_blog_options
 *
 * @param  array $options
 * @return array
 */
function extra_blog_options( $options ) {
	$addon_options = array(
		'blog-mode-title'                => array(
			'type'    => 'kmt-title',
			'label'   => __( 'Blog Mode', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => 'blog-layouts',
					'value'   => 'blog-layout-2',
				),
			),
		),
		'blog-layout-mode'               => array(
			'type'    => 'kmt-select',
			'label'   => __( 'Grid Style', 'kemet-addons' ),
			'choices' => array(
				'masonry'  => __( 'Masonry', 'kemet-addons' ),
				'fit-rows' => __( 'Fit Rows', 'kemet-addons' ),
			),
			'context' => array(
				array(
					'setting' => 'blog-layouts',
					'value'   => 'blog-layout-2',
				),
			),
		),
		'featured-image-title'           => array(
			'type'  => 'kmt-title',
			'label' => __( 'Featured image settings', 'kemet-addons' ),
		),
		'blog-featured-image-width'      => array(
			'type'    => 'kmt-number',
			'label'   => __( 'Custom Width', 'kemet-addons' ),
			'min'     => 0,
			'step'    => 1,
			'max'     => 1200,
			'context' => array(
				array(
					'setting'  => 'blog-post-structure',
					'operator' => 'contain',
					'value'    => 'image',
				),
			),
		),
		'blog-featured-image-height'     => array(
			'type'    => 'kmt-number',
			'label'   => __( 'Custom Height', 'kemet-addons' ),
			'min'     => 0,
			'step'    => 1,
			'max'     => 1200,
			'context' => array(
				array(
					'setting'  => 'blog-post-structure',
					'operator' => 'contain',
					'value'    => 'image',
				),
			),
		),
		'kemet-blog-pagination-title'    => array(
			'type'  => 'kmt-title',
			'label' => __( 'Pagination Style', 'kemet-addons' ),
		),
		'blog-pagination-style'          => array(
			'type'    => 'kmt-select',
			'label'   => __( 'Pagination', 'kemet-addons' ),
			'choices' => array(
				'next-prev'       => __( 'Next/Prev', 'kemet-addons' ),
				'standard'        => __( 'Standard', 'kemet-addons' ),
				'infinite-scroll' => __( 'Infinite', 'kemet-addons' ),
			),
		),
		'blog-pagination-border-color'   => array(
			'type'      => 'kmt-color',
			'transport' => 'postMessage',
			'pickers'   => array(
				array(
					'id'    => 'initial',
					'title' => __( 'Initial', 'kemet-addons' ),
				),
			),
			'label'     => __( 'Pagination Border Color', 'kemet-addons' ),
			'preview'   => array(
				'initial' => array(
					'selector' => '.kmt-pagination.standard .nav-links > a',
					'property' => '--paginationBorderColor',
				),
			),
			'context'   => array(
				array(
					'setting' => 'blog-pagination-style',
					'value'   => 'standard',
				),
			),
		),
		'load-more-style'                => array(
			'type'    => 'kmt-select',
			'label'   => __( 'Load More Style', 'kemet-addons' ),
			'choices' => array(
				'dots'   => __( 'Dots', 'kemet-addons' ),
				'button' => __( 'Button', 'kemet-addons' ),
			),
			'context' => array(
				array(
					'setting' => 'blog-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
		'load-more-text'                 => array(
			'type'    => 'kmt-text',
			'label'   => __( 'Load More Text', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => 'blog-pagination-style',
					'value'   => 'infinite-scroll',
				),
				array(
					'setting' => 'load-more-style',
					'value'   => 'button',
				),
			),
		),
		'blog-infinite-loader-color'     => array(
			'type'      => 'kmt-color',
			'transport' => 'postMessage',
			'label'     => __( 'Infinite Scroll Loader Color', 'kemet-addons' ),
			'pickers'   => array(
				array(
					'id'    => 'initial',
					'title' => __( 'Initial', 'kemet-addons' ),
				),
			),
			'preview'   => array(
				'initial' => array(
					'selector' => '.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader',
					'property' => '--dotsColor',
				),
			),
			'context'   => array(
				array(
					'setting' => 'blog-pagination-style',
					'value'   => 'infinite-scroll',
				),
				array(
					'setting' => 'load-more-style',
					'value'   => 'dots',
				),
			),
		),
		'blog-infinite-scroll-last-text' => array(
			'type'    => 'kmt-text',
			'label'   => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
			'context' => array(
				array(
					'setting' => 'blog-pagination-style',
					'value'   => 'infinite-scroll',
				),
			),
		),
	);

	unset( $options['blog-controls-tabs']['tabs']['general']['options']['blog-kemet-addons-notification'] );
	unset( $options['blog-controls-tabs']['tabs']['general']['options']['blog-addon-notification'] );

	return array_merge( $options, $addon_options );
}

