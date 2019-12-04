<?php
/**
 * Go Top Link Options for Kemet Theme.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        http://wpkemet.com/
 * @since       Kemet 1.0.0
 */



    /**
	 * Option: Enable Go Top Link
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-extra-widgets]', array(
			'default'           => kemet_get_option( 'enable-extra-widgets' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-extra-widgets]', array(
			'type'            => 'checkbox',
			'section'         => 'section-extra-widgets',
			'label'           => __( 'Enable Go Top Link', 'kemet-addons' ),
            'priority'        => 1,
		)
    );
    
    /**
	 * Option: Go Top Link Button Size
	 */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[extra-widgets-button-size]', array(
            'default'           => 30,
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        )
    );
    $wp_customize->add_control(
        new Kemet_Control_Slider(
            $wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-button-size]', array(
                'type'        => 'kmt-slider',
                'section'     => 'section-extra-widgets',
                'priority'    => 2,
                'label'       => __( 'Button Size', 'kemet-addons' ),
                'suffix'      => 'px',
                'input_attrs' => array(
                    'min'  => 0,
                    'step' => 1,
                    'max'  => 70,
                ),
                'active_callback' => 'kmt_dep_go_top',
            )
        )
    );

    /**
	 * Option: Go Top Link Icon Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[extra-widgets-icon-size]', array(
			'default'           => kemet_get_option( 'extra-widgets-icon-size' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_typo' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive(
			$wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-icon-size]', array(
				'type'        => 'kmt-responsive',
				'section'     => 'section-extra-widgets',
				'priority'    => 3,
				'label'       => __( 'Icon Size', 'kemet-addons' ),
				'input_attrs' => array(
                    'min' => 0,
                    'max' =>50
				),
				'units'       => array(
                    'px' => 'px',
                    'em' => 'em',
                    '%'  => '%',
                ),
                'active_callback' => 'kmt_dep_go_top',
			)
		)
    );
    
    /**
     * Option: Go Top Link Border Radius
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[extra-widgets-border-radius]', array(
            'default'           => kemet_get_option( 'extra-widgets-border-radius' ),
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[extra-widgets-border-radius]', array(
            'priority'    => 4,
            'section'     => 'section-extra-widgets',
            'label'       => __( 'Border Radius', 'kemet-addons' ),
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 0,
                'step' => 1,
                'max'  => 200,
            ),
            'active_callback' => 'kmt_dep_go_top',
        )
    );

    /**
     * Option: Icon color
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[extra-widgets-icon-color]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-icon-color]', array(
                'section' => 'section-extra-widgets',
                'label'   => __( 'Icon Color', 'kemet-addons' ),
                'priority'=>5,
                'active_callback' => 'kmt_dep_go_top',
            )
        )
    );

    /**
     * Option: Icon Hover color
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[extra-widgets-icon-h-color]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-icon-h-color]', array(
                'section' => 'section-extra-widgets',
                'label'   => __( 'Icon Hover Color', 'kemet-addons' ),
                'priority'=>6,
                'active_callback' => 'kmt_dep_go_top',
            )
        )
    );

    /**
	 * Option: Go Top Link Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[extra-widgets-bg-color]', array(
			'default'           => kemet_get_option( 'extra-widgets-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-bg-color]', array(
                'priority'       => 7,
                'section' => 'section-extra-widgets',
                'label'   => __( 'Background Color', 'kemet-addons' ),
                'active_callback' => 'kmt_dep_go_top',
			)
		)
    );
    
    /**
	 * Option: Go Top Link Background Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[extra-widgets-bg-h-color]', array(
			'default'           => kemet_get_option( 'extra-widgets-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[extra-widgets-bg-h-color]', array(
                'priority'       => 8,
                'section' => 'section-extra-widgets',
                'label'   => __( 'Background Hover Color', 'kemet-addons' ),
                'active_callback' => 'kmt_dep_go_top',
			)
		)
    );
    
    /**
     * Option:Go Top Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[extra-widgets-responsive]',array(
            'default'           => kemet_get_option('extra-widgets-responsive'),
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[extra-widgets-responsive]' ,array(
            'priority'   => 9,
            'section'    => 'section-extra-widgets',
            'type'     => 'select',
            'label'    => __( 'Go Top Link Visibility', 'kemet-addons' ),
            'choices'  => array(
                'all-devices'        => __( 'Show On All Devices', 'kemet-addons' ),
                'hide-tablet'        => __( 'Hide On Tablet', 'kemet-addons' ),
                'hide-mobile'        => __( 'Hide On Mobile', 'kemet-addons' ),
                'hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet-addons' ),
            ),
            'active_callback' => 'kmt_dep_go_top',
        )
    );
