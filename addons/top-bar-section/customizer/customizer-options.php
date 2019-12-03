<?php
/**
 * Top Bar Section Customizer
 * 
 * @package Kemet Addons
 */

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-1]', array(
		'default'           => kemet_get_option( 'top-section-1' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
			new Kemet_Control_Sortable(
		$wp_customize, KEMET_THEME_SETTINGS . '[top-section-1]', array(
		'type'     => 'kmt-sortable',
		'section'  => 'section-topbar-header',
		'priority' => 5,
		'label'    => __( 'Top Section 1', 'kemet-addons' ),
		'choices'  => array(
				'search'    => __( 'Search', 'kemet-addons' ),
				'menu' => __( 'Menu', 'kemet-addons' ),
				'widget'    => __( 'Widget', 'kemet-addons' ),
				'text-html' => __( 'Text / HTML', 'kemet-addons' ),
		),
	)
	)
	);

	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'default'           => kemet_get_option( 'top-section-1-html' ),
			'type'              => 'option',
			//'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 10,
			'label'    => __( 'Custom Text / HTML', 'kemet-addons' ),
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[topbar-section-1-html]', array(
				'selector'            => '.kemet-top-header-section-1',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_1_html' ),
			)
		);
	}

$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[top-section-2]', array(
		'default'           => kemet_get_option( 'top-section-2' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
	)
);
$wp_customize->add_control(
			new Kemet_Control_Sortable(
		$wp_customize, KEMET_THEME_SETTINGS . '[top-section-2]', array(
		'type'     => 'kmt-sortable',
		'section'  => 'section-topbar-header',
		'priority' => 15,
		'label'    => __( 'Top  Section 2', 'kemet-addons' ),
		'choices'  => 
			array(
				'search'    => __( 'Search', 'kemet-addons' ),
				'menu' => __( 'Menu', 'kemet-addons' ),
				'widget'    => __( 'Widget', 'kemet-addons' ),
				'text-html' => __( 'Text / HTML', 'kemet-addons' ),
		),
	)
					)
);

	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'default'           => kemet_get_option( 'top-section-2-html' ),
			'type'              => 'option',
			//'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 20,
			'label'    => __( 'Custom Text / HTML', 'kemet-addons' ),
		)
	);

		if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[topbar-section-2-html]', array(
				'selector'            => '.kemet-top-header-section-2',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_2_html' ),
			)
		);
	}
    
    
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-padding]', array(
			'default'           => kemet_get_option( 'topbar-padding' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-padding]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 30,
				'label'          => __( 'Top Bar Padding', 'kemet-addons' ),
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
	 * Option: Top Bar Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
			'default'           => kemet_get_option( 'topbar-bg-color' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
                'priority'       => 31,
                'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar Background Color', 'kemet-addons' ),
			)
		)
	);

	/**
	 * Option: Top Bar Font Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
			'default'           => kemet_get_option( 'topbar-font-size' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_typo' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
				'type'        => 'kmt-responsive',
				'section'     => 'section-topbar-header',
				'priority'    => 35,
				'label'       => __( 'Top Bar Font Size', 'kemet-addons' ),
				'input_attrs' => array(
					'min' => 0,
				),
				'units'       => array(
					'px' => 'px',
					'em' => 'em',
					
				),
			)
		)
	);
	/**
     * Option:Top Bar Responsive
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[topbar-responsive]',array(
					'default'           => kemet_get_option('sticky-responsive'),
					'type'              => 'option',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[topbar-responsive]' ,array(
					'priority'   => 36,
					'section'    => 'section-topbar-header',
					'type'     => 'select',
					'label'    => __( 'Top Bar Visibility', 'kemet-addons' ),
					'choices'  => array(
							'all-devices'        => __( 'Show On All Devices', 'kemet-addons' ),
							'hide-tablet'        => __( 'Hide On Tablet', 'kemet-addons' ),
							'hide-mobile'        => __( 'Hide On Mobile', 'kemet-addons' ),
							'hide-tablet-mobile' => __( 'Hide On Tablet & Mobile', 'kemet-addons' ),
					),
			)
	);


	/**
  * Option:Top Bar Text Color
  */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
				'label'   => __( 'Top Bar Text Color', 'kemet-addons' ),
				'priority'       => 37,
				'section' => 'section-topbar-header',
			)
		)
	);
	
	/**
	 * Option: Top Bar Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
                'priority'       => 40,
                'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar Background Color', 'kemet-addons' ),
			)
		)
	);



	 /**
      * Option:Top Bar Link Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
				'label'   => __( 'Top Bar Link Color', 'kemet-addons' ),
				'priority'       => 50,
				'section' => 'section-topbar-header',
			)
		)
	);

	/**
      * Option:Top Bar Link Hover Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
				'label'   => __( 'Top Bar Link Hover Color', 'kemet-addons' ),
				'priority'       => 55,
				'section' => 'section-topbar-header',
			)
		)
	);
        
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
			'default'           => kemet_get_option( 'topbar-padding' ),
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 30,
				'label'          => __( 'Top Bar Border Size', 'kemet-addons' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em'),
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
	 * Option: Top Bar Border Bottom Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-bottom-color]', array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-bottom-color]', array(
				'section'  => 'section-topbar-header',
				'priority' => 65,
				'label'    => __( 'Top Bar Border Bottom Color', 'kemet-addons' ),
			)
		)
	);

	/**
	 * Option:Top Bar SubMenu Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
				'priority'       => 70,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Background Color', 'kemet-addons' ),
			)
		)
	);


	/**
	 * Option:Top Bar SubMenu Items Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
				'priority'       => 75,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Items Color', 'kemet-addons' ),
			)
		)
	);


	/**
	 * Option:Top Bar SubMenu Items Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
				'priority'       => 80,
				'section' => 'section-topbar-header',
				'label'   => __( 'Top Bar SubMenu Items Hover Color', 'kemet-addons' ),
			)
		)
	);