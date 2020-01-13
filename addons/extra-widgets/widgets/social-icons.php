<?php

$Social_icons_widget = array(
  'title'       => 'Kemet Social Icons',
  'classname'   => 'kwf-widget-social-icon',
  'id'          => 'kemet-widget-social-icons',
  'description' => 'Social Icons',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title',
    ),
    array(
      'id'     => 'social-profile',
      'type'   => 'group',
      'title'  => 'Add Icon',
      'button_title'  => 'Add Icon',
      'accordion_title_auto'  => true,
      'fields' => array(
    
        array(
          'id'    => 'profile-title',
          'type'  => 'text',
          'title' => 'Title',
        ),
        array(
          'id'    => 'link',
          'type'  => 'text',
          'title' => 'Link',
          'validate' => 'kfw_validate_url',
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
      'title' => 'Display Icon Title',
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
        'simple'  => 'Simple',
        'circle'  => 'Circle',
        'square'  => 'Square',
        'circle-outline'  => 'Circle Outline',
        'square-outline'  => 'Square Outline',
      ),
      'default'     => 'simple'
    ),
    array(
      'id'    => 'icon-bg-color',
      'type'  => 'color',
      'title' => 'Background Color',
      'dependency' => array(
        array( 'icon-style', '!=', 'simple' ),
        array( 'icon-style',   '!=', 'circle-outline' ),
        array( 'icon-style',   '!=', 'square-outline' ),
      ),
    ),
    array(
      'id'    => 'icon-hover-bg-color',
      'type'  => 'color',
      'title' => 'Background Hover Color',
      'dependency' => array(
        array( 'icon-style', '!=', 'simple' ),
        array( 'icon-style',   '!=', 'circle-outline' ),
        array( 'icon-style',   '!=', 'square-outline' ),
      ),
    ),
    array(
      'id'    => 'icon-border-color',
      'type'  => 'color',
      'title' => 'Border Color',
      'dependency' => array(
        array( 'icon-style', '!=', 'simple' ),
        array( 'icon-style',   '!=', 'circle' ),
        array( 'icon-style',   '!=', 'square' ),
      ),
    ),
    array(
      'id'    => 'icon-hover-border-color',
      'type'  => 'color',
      'title' => 'Border Hover Color',
      'dependency' => array(
        array( 'icon-style', '!=', 'simple' ),
        array( 'icon-style',   '!=', 'circle' ),
        array( 'icon-style',   '!=', 'square' ),
      ),
    ),
    array(
      'id'    => 'icon-width',
      'type'  => 'number',
      'title' => 'Icon Width',
      'unit'  => 'px',
    ),
    array(
      'id'    => 'space-between-icon-text',
      'type'  => 'number',
      'title' => 'Space Between Icon & Text:',
      'unit'  => 'px',
      'output_mode' => 'padding',
      'dependency' => array( 'enable-title', '==', 'true' ),
    ),
    array(
      'id'    => 'space-between-profiles',
      'type'  => 'number',
      'title' => 'Space Between Social Icons:',
      'unit'  => 'px',
      'output_mode' => 'padding'
    ),
  )
);

if( ! function_exists( 'kemet_widget_social_profiles' ) ) {
  function kemet_widget_social_profiles( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    } 
    if(! empty($instance['social-profile'])){
    ?>
    <div class="kmt-social-profiles <?php echo $instance['icon-style'] ?>">
    <?php foreach($instance['social-profile'] as $profile){
      $link_target = isset($profile['link-target']) ? $profile['link-target'] : '_blank';  
      if(!empty($profile['social-icon'])){
        $icon_class = explode('-', $profile['social-icon'],2)[1];
        }else{
          $icon_class = '';
        }
      ?>
      <a href="<?php echo esc_attr($profile['link']) ?>" class="kmt-profile-link" target="<?php echo esc_attr($link_target) ?>">
        <span class="profile-icon <?php echo esc_attr($icon_class) ?>"><span class="dashicons <?php echo esc_attr($profile['social-icon']);?>"></span></span>
        <?php if($instance['enable-title']){ ?>
        <span class='profile-title'><?php echo esc_attr($profile['profile-title']); ?></span>
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
    $border_color = !empty($instance['icon-border-color']) ? $instance['icon-border-color'] : '';
    $icon__hover_border_color = !empty($instance['icon-hover-border-color']) ? $instance['icon-hover-border-color'] : '';
    if(!empty($instance['space-between-profiles']) && $instance['alignment'] == 'row'){
      $space_between_profiles = 'padding-right:' . $instance['space-between-profiles'] . 'px';
    }elseif(!empty($instance['space-between-profiles']) && $instance['alignment'] == 'column'){
      $space_between_profiles = 'padding-bottom:' . $instance['space-between-profiles'] . 'px';
    }else{
      $space_between_profiles = '';
    }
    $icon_width = !empty($instance['icon-width']) ? $instance['icon-width'] .'px' : '';
    $space_text_icon = !empty($instance['space-between-icon-text']) ? $instance['space-between-icon-text'] .'px' : '';
    ?> 
  <style>
    <?php echo $id ?>.kmt-social-profiles.circle .kmt-profile-link .profile-icon , <?php echo $id ?>.kmt-social-profiles.square .kmt-profile-link .profile-icon{ 
      <?php if ( $icon_bg_color ) { echo 'background-color:' . esc_attr($icon_bg_color); } ?>;
    }
    <?php echo $id ?>.kmt-social-profiles.circle .kmt-profile-link .profile-icon:hover , <?php echo $id ?>.kmt-social-profiles.square .kmt-profile-link .profile-icon:hover{ 
      <?php if ( $icon__hover_bg_color ){ echo 'background-color:' . esc_attr($icon__hover_bg_color); } ?>;
    }
    <?php echo $id ?>.kmt-social-profiles .kmt-profile-link .profile-icon { 
      <?php if ( $icon_width ) { echo 'font-size:' . esc_attr($icon_width); } ?>;
    }
    <?php echo $id ?>.kmt-social-profiles .kmt-profile-link .profile-title { 
      <?php if ( $space_text_icon ) { echo 'padding-left:' . esc_attr($space_text_icon); } ?>;
    }
    <?php foreach($instance['social-profile'] as $profile){ 
      if(!empty($profile['social-icon'])){
      $icon_class = explode('-', $profile['social-icon'],2)[1];
      ?>
      .kmt-social-profiles .kmt-profile-link .profile-icon.<?php echo esc_attr($icon_class); ?> {
        <?php if ( $profile['icon-color'] ){ echo 'color: '.esc_attr($profile['icon-color']); } ?>;
      }
      <?php echo $id ?>.kmt-social-profiles .kmt-profile-link .profile-icon.<?php echo esc_attr($icon_class); ?>:hover {
        <?php if ( $profile['icon-hover-color'] ){ echo 'color:' . esc_attr($profile['icon-hover-color']); } ?>;
      }
      <?php }
      } ?>

    <?php echo $id ?>.kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon{
      <?php if ( $border_color ){ echo 'border:1px solid'.esc_attr($border_color); } ?>;
    }
    <?php echo $id ?>.kmt-social-profiles.circle-outline .kmt-profile-link .profile-icon:hover{
      <?php if ( $icon__hover_border_color ){ echo 'border-color: '. esc_attr($icon__hover_border_color);} ?>;
    }
    <?php echo $id ?>.kmt-social-profiles.square-outline .kmt-profile-link .profile-icon{
      <?php if ( $border_color ){ echo 'background:transparent; border-radius: unset; border:1px solid'.esc_attr($border_color); } ?>;
    }
    <?php echo $id ?>.kmt-social-profiles.square-outline .kmt-profile-link .profile-icon:hover{
      <?php if ( $icon__hover_border_color ){ echo 'background: transparent; border-color: '. esc_attr($icon__hover_border_color);} ?>;
    }
    <?php echo $id ?>.kmt-social-profiles .kmt-profile-link:not(:last-child){
      <?php { echo $space_between_profiles;} ?>;
    }
    <?php echo $id ?>.kmt-social-profiles { 
      <?php if ( $alignment ){ echo 'flex-direction:' . esc_attr($alignment); } ?>;
    }
    .kmt-social-profiles .kmt-profile-link .profile-icon.facebook{
      color: #3b5998;
    }
    .kmt-social-profiles .kmt-profile-link .profile-icon.twitter{
      color: #00aced;
    }
    .kmt-social-profiles .kmt-profile-link .profile-icon.googleplus{
      color: #dd4b39;
    }
  </style>
<?php echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_social_profiles" , $Social_icons_widget) );