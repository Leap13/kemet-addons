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
            $widget_style_color         = kemet_get_option( 'widget-style-color' );
            $footer_widget_style_color         = kemet_get_option( 'footer-widget-style-color' );
            $css_content = array(     
                '.kmt-widget-style3 .widget-content,.kmt-widget-style6 div.title .widget-title,.kmt-widget-style6 div.title .widget-title:before' => array(
					'border-bottom-color' => esc_attr( $widget_style_color ),
                ),
                '.kmt-widget-style3 .widget-content , .kmt-widget-style5.widget' => array(
					'border-color' => esc_attr( $widget_style_color ),
				),
				'.kmt-widget-style2 .widget-title ,.kmt-widget-style4 .widget-head ,.kmt-widget-style7 div.title .widget-title:after' => array(
					'background-color' => esc_attr( $widget_style_color ),
                ),
                '.kemet-footer .kmt-widget-style3 .widget-content,.kemet-footer .kmt-widget-style6 div.title .widget-title,.kemet-footer .kmt-widget-style6 div.title .widget-title:before  ,.kmt-footer-copyright .kmt-widget-style3 .widget-content,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title:before' => array(
					'border-bottom-color' => esc_attr( $footer_widget_style_color ),
                ),
                '.kemet-footer .kmt-widget-style3 .widget-content ,.kemet-footer .kmt-widget-style5.widget , .kmt-footer-copyright .kmt-widget-style3 .widget-content ,.kmt-footer-copyright .kmt-widget-style5.widget' => array(
					'border-color' => esc_attr( $footer_widget_style_color ),
				),
				'.kemet-footer .kmt-widget-style2 .widget-title ,.kemet-footer .kmt-widget-style4 .widget-head  .widget-head,.kemet-footer .kmt-widget-style7 div.title .widget-title:after ,  .kmt-footer-copyright .kmt-widget-style2 .widget-title ,.kmt-footer-copyright .kmt-widget-style4 .widget-head ,.kmt-footer-copyright .kmt-widget-style7 div.title .widget-title:after' => array(
					'background-color' => esc_attr( $footer_widget_style_color ),
				),
            );

            $parse_css = kemet_parse_css( $css_content );
                        
            return $dynamic_css . $parse_css;
}