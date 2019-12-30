<?php
/**
 * Page Title Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Page_Title_Partials')) {

    /**
     * Page Title Section
     *
     * @since 1.0.0
     */
    class Kemet_Page_Title_Partials {

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
            add_filter( 'kemet_the_title_enabled', '__return_false' );
            add_action( 'kemet_after_header_block' , array( $this, 'kemet_page_title_markup' ), 9 );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_before_header_block', array( $this, 'header_merged_with_title' ) );
        }

        public function kemet_page_title_markup() {
            $page_title_layout = kemet_get_option( 'page-title-layouts' );
            if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) {
                if($page_title_layout !== 'page-title-layout-2'){
                    kemetaddons_get_template( 'page-title/templates/'. esc_attr( $page_title_layout ) . '.php' );
                }else{
                    kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
                }
            }
            $header_merged_title = kemet_get_option('merge-with-header');
            if( $header_merged_title == '1') {
                echo '</div>';
            }
         }

        public function header_merged_with_title() {
            $header_merged_title = kemet_get_option("merge-with-header");
            if( $header_merged_title == '1') {
                $combined = 'kemet-merged-header-title';
            printf(
				'<div class="%1$s">',
				$combined
            );
            }
            
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_PAGE_TITLE_DIR.'assets/css/minified/style.min.css');

	    }

    }
}
Kemet_Page_Title_Partials::get_instance();
