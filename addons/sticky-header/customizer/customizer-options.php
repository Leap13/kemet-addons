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
	 * Option: Title
	 */
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-sticky-header]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Sticky Header Logo Settings', 'kemet-addons' ),
				'section'  => 'section-sticky-header',
				'priority' => 15,
				'settings' => array(),
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
				'priority'       => 20,
				'label'          => __( 'Logo Image', 'kemet-addons' ),
                'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			)
		)
	);
	
	/**
	 * Option: Sticky Logo Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-logo-width]', array(
			'default'           => kemet_get_option( 'sticky-logo-width' ),
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
				'priority'       => 25,
				'label'          => __( 'Logo Width', 'kemet-addons' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' =>300,
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
			)
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
                'priority' => 30,
                'label'   => __( 'Sticky Header Background', 'kemet-addons' ),
			)
		)
    );

    /**
	 * Option: Title
	 */
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-sticky-header-style]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Sticky Header Style', 'kemet-addons' ),
				'section'  => 'section-sticky-header',
				'priority' => 35,
				'settings' => array(),
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
				'label'   => __( 'Menu Link Color', 'kemet-addons' ),
				'priority'=> 40,
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
				'label'   => __( 'Menu Link Hover Color', 'kemet-addons' ),
				'priority'=> 45,
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
				'label'   => __( 'Bottom Border Color', 'kemet-addons' ),
				'priority'=> 50,
                'section' => 'section-sticky-header',
			)
		)
	);
	
    /**
	 * Option: Sticky Submenu Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-submenu-bg-color]', array(
			'default'           => kemet_get_option( 'sticky-submenu-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-submenu-bg-color]', array(
                'label'   => __( 'Submenu Background Color', 'kemet-addons' ),
                'priority'       => 55,
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
				'label'   => __( 'Submenu Link Color', 'kemet-addons' ),
				'priority'=> 60,
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
				'label'   => __( 'Submenu Link Hover Color', 'kemet-addons' ),
				'priority'=> 65,
                'section' => 'section-sticky-header',
			)
		)
    );
	
	/**
	 * Option: Sub menu Border Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sticky-submenu-border-color]', array(
			'default'           =>  kemet_get_option( 'sticky-submenu-border-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sticky-submenu-border-color]', array(
				'section'  => 'section-sticky-header',
				'priority' => 70,
				'label'    => __( 'Submenu Separator Color', 'kemet-addons' ),
			)
		)
	);

    /**
     * Option:Sticky Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[sticky-responsive]',array(
            'default'           => kemet_get_option( 'sticky-responsive' ),
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[sticky-responsive]' ,array(
            'priority'   => 75,
            'section'    => 'section-sticky-header',
            'type'     => 'select',
            'label'    => __( 'Sticky Header Visibility', 'kemet-addons' ),
            'choices'  => array(
				'all-devices'        => __( 'Show on All Devices', 'kemet-addons' ),
                'sticky-hide-tablet'        => __( 'Hide on Tablet', 'kemet-addons' ),
                'sticky-hide-mobile'        => __( 'Hide on Mobile', 'kemet-addons' ),
                'sticky-hide-tablet-mobile' => __( 'Hide on Tablet and Mobile', 'kemet-addons' ),
            ),
        )
    );

	/**
     * Option:Sticky Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[sticky-style]',array(
            'default'           => kemet_get_option( 'sticky-style' ),
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[sticky-style]' ,array(
            'priority'   => 80,
            'section'    => 'section-sticky-header',
            'type'     => 'select',
            'label'    => __( 'Sticky Header Entrance Animation', 'kemet-addons' ),
            'choices'  => array(
				'sticky-fade'        => __( 'Fade', 'kemet-addons' ),
                'sticky-slide'        => __( 'Slide', 'kemet-addons' ),
            ),
        )
    );