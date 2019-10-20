<?php

/**
 * Extra Headers - Defaults &Customizer.
 *
 * @package Kemet Addons
 * @since 1.0.0
 */

if ( !class_exists( 'Kemet_Extra_Headers_Partials' )) {
    /**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
    class Kemet_Extra_Headers_Partials {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        /**
		 *  Constructor
		 */
		public function __construct() {
            
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_action( 'customize_register', array( $this, 'controls_helpers' ) );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
           // add_filter( 'kemet_theme_defaults', array( $this, 'addons_defaults' ) );
            
			//add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
			//add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			//add_action( 'customize_register', array( $this, 'headers_customize_register' ), 2 );

       
        }
        
//        function addons_defaults( $defaults ) {
//             // Defaults Top Header list of options.
//             //$defaults['header-layouts'] = 'header-main-layout-1';
//		 }
         
        public function customize_register($wp_customize) {
			require_once KEMET_EXTRA_HEADERS_DIR . 'customizer/customizer-options.php';  
			
		}
        
        public function controls_helpers() {
			require_once( KEMET_EXTRA_HEADERS_DIR .'customizer/customizer-helpers.php' );
		}
        
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {
			echo 'oopopopoo';
			$uri = KEMET_EXTRA_HEADERS_URL . 'assets/css';
			$path = KEMET_EXTRA_HEADERS_DIR . 'assets/css';
			$rtl = '';
			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'KEMET_THEME_HTTP2' ) && KEMET_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			//Kemet_Minify::add_css( $gen_path . 'extra-header-layouts.min.css' );

			Kemet_Minify::add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/extra-header-layouts.min.css');
			//Kemet_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
			Kemet_Minify::add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/unminified/style.css');
           // Kemet_Minify::add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.css');
		}

		public function add_scripts() {
			// Kemet_Minify::add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/extra-header-layouts.min.js');
			// Kemet_Minify::add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/simple-scrollbar.min.js');
			//wp_enqueue_script( 'script', KEMET_EXTRA_HEADERS_URL.'assets/js/minified/extra-header-layouts.min.js',array ( 'jquery' ), KEMET_ADDONS_VERSION, true);

		}
        
        public static function refresh() {
			self::$db_options = wp_parse_args(
				get_option( KEMET_THEME_SETTINGS ),
				self::defaults()
			);
		}
    }
}
Kemet_Extra_Headers_Partials::get_instance();