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
      array(
        'id'            => 'facebook-fields',
        'type'          => 'accordion',
        'accordions'    => array(
          array(
            'title'     => 'Facebook',
            'fields'    => array(
              array(
                'type'    => 'content',
                'content' => __('<span  class="button fb-login" style="background-color: #3b5998; color: #fff; border:0;">Log in with Facebook</span>'),
              ),
              array(
                'id'      => 'access-token',
                'type'    => 'textarea',
                'title'   => 'Access Token',
                'class'   => 'fb-access-token',
              ),
              array(
                'id'      => 'fb-page-id',
                'type'    => 'text',
                'title'   => 'Page ID',
                'class'   => 'fb-page-id',
              ),
              array(
                'id'      => 'fb-page-name',
                'type'    => 'text',
                'title'   => 'Page Name',
                'class'   => 'fb-page-name',
              ),
            ),
          ),
        ),
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
    $fb_fields = isset($instance['facebook-fields']) ? $instance['facebook-fields'] : '';
    $faceboo_access_token = isset($fb_fields['access-token']) ? $fb_fields['access-token'] : '';
    $faceboo_page_id = isset($fb_fields['fb-page-id']) ? $fb_fields['fb-page-id'] : '';
    $faceboo_name = isset($fb_fields['fb-page-name']) ? $fb_fields['fb-page-name'] : '';
    
    
    $html = '<div class="kmt-social-counter">';
    $html .= '<ul>';
    if(!empty($youtube)):
      $api_key = "AIzaSyAGzk0XPlUBwfgLpuOAljqG5ruDOCrntas";
      $url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$youtube.'&fields=items/statistics/subscriberCount&key='.$api_key;
      $obj = json_decode(get_api_result($url), true);
      $html .= '<li>';
      $html .= '<a href="https://www.youtube.com/channel/'.$youtube.'" target="_blank">';
      $html .= '<span class="count-icon dashicons dashicons-video-alt3"></span>';
      $html .= '<div class="subscriber"><span>'.$obj['items'][0]['statistics']['subscriberCount'].'</span><small>Subscribers</small></div>';
      $html .= '</a>';
      $html .= '</li>';
    endif;
    if(!empty($faceboo_access_token) && !empty($faceboo_page_id) && !empty($faceboo_name)):

      $api_url = 'https://graph.facebook.com/' . $faceboo_page_id . '/?fields=fan_count&access_token=' . $faceboo_access_token;
      $fb_obj = get_api_result($api_url);
      $fb_fan_obj = json_decode($fb_obj, true);

      $html .= '<li>';
      $html .= '<a href="https://www.facebook.com/'.$faceboo_page_id.'" target="_blank">';
      $html .= '<span class="count-icon dashicons dashicons-facebook-alt"></span>';
      $html .= '<div class="subscriber"><span>'.$fb_fan_obj['fan_count'].'</span><small>Likes</small></div>';
      $html .= '</a>';
      $html .= '</li>';
    endif;
    $html .= '</ul>';
    $html .= '</div>';

    echo $html;
    echo $args['after_widget']; 
  } 
}
function get_api_result($url,$useragent='cURL',$headers=false, $follow_redirects=false,$debug=false) {
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