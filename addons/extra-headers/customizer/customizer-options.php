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
            'active_callback' => 'kemet_header_withicon_layout_style',
		  )
		)
	);
    

   /**
   	* Option: Icon Color
    */
  $wp_customize->add_setting(
    	KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
            //'active_callback'  => array($this, 'header-main-layout-5'),
		)
  	);
  	$wp_customize->add_control(
    	new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[header-icon-bars-color]', array(
				'label'   => __( 'Icon Color', 'kemet' ),
				'section' => 'section-header',
				'priority' => 12,
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

//if( class_exists( 'KFW' ) ) {
//
//  //
//  // Set a unique slug-like ID
//  $prefix = 'my_framework';
//
//  //
//  // Create customize options
//  KFW::createCustomizeOptions( $prefix );
//
//  //
//  // Create a section
//  KFW::createSection( $prefix, array(
//    //'title'  => 'Tab Title 1',
//    'assign' => 'section-container-layout',
//    'fields' => array(
//
//      //
//      // A text field
//      array(
//        'id'    => 'opt-text-1',
//        'type'  => 'checkbox',
//        'title' => 'Text 12222222222',
//      ),
////       array(
////            'id'        => 'opt-image-select-1',
////            'type'      => 'image_select',
////            'title'     => 'Image Select',
////            'options'   => array(
////              'value-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
////              'value-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
////              'value-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
////            ),
////           //'default'   => 'value-2'
////          ),
//      array(
//        'id'          => 'site-content-layouteee',
//        'type'        => 'image_select',
//        'title'       => __('Page Layout', 'kemet-addons'),
//        'placeholder' => 'Select an option',
//        'options'     => array(
//          'boxed-container'            => 'Boxed Layout',
//          'boxed-container1'            => 'Boxed Layout',
//          'boxed-container2'            => 'Boxed Layout',
//        ),
//    ),
//        
//    )
//  ) );
//}

	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-top-header]', array(
			'default'           => kemet_get_option( 'enable-top-header' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-top-header]', array(
			'type'     => 'checkbox',
			'section'  => 'section-topbar-header',
			'label'    => __( 'Top Header', 'kemet' ),
			'priority' => 0,
		)
	);

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-1]', array(
		'default'           => kemet_get_option( 'top-section-1' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
			new Kemet_Control_Sortable(
		$wp_customize, KEMET_THEME_SETTINGS . '[top-section-1]', array(
		'type'     => 'kmt-sortable',
		'section'  => 'section-topbar-header',
		'priority' => 5,
		'label'    => __( 'Top Section 1', 'kemet' ),
		'choices'  => array(
				'search'    => __( 'Search', 'kemet' ),
				'menu' => __( 'Menu', 'kemet' ),
				'widget'    => __( 'Widget', 'kemet' ),
				'text-html' => __( 'Text / HTML', 'kemet' ),
		),
        'active_callback' => 'top_header_enabled',
	)
	)
	);


	// Layout Panel Header Top bar
	$wp_customize->add_section(
		new Kemet_WP_Customize_Section(
			$wp_customize, 'section-topbar-header', array(
					'title'    => __( 'Top Bar Header', 'kemet' ),
					'panel'    => 'panel-layout',
					'section'  => 'section-header-group',
					'priority' => 15,
				)
		)
	);
	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'default'           => kemet_get_option( 'top-section-1-html' ),
			'type'              => 'option',
			//'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 10,
			'label'    => __( 'Custom Text / HTML', 'kemet' ),
            'active_callback' => 'top_header_enabled',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[topbar-section-1-html]', array(
				'selector'            => '.kemet-top-header-section-1',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_1_html' ),
			)
		);
	}

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-2]', array(
		'default'           => kemet_get_option( 'top-section-2' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
			new Kemet_Control_Sortable(
		$wp_customize, KEMET_THEME_SETTINGS . '[top-section-2]', array(
		'type'     => 'kmt-sortable',
		'section'  => 'section-topbar-header',
		'priority' => 15,
		'label'    => __( 'Top  Section 2', 'kemet' ),
		'choices'  => 
			array(
				'search'    => __( 'Search', 'kemet' ),
				'menu' => __( 'Menu', 'kemet' ),
				'widget'    => __( 'Widget', 'kemet' ),
				'text-html' => __( 'Text / HTML', 'kemet' ),
		),
        'active_callback' => 'top_header_enabled',
	)
					)
);

	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'default'           => kemet_get_option( 'top-section-2-html' ),
			'type'              => 'option',
			//'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 20,
			'label'    => __( 'Custom Text / HTML', 'kemet' ),
            'active_callback' => 'top_header_enabled',
		)
	);

		if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[topbar-section-2-html]', array(
				'selector'            => '.kemet-top-header-section-2',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_2_html' ),
			)
		);
	}
    
    
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-padding]', array(
			'default'           => kemet_get_option( 'topbar-padding' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-padding]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 30,
				'label'          => __( 'Top Bar Padding', 'kemet' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
						'top'    => __( 'Top', 'kemet' ),
						'right'  => __( 'Right', 'kemet' ),
						'bottom' => __( 'Bottom', 'kemet' ),
						'left'   => __( 'Left', 'kemet' ),
				),
                'active_callback' => 'top_header_enabled',
			)
		)
	);
    
    	/**
	 * Option: Top Bar Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
                'priority'       => 31,
                'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar Background Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);

	/**
	 * Option: Top Bar Font Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
			'default'           => kemet_get_option( 'topbar-font-size' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_typo' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
				'type'        => 'kmt-responsive',
				'section'     => 'section-topbar-header',
				'priority'    => 35,
				'label'       => __( 'Top Bar Font Size', 'kemet' ),
				'input_attrs' => array(
					'min' => 0,
				),
				'units'       => array(
					'px' => 'px',
					'em' => 'em',
					
				),
                'active_callback' => 'top_header_enabled',
			)
		)
	);
	/**
     * Option:Top Bar Responsive
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[topbar-responsive]',array(
					'default'           => kemet_get_option('sticky-responsive'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[topbar-responsive]' ,array(
					'priority'   => 36,
					'section'    => 'section-topbar-header',
					'type'     => 'select',
					'label'    => __( 'Top Bar Visibility', 'kemet' ),
					'choices'  => array(
							'all-devices'        => __( 'Show On All Devices', 'kemet' ),
							'hide-tablet'        => __( 'Hide On Tablet', 'kemet' ),
							'hide-mobile'        => __( 'Hide On Mobile', 'kemet' ),
							'hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet' ),
					),
                'active_callback' => 'top_header_enabled',
			)
	);


	/**
  * Option:Top Bar Text Color
  */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
				'label'   => __( 'Top Bar Text Color', 'kemet' ),
				'priority'       => 37,
				'section' => 'section-topbar-header',
                'active_callback' => 'top_header_enabled',
			)
		)
	);
	
	/**
	 * Option: Top Bar Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
                'priority'       => 40,
                'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar Background Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);



	 /**
      * Option:Top Bar Link Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
				'label'   => __( 'Top Bar Link Color', 'kemet' ),
				'priority'       => 50,
				'section' => 'section-topbar-header',
                'active_callback' => 'top_header_enabled',
			)
		)
	);

	/**
      * Option:Top Bar Link Hover Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
				'label'   => __( 'Top Bar Link Hover Color', 'kemet' ),
				'priority'       => 55,
				'section' => 'section-topbar-header',
                'active_callback' => 'top_header_enabled',
			)
		)
	);

//	/**
//	 * Option: Top Bar Border Bottom Size
//	 */
//	$wp_customize->add_setting(
//		KEMET_THEME_SETTINGS . '[topbar-border-bottom-size]', array(
//			'default'           => kemet_get_option( 'topbar-border-bottom-size' ),
//			'type'              => 'option',
//			'transport'         => 'postMessage',
//			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
//		)
//	);
//	$wp_customize->add_control(
//		KEMET_THEME_SETTINGS . '[topbar-border-bottom-size]', array(
//			'type'        => 'number',
//			'section'     => 'section-topbar-header',
//			'priority'    => 60,
//			'label'       => __( 'Top Bar Border Bottom Size', 'kemet' ),
//			'input_attrs' => array(
//				'min'  => 0,
//				'step' => 1,
//				'max'  => 600,
//			),
//		)
//	);
        
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
			'default'           => kemet_get_option( 'topbar-padding' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 30,
				'label'          => __( 'Top Bar Border Size', 'kemet' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em'),
				'choices'        => array(
						'top'    => __( 'Top', 'kemet' ),
						'right'  => __( 'Right', 'kemet' ),
						'bottom' => __( 'Bottom', 'kemet' ),
						'left'   => __( 'Left', 'kemet' ),
				),
                'active_callback' => 'top_header_enabled',
			)
		)
	);

	/**
	 * Option: Top Bar Border Bottom Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-bottom-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-bottom-color]', array(
				'section'  => 'section-topbar-header',
				'priority' => 65,
				'label'    => __( 'Top Bar Border Bottom Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);

	/**
	 * Option:Top Bar SubMenu Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
				'priority'       => 70,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Background Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);


	/**
	 * Option:Top Bar SubMenu Items Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
				'priority'       => 75,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Items Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);


	/**
	 * Option:Top Bar SubMenu Items Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
				'priority'       => 80,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Items Hover Color', 'kemet' ),
                'active_callback' => 'top_header_enabled',
			)
		)
	);