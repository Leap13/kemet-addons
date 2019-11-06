<?php
function kemet_has_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return true;
	} else {
		return kemet_get_option( 'kemet_has_breadcrumbs', true );
	}
}

// if ( ! function_exists( 'kemet_has_breadcrumbs' ) ) {

// 	function kemet_has_breadcrumbs() {

// 		// Return true by default
// 		$return = true;

// 		// Return false if disabled via Customizer
// 		if ( true != kemet_get_option( 'kemet_has_breadcrumbs', true ) ) {
// 			$return = false;
// 		}

// 		// Apply filters and return
// 		return apply_filters( 'kemet_display_breadcrumbs', $return );

// 	}

// }