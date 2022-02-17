<?php
/**
 * Server-side rendering of the `kemet/breadcrumbs` block.
 *
 * @package WordPress
 */

require_once KEMET_EXTRA_BLOCKS_DIR . 'breadcrumbs/class-kemet-breadcrumb-trail.php';

/**
 * Renders the `kemet/breadcrumbs` block on the server.
 *
 * @param array $attributes The block attributes.
 *
 * @return string The render.
 */
function render_block_kemet_breadcrumbs( $attributes ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null );
	if ( ! is_object( $breadcrumb ) ) {
		$breadcrumb = new Kemet_Breadcrumb_Trail();
	}
	$align_class_name   = empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $align_class_name ) );

	return sprintf(
		'<div %1$s>%2$s</div>',
		$wrapper_attributes,
		// already pre-escaped if it is a link.
		$breadcrumb->get_trail()
	);
}

/**
 * Registers the `kemet/breadcrumbs` block on the server.
 */
function register_block_kemet_breadcrumbs() {
	register_block_type_from_metadata(
		KEMET_EXTRA_BLOCKS_DIR . '/breadcrumbs',
		array(
			'render_callback' => 'render_block_kemet_breadcrumbs',
		)
	);
}
add_action( 'init', 'register_block_kemet_breadcrumbs' );
