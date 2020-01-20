<?php
/**
 * Extra Widgets - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_widgets_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_ext_widgets_dynamic_css( $dynamic_css ) {
            $widget_style_color         = kemet_get_option( 'kemet-widget-style-color' );

            $css_content = array(     
                '.kmt-widget-style2 .widget-head ,.kmt-widget-style3 .widget-title ,.kmt-widget-style4 .widget-content,.kmt-widget-style5 .widget-content ,.kmt-widget-style7 .widget-head,.kmt-widget-style8 div.title .widget-title ,.kmt-widget-style8 div.title .widget-title:before' => array(
					'border-bottom-color' => esc_attr( $widget_style_color ),
				),
				'.kmt-widget-style2 .widget-title ,.kmt-widget-style5 .widget-head ,.kmt-widget-style6 .widget-head,.kmt-widget-style9 .widget ,.kmt-widget-style10 div.title .widget-title:after' => array(
					'background-color' => esc_attr( $widget_style_color ),
				),
				'.kmt-widget-style1 .widget-title,.kmt-widget-style3 .widget-title ,.kmt-widget-style4 .widget-title ,.kmt-widget-style7 .widget-title ,.kmt-widget-style8 .widget-title , .kmt-widget-style10 div.title .widget-title' => array(
					'color' => esc_attr( $widget_style_color ),
				),
            );

            $parse_css = kemet_parse_css( $css_content );
                        
            return $dynamic_css . $parse_css;
}