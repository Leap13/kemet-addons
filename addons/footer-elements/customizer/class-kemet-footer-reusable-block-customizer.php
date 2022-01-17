<?php
/**
 * Kemet Footer Elements Addon
 *
 * @package Kemet Addons
 */

class Kemet_Footer_Reusable_Block_Customizer extends Kemet_Customizer_Register {

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
		self::$prefix           = 'footer-reusable-block';
		$selector               = '.kmt-' . self::$prefix;
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
				'section' => 'section-' . self::$prefix,
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
			'section-' . self::$prefix => array(
				'title' => __( 'Footer Reusable Block', 'kemet' ),
				'panel' => 'panel-footer-builder-group',
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
			'selector'            => '.kmt-' . self::$prefix,
			'container_inclusive' => false,
			'render_callback'     => array( Kemet_Addon_Footer_Elements_Partials::get_instance(), 'reusable_block_markup' ),
		);

		return $partials;
	}
}


new Kemet_Footer_Reusable_Block_Customizer();


