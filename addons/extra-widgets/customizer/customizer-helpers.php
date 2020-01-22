<?php

/* 
 * To change the Dependents options for main options
 */

function kemet_widget_with_style_color() {
    
	if ( 'style2' == kemet_get_option( 'widgets-style' ) || 'style3' == kemet_get_option( 'widgets-style' ) || 'style4' == kemet_get_option( 'widgets-style' ) || 'style5' == kemet_get_option( 'widgets-style' ) || 'style6' == kemet_get_option( 'widgets-style' ) || 'style7' == kemet_get_option( 'widgets-style' ) || 'style8' == kemet_get_option( 'widgets-style' ) || 'style9' == kemet_get_option( 'widgets-style' )) {
		return true;
	} else {
		return false;
	}
}
function kemet_footer_widget_with_style_color() {
    
	if ( 'style2' == kemet_get_option( 'footer-widgets-style' ) || 'style3' == kemet_get_option( 'footer-widgets-style' ) || 'style4' == kemet_get_option( 'footer-widgets-style' ) || 'style5' == kemet_get_option( 'footer-widgets-style' ) || 'style6' == kemet_get_option( 'footer-widgets-style' ) || 'style7' == kemet_get_option( 'footer-widgets-style' ) || 'style8' == kemet_get_option( 'footer-widgets-style' ) || 'style9' == kemet_get_option( 'footer-widgets-style' )) {
		return true;
	} else {
		return false;
	}
}