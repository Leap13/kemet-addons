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
            add_action ( 'kemet_header', array( $this, 'sticky_header_logo' ), 1 );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_filter( 'kemet_addons_js_localize', array( $this, 'localize_variables' ) );
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

        public function add_styles() {

            $css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}
			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
            Kemet_Style_Generator::kmt_add_css( KEMET_STICKY_HEADER_DIR.'assets/css/'. $dir  .'/style' . $css_prefix);
        }

        public function enqueue_scripts() {

            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}
            wp_enqueue_script( 'kemet-addon-js', KEMET_STICKY_HEADER_URL.'assets/js/'. $dir  .'/sticky-header' . $js_prefix,array(), KEMET_ADDONS_VERSION, true );
			wp_localize_script( 'kemet-addon-js', 'kemetAddons', apply_filters( 'kemet_addons_js_localize', array() ) );
        }
        /**
		 * Add Localize variables
		 */
		public function localize_variables( $localize_vars ) {

            $localize_vars['enable_sticky_header'] = apply_filters('kemet_disable_sticky_header' , kemet_get_option( 'enable-sticky' ));
            $localize_vars['sticky_responsive'] = kemet_get_option( 'sticky-responsive' );
            $localize_vars['enable_sticky_top_bar'] = kemet_get_option( 'sticky-top-bar' );
            $localize_vars['site_content_layout'] = kemet_get_option( 'site-content-layout' );
            $localize_vars['sticky_style'] = kemet_get_option( 'sticky-style' );
            $localize_vars['sticky_logo_width'] = kemet_get_option( 'sticky-logo-width' );
            $localize_vars['site_content_width'] = kemet_get_option( 'site-content-width' );
            $localize_vars['display_responsive_menu_point'] = kemet_get_option( 'display-responsive-menu-point' );
            $localize_vars['kemet_primary_header_layout']= apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
            $localize_vars['sticky_logo'] = kemet_get_option( 'sticky-logo' );

			return $localize_vars;
		}
    }
}
Kemet_Sticky_Header_Partials::get_instance();