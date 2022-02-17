<?php
/**
 * Kemet Extra Blocks Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_EXTRA_BLOCKS_DIR', KEMET_ADDONS_DIR . 'addons/extra-blocks/' );
define( 'KEMET_EXTRA_BLOCKS_URL', KEMET_ADDONS_URL . 'addons/extra-blocks/' );

if ( ! class_exists( 'Kemet_Addon_Extra_Blocks' ) ) {

	/**
	 * Extra Blocks
	 */
	class Kemet_Addon_Extra_Blocks {

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
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// require_once KEMET_EXTRA_BLOCKS_DIR . 'classes/class-kemet-addon-extra-blocks-settings.php';
			// require_once KEMET_EXTRA_BLOCKS_DIR . 'classes/class-kemet-addon-extra-blocks-partials.php';
			require_once KEMET_EXTRA_BLOCKS_DIR . 'breadcrumbs/index.php';
		}

	}
	Kemet_Addon_Extra_Blocks::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
