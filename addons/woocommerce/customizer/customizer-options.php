<?php
$defaults = Kemet_Theme_Options::defaults();

/**
* Option: Shop
*/

/**
* Option: Quick View
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-quick-view]', array(
        'default'           => $defaults['enable-quick-view'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-quick-view]', array(
        'type'     => 'select',
        'section'  => 'section-woo-shop',
        'priority' => 1,
        'label'    => __( 'Quick View', 'kemet-addons' ),
        'choices'  => array(
            'disabled' => __( 'Disabled', 'kemet-addons' ),
            'on-image'   => __( 'On Image Click', 'kemet-addons' ),
            'after-add-to-cart'   => __( 'After Add To Cart', 'kemet-addons' ),
        ),
    )
);

/**
* Option: Shop Layout
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-layout]', array(
        'default'           => $defaults['shop-layout'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-layout]', array(
        'type'     => 'select',
        'section'  => 'section-woo-shop',
        'priority' => 1,
        'label'    => __( 'Shop Layout', 'kemet-addons' ),
        'choices'  => array(
            'shop-grid'   => __( 'Grid', 'kemet-addons' ),
            'shop-list'   => __( 'List', 'kemet-addons' ),
        ),
    )
);

/**
* Option: Single Product
*/

/**
* Option: Ajax Add To Cart
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]', array(
        'default'           => $defaults[ 'enable-single-ajax-add-to-cart' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Enable Ajax Add To Cart', 'kemet-addons' ),
        'priority'        => 10,
    )
);