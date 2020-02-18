<?php
/**
 * Sticky Header - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_sticky_header_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_sticky_header_dynamic_css( $dynamic_css ) {
			$b1_color						  = kemet_get_option( 'b1-color' );
			$sticky_bg_obj                    = kemet_get_option( 'sticky-bg-obj' , array('background-color' => kemet_color_brightness($b1_color , 0.99 , 'dark')) );
			$sticky_logo_width                = kemet_get_option( 'sticky-logo-width' );
			$sticky_menu_link_color           = kemet_get_option('sticky-menu-link-color');
			$sticky_menu_link_h_color           = kemet_get_option('sticky-menu-link-h-color');
			$sticky_submenu_bg_color             = kemet_get_option( 'sticky-submenu-bg-color' );
			$sticky_submenu_link_color             = kemet_get_option( 'sticky-submenu-link-color' );
			$sticky_submenu_link_h_color             = kemet_get_option( 'sticky-submenu-link-h-color' ); 
			$sticky_border_bottom_color 	  = kemet_get_option('sticky-border-bottom-color');	   
			$submenu_border_color			  = kemet_get_option('sticky-submenu-border-color');

			$css_output = array(
            //Sticky Header
				'.site-header.kmt-is-sticky .main-header-bar' => kemet_get_background_obj( $sticky_bg_obj ),
				'.kmt-is-sticky .main-header-menu a' => array(
					'color' => esc_attr($sticky_menu_link_color),
				),
				'.kmt-is-sticky .main-header-menu li:hover a,.kmt-is-sticky .main-header-menu li.current_page_item a' => array(
					'color' => esc_attr($sticky_menu_link_h_color),
				),
				'.kmt-is-sticky .main-header-menu .sub-menu li a' => array(
					'color'               => esc_attr($sticky_submenu_link_color),
				),
				'.kmt-is-sticky .main-header-menu .sub-menu li:hover > a' => array(
					'color' => esc_attr($sticky_submenu_link_h_color)
				),
				'.kmt-is-sticky .main-header-menu ul.sub-menu' => array(
					'background-color' => esc_attr( $sticky_submenu_bg_color),
				),
				'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
					'max-width' => kemet_responsive_slider( $sticky_logo_width, 'desktop' ),
				),
				'.kmt-is-sticky .main-header-bar' => array(
					'border-bottom-color' => esc_attr( $sticky_border_bottom_color),
				),
				'.kmt-is-sticky .main-header-menu .sub-menu a' => array(
					'border-bottom-color'        => esc_attr( $submenu_border_color ),
				),
			);

			$parse_css = kemet_parse_css( $css_output );

			$css_tablet = array(
				'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
					'max-width' => kemet_responsive_slider( $sticky_logo_width, 'tablet' ),
				),
			 );
			$parse_css .= kemet_parse_css( $css_tablet, '', '768' );
			
			$css_mobile = array(
				'#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img' => array(
					'max-width' => kemet_responsive_slider( $sticky_logo_width, 'mobile' ),
				),
			);

			$parse_css .= kemet_parse_css( $css_mobile, '', '544' );
           
            
           return $dynamic_css . $parse_css;
}