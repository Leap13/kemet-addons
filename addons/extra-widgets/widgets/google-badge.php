<?php
$google_badge_widgets = array(
  'title'       => __('Kemet Google Badge', 'kemet-addons' ),
  'classname'   => 'kfw-widget-google-badge',
  'id'          => 'kemet-widget-google-badge',
  'description' => __('Kemet Google Badge', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Follow us on Google+', 'kemet-addons' ),
    ),
    array(
        'id'      => 'page-url',
        'type'    => 'text',
        'title'   => __('Page Url', 'kemet-addons' ),
      ),
      array(
        'id'          => 'layout',
        'type'        => 'select',
        'title'       => __('Layout', 'kemet-addons' ),
        'options'     => array(
              'portrait' => __('Portrait', 'kemet-addons' ),
              'landscape' => __('Landscape', 'kemet-addons' ),
        ),
        'default'     => 'portrait'
      ),
      array(
        'id'    => 'width',
        'type'  => 'number',
        'title' => __('Width', 'kemet-addons' ),
        'default'     => 5
      ),
      array(
        'id'          => 'theme-color',
        'type'        => 'select',
        'title'       => __('Color theme', 'kemet-addons' ),
        'options'     => array(
              'light' => __('Light', 'kemet-addons' ),
              'dark' => __('Dark', 'kemet-addons' ),
        ),
        'default'     => 'light'
      ),
      array(
        'id'          => 'cover-photo',
        'type'        => 'select',
        'title'       => __('Cover Photo', 'kemet-addons' ),
        'options'     => array(
              'true' => __('Enable', 'kemet-addons' ),
              'false' => __('Disable', 'kemet-addons' ),
        ),
        'default'     => 'true'
      ),
      array(
        'id'          => 'tagline',
        'type'        => 'select',
        'title'       => __('Tagline', 'kemet-addons' ),
        'options'     => array(
              'true' => __('Enable', 'kemet-addons' ),
              'false' => __('Disable', 'kemet-addons' ),
        ),
        'default'     => 'true'
      ),
    ),
);


if( ! function_exists( 'kemet_widget_google_badge' ) ) {
  function kemet_widget_google_badge( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    $page_url	 = $instance[ 'page-url' ];
    $layout		 = $instance[ 'layout' ];
    $width		 = $instance[ 'width' ];
    $theme		 = $instance[ 'theme-color' ];
    $cover_photo = $instance[ 'cover-photo' ];
    $tagline	 = $instance[ 'tagline' ];
    
        ?>
        <div class="google-box">

            <!-- Place this tag where you want the widget to render. -->
            <div class="g-page" data-width="<?php echo $width; ?>" data-href="<?php echo $page_url; ?>" data-layout="<?php echo $layout; ?>" data-theme="<?php echo $theme; ?>" <?php if ( $layout == 'portrait' ) : ?>data-showcoverphoto="<?php echo $cover_photo; ?>" data-showtagline="<?php echo $tagline; ?>"<?php endif; ?> data-rel="publisher"></div>

            <!-- Place this tag after the last widget tag. -->
            <script type="text/javascript">
                ( function () {
                    var po = document.createElement('script'); 
                    po.type = 'text/javascript'; 
                    po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; 
                    s.parentNode.insertBefore(po, s);
                } )();
            </script>

        </div>
        <?php
    
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_google_badge" , $google_badge_widgets) );