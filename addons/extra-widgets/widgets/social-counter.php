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
        'id'      => 'facebook-page',
        'type'    => 'text',
        'title'   => __('Facebook', 'kemet-addons' ),
      ), 
  )
);

if( ! function_exists( 'kemet_widget_social_counter' ) ) {
  function kemet_widget_social_counter( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    
    
    $appid = '666000477544633';
    $appsecret = '330068577bc77bfb887147bd277136a6';
    $url = 'https://www.facebook.com/Emarkati-243365042949967/';
    //$url = 'http://www.batsinaustin.com';
    $url = "https://graph.facebook.com/v3.2/?id=$url&fields=engagement&access_token=$appid|$appsecret";

    // $url = "https://graph.facebook.com/666000477544633?fields=likes.summary(true)&access_token=EAAJduVHiYLkBAGCQQTkKu4oVxmnZBAOQ8AYye7bNa3mwVX2hh0xKQTktSpbWCmiJeU5mGiJbLLWk180ZBnkfM6F6PFb12YSqzhNvDKlV3YeNsyETkrJOcsyrUyHvXG5FZCWg0XP0nE8u2e0avRGBpZAHCXdL2ZB5pYPdJpTKGIdLqagVpxLXgt3TbdMPWLCw1g5Uo00M0c3fez6oc63LkukkaugbwhnE51pewMw5VxyM5CmUWwwWZC";
    //open connection
    $ch = curl_init();
    $timeout=5;
    //set the url
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE 
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    $data = json_decode($result,true);
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    // add up engagement numbers: reaction count, comment count, and share count
    $total_count = $data['engagement']['reaction_count'] + $data['engagement']['comment_count'] + $data['engagement']['share_count'];
    echo '<p>Likes: '.number_format($total_count).'</p>';
    
 
    echo $args['after_widget']; 
  } 
}
register_widget( Kemet_Create_Widget::instance( "kemet_widget_social_counter" , $social_counter_widgets) );