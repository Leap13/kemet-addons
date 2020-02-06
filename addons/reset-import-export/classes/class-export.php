<?php
/**
*  Kemet Customizer Export
*/

class Export {
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
	 * @param object
	 */
	public function __construct( $wp_customize = null ) {
		$this->wp_customize = $wp_customize;
	}

	/**
	 * Export the customizer.
	 */
	public function export() {
		$theme    = get_stylesheet();
        // Get options from the Customizer API.
        $theme_options['customizer-settings'] = Kemet_Theme_Options::get_options();

		$theme_options = apply_filters( 'customizer_export_option_keys', $theme_options );

		$option_keys = apply_filters( 'customizer_export_option_keys', array() );

		foreach ( $option_keys as $option_key ) {
			$data['options'][ $option_key ] = get_option( $option_key );
		}

		if ( function_exists( 'wp_get_custom_css_post' ) ) {
			$data['wp_css'] = wp_get_custom_css();
		}

		nocache_headers();

		header( 'Content-disposition: attachment; filename=customizer-export-of-' . $theme . '.json' );
		header( 'Content-Type: application/octet-stream; charset=utf-8' );

		echo wp_json_encode( $theme_options );

		// Start the download.
		die();
            }
        }
