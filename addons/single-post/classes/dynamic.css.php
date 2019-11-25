<?php
/**
 * Single Post - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_single_post_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_single_post_dynamic_css( $dynamic_css ) {
            
            $css_content = array(     
                // '.single .post-navigation .nav-links' => array(
				// 'display' => esc_attr($header_icon_bars_color),
                // ),
            );

            
            
            return $dynamic_css;
}