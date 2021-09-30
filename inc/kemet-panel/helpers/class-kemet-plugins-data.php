<?php
/**
 * Panel_Plugins_Data
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Panel_Plugins_Data' ) ) {

	/**
	 * Kemet Panel
	 *
	 * @since 1.0.0
	 */
	class Kemet_Panel_Plugins_Data {

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
			add_action( 'wp_ajax_kemet-plugins-status', array( $this, 'get_plugins_status' ) );
			add_action( 'wp_ajax_kemet-install-plugin', array( $this, 'ajax_install_plugin' ) );
			add_action( 'wp_ajax_kemet-activate-plugin', array( $this, 'activate_plugin' ) );
			add_action( 'wp_ajax_kemet-deactivate-plugin', array( $this, 'deactivate_plugin' ) );
		}


		/**
		 * get_plugins
		 *
		 * @return array
		 */
		public static function get_plugins() {
			$plugins = array(
				'elementor',
				'premium-addons-for-elementor',
				'premium-blocks-for-gutenberg',
			);

			return $plugins;
		}

		/**
		 * Call plugins api
		 *
		 * @param string $slug plugin slug.
		 * @return array
		 */
		public function call_plugin_api( $slug ) {
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			$call_api = get_transient( 'about_plugin_info_' . $slug );

			if ( false === $call_api ) {
				$call_api = plugins_api(
					'plugin_information',
					array(
						'slug'   => $slug,
						'fields' => array(
							'downloaded'        => false,
							'rating'            => false,
							'description'       => true,
							'short_description' => true,
							'donate_link'       => false,
							'tags'              => false,
							'sections'          => true,
							'homepage'          => true,
							'added'             => false,
							'last_updated'      => false,
							'compatibility'     => false,
							'tested'            => false,
							'requires'          => false,
							'downloadlink'      => false,
							'icons'             => true,
							'banners'           => true,
							'name'              => true,
						),
					)
				);
				set_transient( 'about_plugin_info_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
			}

			return $call_api;
		}

		/**
		 * get_plugins_data
		 *
		 * @return array
		 */
		public function get_plugins_data() {
			$plugins = self::get_plugins();
			$data    = array();
			foreach ( $plugins as $plugin ) {
				$plugin_data     = $this->call_plugin_api( $plugin );
				$data[ $plugin ] = array(
					'name'        => $plugin_data->name,
					'description' => $plugin_data->short_description,
					'path'        => $plugin . '/' . $plugin . '.php',
				);
			}

			return $data;
		}

		/**
		 * Check if Kemet Addons is installed
		 *
		 * @param string $plugin_path plugin path.
		 * @return boolean
		 */
		public function is_addons_installed( $plugin_path ) {
			$plugins = get_plugins();

			return isset( $plugins[ $plugin_path ] );
		}

		/**
		 * get_plugins_status
		 */
		public function get_plugins_status() {
			check_ajax_referer( 'kemet-panel', 'nonce' );
			$status = $this->plugins_status();
			wp_send_json_success( $status );
		}

		/**
		 * get_plugins_status
		 */
		public function plugins_status() {
			$plugins = self::get_plugins();
			$status  = array();
			foreach ( $plugins as $plugin ) {
				$plugin_path = $plugin . '/' . $plugin . '.php';
				if ( $this->is_addons_installed( $plugin_path ) ) {
					if ( is_plugin_active( $plugin_path ) ) {
						$status[ $plugin ] = 'deactivate';
					} else {
						$status[ $plugin ] = 'activate';
					}
				} else {
					if ( current_user_can( 'install_plugins' ) ) {
						$status[ $plugin ] = 'install';
					}
				}
			}
			return $status;
		}

		/**
		 * deactivate_plugin
		 */
		public function deactivate_plugin() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$path = isset( $_POST['path'] ) ? sanitize_text_field( wp_unslash( $_POST['path'] ) ) : '';

			if ( $path ) {
				if ( is_plugin_active( $path ) ) {
					deactivate_plugins( $path );
					wp_send_json_success();
				}
			}

			wp_send_json_error();
		}

		/**
		 * activate_plugin
		 */
		public function activate_plugin() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$path = isset( $_POST['path'] ) ? sanitize_text_field( wp_unslash( $_POST['path'] ) ) : '';

			if ( $path ) {
				if ( ! is_plugin_active( $path ) ) {
					activate_plugin( $path );
					wp_send_json_success();
				}
			}

			wp_send_json_error();
		}

		/**
		 * install_plugin
		 */
		public function ajax_install_plugin() {
			check_ajax_referer( 'kemet-panel', 'nonce' );

			$slug = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';

			if ( $slug ) {
				if ( ! is_plugin_active( $slug ) ) {
					$install = $this->install_plugin( $slug );
					if ( $install ) {
						wp_send_json_success();
					}
				}
			}

			wp_send_json_error();
		}

		/**
		 * install_plugin
		 *
		 * @param  string $plugin_slug
		 */
		public function install_plugin( $plugin_slug ) {
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin_slug,
					'fields' => array( 'sections' => false ),
				)
			);

			if ( is_wp_error( $api ) ) {
				return false;
			}
			if ( ! class_exists( 'Plugin_Upgrader' ) ) {
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			}
			if ( ! class_exists( 'Kemet_Plugin_Installer_Skin' ) ) {
				require_once KEMET_PANEL_DIR . 'helpers/class-kemet-plugin-installer-skin.php';
			}
			$upgrader       = new Plugin_Upgrader(
				new Kemet_Plugin_Installer_Skin(
					array(
						'nonce'  => 'install-plugin_' . $plugin_slug,
						'plugin' => $plugin_slug,
						'api'    => $api,
					)
				)
			);
			$install_result = $upgrader->install( $api->download_link );
			if ( ! $install_result || is_wp_error( $install_result ) ) {
				// $install_result can be false if the file system isn't writeable.
				return false;
			}
			$plugin_path = $plugin_slug . '/' . $plugin_slug . '.php';

			return true;
		}
	}
}

new Kemet_Panel_Plugins_Data();
