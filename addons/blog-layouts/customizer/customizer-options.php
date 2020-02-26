<?php

$defaults = Kemet_Theme_Options::defaults();

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-layouts]', array(
		'default'           => $defaults[ 'blog-layouts' ],
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
        'default'           => $defaults['blog-grids'],
        'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_select' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]', 
			'conditions' => '==', 
			'values' => 'blog-layout-2',
		),
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
                1 => 'One',
                2 => 'Two',
                3 => 'Three',
                4 => 'Four',
			),
        )
    )
);
/**
	* Option: Header Width
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-layout-mode]', array(
			'default'           => $defaults[ 'blog-layout-mode' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]', 
				'conditions' => '==', 
				'values' => 'blog-layout-2',
			),
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
		)
	);
/**
* Option: Excerpt Length
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-excerpt-length]', array(
        'default'           => $defaults[ 'blog-excerpt-length' ],
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
			'default'           => $defaults[ 'blog-posts-border-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]/'.KEMET_THEME_SETTINGS . '[blog-layouts]', 
				'conditions' => '==/==', 
				'values' => 'blog-layout-2/blog-layout-3',
			),
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
				)
			)
		);
	/**
   	* Option: Posts Border Color 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-posts-border-color]', array(
		  'default'           => $defaults[ 'blog-posts-border-color' ],
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		  'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]/'.KEMET_THEME_SETTINGS . '[blog-layouts]', 
			'conditions' => '==/==', 
			'values' => 'blog-layout-2/blog-layout-3',
		),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[blog-posts-border-color]', array(
			'label'   => __( 'Posts Border Color', 'kemet-addons' ),
			'section' => 'section-blog',
			'priority' => 5,
		  )
		)
	);
	/**
	* Option: Title & Meta Border Size
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-size]', array(
			'default'           => $defaults[ 'blog-title-meta-border-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]', 
				'conditions' => '==', 
				'values' => 'blog-layout-3',
			),
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
				)
			)
		);
	/**
   	* Option: Title Meta Border Color 
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]', array(
		  'default'           => $defaults[ 'blog-title-meta-border-color' ],
		  'type'              => 'option',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		  'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]', 
			'conditions' => '==', 
			'values' => 'blog-layout-3',
		),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
		  $wp_customize, KEMET_THEME_SETTINGS . '[blog-title-meta-border-color]', array(
			'label'   => __( 'Title & Meta Border Color', 'kemet-addons' ),
			'section' => 'section-blog',
			'priority' => 5,
		  )
		)
	);
		/**
* Option: Display Post Structure
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-post-structure]', array(
        'default'           => $defaults[ 'blog-post-structure' ],
        'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[blog-layouts]/'.KEMET_THEME_SETTINGS . '[blog-layouts]', 
			'conditions' => '==/==', 
			'values' => 'blog-layout-1/blog-layout-2',
		),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-post-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-blog',
            'priority' => 15,
            'label'    => __( 'Blog Post Structure', 'kemet' ),
            'choices'  => array(
                'image'      => __( 'Featured Image', 'kemet' ),
                'title-meta' => __( 'Title & Blog Meta', 'kemet' ),
                'content-readmore' => __( 'Content & Readmore', 'kemet' ),
            ),
        )
    )
);
	/**
	 * Option: Overlay Image
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[overlay-image-style]', array(
			'default'           => $defaults[ 'overlay-image-style' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[overlay-image-style]', array(
			'type'     => 'select',
			'section'  => 'section-blog',
			'priority' => 119,
			'label'    => __( 'Overlay Image', 'kemet-addons' ),
			'choices'  => array(
				'none'    => __( 'None', 'kemet-addons' ),
				'framed' => __( 'Framed', 'kemet-addons' ),
				'diagonal' => __( 'Diagonal', 'kemet-addons' ),
				'bordered' => __( 'Bordered', 'kemet-addons' ),
				'squares' => __( 'Squares', 'kemet-addons' ),
			),
		)
	);
 	
/**
* Option: Title
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-blog-overlay-image]', array(
		'sanitize_callback' => false,
		'dependency'  => array(
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=', 
			'values' => 'none',
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
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]/' . KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=/!=', 
			'values' => 'none/diagonal',
			'operators' => '&&'
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
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=', 
			'values' => 'none',
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
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=', 
			'values' => 'none',
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
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=', 
			'values' => 'none',
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
			'controls' =>  KEMET_THEME_SETTINGS . '[overlay-image-style]', 
			'conditions' => '!=', 
			'values' => 'none',
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
/**
* Option - Container Inner Spacing
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[blog-container-inner-spacing]', array(
		'default'           => $defaults[ 'blog-container-inner-spacing' ],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
	)
);
$wp_customize->add_control(
	new Kemet_Control_Responsive_Spacing(
		$wp_customize, KEMET_THEME_SETTINGS . '[blog-container-inner-spacing]', array(
			'type'           => 'kmt-responsive-spacing',
			'section'        => 'section-blog',
			'priority'       => 150,
			'label'          => __( 'Spacing', 'kemet' ),
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