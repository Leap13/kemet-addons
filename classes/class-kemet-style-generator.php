<?php
/**
 * Minify Loader Class
 *
 * @package     Kemet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Style_Generator' ) ) {

	/**
	 * Kemet_Merged_Style
	 */
	class Kemet_Style_Generator {

		static private $css_files = array();

		static private $js_files = array();

		public function __construct() {
			//add_action( 'kfw_kmt_framework_saved', 'refresh_assets');
			add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts'));
		}

		public function merge_all_scripts() 
		{
			$css_files = self::get_css_files();
			$files_count = count( $css_files );
			$js_files  = self::get_js_files();
			$merged_style	= '';
			/* new ner */
			if ( $files_count > 0 ) {

			foreach( $css_files as $k => $file) {	
				//$css_file_path = $handle;
				$merged_style .=  file_get_contents($file)."\n";
				if ( $files_count == $k + 1 ) {
						$handle = 'kmt-addon-css';
					}
			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) );
			}


		// Stash CSS in uploads directory
		require_once( ABSPATH . 'wp-admin/includes/file.php' ); // We will probably need to load this file
		global $wp_filesystem;
		$upload_dir = wp_upload_dir(); // Grab uploads folder array
		$dir = trailingslashit( $upload_dir['basedir'] ) . 'kemet-addons/'; // Set storage directory path

		WP_Filesystem(); // Initial WP file system
		$wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file
		$wp_filesystem->put_contents( $dir . 'style.css', $merged_style, 0777 | 0644 ); // Finally, store the file :D
		$wp_upload_dir = $upload_dir['baseurl'] . '/' . 'kemet-addons/';
		$merged_file = $wp_upload_dir . 'style.css';
		$handle = 'kemet-addon-css';
		
			
			wp_enqueue_style(
						$handle,
						$merged_file,
						array(),
						KEMET_ADDONS_VERSION,
						'all'
					);
					}
				}

			wp_add_inline_style( 'kemet-addon-css', apply_filters( 'kemet_dynamic_css', '' ) );
		}

		
		public function refresh_assets() {
			self::render_css();
		} 

		public static function load_filesystem() {

			if ( null === self::$kemet_filesystem ) {

				global $wp_filesystem;
				if ( empty( $wp_filesystem ) ) {
					require_once( ABSPATH . '/wp-admin/includes/file.php' );
					WP_Filesystem();
				}

				self::$kemet_filesystem = $wp_filesystem;
			}
		}

		private static function render_css() {
			self::load_filesystem();

			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) );
			}

			if ( get_option( 'kmt-theme-css-status' ) ) {
				$assets_status = self::clear_assets_cache();

				if ( false == $assets_status ) {
					return false;
				}
			}

			$cache_dir   = self::get_cache_dir();
			$new_css_key = str_replace( '.', '-', uniqid( '', true ) );
			//$css_slug    = self::_asset_slug();
			$css_files   = self::get_css_files();
			$css         = '';
			$css_min     = '';
			$filepath    = $cache_dir['path'] . '-' . $new_css_key . '.css';

			if ( count( $css_files ) > 0 ) {

				foreach ( $css_files as $k => $file ) {

					if ( ! empty( $file ) && file_exists( $file ) ) {
						$css .= self::$kemet_filesystem->get_contents(
							$file,
							FS_CHMOD_FILE
						);
					}
				}
			}

			$css = apply_filters( 'kemet_render_css', $css );

			$status = self::$kemet_filesystem->put_contents(
				$filepath,
				$css,
				FS_CHMOD_FILE
			);
						$status = ! $status;

			// Save the new css key.
			update_option( 'kmt-theme-css-status', $status );
			update_option( self::$_css_key . '-', $new_css_key );

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
		 * Used to add enqueue frontend styles.
		 *
		 * @since 1.0
		 * @param string  $src    Source URL.
		 * @param boolean $handle Script handle.
		 * @return void
		 */
		static public function kmt_add_css( $src = null, $handle = false ) {
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
		static public function kmt_add_js( $src = null, $handle = false ) {

			if ( false != $handle ) {
				self::$js_files[ $handle ] = $src;
			} else {
				self::$js_files[] = $src;
			}
			
		}
		
		
	}
	new Kemet_Style_Generator;

};
