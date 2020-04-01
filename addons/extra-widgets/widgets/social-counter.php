<?php
$social_counter_widgets = array(
  'title'       => __('Kemet Social Counter', 'kemet-addons' ),
  'classname'   => 'kfw-widget-social-counter',
  'id'          => 'kemet-widget-social-counter',
  'description' => __('Social Counter', 'kemet-addons' ),
  'fields'      => array(
      array(
        'id'      => 'title',
        'type'    => 'text',
        'title'   => __('Title', 'kemet-addons' ),
        'default'   => __('Social Counter', 'kemet-addons' ),
      ),
      array(
        'id'      => 'youtube-channel',
        'type'    => 'text',
        'title'   => __('YouTube Channel ID', 'kemet-addons' ),
      ), 
  )
);

if( ! function_exists( 'kemet_widget_social_counter' ) ) {
  function kemet_widget_social_counter( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }

    $youtube = isset($instance['youtube-channel']) ? $instance['youtube-channel'] : '';
    $html = '<div class="kmt-social-counter">';
    $html .= '<ul>';
    if(!empty($youtube)):
      $api_key = "AIzaSyAGzk0XPlUBwfgLpuOAljqG5ruDOCrntas";
      $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$youtube.'&fields=items/statistics/subscriberCount&key='.$api_key;
      $obj = json_decode(get_youtube_subs($url), true);
      $html .= '<li>';
      $html .= '<a href="https://www.youtube.com/channel/'.$youtube.'">';
      $html .= '<span class="count-icon dashicons dashicons-video-alt3"></span>';
      $html .= '<div class="subscriber"><span>'.$obj['items'][0]['statistics']['subscriberCount'].'</span><small>Subscribers</small></div>';
      $html .= '</a>';
      $html .= '</li>';
    endif;
    $html .= '</ul>';
    $html .= '</div>';

    echo $html;
    echo $args['after_widget']; 
  } 
}
function get_youtube_subs($url,$useragent='cURL',$headers=false, $follow_redirects=false,$debug=false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if ($headers==true){
      curl_setopt($ch, CURLOPT_HEADER,1);
    }
    if ($headers=='headers only') {
      curl_setopt($ch, CURLOPT_NOBODY ,1);
    }
      if ($follow_redirects==true) {
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
    }
    if ($debug==true) {
      $result['contents']=curl_exec($ch);
      $result['info']=curl_getinfo($ch);
    } else {
      $result=curl_exec($ch);
    }

    curl_close($ch);
    return $result;
}
register_widget( Kemet_Create_Widget::instance( "kemet_widget_social_counter" , $social_counter_widgets) );