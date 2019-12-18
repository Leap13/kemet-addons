<?php

$Social_icons_widget = array(
  'title'       => 'Kemet Social Icons',
  'classname'   => 'kwf-widget-social-icon',
  'description' => 'Social Profile',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title',
    ),array(
      'id'     => 'social-profile',
      'type'   => 'repeater',
      'title'  => 'Add Profile',
      'fields' => array(
    
        array(
          'id'    => 'profile-title',
          'type'  => 'text',
          'title' => 'Title'
        ),
        array(
          'id'    => 'link',
          'type'  => 'text',
          'title' => 'Link'
        ),
        array(
          'id'          => 'link-target',
          'type'        => 'select',
          'title'       => 'Target',
          'options'     => array(
            '_self'  => 'Same Page',
            '_blank'  => 'New Page',
          ),
          'default'     => 'new-page'
        ),
        array(
          'id'    => 'no-follow',
          'type'  => 'switcher',
          'title' => 'No Follow',
        ),
        array(
          'id'    => 'social-icon',
          'type'  => 'icon',
          'title' => 'Icon',
        ),
        array(
          'id'    => 'icon-color',
          'type'  => 'color',
          'title' => 'Icon Color',
        ),
        array(
          'id'    => 'icon-hover-color',
          'type'  => 'color',
          'title' => 'Icon Hover Color',
        ),
      ),
    ),
    array(
      'id'    => 'enable-title',
      'type'  => 'switcher',
      'title' => 'Display Profile Title',
    ),
    array(
      'id'          => 'alignment',
      'type'        => 'select',
      'title'       => 'Alignment',
      'options'     => array(
        'row'  => 'Inline',
        'column'  => 'Stack',
      ),
      'default'     => 'inline'
    ),
    array(
      'id'          => 'icon-style',
      'type'        => 'select',
      'title'       => 'Icon Style',
      'options'     => array(
        'circle'  => 'Circle',
        'square'  => 'Square',
        'circle-outline'  => 'Circle Outline',
        'square-outline'  => 'Square Outline',
      ),
      'default'     => 'square'
    ),
    array(
      'id'    => 'icon-bg-color',
      'type'  => 'color',
      'title' => 'Background Color',
    ),
    array(
      'id'    => 'icon-hover-bg-color',
      'type'  => 'color',
      'title' => 'Background Hover Color',
    ),
    array(
      'id'    => 'icon-width',
      'type'  => 'number',
      'title' => 'Icon Width',
      'unit'  => 'px',
      'output_mode' => 'width'
    ),
    array(
      'id'    => 'space-between-icon-text',
      'type'  => 'number',
      'title' => 'Space Between Icon & Text:',
      'unit'  => 'px',
      'output_mode' => 'padding'
    ),
    array(
      'id'    => 'space-between-profiles',
      'type'  => 'number',
      'title' => 'Space Between Social Profiles:',
      'unit'  => 'px',
      'output_mode' => 'padding'
    ),
  )
);

if( ! function_exists( 'front_end' ) ) {
  function front_end( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    } 
    if(! empty($instance['social-profile'])){
    ?>
    <div class="kmt-social-profiles <?php echo $instance['icon-style'] ?>">
    <?php foreach($instance['social-profile'] as $profile){ 
        $icon_class = explode('-', $profile['social-icon'],2)[1];
        $link_target = isset($profile['link-target']) ? $profile['link-target'] : '_blank';
      ?>
      <a href="<?php echo $profile['link'] ?>" class="kmt-profile-link" target="<?php echo $link_target ?>">
        <span class="profile-icon <?php echo $icon_class ?>"><span class="dashicons <?php echo $profile['social-icon'];?>"></span></span>
        <?php if($instance['enable-title']){ ?>
        <span class='profile-title'><?php echo $profile['profile-title']; ?></span>
        <?php } ?>
      </a>
 <?php }
    echo '</div>';
    } 
    //Css Style
    $icon_color = !empty($instance['icon-color']) ? $instance['icon-color'] : '';
    $icon_hover_color = !empty($instance['icon-hover-color']) ? $instance['icon-hover-color'] : '';
    $icon_bg_color = !empty($instance['icon-bg-color']) ? $instance['icon-bg-color'] : '';
    $icon__hover_bg_color = !empty($instance['icon-hover-bg-color']) ? $instance['icon-hover-bg-color'] : '';
    $alignment = !empty($instance['alignment']) ? $instance['alignment'] : '';
    $space_between_profiles = ($instance['alignment'] == 'row') ? 'padding-right:' . $instance['space-between-profiles'] . 'px' : 'padding-bottom:' . $instance['space-between-profiles'] . 'px';
    $icon_width = !empty($instance['icon-width']) ? $instance['icon-width'] .'px' : '';
    $space_text_icon = !empty($instance['space-between-icon-text']) ? $instance['space-between-icon-text'] .'px' : '';
    ?> 
  <style>
    .kmt-social-profiles .kmt-profile-link .profile-icon { 
      <?php if ( $icon_bg_color ) { echo 'background-color:' . $icon_bg_color; } ?>;
      <?php if ( $icon_width ) { echo 'font-size:' . $icon_width; } ?>;
    }
    .kmt-social-profiles .kmt-profile-link .profile-title { 
      <?php if ( $space_text_icon ) { echo 'padding-left:' . $space_text_icon; } ?>;
    }
    <?php foreach($instance['social-profile'] as $profile){ 
      $icon_class = explode('-', $profile['social-icon'],2)[1];
      ?>
      .kmt-social-profiles .kmt-profile-link .profile-icon.<?php {echo $icon_class;} ?> {
        <?php if ( $profile['icon-color'] ){ echo 'color: '.$profile['icon-color']; } ?>;
      }
      .kmt-social-profiles .kmt-profile-link .profile-icon.<?php {echo $icon_class;} ?>:hover {
        <?php if ( $profile['icon-hover-color'] ){ echo 'color:' . $profile['icon-hover-color']; } ?>;
      }
      <?php } ?>
    .kmt-social-profiles.circle .kmt-profile-link .profile-icon{
      <?php { echo 'border-radius: 50%'; } ?>;
    }
    .kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon{
      <?php { echo 'background:transparent; border-radius: 50%; border:1px solid'.$icon_bg_color; } ?>;
    }
    .kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon:hover{
      <?php { echo 'background: transparent; border-color: '. $icon__hover_bg_color;} ?>;
    }
    .kmt-social-profiles.square-outline .kmt-profile-link .profile-icon{
      <?php { echo 'background:transparent; border-radius: unset; border:1px solid'.$icon_bg_color; } ?>;
    }
    .kmt-social-profiles.square-outline .kmt-profile-link .profile-icon:hover{
      <?php { echo 'background: transparent; border-color: '. $icon__hover_bg_color;} ?>;
    }
    .kmt-social-profiles .kmt-profile-link .profile-icon:hover { 
      <?php if ( $icon__hover_bg_color ){ echo 'background-color:' . $icon__hover_bg_color; } ?>;
    }
    .kmt-social-profiles .kmt-profile-link:not(:last-child){
      <?php { echo $space_between_profiles;} ?>;
    }
    .kmt-social-profiles { 
      <?php if ( $alignment ){ echo 'flex-direction:' . $alignment; } ?>;
		}
  </style>
<?php } 
}


register_widget( Kemet_Create_Widget::instance( "front_end" , $Social_icons_widget , $extra_fields = '' ) );