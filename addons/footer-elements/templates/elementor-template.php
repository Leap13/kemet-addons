<?php
/**
 * Template part for displaying the elementor template
 *
 * @package kemet
 */

?>
<div class="kmt-footer-item kmt-footer-item-elementor-template kmt-item-focus" data-section="section-footer-elementor-template">
	<?php Kemet_Builder_Helper::customizer_edit_link(); ?>
	<?php
	/**
	 * Kemet Footer Cart
	 *
	 * Hooked kemet_footer_elemetor_template
	 */
	do_action( 'kemet_footer_elemetor_template' );
	?>
</div>
