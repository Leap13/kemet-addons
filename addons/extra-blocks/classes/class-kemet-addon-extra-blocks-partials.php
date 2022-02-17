<?php
/**
 * Extra Blocks
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Extra_Blocks_Partials' ) ) {
	/**
	 * Kemet Addon Extra Blocks
	 */
	class Kemet_Addon_Extra_Blocks_Partials {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
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
			require_once KEMET_EXTRA_BLOCKS_DIR . 'breadcrumbs/index.php';
		}
	}
}
Kemet_Addon_Extra_Blocks_Partials::get_instance();
