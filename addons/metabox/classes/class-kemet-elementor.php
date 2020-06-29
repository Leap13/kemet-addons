<?php
/**
 * Elementor Compatibility File.
 *
 * @package Kemet
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Kemet Elementor Compatibility
 */
if ( ! class_exists( 'Kemet_Elementor' ) ) :

	/**
	 * Kemet Elementor Compatibility
	 *
	 * @since 1.0.5
	 */
	class Kemet_Elementor {

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
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp', array( $this, 'elementor_default_setting' ), 20 );
			add_action( 'elementor/preview/init', array( $this, 'elementor_default_setting' ) );
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'elementor_overlay_zindex' ) );
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_elementor_compatibility_styles' ) );
			add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_elementor_compatibility_styles' ) );
		}

		/**
		 * Compatibility CSS for Elementor Headings after Elementor-v2.9.9
		 *
		 * In v2.9.9 Elementor has removed [ .elementor-widget-heading .elementor-heading-title { margin: 0 } ] this CSS.
		 * Again in v2.9.10 Elementor added this as .elementor-heading-title { margin: 0 } but still our [ .entry-content heading { margin-bottom: 20px } ] CSS overrding their fix.
		 *
		 * That's why adding this CSS fix to headings by setting bottom-margin to 0.
		 *
		 * @return void
		 * @since  2.4.5
		 */
		public function enqueue_elementor_compatibility_styles() {
			?>
				<style type="text/css" id="kmt-elementor-compatibility-css">
					.elementor-widget-heading .elementor-heading-title {
						margin: 0;
					}
				</style>
			<?php
		}

		/**
		 * Elementor Content layout set as Page Builder
		 *
		 * @return void
		 * @since  1.0.5
		 */
		public function elementor_default_setting() {

			if ( 'post' == get_post_type() ) {
				return;
			}

			// don't modify post meta settings if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			global $post;
			$id = kemet_get_post_id();
			
			if ( isset( $post ) && ( is_admin() || is_singular() ) ) {
				
				if ( $this->is_elementor_activated( $id ) ) {
					
					$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            		$content_layout = ( isset( $meta['site-content-layout'] ) ) ? $meta['site-content-layout'] : '';

					if ( empty( $content_layout ) ) {
						$meta['site-content-layout'] = 'page-builder';
						update_post_meta( $id, 'kemet_page_options', $meta );
					}

					add_filter(
						'kemet_get_content_layout',
						function () {
							return 'page-builder';
						}
					);
				}
			}
		}

		/**
		 * Add z-index CSS for elementor's drag drop
		 *
		 * @return void
		 * @since  1.0.5
		 */
		public function elementor_overlay_zindex() {

			// return if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			?>
			<style type="text/css" id="kmt-elementor-overlay-css">
				.elementor-editor-active .elementor-element > .elementor-element-overlay {
					z-index: 9999;
				}
			</style>

			<?php
		}

		/**
		 * Check is elementor activated.
		 *
		 * @param int $id Post/Page Id.
		 * @return boolean
		 */
		public function is_elementor_activated( $id ) {
			
			if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
				
				return ( 'builder' === Plugin::$instance->db->get_edit_mode( $id ) );
			} else {
				
				return Plugin::$instance->db->is_built_with_elementor( $id );
			}
		}

		/**
		 * Check if Elementor Editor is open.
		 *
		 * @since  1.0.5
		 *
		 * @return boolean True IF Elementor Editor is loaded, False If Elementor Editor is not loaded.
		 */
		private function is_elementor_editor() {
			if ( ( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) || isset( $_REQUEST['elementor-preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return true;
			}

			return false;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Elementor::get_instance();
