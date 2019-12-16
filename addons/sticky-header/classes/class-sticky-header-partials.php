<?php
/**
* Sticky Header Partials
*
* @package Kemet Addons
*/
if ( ! class_exists( 'Kemet_Sticky_Header_Partials' ) ) {
    class Kemet_Sticky_Header_Partials {
        private static $instance;
        /**
        * Initiator
        */

        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
        *  Constructor
        */

        public function __construct() {
            //add_filter( 'kemet_has_custom_logo', '__return_true' );
            add_action ( 'kemet_header', array( $this, 'sticky_header_logo' ), 1 );
            add_action( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
        }

        function sticky_header_logo() {
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo          = kemet_get_option( 'sticky-logo' );
            if ( '' !== $sticky_logo && '1' == $enabled_sticky ) {
                // Logo For None Effect.
                add_filter( 'kemet_has_custom_logo', '__return_true' );
                add_filter( 'get_custom_logo', array( $this, 'kemet_sticky_header_logo' ), 10, 2 );
            }
        }

        function kemet_sticky_header_logo( $html ) {
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo          = kemet_get_option( 'sticky-logo' );

            if ( '' !== $sticky_logo && '1' == $enabled_sticky ) {

                add_filter( 'wp_get_attachment_image_attributes', array( $this, 'replace_sticky_header_attr' ), 10, 3 );
                $custom_logo_id = attachment_url_to_postid( $sticky_logo );
                $size = 'full';
                $html = sprintf(
                    '<a href="%1$s" class="custom-logo-link sticky-custom-logo" rel="home" itemprop="url">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    wp_get_attachment_image(
                        $custom_logo_id,
                        $size,
                        false,
                        array(
                            'class' => 'custom-logo',
                        )
                    )
                );
                $html .= sprintf(
                    '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    wp_get_attachment_image(
                        get_theme_mod( 'custom_logo' ),
                        $size,
                        false,
                        array(
                            'class' => 'custom-logo',
                        )
                    )
                );
            }
            return $html;
        }

        function replace_sticky_header_attr( $attr, $attachment, $size ) {
            $sticky_logo          = kemet_get_option( 'sticky-logo' );
            $custom_logo_id = attachment_url_to_postid( $sticky_logo );
            if ( $custom_logo_id == $attachment->ID ) {
                $attach_data = array();
                if ( ! is_customize_preview() ) {
                    $attach_data = wp_get_attachment_image_src( $attachment->ID, 'full' );
                    if ( isset( $attach_data[0] ) ) {
                        $attr['src'] = $attach_data[0];
                    }
                }

                $attr['srcset'] = '';

                if ( '' !== $sticky_logo ) {
                    $cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    $cutom_logo_url = $cutom_logo[0];
                    $attr['srcset'] = $cutom_logo_url;
                }
                $attr['srcset'] = $cutom_logo_url;
            }
            return $attr;
        }

        public function header_classes( $classes ) {
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo              = kemet_get_option( 'sticky-logo' );
            $kemet_header_layout = kemet_get_option( 'header-layouts' );
            $sticky_responsive        = kemet_get_option( 'sticky-responsive' );
            if ( $enabled_sticky && 'header-main-layout-6' != $kemet_header_layout && 'header-main-layout-8' != $kemet_header_layout ) {
                $classes[] = 'kmt-sticky-header';
                $classes[] =  $sticky_responsive;
                if ( '' !== $sticky_logo ) {
                    $classes[] = 'kmt-sticky-logo';
                }
            }
            return $classes;
            echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
        }

        public function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_STICKY_HEADER_DIR.'assets/css/minified/style.min.css' );
        }

        public function add_scripts() {
            Kemet_Style_Generator::kmt_add_js( KEMET_STICKY_HEADER_DIR.'assets/js/minified/sticky-header.min.js' );
        }
    }
}
Kemet_Sticky_Header_Partials::get_instance();