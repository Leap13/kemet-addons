<?php

/* 
 * To change the Dependents options for main options
 */

function kemet_header_withicon_layout_style() {
    
	if ( 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' ) ) {
		return true;
	} else {
		return false;
	}
}

function kemet_header_layout6_style() {
    
	if ( 'header-main-layout-6' == kemet_get_option( 'header-layouts', 'wide' ) ) {
		return true;
	} else {
		return false;
	}
}
