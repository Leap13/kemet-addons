<?php
$youtube_channel_widgets = array(
  'title'       => __('Kemet Youtube Channel', 'kemet-addons' ),
  'classname'   => 'kfw-widget-youtube-channel',
  'id'          => 'kemet-widget-youtube-channel',
  'description' => __('Youtube Channel', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Youtube Channel', 'kemet-addons' ),
    ),
    array(
        'id'      => 'channel-name',
        'type'    => 'text',
        'title'   => __('Channel Name', 'kemet-addons' ),
      ),
  )
);

if( ! function_exists( 'kemet_widget_youtube_channel' ) ) {
  function kemet_widget_youtube_channel( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    $channel_name = isset($instance['channel-name']) ? $instance['channel-name'] : '';
    
            //Youtube Widget
			if( ! empty( $channel_name ) ){

				wp_enqueue_script( 'leap-google-platform-js', '//apis.google.com/js/platform.js' );

				// Check if it is a channel or a user account
				if ( strpos( $channel_name, 'UC' ) === 0 ){
					$source = 'channelid';
				}
				else{
					$source = 'channel';
				} ?>

            <div class="g-ytsubscribe" data-<?php echo $source; ?>="<?php echo $channel_name; ?>" data-layout="full" data-count="default"></div>
				
		<?php }
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_youtube_channel" , $youtube_channel_widgets) );