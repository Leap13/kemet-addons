<?php
/**
 * Page Title Meta Box
 */


if ( ! class_exists( 'Kemet_Addon_Page_Title_Meta_Box' ) ) {

	class Kemet_Addon_Page_Title_Meta_Box {
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
            self::add_page_title_meta_box();
            add_action( 'wp', array( $this, 'meta_options_hooks' ) );
        }
        
        /**
		 * Metabox Hooks
		 */
		function meta_options_hooks() {

			if ( is_singular() ) {
                add_filter ( 'kemet_the_page_title_layout', array( $this, 'post_title' ));
                add_filter( 'kemet_disable_breadcrumbs', array( $this, 'disable_breadcrumbs' ) );
			}
           
        }

        function add_page_title_meta_box(){

        KFW::createSection( 'kemet_page_options', array(
                'title'  => __( 'Page Title', 'kemet-addons'),
                'icon'   => 'fa fa-wrench',
                'fields' => array(
                    array(
                        'id'         => 'kemet-page-title-display',
                        'type'       => 'image_select',
                        'title'      => __( 'Display Page Title', 'kemet-addons'),
                        'options'    => array(
                        'default'  => KEMET_PAGE_TITLE_URL . '/assets/images/default.png',
                        'page-title-layout-1'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-01.png',
                        'page-title-layout-2'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-02.png',
                        'page-title-layout-3'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-03.png',
                        'disable' => KEMET_PAGE_TITLE_URL . '/assets/images/disable.png',
                        ),
                        'default'    => 'default'
                    ),          
                  )
                ) 
            );
            KFW::createSection( 'kemet_page_options', array(
                'title'  => __('Breadcrumbs', 'kemet-addons'),
                'icon'   => 'fa fa-thumb-tack',
                'fields' => array(
                    array(
                        'id'         => 'kemet-disable-breadcrumbs',
                        'type'       => 'checkbox',
                        'title'      => __( 'Disable Breadcrumbs', 'kemet-addons'),
                        'label'   => __( 'Disable The Breadcrumbs in The Current Page/Post.', 'kemet-addons'),
                        'default'    => false
                    ),          
                  ) 
                )
            );
        }

        /**
		 * Disable Post / Page Title
		 *
		 */
		function post_title( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $title = ( isset( $meta['kemet-page-title-display'] )  && $meta['kemet-page-title-display'] != 'default') ? $meta['kemet-page-title-display'] : $defaults;

			return $title;
        }

         /**
		 * Breadcrumbs Option
		 */
        function disable_breadcrumbs( $default ) {
			
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
		    $disable_breadcrumbs = (isset( $meta['kemet-disable-breadcrumbs'] ) ) ? $meta['kemet-disable-breadcrumbs'] : false;

			if ( $disable_breadcrumbs ) {
				$default = false;
            }
			
            return $default;
        }
    }
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kemet_Addon_Page_Title_Meta_Box;