<?php
/**
 * Blog Layouts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Header_Elements_Partials' ) ) {

	/**
	 * Class Kemet_Addon_Header_Elements_Partials
	 */
	class Kemet_Addon_Header_Elements_Partials {

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
			add_action( 'get_template_part_templates/header/components/elementor-template', array( $this, 'elementor_template' ), 10 );
			add_action( 'get_template_part_templates/header/components/reusable-block', array( $this, 'reusable_block' ), 10 );
			add_action( 'kemet_header_elemetor_template', array( $this, 'elementor_template_markup' ) );
			add_action( 'kemet_header_reusable_block', array( $this, 'reusable_block_markup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Elementor Template
		 *
		 * @return void
		 */
		public function elementor_template() {
			kemetaddons_get_template( 'header-elements/templates/elementor-template.php' );
		}

		/**
		 * Reusable Block
		 *
		 * @return void
		 */
		public function reusable_block() {
			kemetaddons_get_template( 'header-elements/templates/reusable-block.php' );
		}

		/**
		 * elementor_template_markup
		 */
		public function elementor_template_markup() {
			$visibility = kemet_get_option( 'elementor-template-visibility' );
			?>
			<div class="kmt-header-elementor-template <?php echo get_visibility_class( $visibility ); ?>">
				<?php
				$elementor_template = kemet_get_option( 'elementor-template-id' );
				if ( $elementor_template ) {
					$this->render_template_content( $elementor_template );
				} else {
					$html_args = kemet_allowed_html( array( 'span' ) );
					echo wp_kses(
						'<span>' . __( 'Add Elemetor Template Here', 'kemet-addons' ) . '</span>',
						$html_args
					);
				}
				?>
			</div>
			<?php
		}

		/**
		 * reusable_block_markup
		 */
		public function reusable_block_markup() {
			$visibility = kemet_get_option( 'reusable-block-visibility' );
			?>
			<div class="kmt-header-reusable-block <?php echo get_visibility_class( $visibility ); ?>">
				<?php
				$reusable_block = kemet_get_option( 'reusable-block-id' );
				if ( $reusable_block ) {
					$this->render_template_content( $reusable_block );
				} else {
					$html_args = kemet_allowed_html( array( 'span' ) );
					echo wp_kses(
						'<span>' . __( 'Add Reusable Block Here', 'kemet-addons' ) . '</span>',
						$html_args
					);
				}
				?>
			</div>
			<?php
		}

		/**
		 * render_template_content
		 *
		 * @param  int $post_id
		 * @return void
		 */
		public function render_template_content( $post_id ) {
			if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
				$template_id          = explode( '-', $post_id );
				$template_id          = $template_id[1];
				$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
				$custom_layout_compat->render_content( $template_id );
			}
		}

		/**
		 * Add admin Scripts
		 */
		public function enqueue_scripts() {
			$elementor_template = kemet_get_option( 'elementor-template-id' );
			$reusable_block     = kemet_get_option( 'reusable-block-id' );
			if ( $elementor_template ) {
				$this->add_template_script( $elementor_template );
			}
			if ( $reusable_block ) {
				$this->add_template_script( $reusable_block );
			}
		}

		/**
		 * add_template_script
		 *
		 * @param  int $post_id
		 * @return void
		 */
		public function add_template_script( $post_id ) {
			if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
				$template_id          = explode( '-', $post_id );
				$template_id          = $template_id[1];
				$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
				$custom_layout_compat->enqueue_scripts( $template_id );
			}
		}
	}
}
Kemet_Addon_Header_Elements_Partials::get_instance();
