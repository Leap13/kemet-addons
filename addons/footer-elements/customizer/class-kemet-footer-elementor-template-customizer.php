<?php
/**
 * Kemet Footer Elements Addon
 *
 * @package Kemet Addons
 */

class Kemet_Footer_Elementor_Template_Customizer extends Kemet_Customizer_Register {

	/**
	 * prefix
	 *
	 * @access private
	 * @var string
	 */
	private static $prefix;
	/**
	 * Register Customizer Options
	 *
	 * @param array $options options.
	 * @return array
	 */
	public function register_options( $options ) {
		self::$prefix    = 'footer-elementor-template';
		$selector        = '.kmt-' . self::$prefix;
		$parent_selector = 'div.kmt-footer-item-elementor-template';

		$elemetor_template_options = array(
			self::$prefix . '-id'               => array(
				'type'      => 'kmt-templates',
				'transport' => 'postMessage',
				'label'     => __( 'Template', 'kemet-addons' ),
				'template'  => 'elementor_library',
			),
			self::$prefix . '-visibility'       => array(
				'label'   => __( 'Visibility', 'kemet-addons' ),
				'type'    => 'kmt-visibility',
				'divider' => true,
				'choices' => array(
					'desktop' => __( 'Tablet', 'kemet-addons' ),
					'tablet'  => __( 'Tablet', 'kemet-addons' ),
					'mobile'  => __( 'Mobile', 'kemet-addons' ),
				),
			),
			self::$prefix . '-margin'           => array(
				'type'           => 'kmt-spacing',
				'transport'      => 'postMessage',
				'responsive'     => true,
				'label'          => __( 'Margin', 'kemet' ),
				'linked_choices' => true,
				'divider'        => true,
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
					'top'    => __( 'Top', 'kemet' ),
					'right'  => __( 'Right', 'kemet' ),
					'bottom' => __( 'Bottom', 'kemet' ),
					'left'   => __( 'Left', 'kemet' ),
				),
				'preview'        => array(
					'selector'   => $selector,
					'property'   => 'margin',
					'responsive' => true,
				),
			),
			self::$prefix . '-horizontal-align' => array(
				'transport'  => 'postMessage',
				'type'       => 'kmt-icon-select',
				'responsive' => true,
				'divider'    => true,
				'label'      => __( 'Horizontal Alignment', 'kemet' ),
				'choices'    => array(
					'flex-start' => array(
						'icon' => 'dashicons-align-left',
					),
					'center'     => array(
						'icon' => 'dashicons-align-center',
					),
					'flex-end'   => array(
						'icon' => 'dashicons-align-right',
					),
				),
				'preview'    => array(
					'selector'   => $parent_selector,
					'property'   => '--justifyContnet',
					'responsive' => true,
				),
			),
			self::$prefix . '-vertical-align'   => array(
				'transport'  => 'postMessage',
				'type'       => 'kmt-icon-select',
				'responsive' => true,
				'divider'    => true,
				'label'      => __( 'Vertical Alignment', 'kemet' ),
				'choices'    => array(
					'flex-start' => array(
						'icon' => 'dashicons-align-left',
					),
					'center'     => array(
						'icon' => 'dashicons-align-center',
					),
					'flex-end'   => array(
						'icon' => 'dashicons-align-right',
					),
				),
				'preview'    => array(
					'selector'   => $parent_selector,
					'property'   => '--alignItems',
					'responsive' => true,
				),
			),
		);

		$elemetor_template_options = array(
			self::$prefix . '-options' => array(
				'section' => 'section-' . self::$prefix,
				'type'    => 'kmt-options',
				'data'    => array(
					'options' => $elemetor_template_options,
				),
			),
		);

		return array_merge( $options, $elemetor_template_options );
	}

	/**
	 * Register Customizer Sections
	 *
	 * @param array $sections sections.
	 * @return array
	 */
	public function register_sections( $sections ) {
		$elemetor_template_sections = array(
			'section-' . self::$prefix => array(
				'title' => __( 'Footer Elementor Template', 'kemet-addons' ),
				'panel' => 'panel-footer-builder-group',
			),
		);

		return array_merge( $sections, $elemetor_template_sections );

	}

	/**
	 * Add Partials
	 *
	 * @param array $partials partials.
	 * @return array
	 */
	public function add_partials( $partials ) {
		$new_partials = array_fill_keys(
			array( self::$prefix . '-id', self::$prefix . '-visibility' ),
			array(
				'selector'            => '.kmt-' . self::$prefix,
				'container_inclusive' => false,
				'render_callback'     => array( Kemet_Addon_Footer_Elements_Partials::get_instance(), 'elementor_template_markup' ),
			)
		);

		return array_merge( $partials, $new_partials );
	}
}


new Kemet_Footer_Elementor_Template_Customizer();


