<?php
$soundcloud_widgets = array(
  'title'       => __('Kemet SoundCloud', 'kemet-addons' ),
  'classname'   => 'kfw-widget-soundcloud',
  'id'          => 'kemet-widget-soundcloud',
  'description' => __('SoundCloud', 'kemet-addons' ),
  'fields'      => array(
      array(
        'id'      => 'title',
        'type'    => 'text',
        'title'   => __('Title', 'kemet-addons' ),
        'default'   => __('SoundCloud', 'kemet-addons' ),
      ),
      array(
        'id'      => 'url',
        'type'    => 'text',
        'title'   => __('URL:', 'kemet-addons' ),
      ),
      array(
        'id'    => 'width',
        'type'  => 'number',
        'title' => __('Width', 'kemet-addons' ),
        'default'     => 268,
      ),
      array(
        'id'    => 'height',
        'type'  => 'number',
        'title' => __('Height', 'kemet-addons' ),
        'default'     => 280,
      ),
      array(
        'id'      => 'autoplay',
        'type'    => 'checkbox',
        'title'   => __('Autoplay', 'kemet-addons' ),
        'default' => false,
      ),  
  )
);

if( ! function_exists( 'kemet_widget_soundcloud' ) ) {
  function kemet_widget_soundcloud( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    $url = isset($instance['url']) ? $instance['url'] : '';
    $width = isset($instance['width']) ? $instance['width'] : '';
    $height = isset($instance['height']) ? $instance['height'] : '';
    $autoplay    = $instance[ 'autoplay' ] ? 'true' : 'false';
    
    if(!empty($url)){ 

        echo '<iframe width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . $url . '&amp;auto_play=' . $autoplay . '&amp;show_artwork=true"></iframe>';
            
     }

    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_soundcloud" , $soundcloud_widgets) );