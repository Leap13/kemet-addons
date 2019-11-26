<?php
/**
 * Single Post Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Single_Post_Partials')) {

    /**
     * Single Post Section
     *
     * @since 1.0.0
     */
    class Kemet_Single_Post_Partials
    {

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
            add_filter( 'body_class', array( $this,'kemet_body_classes' ));
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_entry_content_single', array( $this, 'kemet_single_post_template_loader') , 1);
            add_action( 'kemet_entry_after', array( $this, 'related_posts_template' ),1 );
            //add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
        }

    function related_posts_template(){
            if ( is_single() ) {
                kemetaddons_get_template( 'single-post/templates/related-posts.php' ); 
            } 
        }

        public function kemet_single_post_template_loader() {
            remove_action( 'kemet_entry_content_single', 'kemet_entry_content_single_template' );
            kemetaddons_get_template( 'single-post/templates/single-post-layout.php' );  
        }
        function kemet_body_classes($classes) {
            
            $prev_next_links = kemet_get_option('prev-next-links');

			if($prev_next_links == true){
				$classes[] = 'hide-nav-links';
			}
            return $classes;
		}
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_SINGLE_POST_DIR.'assets/css/minified/style.min.css');
		}

		// public function add_scripts() {
		// 	 Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/extra-header-layouts.min.js');

		// }

    }
}
Kemet_Single_Post_Partials::get_instance();
