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
					'header-main-layout-8' => array(
						'label' => __( 'Logo Right', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
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
		  'default'           => '',
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
		KEMET_THEME_SETTINGS . '[header-icon-bars-border-radius]', array(
            'priority'       => 16,
            'section' => 'section-header',
			'label'       => __( 'Icon Border Radius', 'kemet-addons' ),
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
	 * Option: Search Style
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-style]', array(
			'default'           => 'search-box',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[search-style]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 16,
			'label'    => __( 'Search Style', 'kemet-addons' ),
			'choices'  => array(
				'search-box'    => __( 'Search Box', 'kemet-addons' ),
				'search-icon'   => __( 'Icon', 'kemet-addons' ),
			),
		)
	);	

	/**
	 * Option: Search Box Shadow
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-box-shadow]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[search-box-shadow]', array(
			'type'     => 'checkbox',
			'section'  => 'section-header',
			'priority' => 16,
			'label'    => __( 'Enable Search Box Shadow', 'kemet-addons' ),
            'active_callback' => 'kemet_header_layoutall_style',
		)
	);	
	/**
   	* Option: Search Button Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-btn-bg-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[search-btn-bg-color]', array(
			'label'   => __( 'Search Button Background Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 16,
		  )
		)
	);
	/**
   	* Option: Search Button Hover Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-btn-h-bg-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[search-btn-h-bg-color]', array(
			'label'   => __( 'Search Button Hover', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 16,
		  )
		)
	);
	/**
   	* Option: Search Button Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-btn-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[search-btn-color]', array(
			'label'   => __( 'Search Button Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 16,
		  )
		)
	);
	/**
   	* Option: Search Border Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[search-border-color]', array(
		  'default'           => '',
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[search-border-color]', array(
			'label'   => __( 'Search Border Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 16,
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
			'label'    => __( 'Header Position', 'kemet-addons' ),
			'choices'  => array(
				'left'    => __( 'Left', 'kemet-addons' ),
				'right'   => __( 'Right', 'kemet-addons' ),
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
			'label'           => __( 'Enable Box Shadow', 'kemet-addons' ),
            'priority'        => 19,
			'active_callback' => 'kemet_header_layout6_style',	
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
			'label'       => __( 'Header6 Border Width', 'kemet-addons' ),
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
			'label'    => __( 'Header6 Border Style', 'kemet-addons' ),
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
				'label'    => __( 'Header6 Border Color', 'kemet-addons' ),
                'active_callback' => 'kemet_header_layout6_style',
			)
		)
	);


	//Header8
	/**
	 * Option: Header6 Position
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header8-position]', array(
			'default'           => 'left',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header8-position]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 17,
			'label'    => __( 'Header Position', 'kemet-addons' ),
			'choices'  => array(
				'left'    => __( 'Left', 'kemet-addons' ),
				'right'   => __( 'Right', 'kemet-addons' ),
			),
            'active_callback' => 'kemet_header_layout8_style',
		)
	);	
    
	/**
	 * Option: Enter Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header6-width]', array(
			'default'           => 60,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);

		/**
	 * Option: Enter Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header8-width]', array(
			'default'           => 60,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[header8-width]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-header',
				'priority'    => 18,
				'label'       => __( 'Vertical Header8 Width', 'kemet-addons' ),
				'suffix'      => '',
				'input_attrs' => array(
					'min'  => 60,
					'step' => 1,
					'max'  => 150,
				),
                'active_callback' => 'kemet_header_layout8_style',
			)
		)
	);
	/**
	 * Option: Enable Box Shadow
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header8-box-shadow]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header8-box-shadow]', array(
			'type'            => 'checkbox',
			'section'         => 'section-header',
			'label'           => __( 'Enable Box Shadow', 'kemet-addons' ),
            'priority'        => 19,
			'active_callback' => 'kemet_header_layout8_style',	
		)
	);