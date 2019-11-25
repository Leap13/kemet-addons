<?php

	/**
   	* Option: Next / Prev links
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[prev-next-links]', array(
		  'default'           => false,
		  'type'              => 'option',
		  'transport'         => 'postMessage',
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