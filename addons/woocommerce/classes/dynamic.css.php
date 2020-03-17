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

            $sale_style      = kemet_get_option( 'sale-style' );


            $css_content = array(
                '.woocommerce ul.products li.product .onsale' => array(
                    'border-radius' => esc_attr( $sale_style ),
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