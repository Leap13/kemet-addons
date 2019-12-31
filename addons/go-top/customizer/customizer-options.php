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
		KEMET_THEME_SETTINGS . '[enable-go-top]', array(
			'default'           => kemet_get_option( 'enable-go-top' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-go-top]', array(
			'type'            => 'checkbox',
			'section'         => 'section-go-top',
			'label'           => __( 'Enable Go Top Link', 'kemet-addons' ),
            'priority'        => 1,
		)
    );
    
    /**
	 * Option: Go Top Link Button Size
	 */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-button-size]', array(
            'default'           => '',
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        )
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-button-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 3,
				'label'          => __( 'Button Size', 'kemet' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 15,
					 ),
                 ),
                 'active_callback' => 'kmt_dep_go_top',
			)
		)
	);

    /**
	 * Option: Go Top Link Icon Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[go-top-icon-size]', array(
			'default'           => kemet_get_option( 'go-top-icon-size' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 3,
				'label'          => __( 'Icon Size', 'kemet' ),
				'unit_choices'   => array(
                    'px' => array(
                        'min' => 1,
                        'step' => 1,
                        'max' =>200,
                    ),
                    'em' => array(
                        'min' => 0.1,
                        'step' => 0.1,
                        'max' => 10,
                    ),
                 ),
                 'active_callback' => 'kmt_dep_go_top',
			)
		)
	);
    
    /**
     * Option: Go Top Link Border Radius
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-border-radius]', array(
            'default'           => kemet_get_option( 'go-top-border-radius' ),
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        )
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-border-radius]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 4,
				'label'          => __( 'Border Radius', 'kemet' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 100,
					 ),
					 'em' => array(
						 'min' => 0.1,
						 'step' => 0.1,
						 'max' => 10,
                     ),
                     '%' => array(
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                    ),
                 ),
                 'active_callback' => 'kmt_dep_go_top',
			)
		)
	);

    /**
     * Option: Icon color
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-icon-color]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-color]', array(
                'section' => 'section-go-top',
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
        KEMET_THEME_SETTINGS . '[go-top-icon-h-color]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-h-color]', array(
                'section' => 'section-go-top',
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
		KEMET_THEME_SETTINGS . '[go-top-bg-color]', array(
			'default'           => kemet_get_option( 'go-top-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-bg-color]', array(
                'priority'       => 7,
                'section' => 'section-go-top',
                'label'   => __( 'Background Color', 'kemet-addons' ),
                'active_callback' => 'kmt_dep_go_top',
			)
		)
    );
    
    /**
	 * Option: Go Top Link Background Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[go-top-bg-h-color]', array(
			'default'           => kemet_get_option( 'go-top-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-bg-h-color]', array(
                'priority'       => 8,
                'section' => 'section-go-top',
                'label'   => __( 'Background Hover Color', 'kemet-addons' ),
                'active_callback' => 'kmt_dep_go_top',
			)
		)
    );
    
    /**
     * Option:Go Top Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-responsive]',array(
            'default'           => kemet_get_option('go-top-responsive'),
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[go-top-responsive]' ,array(
            'priority'   => 9,
            'section'    => 'section-go-top',
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
