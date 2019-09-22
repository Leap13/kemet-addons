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
        
           // add_filter( 'kemet_theme_defaults', array( $this, 'addons_defaults' ) );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
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
		public function add_styles() {
			Kemet_Minify::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/extra-header-layouts.min.css');
            Kemet_Minify::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.min.css');
		}
		public function add_scripts() {
			Kemet_Minify::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/extra-header-layouts.min.js');
            Kemet_Minify::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/simple-scrollbar.min.js');
		}
        
        
        public function preview_scripts() {
			wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
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