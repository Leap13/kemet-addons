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
			require_once KEMET_PANEL_DIR . 'helpers/class-kemet-plugins-data.php';
			add_action( 'wp_ajax_kemet-panel-update-option', array( $this, 'update_option' ) );
			add_action( 'admin_menu', array( $this, 'register_custom_menu_page' ), 99 );
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_item' ), 500 );
			add_action( 'enable_kemet_admin_menu_item', '__return_true' );
		}

		/**
		 * Add kemet panel to admin bar
		 *
		 * @param WP_Admin_Bar $admin_bar admin bar.
		 * @return void
		 */
		public function admin_bar_item( WP_Admin_Bar $admin_bar ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			$admin_bar->add_menu(
				array(
					'id'     => 'menu-id',
					'parent' => null,
					'group'  => null,
					'title'  => __( 'Kemet', 'kemet-addons' ), // you can use img tag with image link. it will show the image icon Instead of the title.
					'href'   => admin_url( 'admin.php?page=kemet_panel' ),
					'meta'   => array(
						'title' => __( 'Kemet', 'kemet-addons' ), // This title will show on hover.
					),
				)
			);
		}

		/**
		 * Add kemet panel menu
		 *
		 * @return void
		 */
		public function register_custom_menu_page() {
			$page = add_submenu_page( 'kemet_panel', __( 'Settings', 'kemet-addons' ), __( 'Settings', 'kemet-addons' ), 'manage_options', 'kemet_panel', array( $this, 'render' ), null );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_admin_script' ) );
		}

		/**
		 * Render panel html
		 *
		 * @return void
		 */
		public function render() { ?>
			<div id="kmt-dashboard">
				
			</div>
			<?php
		}

		/**
		 * update_option
		 *
		 * @return void
		 */
		public function update_option() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$option  = isset( $_POST['option'] ) ? sanitize_text_field( wp_unslash( $_POST['option'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$value   = isset( $_POST['value'] ) ? sanitize_text_field( wp_unslash( $_POST['value'] ) ) : '';
			$value   = 'true' === $value ? true : false;
			$options = get_option( 'kemet_addons_options' );
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
		 * get_system_info
		 *
		 * @return array
		 */
		public static function get_system_info() {
			global $wpdb;

			$info = array(
				'home_url'          => get_option( 'home' ),
				'site_url'          => get_option( 'siteurl' ),
				'version'           => get_bloginfo( 'version' ),
				'multisite'         => is_multisite(),
				'memory_limit'      => wp_convert_hr_to_bytes( WP_MEMORY_LIMIT ),
				'memory_limit_size' => size_format( wp_convert_hr_to_bytes( WP_MEMORY_LIMIT ) ),
				'theme_version'     => esc_html( KEMET_THEME_VERSION ),
				'wp_path'           => esc_html( ABSPATH ),
				'debug'             => defined( 'WP_DEBUG' ) && WP_DEBUG,
				'lang'              => esc_html( get_locale() ),
				'server'            => isset( $_SERVER['SERVER_SOFTWARE'] ) ? esc_html( sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) ) : '',
				'php_version'       => function_exists( 'phpversion' ) ? phpversion() : '',
				'mysql_version'     => $wpdb->db_version(),
				'max_upload'        => esc_html( size_format( wp_max_upload_size() ) ),
				'ini_get'           => function_exists( 'ini_get' ),
			);
			if ( function_exists( 'ini_get' ) ) {
				$info['php_memory_limit']   = esc_html( size_format( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) ) );
				$info['post_max_size']      = esc_html( size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ) );
				$info['max_execution_time'] = ini_get( 'max_execution_time' );
				$info['max_input_vars']     = esc_html( ini_get( 'max_input_vars' ) );
				$info['suhosin']            = extension_loaded( 'suhosin' );
			}

			$active_plugins = (array) get_option( 'active_plugins', array() );
			$plugins        = array();
			if ( is_multisite() ) {
				$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
				$active_plugins            = array_merge( $active_plugins, $network_activated_plugins );
			}

			foreach ( $active_plugins as $plugin ) {
				$plugin_data    = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
				$dirname        = dirname( $plugin );
				$version_string = '';
				$network_string = '';

				if ( ! empty( $plugin_data['Name'] ) ) {
					$plugins[ $plugin ] = array(
						'name'    => $plugin_data['Name'],
						'author'  => $plugin_data['Author'],
						'version' => $plugin_data['Version'],

					);

					if ( ! empty( $plugin_data['PluginURI'] ) ) {
						$plugins[ $plugin ]['PluginURI'] = $plugin_data['PluginURI'];
					}
				}
			}

			$info['active_plugins'] = $plugins;

			return $info;
		}

		/**
		 * panel_options
		 *
		 * @return array
		 */
		public static function panel_options() {
			$options = array(
				'options' => array(
					'blog-layouts'        => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Blog Layouts', 'kemet-addons' ),
						'description' => __( 'Enable/Disable Extra Blog Layouts.', 'kemet-addons' ),
					),
					'custom-layout'       => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Custom Layout', 'kemet-addons' ),
						'description' => __( 'Enable/Disable custom layout option that will allow you to create your own custom content, script, or code on various hook locations.', 'kemet-addons' ),
					),
					'mega-menu'           => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Mega Menu', 'kemet-addons' ),
						'description' => __( 'Enable/Disable Mega Menu', 'kemet-addons' ),
					),
					'custom-fonts'        => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Custom Fonts', 'kemet-addons' ),
						'description' => __( 'Enable/Disable Custom fonts.', 'kemet-addons' ),
					),
					'woocommerce'         => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Woocommerce', 'kemet-addons' ),
						'description' => __( 'Enable/Disable the extra options that allows you to control & customize WooCommerce product page and product listing.', 'kemet-addons' ),
					),
					'reset-import-export' => array(
						'type'        => 'kmt-switcher',
						'label'       => __( 'Customizer Reset, Import, and Export Buttons', 'kemet-addons' ),
						'description' => __( 'Enable/Disable the import, export and reset buttons that will give you the ability to apply any of those actions to the customizer settings.', 'kemet-addons' ),
					),
				),
			);
			return apply_filters( 'kemet_panel_options', $options );
		}

		/**
		 * Enqueue a script in the WordPress admin on edit.php
		 *
		 * @param string $hook current location.
		 * @return void
		 */
		public function enqueue_admin_script() {
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
			wp_enqueue_style( 'kemet-panel-css', KEMET_PANEL_URL . 'assets/css/' . $dir . '/kemet-panel' . $css_prefix, false, KEMET_ADDONS_VERSION );
			wp_enqueue_script(
				'kemet-panel-js',
				KEMET_PANEL_URL . 'assets/js/build/index.js',
				array(
					'wp-i18n',
					'wp-components',
					'wp-element',
					'wp-media-utils',
					'wp-block-editor',
				),
				KEMET_THEME_VERSION,
				true
			);

			wp_localize_script(
				'kemet-panel-js',
				'KemetPanelData',
				array(
					'options'       => self::panel_options(),
					'values'        => array(
						'options' => get_option( 'kemet_addons_options', array() ),
					),
					'nonce'         => wp_create_nonce( 'kemet-panel' ),
					'ajaxurl'       => admin_url( 'admin-ajax.php' ),
					'plugins_data'  => Kemet_Panel_Plugins_Data::get_instance()->get_plugins_data(),
					'plugins_cache' => Kemet_Panel_Plugins_Data::get_instance()->plugins_status(),
					'system_info'   => self::get_system_info(),
				)
			);
		}
	}
	Kemet_Addons_Panel::get_instance();
}
