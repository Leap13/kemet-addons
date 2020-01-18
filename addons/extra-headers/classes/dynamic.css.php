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
 * @param  string $dynamic_css
 * @return string
 */
function kemet_ext_headers_dynamic_css( $dynamic_css ) {
            $header_icon_bars_logo_bg_color         = kemet_get_option( 'header-icon-bars-logo-bg-color' );
            $header_icon_bars_color         = kemet_get_option( 'header-icon-bars-color' );
            $header_icon_bars_h_color       = kemet_get_option( 'header-icon-bars-h-color' );
            $header_icon_bars_bg_color      = kemet_get_option( 'header-icon-bars-bg-color' );
            $header_icon_bars_bg_h_color    = kemet_get_option( 'header-icon-bars-bg-h-color' );
            $header_icon_bars_borderradius  =  kemet_get_option( 'header-icon-bars-border-radius' );
            $space_icon_bars                = kemet_get_option( 'menu-icon-bars-space' );

            $vertical_header_width        = kemet_get_option( 'vertical-header-width' );
            $vertical_border_width         = kemet_get_option( 'header-main-sep' );
            $vheader_border_style         = kemet_get_option( 'vheader-border-style' );
            $vheader_border_color         = kemet_get_option( 'header-main-sep-color' );
            
            $mini_vheader_width         = kemet_get_option( 'mini-vheader-width' );

            //Header9
            $logo_icon_separator        = kemet_get_option( 'logo-icon-separator-color' );
            $css_content = array(     
                '.logo-menu-icon' => array(
					'background-color' => esc_attr($header_icon_bars_logo_bg_color),
                ),
                '.header-main-layout-9 .inline-logo-menu .site-branding:after' => array(
                    'background-color' => esc_attr($logo_icon_separator),
                ),
                '.site-header .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'desktop' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'desktop' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'desktop' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'desktop' ),              
                ),
                '.site-header .menu-icon-social .icon-bars-btn span' => array(
					'background-color' => esc_attr($header_icon_bars_color),
                ),
                '.site-header .icon-bars-btn:hover span,.site-header .open .icon-bars-btn span' => array(
					'background-color' => esc_attr($header_icon_bars_h_color),
                ),
                '.site-header .menu-icon-social .menu-icon' => array(
                    'background-color' => esc_attr($header_icon_bars_bg_color),
                    'border-radius'    => kemet_get_css_value( $header_icon_bars_borderradius, 'px' ),
                ),
                '.site-header .menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open' => array(
					'background-color' => esc_attr($header_icon_bars_bg_h_color),
                ),
                '.header-main-layout-6 .main-header-bar-wrap' => array(
                    'width' => kemet_get_css_value( $vertical_header_width, 'px' ),
                    'border-color' => esc_attr( $vheader_border_color ),
                ),
                '.header-main-layout-8 .main-header-bar-wrap' => array(
                    'width' => kemet_get_css_value( $mini_vheader_width, 'px' ),
                    'border-color' => esc_attr( $vheader_border_color ),
                ),
                '.kemet-main-v-header-align-right.header-main-layout-8' => array(
                    'padding-right' => kemet_get_css_value( $mini_vheader_width , 'px'),
                ),
                '.kemet-main-v-header-align-left.header-main-layout-8' => array(
                    'padding-left' => kemet_get_css_value( $mini_vheader_width , 'px'),
                ),
                '.kemet-main-v-header-align-right .main-header-bar-wrap' => array(
                    'border-left-style' => esc_attr( $vheader_border_style ),
                    'border-left-width' => kemet_responsive_slider( $vertical_border_width , 'desktop' ),
                ),
                '.kemet-main-v-header-align-left .main-header-bar-wrap' => array(
                    'border-right-style' => esc_attr( $vheader_border_style ),
                    'border-right-width' => kemet_responsive_slider( $vertical_border_width , 'desktop' ),
                ),
                '.kemet-main-v-header-align-right.header-main-layout-6' => array(
                    'padding-right' => kemet_get_css_value( $vertical_header_width , 'px'),
                ),
                '.kemet-main-v-header-align-left.header-main-layout-6' => array(
                    'padding-left' => kemet_get_css_value( $vertical_header_width , 'px'),
                ),     
            );

            $parse_css = kemet_parse_css( $css_content );
            
            $css_tablet = array(
                '.site-header .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'tablet' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'tablet' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'tablet' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'tablet' ),              
                ),
             );
           $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            $css_mobile = array(
                '.site-header .menu-icon-social' => array(
                    'margin-top'    => kemet_responsive_spacing( $space_icon_bars, 'top', 'mobile' ),
                    'margin-right'  => kemet_responsive_spacing( $space_icon_bars, 'right', 'mobile' ),
                    'margin-bottom' => kemet_responsive_spacing( $space_icon_bars, 'bottom', 'mobile' ),
                    'margin-left'   => kemet_responsive_spacing( $space_icon_bars, 'left', 'mobile' ),              
                ),
             );
           $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}