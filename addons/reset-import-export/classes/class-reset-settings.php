<?php
/**
 * Customizer Reset
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Customizer_Reset_ImportExport')) {

    class Kemet_Customizer_Reset_ImportExport {

        private static $instance;

        /**
         * Initiator
         */

        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_register', array( $this, 'export' ) );
			add_action( 'admin_init', array( $this, 'import' ) );
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_action( 'customize_controls_print_scripts', array( $this, 'controls_print_scripts' ) );
            add_action( 'wp_ajax_customizer_reset', array( $this, 'handle_ajax' ) );
        }


        public function customize_register( $wp_customize ) {
            $this->wp_customize = $wp_customize;
        }

    /**
	 * Enqueue assets.
	 */
	public function enqueue_scripts() {
		global $wp;

		// CSS.
		wp_enqueue_style( 'kmt-customizer-reset', KEMET_RESET_URL . 'assets/css/kmt-customizer-reset.css', true);

		// JS.
		wp_enqueue_script( 'kmt-customizer-reset', KEMET_RESET_URL . 'assets/js/kmt-customizer-reset.js', array( 'jquery' ), KEMET_ADDONS_VERSION, true );

		// Require the customizer import form.
		require KEMET_RESET_DIR . 'templates/import-form.php';

		//require KEMET_RESET_DIR . 'templates/import-form.php';
		wp_localize_script(
			'kmt-customizer-reset',
			'kmtResetCustomizerObj',
			array(
				'buttons'       => array(
					'reset'  => array(
						'text' => __( 'Reset Customizer Optionsssss', 'kemet-addons' ),
					),
					'export'  => array(
						'text' => __( 'Export', 'kemet-addons' ),
					),
					'import'  => array(
						'text' => __( 'Import', 'kemet-addons' ),
					)
				),
				'customizerUrl' => admin_url( 'customize.php' ),
				'message'       => array(
					'resetWarning'  => __( "WARNING! By clicking ok you will remove all Kemet theme customizer options!", 'kemet-addons' ),
					'importWarning' => __( 'WARNING! By running the import tool, your existing customizer data will be replaced. If you want to backup your current data, please export your data first.', 'customizer-reset' ),
					'emptyImport'   => __( 'Please select a file to import.', 'customizer-reset' ),
				),
				'importForm'    => array(
					'templates' => $customizer_import_form,
				),
				'nonces'        => array(
					'reset'  => wp_create_nonce( 'kmt-customizer-reset' ),
					'export' => wp_create_nonce( 'customizer-export' ),
				),
			)
		);
	}

    /**
	 * Handle ajax kemet customizer reset.
	 */
	public function handle_ajax() {
		if ( ! $this->wp_customize->is_preview() ) {
			wp_send_json_error( 'not_preview' );
		}

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'kmt-customizer-reset' ) ) {
			wp_send_json_error( 'invalid_nonce' );
		}

		$this->reset_customizer();
		wp_send_json_success();
	}

	/**
	 * Setup customizer export.
	 */
public function export() {
			
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! isset( $_GET['action'] ) || 'customizer_export' !== $_GET['action'] ) {
			return;
		}

		if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( $_GET['nonce'], 'customizer-export' ) ) {
			return;
		}

		$exporter = new Export( $this->wp_customize );

		$exporter->export();
		}
/**
	 * Setup customizer import.
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
			$file_ext  = explode( '.', $filename );
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
			

			// Delete existing dynamic CSS cache.
			delete_option( 'kemet-settings' );

			update_option( 'kemet-settings', $settings['customizer-settings'] );
	}

	/* public function import( $value ) {
		$this->update( $value );
	} */

	/**
	 * Reset customizer.
	 */
	public function reset_customizer() {

        // Reset option 'kemet-settings'.
        if ( defined( 'KEMET_THEME_SETTINGS' ) ) {

            $default_options = array();

            if ( ! empty( $default_options ) ) {
                update_option( KEMET_THEME_SETTINGS, $default_options );
            } else {
                delete_option( KEMET_THEME_SETTINGS );
            }
        }
	}

	/**
	 * Prints scripts for the control.
	 */
	public function controls_print_scripts() {
		global $customizer_reset_error;

		if ( $customizer_reset_error ) {
			echo '<script> alert("' . $customizer_reset_error . '"); </script>';
		}
	}
    }
}
Kemet_Customizer_Reset_ImportExport::get_instance();