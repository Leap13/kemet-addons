<?php
/**
 * Template part for displaying the elementor template
 *
 * @package kemet
 */

?>
<div class="kmt-header-item kmt-header-item-elementor-template kmt-item-focus" data-section="section-header-elementor-template">
	<?php Kemet_Builder_Helper::customizer_edit_link(); ?>
	<?php
	/**
	 * Kemet Header Cart
	 *
	 * Hooked kemet_header_elemetor_template
	 */
	do_action( 'kemet_header_elemetor_template' );
	?>
</div>
