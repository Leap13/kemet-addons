<?php
/**
 * Blog Layouts
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Blog_Layouts_Partials')) {

    class Kemet_Blog_Layouts_Partials {
        private static $instance;
        
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
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_filter( 'body_class', array( $this, 'kemet_blog_body_classes') );
        }
    



        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR.'assets/css/minified/blog-layouts.min.css');

	    }
    }
}
Kemet_Blog_Layouts_Partials::get_instance();
