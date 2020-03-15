<?php
$defaults = Kemet_Theme_Options::defaults();

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
