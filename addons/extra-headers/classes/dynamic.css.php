<?php
/**
 * Extra Headers - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_headers_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Kemet Dynamic CSS.
 * @return string
 */
function kemet_ext_headers_dynamic_css( $dynamic_css ) {
            $header_icon_bars_logo_bg_color         = kemet_get_option( 'header-icon-bars-logo-bg-color' );
            $header_icon_bars_color         = kemet_get_option( 'header-icon-bars-color' );
            $header_icon_bars_h_color       = kemet_get_option( 'header-icon-bars-h-color' );
            $header_icon_bars_bg_color     = kemet_get_option( 'header-icon-bars-bg-color' );
            $header_icon_bars_bg_h_color    = kemet_get_option( 'header-icon-bars-bg-h-color' );
            $header_icon_bars_borderradius =  kemet_get_option( 'header-icon-bars-border-radius' );
            $space_icon_bars              = kemet_get_option( 'menu-icon-bars-space' );

            $header6_width               = kemet_get_option( 'header6-width' );
            $header6_border_width        = kemet_get_option( 'header6-border-width' );
            $header6_border_style        = kemet_get_option( 'header6-border-style' );
            $header6_border_color        = kemet_get_option( 'header6-border-color' );
            
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
            
            $css_output = array(     
                '.main-header-container.logo-menu-icon' => array(
					'background-color' => esc_attr($header_icon_bars_logo_bg_color),
                ),
                '.main-header-container.logo-menu-icon .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'desktop' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'desktop' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'desktop' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'desktop' ),              
                ),
                '.icon-bars-btn span' => array(
					'background-color' => esc_attr($header_icon_bars_color),
                ),
                '.icon-bars-btn:hover span, .open .icon-bars-btn span' => array(
					'background-color' => esc_attr($header_icon_bars_h_color),
                ),
                '.menu-icon-social .menu-icon' => array(
                    'background-color' => esc_attr($header_icon_bars_bg_color),
                    'border-radius'    => kemet_get_css_value( $header_icon_bars_borderradius, 'px' ),
                ),
                '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open' => array(
					'background-color' => esc_attr($header_icon_bars_bg_h_color),
                ),
                '.site-header.header-main-layout-6' => array(
                    'width' => kemet_get_css_value( $header6_width, 'px' ),
                    'border-color' => esc_attr( $header6_border_color ),
                ),
                '.kemet-addons-header6-right .site-header.header-main-layout-6,.kemet-addons-header7-right #sitehead.header-main-layout-7' => array(
                    'border-left-style' => esc_attr( $header6_border_style ),
                    'border-left-width' => kemet_get_css_value( $header6_border_width , 'px' ),
                ),
                '.kemet-addons-header6-left .site-header.header-main-layout-6,.kemet-addons-header7-left #sitehead.header-main-layout-7' => array(
                    'border-right-style' => esc_attr( $header6_border_style ),
                    'border-right-width' => kemet_get_css_value( $header6_border_width , 'px' ),
                ),
                'body.kemet-addons-header6-right' => array(
                    'padding-right' => kemet_get_css_value( $header6_width , 'px'),
                ),
                'body.kemet-addons-header6-left' => array(
                    'padding-left' => kemet_get_css_value( $header6_width , 'px'),
                ),
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

            $parse_css = kemet_parse_css( $css_output );
            
            $tablet_styles = array(
                '.main-header-container.logo-menu-icon .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'tablet' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'tablet' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'tablet' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'tablet' ),              
                ),
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'tablet' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $tablet_styles, '', '768' );
            
            $mobile_styles = array(
                '.main-header-container.logo-menu-icon .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'mobile' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'mobile' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'mobile' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'mobile' ),              
                ),
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'mobile' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $mobile_styles, '', '544' );
            
            /**
            * Top Bar Header Spacing
            */
           //kemet_responsive_spacing( 'kemet-settings[topbar-padding]','.kemet-top-header ', 'padding', [ 'top', 'bottom', 'right', 'left' ] );

            return $dynamic_css . $parse_css;
}