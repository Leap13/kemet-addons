<?php
/**
 * Mega menu
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Settings' ) ) {
	/**
	 * Mega menu Settings
	 */
	class Kemet_Addon_Mega_Menu_Settings {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// Add custom fields to menu.
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

			if ( isset( $menu_item->ID ) ) {
				$menu_item->megamenu                    = get_post_meta( $menu_item->ID, 'enable-mega-menu', true );
				$menu_item->megamenu_icon               = get_post_meta( $menu_item->ID, 'mega-menu-icon', true );
				$menu_item->megamenu_icon_color         = get_post_meta( $menu_item->ID, 'mega-menu-icon-color', true );
				$menu_item->megamenu_disable_link       = get_post_meta( $menu_item->ID, 'disable-link', true );
				$menu_item->megamenu                    = get_post_meta( $menu_item->ID, 'enable-mega-menu', true );
				$menu_item->megamenu_col                = get_post_meta( $menu_item->ID, 'mega-menu-columns', true );
				$menu_item->megamenu_bg_obj             = get_post_meta( $menu_item->ID, 'mega-menu-background', true );
				$menu_item->megamenu_spacing            = get_post_meta( $menu_item->ID, 'mega-menu-spacing', true );
				$menu_item->column_heading              = get_post_meta( $menu_item->ID, 'column-heading', true );
				$menu_item->megamenu_width              = get_post_meta( $menu_item->ID, 'mega-menu-width', true );
				$menu_item->megamenu_label              = get_post_meta( $menu_item->ID, 'label-text', true );
				$menu_item->megamenu_label_color        = get_post_meta( $menu_item->ID, 'label-color', true );
				$menu_item->megamenu_label_bg_color     = get_post_meta( $menu_item->ID, 'label-bg-color', true );
				$menu_item->megamenu_column_template    = get_post_meta( $menu_item->ID, 'column-template', true );
				$menu_item->megamenu_disable_item_label = get_post_meta( $menu_item->ID, 'disable-item-label', true );
				$menu_item->megamenu_item_content       = get_post_meta( $menu_item->ID, 'item-content', true );
				$menu_item->megamenu_text_color         = get_post_meta( $menu_item->ID, 'mega-menu-text-color', true );
				$menu_item->megamenu_heading_color      = get_post_meta( $menu_item->ID, 'mega-menu-heading-color', true );
				$menu_item->megamenu_link_color         = get_post_meta( $menu_item->ID, 'mega-menu-link-color', true );
				$menu_item->megamenu_item_spacing       = get_post_meta( $menu_item->ID, 'mega-menu-item-spacing', true );
				$menu_item->megamenu_items_divider      = get_post_meta( $menu_item->ID, 'mega-menu-items-divider', true );
				$menu_item->megamenu_column_divider     = get_post_meta( $menu_item->ID, 'mega-menu-column-divider', true );
				$menu_item->megamenu_border_radius      = get_post_meta( $menu_item->ID, 'mega-menu-border-radius', true );
			}

			return $menu_item;
		}

	}
}
Kemet_Addon_Mega_Menu_Settings::get_instance();
