<?php
/**
 * WooCommerce
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Woocommerce_Settings' ) ) {

	/**
	 * WooCommerce Settings
	 *
	 * @since 1.0.3
	 */
	class Kemet_Addon_Woocommerce_Settings {

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
			require_once KEMET_WOOCOMMERCE_DIR . 'customizer/customizer-options.php';
			add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
		}

		/**
		 * Customizer options default values
		 *
		 * @param object $defaults object of default values.
		 * @return object
		 */
		public function theme_defaults( $defaults ) {
			$defaults['woo-shop-quick-view-style']          = 'qv-icon';
			$defaults['woo-shop-layout']                    = 'woo-style1';
			$defaults['enable-single-ajax-add-to-cart']     = false;
			$defaults['woo-shop-off-canvas-filter-label']   = 'Filter';
			$defaults['woo-shop-enable-quick-view']         = false;
			$defaults['woo-shop-pagination-style']          = 'standard';
			$defaults['woo-shop-infinite-scroll-last-text'] = __( 'No more products to show.', 'kemet-addons' );
			$defaults['woo-shop-load-more-style']           = 'dots';
			$defaults['woo-shop-load-more-text']            = 'Load More';
			$defaults['woo-shop-product-button-typography'] = array(
				'family'         => 'Default',
				'variation'      => 'n6',
				'text-transform' => 'uppercase',
			);

			return $defaults;
		}
	}
}

Kemet_Addon_Woocommerce_Settings::get_instance();
