<?php
/**
 * Top Bar Section - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_topbar_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Kemet Dynamic CSS.
 * @return string
 */
function kemet_topbar_dynamic_css( $dynamic_css ) {
            
            //Top Bar Header
            $topbar_spacing              = kemet_get_option( 'topbar-padding' );
            $topbar_bg_color             = kemet_get_option( 'topbar-bg-color' );
            $topbar_link_color         = kemet_get_option( 'topbar-link-color' );
			$topbar_link_h_color       = kemet_get_option( 'topbar-link-h-color' );
			$topbar_text_color         = kemet_get_option( 'topbar-text-color' );
			$topbar_border_color       = kemet_get_option( 'topbar-border-color' );
			$topbar_border_size        = kemet_get_option( 'topbar-border-size' );

			//Top Bar Header SubMenu
			$topbar_submenu_bg_color   = kemet_get_option( 'topbar-submenu-bg-color' );
			$topbar_submenu_items_color   = kemet_get_option( 'topbar-submenu-items-color' );
			$topbar_submenu_items_h_color   = kemet_get_option( 'topbar-submenu-items-h-color' );
			 
			$topbar_font_size                    = kemet_get_option( 'topbar-font-size' );
            
            $css_content = array(     

                // Top Bar Header   topbar-bg-color
                '.kemet-top-header' => array(
                   
                ),
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'desktop' ),  
                    'background-color' => esc_attr($topbar_bg_color),
                    'border-style' => 'solid',
					'border-bottom-color'     => esc_attr( $topbar_border_color),
				    //'border-bottom-width' => kemet_get_css_value( $topbar_border_bottom_size , 'px' ),
                    'border-top-width'    => kemet_responsive_spacing( $topbar_border_size, 'top', 'desktop' ),
                    'border-right-width'  => kemet_responsive_spacing( $topbar_border_size, 'right', 'desktop' ),
                    'border-bottom-width' => kemet_responsive_spacing( $topbar_border_size, 'bottom', 'desktop' ),
                    'border-left-width'   => kemet_responsive_spacing( $topbar_border_size, 'left', 'desktop' ), 
                    
					'font-size'    => kemet_responsive_font( $topbar_font_size, 'desktop' ),
					'color'          => esc_attr($topbar_text_color),
                ),
                '.kemet-top-header a'  => array(
					'color' => esc_attr( $topbar_link_color ),
				),

				'.kemet-top-header a:hover'  => array(
					'color' => esc_attr( $topbar_link_h_color ),
				),
				'.top-navigation ul.sub-menu'  => array(
					'background-color' => esc_attr( $topbar_submenu_bg_color),
				),
				'.top-navigation ul.sub-menu li a'  => array(
					'color' => esc_attr( $topbar_submenu_items_color),
				),
				'.top-navigation ul.sub-menu li:hover a'   => array(
					'color' => esc_attr( $topbar_submenu_items_h_color),
				),
                 
            );

            $parse_css = kemet_parse_css( $css_content );
            
            $css_tablet = array(
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'tablet' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            $css_mobile = array(
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'mobile' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}