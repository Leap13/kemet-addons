<?php
$posts_tabs_widget = array(
  'title'       => __('Kemet Posts Tabs', 'kemet-addons' ),
  'classname'   => 'kmt-posts-tabs',
  'id'          => 'kemet-widget-posts-tabs',
  'class'       => 'kemet-tabs-widget',
  'description' => __('Posts Tabs', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'            => 'tabs-groubs',
      'type'          => 'accordion',
      'accordions'    => array(
        array(
          'title'     => 'Popular Posts',
          'fields'    => array(
            array(
              'id'      => 'popular-posts-display',
              'type'    => 'checkbox',
              'title'   => __('Display Popular Posts', 'kemet-addons' ),
              'default' => true
            ),  
            array(
              'id'      => 'popular-title',
              'type'    => 'text',
              'title'   => __('Label', 'kemet-addons' ),
              'default'   => __('Popular', 'kemet-addons' ),
            ),
            array(
              'id'    => 'popular-posts-number',
              'type'  => 'number',
              'title' => __('Number of posts to show', 'kemet-addons' ),
              'default'     => 5
            ),
            array(
                'id'    => 'popular-order',
                'type'  => 'number',
                'title' => __('Order', 'kemet-addons' ),
                'default'     => 1
              ),
          )
        ),
        array(
          'title'     => 'Recent Posts',
          'fields'    => array(
            array(
              'id'      => 'recent-posts',
              'type'    => 'checkbox',
              'title'   => __('Display Recent Posts', 'kemet-addons' ),
              'default' => true
            ),  
          array(
            'id'      => 'recent-title',
            'type'    => 'text',
            'title'   => __('Label', 'kemet-addons' ),
            'default'   => __('Recent', 'kemet-addons' ),
          ),
          array(
            'id'    => 'recent-posts-number',
            'type'  => 'number',
            'title' => __('Number of posts to show', 'kemet-addons' ),
            'default'     => 5
          ),
          array(
              'id'    => 'recent-order',
              'type'  => 'number',
              'title' => __('Order', 'kemet-addons' ),
              'default'     => 2
            ),
          )
        ),
        array(
          'title'     => 'Random Posts',
          'fields'    => array(
            array(
              'id'      => 'random-posts',
              'type'    => 'checkbox',
              'title'   => __('Display Random Posts', 'kemet-addons' ),
              'default' => true
            ),  
          array(
            'id'      => 'random-title',
            'type'    => 'text',
            'title'   => __('Label', 'kemet-addons' ),
            'default'   => __('Random', 'kemet-addons' ),
          ),
          array(
            'id'    => 'random-posts-number',
            'type'  => 'number',
            'title' => __('Number of posts to show', 'kemet-addons' ),
            'default'     => 5
          ),
          array(
              'id'    => 'random-order',
              'type'  => 'number',
              'title' => __('Order', 'kemet-addons' ),
              'class' => 'field-with-border',
              'default'     => 3
            ),
          )
        ),
        array(
          'title'     => 'Recent Comments Posts',
          'fields'    => array(
            array(
              'id'      => 'recent-comments-posts',
              'type'    => 'checkbox',
              'title'   => __('Display Recent Comments', 'kemet-addons' ),
              'default' => true
            ),  
          array(
            'id'      => 'recent-comments-title',
            'type'    => 'text',
            'title'   => __('Label', 'kemet-addons' ),
            'default'   => __('Recent Comments', 'kemet-addons' ),
          ),
          array(
            'id'    => 'recent-comments-posts-number',
            'type'  => 'number',
            'title' => __('Number of posts to show', 'kemet-addons' ),
            'default'     => 5
          ),
          array(
              'id'    => 'recent-comments-order',
              'type'  => 'number',
              'title' => __('Order', 'kemet-addons' ),
              'default'     => 4
            ),
          )
        ),
        array(
          'title'     => 'Tags Posts',
          'fields'    => array(
            array(
              'id'      => 'tags-posts',
              'type'    => 'checkbox',
              'title'   => __('Display Tags', 'kemet-addons' ),
              'default' => true
            ),  
          array(
            'id'      => 'tags-title',
            'type'    => 'text',
            'title'   => __('Label', 'kemet-addons' ),
            'default'   => __('Tags', 'kemet-addons' ),
          ),
          array(
            'id'    => 'tags-posts-number',
            'type'  => 'number',
            'title' => __('Number of posts to show', 'kemet-addons' ),
            'default'     => 5
          ),
          array(
              'id'    => 'tags-order',
              'type'  => 'number',
              'title' => __('Order', 'kemet-addons' ),
              'default'     => 5
            ),
          )
        ),
      )
    ),
  )
);

if( ! function_exists( 'kemet_widget_posts_tabs' ) ) {
  function kemet_widget_posts_tabs( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    
    $tabs_ground = $instance['tabs-groubs'];
    $popularposts = '';
    $tabs	 = array();

    if( $tabs_ground['popular-posts-display'] == 1 ){
      $tabs[]	 = array(
        'type'  => 'popular-posts',
        'label'	 => isset( $tabs_ground[ 'popular-title' ] )? $tabs_ground[ 'popular-title' ] : 'Popular',
        'num'	 => isset($tabs_ground[ 'popular-posts-number' ]) ? $tabs_ground[ 'popular-posts-number' ] : 5,
        'order'	 => isset($tabs_ground[ 'popular-order' ]) ? $tabs_ground[ 'popular-order' ] : 1,
      );
    }
    if( $tabs_ground['recent-posts'] == 1 ){
      $tabs[]	 = array(
        'type'  => 'recent-posts',
        'label'	 => isset($tabs_ground[ 'recent-title' ]) ? $tabs_ground[ 'recent-title' ] : 'Recent',
        'num'	 => isset( $tabs_ground[ 'recent-posts-number' ]) ? $tabs_ground[ 'recent-posts-number' ] : 5,
        'order'	 => isset( $tabs_ground[ 'recent-order' ]) ? $tabs_ground[ 'recent-order' ] : 2,
      );
    }
    if( $tabs_ground['random-posts'] == 1 ){
      $tabs[]	 = array(
        'type'  => 'random-posts',
        'label'	 => isset( $tabs_ground[ 'random-title' ] )? $tabs_ground[ 'random-title' ] : 'Random',
        'num'	 => isset( $tabs_ground[ 'random-posts-number' ]) ? $tabs_ground[ 'random-posts-number' ] : 5,
        'order'	 => isset( $tabs_ground[ 'random-order' ]) ? $tabs_ground[ 'random-order' ] : 3,
      );
    }
    if( $tabs_ground['recent-comments-posts'] == 1 ){
      $tabs[]	 = array(
        'type'  => 'recent-comments-posts',
        'label'	 => isset(  $tabs_ground[ 'recent-comments-title' ] )? $tabs_ground[ 'recent-comments-title' ] : 'Recent Comments',
        'num'	 => isset(  $tabs_ground[ 'recent-comments-posts-number' ] )? $tabs_ground[ 'recent-comments-posts-number' ] : 5,
        'order'	 => isset(  $tabs_ground[ 'recent-comments-order' ]) ? $tabs_ground[ 'recent-comments-order' ] : 4,
      );
    }
    if( $tabs_ground['tags-posts'] == 1 ){
      $tabs[]	 = array(
        'type'  => 'tags-posts',
        'label'	 => isset(  $tabs_ground[ 'tags-title' ]) ? $tabs_ground[ 'tags-title' ] : 'Tags',
        'num'	 => isset( $tabs_ground[ 'tags-posts-number' ] )? $tabs_ground[ 'tags-posts-number' ] : 5,
        'order'	 => isset(  $tabs_ground[ 'tags-order' ] )? $tabs_ground[ 'tags-order' ] : 5
      );
    }

    $tabs_order = wp_list_sort( $tabs , 'order' );
    
    ?>
		<div class="kmt-sc-tabs">
			<ul class="kmt-tabs-titles">
				<?php
				foreach ( $tabs_order as $tab ) {
					echo '<li data-tab="'. $tab[ 'type' ] .'">' . $tab[ 'label' ] . '</li>';
				}
				?>
			</ul>

			<?php
			foreach ( $tabs_order as $tab ) {
        echo '<div id="'. $tab[ 'type' ] .'" class="kmt-tab">';
				switch( $tab['type'] ){
            case 'popular-posts':
              $popularposts = get_posts( 'orderby=comment_count&numberposts=' . $tab['num'] );
              wp_get_posts($popularposts);
              break;
            case 'recent-posts':
              $popularposts = get_posts( 'numberposts=' . $tab['num'] );
              wp_get_posts($popularposts);
              break;
            case 'random-posts':
              $popularposts = get_posts( 'orderby=rand&numberposts=' . $tab['num'] );
              wp_get_posts($popularposts);
              break;
            case 'recent-comments-posts':
              get_recent_commented( $tab[ 'num' ], 50 );
              break;
            case 'tags-posts':
              get_popular_tags( $tab[ 'num' ], 50 );
              break;  
        }
        
        echo '</div>';
			}
			?>

		</div>

		<?php

    echo $args['after_widget']; 
  } 
}
/* ----------------------------------------------------------------------------------- */
# Get Popular posts 
/* ----------------------------------------------------------------------------------- */

function wp_get_posts($query , $thumb = true ) {
  global $wpdb, $post;
  $orig_post = $post;

  $popularposts = get_posts( $query );
  echo '<ul class="kmt-wdg-posts-list">';
  ?>
    <?php foreach ( $popularposts as $post ){
          setup_postdata( $post );
      echo '<li>';
      if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail()) { ?>
          <div class="wgt-img">
					      <a class="ttip" title="<?php esc_attr(the_title(), 'kemet-addons' ); ?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( array('50', '50') ) ?></a>
				  </div><!-- wgt-img /-->
      <?php } ?>
        <div class="wdg-posttitle"><a href="<?php the_permalink(); ?>"><?php esc_attr(the_title(), 'kemet-addons' ); ?></a></div>
        <small class="small"><?php echo esc_attr(get_the_date(), 'kemet-addons' ); ?></small>
      </li>
        <?php } 
        echo '</ul>';
      ?>
    <?php
  $post = $orig_post;
}
/* ----------------------------------------------------------------------------------- */
	# Get commented posts 
	/* ----------------------------------------------------------------------------------- */

	function get_recent_commented( $comment_posts = 5, $avatar_size = 50 ) {
    $comments = get_comments( 'status=approve&post_type=post&number=' . $comment_posts );
    echo '<ul class="kmt-wdg-posts-list">';
		foreach ( $comments as $comment ) {
			?>
			<li>
				<div class="wgt-img">
					<?php echo get_avatar( $comment, $avatar_size ); ?>
				</div>
				<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
					<?php echo strip_tags( $comment->comment_author ); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 60, '...' ); ?> </a>
			</li>
			<?php
    }
    echo '</ul>';
	}
/* ----------------------------------------------------------------------------------- */
	# Get commented posts 
	/* ----------------------------------------------------------------------------------- */

	function get_popular_tags( $num = 5, $avatar_size = 50 ) {
		$tags_args = array(
			'orderby'	 => 'count',
			'order'		 => 'DESC',
			'number'	 => $num
		);

		$tags		 = get_tags( $tags_args );
		$tags_cloud	 = '<div class="post-tags">';
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );

			$tags_cloud .= "<a href='{$tag_link}' title='{$tag->count} post' class='tag-link-{$tag->term_id} label tag-{$tag->slug}'>";
			$tags_cloud .= "{$tag->name}</a>";
		}
    $tags_cloud .= '</div>';
		echo $tags_cloud;
  }
register_widget( Kemet_Create_Widget::instance( "kemet_widget_posts_tabs" , $posts_tabs_widget) );