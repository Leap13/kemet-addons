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
            );

            $parse_css = kemet_parse_css( $css_output );
            
            $tablet_styles = array(
                '.main-header-container.logo-menu-icon .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'tablet' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'tablet' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'tablet' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'tablet' ),              
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
             );
           $parse_css .= kemet_parse_css( $mobile_styles, '', '544' );
            
            return $dynamic_css . $parse_css;
}