<?php
/**
 * Template part for displaying the reusable block
 *
 * @package kemet
 */

?>
<div class="kmt-header-item kmt-header-item-reusable-block kmt-item-focus" data-section="section-header-reusable-block">
	<?php Kemet_Builder_Helper::customizer_edit_link(); ?>
	<?php
	/**
	 * Kemet Header Cart
	 *
	 * Hooked kemet_header_reusable_block
	 */
	do_action( 'kemet_header_reusable_block' );
	?>
</div>
