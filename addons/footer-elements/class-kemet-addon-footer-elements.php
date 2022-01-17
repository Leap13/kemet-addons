<?php
/**
 * Kemet Extra Blog Layouts Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_FOOTER_ELEMENTS_DIR', KEMET_ADDONS_DIR . 'addons/footer-elements/' );
define( 'KEMET_FOOTER_ELEMENTS_URL', KEMET_ADDONS_URL . 'addons/footer-elements/' );

if ( ! class_exists( 'Kemet_Addon_Footer_Elements' ) ) {

	/**
	 * Blog Layouts
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Footer_Elements {

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
			require_once KEMET_FOOTER_ELEMENTS_DIR . 'classes/class-kemet-addon-footer-elements-partials.php';
			require_once KEMET_FOOTER_ELEMENTS_DIR . 'classes/class-kemet-addon-footer-elements-settings.php';
			if ( ! is_admin() ) {
				require_once KEMET_FOOTER_ELEMENTS_DIR . 'classes/dynamic.css.php';
			}
		}

	}
	/**
	*  Kicking this off by calling 'get_instance()' method
	*/
	Kemet_Addon_Footer_Elements::get_instance();
}


