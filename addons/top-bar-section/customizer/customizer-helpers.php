<?php

function kemet_top_bar_has_content_style() {
	$top_bar_section1 = kemet_get_option( 'top-section-1');
	$top_bar_section2 = kemet_get_option( 'top-section-2');
	if ( !empty($top_bar_section1) || !empty($top_bar_section2)) {
		return true;
	} else {
		return false;
	}
}
