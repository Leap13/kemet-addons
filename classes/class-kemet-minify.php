<?php
/**
 * Minify Loader Class
 *
 * @package     Kemet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Minify' ) ) {

	/**
	 * Kemet_Minify
	 */
	class Kemet_Minify {

		static private $js_files = array();

		static private $css_files = array();

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts'));
		}
		public function merge_all_scripts() 
		{
			$css_files = self::get_css_files();
			$js_files  = self::get_js_files();
			$merged_js_file_location =  KEMET_ADDONS_DIR.'merged-script.js';
			
			$merged_script	= '';
			$merged_css_file_location = KEMET_ADDONS_DIR.'merged-style.css';
			$merged_style	= '';
		
			foreach( $js_files as $handle) 
			{	
				$js_file_path = $handle;
				$merged_script .=  file_get_contents($js_file_path) .';' ;
				
				
			}
			
			foreach( $css_files as $handle) 
			{	
				$css_file_path = $handle;
				$merged_style .=  file_get_contents($css_file_path)."\n";
			}

			file_put_contents ( $merged_js_file_location , $merged_script);
			file_put_contents ( $merged_css_file_location , $merged_style);

			wp_enqueue_script('merged-script', KEMET_ADDONS_URL . 'merged-script.js', array('jquery'), '1.0.0', true );
			wp_enqueue_style('merged-style-css', KEMET_ADDONS_URL . 'merged-style.css');
			wp_add_inline_style( 'merged-style-css', apply_filters( 'kemet_dynamic_css', '' ) );
			
		}

		static public function get_css_files() {

			if ( 1 > count( self::$css_files ) ) {
				do_action( 'kemet_get_css_files' );		
			}

			return apply_filters( 'kemet_kmt_add_css_file', self::$css_files );
		}

		static public function get_js_files() {

			if ( 1 > count( self::$js_files ) ) {
				do_action( 'kemet_get_js_files' );
				
			}
			return apply_filters( 'kemet_kmt_add_js_file', self::$js_files );
		}

		/**
		 * Render HTTP/2 CSS : enqueue individual CSS file.
		 *
		 * @since 1.0
		 * @access private
		 * @return void
		 */
		private static function enqueue_http2_css() {

			$css_files   = self::get_http2_css_files();
			$files_count = count( $css_files );

			if ( $files_count > 0 ) {

				foreach ( $css_files as $k => $file ) {

					if ( $files_count == $k + 1 ) {
						$handle = 'kemet-addon-css';
					} else {
						$handle = 'kemet-addon-css-' . $k;
					}

					wp_enqueue_style(
						$handle,
						$file,
						array(),
						KEMET_ADDONS_VERSION,
						'all'
					);
				}
			}
		}

		/**
		 * Fallback to enqueue individual CSS file.
		 *
		 * @since 1.0
		 * @access private
		 * @return void
		 */
		private static function render_fallback_css() {

			$css_files   = self::get_css_files();
			$files_count = count( $css_files );

			if ( $files_count > 0 ) {

				foreach ( $css_files as $index => $file_path ) {

					if ( ! file_exists( $file_path ) ) {
						continue;
					}

					$new_file = plugins_url( str_replace( plugin_dir_path( KEMET_ADDONS_FILE ), '', $file_path ), KEMET_ADDONS_FILE );

					if ( $files_count == $index + 1 ) {

						$handle = 'kemet-addon-css';
					} else {
						$handle = 'kemet-addon-css-' . $index;
					}

					wp_enqueue_style(
						$handle,
						$new_file,
						array(),
						KEMET_ADDONS_VERSION,
						'all'
					);

				}
			}
		}

		public static function get_http2_dynamic_css() {

			// Get the css key.
			$css_slug = self::_asset_slug();

			// No css data, recompile the css.
			if ( ! $css_data ) {
				self::render_http2_css();
				return self::get_http2_dynamic_css();
			}

			// Return the url.
			return $css_data;
		}

		public static function get_dynamic_css() {

			// Get the cache dir and css key.
			$cache_dir = self::get_cache_dir();
			$css_slug  = self::_asset_slug();

			// No css data, recompile the css.
			if ( ! $css_data ) {
				self::render_css();
				return self::get_dynamic_css();
			}

			// Return the url.
			return $css_data;
		}
	

		/**
		 * Used to add enqueue frontend styles.
		 *
		 * @since 1.0
		 * @param string  $src    Source URL.
		 * @param boolean $handle Script handle.
		 * @return void
		 */
		static public function add_css( $src = null, $handle = false ) {
			if ( false != $handle ) {
				self::$css_files[ $handle ] = $src;
			} else {
				self::$css_files[] = $src;
			}
		}
		
		/**
		 * Used to enqueue frontend scripts.
		 *
		 * @since 1.0
		 * @param string  $src    Source URL.
		 * @param boolean $handle Script handle.
		 * @return void
		 */
		static public function add_js( $src = null, $handle = false ) {

			if ( false != $handle ) {
				self::$js_files[ $handle ] = $src;
			} else {
				self::$js_files[] = $src;
			}
			
		}
		
		
	}
	new Kemet_Minify;

};
