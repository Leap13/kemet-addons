<?php

    $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[blog-layouts]', array(
 			'default'           => 'blog-layout-1',
 			'type'              => 'option',
 			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[blog-layouts]', array(
				'section'  => 'section-blog',
				'priority' => 1,
				'label'    => __( 'Blog Layouts', 'kemet-addons' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'blog-layout-1' => array(
						'label' => __( 'Thumbnail Layout', 'kemet-addons' ),
						'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-01.png',
					),
					'blog-layout-2' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-02.png',
					),
					'blog-layout-3' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-03.png',
					),
					'blog-layout-4' => array(
						'label' => __( 'Logo Center', 'kemet-addons' ),
						'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-04.png',
					),
				),
			)
		)
	);

