<?php
/**
 * Panel
 *
 * @package Kemet Addons
 */

define( 'KEMET_PANEL_DIR', KEMET_ADDONS_DIR . 'inc/kemet-panel/' );
define( 'KEMET_PANEL_URL', KEMET_ADDONS_URL . 'inc/kemet-panel/' );

if ( ! class_exists( 'Kemet_Addons_Panel' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Addons_Panel {

		/**
		 * Default values
		 *
		 * @var array defaults
		 */
		private $defaults = array();

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
			add_action( 'wp_ajax_kemet-panel-update-option', array( $this, 'update_option' ) );
			add_action( 'admin_menu', array( $this, 'register_custom_menu_page' ), 101 );
			add_filter( 'kemet_addons_options', array( $this, 'add_default_options' ) );
		}

		/**
		 * Add kemet panel menu
		 *
		 * @return void
		 */
		public function register_custom_menu_page() {
			if ( defined( 'KEMET_ADMIN_PAGE' ) ) {
				add_action( 'admin_print_styles-' . KEMET_ADMIN_PAGE, array( $this, 'enqueue_admin_script' ) );
			}
		}

		public function add_default_options( $options ) {
			$default_options = array(
				'header-elements'     => false,
				'footer-elements'     => false,
				'blog-layouts'        => true,
				'mega-menu'           => false,
				'custom-fonts'        => false,
				'custom-layout'       => false,
				'woocommerce'         => class_exists( 'WooCommerce' ) ? true : false,
				'reset-import-export' => false,
			);

			return array_merge( $default_options, $options );
		}
		/**
		 * update_option
		 *
		 * @return void
		 */
		public function update_option() {
			check_ajax_referer( 'kemet-addons-panel', 'nonce' );

			$option  = isset( $_POST['option'] ) ? sanitize_text_field( wp_unslash( $_POST['option'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$value   = isset( $_POST['value'] ) ? sanitize_text_field( wp_unslash( $_POST['value'] ) ) : '';
			$value   = 'true' === $value ? true : false;
			$options = apply_filters( 'kemet_addons_options', get_option( 'kemet_addons_options', array() ) );
			$options = ! is_array( $options ) ? array() : $options;

			if ( '' !== $value && '' !== $option ) {
				$options[ $option ] = $value;
				update_option( 'kemet_addons_options', $options );
				wp_send_json_success(
					array(
						'success' => true,
						'values'  => $options,
					)
				);
			}

			wp_send_json_error();
		}

		/**
		 * panel_options
		 *
		 * @return array
		 */
		public static function panel_options() {
			$options = array(
				'header-elements'     => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Header Elements', 'kemet-addons' ),
					'description' => __( "Display your blog layout in a grid view or use the infinite scroll option and customize the featured images' width and height.", 'kemet-addons' ),
					'url'         => admin_url( '/customize.php?autofocus[section]=section-header-builder-layout' ),
				),
				'footer-elements'     => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Footer Elements', 'kemet-addons' ),
					'description' => __( "Display your blog layout in a grid view or use the infinite scroll option and customize the featured images' width and height.", 'kemet-addons' ),
					'url'         => admin_url( '/customize.php?autofocus[section]=section-footer-builder-layout' ),
				),
				'blog-layouts'        => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Blog Options', 'kemet-addons' ),
					'description' => __( "Display your blog layout in a grid view or use the infinite scroll option and customize the featured images' width and height.", 'kemet-addons' ),
					'url'         => admin_url( '/customize.php?autofocus[section]=section-blog' ),
				),
				'mega-menu'           => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Mega Menu', 'kemet-addons' ),
					'description' => __( 'Enrich the regular website submenu with Kemet Mega Menu that comes with powerful customization options.', 'kemet-addons' ),
				),
				'custom-fonts'        => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Custom Fonts', 'kemet-addons' ),
					'description' => __( 'Upload and use your own custom font(s) across your Kemet website. And, you can use Adobe Fonts Kit within Kemet Theme.', 'kemet-addons' ),
				),
				'custom-layout'       => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Custom Content', 'kemet-addons' ),
					'description' => __( 'Enable/Disable custom content option that will allow you to create your own custom content, script, or code on various hook locations.', 'kemet-addons' ),
				),
				'woocommerce'         => array(
					'type'        => 'kmt-button',
					'label'       => __( 'WooCommerce', 'kemet-addons' ),
					'description' => __( 'Enable/Disable the extra options that allows you to control & customize WooCommerce product page and product listing.', 'kemet-addons' ),
					'url'         => admin_url( '/customize.php?autofocus[section]=woocommerce_product_catalog' ),
				),
				'reset-import-export' => array(
					'type'        => 'kmt-button',
					'label'       => __( 'Reset, Import, and Export', 'kemet-addons' ),
					'description' => __( 'Enable/Disable the import, export and reset buttons that will give you the ability to apply any of those actions to the customizer settings.', 'kemet-addons' ),
					'url'         => admin_url( 'customize.php' ),
				),
			);
			return apply_filters( 'kemet_addons_panel_options', $options );
		}

		/**
		 * Enqueue a script in the WordPress admin on edit.php
		 *
		 * @param string $hook current location.
		 * @return void
		 */
		public function enqueue_admin_script() {
			wp_enqueue_script(
				'kemet-addons-panel-js',
				KEMET_PANEL_URL . 'assets/js/build/index.js',
				array(
					'wp-i18n',
					'wp-components',
					'wp-element',
				),
				KEMET_THEME_VERSION,
				true
			);

			wp_localize_script(
				'kemet-addons-panel-js',
				'KemetAddonsPanelData',
				array(
					'options'        => self::panel_options(),
					'values'         => apply_filters( 'kemet_addons_options', get_option( 'kemet_addons_options', array() ) ),
					'nonce'          => wp_create_nonce( 'kemet-addons-panel' ),
					'ajaxurl'        => admin_url( 'admin-ajax.php' ),
					'customizer_url' => esc_url( admin_url( 'customize.php' ) ),
				)
			);
		}
	}
	Kemet_Addons_Panel::get_instance();
}
