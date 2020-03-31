<?php
$recent_tweets_widgets = array(
  'title'       => __('Kemet Recent Tweets', 'kemet-addons' ),
  'classname'   => 'kfw-widget-recent-tweets',
  'id'          => 'kemet-widget-recent-tweets',
  'description' => __('Recent Tweets', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Recent Tweets', 'kemet-addons' ),
    ),
    array(
        'id'     => 'twitter-users',
        'type'   => 'group',
        'title'  => __('Account', 'kemet-addons' ),
        'button_title'  => __('Add Account', 'kemet-addons' ),
        'accordion_title_auto'  => true,
        'fields' => array(
            array(
                'id'    => 'user-name',
                'type'  => 'text',
                'title' => __('Account ID', 'kemet-addons' ),
            ),
        ),
      ),
      array(
        'id'     => 'twitter-hashtags',
        'type'   => 'group',
        'title'  => __('Hashtag', 'kemet-addons' ),
        'button_title'  => __('Add Hashtag', 'kemet-addons' ),
        'accordion_title_auto'  => true,
        'fields' => array(
            array(
                'id'    => 'hashtag',
                'type'  => 'text',
                'title' => __('Hashtag', 'kemet-addons' ),
            ),
        ),
      ),
      array(
        'id'    => 'tweets-num',
        'type'  => 'number',
        'title' => __('Tweets Number', 'kemet-addons' ),
        'default'     => 3
      ),
      array(
        'id'    => 'tweet-lenght',
        'type'  => 'number',
        'title' => __('Tweet Length', 'kemet-addons' ),
        'default'     => 150
      ),
      array(
        'id'      => 'show-media',
        'type'    => 'checkbox',
        'title'   => __('Show Tweet Media', 'kemet-addons' ),
        'default' => true
      ),
      array(
        'id'    => 'readmore-text',
        'type'  => 'text',
        'title' => __('Read More', 'kemet-addons' ),
        'default' => __('Read More', 'kemet-addons' ),
    ), 
  )
);

if( ! function_exists( 'kemet_widget_recent_tweets' ) ) {
  function kemet_widget_recent_tweets( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    } 
    $accounts_id = isset($instance['twitter-users']) ? $instance['twitter-users'] : '';
    $hashtags = isset($instance['twitter-hashtags']) ? $instance['twitter-hashtags'] : '';
    $tweets_number = isset($instance['tweets-num']) ? $instance['tweets-num'] : 3;
    $tweets_length = isset($instance['tweet-lenght']) ? $instance['tweet-lenght'] : 50;
    $show_media = isset($instance['show-media']) && $instance['show-media'] == 1 ? true : false;
    $read_more = isset($instance['readmore-text']) ? $instance['readmore-text'] : 'Read More';
    $accounts = array();
    
    if(!empty($accounts_id)):
    foreach ( $accounts_id as $item ) { 
            
        if ( ! empty( $item['user-name'] ) ) {
            
            array_push( $accounts, $item['user-name'] ); 
        }
    }
    endif;

    if(!empty($hashtags)):
    foreach ( $hashtags as $item ) {
    
        if ( ! empty( $item['hashtag'] ) ) {
          
            array_push($accounts, $item['hashtag']); 
        }
    }
    
    endif;
    $twitter_settings = [
        'accounts'  => $accounts,
        'limit'     => $tweets_number,
        'consKey'   => 'wwC72W809xRKd9ySwUzXzjkmS',
        'consSec'   => 'rn54hBqxjve2CWOtZqwJigT3F5OEvrriK2XAcqoQVohzr2UA8h',
        'length'    => $tweets_length,
        'showMedia' => $show_media,
        'readMore'  => esc_html( $read_more ),
        'template'  => KEMET_WIDGETS_URL . 'templates/list-template.php',
    ];
    $json_settings = wp_json_encode( $twitter_settings );
    ?>
    <div class="tweets-container" data-settings='<?php echo $json_settings; ?>'></div>

    <?php
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_recent_tweets" , $recent_tweets_widgets) );