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
    'data_type'      => 'serialize'
) );

//
// Create a section
//
$fields = array(
  array(
    'id'    => 'kemet-main-header-display',
    'type'  => 'switcher',
    'title' =>  __('Display Primary Header', 'kemet-addons'),
    'label' => __('Display Main Header In Current Post/Page.', 'kemet-addons'),
    'default' => true
  ),
   array(
    'id'    => 'site-post-title',
    'type'  => 'switcher',
    'title' =>  __('Disable Page Title', 'kemet-addons'),
    'label' => __('Disable Post/Page Title', 'kemet-addons'),
  ),
  array(
    'id'    => 'kmt-featured-img',
    'type'  => 'switcher',
    'title' =>  __('Disable Featured Image', 'kemet-addons'),
    'label' => __('Disable Post/Page Featured Image', 'kemet-addons'),
  ),
      
  array(
    'id'    => 'kemet-footer-display',
    'type'  => 'switcher',
    'title' =>  __('Disable Main Footer', 'kemet-addons'),
    'label' => __('Disable Post/Page Footer Widgets Area', 'kemet-addons'),
  ),
    
   array(
    'id'    => 'copyright-footer-layout',
    'type'  => 'switcher',
    'title' =>  __('Disable Copyright Area', 'kemet-addons'),
    'label' => __('Disable Post/Page Copyright', 'kemet-addons'),
  ),
  
    array(
    'id'    => 'kemet-meta-enable-header-transparent',
    'type'  => 'select',
    'title' =>  __('Overlay Header', 'kemet-addons'),
    'options'     => array(
      'default'     => __('Default', 'kemet-addons'),
      'enabled'     => __('Enable', 'kemet-addons'),
      'disabled'     => __('Disabled', 'kemet-addons'),
    ),
  ),

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
);
$options = get_option( 'kmt_framework' );
if($options['top-bar-section']){
    $top_bar = array(
      'id'    => 'kemet-top-bar-display',
      'type'  => 'switcher',
      'title' =>  __('Disable Top Bar', 'kemet-addons'),
      'label' => __('Disable Top Bar In Current Post/Page.', 'kemet-addons'),
    );
    $fields[] = $top_bar;
}
KFW::createSection( $prefix_page_opts, array(
  'title'  => 'Overview',
  'icon'   => 'fa fa-rocket',
  'fields' => $fields
) );
}