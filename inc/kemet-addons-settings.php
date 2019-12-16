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
    'menu_title' => __( 'Kemet', 'kemet-addons' ),
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-options',
    'show_search' => false,
    'show_all_options'  => false,
    'theme'   => 'light',
  ));

    //
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => __( 'Customizer Options', 'kemet-addons' ),
    'priority' => '1',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'metabox',
        'type' => 'switcher',
        'title' => __( 'Single page/post options', 'kemet-addons' ),
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
      ),array(
        'id' => 'single-post',
        'type' => 'switcher',
        'title' => __('Single Post Options', 'kemet-addons'),
        'subtitle' => __('Enable/Disable Extra option to customize single post content.', 'kemet-ddons'),
        'default' => 'false',
      ),
    ),
  ),
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'integrations_tab',
    'title' => __( 'Integrations', 'kemet-addons'),
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
  ),
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'plugins_tab',
    'title' => __( 'Plugins', 'kemet-addons'),
    'priority' => '10',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'plugins',
        'type' => 'pluginstab',
      ),
    ),
  )),
      // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'info_tab',
    'title' => __( 'System Info', 'kemet-addons'),
    'priority' => '10',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'system-info-php',
        'type' => 'systeminfo',
      ),
    ),
  )
    )));
  KFW::createWidget( 'kemet_social_icons', array(
    'title'       => 'Kemet Social Icons',
    'classname'   => 'csf-widget-classname',
    'description' => 'Social Profile',
    'fields'      => array(
      array(
        'id'      => 'title',
        'type'    => 'text',
        'title'   => 'Title',
      ),
      array(
        'id'     => 'social-profile',
        'type'   => 'repeater',
        'title'  => 'Add Profile',
        'fields' => array(
      
          array(
            'id'    => 'profile-title',
            'type'  => 'text',
            'title' => 'Title'
          ),
          array(
            'id'    => 'link',
            'type'  => 'text',
            'title' => 'Link'
          ),
          array(
            'id'          => 'link-target',
            'type'        => 'select',
            'title'       => 'Target',
            'options'     => array(
              'same-page'  => 'Same Page',
              'new-page'  => 'New Page',
            ),
            'default'     => 'new-page'
          ),
          array(
            'id'    => 'no-follow',
            'type'  => 'switcher',
            'title' => 'No Follow',
          ),
          array(
            'id'    => 'social-icon',
            'type'  => 'icon',
            'title' => 'Icon',
          ),
        ),
      ),

      array(
        'id'          => 'alignment',
        'type'        => 'select',
        'title'       => 'Alignment',
        'options'     => array(
          'inline'  => 'Inline',
          'stack'  => 'Stack',
        ),
        'default'     => 'inline'
      ),
      array(
        'id'          => 'icon-style',
        'type'        => 'select',
        'title'       => 'Icon Style',
        'options'     => array(
          'simple'  => 'Simple',
          'circle'  => 'Circle',
          'square'  => 'Square',
          'circle-outline'  => 'Circle Outline',
          'square-outline'  => 'Square Outline',
        ),
        'default'     => 'simple'
      ),
      array(
        'id'          => 'icon-color-mode',
        'type'        => 'select',
        'title'       => 'Icon Color',
        'options'     => array(
          'official-color'  => 'Official Color',
          'custom'  => 'Custom',
        ),
        'default'     => 'official-color',
      ),
      array(
        'id'    => 'icon-color',
        'type'  => 'color',
        'title' => 'Color',
        'dependency' => array( 'icon-color-mode', '==', 'custom' ),
      ),
      array(
        'id'    => 'icon-bg-color',
        'type'  => 'color',
        'title' => 'Background Color',
        'dependency' => array( 'icon-color-mode', '==', 'custom' ),
      ),
      array(
        'id'    => 'icon-hover-color',
        'type'  => 'color',
        'title' => 'Icon Hover Color',
        'dependency' => array( 'icon-color-mode', '==', 'custom' ),
      ),
      array(
        'id'    => 'icon-hover-bg-color',
        'type'  => 'color',
        'title' => 'Background Hover Color',
        'dependency' => array( 'icon-color-mode', '==', 'custom' ),
      ),
      array(
        'id'    => 'icon-width',
        'type'  => 'number',
        'title' => 'Icon Width',
        'unit'  => 'px',
        'output_mode' => 'width'
      ),
      array(
        'id'    => 'space-between-icon-text',
        'type'  => 'number',
        'title' => 'Space Between Icon & Text:',
        'unit'  => 'px',
        'output_mode' => 'padding'
      ),
      array(
        'id'    => 'space-between-profiles',
        'type'  => 'number',
        'title' => 'Space Between Social Profiles:',
        'unit'  => 'px',
        'output_mode' => 'padding'
      ),
    )
  ) );
  if( ! function_exists( 'kemet_social_icons' ) ) {
    function kemet_social_icons( $args, $instance ) {

      echo $args['before_widget'];

      if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      var_dump( $args ); // Widget arguments
      var_dump( $instance ); // Saved values from database
      echo $instance['title'];
      // echo $instance['social-profile'];
      // echo $instance['link-target'];
      // echo $instance['icon-color'];

      echo $args['after_widget'];

    }
  }
}
