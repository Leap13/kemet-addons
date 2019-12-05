<?php
/**
 * Kemet Panel Settings
 */

// Control core classes for avoid errors
if (class_exists('KFW')) {

    // Set a unique slug-like ID
    $prefix = 'kmt_framework';

    //
    // Create options
    KFW::createOptions($prefix, array(
    'menu_title' => __( 'Kemet Panel', 'kemet-addons' ),
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-icon',
  ));

    //
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => __( 'Kemet Customizer Options', 'kemet-addons' ),
    'priority' => '1',
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
        'title' => __( 'Extra Headers', 'kemet-addons' ),
        'default' => 'false',
      ),array(
        'id' => 'top-bar-section',
        'type' => 'switcher',
        'title' => __('Top Bar Section', 'kemet-addons'),
        'default' => 'false',
        ),array(
        'id' => 'page-title',
        'type' => 'switcher',
        'title' => __('Page Title', 'kemet-addons'),
        'default' => 'false',
      ),array(
        'id' => 'go-top',
        'type' => 'switcher',
        'title' => __( 'Go Top Link', 'kemet-addons' ),
        'default' => 'false',
      ),array(
        'id' => 'sticky-header',
        'type' => 'switcher',
        'title' => __( 'Sticky Header', 'kemet-addons'),
        'default' => 'false',
      ),array(
        'id' => 'extra-widgets',
        'type' => 'switcher',
        'title' => __('Extra Widgets', 'kemet-addons'),
        'default' => 'false',
      ),
    ),
  ),
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => __( 'Kemet Integration', 'kemet-addons'),
    'priority' => '5',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'kmt-mailchimp-api-key',
        'type' => 'text',
        'title' => __( 'Mailchimp API Key', 'kemet-addons' ),
      ),array(
        'id' => 'kmt-mailchimp-list-id',
        'type' => 'text',
        'title' => __( 'Mailchimp List ID', 'kemet-addons' ),
      ),
    ),
  )
    ));

  
}
