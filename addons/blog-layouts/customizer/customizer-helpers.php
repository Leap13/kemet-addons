<?php

/* 
 * To change the Dependents options for main options
 */

function kemet_blog_has_grids() {
    
	if ( 'blog-layout-2' == kemet_get_option( 'blog-layouts') ) {
		return true;
	} else {
		return false;
	}
}
