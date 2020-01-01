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
				'label'    => __( 'Kemet Headers', 'kemet-addons' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'header-main-layout-1' => array(
						'label' => __( 'Logo Left', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-01.png',
					),
					'header-main-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-02.png',
					),
					'header-main-layout-3' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-03.png',
					), 
                    'header-main-layout-4' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-04.png',
					), 
                    'header-main-layout-5' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  =>  KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-05.png',
					), 
                    'header-main-layout-6' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
					),
					'header-main-layout-7' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-07.png',
					),
					'header-main-layout-8' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-08.png',
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
			'label'   => __( 'Logo & Menu Icon Background', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 11,
			'active_callback' => 'kemet_header_withicon_layout_style',
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
		  'default'           => '#fff',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
			'label'   => __( 'Icon Color', 'kemet-addons' ),
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
			'label'   => __( 'Icon Hover Color', 'kemet-addons' ),
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
		  'default'           => '#a7a7a7',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-bg-color]', array(
			'label'   => __( 'Icon Background Color', 'kemet-addons' ),
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
			'label'   => __( 'Icon Background Hover Color', 'kemet-addons' ),
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
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-header',
				'priority'    => 16,
				'label'       => __( 'Icon Border Radius', 'kemet' ),
				'suffix'      => '',
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'active_callback' => 'kemet_header_withicon_layout_style',
			)
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
				'label'          => __( 'Menu Icon Space', 'kemet-addons' ),
				'linked_choices' => true,
                'active_callback' => 'kemet_header_withicon_layout_style',
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
					'top'    => __( 'Top', 'kemet-addons' ),
					'right'  => __( 'Right', 'kemet-addons' ),
					'bottom' => __( 'Bottom', 'kemet-addons' ),
					'left'   => __( 'Left', 'kemet-addons' ),
				),
			)
		)
	);

	/**
	 * Option: Vertical Header Position
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[v-headers-position]', array(
			'default'           => 'left',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[v-headers-position]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 17,
			'label'    => __( 'Header Position', 'kemet-addons' ),
			'choices'  => array(
				'left'    => __( 'Left', 'kemet-addons' ),
				'right'   => __( 'Right', 'kemet-addons' ),
			),
            'active_callback' => 'kemet_header_layout_vertical_style',
		)
	);	
    
	/**
	 * Option: Enter Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[vertical-header-width]', array(
			'default'           => 300,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[vertical-header-width]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-header',
				'priority'    => 18,
				'label'       => __( 'Vertical Header Width', 'kemet-addons' ),
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
	 * Option: Vertical Headers Enable Box Shadow
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[vheader-box-shadow]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[vheader-box-shadow]', array(
			'type'            => 'checkbox',
			'section'         => 'section-header',
			'label'           => __( 'Enable Box Shadow', 'kemet-addons' ),
            'priority'        => 19,
            'active_callback' => 'kemet_header_layout_vertical_style',
		)
	);
	/**
	 * Option: Vertical Headers Border Style
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[vheader-border-style]', array(
			'default'           => 'solid',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[vheader-border-style]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 100,
			'label'    => __( 'Border Type', 'kemet-addons' ),
			'choices'  => array(
				'hidden'    => __( 'Hidden', 'kemet-addons' ),
				'dotted'    => __( 'Dotted', 'kemet-addons' ),
				'dashed'    => __( 'Dashed', 'kemet-addons' ),
				'solid'     => __( 'Solid', 'kemet-addons' ),
				'double'    => __( 'Double', 'kemet-addons' ),
				'groove'    => __( 'Groove', 'kemet-addons' ),
				'ridge'     => __( 'Ridge', 'kemet-addons' ),
				'inset'     => __( 'Inset', 'kemet-addons' ),
				'outset'    => __( 'Outset', 'kemet-addons' ),
			),
            'active_callback' => 'kemet_header_layout_vertical_style',
		)
	);	