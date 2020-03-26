<?php
/**
 * Woocommerce - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_woocommerce_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_woocommerce_dynamic_css( $dynamic_css ) {
            //General
            $cart_dropdown_width = kemet_get_option( 'cart-dropdown-width' );
            //Shop
            $sale_style      = kemet_get_option( 'sale-style' );
            
            //Single Product
            $image_width = kemet_get_option('product-image-width');
            $summary_width = kemet_get_option('product-summary-width');

            $css_content = array(
                '.woocommerce .product .onsale' => array(
                    'border-radius' => esc_attr( $sale_style ),
                ),
                '.woocommerce .site-header .kmt-site-header-cart .widget_shopping_cart, .woocommerce .site-header .kmt-site-header-cart .widget_shopping_cart' => array(
                    'width' => kemet_get_css_value( $cart_dropdown_width , 'px' ),
                ),
                '.woocommerce #content .kmt-woocommerce-container div.product div.images, .woocommerce .kmt-woocommerce-container div.product div.images, .woocommerce-page #content .kmt-woocommerce-container div.product div.images, .woocommerce-page .kmt-woocommerce-container div.product div.images' => array(
                    'width' => kemet_get_css_value( $image_width , '%' ),
                    'max-width' => kemet_get_css_value( $image_width , '%' ),
                ),
                '.woocommerce #content .kmt-woocommerce-container div.product div.summary, .woocommerce .kmt-woocommerce-container div.product div.summary, .woocommerce-page #content .kmt-woocommerce-container div.product div.summary, .woocommerce-page .kmt-woocommerce-container div.product div.summary' => array(
                    'width' => kemet_get_css_value( $summary_width , '%' ),
                    'max-width' => kemet_get_css_value( $summary_width , '%' ),
                ),
            );

            $parse_css = kemet_parse_css( $css_content );
            
            // $css_tablet = array(
            //  );
            // $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            // $css_mobile = array(
            //  );
            // $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}