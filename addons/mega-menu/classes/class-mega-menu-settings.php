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

			// Add custom fields to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_fields_meta' ) );
		}
		
		/**
		 * Add custom menu style fields data to the menu.
		 *
		 * @access public
		 * @param object $menu_item A single menu item.
		 * @return object The menu item.
		 */
		public function add_custom_fields_meta( $menu_item ) {
			$menu_item->megamenu 					= get_post_meta( $menu_item->ID, 'enable-mega-menu', true );
			$menu_item->icon 					= get_post_meta( $menu_item->ID, 'mega-menu-icon', true );
			$menu_item->megamenu_disable_link  = get_post_meta( $menu_item->ID, 'disable-link', true );
			$menu_item->megamenu 			= get_post_meta( $menu_item->ID, 'enable-mega-menu', true );
			$menu_item->megamenu_col 	= get_post_meta( $menu_item->ID, 'mega-menu-columns', true );
			$menu_item->megamenu_bg_obj 	= get_post_meta( $menu_item->ID, 'mega-menu-background', true );
			$menu_item->megamenu_width 	= get_post_meta( $menu_item->ID, 'mega-menu-width', true );

			return $menu_item;
		}

    }
}
Kemet_Mega_Menu_Settings::get_instance();