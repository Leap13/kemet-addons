<?php
    /**
     * Option: Enable Sticky Header 
     */
	$wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[enable-sticky]', array(
            'default'           => kemet_get_option( 'enable-sticky' ),
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[enable-sticky]', array(
            'type'            => 'checkbox',
            'section'         => 'section-sticky-header',
            'label'           => __( 'Enable Sticky Header', 'kemet-addons' ),
            'priority'        => 5,
        )
	);
	
	/**
     * Option: Enable Sticky Top Bar 
     */
	$wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[sticky-top-bar]', array(
            'default'           => kemet_get_option( 'sticky-top-bar' ),
            'type'              => 'option',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[sticky-top-bar]', array(
            'type'            => 'checkbox',
            'section'         => 'section-sticky-header',
            'label'           => __( 'Enable Sticky Top Bar', 'kemet-addons' ),
            'priority'        => 5,
        )
	);

    /**
	 * Option: Sticky Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-bg-obj]', array(
			'default'           => kemet_get_option( 'sticky-bg-obj' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_background_obj' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Background(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-bg-obj]', array(
				'type'    => 'kmt-background',
                'section' => 'section-sticky-header',
                'priority' => 10,
                'label'   => __( 'Sticky Header Background', 'kemet-addons' ),
			)
		)
    );

    /**
	 * Option: Logo Image
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-logo]', array(
			'default'           => kemet_get_option( 'sticky-logo' ),
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-logo]', array(
				'section'        => 'section-sticky-header',
				'priority'       => 15,
				'label'          => __( 'Sticky Logo Image', 'kemet-addons' ),
                'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			)
		)
	);
	
	/**
	 * Option: Sticky Logo Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-logo-width]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-logo-width]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-sticky-header',
				'priority'       => 16,
				'label'          => __( 'Sticky Logo Width', 'kemet' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' =>300,
					 ),
					 'em' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 10,
					 ),
				 ),
			)
		)
	);
    
    /**
	 * Option: Sticky Text Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-menu-link-color]', array(
			'default'           => kemet_get_option( 'sticky-menu-link-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-menu-link-color]', array(
				'label'   => __( 'Sticky Menu Links Color', 'kemet-addons' ),
				'priority'=> 20,
                'section' => 'section-sticky-header',
			)
		)
    );
    
    /**
	 * Option: Sticky Text Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-menu-link-h-color]', array(
			'default'           => kemet_get_option( 'sticky-menu-link-h-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-menu-link-h-color]', array(
				'label'   => __( 'Sticky Menu Link Hover Color', 'kemet-addons' ),
				'priority'=> 25,
                'section' => 'section-sticky-header',
			)
		)
    );

    /**
	 * Option: Sticky Submenu Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-submenu-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-submenu-bg-color]', array(
                'label'   => __( 'Sticky Submenu Background Color', 'kemet-addons' ),
                'priority'       => 30,
                'section' => 'section-sticky-header',
			)
		)
    );
    
    /**
	 * Option: Sticky Submenu Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-submenu-link-color]', array(
			'default'           => kemet_get_option( 'sticky-submenu-link-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-submenu-link-color]', array(
				'label'   => __( 'Sticky Submenu Color', 'kemet-addons' ),
				'priority'=> 35,
                'section' => 'section-sticky-header',
			)
		)
    );
    
    /**
	 * Option: Sticky Submenu Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-submenu-link-h-color]', array(
			'default'           => kemet_get_option( 'sticky-submenu-link-h-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-submenu-link-h-color]', array(
				'label'   => __( 'Sticky Submenu Hover Color', 'kemet-addons' ),
				'priority'=> 40,
                'section' => 'section-sticky-header',
			)
		)
    );
    /**
	 * Option: Sticky Border Bottom Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-border-bottom-color]', array(
			'default'           => kemet_get_option( 'sticky-border-bottom-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-border-bottom-color]', array(
				'label'   => __( 'Sticky Border Bottom Color', 'kemet-addons' ),
				'priority'=> 50,
                'section' => 'section-sticky-header',
			)
		)
    );

    /**
     * Option:Sticky Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[sticky-responsive]',array(
            'default'           => 'all-devices',
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[sticky-responsive]' ,array(
            'priority'   => 55,
            'section'    => 'section-sticky-header',
            'type'     => 'select',
            'label'    => __( 'Sticky Visibility', 'kemet-addons' ),
            'choices'  => array(
				'all-devices'        => __( 'Show On All Devices', 'kemet-addons' ),
                'sticky-hide-tablet'        => __( 'Hide On Tablet', 'kemet-addons' ),
                'sticky-hide-mobile'        => __( 'Hide On Mobile', 'kemet-addons' ),
                'sticky-hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet-addons' ),
            ),
        )
    );

	/**
     * Option:Sticky Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[sticky-style]',array(
            'default'           => 'sticky-fade',
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[sticky-style]' ,array(
            'priority'   => 55,
            'section'    => 'section-sticky-header',
            'type'     => 'select',
            'label'    => __( 'Sticky Style', 'kemet-addons' ),
            'choices'  => array(
				'sticky-fade'        => __( 'Fade', 'kemet-addons' ),
                'sticky-slide'        => __( 'Slide', 'kemet-addons' ),
            ),
        )
    );