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
	 * @param object $wp_customize `WP_Customize_Manager` instance.
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
            
		// Add Kemet Addons to import.
		/* if ( class_exists( 'Kemet_Ext_Extension' ) ) {
			$theme_options['kemet-addons'] = Kemet_Ext_Extension::get_enabled_addons();
		} */

		$theme_mods = get_theme_mods();
		$filters    = array( 0, 'nav_menu_locations', 'custom_css_post_id', 'last_checked_version' );
		foreach ( $filters as $filter ) {
			if ( isset( $theme_mods[ $filter ] ) ) {
				unset( $theme_mods[ $filter ] );
			}
		}

		$theme_options = apply_filters( 'customizer_export_option_keys', $theme_options );

		//Plugin developers can specify additional option keys to export.
		$option_keys = apply_filters( 'customizer_export_option_keys', array() );

		foreach ( $option_keys as $option_key ) {
			$data['options'][ $option_key ] = get_option( $option_key );
		}

		if ( function_exists( 'wp_get_custom_css_post' ) ) {
			$data['wp_css'] = wp_get_custom_css();
		}

		nocache_headers();
		// Set the download headers.
		header( 'Content-disposition: attachment; filename=customizer-export-of-' . $theme . '.json' );
		header( 'Content-Type: application/octet-stream; charset=' . $charset );

		// Output the export data.
		echo wp_json_encode( array(
        'theme_options' => $theme_options,
		'theme_mods'    => $theme_mods,
		'data' => $data
        )  );

		// Start the download.
		exit;

 
            }
        }