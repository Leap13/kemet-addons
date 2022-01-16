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
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );
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
			?>
			<div class="kmt-header-elementor-template">
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
			?>
			<div class="kmt-header-reusable-block">
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
				'kemet-addons-header-elements-script',
				KEMET_HEADER_ELEMENTS_URL . 'assets/js/build/index.js',
				array(
					'wp-i18n',
					'wp-components',
					'wp-element',
				),
				KEMET_ADDONS_VERSION,
				true
			);

			wp_localize_script(
				'kemet-addons-header-elements-script',
				'kemetHeaderElements',
				array(
					'ajax_url'       => admin_url( 'admin-ajax.php' ),
					'ajax_nonce'     => wp_create_nonce( 'kemet-addons-header-elements' ),
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
Kemet_Addon_Header_Elements_Partials::get_instance();
