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
    'menu_title' => __( 'Welcome to Kemet Theme', 'kemet-addons' ),
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-icon',
    'show_search' => false,
    'show_all_options'  => false,
    'theme'   => 'light',
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
        'subtitle' => __('Enable/Disable the page options to customize your single page/post.', 'kemet-ddons'),
        'default' => 'true',
      ),array(
        'id' => 'extra-headers',
        'type' => 'switcher',
        'title' => __( 'Advanced Headers', 'kemet-addons' ),
        'subtitle' => __('Enable/Disable Extra Kemet Headers which includes many options to design awesome headers.', 'kemet-ddons'),
        'default' => 'false',
      ),array(
        'id' => 'sticky-header',
        'type' => 'switcher',
        'title' => __( 'Sticky Header', 'kemet-addons'),
        'subtitle' => __('Enable/Disable Sticky Header options.', 'kemet-ddons'),
        'default' => 'false',
      ),array(
        'id' => 'top-bar-section',
        'type' => 'switcher',
        'title' => __('Top Bar Section', 'kemet-addons'),
        'subtitle' => __('Enable/Disable Top bar Area includes two sections with content options (Search, widget, custom text, woocommerce icon.)', 'kemet-ddons'),
        'default' => 'false',
        ),array(
        'id' => 'page-title',
        'type' => 'switcher',
        'title' => __('Page Title Area', 'kemet-addons'),
        'subtitle' => __('Enable/Disable page title area which includes title & Breadcrumbs and their customizer options.', 'kemet-ddons'),
        'default' => 'false',
      ),array(
        'id' => 'go-top',
        'type' => 'switcher',
        'title' => __( 'Go to top icon', 'kemet-addons' ),
        'subtitle' => __('Enable/Disable Go To Top Icon and its customizer options.', 'kemet-ddons'),
        'default' => 'false',
      ),array(
        'id' => 'extra-widgets',
        'type' => 'switcher',
        'title' => __('Extra Widgets', 'kemet-addons'),
        'subtitle' => __('Enable/Disable Extra Kemet Wordpress widgets to build your website', 'kemet-ddons'),
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
        'subtitle' => sprintf(esc_html__('Used for the MailChimp widget which working with Extra Widgets Addon. %1$sFollow this article%2$s to get your API Key.', 'kemet-addons'), '<a href="https://mailchimp.com/help/about-api-keys/" target="_blank">', '</a>' ),
      ),array(
        'id' => 'kmt-mailchimp-list-id',
        'type' => 'text',
        'title' => __( 'Mailchimp List ID', 'kemet-addons' ),
                'subtitle' => sprintf(esc_html__('Used for the MailChimp widget which working with Extra Widgets Addon. %1$sFollow this article%2$s to get your List ID.', 'kemet-addons'), '<a href="https://mailchimp.com/help/find-audience-id/" target="_blank">', '</a>' ),

      ),
    ),
  )
    ));

  
}
