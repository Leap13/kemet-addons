<?php
$facebook_widgets = array(
  'title'       => __('Kemet Facebook Box', 'kemet-addons' ),
  'classname'   => 'kfw-widget-facebook-box',
  'id'          => 'kemet-widget-facebook-box',
  'description' => __('Facebook Box', 'kemet-addons' ),
  'fields'      => array(
      array(
        'id'      => 'title',
        'type'    => 'text',
        'title'   => __('Title', 'kemet-addons' ),
        'default'   => __('Find us on Facebook', 'kemet-addons' ),
      ),
      array(
        'id'      => 'page-url',
        'type'    => 'text',
        'title'   => __('The URL of the Facebook Page:', 'kemet-addons' ),
      ),
      array(
        'id'      => 'app-id',
        'type'    => 'text',
        'title'   => __('App Id:', 'kemet-addons' ),
        'subtitle' => __('Get Facebook application id from <a target="_blank" href="'.esc_url( 'https://developers.facebook.com/apps/' ).'">here</a>', 'kemet-addons' ),
      ),
      array(
        'id'      => 'tabs',
        'type'    => 'text',
        'title'   => __('Tabs:', 'kemet-addons' ),
        'subtitle' => __('Tabs to render i.e. timeline, events, messages. Use a comma-separated list to add multiple tabs, i.e. timeline, events.', 'kemet-addons' ),
      ), 
      array(
        'id'    => 'width',
        'type'  => 'number',
        'title' => __('Width', 'kemet-addons' ),
        'default'     => 268,
        'subtitle' => __('The pixel width of the plugin. Min. is 180 & Max. is 500', 'kemet-addons' ),
      ),
      array(
        'id'    => 'height',
        'type'  => 'number',
        'title' => __('Height', 'kemet-addons' ),
        'default'     => 280,
        'subtitle' => __('The pixel height of the plugin. Min. is 70', 'kemet-addons' ),
      ),
      array(
        'id'      => 'small-header',
        'type'    => 'checkbox',
        'title'   => __('Use Small Header', 'kemet-addons' ),
        'default' => false,
        'subtitle' => __('Use the small header instead', 'kemet-addons' ),
      ),
      array(
        'id'      => 'hide-cover',
        'type'    => 'checkbox',
        'title'   => __('Hide Cover', 'kemet-addons' ),
        'default' => false,
        'subtitle' => __('Hide cover photo in the header', 'kemet-addons' ),
      ),
      array(
        'id'      => 'profile-photos',
        'type'    => 'checkbox',
        'title'   => __('Show profile photos', 'kemet-addons' ),
        'default' => true,
        'subtitle' => __('Show profile photos when friends like this', 'kemet-addons' ),
      ),
      array(
        'id'      => 'hide-call-action',
        'type'    => 'checkbox',
        'title'   => __('Hide call to action', 'kemet-addons' ),
        'default' => false,
        'subtitle' => __('Hide the custom call to action button (if available)', 'kemet-addons' ),
      ),
      array(
        'id'      => 'lang',
        'type'    => 'text',
        'title'   => __('Language:', 'kemet-addons' ),
        'subtitle' => __('Supported locales are referenced in the <a target="_blank" href="'.esc_url( 'https://www.facebook.com/translations/FacebookLocales.xml' ).'">Facebook Locales XML file</a>', 'kemet-addons' ),
        'default' => 'en_US',
      ),  
  )
);

if( ! function_exists( 'kemet_widget_facecook_box' ) ) {
  function kemet_widget_facecook_box( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    $page_url = isset($instance['page-url']) ? $instance['page-url'] : '';
    $app_id = isset($instance['app-id']) ? $instance['app-id'] : '';
    $tabs = isset($instance['tabs']) ? $instance['tabs'] : '';
    $width = isset($instance['width']) ? $instance['width'] : '';
    $height = isset($instance['height']) ? $instance['height'] : '';
    $small_header  = $instance[ 'small-header' ] ? 'true' : 'false';
    $hide_cover    = $instance[ 'hide-cover' ] ? 'true' : 'false';
    $show_facepile = $instance[ 'profile-photos' ] ? 'true' : 'false';
    $hide_cta      = $instance[ 'hide-call-action' ] ? 'true' : 'false';
    $language = isset($instance['lang']) ? $instance['lang'] : '';
    
    if ( $page_url ):
        ?>

        <div id="fb-root"></div>
        <script>( function ( d, s, id ) {
                    var js, fjs = d.getElementsByTagName( s )[0];
                    if ( d.getElementById( id ) )
                        return;
                    js = d.createElement( s );
                    js.id = id;
                    js.src = "//connect.facebook.net/<?php echo esc_attr( $language ); ?>/sdk.js#xfbml=1&version=v2.5&appId=<?php echo esc_attr( $app_id ); ?>";
                        fjs.parentNode.insertBefore( js, fjs );
                }( document, 'script', 'facebook-jssdk' ) );</script>

        <div class="fb-page"
             data-href="<?php echo esc_url( $page_url ); ?>"
             data-width="<?php echo esc_attr( $width ); ?>"
             data-height="<?php echo esc_attr( $height ); ?>"
             data-tabs="<?php echo esc_attr( $tabs ); ?>"
             data-small-header="<?php echo $small_header ?>"
             data-adapt-container-width="true"
             data-hide-cover="<?php echo $hide_cover ?>"
             data-show-facepile="<?php echo $show_facepile ?>"
             data-hide-cta="<?php echo $hide_cta ?>"></div>


        <?php
    endif;
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_facecook_box" , $facebook_widgets) );