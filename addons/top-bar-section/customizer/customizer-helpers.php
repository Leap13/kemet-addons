<?php

function kemet_top_bar_has_content_style() {
    
	if ( kemet_get_top_section( 'top-section-1' ) != '' || kemet_get_top_section( 'top-section-2' ) != '') {
		return true;
	} else {
		return false;
	}
}
