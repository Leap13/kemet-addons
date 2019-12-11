<?php
/**
 * Single Post - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_single_post_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_single_post_dynamic_css( $dynamic_css ) {
            global $post;
            $header_featured_image = '';
            
            $padding_inside_container = kemet_get_option('padding-inside-container');
            
            if(kemet_get_option('featured-image-header') == true){
                if(has_post_thumbnail( $post->ID )){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                    $header_featured_image = array(
                        'background-image'      => $image[0],
                        'background-repeat'     => 'no-repeat',
                        'background-position'   => 'center center',
                        'background-size'       => 'cover',
                        'background-attachment' => 'scroll',
                    );
                }
            }
            
            $css_content = array(
                    '.kmt-page-title-addon-content, .kemet-merged-header-title' => kemet_get_background_obj( $header_featured_image ),  
                    '.single-post.kmt-separate-container .kmt-article-single, .single-post .comments-area .comment-respond , .single-post .kmt-author-box' => array(
                    'padding-top'    => kemet_responsive_spacing( $padding_inside_container, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $padding_inside_container, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $padding_inside_container, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $padding_inside_container, 'left', 'desktop' ),              
                ),

            );

            $parse_css = kemet_parse_css( $css_content );
            
            return $dynamic_css . $parse_css;
}