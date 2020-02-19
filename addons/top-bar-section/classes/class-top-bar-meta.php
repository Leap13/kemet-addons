<?php
/**
 * Top Bar Meta Box
 */


if ( ! class_exists( 'Kemet_Addon_Top_Bar_Meta_Box' ) ) {

	class Kemet_Addon_Top_Bar_Meta_Box {
        /**
         * Instance
         *
         * @var $instance
         */
        private static $instance;

        /**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
            self::add_top_bar_meta_box();
            add_action( 'wp', array( $this, 'meta_options_hooks' ) );
        }
        
        /**
		 * Metabox Hooks
		 */
		function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_top_bar_enabled', array( $this, 'top_bar' ) );
			}
           
        }

        function add_top_bar_meta_box(){

            KFW::createSection( 'kemet_page_options', array(
                'title'  => 'Top Bar',
                'icon'   => 'fa fa-thumb-tack',
                'fields' => array(
                    array(
                      'id'         => 'kemet-top-bar-display',
                      'type'       => 'checkbox',
                      'title'      => 'Disable Top Bar',
                      'label'   => 'Disable The Top Bar in The Current Page/Post.',
                      'default'    => false
                    ),         
                  ) 
              )
            );
        }

        /**
		 * Disable Top Bar
		 */
		function top_bar($defaults) {
            
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true); 
				
			$display_top_bar = ( isset( $meta['kemet-top-bar-display'] ) ) ? $meta['kemet-top-bar-display'] : false;
            
				if ( true == $display_top_bar ) {
					$defaults = false;
				}

				return $defaults;
		}
    }
}


new Kemet_Addon_Top_Bar_Meta_Box;