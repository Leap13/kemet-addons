<?php

// Metabox of the PAGE
$options = Kemet_Custom_Layout_Partials::get_location_options();
$location_options = array();

foreach($options as $key => $value){
  foreach($value['value'] as $val => $label){
    $location_options[ __($value['label'], 'kemet-addons') ][$val] = __($label, 'kemet-addons');
  }
}

$hooks = Kemet_Custom_Layout_Partials::get_hooks_options();
$hooks_array = array();
foreach($hooks as $key => $value){
   foreach($value['value'] as $val => $decription){
      $hooks_array[ __($value['title'], 'kemet-addons') ][$val] = __($val, 'kemet-addons');
   }
}

$user_roles = Kemet_Custom_Layout_Partials::get_user_rules_options();
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
$code_editor_prefix = 'kemet_code_editor';

KFW::createMetabox( $code_editor_prefix, array(
  'title'        => __('Kemet Code Editor', 'kemet-addons'),
  'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
  
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );

KFW::createMetabox( $prefix_page_opts, array(
  'title'        => __('Kemet Page Options', 'kemet-addons'),
  'priority'     => 'high',
  'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
  
    'data_type'      => 'serialize',
    'theme'   => 'light',
) );
//
// Create a section
//
KFW::createSection( $code_editor_prefix, array(
  'priority_num' => 1,
  'fields' => array(
      array(
        'id'       => 'kemet-hook-custom-code',
        'type'     => 'code_editor',
        'data_type'          => 'unserialize',
        'settings' => array(
          'indentUnit' => 2,
					'tabSize'    => 2,
        ),
      ),
    )
  )
);
KFW::createSection( $prefix_page_opts, array(
  'priority_num' => 1,
  'fields' => array(
      array(
        'id'          => 'hook-action',
        'type'        => 'select',
        'class'       => 'kmt-hooks-select',
        'title'       => __('Action', 'kemet-addons'),
        'desc'        => __('Select an option', 'kemet-addons'),
        'placeholder' => __('Select an option', 'kemet-addons'),
        'default'     => '',
        'options'     => $hooks_array,
      ),  
      array(
        'id'    => 'hook-priority',
        'type'  => 'number',
        'title' => __('Priority', 'kemet-addons' ),
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
        'id'     => 'display-on-group',
        'type'   => 'fieldset',
        'title'  => __('Display On', 'kemet-addons'),
        'fields' => array(
          array(
            'id'    => 'display-on-rule',
            'class'    => 'display-on-rule',
            'type'  => 'select',
            'multiple'    => true,
            'placeholder' => __('Select an option', 'kemet-addons'),
            'options'     => $location_options,
          ),
          array(
            'id'          => 'display-on-specifics-location',
            'type'        => 'select',
            'class'       => 'kmt-display-on-specifics-select',
            'default'     => '',
            'multiple'    => true,
            'title'  => __('Specific Locations', 'kemet-addons'),
            'options'     => array(
              '' => __('Select an option', 'kemet-addons'),
            ),
          ),
        ),
      ),  
      array(
        'id'     => 'hide-on-group',
        'type'   => 'fieldset',
        'title'  => __('Hide On', 'kemet-addons'),
        'fields' => array(
          array(
            'id'    => 'hide-on-rule',
            'type'  => 'select',
            'class'    => 'hide-on-rule',
            'multiple'    => true,
            'placeholder' => __('Select an option', 'kemet-addons'),
            'options'     => $location_options,
          ),
          array(
            'id'          => 'hide-on-specifics-location',
            'type'        => 'select',
            'class'       => 'kmt-hide-on-specifics-select',
            'title'       => __('Specific Locations', 'kemet-addons'),
            'multiple'    => true,
            'options'     => array(
              '' => __('Select an option', 'kemet-addons'),
            ),
          ),
        ),
      ),
      array(
        'id'    => 'user-rules',
        'class'    => 'kmt-user-rules',
        'type'  => 'select',
        'title'  => __('User Rules', 'kemet-addons'),
        'multiple'    => true,
        'placeholder' => __('Select an option', 'kemet-addons'),
        'options'     => $user_roles_array,
      ),
    )
  ) 
);
}