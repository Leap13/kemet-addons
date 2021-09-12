<?php
/**
 * Extra Headers
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Blog_Layouts_Settings' ) ) {
	/**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
	class Kemet_Blog_Layouts_Settings {

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
			add_action( 'kemet_pagination_infinite', 'kemet_entry_content_blog_template' );
		}

		/**
		 * Default Values
		 *
		 * @param array $defaults default value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {
			$defaults['blog-pagination-border-color']   = '';
			$defaults['blog-infinite-loader-color']     = '';
			$defaults['blog-infinite-scroll-last-text'] = __( 'No more posts to show.', 'kemet-addons' );
			$defaults['load-more-style']                = 'dots';
			$defaults['load-more-text']                 = 'Load More';
			$defaults['blog-featured-image-width']      = '';
			$defaults['blog-featured-image-height']     = '';

			return $defaults;
		}

		/**
		 * Customizer Options
		 */
		public function customize_register() {
			require_once KEMET_BLOG_LAYOUTS_DIR . 'customizer/customizer-options.php';
		}
	}
}
Kemet_Blog_Layouts_Settings::get_instance();
