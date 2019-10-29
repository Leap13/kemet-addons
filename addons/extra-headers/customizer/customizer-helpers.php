<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
