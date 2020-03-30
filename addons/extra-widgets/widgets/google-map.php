<?php
$google_map_widgets = array(
  'title'       => __('Kemet Google Map', 'kemet-addons' ),
  'classname'   => 'kfw-widget-google-map',
  'id'          => 'kemet-widget-google-map',
  'description' => __('Google Map', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Map', 'kemet-addons' ),
    ),
    array(
        'id'      => 'map-code',
        'type'    => 'textarea',
        'title'   => 'Google Map Code',
      ),
  )
);

if( ! function_exists( 'kemet_widget_google_map' ) ) {
  function kemet_widget_google_map( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    
    $google_map_code = $instance['map-code'];
    if(! empty($google_map_code)){
        echo $google_map_code;
    }

    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_google_map" , $google_map_widgets) );