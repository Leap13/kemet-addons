<?php
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-layouts]', array(
		'default'           => kemet_get_option( 'blog-layouts' ),
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
					'label' => __( 'Blog Layout 1', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-01.png',
				),
				'blog-layout-2' => array(
					'label' => __( 'Blog Layout 2', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-02.png',
				),
			),
		)
	)
);
/**
* Option: Blog Columns
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-grids]', array(
        'default'           => kemet_get_option('blog-grids'),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_select' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Select(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-grids]', array(
            'type'           => 'kmt-responsive-select',
            'section'        => 'section-blog',
            'priority'       => 5,
            'label'          => __( 'Blog Columns', 'kemet-addons' ),
            'choices'   => array(
                '1' => 'One',
                '2' => 'Two',
                '3' => 'Three',
                '4' => 'Four',
			),
			'active_callback' => 'kemet_blog_has_grids',
        )
    )
);
/**
* Option: Excerpt Length
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-excerpt-length]', array(
        'default'           => kemet_get_option( 'blog-excerpt-length' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[blog-excerpt-length]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-blog',
				'priority'    => 5,
				'label'       => __( 'Excerpt Length', 'kemet-addons' ),
				'suffix'      => '',
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
			)
		)
	);