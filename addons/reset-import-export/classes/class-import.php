<?php

/**
* A class that handle customizer import.
*/

class Import{
    /**
    * An instance of WP_Customize_Manager.
    *
    * @access private
    * @var object $wp_customize
    */
    private $wp_customize;

    /**
    * Class constructor
    *
    * @param object $wp_customize `WP_Customize_Manager` instance.
    */

    public function __construct( $wp_customize = null ) {
        $this->wp_customize = $wp_customize;
        add_action( 'admin_init', array( $this, 'import' ) );
    }

    /**
    * Import the customizer.
    */

    public function import() {

			if ( ! isset( $_POST['kemet_import_nonce'] ) || ! wp_verify_nonce( $_POST['kemet_import_nonce'], 'kemet_import_nonce' ) ) {
				return;
			}
			if ( empty( $_POST['kemet_ie_action'] ) || 'import_settings' !== $_POST['kemet_ie_action'] ) {
				return;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$filename = $_FILES['import_file']['name'];

			if ( empty( $filename ) ) {
				return;
			}
			$file_ext = explode( '.', $filename );
			$extension = end( $file_ext );

			if ( 'json' !== $extension ) {
				wp_die( esc_html__( 'Please upload a valid .json file', 'kemet-import-export' ) );
			}

			$import_file = $_FILES['import_file']['tmp_name'];

			if ( empty( $import_file ) ) {
				wp_die( esc_html__( 'Please upload a file to import', 'kemet-import-export' ) );
			}

			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			// Retrieve the settings from the file and convert the json object to an array.
			$file_contants = $wp_filesystem->get_contents( $import_file );
			$settings      = json_decode( $file_contants, 1 );

			// Kemet addons activation.
			if ( class_exists( 'Kemet_Admin_Helper' ) ) {
				Kemet_Admin_Helper::update_admin_settings_option( '_kemet_ext_enabled_extensions', $settings['kemet-addons'] );
			}

			// Delete existing dynamic CSS cache.
			delete_option( 'kemet-settings' );

			update_option( 'kemet-settings', $settings['customizer-settings'] );

			wp_safe_redirect(
				wp_nonce_url(
					add_query_arg(
						array(
							'page'   => 'kemet',
							'status' => 'imported',
						),
						admin_url( 'themes.php' )
					),
					'kemet-import-complete'
				)
			);
			exit;
		}
    }