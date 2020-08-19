<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Mega_Menu_Options' )) {
    /**
	 * mega_menu options
	 *
	 * @since 1.0.10
	 */
    class Kemet_Mega_Menu_Options {
        
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
			$prefix = 'kemet_menu_options';

			$this->create_menu_options($prefix);
			$this->create_sections($prefix);
		}
		
		/**
		 * Create Menu Option
		 */
		public function create_menu_options($prefix)
		{
			

			KFW::createNavMenuOptions( $prefix, array(
				'data_type' => 'serialize',
				) 
			);
		}

		/**
		 * Create Sections
		 */
		public function create_sections($prefix)
		{
			KFW::createSection( $prefix, array(
				'fields' => array(

				array(
					'id'      => 'enable-mega-menu',
					'type'    => 'checkbox',
					'label'   => 'Enable Mega Menu',
					'default' => false
				),
				array(
					'id'    => 'mega-menu-width',
					'type'  => 'number',
					'title' => 'Mega Menu Width',
				),
				array(
					'id'    => 'mega-menu-columns',
					'type'  => 'number',
					'title' => 'Mega Menu Columns',
				),
				array(
					'id'    => 'mega-menu-background',
					'type'  => 'background',
					'title' => 'Mega Menu Background',
				),
				array(
					'id'      => 'disable-link',
					'type'    => 'checkbox',
					'label'   => 'Disable link',
					'default' => false
				),
				)
			  ) 
			);
		}
    }
}
Kemet_Mega_Menu_Options::get_instance();