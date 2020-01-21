<?php
/**
 * Top Bar Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Extra_Widgets_Settings')) {


    class Kemet_Extra_Widgets_Settings {

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
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
        }


        public function customize_register( $wp_customize ) {

            require_once KEMET_WIDGETS_DIR . 'customizer/customizer-options.php';  
            require_once KEMET_WIDGETS_DIR . 'customizer/customizer-helpers.php';  
        }

        function theme_defaults( $defaults ) {
            $defaults['widgets-style']              = 'style1';
            $defaults['kemet-widget-style-color']   = '';
            return $defaults;
        }

    }
}
Kemet_Extra_Widgets_Settings::get_instance();
