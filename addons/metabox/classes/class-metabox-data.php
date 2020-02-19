<?php

// Metabox of the PAGE

//
// Create a Metabox Options
//
if( class_exists( 'KFW' ) ) {

$prefix_page_opts = 'kemet_page_options';

KFW::createMetabox( $prefix_page_opts, array(
  'title'        => 'Kemet Page Options',
  'post_type'    =>  array( 
                    'page', 
                    'post',
                    'product',
  ),
  
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );
//
// Create a section
//
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Main',
  'icon'   => 'fa fa-cog',
  'fields' => array(
      array(
        'id'          => 'site-sidebar-layout',
        'type'        => 'select',
        'title'       => __('Sidebar Layout', 'kemet-addons'),
        'placeholder' => 'Select an option',
        'default'     => '',
        'options'     => array(
          'no-sidebar'     => __('No Sidebar', 'kemet-addons'),
          'left-sidebar'     => __('Left Sidebar', 'kemet-addons'),
          'right-sidebar'     => __('Right Sidebar', 'kemet-addons'),
        ),
      ),
      array(
        'id'          => 'site-content-layout',
        'type'        => 'select',
        'title'       => __('Page Layout', 'kemet-addons'),
        'placeholder' => 'Select an option',
        'options'     => array(
          'boxed-container'            => __('Boxed Layout', 'kemet-addons'),
          'content-boxed-container'    => __('Boxed Content', 'kemet-addons'),
          'plain-container'            => __('Full Width Content', 'kemet-addons'),
          'page-builder'               => __('Stretched Content', 'kemet-addons'),
        ),
      ),
      array(
        'id'         => 'kemet-featured-img',
        'type'       => 'checkbox',
        'title'      => 'Disable Featured Image',
        'label'   => 'Disable The Featured Image in The Current Page/Post.',
        'default'    => false
       ),           
    )
  ) 
);

KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Footer',
  'icon'   => 'fa fa-pencil',
  'fields' => array(
      array(
        'id'         => 'kemet-disable-footer',
        'type'       => 'checkbox',
        'title'      => 'Disable Footer Area',
        'label'   => 'Disable The Footer Area in The Current Page/Post.',
        'default'    => false
       ), 
       array(
        'id'         => 'kemet-disable-copyright-footer',
        'type'       => 'checkbox',
        'title'      => 'Disable Copyright Area',
        'label'   => 'Disable The Copyright Area in The Current Page/Post.',
        'default'    => false
       ),             
    )
  ) 
);
}