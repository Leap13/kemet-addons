<?php
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