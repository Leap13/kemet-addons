<?php
/**
 * Top Bar Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Top_Bar_Partials')) {

    /**
     * Top Bar Section
     *
     * @since 1.0.0
     */
    class Kemet_Top_Bar_Partials
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
            add_action( 'kemet_sitehead_top' , array( $this, 'kemet_top_header_template' ), 9 );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
        }

        public function kemet_top_header_template() {
            
			kemetaddons_get_template( 'top-bar-section/templates/topbar-layout.php' );
            
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_TOPBAR_DIR.'assets/css/minified/style.min.css');

	    }

    }
}
Kemet_Top_Bar_Partials::get_instance();
