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
				'priority' => 10,
				'label'    => __( 'Kemet Headers', 'kemet-addons' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'header-main-layout-1' => array(
						'label' => __( 'Header 1', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-01.png',
					),
					'header-main-layout-2' => array(
						'label' => __( 'Header 2', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-02.png',
					),
					'header-main-layout-3' => array(
						'label' => __( 'Header 3', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-03.png',
					), 
                    'header-main-layout-4' => array(
						'label' => __( 'Header 4', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-04.png',
					), 
                    'header-main-layout-5' => array(
						'label' => __( 'Header 5', 'kemet-addons' ),
						'path'  =>  KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-05.png',
					), 
                    'header-main-layout-6' => array(
						'label' => __( 'Header 7', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
					),
					'header-main-layout-7' => array(
						'label' => __( 'Header 7', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-07.png',
					),
					'header-main-layout-8' => array(
						'label' => __( 'Header 8', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-08.png',
					),
					'header-main-layout-9' => array(
						'label' => __( 'Header 9', 'kemet-addons' ),
						'path'  => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-09.png',
					),
				),
			)
		)
	);
	/**
	* Option: Title
	*/
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-title-title]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Header Layout Settings', 'kemet-addons' ),
				'section'  => 'section-header',
				'priority' => 20,
				'settings' => array(),
				'active_callback' => 'kemet_header_has_setting_label'
			)
		)
	);
	/**
	 * Option: Vertical Header Position
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[v-headers-position]', array(
			'default'           => kemet_get_option( 'v-headers-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			'required'          =>    array( KEMET_THEME_SETTINGS . '[header-layouts]', '==', 'header-main-layout-6' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[v-headers-position]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 21,
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
			'default'           => kemet_get_option( 'vertical-header-width' ),
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
				'priority'    => 22,
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
	 * Option: Enter Width
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[mini-vheader-width]', array(
			'default'           => kemet_get_option( 'mini-vheader-width' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[mini-vheader-width]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-header',
				'priority'    => 22,
				'label'       => __( 'Vertical Header Width', 'kemet-addons' ),
				'suffix'      => '',
				'input_attrs' => array(
					'min'  => 60,
					'step' => 1,
					'max'  => 100,
				),
                'active_callback' => 'kemet_header_layout8_style',
			)
		)
	);

	/**
	 * Option: Vertical Headers Enable Box Shadow
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[vheader-box-shadow]', array(
			'default'           => kemet_get_option( 'vheader-box-shadow' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[vheader-box-shadow]', array(
			'type'            => 'checkbox',
			'section'         => 'section-header',
			'label'           => __( 'Enable Box Shadow', 'kemet-addons' ),
            'priority'        => 23,
            'active_callback' => 'kemet_header_layout_vertical_style',
		)
	);
	/**
	* Option: Header Width
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-main-layout-width]', array(
			'default'           => kemet_get_option( 'header-main-layout-width' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header-main-layout-width]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 30,
			'label'    => __( 'Header Width', 'kemet-addons' ),
			'choices'  => array(
				'full'    => __( 'Full Width', 'kemet-addons' ),
				'content' => __( 'Content Width', 'kemet-addons' ),
			),
			'active_callback' => 'kemet_headers_with_content_width'	
		)
	);
	/**
	* Option: Transparent header
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-transparent]', array(
			'default'           => kemet_get_option( 'enable-transparent' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-transparent]', array(
			'type'            => 'checkbox',
			'section'         => 'section-header',
			'label'           => __( 'Enable Overlay Header', 'kemet-addons' ),
			'priority'        => 40,
			'active_callback' => 'kemet_header_transparent'	
		)
	);
	/**
	* Option: Title
	*/
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-hamburger-style]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Hamburger Menu Style', 'kemet-addons' ),
				'section'  => 'section-header',
				'priority' => 41,
				'settings' => array(),
				'active_callback' => 'kemet_header_withicon_layout_style',
			)
		)
	);
	//Header9
	/**
   	* Option: Header9 Logo Icon Separator Color 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[logo-icon-separator-color]', array(
		  'default'           => kemet_get_option( 'logo-icon-separator-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[logo-icon-separator-color]', array(
			'label'   => __( 'Logo Icon Separator Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 42,
            'active_callback' => 'kemet_header_layout9_style',
		  )
		)
	);
    /**
	 * Option: Icon Label
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-label]', array(
			'default'           => kemet_get_option( 'header-icon-label' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[header-icon-label]', array(
			'section'  => 'section-header',
			'priority' => 42,
			'label'    => __( 'Menu Icon Label', 'kemet-addons' ),
			'type'     => 'text',
			'active_callback' => 'kemet_header_has_icon_label',
		)
	);
	 /**
   	* Option: Icon Label Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-label-color]', array(
		  'default'           => kemet_get_option( 'header-icon-label-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-label-color]', array(
			'label'   => __( 'Menu Icon Label Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 43,
			'active_callback' => 'kemet_header_has_icon_label',
		  )
		)
	);
	 /**
   	* Option: Icon Label Hover Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-label-hover-color]', array(
		  'default'           => kemet_get_option( 'header-icon-label-hover-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-label-hover-color]', array(
			'label'   => __( 'Menu Icon Label Hover Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 44,
			'active_callback' => 'kemet_header_has_icon_label',
		  )
		)
	);
	/**
   	* Option: Icon Bars Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
		  'default'           => kemet_get_option( 'header-icon-bars-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
			'label'   => __( 'Menu Icon Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 45,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);
	/**
   	* Option: Icon Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-bg-color]', array(
		  'default'           => kemet_get_option( 'header-icon-bars-bg-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-bg-color]', array(
			'label'   => __( 'Menu Icon Background Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 46,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);
	/**
   	* Option: Icon Hover Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-h-color]', array(
		  'default'           => kemet_get_option( 'header-icon-bars-h-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-h-color]', array(
			'label'   => __( 'Menu Icon Hover Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 47,
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);

	/**
   	* Option: Icon Background Hover Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-bg-h-color]', array(
		  'default'           => kemet_get_option( 'header-icon-bars-bg-h-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-bg-h-color]', array(
			'label'   => __( 'Menu Icon Background Hover Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 48,
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
				'priority'    => 49,
				'label'       => __( 'Menu Icon Border Radius', 'kemet-addons' ),
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
			'default'           => kemet_get_option( 'menu-icon-bars-space' ),
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
				'priority'       => 49,
				'label'          => __( 'Menu Icon Spacing', 'kemet-addons' ),
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
   	* Option: Icon Background Color
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]', array(
		  'default'           => kemet_get_option( 'header-icon-bars-logo-bg-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-logo-bg-color]', array(
			'label'   => __( 'Logo and Menu Icon Background Color', 'kemet-addons' ),
			'section' => 'section-header',
			'priority' => 55,
			'active_callback' => 'has_menu_icon_bg_color',
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
	 * Option: Vertical Headers Border Style
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[vheader-border-style]', array(
			'default'           => kemet_get_option( 'vheader-border-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[vheader-border-style]', array(
			'type'     => 'select',
			'section'  => 'section-header',
			'priority' => 75,
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

	