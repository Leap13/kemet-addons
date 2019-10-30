<?php

    $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[header-layouts]', array(
 			'default'           => kemet_get_option( 'header-layouts' ),
 			'type'              => 'option',
 			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[header-layouts]', array(
				'section'  => 'section-header',
				'priority' => 1,
				'label'    => __( 'Kemet Headers', 'kemet' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'header-main-layout-1' => array(
						'label' => __( 'Logo Left', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					),
					'header-main-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					),
					'header-main-layout-3' => array(
						'label' => __( 'Logo Right', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					), 
                    'header-main-layout-4' => array(
						'label' => __( 'Logo Right', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					), 
                    'header-main-layout-5' => array(
						'label' => __( 'Logo Right', 'kemet' ),
						'path'  =>  KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					), 
                    'header-main-layout-6' => array(
						'label' => __( 'Logo Right', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					), 
                    'header-main-layout-7' => array(
						'label' => __( 'Logo Right', 'kemet' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/logo-center.png',
					), 
				),
			)
		)
	);
    
    /**
   	* Option: Icon Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]', array(
			'label'   => __( 'Logo & Menu Icon Background', 'kemet' ),
			'section' => 'section-header',
			'priority' => 11,
		  )
		)
	);
    
    $wp_customize->selective_refresh->add_partial( "header-icon-bars-logo-bg-color", [
        'selector'            => ".main-header-container.logo-menu-icon",
        'settings'            => [
            "header-icon-bars-logo-bg-color",
        ],
        'render_callback'     => 'panel-layout',
        'container_inclusive' => true,
    ] );
    


   /**
   	* Option: Icon Bars Color
    */
  	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
			'label'   => __( 'Icon Color', 'kemet' ),
			'section' => 'section-header',
			'priority' => 11,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);
   /**
   	* Option: Icon Hover Color
    */
  	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-h-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-h-color]', array(
			'label'   => __( 'Icon Hover Color', 'kemet' ),
			'section' => 'section-header',
			'priority' => 13,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);

   /**
   	* Option: Icon Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-bg-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-bg-color]', array(
			'label'   => __( 'Icon Background Color', 'kemet' ),
			'section' => 'section-header',
			'priority' => 14,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);

	/**
   	* Option: Icon Background Hover Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-bg-h-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-bg-h-color]', array(
			'label'   => __( 'Icon Background Hover Color', 'kemet' ),
			'section' => 'section-header',
			'priority' => 15,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);

	/**
	 * Option: Icon Border Radius
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]', array(
			'default'           => kemet_get_option( 'readmore-border-radius' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]', array(
            'priority'       => 16,
            'section' => 'section-header',
			'label'       => __( 'Icon Border Radius', 'kemet' ),
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 200,
			),
            'active_callback' => 'kemet_header_withicon_layout_style',
		)
	);
    
    /**
    * Option - Menu Icon Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[menu-icon-bars-space]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[menu-icon-bars-space]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-header',
				'priority'       => 10,
				'label'          => __( 'Menu Icon Space', 'kemet' ),
				'linked_choices' => true,
                'active_callback' => 'kemet_header_withicon_layout_style',
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
					'top'    => __( 'Top', 'kemet' ),
					'right'  => __( 'Right', 'kemet' ),
					'bottom' => __( 'Bottom', 'kemet' ),
					'left'   => __( 'Left', 'kemet' ),
				),
			)
		)
	);

	/**
	 * Option: Header6 Position
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-position]', array(
			'default'           => 'left',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header6-position]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 17,
			'label'    => __( 'Header Position', 'kemet' ),
			'choices'  => array(
				'left'    => __( 'Left', 'kemet' ),
				'right'   => __( 'Right', 'kemet' ),
			),
            'active_callback' => 'kemet_header_layout6_style',
		)
	);	
    
	/**
	 * Option: Enter Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-width]', array(
			'default'           => 300,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[header6-width]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-header',
				'priority'    => 18,
				'label'       => __( 'Vertical Header Width', 'kemet' ),
				'suffix'      => '',
				'input_attrs' => array(
					'min'  => 100,
					'step' => 1,
					'max'  => 400,
				),
                'active_callback' => 'kemet_header_layout6_style',
			)
		)
	);

	/**
	 * Option: Enable Box Shadow
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-box-shadow]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header6-box-shadow]', array(
			'type'            => 'checkbox',
			'section'         => 'section-header',
			'label'           => __( 'Enable Box Shadow', 'kemet' ),
            'priority'        => 19,
            
		)
	);
	
	/**
	 * Option: Header6 Border Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-border-width]', array(
			'default'           => kemet_get_option( 'header6-border-width' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header6-border-width]', array(
			'type'        => 'number',
			'section'     => 'section-header',
			'priority'    => 20,
			'label'       => __( 'Header6 Border Width', 'kemet' ),
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 600,
			),
            'active_callback' => 'kemet_header_layout6_style',
		)
	);
	/**
	 * Option: Header6 Border Style
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-border-style]', array(
			'default'           => 'solid',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header6-border-style]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 21,
			'label'    => __( 'Header6 Border Style', 'kemet' ),
			'choices'  => array(
				'hidden'    => __( 'Hidden', 'kemet' ),
				'dotted'    => __( 'Dotted', 'kemet' ),
				'dashed'    => __( 'Dashed', 'kemet' ),
				'solid'     => __( 'Solid', 'kemet' ),
				'double'    => __( 'Double', 'kemet' ),
				'groove'    => __( 'Groove', 'kemet' ),
				'ridge'     => __( 'Ridge', 'kemet' ),
				'inset'     => __( 'Inset', 'kemet' ),
				'outset'    => __( 'Outset', 'kemet' ),
			),
            'active_callback' => 'kemet_header_layout6_style',
		)
	);	

	/**
	 * Option: Header6 Border Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-border-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[header6-border-color]', array(
				'section'  => 'section-header',
				'priority' => 22,
				'label'    => __( 'Header6 Border Color', 'kemet' ),
                'active_callback' => 'kemet_header_layout6_style',
			)
		)
	);