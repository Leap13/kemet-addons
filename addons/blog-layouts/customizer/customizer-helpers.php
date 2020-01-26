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
function kemet_blog_has_border() {
    
	if ( 'blog-layout-2' == kemet_get_option( 'blog-layouts') || 'blog-layout-4' == kemet_get_option( 'blog-layouts') ) {
		return true;
	} else {
		return false;
	}
}
function kemet_blog_has_title_meta_border() {
    
	if ('blog-layout-4' == kemet_get_option( 'blog-layouts') ) {
		return true;
	} else {
		return false;
	}
}
function kemet_blog_layout5() {
    
	if ('blog-layout-5' == kemet_get_option( 'blog-layouts') ) {
		return true;
	} else {
		return false;
	}
}
function kemet_blog_layout2() {
    
	if ('blog-layout-2' == kemet_get_option( 'blog-layouts') ) {
		return true;
	} else {
		return false;
	}
}