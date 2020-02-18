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
  'fields' => apply_filters( 'kemet_header_page_meta' , array(
      array(
        'id'         => 'kemet-top-bar-display',
        'type'       => 'button_set',
        'title'      => 'Display Top Bar',
        'options'    => array(
          'default'  => 'Default',
          'enable'  => 'Enable',
          'disable' => 'Disable',
        ),
        'default'    => 'default'
      ),
      array(
        'id'         => 'kemet-main-header-display',
        'type'       => 'image_select',
        'title'      => 'Display Primary Header',
        'options'    => array(
          'default'  => KEMET_METABOX_URL . '/assets/images/disable-footer.png',
          'disable'  => KEMET_METABOX_URL . '/assets/images/disable-footer.png',
        ),
        'default'    => 'default'
      ),
      array(
        'id'    => 'kemet-meta-enable-header-transparent',
        'type'  => 'button_set',
        'title' =>  __('Overlay Header', 'kemet-addons'),
        'options'     => array(
          'default'     => __('Default', 'kemet-addons'),
          'enable'     => __('Enable', 'kemet-addons'),
          'disable'     => __('Disable', 'kemet-addons'),
        ),
        'default'    => 'default',
        'dependency' => array( 'kemet-main-header-display', '!=', 'disable' ),
      ),          
    )
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
          'disable' => 'Disable',
        ),
        'default'    => 'default'
      ),          
    )
  ) 
);
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Footer',
  'icon'   => 'fa fa-pencil',
  'fields' => array(
      array(
        'id'          => 'kemet-footer-display',
        'type'        => 'image_select',
        'title'       => 'Kemet Footer Layout',
        'options'     => array(
          'default'  => KEMET_METABOX_URL . '/assets/images/disable-footer.png',
          'disabled'  => KEMET_METABOX_URL . '/assets/images/disable-footer.png',
          'layout-1'  => KEMET_METABOX_URL . '/assets/images/footer-layout-1.png',
          'layout-2'  => KEMET_METABOX_URL . '/assets/images/footer-layout-2.png',
          'layout-3'  => KEMET_METABOX_URL . '/assets/images/footer-layout-3.png',
          'layout-4'  => KEMET_METABOX_URL . '/assets/images/footer-layout-4.png',
          'layout-5'  => KEMET_METABOX_URL . '/assets/images/footer-layout-5.png',
          'layout-6'  => KEMET_METABOX_URL . '/assets/images/footer-layout-6.png',
        ),
        'default'   => 'default'
      ),    
      array(
        'id'         => 'copyright-footer-layout',
        'type'       => 'image_select',
        'title'      => 'Display Copyright Area',
        'options'     => array(
          'default'  => KEMET_METABOX_URL . '/assets/images/disable-copyright-area.png',
          'disabled'  => KEMET_METABOX_URL . '/assets/images/disable-copyright-area.png',
          'copyright-footer-layout-1'  => KEMET_METABOX_URL . '/assets/images/copyright-area-layout-1.png',
          'copyright-footer-layout-2'  => KEMET_METABOX_URL . '/assets/images/copyright-area-layout-2.png',
        ),
        'default'   => 'default'
      ),         
    )
  ) 
);
}