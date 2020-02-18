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
            //Defaults Colors
            $theme_color      = kemet_get_option( 'theme-color' );
            $global_border_color      = kemet_get_option( 'global-border-color' );
            $btn_bg_color       = kemet_get_option( 'button-bg-color', $theme_color );
            $btn_text_color = kemet_get_option( 'button-color' );
			if ( empty( $btn_text_color ) ) {
				$btn_text_color = kemet_get_foreground_color( $theme_color );
            }
            $btn_text_hover_color = kemet_get_option( 'button-h-color' );
            $btn_bg_hover_color = kemet_get_option( 'button-bg-h-color' );
            $btn_border_radius      = kemet_get_option( 'button-radius' );
            //Icon
            $header_icon_bars_logo_bg_color         = kemet_get_option( 'header-icon-bars-logo-bg-color' );
            $header_icon_bars_color         = kemet_get_option( 'header-icon-bars-color' , $btn_text_color);
            $header_icon_bars_h_color       = kemet_get_option( 'header-icon-bars-h-color' ,$btn_text_hover_color);
            $header_icon_bars_bg_color      = kemet_get_option( 'header-icon-bars-bg-color' , $btn_bg_color);
            $header_icon_bars_bg_h_color    = kemet_get_option( 'header-icon-bars-bg-h-color' ,$btn_bg_hover_color);
            $header_icon_bars_borderradius  =  kemet_get_option( 'header-icon-bars-border-radius' );
            $space_icon_bars                = kemet_get_option( 'menu-icon-bars-space' );
            $icon_label_color              = kemet_get_option( 'header-icon-label-color' );
            $icon_label_hover_color        = kemet_get_option( 'header-icon-label-hover-color' );
            $vertical_header_width        = kemet_get_option( 'vertical-header-width' );
            $vertical_border_width         = kemet_get_option( 'header-main-sep' );
            $vheader_border_style         = kemet_get_option( 'vheader-border-style' );
            $vheader_border_color         = kemet_get_option( 'header-main-sep-color' , $global_border_color);
            
            $mini_vheader_width         = kemet_get_option( 'mini-vheader-width' );

            //Header8
            $logo_icon_separator        = kemet_get_option( 'logo-icon-separator-color' , $global_border_color);
            $css_content = array(
                '.site-header .menu-icon' => array(
					'border-radius'    => kemet_responsive_slider( $btn_border_radius, 'desktop' ),
				), 
                '.menu-icon-social .header-icon-label' => array(
                    'color' => esc_attr($icon_label_color),
                ), 
                '.menu-icon-social .header-icon-label:hover' => array(
                    'color' => esc_attr($icon_label_hover_color),
                ),   
                '.logo-menu-icon' => array(
					'background-color' => esc_attr($header_icon_bars_logo_bg_color),
                ),
                '.header-main-layout-8 .inline-logo-menu .site-branding:after' => array(
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
                '.site-header .menu-icon-social .menu-icon:hover span,.site-header .open .icon-bars-btn span' => array(
					'background-color' => esc_attr($header_icon_bars_h_color),
                ),
                '.site-header .menu-icon-social .menu-icon' => array(
                    'background-color' => esc_attr($header_icon_bars_bg_color),
                    'border-radius'    => kemet_get_css_value( $header_icon_bars_borderradius, 'px' ),
                ),
                '.site-header .menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open' => array(
					'background-color' => esc_attr($header_icon_bars_bg_h_color),
                ),
                '.header-main-layout-5 .main-header-bar-wrap' => array(
                    'width' => kemet_get_css_value( $vertical_header_width, 'px' ),
                    'border-color' => esc_attr( $vheader_border_color ),
                ),
                '.header-main-layout-7 .main-header-bar-wrap' => array(
                    'width' => kemet_get_css_value( $mini_vheader_width, 'px' ),
                    'border-color' => esc_attr( $vheader_border_color ),
                ),
                '.kemet-main-v-header-align-right.header-main-layout-7' => array(
                    'padding-right' => kemet_get_css_value( $mini_vheader_width , 'px'),
                ),
                '.kemet-main-v-header-align-left.header-main-layout-7' => array(
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
                '.kemet-main-v-header-align-right.header-main-layout-5' => array(
                    'padding-right' => kemet_get_css_value( $vertical_header_width , 'px'),
                ),
                '.kemet-main-v-header-align-left.header-main-layout-5' => array(
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