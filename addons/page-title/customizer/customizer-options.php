<?php
/**
 * Page Title Section Customizer
 * 
 * @package Kemet Addons
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
     * Option:Page Title Alignment
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page-title-alignmrent]',array(
					'default'           => kemet_get_option('page-title-alignmrent'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[page-title-alignmrent]' ,array(
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
				'priority'       => 10,
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
	 * Option: header Background
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
				'priority' => 15,
				'label'   => __( 'Page Title Background', 'kemet' ),
				)
			)
		);

	/**
	 * Option: Show item title
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
            'priority'        => 20,
            
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
			'section'         => 'section-page-title-header',
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
			'section'         => 'section-page-title-header',
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
			'section'  => 'section-page-title-header',
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
				'section'  => 'section-page-title-header',
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


