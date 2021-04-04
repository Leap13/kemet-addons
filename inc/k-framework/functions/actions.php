<?php
/**
 * Actions
 *
 * @package Kemet Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! function_exists( 'kfw_get_icons' ) ) {
	/**
	 *
	 * Get icons from admin ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_get_icons() {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'kfw_icon_nonce' ) ) {
			ob_start();

			kfw::include_plugin_file( 'fields/icon/default-icons.php' );

			$icon_lists = apply_filters( 'kfw_field_icon_add_icons', kfw_get_default_icons() );

			if ( ! empty( $icon_lists ) ) {
				foreach ( $icon_lists as $list ) {
					echo ( count( $icon_lists ) >= 2 ) ? wp_kses( '<div class="kfw-icon-title">' . $list['title'] . '</div>', kfw_allowed_html( array( 'div' ) ) ) : '';

					foreach ( $list['icons'] as $icon ) {
						echo wp_kses( '<a class="kfw-icon-tooltip" data-kfw-icon="' . $icon . '" title="' . $icon . '"><span class="kfw-icon kfw-selector dashicons ' . $icon . '"></span></a>', kfw_allowed_html( array( 'a', 'span' ) ) );
					}
				}
			} else {
				echo wp_kses( '<div class="kfw-text-error">' . esc_html__( 'No data provided by developer', 'kfw' ) . '</div>', kfw_allowed_html( array( 'a', 'div' ) ) );
			}

			wp_send_json_success( array( 'content' => ob_get_clean() ) );
		} else {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'kfw' ) ) );
		}
	}
	add_action( 'wp_ajax_kfw-get-icons', 'kfw_get_icons' );
}

if ( ! function_exists( 'kfw_export' ) ) {
	/**
	 *
	 * Export
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_export() {
		if ( ( isset( $_GET['export'] ) && ! empty( $_GET['export'] ) ) && ( isset( $_GET['nonce'] ) && ! empty( $_GET['nonce'] ) ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'kfw_backup_nonce' ) ) {
			header( 'Content-Type: application/json' );
			header( 'Content-disposition: attachment; filename=backup-' . gmdate( 'd-m-Y' ) . '.json' );
			header( 'Content-Transfer-Encoding: binary' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			echo wp_json_encode( get_option( sanitize_text_field( wp_unslash( $_GET['export'] ) ) ) );
		}

		die();
	}
	add_action( 'wp_ajax_kfw-export', 'kfw_export' );
}

if ( ! function_exists( 'kfw_import_ajax' ) ) {
	/**
	 *
	 * Import Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_import_ajax() {
		if ( ( isset( $_POST['import_data'] ) && ! empty( $_POST['import_data'] ) ) && ( isset( $_POST['unique'] ) && ! empty( $_POST['unique'] ) ) && ( isset( $_POST['nonce'] ) && ! empty( $_POST['nonce'] ) ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'kfw_backup_nonce' ) ) {
			$import_data = json_decode( sanitize_post( wp_unslash( trim( $_POST['import_data'] ) ) ), true );

			if ( is_array( $import_data ) ) {
				update_option( sanitize_text_field( wp_unslash( $_POST['unique'] ) ), wp_unslash( $import_data ) );
				wp_send_json_success();
			}
		}

		wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'kfw' ) ) );
	}
	add_action( 'wp_ajax_kfw-import', 'kfw_import_ajax' );
}

if ( ! function_exists( 'kfw_reset_ajax' ) ) {

	/**
	 *
	 * Reset Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_reset_ajax() {
		if ( ( isset( $_POST['unique'] ) && ! empty( $_POST['unique'] ) ) && ( isset( $_POST['nonce'] ) && ! empty( $_POST['nonce'] ) ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'kfw_backup_nonce' ) ) {
			delete_option( sanitize_text_field( wp_unslash( $_POST['unique'] ) ) );
			wp_send_json_success();
		}

		wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'kfw' ) ) );
	}
	add_action( 'wp_ajax_kfw-reset', 'kfw_reset_ajax' );
}

if ( ! function_exists( 'kfw_chosen_ajax' ) ) {
	/**
	 *
	 * Chosen Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_chosen_ajax() {
		if ( ( isset( $_POST['term'] ) && ! empty( $_POST['term'] ) ) && ( isset( $_POST['type'] ) && ! empty( $_POST['type'] ) ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'kfw_chosen_ajax_nonce' ) ) {
			$capability = apply_filters( 'kfw_chosen_ajax_capability', 'manage_options' );

			if ( current_user_can( $capability ) ) {
				$type       = sanitize_text_field( wp_unslash( $_POST['type'] ) );
				$term       = sanitize_text_field( wp_unslash( $_POST['term'] ) );
				$query_args = ( ! empty( $_POST['query_args'] ) ) ? wp_kses_post_deep( $_POST['query_args'] ) : array();
				$options    = kfw_Fields::field_data( $type, $term, $query_args );

				wp_send_json_success( $options );
			} else {
				wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'kfw' ) ) );
			}
		} else {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'kfw' ) ) );
		}
	}
	add_action( 'wp_ajax_kfw-chosen', 'kfw_chosen_ajax' );
}

if ( ! function_exists( 'kfw_set_icons' ) ) {
	/**
	 *
	 * Set icons for wp dialog
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function kfw_set_icons() {
		?>
	<div id="kfw-modal-icon" class="kfw-modal kfw-modal-icon">
		<div class="kfw-modal-table">
			<div class="kfw-modal-table-cell">
				<div class="kfw-modal-overlay"></div>
					<div class="kfw-modal-inner">
						<div class="kfw-modal-title">
							<?php esc_html_e( 'Add Icon', 'kfw' ); ?>
							<div class="kfw-modal-close kfw-icon-close"></div>
						</div>
						<div class="kfw-modal-header kfw-text-center">
							<input type="text" placeholder="<?php esc_html_e( 'Search a Icon...', 'kfw' ); ?>" class="kfw-icon-search" />
						</div>
						<div class="kfw-modal-content">
						<div class="kfw-modal-loading"><div class="kfw-loading"></div></div>
						<div class="kfw-modal-load"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
	add_action( 'admin_footer', 'kfw_set_icons' );
	add_action( 'customize_controls_print_footer_scripts', 'kfw_set_icons' );
}
