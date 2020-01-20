<?php

/* 
 * To change the Dependents options for main options
 */
function kemet_has_sticky_header() {
    
	if ( kemet_get_option( 'enable-sticky' ) == true) {
		return true;
	} else {
		return false;
	}
}