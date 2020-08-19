<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Mega_Menu_Partials')) {

    class Kemet_Mega_Menu_Partials {

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
        }

    }
}
Kemet_Mega_Menu_Partials::get_instance();
