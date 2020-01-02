<?php
/**
 * Blog Layouts
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Blog_Layouts_Partials')) {

    class Kemet_Blog_Layouts_Partials {

        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        /**
         * Initiator
         */
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_action( 'kemet_entry_content_blog', array( $this, 'blog_template' ), 1 );
            //add_action( 'customize_register', array( $this, 'controls_helpers' ) );
           // add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );

        }
        

        function theme_defaults( $defaults ) {
            // $defaults['header-icon-bars-logo-bg-color']  = '';
            // $defaults['header-icon-bars-color']          = '#fff';
            // $defaults['header-icon-bars-h-color']        = '';
            // $defaults['header-icon-bars-bg-color']       = '#7a7a7a';
            // $defaults['header-icon-bars-bg-h-color']     = '';
            // $defaults['header-icon-bars-border-radius']  = '';
            // $defaults['menu-icon-bars-space']            = '';
            // $defaults['box-shadow']                      = '';
            // // Vertical Headers
            // $defaults['header6-position']                = '';
            // $defaults['vertical-header-width']           = 300;
            // $defaults['v-headers-position']              = 'left';
            // $defaults['header6-border-width']            = '';
            // $defaults['header6-border-style']            = '';
            // $defaults['header6-border-color']            = '';
            // $defaults['header8-position']                = '';
            // $defaults['header8-width']                   = '';
            return $defaults;
        }

        /**
		 * Blog 
		 */
		// function new_blog_layouts() {

		// 	$blog_layout = kemet_get_option( 'blog-layouts' );

		// 	if ( 'blog-layout-1' !== $blog_layout ) {
		// 		remove_action( 'kemet_entry_content_blog', 'kemet_entry_content_blog_template' );
		// 		add_action( 'kemet_entry_content_blog', array( $this, 'blog_template' ) );
		// 	}
		// }

        function blog_template() {
            echo 'ofoiuopdius';
            kemetaddons_get_template( 'blog-layouts/templates/' . esc_attr( kemet_get_option( 'blog-layouts' ) ) . '.php' );
        }

       function customize_register($wp_customize) {
			require_once KEMET_BLOG_LAYOUTS_DIR . 'customizer/customizer-options.php';  
			
        }

        public function controls_helpers() {
			//require_once( KEMET_BLOG_LAYOUTS_DIR .'customizer/customizer-helpers.php' );
		}
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-extra-headers-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Blog_Layouts_Partials::get_instance();
