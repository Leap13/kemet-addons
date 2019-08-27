<?php

/**
 * Kemet Extra Headers Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_EXTRA_HEADERS_DIR', KEMET_ADDONS_DIR . 'addons/extra-headers/' );
define( 'KEMET_EXTRA_HEADERS_URL', KEMET_ADDONS_URL . 'addons/extra-headers/' );

if ( ! class_exists( 'Kemet_Extra_Headers' ) ) {

	/**
	 * Extra Headers
	 *
	 * @since 1.0.0
	 */
	class Kemet_Extra_Headers {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
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
		 	add_action( 'kemet_sitehead', array( $this, 'html_markup_loader' ), 1 );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
            require_once KEMET_EXTRA_HEADERS_DIR . 'classes/dynamic.css.php';
			
		}
       
        public function customize_register($wp_customize) {
			require KEMET_ADDONS_DIR . 'addons/extra-headers/customizer/customizer-options.php';  
			
		}
        
        public function controls_helpers() {
			require_once( KEMET_EXTRA_HEADERS_DIR .'customizer/customizer-helpers.php' );
		}

			
        /**
		 * Customizer Preview
		 */
		public function preview_scripts() {
			wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
		}

		/**
		 * Header Markup
		 *
		 */
		public function html_markup_loader() {
            
            $kemet_header_layout = kemet_get_option( 'header-layouts' );
           
            if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout && 'header-main-layout-4' !== $kemet_header_layout  ) {
			   remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' ); 
               kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
            } else {
                return;
            }
                    
		}
		
		
		 /**
		  * Enqueues scripts and styles for the header layouts
		 */
		public function add_styles() {
			Kemet_Minify::kmt_add_css(KEMET_ADDONS_DIR.'addons/extra-headers/assets/css/minified/extra-header-layouts.min.css');
		}
		public function add_scripts() {
			Kemet_Minify::kmt_add_js(KEMET_ADDONS_DIR.'addons/extra-headers/assets/js/minified/extra-header-layouts.min.js');
		}
	}
    Kemet_Extra_Headers::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
