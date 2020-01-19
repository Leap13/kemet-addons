<?php

/* 
 * To change the Dependents options for main options
 */

function kemet_top_bar_section1_has_html() {
    
	if ( in_array('text-html' , (array)kemet_get_option('top-section-1')) ) {
		return true;
	} else {
		return false;
	}
}

function kemet_top_bar_section2_has_html() {
    
	if ( in_array('text-html' , (array)kemet_get_option('top-section-2')) ) {
		return true;
	} else {
		return false;
	}
}