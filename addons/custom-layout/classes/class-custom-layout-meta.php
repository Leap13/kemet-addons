<?php

// Metabox of the PAGE
$options = Kemet_Custom_Layout_Partials::get_locations();
$rules_array = array();

foreach($options as $key => $value){
  foreach($value['value'] as $val => $label){
    $rules_array[ __($value['label'], 'kemet-addons') ][$val] = __($label, 'kemet-addons');
  }
}

$hooks = Kemet_Custom_Layout_Partials::get_hooks();
$hooks_array = array();
foreach($hooks as $key => $value){
   foreach($value['value'] as $val => $decription){
      $hooks_array[ __($value['title'], 'kemet-addons') ][$val] = __($val, 'kemet-addons');
   }
}

$user_roles = Kemet_Custom_Layout_Partials::get_user_rules_list();
$user_roles_array = array();

foreach($user_roles as $key => $value){
   foreach($value['value'] as $val => $label){
      $user_roles_array[ __($value['title'], 'kemet-addons') ][$val] = __($label, 'kemet-addons');
   }
}
//
// Create a Metabox Options
//
if( class_exists( 'KFW' ) ) {

$prefix_page_opts = 'kemet_custom_layout_options';

KFW::createMetabox( $prefix_page_opts, array(
  'title'        => __('Kemet Page Options', 'kemet-addons'),
  'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
  
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );
//
// Create a section
//
KFW::createSection( $prefix_page_opts, array(
  'priority_num' => 1,
  'fields' => array(
      array(
        'id'          => 'layout-position',
        'type'        => 'select',
        'title'       => __('Layout', 'kemet-addons'),
        'options'     => array(
          'hooks'     => __('Hooks', 'kemet-addons'),
        ),
        'default'     => 'hooks',
      ),      
      array(
        'id'          => 'hook-action',
        'type'        => 'select',
        'class'       => 'kmt-hooks-select',
        'title'       => __('Action', 'kemet-addons'),
        'desc'        => __('Select an option', 'kemet-addons'),
        'placeholder' => __('Select an option', 'kemet-addons'),
        'default'     => '',
        'options'     => $hooks_array,
        'dependency' => array(
          array( 'layout-position', '==', 'hooks' ),
        ),
      ),  
      array(
        'id'    => 'hook-priority',
        'type'  => 'number',
        'title' => __('Priority', 'kemet-addons' ),
        'dependency' => array( 'layout-position', '==', 'hooks' ),
      ), 
      array(
        'id'    => 'spacing-top',
        'type'  => 'number',
        'title' => __('Spacing Top', 'kemet-addons' ),
        'unit'  => 'px',
        'output_mode' => 'padding',
      ), 
      array(
        'id'    => 'spacing-bottom',
        'type'  => 'number',
        'title' => __('Spacing Bottom', 'kemet-addons' ),
        'unit'  => 'px',
        'output_mode' => 'padding',
      ), 
      array(
        'id'     => 'all-display-on-rules',
        'class'  => 'all-display-on-rules',
        'type'   => 'repeater',
        'title'  => 'Display On',
        'button_title' => 'Add new row',
        'chosen'      => true,
        'fields' => array(
          array(
            'id'    => 'display-on-rule',
            'class'    => 'display-on-rule',
            'type'  => 'select',
            'placeholder' => __('Select an option', 'kemet-addons'),
            'options'     => $rules_array,
          ),
          array(
            'id'          => 'specifics-location',
            'type'        => 'select',
            'class'       => 'kmt-specifics-location-select',
            'default'     => '',
            'multiple'    => true,
            'options'     => array(
              '' => __('Select an option', 'kemet-addons'),
            ),
            'dependency' => array(
              array( 'display-on-rule', '==', 'specifics-location' ),
            ),
          ),
        ),
        'default'   => array(
          'display-on-rule'
        )
      ), 
      array(
        'id'     => 'all-hide-on-rules',
        'class'     => 'all-hide-on-rules',
        'type'   => 'repeater',
        'title'  => 'Hide On',
        'button_title' => 'Add new row',
        'chosen'      => true,
        'fields' => array(
          array(
            'id'    => 'hide-on-rule',
            'type'  => 'select',
            'class'    => 'hide-on-rule',
            'placeholder' => __('Select an option', 'kemet-addons'),
            'options'     => $rules_array,
          ),
          array(
            'id'          => 'specifics-location',
            'type'        => 'select',
            'class'       => 'kmt-specifics-location-select',
            'default'     => '',
            'multiple'    => true,
            'options'     => array(
              '' => __('Select an option', 'kemet-addons'),
            ),
            'dependency' => array(
              array( 'hide-on-rule', '==', 'specifics-location' ),
            ),
          ),
        ),
        'default'   => array(
          'hide-on-rule'
        )
      ),
      array(
        'id'     => 'all-user-rules',
        'type'   => 'repeater',
        'title'  => 'User Rules',
        'button_title' => 'Add new row',
        'chosen'      => true,
        'fields' => array(
          array(
            'id'    => 'user-rules',
            'type'  => 'select',
            'placeholder' => __('Select an option', 'kemet-addons'),
            'options'     => $user_roles_array,
          ),
        ),
        'default'   => array(
          'user-rules'
        )
      ),
    )
  ) 
);
}