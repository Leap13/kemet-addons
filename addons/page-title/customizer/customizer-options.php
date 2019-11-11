<?php
/**
 * Page Title Section Customizer
 * 
 * @package Kemet Addons
 */
	/**
     * Option: Page Title Layouts
     */
    $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
 			'default'           => kemet_get_option( 'page-title-layouts' ),
 			'type'              => 'option',
 			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
				'section'  => 'section-page-title-header',
				'priority' => 1,
				'label'    => __( 'Page Title Layouts', 'kemet' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'page-title-layout-1' => array(
						'label' => __( 'Logo Left', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
					'page-title-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
				),
			)
		)
	);

	/**
     * Option: Page Title Alignment
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page_title_alignment]',array(
					'default'           => kemet_get_option('page_title_alignment'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[page_title_alignment]' ,array(
					'priority'   => 5,
					'section'    => 'section-page-title-header',
					'type'     => 'select',
					'label'    => __( 'Page Title Alignment', 'kemet' ),
					'active_callback' => 'kemet_page_title_layout1_style',
					'choices'  => array(
							'align-center'        => __( 'Center', 'kemet' ),
							'align-right'        => __( 'Right', 'kemet' ),
							'align-left'        => __( 'Left', 'kemet' ),
					),
			)
	);

	/**
	 * Option: Page Title Background
	 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page-title-bg-obj]', array(
				'default'           => kemet_get_option( 'page-title-bg-obj' ),
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_background_obj' ),
			)
		);
		$wp_customize->add_control(
			new Kemet_Control_Background(
				$wp_customize, KEMET_THEME_SETTINGS . '[page-title-bg-obj]', array(
				'type'    => 'kmt-background',
				'section' => 'section-page-title-header',
				'priority' => 10,
				'label'   => __( 'Page Title Background', 'kemet' ),
				)
			)
		);

		/**
		 * Option: Merge Page Title with the main header
		 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'default'           => false,
				'type'              => 'option',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
			)
		);
		$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'type'            => 'checkbox',
				'section'         => 'section-page-title-header',
				'label'           => __( 'Merge Page title with Main Header', 'kemet' ),
				'priority'        => 15,
				
			)
		);

    /**
    * Option - Page Title Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-space]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-space]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-page-title-header',
				'priority'       => 16,
				'label'          => __( 'Page Title Spacing', 'kemet' ),
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

	  /**
      * Option: Page Title Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-color]', array(
				'label'   => __( 'Page Title Color', 'kemet' ),
				'priority'       => 17,
				'section' => 'section-page-title-header',
			)
		)
	);
		/**
	 * Option: Page Title Font Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-font-size]', array(
			'default'           => kemet_get_option( 'page-title-font-size' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_typo' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-size]', array(
				'type'        => 'kmt-responsive',
				'section'     => 'section-page-title-header',
				'priority'    => 18,
				'label'       => __( 'Page Title Font Size', 'kemet' ),
				'input_attrs' => array(
					'min' => 0,
				),
				'units'       => array(
					'px' => 'px',
					'em' => 'em',
					
				),
			)
		)
	);
	   /**
       * Option: Page Title Font Family
       */
      $wp_customize->add_setting(
          KEMET_THEME_SETTINGS . '[page-title-font-family]', array(
              'default'           => kemet_get_option( 'page-title-font-family' ),
              'type'              => 'option',
              'sanitize_callback' => 'sanitize_text_field',
          )
      );
      $wp_customize->add_control(
          new Kemet_Control_Typography(
              $wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-family]', array(
                  'type'     => 'kmt-font-family',
                  'label'    => __( 'Font Family', 'kemet' ),
                  'section'  => 'section-page-title-header',
                  'priority' => 20,
                  'connect'  => KEMET_THEME_SETTINGS . '[page-title-font-weight]',
              )
          )
      );
      
       /**
          * Option: Page Title Font Weight
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-font-weight]', array(
                 'default'           => kemet_get_option( 'pagetitle-font-weight' ),
                 'type'              => 'option',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Typography(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-font-weight]', array(
                     'type'     => 'kmt-font-weight',
                     'label'    => __( 'Font Weight', 'kemet' ),
                     'section'  => 'section-page-title-header',
                     'priority' => 25,
                     'connect'  => KEMET_THEME_SETTINGS . '[footer-font-family]',
 
                 )
             )
         );
 
         /**
          * Option: Page Title Text Transform
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-text-transform]', array(
                 'default'           => kemet_get_option( 'pagetitle-text-transform' ),
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
             )
         );
         $wp_customize->add_control(
             KEMET_THEME_SETTINGS . '[pagetitle-text-transform]', array(
                 'section'  => 'section-page-title-header',
                 'label'    => __( 'Text Transform', 'kemet' ),
                 'type'     => 'select',
                 'priority' => 30,
                 'choices'  => array(
                     ''           => __( 'Inherit', 'kemet' ),
                     'none'       => __( 'None', 'kemet' ),
                     'capitalize' => __( 'Capitalize', 'kemet' ),
                     'uppercase'  => __( 'Uppercase', 'kemet' ),
                     'lowercase'  => __( 'Lowercase', 'kemet' ),
                 ),
             )
         );
 
         /**
          * Option: Page Title Line Height
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-line-height]', array(
                 'default'           => '',
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Slider(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-line-height]', array(
                     'type'        => 'kmt-slider',
                     'section'     => 'section-page-title-header',
                     'priority'    => 35,
                     'label'       => __( 'Line Height', 'kemet' ),
                     'suffix'      => '',
                     'input_attrs' => array(
                         'min'  => 1,
                         'step' => 0.01,
                         'max'  => 5,
                     ),
                 )
             )
		 );

		 	/**
     * Option:Page Title Responsive
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page-title-responsive]',array(
					'default'           => kemet_get_option('sticky-responsive'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[page-title-responsive]' ,array(
					'priority'   => 40,
					'section'    => 'section-page-title-header',
					'type'     => 'select',
					'label'    => __( 'Page Title Visibility', 'kemet' ),
					'choices'  => array(
							'all-devices'        => __( 'Show On All Devices', 'kemet' ),
							'hide-tablet'        => __( 'Hide On Tablet', 'kemet' ),
							'hide-mobile'        => __( 'Hide On Mobile', 'kemet' ),
							'hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet' ),
					),
			)
	);

		  /**
          * Option: Page Title Bottom Line width
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]', array(
                 'default'           => '',
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Slider(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]', array(
                     'type'        => 'kmt-slider',
                     'section'     => 'section-page-title-header',
                     'priority'    => 45,
                     'label'       => __( 'Bottom Line Height', 'kemet' ),
                     'suffix'      => '',
                     'input_attrs' => array(
                         'min'  => 0,
                         'max'  => 20,
                     ),
                 )
             )
		 );


		  /**
          * Option: Page Title Bottom Line width
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]', array(
                 'default'           => '',
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Slider(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]', array(
                     'type'        => 'kmt-slider',
                     'section'     => 'section-page-title-header',
                     'priority'    => 45,
                     'label'       => __( 'Bottom Line width', 'kemet' ),
                     'suffix'      => '',
                     'input_attrs' => array(
                         'min'  => 0,
                         'max'  => 300,
                     ),
                 )
             )
		 );
		 
	 /**
      * Option: Page Title Bottom Line Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]', array(
				'label'   => __( 'Page Title Bottom Line Color', 'kemet' ),
				'priority'       => 50,
				'section' => 'section-page-title-header',
			)
		)
	);



























		 







	/**
	 * Option: Kemet Breadcrumbs
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[kemet_has_breadcrumbs]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[kemet_has_breadcrumbs]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Enable Breadcrumbs', 'kemet' ),
            'priority'        => 50,
            
		)
	);
	/**
	 * Option: Show item title
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'default'           => false,
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Show Item Title', 'kemet' ),
            'priority'        => 10,
            
		)
	);
	/**
	 * Option: Breadcrumbs Separator
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[kemet-breadcrumb-separator]', array(
			'default'           => kemet_get_option( 'kemet-breadcrumb-separator' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[kemet-breadcrumb-separator]', array(
			'section'  => 'section-breadcrumbs',
			'priority' => 20,
			'label'    => __( 'Breadcrumbs Separator', 'kemet' ),
			'type'     => 'text',
		)
	);

	/**
	 * Option: Breadcrumbs Taxonomy
	 */

		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[kemet-breadcrumb-posts-taxonomy]', array(
				'default'           => kemet_get_option( 'kemet-breadcrumb-posts-taxonomy' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			)
		);
		$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[kemet-breadcrumb-posts-taxonomy]', array(
				'type'     => 'select',
				'section'  => 'section-breadcrumbs',
				'priority' => 20,
				'label'    => __( 'Posts Taxonomy', 'kemet' ),
				'choices'  => array(
					'none' 		=> esc_html__( 'None', 'kemet' ),
					'category' 	=> esc_html__( 'Category', 'kemet' ),
					'post_tag' 	=> esc_html__( 'Tag', 'kemet' ),
					'blog' 		=> esc_html__( 'Blog Page', 'kemet' ),
				),
			)
		);

	/**
    * Option - Breadcrumbs Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-space]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-space]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-breadcrumbs',
				'priority'       => 50,
				'label'          => __( 'Breadcrumbs Spacing', 'kemet' ),
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


	  /**
      * Option: Breadcrumbs Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
				'label'   => __( 'Breadcrumbs Text Color', 'kemet' ),
				'priority'       => 57,
				'section' => 'section-breadcrumbs',
			)
		)
	);

	  /**
      * Option: Breadcrumbs Link Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-link-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-color]', array(
				'label'   => __( 'Breadcrumbs Link Color', 'kemet' ),
				'priority'       => 57,
				'section' => 'section-breadcrumbs',
			)
		)
	);

	  /**
      * Option: Breadcrumbs Link Hover Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-link-h-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-h-color]', array(
				'label'   => __( 'Breadcrumbs Link Hover Color', 'kemet' ),
				'priority'       => 57,
				'section' => 'section-breadcrumbs',
			)
		)
	);
    
    /**
      * Option: Breadcrumbs Home Style
      */
        $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[kemet_breadcrumbs_home]', array(
 			'default'           => kemet_get_option( 'kemet_breadcrumbs_home' ),
 			'type'              => 'option',
 			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[kemet_breadcrumbs_home]', array(
				'section'  => 'section-breadcrumbs',
				'priority' => 70,
				'label'    => __( 'Breadcrumbs Home style', 'kemet' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'text' => array(
						'label' => __( 'Text', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
					'icon' => array(
						'label' => __( 'Icon', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
				),
			)
		)
	);
    
    /**
      * Option: Breadcrumbs Prefix Text
      */
        $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[kemet_breadcrumbs_prefix]', array(
 			'default'           => kemet_get_option( 'kemet_breadcrumbs_prefix' ),
 			'type'              => 'option',
 			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[kemet_breadcrumbs_prefix]', array(
				'section'  => 'section-breadcrumbs',
				'priority' => 70,
				'label'    => __( 'Breadcrumbs Prefix Text', 'kemet' ),
				'type'     => 'text',
			)
		)
	);
	


