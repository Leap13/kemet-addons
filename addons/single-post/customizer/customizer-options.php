<?php

	/**
   	* Option: Next / Prev links
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[prev-next-links]', array(
		  'default'           => false,
		  'type'              => 'option',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[prev-next-links]', array(
            'type' => 'checkbox',
			'label'   => __( 'Disable Next / Prev Links', 'kemet-addons' ),
			'section' => 'section-blog-single',
			'priority' => 10,
		  )
		)
	);

	/**
   	* Option: Author Box
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-author-box]', array(
		  'default'           => false,
		  'type'              => 'option',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[enable-author-box]', array(
            'type' => 'checkbox',
			'label'   => __( 'Enable Author Box', 'kemet-addons' ),
			'section' => 'section-blog-single',
			'priority' => 11,
		  )
		)
	);
	/**
   	* Option: Page Title In Content
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-page-title-content-area]', array(
		  'default'           => false,
		  'type'              => 'option',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[enable-page-title-content-area]', array(
            'type' => 'checkbox',
			'label'   => __( 'Enable Post Title in Content Area', 'kemet-addons' ),
			'section' => 'section-blog-single',
			'priority' => 11,
		  )
		)
	);
	/**
   	* Option: Featured Image In Header 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[featured-image-header]', array(
		  'default'           => false,
		  'type'              => 'option',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[featured-image-header]', array(
            'type' => 'checkbox',
			'label'   => __( 'Enable Featured Image in Page Title', 'kemet-addons' ),
			'section' => 'section-blog-single',
			'priority' => 11,
		  )
		)
	);
	   /**
    * Option - Padding Inside Container
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[padding-inside-container]', array(
			'default'           => kemet_get_option( 'padding-inside-container' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[padding-inside-container]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-blog-single',
				'priority'       => 14,
				'label'          => __( 'Padding Inside Container', 'kemet' ),
				'linked_choices' => true,
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

	//Title and meta position
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[title-meta-position]', array(
			'default'           => 'left',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[title-meta-position]', array(
				'priority'       => 17,
				'section' => 'section-blog-single',
				'label'   => __( 'Title And Meta Position', 'kemet-addons' ),
				'choices'  => array(
					'left' => array(
						'icon' => 'dashicons-editor-alignleft'
					),
					'center' => array(
						'icon' => 'dashicons-editor-aligncenter'
					),
					'right' => array(
						'icon' => 'dashicons-editor-alignright'
					),	
				),
			)
		)
	);
	//Content Alignment
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[content-alignment]', array(
			'default'           => 'left',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[content-alignment]', array(
				'priority'       => 17,
				'section' => 'section-blog-single',
				'label'   => __( 'Content Alignment', 'kemet-addons' ),
				'choices'  => array(
					'left' => array(
						'icon' => 'dashicons-editor-alignleft'
					),
					'center' => array(
						'icon' => 'dashicons-editor-aligncenter'
					),
					'right' => array(
						'icon' => 'dashicons-editor-alignright'
					),	
				),
			)
		)
	);