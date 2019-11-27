<?php
/**
 * Related Posts
 * 
 * @package Kemet Addons
 */ 


global $post;
$orig_post	 = $post;
$posts_taxonomy = kemet_get_option();
$tags		 = wp_get_post_tags( $post->ID );
$categories  = wp_get_post_categories( $post->ID);
if ( $tags ) {
	$tags_ids = array();
	foreach ( $tags as $individual_tag ) {
		$tags_ids[] = $individual_tag->term_id;
	}
	$args = array(
		'tag__in'		 => $tags_ids,
		'post__not_in'	 => array( $post->ID ),
		'posts_per_page' => 20
	);
	if($categories){
		$cats_ids = array();
		foreach($categories as $category){
			$cat= get_category( $category );
			$cats_ids[] = $cat->cat_ID;
		}
	}
	$Catargs = array(
		'category__in'		 => $cats_ids,
		'post__not_in'	 => array( $post->ID ),
		'posts_per_page' => 20
	);
	$query2 = new wp_query( $Catargs );
	$my_query = new wp_query( $args );

	$output = '';

	if($query2->have_posts()){
		while ( $query2->have_posts() ) {
			$query2->the_post();
			if ( has_post_thumbnail() ) {
				$output .= '<h4 class="item-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a></h4>';
			}
		}
	}
	// if ( $my_query->have_posts() ) {
	// 	$output .= '<div class="kmt-related-posts">';

	// 	while ( $my_query->have_posts() ) {
	// 		$my_query->the_post();
	// 		if ( has_post_thumbnail() ) {
	// 			$output .= '<h4 class="item-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a></h4>';
	// 		}
	// 	}
	// 	$output .= '</div>';
	// }

	echo $output;
}
$post = $orig_post;
wp_reset_postdata();
