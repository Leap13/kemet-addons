<?php

/* 
 * To change the Dependents options for main options
 */

function kemet_header_withicon_layout_style() {
    
	if ( 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' )  || 'header-main-layout-7' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-8' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-9' == kemet_get_option( 'header-layouts', 'wide' )) {
		return true;
	} else {
		return false;
	}
}
function kemet_header_has_icon_label(){
	if ( 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' )  || 'header-main-layout-7' == kemet_get_option( 'header-layouts', 'wide' )) {
		return true;
	} else {
		return false;
	}
}
function kemet_header_transparent(){
	if ( 'header-main-layout-1' == kemet_get_option( 'header-layouts', 'wide' )  || 'header-main-layout-2' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-3' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-4' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-9' == kemet_get_option( 'header-layouts', 'wide' )) {
		return true;
	} else {
		return false;
	}
}
function kemet_headers_with_content_width(){
	if ( 'header-main-layout-1' == kemet_get_option( 'header-layouts', 'wide' )  || 'header-main-layout-2' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-3' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-4' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-9' == kemet_get_option( 'header-layouts', 'wide' )) {
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
function kemet_header_layout9_style() {
    
	if ( 'header-main-layout-9' == kemet_get_option( 'header-layouts', 'wide' ) ) {
		return true;
	} else {
		return false;
	}
}
function kemet_header_layout8_style() {
    
	if ( 'header-main-layout-8' == kemet_get_option( 'header-layouts', 'wide' ) ) {
		return true;
	} else {
		return false;
	}
}
function has_menu_icon_bg_color(){
	if ( 'header-main-layout-5' == kemet_get_option( 'header-layouts', 'wide' )) {
		return true;
	} else {
		return false;
	}
}
function kemet_header_layout_vertical_style() {
    
	if ( 'header-main-layout-8' == kemet_get_option( 'header-layouts', 'wide' ) || 'header-main-layout-6' == kemet_get_option( 'header-layouts', 'wide' )) {
		return true;
	} else {
		return false;
	}
}