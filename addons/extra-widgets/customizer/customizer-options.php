<?php
/**
 * Option: Widgets Style
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widgets-style]', array(
        'default'           => kemet_get_option( 'widgets-style' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[widgets-style]', array(
        'type'     => 'select',
        'section'  => 'section-widgets',
        'priority' => 1,
        'label'    => __( 'Widgets Style', 'kemet-addons' ),
        'choices'  => array(
            'style1'           => __( 'Style 1', 'kemet-addons' ),
            'style2'           => __( 'Style 2', 'kemet-addons' ),
            'style3'           => __( 'Style 3', 'kemet-addons' ),
            'style4'           => __( 'Style 4', 'kemet-addons' ),
            'style5'           => __( 'Style 5', 'kemet-addons' ),
            'style6'           => __( 'Style 6', 'kemet-addons' ),
            'style7'           => __( 'Style 7', 'kemet-addons' ),
        ),  
    )
);

/**
* Option: Widget Style Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kemet-widget-style-color]', array(
        'default'           => kemet_get_option( 'kemet-widget-style-color' ),
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[kemet-widget-style-color]', array(
            'section'  => 'section-widgets',
            'priority' => 3,
            'label'    => __( 'Widget Style Color', 'kemet-addons' ),
            'active_callback'      => 'kemet_widget_with_style_color',
        )
    )
);
/**
 * Option: Widgets Style
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-widgets-style]', array(
        'default'           => kemet_get_option( 'footer-widgets-style' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-widgets-style]', array(
        'type'     => 'select',
        'section'  => 'section-kemet-footer',
        'priority' => 141,
        'label'    => __( 'Widgets Style', 'kemet-addons' ),
        'choices'  => array(
            ''                 => __( 'Default', 'kemet-addons' ),
            'style1'           => __( 'Style 1', 'kemet-addons' ),
            'style2'           => __( 'Style 2', 'kemet-addons' ),
            'style3'           => __( 'Style 3', 'kemet-addons' ),
            'style4'           => __( 'Style 4', 'kemet-addons' ),
            'style5'           => __( 'Style 5', 'kemet-addons' ),
            'style6'           => __( 'Style 6', 'kemet-addons' ),
            'style7'           => __( 'Style 7', 'kemet-addons' ),
        ),  
    )
);
/**
* Option: Footer Widget Style Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kemet-footer-widget-style-color]', array(
        'default'           => kemet_get_option( 'kemet-footer-widget-style-color' ),
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[kemet-footer-widget-style-color]', array(
            'section'  => 'section-kemet-footer',
            'priority' => 142,
            'label'    => __( 'Widget Style Color', 'kemet-addons' ),
            'active_callback'      => 'kemet_footer_widget_with_style_color',
        )
    )
);