<?php
/**
 * Mega Menu - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_mega_menu_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_mega_menu_dynamic_css( $dynamic_css ) {
    
    $theme_color      = kemet_get_option( 'theme-color' );
    $global_border_color      = kemet_get_option( 'global-border-color' );
    $global_bg_color      = kemet_get_option( 'global-background-color' );
    $text_meta_color      = kemet_get_option( 'text-meta-color' );
    $submenu_has_boxshadow = kemet_get_option( 'submenu-box-shadow' );
    $submenu_top_border_size       = kemet_get_option( 'submenu-top-border-size' );
    $submenu_top_border_color       = kemet_get_option( 'submenu-top-border-color' , $global_border_color);
    $submenu_bg_color               = kemet_get_option( 'submenu-bg-color' , kemet_color_brightness($global_bg_color , 0.99 , 'dark') );
    $submenu_font_size					= kemet_get_option( 'submenu-font-size' );
    
    $css_content = array( 
        'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item .mega-menu-full-wrap' => array(
            'background-color' => esc_attr( $submenu_bg_color),
            'border-top-width' => kemet_get_css_value( $submenu_top_border_size, 'px' ),
            'border-top-color' => esc_attr( $submenu_top_border_color ),
        ),
        '.main-navigation .kemet-megamenu .heading-item>a'  => array(
            'font-size'	 	=> kemet_responsive_slider( $submenu_font_size , 'desktop' ),
        ),
    );

    $parse_css = kemet_parse_css( $css_content );
    
    $css_tablet = array(
        '.main-navigation .kemet-megamenu .heading-item>a'  => array(
            'font-size'	 	=> kemet_responsive_slider( $submenu_font_size , 'tablet' ),
        ), 
        );
    $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
    
    $css_mobile = array(
        '.main-navigation .kemet-megamenu .heading-item>a'  => array(
            'font-size'	 	=> kemet_responsive_slider( $submenu_font_size , 'mobile' ),
        ), 
        );

    $parse_css .= kemet_parse_css( $css_mobile, '', '544' );

    if($submenu_has_boxshadow){
        $boxshadow = array( 
            'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item div.mega-menu-full-wrap' => array(
                '-webkit-box-shadow' => esc_attr('0 3px 13px 0 rgba(0,0,0,.2)'),
                'box-shadow' => esc_attr('0 3px 13px 0 rgba(0,0,0,.2)'),
            ),
        );

        $parse_css .= kemet_parse_css( $boxshadow );
    }

    return $dynamic_css . $parse_css;
}