<?php
/**
 * Extra Footers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Footer_Elements_Settings' ) ) {
	/**
	 * Extra Footers Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Footer_Elements_Settings {

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
			$this->customize_register();
			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
		}

		/**
		 * Default Values
		 *
		 * @param array $defaults default value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {
			// $defaults['']   = '';

			return $defaults;
		}

		/**
		 * Customizer Options
		 */
		public function customize_register() {
			require_once KEMET_FOOTER_ELEMENTS_DIR . 'customizer/class-kemet-footer-elementor-template-customizer.php';
			require_once KEMET_FOOTER_ELEMENTS_DIR . 'customizer/class-kemet-footer-reusable-block-customizer.php';
			require_once KEMET_FOOTER_ELEMENTS_DIR . 'customizer/customizer-options.php';
		}
	}
}
Kemet_Addon_Footer_Elements_Settings::get_instance();
