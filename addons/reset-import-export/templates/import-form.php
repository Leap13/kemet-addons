<?php
/**
* Template for displaying customizer import form.
*
* @package Customizer_Reset
*/

defined( 'ABSPATH' ) || die( "Can't access directly" );

ob_start();
?>

<div class="postbox" id="kemet-ie">
				<h2 class="hndle ast-normal-cusror"><span class="dashicons dashicons-upload"></span><?php esc_html_e( 'Import Settings', 'astra-import-export' ); ?></h2>
				<div class="inside">
					<p><?php esc_html_e( 'Import your Astra Customizer settings.', 'kemet-addons' ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="import_file"/>
						</p>
						<p style="margin-bottom:0">
							<input type="hidden" name="kemet_ie_action" value="import_settings" />
							<?php wp_nonce_field( 'kemet_import_nonce', 'kemet_import_nonce' ); ?>
							<?php submit_button( __( 'Import', 'kemet-import-export' ), 'button', 'submit', false, array( 'id' => '' ) ); ?>
						</p>
					</form>

				</div>
			</div>

<?php
$customizer_import_form = ob_get_clean();