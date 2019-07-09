<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Minify' ) ) {
    
    class Kemet_Minify{
    /**
		 * A flag for whether or not we're in a Customizer
		 * preview or not.
		 *
		 * @since 1.0
		 * @access private
		 * @var bool $_in_customizer_preview
		 */
		static private $_in_customizer_preview = false;
        
        /**
		 * Additional CSS to enqueue.
		 *
		 * @since 1.0
		 * @var array $css
		 */
		static private $css_files = array();
        
        /**
		 * Additional JS to enqueue.
		 *
		 * @since 1.0
		 * @var array $js
		 */
		static private $js_files = array();
        
        /**
		 * Instance
		 *
		 * @since 1.6.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;
        
        /**
		 * Initiator
		 *
		 * @since 1.6.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
        
        function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts'));
        }
        
        public static function merge_all_scripts() {
            //$css_url = self::get_css_url();
           // if ( fales != $css_url ) {
                wp_enqueue_style( 'kemet-addon-css', KEMET_ADDONS_URL . 'merged-style.css', array(), KEMET_ADDONS_VERSION, 'all');
          //  }
        }
        
        public static function add_css( $src = null, $handle = false ) {
            if ( false != $handle ) {
                self::$css_files[ $handle ] = $src;
            } else {
                self::$css_files[] = $src;
            }
        }
        
        public static function get_http2_css_files() {

            // Get the css key.
            $css_slug  = self::_asset_slug();
            $css_files = get_option( self::$_css_key . "-files-" . $css_slug, array() );

            // No css files, recompile the files.
            if ( ! $css_files ) {
                self::render_http2_css();
                return self::get_http2_css_files();
            }

            // Return the url.
            return $css_files;
        }
        
        /**
         * Returns the prefix slug for the CSS cache file.
         *
         * @since 1.0
         * @access private
         * @return string
         */
        private static function _asset_slug() {
            if ( self::is_customizer_preview() ) {
                $slug = "kmt-customizer";
            } else {
                $slug = "kemet-addon";
            }

            return $slug;
        }
        
        private static function enqueue_http2_css() {

            $css_files   = self::get_http2_css_files();
            $files_count = count( $css_files );

            if ( $files_count > 0 ) {

                foreach ( $css_files as $k => $file ) {

                    if ( $files_count == $k + 1 ) {
                        $handle = "kemet-addon-css";
                    } else {
                        $handle = "kemet-addon-css-" . $k;
                    }

                    wp_enqueue_style(
                        $handle,
                        $file,
                        array(),
                        KEMET_ADDONS_VERSION,
                        "all"
                    );
                }
            }
        }
}
    Kemet_Minify::get_instance();
}