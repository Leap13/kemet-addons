<?php
/**
 * Page Title Section Customizer
 * 
 * @package Kemet Addons
 */

// $wp_customize->add_setting(
// 	KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
// 		'default'           => kemet_get_option( 'page-title-layouts' ),
// 		'type'              => 'option',
// 		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
// 	)
// );
// $wp_customize->add_control(
// 			new Kemet_Control_Sortable(
// 		$wp_customize, KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
// 		'type'     => 'kmt-radio-image',
// 		'section'  => 'section-page-title-header',
// 		'priority' => 50,
// 		'label'    => __( 'Page Title Layouts', 'kemet' ),
// 		'choices'  => array(
// 					'page-title-layout-1' => array (
// 						'label' => __( 'Page Title Layout 1', 'kemet' ),
// 						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
// 					),
// 					'page-title-layout-2' => array (
// 						'label' => __( 'Page Title Layout 2' , 'kemet' ),
//                         'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
//                     ),
// 				),
// 	)
// 	)
// 	);

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
					'header-main-layout-1' => array(
						'label' => __( 'Logo Left', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
					'header-main-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/logo-center.png',
					),
				),
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
			'section'         => 'section-page-title-header',
			'label'           => __( 'Enable Breadcrumbs', 'kemet' ),
            'priority'        => 5,
            
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


