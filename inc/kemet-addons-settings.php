<?php

/**
 * Kemet Headeer Markup.
 */
// Control core classes for avoid errors
if (class_exists('KFW')) {
    //
    // Set a unique slug-like ID
    $prefix = 'kmt_framework';

    //
    // Create options
    KFW::createOptions($prefix, array(
    'menu_title' => 'Kemet Panel',
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-icon',
  ));

    //
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => 'Kemet Customizer Options',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'metabox',
        'type' => 'switcher',
        'title' => __( 'MetaBox Options', 'kemet-addons' ),
        'default' => 'true',
      ),array(
        'id' => 'extra-headers',
        'type' => 'switcher',
        'title' => 'Extra Headers',
        'default' => 'false',
      ),array(
        'id' => 'top-bar-section',
        'type' => 'switcher',
        'title' => 'Top Bar Section',
        'default' => 'false',
        ),array(
        'id' => 'page-title',
        'type' => 'switcher',
        'title' => 'Page Title',
        'default' => 'false',
      ),array(
        'id' => 'go-top',
        'type' => 'switcher',
        'title' => 'Go Top Link',
        'default' => 'false',
      ),array(
        'id' => 'sticky-header',
        'type' => 'switcher',
        'title' => 'Sticky Header',
        'default' => 'false',
      ),
    ),
  ));

  
}
