<?php

$defaults = Kemet_Theme_Options::defaults();

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
				'blog-layout-3' => array(
					'label' => __( 'Blog Layout 3', 'kemet-addons' ),
					'path'  => KEMET_BLOG_LAYOUTS_URL . '/assets/images/header-layout-02.png',
				),
				'blog-layout-4' => array(
					'label' => __( 'Blog Layout 4', 'kemet-addons' ),
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
        'default'           => '2',
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
	* Option: Header Width
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-layout-mode]', array(
			'default'           => kemet_get_option( 'blog-layout-mode' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[blog-layout-mode]', array(
			'type'     => 'select',
			'section'  => 'section-blog',
			'priority' => 5,
			'label'    => __( 'Grid Style', 'kemet-addons' ),
			'choices'  => array(
				'masonry'    => __( 'Masonry', 'kemet-addons' ),
				'fit-rows' => __( 'Fit Rows', 'kemet-addons' ),
			),
			'active_callback' => 'kemet_blog_layout2'	
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
	/**
	* Option: Border Size
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-posts-border-size]', array(
			'default'           => kemet_get_option( 'blog-posts-border-size' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
			new Kemet_Control_Slider(
				$wp_customize, KEMET_THEME_SETTINGS . '[blog-posts-border-size]', array(
					'type'        => 'kmt-slider',
					'section'     => 'section-blog',
					'priority'    => 5,
					'label'       => __( 'Border Size', 'kemet-addons' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
					'active_callback' => 'kemet_blog_has_border'
				)
			)
		);
	/**
   	* Option: Posts Border Color 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-posts-border-color]', array(
		  'default'           => kemet_get_option( 'blog-posts-border-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[blog-posts-border-color]', array(
			'label'   => __( 'Posts Border Color', 'kemet-addons' ),
			'section' => 'section-blog',
			'priority' => 5,
			'active_callback' => 'kemet_blog_has_border'
		  )
		)
	);
	/**
	* Option: Title & Meta Border Size
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-size]', array(
			'default'           => kemet_get_option( 'blog-title-meta-border-size' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);
	$wp_customize->add_control(
			new Kemet_Control_Slider(
				$wp_customize, KEMET_THEME_SETTINGS . '[blog-title-meta-border-size]', array(
					'type'        => 'kmt-slider',
					'section'     => 'section-blog',
					'priority'    => 5,
					'label'       => __( 'Border Size', 'kemet-addons' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
					'active_callback' => 'kemet_blog_has_title_meta_border'
				)
			)
		);
	/**
   	* Option: Title Meta Border Color 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]', array(
		  'default'           => kemet_get_option( 'blog-title-meta-border-color' ),
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]', array(
			'label'   => __( 'Title & Meta Border Color', 'kemet-addons' ),
			'section' => 'section-blog',
			'priority' => 5,
			'active_callback' => 'kemet_blog_has_title_meta_border'
		  )
		)
	);

	/**
	 * Option: Enable Overlay Image
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-overlay-image]', array(
			'default'           => $defaults[ 'enable-overlay-image' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-overlay-image]', array(
			'type'            => 'checkbox',
			'section'         => 'section-blog',
			'label'           => __( 'Enable Overlay Image', 'kemet-addons' ),
            'priority'        => 119,
		)
	);
/**
* Option: Title
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-blog-overlay-image]', array(
		'sanitize_callback' => false,
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-blog-overlay-image]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Overlay Image Style', 'kemet-addons' ),
            'section'  => 'section-blog',
            'priority' => 120,
            'settings' => array(),
        )
    )
);
/**
* Option: Overlay Image Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[overlay-image-bg-color]', array(
        'default'           => $defaults[ 'overlay-image-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[overlay-image-bg-color]', array(
            'section'  => 'section-blog',
            'priority' => 125,
            'label'    => __( 'Overlay Image Background Color', 'kemet-addons' ),
        )
    )
);
/**
* Option:Post Overlay Icon Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[overlay-icon-color]', array(
        'default'           => $defaults[ 'overlay-icon-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[overlay-icon-color]', array(
            'label'   => __( 'Overlay Icon Color', 'kemet-addons' ),
            'priority'       => 130,
            'section' => 'section-blog',
        )
    )
);

/**
* Option:Post Overlay Icon Color Hover
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[overlay-icon-h-color]', array(
        'default'           => $defaults[ 'overlay-icon-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[overlay-icon-h-color]', array(
            'label'   => __( 'Overlay Icon Hover Color', 'kemet-addons' ),
            'priority'       => 135,
            'section' => 'section-blog',
        )
    )
);

/**
* Option: Overlay Icon Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[overlay-icon-bg-color]', array(
        'default'           => $defaults[ 'overlay-icon-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[overlay-icon-bg-color]', array(
            'section'  => 'section-blog',
            'priority' => 140,
            'label'    => __( 'Overlay Icon Background Color', 'kemet-addons' ),
        )
    )
);
/**
* Option: Overlay Icon Background Color Hover
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[overlay-icon-bg-h-color]', array(
        'default'           => $defaults[ 'overlay-icon-bg-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[enable-overlay-image]', 
			'conditions' => '==', 
			'values' => true,
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[overlay-icon-bg-h-color]', array(
            'section'  => 'section-blog',
            'priority' => 145,
            'label'    => __( 'Overlay Icon Background Hover Color', 'kemet-addons' ),
        )
    )
);