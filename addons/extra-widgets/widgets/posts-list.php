<?php
$posts_list_widgets_widget = array(
  'title'       => __('Kemet Posts List', 'kemet-addons' ),
  'classname'   => 'kwf-widget-posts-list',
  'id'          => 'kemet-widget-posts-list',
  'description' => __('Posts List', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title', 'kemet-addons' ),
      'default'   => __('Posts List', 'kemet-addons' ),
    ),
    array(
      'id'    => __('posts-number', 'kemet-addons' ),
      'type'  => 'number',
      'title' => __('Number of posts to show', 'kemet-addons' ),
      'default'     => 12
    ),
    array(
      'id'          => 'posts-order',
      'type'        => 'select',
      'title'       => __('Posts Order', 'kemet-addons' ),
      'options'     => array(
            'most-recent' => __('Most Recent', 'kemet-addons' ),
            'popular' => __('Popular', 'kemet-addons' ),
            'random' => __('Random', 'kemet-addons' ),
      ),
      'default'     => 'most-recent'
    ),
    array(
        'id'      => 'display-thumbinals',
        'type'    => 'checkbox',
        'title'   => __('Display Thumbinals', 'kemet-addons' ),
        'default' => true
      ),
  )
);

if( ! function_exists( 'kemet_widget_posts_list' ) ) {
  function kemet_widget_posts_list( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', __($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    global $post;
    $orig_post = $post;

    $order = isset($instance['posts-order']) ? $instance['posts-order'] : 'random';
    $posts_number = isset($instance['posts-number']) ? $instance['posts-number'] : 12;
    
    switch($order){
      case 'random':
          $cat_posts	 = get_posts( array( 'numberposts' => $posts_number, 'orderby' => 'rand', 'category' => $category ) );

          break;
      case 'most-recent':
          $cat_posts	 = get_posts( array( 'numberposts' => $posts_number, 'category' => $category ) );
      
          break;    
    }?>
    <div class="kmt-posts-images">
    <?php foreach ( $cat_posts as $post ): setup_postdata( $post );
			
			if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) : ?>
					<a class="post-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('kemet-thumbnail'); ?></a>
			<?php endif;
        endforeach; 
      ?>
    </div>
    <?php
    $post = $orig_post;
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_posts_list" , $posts_list_widgets_widget) );