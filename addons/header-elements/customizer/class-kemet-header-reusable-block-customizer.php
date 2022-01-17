<?php
/**
 * Kemet Header Elements Addon
 *
 * @package Kemet Addons
 */

class Kemet_Header_Reusable_Block_Customizer extends Kemet_Customizer_Register {

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
		self::$prefix           = 'reusable-block';
		$selector               = '.kmt-header-' . self::$prefix;
		$reusable_block_options = array(
			self::$prefix . '-id'         => array(
				'type'      => 'kmt-templates',
				'transport' => 'postMessage',
				'label'     => __( 'Template', 'kemet-addons' ),
				'template'  => 'wp_block',
			),
			self::$prefix . '-visibility' => array(
				'label'     => __( 'Visibility', 'kemet-addons' ),
				'type'      => 'kmt-visibility',
				'transport' => 'postMessage',
				'divider'   => true,
				'choices'   => array(
					'tablet' => __( 'Tablet', 'kemet-addons' ),
					'mobile' => __( 'Mobile', 'kemet-addons' ),
				),
				'context'   => array(
					array(
						'setting'  => 'device',
						'operator' => 'in_array',
						'value'    => array( 'tablet', 'mobile' ),
					),
				),
			),
			self::$prefix . '-margin'     => array(
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
		);

		$reusable_block_options = array(
			self::$prefix . '-options' => array(
				'section' => 'section-header-' . self::$prefix,
				'type'    => 'kmt-options',
				'data'    => array(
					'options' => $reusable_block_options,
				),
			),
		);

		return array_merge( $options, $reusable_block_options );
	}

	/**
	 * Register Customizer Sections
	 *
	 * @param array $sections sections.
	 * @return array
	 */
	public function register_sections( $sections ) {
		$reusable_block_sections = array(
			'section-header-' . self::$prefix => array(
				'title' => __( 'Header Reusable Block', 'kemet-addons' ),
				'panel' => 'panel-header-builder-group',
			),
		);

		return array_merge( $sections, $reusable_block_sections );

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
				'selector'            => '.kmt-header-' . self::$prefix,
				'container_inclusive' => false,
				'render_callback'     => array( Kemet_Addon_Header_Elements_Partials::get_instance(), 'reusable_block_markup' ),
			)
		);

		return array_merge( $partials, $new_partials );
	}
}


new Kemet_Header_Reusable_Block_Customizer();


