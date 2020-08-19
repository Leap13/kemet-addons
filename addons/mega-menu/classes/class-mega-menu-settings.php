<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Mega_Menu_Settings' )) {
    /**
	 * mega_menu Settings
	 *
	 * @since 1.0.10
	 */
    class Kemet_Mega_Menu_Settings {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        public function __construct() {
		}
		
    }
}
Kemet_Mega_Menu_Settings::get_instance();