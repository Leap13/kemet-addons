<?php
/**
 * Kemet Theme Customizer Register
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addons_Sticky_Customizer' ) ) :

	/**
	 * Customizer Register
	 */
	class Kemet_Addons_Sticky_Customizer extends Kemet_Customizer_Register {

		/**
		 * Register Customizer Options
		 *
		 * @param array $options options.
		 * @return array
		 */
		public function register_options( $options ) {

			$sticky_options = array(
				'foucs-sticky-section'   => array(
					'section'       => 'section-header-builder-layout',
					'priority'      => 5,
					'type'          => 'kmt-focus-button',
					'button_params' => array(
						'title'   => __( 'Sticky Header', 'kemet-addons' ),
						'section' => 'section-sticky-header-options',
					),
					'context'       => array(
						array(
							'setting' => 'tab',
							'value'   => 'general',
						),
						array(
							'setting' => 'device',
							'value'   => 'desktop',
						),
					),
				),
				'enable-sticky-top'      => array(
					'section'  => 'section-sticky-header-options',
					'priority' => 5,
					'label'    => __( 'Sticky Top Header', 'kemet' ),
					'type'     => 'checkbox',
				),
				'enable-sticky-main'     => array(
					'section'  => 'section-sticky-header-options',
					'priority' => 10,
					'label'    => __( 'Sticky Main Header', 'kemet' ),
					'type'     => 'checkbox',
				),
				'enable-sticky-bottom'   => array(
					'section'  => 'section-sticky-header-options',
					'priority' => 15,
					'label'    => __( 'Sticky Bottom Header', 'kemet' ),
					'type'     => 'checkbox',
				),
				'enable-shrink-main'     => array(
					'section'  => 'section-sticky-header-options',
					'priority' => 20,
					'label'    => __( 'Enable Main Row Shrinking', 'kemet' ),
					'type'     => 'checkbox',
					'context'  => array(
						array(
							'setting' => 'enable-sticky-main',
							'value'   => true,
						),
					),
				),
				'main-row-shrink-height' => array(
					'type'        => 'kmt-slider',
					'section'     => 'section-sticky-header-options',
					'priority'    => 25,
					'label'       => __( 'Main Row Shrink Height', 'kemet' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 5,
						'step' => 1,
						'max'  => 400,
					),
					'context'     => array(
						array(
							'setting' => 'enable-sticky-main',
							'value'   => true,
						),
						array(
							'setting' => 'enable-shrink-main',
							'value'   => true,
						),
					),
				),
			);
			return array_merge( $options, $sticky_options );
		}

		/**
		 * Register Customizer Sections
		 *
		 * @param array $sections sections.
		 * @return array
		 */
		public function register_sections( $sections ) {
			$sticky_sections = array(
				'section-sticky-header-options' => array(
					'priority' => 35,
					'title'    => __( 'Sticky Header', 'kemet' ),
					'panel'    => 'panel-header-builder-group',
				),
			);

			return array_merge( $sections, $sticky_sections );

		}
	}

	new Kemet_Addons_Sticky_Customizer();
endif;


