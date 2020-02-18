<?php

// Metabox of the PAGE
// Set a unique slug-like ID
//
//$prefix_page_opts = 'kemet_page_options';

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
  //'show_restore' => true,
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );

//
// Create a section
//
// $fields = array(
//   array(
//     'id'    => 'kemet-main-header-display',
//     'type'  => 'switcher',
//     'title' =>  __('Display Primary Header', 'kemet-addons'),
//     'label' => __('Display Main Header in The Current Page/Post.', 'kemet-addons'),
//     'default' => true
//   ),
//    array(
//     'id'    => 'site-post-title',
//     'type'  => 'switcher',
//     'title' =>  __('Display Page Title', 'kemet-addons'),
//     'label' => __('Display Page/Post Title', 'kemet-addons'),
//     'default' => true
//   ),
//   array(
//     'id'    => 'kmt-featured-img',
//     'type'  => 'switcher',
//     'title' =>  __('Display Featured Image', 'kemet-addons'),
//     'label' => __('Display Page/Post Featured Image', 'kemet-addons'),
//     'default' => true
//   ),
      
//   array(
//     'id'    => 'kemet-footer-display',
//     'type'  => 'switcher',
//     'title' =>  __('Display Main Footer', 'kemet-addons'),
//     'label' => __('Display Page/Post Footer Widgets Area', 'kemet-addons'),
//     'default' => true
//   ),
    
//    array(
//     'id'    => 'copyright-footer-layout',
//     'type'  => 'switcher',
//     'title' =>  __('Display Copyright Area', 'kemet-addons'),
//     'label' => __('Display The Copyright Area in The Page/Post', 'kemet-addons'),
//     'default' => true
//   ),
  
//     array(
//     'id'    => 'kemet-meta-enable-header-transparent',
//     'type'  => 'select',
//     'title' =>  __('Overlay Header', 'kemet-addons'),
//     'options'     => array(
//       'default'     => __('Default', 'kemet-addons'),
//       'enabled'     => __('Enable', 'kemet-addons'),
//       'disabled'     => __('Disabled', 'kemet-addons'),
//     ),
//   ),

//   array(
//     'id'          => 'site-sidebar-layout',
//     'type'        => 'select',
//     'title'       => __('Sidebar Layout', 'kemet-addons'),
//     'placeholder' => 'Select an option',
//     'default'     => '',
//     'options'     => array(
//       'no-sidebar'     => __('No Sidebar', 'kemet-addons'),
//       'left-sidebar'     => __('Left Sidebar', 'kemet-addons'),
//       'right-sidebar'     => __('Right Sidebar', 'kemet-addons'),
//     ),
//   ),

//   array(
//     'id'          => 'site-content-layout',
//     'type'        => 'select',
//     'title'       => __('Page Layout', 'kemet-addons'),
//     'placeholder' => 'Select an option',
//     'options'     => array(
//       'boxed-container'            => __('Boxed Layout', 'kemet-addons'),
//       'content-boxed-container'    => __('Boxed Content', 'kemet-addons'),
//       'plain-container'            => __('Full Width Content', 'kemet-addons'),
//       'page-builder'               => __('Stretched Content', 'kemet-addons'),
//     ),
//   ),
// );
// $options = get_option( 'kmt_framework' );
// if($options['top-bar-section']){
//     $top_bar = array(
//       'id'    => 'kemet-top-bar-display',
//       'type'  => 'switcher',
//       'title' =>  __('Display Top Bar', 'kemet-addons'),
//       'label' => __('Display The Top Bar in The Current Page/Post.', 'kemet-addons'),
//       'default' => true
//     );
//     $fields[] = $top_bar;
// }
// KFW::createSection( $prefix_page_opts, array(
//   'title'  => 'Overview',
//   'icon'   => 'fa fa-rocket',
//   'fields' => $fields
// ) );
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
      'id'    => 'kemet-featured-img',
      'type'  => 'button_set',
      'title' =>  __('Display Featured Image', 'kemet-addons'),
      'options'    => array(
        'default'  => 'Default',
        'enabled'  => 'Enabled',
        'disabled' => 'Disabled',
      ),
      'default'    => 'default'
    ),           
    )
  ) 
);
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Header',
  'icon'   => 'fa fa-thumb-tack',
  'fields' => array(
      array(
        'id'         => 'kemet-top-bar-display',
        'type'       => 'button_set',
        'title'      => 'Display Top Bar',
        'options'    => array(
          'default'  => 'Default',
          'enabled'  => 'Enabled',
          'disabled' => 'Disabled',
        ),
        'default'    => 'default'
      ),
      array(
        'id'         => 'kemet-main-header-display',
        'type'       => 'button_set',
        'title'      => 'Display Primary Header',
        'options'    => array(
          'default'  => 'Default',
          'enabled'  => 'Enabled',
          'disabled' => 'Disabled',
        ),
        'default'    => 'default'
      ),
      array(
        'id'    => 'kemet-meta-enable-header-transparent',
        'type'  => 'button_set',
        'title' =>  __('Overlay Header', 'kemet-addons'),
        'options'     => array(
          'default'     => __('Default', 'kemet-addons'),
          'enabled'     => __('Enable', 'kemet-addons'),
          'disabled'     => __('Disabled', 'kemet-addons'),
        ),
        'default'    => 'default'
      ),
      array(
        'id'          => 'header-layout',
        'type'        => 'select',
        'title'       => 'Header Layout',
        'options'     => array(
          'header-1'  => 'Header 1',
          'header-2'  => 'Header 2',
          'header-3'  => 'Header 3',
        ),
        'default'     => 'header-2'
      ),           
    )
  ) 
);
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Page Title',
  'icon'   => 'fa fa-wrench',
  'fields' => array(
      array(
        'id'         => 'kemet-page-title-display',
        'type'       => 'button_set',
        'title'      => 'Display Page Title',
        'options'    => array(
          'default'  => 'Default',
          'enabled'  => 'Enabled',
          'disabled' => 'Disabled',
        ),
        'default'    => 'default'
      ),
      array(
        'id'          => 'page-title-layout',
        'type'        => 'select',
        'title'       => 'Page Title Layout',
        'options'     => array(
          'page-title-1'  => 'Page Title 1',
          'page-title-2'  => 'Page Title 2',
          'page-title-3'  => 'Page Title 3',
        ),
        'default'     => 'page-title-1'
      ),           
    )
  ) 
);
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Footer',
  'icon'   => 'fa fa-pencil',
  'fields' => array(
      array(
        'id'         => 'kemet-footer-display',
        'type'       => 'button_set',
        'title'      => 'Display Main Footer',
        'options'    => array(
          'default'  => 'Default',
          'enabled'  => 'Enabled',
          'disabled' => 'Disabled',
        ),
        'default'    => 'default'
      ),   
      array(
        'id'         => 'copyright-footer-layout',
        'type'       => 'button_set',
        'title'      => 'Display Copyright Area',
        'options'    => array(
          'default'  => 'Default',
          'enabled'  => 'Enabled',
          'disabled' => 'Disabled',
        ),
        'default'    => 'default'
      ),         
    )
  ) 
);
}