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
			require_once KEMET_EXTRA_BLOCKS_DIR . 'breadcrumbs/index.php';
			add_filter( 'block_categories_all', array( $this, 'add_new_block_category' ), 10, 2 );
		}

		/**
		 * Adding a new (custom) block category.
		 *
		 * @param   array                   $block_categories                         Array of categories for block types.
		 * @param   WP_Block_Editor_Context $block_editor_context   The current block editor context.
		 */
		function add_new_block_category( $block_categories, $block_editor_context ) {
			// You can add extra validation such as seeing which post type
			// is used to only include categories in some post types.
			// if ( in_array( $block_editor_context->post->post_type, ['post', 'my-post-type'] ) ) { ... }
			return array_merge(
				$block_categories,
				array(
					array(
						'slug'  => 'kemet',
						'title' => esc_html__( 'Kemet', 'kemet-addons' ),
					),
				)
			);
		}

	}
	Kemet_Addon_Extra_Blocks::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
