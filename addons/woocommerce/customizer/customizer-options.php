<?php
$defaults = Kemet_Theme_Options::defaults();

/**
* Option: Single Post Meta
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
        'default'           => $defaults['shop-product-structure'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-woo-shop',
            'priority' => 30,
            'label'    => __( 'Shop Product Structure', 'kemet' ),
            'choices'  => array(
                'price'      => __( 'Price', 'kemet' ),
                'ratings'    => __( 'Ratings', 'kemet' ),
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);