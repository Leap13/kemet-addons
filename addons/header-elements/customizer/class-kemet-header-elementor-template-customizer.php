<?php
/**
 * Kemet Header Elements Addon
 *
 * @package Kemet Addons
 */

class Kemet_Header_Elementor_Template_Customizer extends Kemet_Customizer_Register {

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
		self::$prefix              = 'elementor-template';
		$selector                  = '.kmt-header-' . self::$prefix;
		$elemetor_template_options = array(
			self::$prefix . '-id' => array(
				'type'      => 'kmt-templates',
				'transport' => 'postMessage',
				'label'     => __( 'Template', 'kemet' ),
				'template'  => 'elementor_library',
			),
		);

		$elemetor_template_options = array(
			self::$prefix . '-options' => array(
				'section' => 'section-header-' . self::$prefix,
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
			'section-header-' . self::$prefix => array(
				'title' => __( 'Header Elementor Template', 'kemet' ),
				'panel' => 'panel-header-builder-group',
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
		$partials[ self::$prefix . '-id' ] = array(
			'selector'            => '.kmt-header-' . self::$prefix,
			'container_inclusive' => false,
			'render_callback'     => array( Kemet_Addon_Header_Elements_Partials::get_instance(), 'elementor_template_markup' ),
		);

		return $partials;
	}
}


new Kemet_Header_Elementor_Template_Customizer();


