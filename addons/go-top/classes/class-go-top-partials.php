<?php
/**
 * Go Top Partials
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Go_Top_Partials')) {

    class Kemet_Go_Top_Partials {

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
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'kemet_footer', array( $this, 'kemet_go_top_markup') );
        }

        public function kemet_go_top_markup() {
            if( kemet_get_option( 'enable-go-top' ) ){
            require_once KEMET_GOTOP_DIR . 'templates/go-top.php';
            }
        }


        public function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_GOTOP_DIR.'assets/css/minified/style.min.css');

        }
        
        public function add_scripts() {
			 Kemet_Style_Generator::kmt_add_js(KEMET_GOTOP_DIR.'assets/js/minified/go-top.min.js');
		}
        
    }
}
Kemet_Go_Top_Partials::get_instance();
