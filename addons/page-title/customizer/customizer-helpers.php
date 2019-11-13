<?php

function kemet_page_title_layout1_style() {
    
	if ( 'page-title-layout-1' == kemet_get_option( 'page-title-layouts', '' ) ) {
		return true;
	} else {
		return false;
	}
}
if ( ! function_exists( 'kemet_enabled_breadcrumbs' ) ) {

	function kemet_enabled_breadcrumbs() {

		$return = true;

		if ( true != kemet_get_option( 'breadcrumbs-enabled', true ) ) {
			$return = false;
		}

		return apply_filters( 'kemet_display_breadcrumbs', $return );

	}
}
