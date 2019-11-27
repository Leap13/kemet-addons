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
			'label'   => __( 'Featured Image In Header', 'kemet-addons' ),
			'section' => 'section-blog-single',
			'priority' => 11,
		  )
		)
	);
	/**
	 * Option: Related Posts Taxonomy
	 */

	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[kemet-related-posts-taxonomy]', array(
			'default'           => 'category',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[kemet-related-posts-taxonomy]', array(
			'type'     => 'select',
			'section'  => 'section-blog-single',
			'priority' => 12,
			'label'    => __( 'Posts Taxonomy', 'kemet-addons' ),
			'choices'  => array(
				'tag' 		=> __( 'tag', 'kemet-addons' ),
				'category' 	=> __( 'Category', 'kemet-addons' ),
			),
		)
	);