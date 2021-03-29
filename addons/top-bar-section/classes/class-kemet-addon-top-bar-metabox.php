<?php
/**
 * Top Bar Section
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Top_Bar_Metabox' ) ) {

	/**
	 * Top Bar Metabox
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addon_Top_Bar_Metabox {

		/**
		 * Instance
		 *
		 * @var $instance
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
		 * Constructor
		 */
		public function __construct() {
			self::add_top_bar_meta_box();
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 *
		 * @return void
		 */
		public function meta_options_hooks() {

			if ( is_singular() ) {
				add_filter( 'kemet_top_bar_enabled', array( $this, 'top_bar' ) );
			}

		}

		/**
		 * Add top bar meta
		 *
		 * @return void
		 */
		public function add_top_bar_meta_box() {

			KFW::createSection(
				'kemet_page_options', array(
					'title'        => __( 'Top Bar', 'kemet-addons' ),
					'icon'         => 'dashicons dashicons-admin-tools',
					'priority_num' => 2,
					'fields'       => array(
						array(
							'id'      => 'kemet-top-bar-display',
							'type'    => 'checkbox',
							'title'   => __( 'Disable Top Bar', 'kemet-addons' ),
							'label'   => __( 'Disable The Top Bar in The Current Page/Post.', 'kemet-addons' ),
							'default' => false,
						),
					),
				)
			);
		}

		/**
		 * Disable topbar
		 *
		 * @param boolean $defaults default value.
		 * @return boolean
		 */
		public function top_bar( $defaults ) {

			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true );

			$display_top_bar = ( isset( $meta['kemet-top-bar-display'] ) ) ? $meta['kemet-top-bar-display'] : false;

			if ( true == $display_top_bar ) {
				$defaults = false;
			}

			return $defaults;
		}
	}
}

new Kemet_Addon_Top_Bar_Metabox();
