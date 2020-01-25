<?php
/**
 * Extra Headers
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Blog_Layouts_settings' )) {
    /**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
    class Kemet_Blog_Layouts_settings {
        
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
            add_action( 'customize_register', array( $this, 'controls_helpers' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );

        }
        

        function theme_defaults( $defaults ) {
			$defaults['blog-layouts']  = 'blog-layout-1';
            $defaults['blog-grids']  = '';
            $defaults['blog-posts-border-color']  = '';
            $defaults['blog-posts-border-size']   = '';
            $defaults['blog-title-meta-border-color']   = '';
            $defaults['blog-title-meta-border-size']   = '';
            $defaults['post-image-height']   = '';
            return $defaults;
        }

        /**
		* Blog 
		*/
        function blog_template() {
            
            remove_action( 'kemet_entry_content_blog', 'kemet_entry_content_blog_template' );
			kemetaddons_get_template( 'blog-layouts/templates/' . esc_attr( kemet_get_option( 'blog-layouts' ) ) . '.php' );
        }

       function customize_register($wp_customize) {
			require_once KEMET_BLOG_LAYOUTS_DIR . 'customizer/customizer-options.php';  
			
        }

        public function controls_helpers() {
			require_once( KEMET_BLOG_LAYOUTS_DIR .'customizer/customizer-helpers.php' );
		}
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-extra-blogs-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-extra-blogs-customize-preview-js', KEMET_BLOG_LAYOUTS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }
    
    }
}
Kemet_Blog_Layouts_settings::get_instance();