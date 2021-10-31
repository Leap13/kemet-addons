<?php
/**
 * Mega menu
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Partials' ) ) {

	/**
	 * Mega menu addon partials
	 */
	class Kemet_Addon_Mega_Menu_Partials {

		/**
		 * Mega Menu Style
		 *
		 * @var string
		 */
		private static $mega_menu_style = '';

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Meta values
		 *
		 * @var array meta_values
		 */
		private static $meta_values = array();

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
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
			add_filter( 'wp_nav_menu_args', array( $this, 'nav_menu_args' ) );
			add_filter( 'wp_footer', array( $this, 'megamenu_style' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'update_meta_values_array' ) );
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'custom_field' ), 10, 5 );
			add_action( 'wp_ajax_kemet_addons_menu_item_settings', array( $this, 'get_item_gettings' ) );
			add_action( 'wp_ajax_kemet_addons_menu_update_item_settings', array( $this, 'update_item_gettings' ) );
			add_action( 'wp_ajax_kemet_addons_parent_menu_item_settings', array( $this, 'get_parent_item_gettings' ) );
		}

		/**
		 * get_options
		 *
		 * @return void
		 */
		public function get_parent_item_gettings() {
			check_ajax_referer( 'kemet-addons-mega-menu', 'nonce' );

			$parent_id = isset( $_POST['parent_id'] ) ? sanitize_text_field( wp_unslash( $_POST['parent_id'] ) ) : '';

			$data = array();
			if ( $parent_id ) {
				$data['enable-mega-menu'] = get_post_meta( $parent_id, 'enable-mega-menu', true );
				wp_send_json_success(
					array(
						'success' => true,
						'values'  => $data,
					)
				);
			}

			wp_send_json_error();
		}

		/**
		 * get_options
		 *
		 * @return void
		 */
		public function get_item_gettings() {
			check_ajax_referer( 'kemet-addons-mega-menu', 'nonce' );

			$item_id = isset( $_POST['item_id'] ) ? sanitize_text_field( wp_unslash( $_POST['item_id'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			if ( $item_id && '' !== $item_id ) {
				$data = $this->get_item_meta_values( $item_id );

				wp_send_json_success(
					array(
						'success' => true,
						'values'  => $data,
					)
				);
			}

			wp_send_json_error();
		}

		/**
		 * update_options
		 *
		 * @return void
		 */
		public function update_item_gettings() {
			check_ajax_referer( 'kemet-addons-mega-menu', 'nonce' );

			$item_id = isset( $_POST['item_id'] ) ? sanitize_text_field( wp_unslash( $_POST['item_id'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$data    = isset( $_POST['data'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['data'] ) ), true ) : array();

			if ( $item_id && ! empty( $data ) ) {
				$this->update_item_meta_values( $item_id, $data );
			}

			wp_send_json_success(
				array(
					'success' => true,
				)
			);
		}

		/**
		 * update_item_meta_values
		 *
		 * @param  int   $item_id
		 * @param  array $values
		 */
		public function update_item_meta_values( $item_id, $values ) {
			foreach ( $values as $key => $value ) {
				update_post_meta( $item_id, $key, $value );
			}
		}

		/**
		 * get_item_meta_values
		 *
		 * @param  int $item_id
		 * @return array
		 */
		public function get_item_meta_values( $item_id ) {
			$data                             = array();
			$data['enable-mega-menu']         = get_post_meta( $item_id, 'enable-mega-menu', true );
			$data['mega-menu-icon']           = get_post_meta( $item_id, 'mega-menu-icon', true );
			$data['mega-menu-icon-color']     = get_post_meta( $item_id, 'mega-menu-icon-color', true );
			$data['disable-link']             = get_post_meta( $item_id, 'disable-link', true );
			$data['enable-mega-menu']         = get_post_meta( $item_id, 'enable-mega-menu', true );
			$data['mega-menu-columns']        = get_post_meta( $item_id, 'mega-menu-columns', true );
			$data['mega-menu-background']     = get_post_meta( $item_id, 'mega-menu-background', true );
			$data['mega-menu-spacing']        = get_post_meta( $item_id, 'mega-menu-spacing', true );
			$data['column-heading']           = get_post_meta( $item_id, 'column-heading', true );
			$data['mega-menu-width']          = get_post_meta( $item_id, 'mega-menu-width', true );
			$data['label-text']               = get_post_meta( $item_id, 'label-text', true );
			$data['label-color']              = get_post_meta( $item_id, 'label-color', true );
			$data['label-bg-color']           = get_post_meta( $item_id, 'label-bg-color', true );
			$data['column-template']          = get_post_meta( $item_id, 'column-template', true );
			$data['disable-item-label']       = get_post_meta( $item_id, 'disable-item-label', true );
			$data['item-content']             = get_post_meta( $item_id, 'item-content', true );
			$data['mega-menu-text-color']     = get_post_meta( $item_id, 'mega-menu-text-color', true );
			$data['mega-menu-heading-color']  = get_post_meta( $item_id, 'mega-menu-heading-color', true );
			$data['mega-menu-link-color']     = get_post_meta( $item_id, 'mega-menu-link-color', true );
			$data['mega-menu-item-spacing']   = get_post_meta( $item_id, 'mega-menu-item-spacing', true );
			$data['mega-menu-column-divider'] = get_post_meta( $item_id, 'mega-menu-column-divider', true );
			$data['mega-menu-items-divider']  = get_post_meta( $item_id, 'mega-menu-items-divider', true );
			$data['mega-menu-border-radius']  = get_post_meta( $item_id, 'mega-menu-border-radius', true );

			return $data;
		}

		/**
		 * custom_field
		 *
		 * @param  int      $item_id
		 * @param  WP_Post  $item
		 * @param  int      $depth
		 * @param  stdClass $args
		 * @param  int      $id
		 */
		function custom_field( $item_id, $item, $depth, $args, $id ) { ?>
			<p class="kmt-menu-item-settings description-wide" data-item-id="<?php echo esc_attr( $item_id ); ?>" data-nav-id="<?php echo esc_attr( $id ); ?>">
				<button class="button"><?php echo esc_html__( 'Kemet Menu settings', 'kemet-addons' ); ?></button>
			</p>
			<?php
		}

		/**
		 * Update menu item values
		 *
		 * @param object $item menu item object.
		 * @return object
		 */
		public function update_meta_values_array( $item ) {

			if ( isset( $item->ID ) ) {
				$template = get_post_meta( $item->ID, 'column-template', true );

				if ( ! empty( $template ) ) {
					self::$meta_values[ $item->ID ] = $template;
				}
			}

			return $item;

		}

		/**
		 * Nav menu arguments
		 *
		 * @param object $args menu arguments.
		 * @return object
		 */
		public function nav_menu_args( $args ) {

			if ( 'primary-menu' == $args['theme_location'] || 'secondary-menu' == $args['theme_location'] ) {
				$args['walker'] = new Kemet_Addon_Mega_Menu_Walker_Nav_Menu();
			}

			return $args;
		}

		/**
		 * Admin styles & scripts
		 *
		 * @return void
		 */
		public function admin_script() {

			$css_prefix = '.min.css';
			$js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}

			wp_enqueue_script(
				'kemet-addons-megamenu-js',
				KEMET_MEGA_MENU_URL . 'assets/js/build/index.js',
				array(
					'jquery',
					'kemet-addons-select2',
				),
				KEMET_ADDONS_VERSION,
				true
			);

			wp_enqueue_style( 'kemet-addons-mega-menu-css', KEMET_MEGA_MENU_URL . 'assets/css/' . $dir . '/mega-menu' . $css_prefix, KEMET_ADDONS_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

			wp_localize_script(
				'kemet-addons-megamenu-js',
				'kemetMegaMenu',
				apply_filters(
					'kemet_addons_mega_menu_js_localize',
					array(
						'ajax_url'            => admin_url( 'admin-ajax.php' ),
						'ajax_nonce'          => wp_create_nonce( 'kemet-addons-mega-menu' ),
						'options'             => Kemet_Addon_Mega_Menu_Options::get_instance()->get_item_fields(),
						'template_meta_value' => self::$meta_values,
						'ajax_title_nonce'    => wp_create_nonce( 'kemet-addons-ajax-get-title' ),
						'select2_ajax_nonce'  => wp_create_nonce( 'kemet-addons-ajax-get-post' ),
						'search'              => __( 'Templates / Reusable Blocks', 'kemet-addons' ),
						'edit_post_link'      => admin_url( '/edit.php?post_type=post_name' ),
						'posts_count'         => array(
							'elementor_library'    => post_type_exists( 'elementor_library' ) ? wp_count_posts( 'elementor_library' )->publish : 0,
							'wp_block'             => post_type_exists( 'wp_block' ) ? wp_count_posts( 'wp_block' )->publish : 0,
							'kemet_custom_layouts' => post_type_exists( 'kemet_custom_layouts' ) ? wp_count_posts( 'kemet_custom_layouts' )->publish : 0,
						),
						'posts'               => array(
							'elementor_library'    => $this->get_all_posts( 'elementor_library' ),
							'wp_block'             => $this->get_all_posts( 'wp_block' ),
							'kemet_custom_layouts' => $this->get_all_posts( 'kemet_custom_layouts' ),
						),
					)
				)
			);
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
		 * Enqueues scripts and styles for the mega menu
		 *
		 * @return void
		 */
		public function add_styles() {
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}
			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}

			Kemet_Style_Generator::kmt_add_css( KEMET_MEGA_MENU_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}

		/**
		 * Append CSS style to class variable.
		 *
		 * @param string $style Inline style string.
		 * @return void
		 */
		public static function add_css( $style ) {
			self::$mega_menu_style .= $style;
		}

		/**
		 * Print inline CSS to footer.
		 *
		 * @return void
		 */
		public function megamenu_style() {

			if ( '' != self::$mega_menu_style ) {
				printf( "<style type='text/css' class='kemet-megamenu-inline-style'>%s</style>", esc_attr( self::$mega_menu_style ) );
			}
		}

		/**
		 * Scripts
		 *
		 * @return void
		 */
		public function add_scripts() {

			$js_prefix = '.min.js';
			$dir       = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix = '.js';
				$dir       = 'unminified';
			}

			Kemet_Style_Generator::kmt_add_js( KEMET_MEGA_MENU_DIR . 'assets/js/' . $dir . '/mega-menu' . $js_prefix );
		}

		/**
		 * Add admin Scripts
		 */
		public function enqueue_scripts() {

			$menu_locations = get_nav_menu_locations();

			foreach ( $menu_locations as $menu_id ) {
				$nav_items = wp_get_nav_menu_items( $menu_id );

				if ( ! empty( $nav_items ) ) {
					foreach ( $nav_items as $nav_item ) {

						if ( isset( $nav_item->megamenu_column_template ) && '' != $nav_item->megamenu_column_template ) {

							$template_id = explode( '-', $nav_item->megamenu_column_template );
							$template_id = $template_id[1];

							if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
								$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
								$custom_layout_compat->enqueue_scripts( $template_id );
							}
						}
					}
				}
			}
		}
	}
}
Kemet_Addon_Mega_Menu_Partials::get_instance();
