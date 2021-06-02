<?php

$customizer = Kemet_Customizer::get_instance();

/**
* Option: Options
*/
$options = array(
	'foucs-sticky-section' => array(
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
	'enable-sticky-top'    => array(
		'section'  => 'section-sticky-header-options',
		'priority' => 5,
		'label'    => __( 'Sticky Top Header', 'kemet' ),
		'type'     => 'checkbox',
	),
	'enable-sticky-main'   => array(
		'section'  => 'section-sticky-header-options',
		'priority' => 10,
		'label'    => __( 'Sticky Main Header', 'kemet' ),
		'type'     => 'checkbox',
	),
	'enable-sticky-bottom' => array(
		'section'  => 'section-sticky-header-options',
		'priority' => 15,
		'label'    => __( 'Sticky Bottom Header', 'kemet' ),
		'type'     => 'checkbox',
	),
);

$customizer->add_customizer( $options, 'options' );

$sections = array(
	'section-sticky-header-options' => array(
		'priority' => 35,
		'title'    => __( 'Sticky Header', 'kemet' ),
		'panel'    => 'panel-header-builder-group',
	),
);

$customizer->add_customizer( $sections, 'sections' );
