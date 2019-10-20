  
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
		static private $kemet_filesystem = null;
		static private $_css_key = 'kmt_css_key';
		static private $_dir_info = null;
		//static private $_css_key = 'astra_theme_css_key';
		

		static private $dir_info = null;
        
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
			//add_action( 'customize_save_after', __CLASS__ . '::refresh_assets', 11 );
			//add_action( 'kfw_kmt_framework_saved', 'refresh_assets');	
			add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts'));
		}

		public static function merge_all_scripts() {
			$css_url = self::get_merged_css_url();

			if ( false != $css_url ) {
					wp_enqueue_style( 'kemet-addons-css', $css_url, array(), KEMET_ADDONS_VERSION, 'all' );
			}

		}

		public static function get_merged_css_url() {
			$cache_dir = self::get_cache_dir();
			$new_css_key = uniqid( '', true );
			$filepath    = $cache_dir['path'] . 'style-' . $new_css_key . '.css';
			$css_files   = self::get_css_files();

			require_once( ABSPATH . 'wp-admin/includes/file.php' ); // We will probably need to load this file
			global $wp_filesystem;
			$upload_dir = wp_upload_dir(); // Grab uploads folder array
			//$dir = trailingslashit( $upload_dir['basedir'] ) . 'some-folder/'; // Set storage directory path
			$css = '';


			if ( count( $css_files ) > 0 ) {

				foreach ( $css_files as $k => $file ) {

					if ( ! empty( $file ) && file_exists( $file ) ) {
						$css .= $wp_filesystem->get_contents(
							$file,
							0644
						);
					}
				}
			}
			$upload_dir = wp_upload_dir(); // Grab uploads folder array
			$dir = trailingslashit( $upload_dir['basedir'] ) . 'some-folder-nnn/'; // Set storage directory path


			$css = apply_filters( 'kemet_render_css', $css );
			WP_Filesystem(); // Initial WP file system
			$wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file
			$filepath = $dir . 'style-' . $new_css_key . '.css';
			
			$status = $wp_filesystem->put_contents( $filepath, $css, 0644 ); // Finally, store the file :D
			return $status;
			

		}

		public static function get_css_files() {

			if ( 0 > count( self::$css_files ) ) {
				do_action( 'kemet_get_css_files' );
			}

			return apply_filters( 'kemet_add_css_file', self::$css_files );
		}

		public static function get_cache_dir() {

			$dir_name = 'kemet-addons-new';
			$wp_info  = wp_upload_dir();

			// Build the paths.
			$dir_info = array(
				'path' => $wp_info['basedir'] . '/' . $dir_name . '/',
				'url'  => $wp_info['baseurl'] . '/' . $dir_name . '/',
			);

			// Create the cache dir if it doesn't exist.
			if ( ! file_exists( $dir_info['path'] ) ) {
				wp_mkdir_p( $dir_info['path'] );
			}

			self::$_dir_info = $dir_info;

			return self::$_dir_info;
		}
		/**
		 * Used to add enqueue frontend styles.
		 *
		 * @since 1.0
		 * @param string  $src    Source URL.
		 * @param boolean $handle Script handle.
		 * @return void
		 */
		public static function add_css( $src = null, $handle = false ) {
			if ( false != $handle ) {
				self::$css_files[ $handle ] = $src;
			} else {
				self::$css_files[] = $src;
			}
		}

// 		public static function load_filesystem() {

// 			if ( null === self::$kemet_filesystem ) {

// 				global $wp_filesystem;
// 				if ( empty( $wp_filesystem ) ) {
// 					require_once ABSPATH . '/wp-admin/includes/file.php';
// 					WP_Filesystem();
// 				}

// 				self::$kemet_filesystem = $wp_filesystem;
// 			}
// 		}

// 		public static function get_kemetaddons_dir() {

// 			if ( null != self::$dir_info ) {
// 				return self::$dir_info;
// 			}

// 			$dir_name = 'kemet-addonsss-pp';
// 			$wp_info  = wp_upload_dir();

// 			// Build the paths.
// 			$dir_info = array(
// 				'path' => $wp_info['basedir'] . '/' . $dir_name . '/',
// 				'url'  => $wp_info['baseurl'] . '/' . $dir_name . '/',
// 			);

// 			// Create the cache dir if it doesn't exist.
// 			if ( ! file_exists( $dir_info['path'] ) ) {
// 				wp_mkdir_p( $dir_info['path'] );
// 			}

// 			self::$dir_info = $dir_info;

// 			return self::$dir_info;
// 		}

// 		public static function get_merged_css_url() {
// 			// if ( ! get_option( 'kmt-theme-css-status' ) ) {
			
//  			// $kemet_addons_dir  = self::get_kemetaddons_dir();
// 			// $new_css_key = str_replace( '.', '-', uniqid( '', true ) );
// 			// $css_path  = $kemet_addons_dir['path'] . 'style-' . $new_css_key . '.css';
// 			// $css_url   = $kemet_addons_dir['url']  . 'style-' . $new_css_key . '.css';
// 			// if ( ! $new_css_key ) {
// 			// 		self::render_css();
// 			// 		return self::get_merged_css_url();
// 			// 	}
// 			// 	// Check to see if the file exists.
// 			// 	if ( ! file_exists( $css_path ) ) {
// 			// 		self::render_css();
// 			// 		return false;
// 			// 	}
// 			// return $css_url;
// 			// }

// 			if ( defined( 'KEMET_THEME_HTTP2' ) && KEMET_THEME_HTTP2 ) {

// 				self::enqueue_http2_css();
// 				return false;
// 			} elseif ( ! get_option( 'kmt-theme-css-status' ) ) {

// 				// Get the cache dir and css key.
// 				$cache_dir = self::get_kemetaddons_dir();
// 				$css_slug  = self::_asset_slug();
// 				$css_key   = get_option( self::$_css_key . '-' . $css_slug );
// 				$css_path  = $cache_dir['path'] . $css_slug . '-' . $css_key . '.css';
// 				$css_url   = $cache_dir['url'] . $css_slug . '-' . $css_key . '.css';

// 				if ( ! $css_key ) {
// 					self::render_css();
// 					return self::get_css_url();
// 				}

// 				// Check to see if the file exists.
// 				if ( ! file_exists( $css_path ) ) {
// 					self::render_css();
// 					return false;
// 				}

// 				// Return the url.
// 				return $css_url;
// 			} else {

// 				self::render_css();
// 				return false;
// 			}
// 		}

// 		private static function _asset_slug() {
// 			if ( self::is_customizer_preview() ) {
// 				$slug = 'kmt-customizer';
// 			} else {
// 				$slug = 'kemet-addons';
// 			}

// 			return $slug;
// 		}

// 		private static function enqueue_http2_css() {

// 			$css_files   = self::get_css_files();
// 			$files_count = count( $css_files );

// 			if ( $files_count > 0 ) {

// 				foreach ( $css_files as $k => $file ) {

// 					if ( $files_count == $k + 1 ) {
// 						$handle = 'kemet-addons-css';
// 					} else {
// 						$handle = 'kemet-addons-css-' . $k;
// 					}

// 					wp_enqueue_style(
// 						$handle,
// 						$file,
// 						array(),
// 						ASTRA_EXT_VER,
// 						'all'
// 					);
// 				}
// 			}
// 		}
		
		
// 		private static function render_css() {

// 			self::load_filesystem();

// 			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
// 				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) );
// 			}

// 			if ( get_option( 'kmt-theme-css-status' ) ) {
// 				$assets_status = self::clear_assets_cache();

// 				if ( false == $assets_status ) {
// 					return false;
// 				}
// 			}

// 			$cache_dir   = self::get_kemetaddons_dir();
// 			$new_css_key = str_replace( '.', '-', uniqid( '', true ) );
// 			$css_files   = self::get_css_files();
// 			$css         = '';
// 			$css_min     = '';
// 			$filepath    = $cache_dir['path'] . 'style-' . $new_css_key . '.css';

// 			if ( count( $css_files ) > 0 ) {

// 				foreach ( $css_files as $k => $file ) {

// 					if ( ! empty( $file ) && file_exists( $file ) ) {
// 						$css .= self::$kemet_filesystem->get_contents(
// 							$file,
// 							FS_CHMOD_FILE
// 						);
// 					}
// 				}
// 			}

// 			$css = apply_filters( 'kemet_render_css', $css );

// 			$status = self::$kemet_filesystem->put_contents(
// 				$filepath,
// 				$css,
// 				FS_CHMOD_FILE
// 			);

// 			$status = ! $status;

// 			// Save the new css key.
// 			update_option( 'kmt-theme-css-status', $status );
// 			update_option( self::$_css_key . 'style-', $new_css_key );
// 		}

// 		static public function get_css_files() {
//  			if ( 1 > count( self::$css_files ) ) {
//  				do_action( 'kemet_get_css_files' );		
//  			}
//  			return apply_filters( 'kemet_add_css_file', self::$css_files );
// 		 }
		 
// 		 public static function add_css( $src = null, $handle = false ) {
// 			if ( false != $handle ) {
// 				self::$css_files[ $handle ] = $src;
// 			} else {
// 				self::$css_files[] = $src;
// 			}
// 		}

// 		public static function clear_assets_cache() {

// 			// Make sure the filesystem is loaded.
// 			self::load_filesystem();

// 			$dir_name   = 'kemet-addonsss-pp';
// 			$cache_dir  = self::get_kemetaddons_dir();
// 			//$asset_slug = self::_asset_slug();

// 			/* Delete CSS Keys */
// 			delete_option( self::$_css_key . '-' );
// 			delete_option( self::$_css_key . '-files-' );

// 			if ( ! empty( $cache_dir['path'] ) && stristr( $cache_dir['path'], $dir_name ) ) {
// 				$directory     = trailingslashit( $cache_dir['path'] );
// 				$filelist      = (array) self::$kemet_filesystem->dirlist( $directory, true );
// 				$delete_status = true;

// 				foreach ( $filelist as $file ) {

// 					$file = $directory . $file['name'];

// 					if ( is_file( $file ) && file_exists( $file ) ) {
// 						$delete_status = self::$kemet_filesystem->delete( $file );
// 					}
// 				}

// 				// If the file was not correctly deleted.
// 				if ( false == $delete_status ) {
// 					// Set status CSS status True. This will load the CSS as inline.
// 					update_option( 'kmt-theme-css-status', true );

// 					return false;
// 				}
// 			}

// 			return true;
// 		}

// 		public static function refresh_assets() {
// 			self::clear_assets_cache();
// 			self::render_css();
// 			//do_action( 'astra_addon_assets_refreshed' );
// 		}

// 		// private static function render_css() {

// 		// 	self::load_filesystem();

// 		// 	if ( ! defined( 'FS_CHMOD_FILE' ) ) {
// 		// 		define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) );
// 		// 	}

// 		// 	// if ( get_option( 'ast-theme-css-status' ) ) {
// 		// 	// 	$assets_status = self::clear_assets_cache();

// 		// 	// 	if ( false == $assets_status ) {
// 		// 	// 		return false;
// 		// 	// 	}
// 		// 	// }

// 		// 	$cache_dir   = self::get_kemetaddons_dir();
// 		// 	$new_css_key = str_replace( '.', '-', uniqid( '', true ) );
// 		// 	$css_files   = self::get_css_files();
// 		// 	$files_count = count($css_files);
// 		// 	$css         = '';
// 		// 	$css_min     = '';
// 		// 	$filepath    = $cache_dir['path'] . 'style-' . $new_css_key . '.css';

// 		// 	if ( count( $css_files ) > 0 ) {

// 		// 		foreach ( $css_files as $k => $file ) {
// 		// 			if ( $files_count == $k + 1 ) {
// 		// 				$handle = 'kemet-addons-css';
// 		// 			} else {
// 		// 				$handle = 'kemet-addons-css-' . $k;
// 		// 			}

// 		// 			if ( ! empty( $file ) && file_exists( $file ) ) {
// 		// 				$css .= self::$kemet_filesystem->get_contents(
// 		// 					$file,
// 		// 					FS_CHMOD_FILE
// 		// 				);
// 		// 			}
// 		// 		}
// 		// 	}

// 		// 	$css = apply_filters( 'kemet_render_css', $css );

// 		// 	$status = self::$kemet_filesystem->put_contents(
// 		// 		$handle,
// 		// 		$filepath,
// 		// 		$css,
// 		// 		FS_CHMOD_FILE
// 		// 	);

// 		// 	$status = ! $status;

// 		// 	// Save the new css key.
// 		// 	update_option( 'kmt-theme-css-status', $status );
// 		// 	update_option( self::$_css_key . 'style-' , $new_css_key );
// 		// }

// 		// static public function get_css_files() {
//  		// 	if ( 1 > count( self::$css_files ) ) {
//  		// 		do_action( 'kemet_get_css_files' );		
//  		// 	}
//  		// 	return apply_filters( 'kemet_kmt_add_css_file', self::$css_files );
// 		//  }
		 
// 		//  /**
// 		//  * Load WordPress filesystem
// 		//  *
// 		//  * @since 1.0
// 		//  * @return void
// 		//  */
// 		// public static function load_filesystem() {

// 		// 	if ( null === self::$kemet_filesystem ) {

// 		// 		global $wp_filesystem;
// 		// 		if ( empty( $wp_filesystem ) ) {
// 		// 			require_once ABSPATH . '/wp-admin/includes/file.php';
// 		// 			WP_Filesystem();
// 		// 		}

// 		// 		self::$kemet_filesystem = $wp_filesystem;
// 		// 	}
// 		// }


        
// // 		public function merge_all_scripts() 
// // 		{
// // 			$css_files = self::get_css_files();
// // 			$js_files  = self::get_js_files();
// // 			$merged_js_file_location =  KEMET_ADDONS_DIR.'merged-script.js';
			
// // 			$merged_script	= '';
// // 			$merged_css_file_location = KEMET_ADDONS_DIR.'merged-style.css';
// // 			$merged_style	= '';
		
// // 			foreach( $js_files as $handle) 
// // 			{	
// // 				$js_file_path = $handle;
// // 				$merged_script .=  file_get_contents($js_file_path) .';' ;
				
				
// // 			}
			
// // 			foreach( $css_files as $handle) 
// // 			{	
// // 				$css_file_path = $handle;
// // 				$merged_style .=  file_get_contents($css_file_path)."\n";
// // 			}
// // 			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
// // 				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) );
// // 			}
// // //$new_file = plugins_url( str_replace( plugin_dir_path( KEMET_ADDONS_FILE ), '', $file_path ), KEMET_ADDONS_FILE );

// // //  $doc_root  = untrailingslashit( ABSPATH );
// // //  				$site_root = get_site_url();
// // //  				$new_file = str_replace( '\\', '/', str_replace( $doc_root, $site_root ) );
// // 			// Stash CSS in uploads directory
// // 			//$css = '';
// // 			foreach ( $css_files as $k => $v ) {

// // 					if ( file_exists( $v ) ) {
// // 						continue;
// // 					}
// // 				}
// // 	require_once( ABSPATH . 'wp-admin/includes/file.php' ); // We will probably need to load this file
// // 	global $wp_filesystem;
// // 	$upload_dir = wp_upload_dir(); // Grab uploads folder array
// // 	$dir = trailingslashit( $upload_dir['basedir'] ) . 'some-folder2/'; // Set storage directory path

// // 	WP_Filesystem(); // Initial WP file system
// // 	$wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file
// // 	$wp_filesystem->put_contents( $dir . 'style.css', $merged_style, FS_CHMOD_FILE ); // Finally, store the file :D
// // 	//$doc_root  = untrailingslashit( ABSPATH );
// //  				$site_root = get_site_url();
// // 				 $new_file = str_replace( '\\', '/', str_replace( $dir, $site_root, $v) );
				 
// // 	//	wp_enqueue_style('merged-style', $dir . 'style.css' . KEMET_ADDONS_VERSION , true);
// // 	wp_enqueue_style(
// // 						'merged-style',
// // 						$new_file,
// // 						//array(),
// // 						KEMET_ADDONS_VERSION,
// // 						'all'
// // 					);
				




// // 		// 	//file_put_contents ( $merged_js_file_location , $merged_script);
// //         //    // chmod($filename, 0664);
// // 		// 	file_put_contents ( $merged_css_file_location , $merged_style);
// //         //    // chmod($merged_css_file_location, "0664");
// // 		// 	wp_enqueue_script('merged-script', KEMET_ADDONS_URL . 'merged-script.js', array('jquery'), '1.0.0', true );
		
// //         //     wp_register_style( 'kemet-addon-css', false );
// //         //     wp_enqueue_style( 'kemet-addon-css' );
// //         //     //wp_add_inline_style( 'dma-inline-style', $dynamic_css );
// //         //     wp_add_inline_style( 'kemet-addon-css', apply_filters( 'kemet_addons_dynamic_css', '', time() ) );
            
            
// // 		}
// // 		static public function get_css_files() {
// // 			if ( 1 > count( self::$css_files ) ) {
// // 				do_action( 'kemet_get_css_files' );		
// // 			}
// // 			return apply_filters( 'kemet_kmt_add_css_file', self::$css_files );
// // 		}
// // 		static public function get_js_files() {
// // 			if ( 1 > count( self::$js_files ) ) {
// // 				do_action( 'kemet_get_js_files' );
				
// // 			}
// // 			return apply_filters( 'kemet_kmt_add_js_file', self::$js_files );
// // 		}
        
// //         public static function get_dynamic_css() {
// // 			// Get the cache dir and css key.
// // 			$cache_dir = self::get_cache_dir();
// // 			$css_slug  = self::_asset_slug();
// // 			// No css data, recompile the css.
// // 			if ( ! $css_data ) {
// // 				self::render_css();
// // 				return self::get_dynamic_css();
// // 			}
// // 			// Return the url.
// // 			return $css_data;
// // 		}
        
	
// // 		/**
// // 		 * Used to add enqueue frontend styles.
// // 		 *
// // 		 * @since 1.0
// // 		 * @param string  $src    Source URL.
// // 		 * @param boolean $handle Script handle.
// // 		 * @return void
// // 		 */
// // 		static public function kmt_add_css( $src = null, $handle = false ) {
// // 			if ( false != $handle ) {
// // 				self::$css_files[ $handle ] = $src;
// // 			} else {
// // 				self::$css_files[] = $src;
// // 			}
// // 		}
		
// // 		/**
// // 		 * Used to enqueue frontend scripts.
// // 		 *
// // 		 * @since 1.0
// // 		 * @param string  $src    Source URL.
// // 		 * @param boolean $handle Script handle.
// // 		 * @return void
// // 		 */
// // 		static public function kmt_add_js( $src = null, $handle = false ) {
// // 			if ( false != $handle ) {
// // 				self::$js_files[ $handle ] = $src;
// // 			} else {
// // 				self::$js_files[] = $src;
// // 			}
			
// // 		}
		
		
// // 	}
	}
	//new Kemet_Minify;
//    Kemet_Minify::get_instance();
}