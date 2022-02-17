<?php
/**
 * Extra Customizer Controls
 *
 * @package Kemet Addons
 */
$enabled_addon = apply_filters( 'kemet_addons_options', get_option( 'kemet_addons_options', array() ) );
// if ( ! $enabled_addon['header-elements'] && ! $enabled_addon['footer-elements'] ) {
// return;
// }
define( 'KEMET_EXTRA_CUSTOMIZER_CONTROLS_DIR', KEMET_ADDONS_DIR . 'inc/extra-customizer-controls/' );
define( 'KEMET_EXTRA_CUSTOMIZER_CONTROLS_URL', KEMET_ADDONS_URL . 'inc/extra-customizer-controls/' );

if ( ! class_exists( 'Kemet_Addons_Extra_Customizer_Controls' ) ) {

	/**
	 * Class Kemet_Addons_Extra_Customizer_Controls
	 */
	class Kemet_Addons_Extra_Customizer_Controls {

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
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_admin_script' ), 99 );
		}

		/**
		 * get_all_posts
		 *
		 * @param  string $post_type
		 * @return array
		 */
		public function get_all_posts( $post_type ) {
			$data  = array();
			$query = new WP_Query(
				array(
					'post_type'      => $post_type,
					'posts_per_page' => -1,
				)
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$title                 = get_the_title();
					$title                .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
					$id                    = get_the_id();
					$data[ 'post-' . $id ] = $title;
				}
			}

			return $data;
		}

		/**
		 * Customizer Scripts
		 */
		public function enqueue_admin_script() {
			wp_enqueue_script(
				'kemet-addons-extra-customizer-controls',
				KEMET_EXTRA_CUSTOMIZER_CONTROLS_URL . 'js/build/index.js',
				array(
					'wp-i18n',
					'wp-components',
					'wp-element',
				),
				KEMET_ADDONS_VERSION,
				true
			);

			wp_localize_script(
				'kemet-addons-extra-customizer-controls',
				'kemetAddonsExtraCustomizerControls',
				array(
					'ajax_url'       => admin_url( 'admin-ajax.php' ),
					'ajax_nonce'     => wp_create_nonce( 'kemet-addons-footer-elements' ),
					'edit_post_link' => admin_url( '/edit.php?post_type=post_name' ),
					'posts_count'    => array(
						'elementor_library' => post_type_exists( 'elementor_library' ) ? wp_count_posts( 'elementor_library' )->publish : 0,
						'wp_block'          => post_type_exists( 'wp_block' ) ? wp_count_posts( 'wp_block' )->publish : 0,
					),
					'posts'          => array(
						'elementor_library' => $this->get_all_posts( 'elementor_library' ),
						'wp_block'          => $this->get_all_posts( 'wp_block' ),
					),
				)
			);
		}
	}
}
Kemet_Addons_Extra_Customizer_Controls::get_instance();
