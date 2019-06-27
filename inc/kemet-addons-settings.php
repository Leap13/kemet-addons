<?php

/**
 * Kemet Headeer Markup.
 */
// Control core classes for avoid errors
if (class_exists('CSF')) {
    //
    // Set a unique slug-like ID
    $prefix = 'kmt_framework';

    //
    // Create options
    CSF::createOptions($prefix, array(
    'menu_title' => 'Kemet Panel',
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-icon',
  ));

    //
    // Create a sub-tab
    CSF::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => 'Kemet Customizer Options',
    'fields' => array(
      // Addons switcher field
      array(
        'id' => 'metabox',
        'type' => 'switcher',
        'title' => __( 'MetaBox Options', 'kemet-addons' ),
        'default' => 'true',
      ),
      array(
        'id' => 'extra-headers',
        'type' => 'switcher',
        'title' => __( 'Extra Headers', 'kemet-addons' ),
        'default' => 'true',
      ),
    ),
  ));

  
}
