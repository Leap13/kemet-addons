<?php
/**
 * Template part for displaying the reusable block
 *
 * @package kemet
 */

?>
<div class="kmt-footer-item kmt-footer-item-reusable-block kmt-item-focus" data-section="section-footer-reusable-block">
	<?php Kemet_Builder_Helper::customizer_edit_link(); ?>
	<?php
	/**
	 * Kemet Footer Cart
	 *
	 * Hooked kemet_footer_reusable_block
	 */
	do_action( 'kemet_footer_reusable_block' );
	?>
</div>
