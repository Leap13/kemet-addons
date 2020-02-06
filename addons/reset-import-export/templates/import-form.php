<?php
/**
* Template for displaying customizer import form.
*
* @package Customizer_Reset
*/

defined( 'ABSPATH' ) || die( "Can't access directly" );

ob_start();
?>

<form action="" method="post" class="customizer-import-form border-box" enctype="multipart/form-data">
	<div class="postbox">
		<h2 class="hndle ast-normal-cusror"><span class="dashicons dashicons-upload"></span><?php esc_html_e( 'Import Settings', 'kemet-addons' ); ?></h2>
		<div class="inside">
			<p><?php esc_html_e( 'Import Kemet Customizer Options.', 'kemet-addons' ); ?></p>
			<form method="post" enctype="multipart/form-data">
					<input type="file" name="import_file"/>
					<input type="hidden" name="kemet_ie_action" value="import_settings" />
					<?php wp_nonce_field( 'kemet_import_nonce', 'kemet_import_nonce' ); ?>
					<button class="button button-primary"><?php _e( 'Import', 'customizer-reset' ); ?></button>
			</form>

		</div>
	</div>
</form>

<?php
$customizer_import_form = ob_get_clean();