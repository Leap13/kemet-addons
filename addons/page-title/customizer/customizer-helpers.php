<?php

function kemet_page_title_layout1_style() {
    
	if ( 'page-title-layout-1' == kemet_get_option( 'page-title-layouts', '' ) ) {
		return true;
	} else {
		return false;
	}
}
