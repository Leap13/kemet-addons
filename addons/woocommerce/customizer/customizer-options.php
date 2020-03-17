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
            'qv-icon'   => __( 'Icon', 'kemet-addons' ),
            'on-image'   => __( 'On Image Click', 'kemet-addons' ),
            'after-summary'   => __( 'After Summary', 'kemet-addons' ),
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
* Option: Shop Structure 
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-list-product-structure]', array(
        'default'           => kemet_get_option( 'shop-list-product-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==', 
            'values' => 'shop-list',
        ), 
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-list-product-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-woo-shop',
            'priority' => 30,
            'label'    => __( 'Shop Product Structure', 'kemet' ),
            'choices'  => array(
                'title'      => __( 'Title', 'kemet' ),
                'price'      => __( 'Price', 'kemet' ),
                'ratings'    => __( 'Ratings', 'kemet' ),
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);
/**
* Option: Single Post Meta
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
        'default'           => kemet_get_option( 'shop-product-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==', 
            'values' => 'shop-grid',
        ),
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
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);

/**
* Option: Sale Notification
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[sale-style]', array(
        'default'           => $defaults['sale-style'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[sale-style]', array(
        'type'     => 'select',
        'section'  => 'section-woo-shop',
        'priority' => 35,
        'label'    => __( 'Sale Notification', 'kemet-addons' ),
        'choices'  => array(
            '100%' => __( 'Circle', 'kemet-addons' ),
            '0'   => __( 'Square', 'kemet-addons' ),
        ),
    )
);

/**
* Option: Product Content Alignment
*/

$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-alignment]', array(
        'default'           => $defaults[ 'product-content-alignment' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Icon_Select(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-alignment]', array(
            'priority'       => 45,
            'section' => 'section-woo-shop',
            'label'   => __( 'Product Content Alignment', 'kemet-addons' ),
            'choices'  => array(
                'left' => array(
                    'icon' => 'dashicons-editor-alignleft'
                ),
                'center' => array(
                    'icon' => 'dashicons-editor-aligncenter'
                ),
                'right' => array(
                    'icon' => 'dashicons-editor-alignright'
                ),	
            ),
        )
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
/**
* Option: Disable Related Products
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[disable-related-products]', array(
        'default'           => $defaults[ 'disable-related-products' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[disable-related-products]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Disable Related Products', 'kemet-addons' ),
        'priority'        => 12,
    )
);
/**
* Option: Related Products Count
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[related-products-count]', array(
        'default'           => $defaults['related-products-count'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-related-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[related-products-count]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 15,
            'label'       => __( 'Related Products Count', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 3,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
* Option: Related Products Colunms
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[related-products-colunms]', array(
        'default'           => $defaults['related-products-colunms'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-related-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[related-products-colunms]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 20,
            'label'       => __( 'Related Products Columns', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 1,
                'step' => 1,
                'max'  => 7,
            ),
        )
    )
);