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
			'priority' => 10,
		  )
		)
	);