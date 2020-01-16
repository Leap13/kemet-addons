<?php
/**
 * Page Title Section Customizer
 * 
 * @package Kemet Addons
 */
// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
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
				'label'    => __( 'Page Title Layouts', 'kemet-addons' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'page-title-layout-1' => array(
						'label' => __( 'Logo Left', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-01.png',
					),
					'page-title-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-02.png',
					),
					'page-title-layout-3' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-03.png',
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
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[page_title_alignment]', array(
				'priority'       => 5,
				'section' => 'section-page-title-header',
				'label'   => __( 'Page Title Alignment', 'kemet-addons' ),
				'choices'  => array(
					'align-left' => array(
						'icon' => 'dashicons-editor-alignleft'
					),
					'align-center' => array(
						'icon' => 'dashicons-editor-aligncenter'
					),
					'align-right' => array(
						'icon' => 'dashicons-editor-alignright'
					),	
				),
				'active_callback'	=> 'kemet_page_title_layout1_style'
			)
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
				'label'   => __( 'Page Title Background', 'kemet-addons' ),
				)
			)
		);

		/**
		 * Option: Merge Page Title with the main header
		 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'default'           => kemet_get_option( 'merge-with-header' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
			)
		);
		$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'type'            => 'checkbox',
				'section'         => 'section-page-title-header',
				'label'           => __( 'Merge Page title with Main Header', 'kemet-addons' ),
				'priority'        => 15,
				
			)
		);

    /**
    * Option - Page Title Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-space]', array(
			'default'           => kemet_get_option( 'page-title-space' ),
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
				'priority'       => 20,
				'label'          => __( 'Page Title Spacing', 'kemet-addons' ),
				'linked_choices' => true,
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
      * Option: Page Title Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-color]', array(
			'default'           => kemet_get_option( 'page-title-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-color]', array(
				'label'   => __( 'Page Title Color', 'kemet-addons' ),
				'priority'       => 25,
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
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-page-title-header',
				'priority'       => 30,
				'label'          => __( 'Page Title Font Size', 'kemet' ),
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
                  'label'    => __( 'Font Family', 'kemet-addons' ),
                  'section'  => 'section-page-title-header',
                  'priority' => 35,
                  'connect'  => KEMET_THEME_SETTINGS . '[page-title-font-weight]',
              )
          )
      );
      
       /**
          * Option: Page Title Font Weight
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[page-title-font-weight]', array(
                 'default'           => kemet_get_option( 'page-title-font-weight' ),
                 'type'              => 'option',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Typography(
                 $wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-weight]', array(
                     'type'     => 'kmt-font-weight',
                     'label'    => __( 'Font Weight', 'kemet-addons' ),
                     'section'  => 'section-page-title-header',
                     'priority' => 40,
                     'connect'  => KEMET_THEME_SETTINGS . '[page-title-font-family]',
 
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
                 'label'    => __( 'Text Transform', 'kemet-addons' ),
                 'type'     => 'select',
                 'priority' => 45,
                 'choices'  => array(
                     ''           => __( 'Inherit', 'kemet-addons' ),
                     'none'       => __( 'None', 'kemet-addons' ),
                     'capitalize' => __( 'Capitalize', 'kemet-addons' ),
                     'uppercase'  => __( 'Uppercase', 'kemet-addons' ),
                     'lowercase'  => __( 'Lowercase', 'kemet-addons' ),
                 ),
             )
         );
 
         /**
          * Option: Page Title Line Height
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-line-height]', array(
                 'default'           => kemet_get_option( 'pagetitle-line-height' ),
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
                     'priority'    => 50,
                     'label'       => __( 'Line Height', 'kemet-addons' ),
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
					'default'           => kemet_get_option('page-title-responsive'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[page-title-responsive]' ,array(
					'priority'   => 55,
					'section'    => 'section-page-title-header',
					'type'     => 'select',
					'label'    => __( 'Page Title Visibility', 'kemet-addons' ),
					'choices'  => array(
							'all-devices'        => __( 'Show On All Devices', 'kemet-addons' ),
							'hide-tablet'        => __( 'Hide On Tablet', 'kemet-addons' ),
							'hide-mobile'        => __( 'Hide On Mobile', 'kemet-addons' ),
							'hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet-addons' ),
					),
			)
	);

		  /**
          * Option: Page Title Bottom Line width
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]', array(
                 'default'           => kemet_get_option('pagetitle-bottomline-height'),
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
                     'priority'    => 60,
                     'label'       => __( 'Bottom Line Height', 'kemet-addons' ),
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
                 'default'           => kemet_get_option('pagetitle-bottomline-width'),
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
                     'priority'    => 65,
                     'label'       => __( 'Bottom Line width', 'kemet-addons' ),
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
			'default'           => kemet_get_option('pagetitle-bottomline-color'),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]', array(
				'label'   => __( 'Page Title Bottom Line Color', 'kemet-addons' ),
				'priority'       => 70,
				'section' => 'section-page-title-header',
			)
		)
	);
	
	/**
	 * Option: Show item title
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]', array(
			'default'           => kemet_get_option('breadcrumbs-enabled'),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Enable Breadcrumbs', 'kemet-addons' ),
            'priority'        => 1,
            
		)
	);
	/**
	 * Option: Show item title
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'default'           => kemet_get_option('show-item-title'),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Show Item Title', 'kemet-addons' ),
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
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[kemet-breadcrumb-separator]', array(
			'type'     => 'text',
			'section'  => 'section-breadcrumbs',
			'priority' => 10,
			'label'    => __( 'Custom Text / HTML', 'kemet-addons' ),
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
				'label'    => __( 'Posts Taxonomy', 'kemet-addons' ),
				'choices'  => array(
					'category' 	=> esc_html__( 'Category', 'kemet-addons' ),
					'post_tag' 	=> esc_html__( 'Tag', 'kemet-addons' ),
					'blog' 		=> esc_html__( 'Blog Page', 'kemet-addons' ),
				),
			)
		);

	/**
    * Option - Breadcrumbs Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-space]', array(
			'default'           => kemet_get_option( 'breadcrumbs-space' ),
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
				'label'          => __( 'Breadcrumbs Spacing', 'kemet-addons' ),
				'linked_choices' => true,
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
      * Option: Breadcrumbs Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
			'default'           => kemet_get_option( 'breadcrumbs-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
				'label'   => __( 'Breadcrumbs Text Color', 'kemet-addons' ),
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
			'default'           => kemet_get_option( 'breadcrumbs-link-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-color]', array(
				'label'   => __( 'Breadcrumbs Link Color', 'kemet-addons' ),
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
			'default'           => kemet_get_option( 'breadcrumbs-link-h-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-h-color]', array(
				'label'   => __( 'Breadcrumbs Link Hover Color', 'kemet-addons' ),
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
	 
	 /**
	 * Option: Page Title Border Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-border-right-color]', array(
			'default'           => kemet_get_option( 'page-title-border-right-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-border-right-color]', array(
			'section' => 'section-page-title-header',
			'priority' => 5,
			'label'   => __( 'Page Title Border Right Color', 'kemet-addons' ),
			'active_callback' => 'kemet_page_title_layout3_style',
			)
		)
	); 
	


