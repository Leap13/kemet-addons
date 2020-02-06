<?php
/**
*  Kemet Customizer Export
*/

class Import {
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

	/**
	 * Imports images for settings saved as mods.
	 *
	 * @access private
	 * @param array $mods An array of customizer mods.
	 * @return array The mods array with any new import data.
	 */
	private function import_images( $mods ) {
		foreach ( $mods as $key => $val ) {

			if ( $this->is_image_url( $val ) ) {

				$data = $this->sideload_image( $val );

				if ( ! is_wp_error( $data ) ) {

					$mods[ $key ] = $data->url;

					// Handle header image controls.
					if ( isset( $mods[ $key . '_data' ] ) ) {
						$mods[ $key . '_data' ] = $data;
						update_post_meta( $data->attachment_id, '_wp_attachment_is_custom_header', get_stylesheet() );
					}
				}
			}
		}

		return $mods;
	}

	/**
	 * Checks to see whether a string is an image url or not.
	 *
	 * @access private
	 * @param string $string The string to check.
	 * @return bool Whether the string is an image url or not.
	 */
	private function is_image_url( $string = '' ) {
		if ( is_string( $string ) ) {

			if ( preg_match( '/\.(jpg|jpeg|png|gif)/i', $string ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Taken from the core media_sideload_image function and
	 * modified to return an array of data instead of html.
	 *
	 * @access private
	 * @param string $file The image file path.
	 * @return array An array of image data.
	 */
	private function sideload_image( $file ) {
		$data = new \stdClass();

		if ( ! function_exists( 'media_handle_sideload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
		}

		if ( ! empty( $file ) ) {

			// Set variables for storage, fix file filename for query strings.
			preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
			$file_array         = array();
			$file_array['name'] = basename( $matches[0] );

			// Download file to temp location.
			$file_array['tmp_name'] = download_url( $file );

			// If error storing temporarily, return the error.
			if ( is_wp_error( $file_array['tmp_name'] ) ) {
				return $file_array['tmp_name'];
			}

			// Do the validation and storage stuff.
			$id = media_handle_sideload( $file_array, 0 );

			// If error storing permanently, unlink.
			if ( is_wp_error( $id ) ) {
				@unlink( $file_array['tmp_name'] );
				return $id;
			}

			// Build the object to return.
			$meta                = wp_get_attachment_metadata( $id );
			$data->attachment_id = $id;
			$data->url           = wp_get_attachment_url( $id );
			$data->thumbnail_url = wp_get_attachment_thumb_url( $id );
			$data->height        = $meta['height'];
			$data->width         = $meta['width'];
		}

		return $data;
    }
}