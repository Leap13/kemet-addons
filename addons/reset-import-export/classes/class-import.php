<?php

/**
* A class that handle customizer import.
*/

class Import {
    /**
    * An instance of WP_Customize_Manager.
    *
    * @access private
    * @var object $wp_customize
    */
    //private $wp_customize;

    /**
    * Class constructor
    *
    * @param object $wp_customize `WP_Customize_Manager` instance.
    */

    public function __construct() {
       // $this->wp_customize = $wp_customize;
       // add_action( 'admin_init', array( $this, 'import' ) );
        add_action( 'admin_init', array( $this, 'import' ) );
		add_action( 'admin_notices', array( $this, 'kemet_admin_errors' ) );
    }

    public function kemet_admin_errors() {
			// Verify correct source for the $_GET data.
			if ( isset( $_GET['_wpnonce'] ) && ! wp_verify_nonce( $_GET['_wpnonce'], 'kemet-import-complete' ) ) {
				return;
			}

			if ( ! isset( $_GET['status'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return;
			}

			if ( 'imported' === $_GET['status'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				add_settings_error( 'kemet-notices', 'imported', esc_html__( 'Import successful.', 'kemet-addons' ), 'updated' );
			}

			settings_errors( 'kemet-notices' );
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
				wp_die( esc_html__( 'Please upload a valid .json file', 'kemet-addons' ) );
			}

			$import_file = $_FILES['import_file']['tmp_name'];

			if ( empty( $import_file ) ) {
				wp_die( esc_html__( 'Please upload a file to import', 'kemet-addons' ) );
			}

			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			// Retrieve the settings from the file and convert the json object to an array.
			$file_contants = $wp_filesystem->get_contents( $import_file );
			$settings      = json_decode( $file_contants, 1 );

			// Astra addons activation.
			/* if ( class_exists( 'Astra_Admin_Helper' ) ) {
				Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $settings['astra-addons'] );
			} */

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