<?php

/**
 * Kemet Extra Headers
 *
 * @package Kemet Addons
 */

define( 'KEMET_EXTRA_HEADERS_DIR', KEMET_ADDONS_DIR . 'addons/extra-headers/' );
define( 'KEMET_EXTRA_HEADERS_URL', KEMET_ADDONS_URL . 'addons/extra-headers/' );

if ( ! class_exists( 'Kemet_Extra_Headers' ) ) {

	/**
	 * Footer Widgets Markup Initial Setup
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
			//add_action( 'customize_register', array( $this, 'customize_register' ) );
		 	add_action( 'kemet_sitehead', array( $this, 'html_markup_loader' ), 1 );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			//require_once KEMET_EXTRA_HEADERS_DIR . 'classes/dynamic-css.php';	
            require_once KEMET_EXTRA_HEADERS_DIR . 'customizer/customizer-options.php';
			
		}
       
        function customize_register($wp_customize) {
			require KEMET_ADDONS_DIR . 'addons/extra-headers/customizer/customizer-options.php';  
			
		}

			
        /**
		 * Customizer Preview
		 */
		function preview_scripts() {
			wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ));
		}

		/**
		 * Header Markup
		 *
		 */
		function html_markup_loader() {
            
            $kemet_header_layout = kemet_get_option( 'header-layouts' );
           
            if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout && 'header-main-layout-4' !== $kemet_header_layout  ) {
			   remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' ); 
               kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
            } else {
                return;
            }
                    
		}
		
		
		
		// /**
		//  * Enqueues scripts and styles for the theme layout
		//  * post type on the WordPress admin edit post screen.
		//  *
		//  * @since 1.0.0
		//  * @return void
		//  */
		public function add_styles() {
			Kemet_Minify::kmt_add_css(KEMET_ADDONS_DIR.'addons/extra-headers/assets/css/unminified/header-layout-5.css');
			Kemet_Minify::kmt_add_css(KEMET_ADDONS_DIR.'addons/extra-headers/assets/css/unminified/header-layout-6.css');
			Kemet_Minify::kmt_add_css(KEMET_ADDONS_DIR.'addons/extra-headers/assets/css/unminified/header-layout-7.css');
		}
		public function add_scripts() {
			Kemet_Minify::kmt_add_js(KEMET_ADDONS_DIR.'addons/extra-headers/assets/js/unminified/header-layout-5.js');
			Kemet_Minify::kmt_add_js(KEMET_ADDONS_DIR.'addons/extra-headers/assets/js/unminified/header-layout-7.js');
			wp_add_inline_style( 'kemet-theme-css', Kemet_addon_Dynamic_CSS::return_output() );
		}
	}
    Kemet_Extra_Headers::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
