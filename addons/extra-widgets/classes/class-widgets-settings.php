<?php
/**
 * Go Top Settings Defaults, Customizer, Customizer Preview
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Extra_Widgets_Settings')) {

    /**
     * Go Top Section
     *
     * @since 1.0.0
     */
    class Kemet_Extra_Widgets_Settings
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
        
        function customize_register($wp_customize) {
			require_once KEMET_WIDGETS_DIR . 'classes/helper.php';  
			
        }
        
    }
}
Kemet_Extra_Widgets_Settings::get_instance();
