<?php
$tags_widget = array(
  'title'       => __('Kemet Tags', 'kemet-addons' ),
  'classname'   => 'kfw-widget-tags',
  'id'          => 'kemet-widget-tags',
  'description' => __('Tags', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Tags', 'kemet-addons' ),
    ),
    array(
      'id'    => 'tags-number',
      'type'  => 'number',
      'title' => __('Number of Tags to show', 'kemet-addons' ),
      'default'     => 10
    ),
    array(
      'id'          => 'tags-order-by',
      'type'        => 'select',
      'title'       => __('Order By:', 'kemet-addons' ),
      'options'     => array(
            'name' => __('Name', 'kemet-addons' ),
            'count' => __('Count', 'kemet-addons' ),
      ),
      'default'     => 'name'
    ),
    array(
        'id'          => 'tags-order',
        'type'        => 'select',
        'title'       => __('Order:', 'kemet-addons' ),
        'options'     => array(
              'ASC' => __('ASC', 'kemet-addons' ),
              'DESC' => __('DESC', 'kemet-addons' ),
        ),
        'default'     => 'asc'
      ),
  )
);

if( ! function_exists( 'kemet_widget_tags' ) ) {
  function kemet_widget_tags( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    $orderby = isset($instance['tags-order-by']) ? $instance['tags-order-by'] : 'name';
    $order = isset($instance['tags-order']) ? $instance['tags-order'] : 'ASC';
    $tags_number = isset($instance['tags-number']) ? $instance['tags-number'] : 10;
    $tags_args = array(
        // Default is 'name'. Can be name, count, or nothing (will use term_id).
        'orderby'	 => $orderby,
        // Default is ASC. Can use DESC.
        'order'		 => $order,
        // The maximum number of terms to return. Default is empty.
        'number'	 => $tags_number
    );
    $tags		 = get_tags( $tags_args ); ?>
    <div class="post-tags">
    <?php foreach ( $tags as $tag ) { 
        $tag_link = get_tag_link( $tag->term_id );
        ?>
        <a href="<?php echo $tag_link; ?>" title="<?php echo $tag->count; ?>" class="tag-link-<?php echo $tag->term_id; ?> label tag-<?php echo $tag->slug; ?>"><?php echo esc_attr($tag->name, 'kemet-addons' ); ?> </a> 
    <?php } ?>
    </div>    
    <?php    
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_tags" , $tags_widget) );