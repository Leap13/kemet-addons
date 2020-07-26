<?php

// Metabox of the PAGE

//
// Create a Metabox Options
//
if( class_exists( 'KFW' ) ) {

$prefix_page_opts = 'kemet_custom_layout_options';

KFW::createMetabox( $prefix_page_opts, array(
  'title'        => __('Kemet Page Options', 'kemet-addons'),
  'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
  
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );
//
// Create a section
//
KFW::createSection( $prefix_page_opts, array(
  'priority_num' => 1,
  'fields' => array(
      array(
        'id'          => 'layout-position',
        'type'        => 'select',
        'title'       => __('Layout', 'kemet-addons'),
        'placeholder' => __('Select an option', 'kemet-addons'),
        'default'     => '',
        'options'     => array(
          'header-layout'     => __('Header', 'kemet-addons'),
          'footer-layout'     => __('Footer', 'kemet-addons'),
		  '404-layout'     => __('404 Page', 'kemet-addons'),
		  'hooks'     => __('Hooks', 'kemet-addons'),
        ),
      ),        
    )
  ) 
);
}