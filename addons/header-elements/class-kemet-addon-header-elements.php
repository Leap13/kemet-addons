<?php
/**
 * Kemet Extra Blog Layouts Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_HEADER_ELEMENTS_DIR', KEMET_ADDONS_DIR . 'addons/header-elements/' );
define( 'KEMET_HEADER_ELEMENTS_URL', KEMET_ADDONS_URL . 'addons/header-elements/' );

if ( ! class_exists( 'Kemet_Addon_Header_Elements' ) ) {

	/**
	 * Blog Layouts
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Header_Elements {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Instance
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
			require_once KEMET_HEADER_ELEMENTS_DIR . 'classes/class-kemet-addon-header-elements-partials.php';
			require_once KEMET_HEADER_ELEMENTS_DIR . 'classes/class-kemet-addon-header-elements-settings.php';
			if ( ! is_admin() ) {
				require_once KEMET_HEADER_ELEMENTS_DIR . 'classes/dynamic.css.php';
			}
		}

	}
	/**
	*  Kicking this off by calling 'get_instance()' method
	*/
	Kemet_Addon_Header_Elements::get_instance();
}


