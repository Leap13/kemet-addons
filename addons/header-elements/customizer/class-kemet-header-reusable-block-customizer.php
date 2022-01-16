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
			self::$prefix . '-id' => array(
				'type'      => 'kmt-templates',
				'transport' => 'postMessage',
				'label'     => __( 'Template', 'kemet' ),
				'template'  => 'wp_block',
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
				'title' => __( 'Header Reusable Block', 'kemet' ),
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
		$partials[ self::$prefix . '-id' ] = array(
			'selector'            => '.kmt-header-' . self::$prefix,
			'container_inclusive' => false,
			'render_callback'     => array( Kemet_Addon_Header_Elements_Partials::get_instance(), 'reusable_block_markup' ),
		);

		return $partials;
	}
}


new Kemet_Header_Reusable_Block_Customizer();


