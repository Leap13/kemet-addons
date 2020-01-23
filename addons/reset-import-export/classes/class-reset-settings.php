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

		wp_localize_script(
			'kmt-customizer-reset',
			'kmtResetCustomizerObj',
			array(
				'buttons'       => array(
					'reset'  => array(
						'text' => __( 'Reset Customizer Options', 'kemet-addons' ),
					),
				),
				'message'       => array(
					'resetWarning'  => __( "WARNING! By clicking ok you will remove all Kemet theme customizer options!", 'kemet-addons' ),
				),
				'nonces'        => array(
					'reset'  => wp_create_nonce( 'kmt-customizer-reset' ),
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