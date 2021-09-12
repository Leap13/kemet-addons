<?php
/**
 * Extra Headers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Single_Post_Settings' ) ) {

	/**
	 * Single Post Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Single_Post_Settings {

		/**
		 * Instance
		 *
		 * @var object
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
			$this->customize_register();
			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['single-post-featured-image-width']  = '';
			$defaults['single-post-featured-image-height'] = '';
			return $defaults;
		}

		/**
		 * Customizer options register
		 */
		public function customize_register() {
			require_once KEMET_SINGLE_POST_DIR . 'customizer/customizer-options.php';

		}
	}
}
Kemet_Addon_Single_Post_Settings::get_instance();
