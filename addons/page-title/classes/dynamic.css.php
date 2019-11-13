<?php
/**
 * Page Title addon - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_page_title_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_ext_page_title_dynamic_css( $dynamic_css ) {
            $page_title_bg        = kemet_get_option( 'page-title-bg-obj' );
            $page_title_space        = kemet_get_option( 'page-title-space' );
            $page_title_color        = kemet_get_option( 'page-title-color' );
            $page_title_font_size        = kemet_get_option( 'page-title-font-size' );
            $page_title_font_family        = kemet_get_option( 'page-title-font-family' );
            $page_title_font_weight        = kemet_get_option( 'page-title-font-weight' );
            $page_title_font_transform        = kemet_get_option( 'pagetitle-text-transform' );
            $page_title_line_height        = kemet_get_option( 'pagetitle-line-height' );
            $Page_title_bottomline_height         = kemet_get_option( 'pagetitle-bottomline-height' );
            $Page_title_bottomline_color         = kemet_get_option( 'pagetitle-bottomline-color' );
            $Page_title_bottomline_width         = kemet_get_option( 'pagetitle-bottomline-width' );
            // Breadcrumbs
            $breadcrumbs_spacing              = kemet_get_option( 'breadcrumbs-space' );
            $breadcrumbs_color        = kemet_get_option( 'breadcrumbs-color' );
            $breadcrumbs_link_color        = kemet_get_option( 'breadcrumbs-link-color' );
            $breadcrumbs_link_h_color        = kemet_get_option( 'breadcrumbs-link-h-color' );
            
            $css_output = array(
               '.kmt-page-title-addon-content, .kemet-merged-header-title' => kemet_get_background_obj( $page_title_bg ),
               '.kmt-page-title-addon-content' => array(
                    'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'desktop' ), 
               ),
               '.kemet-page-title'  => array(
                   'color'  => esc_attr( $page_title_color ),
                   'font-family'    => kemet_get_css_value( $page_title_font_family, 'font' ),
                    'font-weight'    => kemet_get_css_value( $page_title_font_weight, 'font' ),
                    'font-size'      => kemet_responsive_font( $page_title_font_size, 'desktop' ),
                    'text-transform' => esc_attr( $page_title_font_transform ),
                    'line-height'     => esc_attr( $page_title_line_height),
               ),
               '.kemet-page-title::after' => array(
                   'background-color'  => esc_attr( $Page_title_bottomline_color ),
                   'height'  => kemet_get_css_value( $Page_title_bottomline_height, 'px' ),
                   'width'  => kemet_get_css_value( $Page_title_bottomline_width, 'px' ),
               ),
               '.kemet-breadcrumb-trail'  => array (
                    'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'desktop' ), 
               ),
               '.kemet-breadcrumb-trail span'  => array(
                   'color'  => esc_attr( $breadcrumbs_color ),
               ),
               '.kemet-breadcrumb-trail a span'  => array(
                   'color'  => esc_attr( $breadcrumbs_link_color ),
               ),
               '.kemet-breadcrumb-trail a:hover span'  => array(
                   'color'  => esc_attr( $breadcrumbs_link_h_color ),
               ),
 
            );

           $parse_css = kemet_parse_css( $css_output );
            
            $tablet_styles = array(
                '.kmt-page-title-addon-content' => array(
                    'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'tablet' ),              
                ),
                 '.kemet-page-title'  => array(
                    'font-size'      => kemet_responsive_font( $page_title_font_size, 'tablet' ),
                ),
                '.kemet-breadcrumb-trail'  => array (
                    'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'tablet' ), 
               ),
             );
            $parse_css .= kemet_parse_css( $tablet_styles, '', '768' );
            
            $mobile_styles = array(
                '.kmt-page-title-addon-content' => array(
                    'padding-top'    => kemet_responsive_spacing( $page_title_space, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $page_title_space, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $page_title_space, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $page_title_space, 'left', 'mobile' ),              
                ),
                 '.kemet-page-title'  => array(
                    'font-size'      => kemet_responsive_font( $page_title_font_size, 'mobile' ),
                ),
                '.kemet-breadcrumb-trail'  => array (
                    'padding-top'    => kemet_responsive_spacing( $breadcrumbs_spacing, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $breadcrumbs_spacing, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $breadcrumbs_spacing, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $breadcrumbs_spacing, 'left', 'mobile' ), 
               ),
             );
            $parse_css .= kemet_parse_css( $mobile_styles, '', '544' );
            
            return $dynamic_css . $parse_css;
}