<?php
/**
 * Custom Layout
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Custom_Layout_Partials')) {

    class Kemet_Custom_Layout_Partials {

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
            add_action( 'do_meta_boxes', array( $this, 'remove_kemet_page_options' ) );
            add_filter( 'single_template', array( $this, 'get_custom_layout_template' ) );
            add_filter( 'kemet_addons_custom_layout_template', array( $this, 'template_empty_content' ) );
            add_filter( 'wp', array( $this, 'layout' ) );
        }

        
		/**
		 * Remove Kemet Meta Box
		 */
		public function remove_kemet_page_options() {
            remove_meta_box( 'kemet_page_options', KEMET_CUSTOM_LAYOUT_POST_TYPE , 'side' );
            
        }

        /**
		 * Custom layout template.
		 *
		 * @param  string $template Single Post template path.
		 * @return string
		 */
		public function get_custom_layout_template( $template ) {

            
			$template =  KEMET_CUSTOM_LAYOUT_DIR . '/templates/template.php';
            
			return $template;
        }
        
        
		/**
		 * Empty Content area.
		 *
		 * @return void
		 */
		public function template_empty_content() {
			$post_id = get_the_id();
			$meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
            $layout = ( isset( $meta['layout-position'] ) ) ? $meta['layout-position'] : '';
			if ( empty( $layout ) ) {
				the_content();
			}
        }
        
        /**
		 * Get layout
		 */
		public function get_layout() {
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		}


        /**
		 *  Layout Position
		 *
		 */
		function layout() {

            if ( is_singular( KEMET_CUSTOM_LAYOUT_POST_TYPE ) ) {

                $post_id  = get_the_id();

                $meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
                $layout = ( isset( $meta['layout-position'] ) ) ? $meta['layout-position'] : '';
                
                if ( $layout == 'header-layout' ) {

                    remove_action( 'kemet_header', 'kemet_header_markup' );

                    add_action( 'kemet_header', 
                    function() use ( $post_id ) {
                        echo '<header class="kmt-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
                        Kemet_Custom_Layout_Partials::get_instance()->get_layout( $post_id );
                        echo '</header>';
                    }
                 );
                }elseif($layout == 'footer-layout'){

                    remove_action( 'kemet_footer', 'kemet_footer_markup' );

                    add_action(
						'kemet_footer',
						function() use ( $post_id ) {
							echo '<footer class="kmt-custom-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">';
                            Kemet_Custom_Layout_Partials::get_instance()->get_layout();
							echo '</footer>';
						}
					);
                }

            }
            
		}
        
        
    }
}
Kemet_Custom_Layout_Partials::get_instance();
