<?php
/**
 * Header Elements - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_footer_elements_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css dynamic css.
 * @return string
 */
function kemet_footer_elements_dynamic_css( $dynamic_css ) {
	$elementor_template_spacing = kemet_get_option( 'footer-elementor-template-margin' );
	$reusable_block_spacing     = kemet_get_option( 'footer-reusable-block-margin' );

	$css_output = array(
		'.kmt-footer-item-elementor-template' => array(
			'display'          => 'flex',
			'justify-content'  => 'var(--justifyContent)',
			'align-items'      => 'var(--alignItems)',
			'--justifyContent' => kemet_get_sub_option( 'footer-elementor-template-horizontal-align', 'desktop' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-elementor-template-vertical-align', 'desktop' ),
		),
		'.kmt-footer-item-reusable-block'     => array(
			'display'          => 'flex',
			'justify-content'  => 'var(--justifyContent)',
			'align-items'      => 'var(--alignItems)',
			'--justifyContent' => kemet_get_sub_option( 'footer-reusable-block-horizontal-align', 'desktop' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-reusable-block-vertical-align', 'desktop' ),
		),
		'.kmt-footer-elementor-template'      => array(
			'margin-top'    => kemet_responsive_spacing( $elementor_template_spacing, 'top', 'desktop' ),
			'margin-right'  => kemet_responsive_spacing( $elementor_template_spacing, 'right', 'desktop' ),
			'margin-bottom' => kemet_responsive_spacing( $elementor_template_spacing, 'bottom', 'desktop' ),
			'margin-left'   => kemet_responsive_spacing( $elementor_template_spacing, 'left', 'desktop' ),
		),
		'.kmt-footer-reusable-block'          => array(
			'margin-top'    => kemet_responsive_spacing( $reusable_block_spacing, 'top', 'desktop' ),
			'margin-right'  => kemet_responsive_spacing( $reusable_block_spacing, 'right', 'desktop' ),
			'margin-bottom' => kemet_responsive_spacing( $reusable_block_spacing, 'bottom', 'desktop' ),
			'margin-left'   => kemet_responsive_spacing( $reusable_block_spacing, 'left', 'desktop' ),
		),
	);

	/* Parse CSS from array() */
	$parse_css = kemet_parse_css( $css_output );

	$tablet = array(
		'.kmt-footer-item-elementor-template' => array(
			'--justifyContent' => kemet_get_sub_option( 'footer-elementor-template-horizontal-align', 'tablet' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-elementor-template-vertical-align', 'tablet' ),
		),
		'.kmt-footer-item-reusable-block'     => array(
			'--justifyContent' => kemet_get_sub_option( 'footer-reusable-block-horizontal-align', 'tablet' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-reusable-block-vertical-align', 'tablet' ),
		),
		'.kmt-footer-elementor-template'      => array(
			'margin-top'    => kemet_responsive_spacing( $elementor_template_spacing, 'top', 'tablet' ),
			'margin-right'  => kemet_responsive_spacing( $elementor_template_spacing, 'right', 'tablet' ),
			'margin-bottom' => kemet_responsive_spacing( $elementor_template_spacing, 'bottom', 'tablet' ),
			'margin-left'   => kemet_responsive_spacing( $elementor_template_spacing, 'left', 'tablet' ),
		),
		'.kmt-footer-reusable-block'          => array(
			'margin-top'    => kemet_responsive_spacing( $reusable_block_spacing, 'top', 'tablet' ),
			'margin-right'  => kemet_responsive_spacing( $reusable_block_spacing, 'right', 'tablet' ),
			'margin-bottom' => kemet_responsive_spacing( $reusable_block_spacing, 'bottom', 'tablet' ),
			'margin-left'   => kemet_responsive_spacing( $reusable_block_spacing, 'left', 'tablet' ),
		),
	);

	/* Parse CSS from array()*/
	$parse_css .= kemet_parse_css( $tablet, '', '768' );

	$mobile = array(
		'.kmt-footer-item-elementor-template' => array(
			'--justifyContent' => kemet_get_sub_option( 'footer-elementor-template-horizontal-align', 'mobile' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-elementor-template-vertical-align', 'mobile' ),
		),
		'.kmt-footer-item-reusable-block'     => array(
			'--justifyContent' => kemet_get_sub_option( 'footer-reusable-block-horizontal-align', 'mobile' ),
			'--alignItems'     => kemet_get_sub_option( 'footer-reusable-block-vertical-align', 'mobile' ),
		),
		'.kmt-footer-elementor-template'      => array(
			'margin-top'    => kemet_responsive_spacing( $elementor_template_spacing, 'top', 'mobile' ),
			'margin-right'  => kemet_responsive_spacing( $elementor_template_spacing, 'right', 'mobile' ),
			'margin-bottom' => kemet_responsive_spacing( $elementor_template_spacing, 'bottom', 'mobile' ),
			'margin-left'   => kemet_responsive_spacing( $elementor_template_spacing, 'left', 'mobile' ),
		),
		'.kmt-footer-reusable-block'          => array(
			'margin-top'    => kemet_responsive_spacing( $reusable_block_spacing, 'top', 'mobile' ),
			'margin-right'  => kemet_responsive_spacing( $reusable_block_spacing, 'right', 'mobile' ),
			'margin-bottom' => kemet_responsive_spacing( $reusable_block_spacing, 'bottom', 'mobile' ),
			'margin-left'   => kemet_responsive_spacing( $reusable_block_spacing, 'left', 'mobile' ),
		),
	);

	/* Parse CSS from array()*/
	$parse_css   .= kemet_parse_css( $mobile, '', '544' );
	$dynamic_css .= $parse_css;

	return $dynamic_css;

}
