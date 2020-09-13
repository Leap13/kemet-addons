<?php 
/**
 * Kemet Custom Layout Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_CUSTOM_LAYOUT_DIR', KEMET_ADDONS_DIR . 'addons/custom-layout/' );
define( 'KEMET_CUSTOM_LAYOUT_URL', KEMET_ADDONS_URL . 'addons/custom-layout/' );
define( 'KEMET_CUSTOM_LAYOUT_POST_TYPE', 'kemet_custom_layouts' );

if ( ! class_exists( 'Kemet_Custom_Layout' ) ) {

	/**
	 * Custom Layout
	 *
	 */
	class Kemet_Custom_Layout {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
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

		/**
		 *  Constructor
		 */
		
		public function __construct() {

			require_once KEMET_CUSTOM_LAYOUT_DIR . 'classes/class-custom-layout-page-builder-compatiblity.php';
			require_once KEMET_CUSTOM_LAYOUT_DIR . 'classes/class-custom-layout-settings.php';
			require_once KEMET_CUSTOM_LAYOUT_DIR . 'classes/class-custom-layout-partials.php';
			require_once KEMET_CUSTOM_LAYOUT_DIR . 'classes/class-custom-layout-meta.php';
            
		}

	}
    Kemet_Custom_Layout::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
