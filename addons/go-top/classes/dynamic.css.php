<?php
/**
 * Page Title addon - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_go_top_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_ext_go_top_dynamic_css( $dynamic_css ) {
			// Go Top Link
			$go_top_icon_color             = kemet_get_option('go-top-icon-color');
			$go_top_icon_h_color           = kemet_get_option('go-top-icon-h-color');
			$go_top_icon_size              = kemet_get_option('go-top-icon-size');
			$go_top_bg_color               = kemet_get_option('go-top-bg-color');
			$go_top_bg_h_color             = kemet_get_option('go-top-bg-h-color');
			$go_top_border_radius          = kemet_get_option('go-top-border-radius');
			$go_top_button_size            = kemet_get_option('go-top-button-size');

            // Breadcrumbs
            $breadcrumbs_spacing              = kemet_get_option( 'breadcrumbs-space' );
            $breadcrumbs_color        = kemet_get_option( 'breadcrumbs-color' );
            $breadcrumbs_link_color        = kemet_get_option( 'breadcrumbs-link-color' );
            $breadcrumbs_link_h_color        = kemet_get_option( 'breadcrumbs-link-h-color' );
            
            $css_output = array(
                '.kmt-go-top-link' => array(
					'background-color' => esc_attr( $go_top_bg_color ),
					'border-radius'    => kemet_get_css_value( $go_top_border_radius, 'px' ),
					'width'            => kemet_get_css_value( $go_top_button_size,'px' ),
					'height'           => kemet_get_css_value( $go_top_button_size,'px' ),
					'line-height'      => kemet_get_css_value( $go_top_button_size,'px'),
					'color'            => esc_attr($go_top_icon_color),
					'font-size'        => kemet_responsive_font( $go_top_icon_size, 'desktop' ),
				),
				'.kmt-go-top-link:hover' => array(
					'color'            => esc_attr($go_top_icon_h_color),
					'background-color' => esc_attr($go_top_bg_h_color)
				),
 
            );

           $parse_css = kemet_parse_css( $css_output );
            
            $tablet_styles = array(
                '.kmt-go-top-link' => array(
                    'font-size'    => kemet_responsive_font( $go_top_icon_size, 'tablet' ),
                ),

             );
            $parse_css .= kemet_parse_css( $tablet_styles, '', '768' );
            
            $mobile_styles = array(
                '.kmt-go-top-link' => array(
                    'font-size'    => kemet_responsive_font( $go_top_icon_size, 'mobile' ),
                ),

             );
            $parse_css .= kemet_parse_css( $mobile_styles, '', '544' );
            
            return $dynamic_css . $parse_css;
}