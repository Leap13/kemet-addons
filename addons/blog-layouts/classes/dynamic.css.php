<?php
/**
 * Extra Blogs - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_blog_layouts_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_blog_layouts_dynamic_css( $dynamic_css ) {
            $posts_border_color         = kemet_get_option( 'blog-posts-border-color' );
            $posts_border_size         = kemet_get_option( 'blog-posts-border-size' );
            $title_meta_border_color         = kemet_get_option( 'blog-title-meta-border-color' );
            $title_meta_border_size         = kemet_get_option( 'blog-title-meta-border-size' );
            $post_image_height         = kemet_get_option( 'post-image-height' );
            $css_content = array( 
                '.blog-layout-2 .blog-post-layout-2 , .blog-layout-4 .blog-post-layout-4 .post-content' => array(
                    'border-width' => kemet_get_css_value( $posts_border_size , 'px' ),
                    'border-color' => esc_attr($posts_border_color),
                ), 
                '.blog-layout-4 .blog-post-layout-4 .entry-content' => array(
                    'border-color' => esc_attr($title_meta_border_color),
                    'border-width' => kemet_get_css_value( $title_meta_border_size , 'px' ),
                ), 
                // '.blog-layout-5 .blog-post-layout-5 .entry-header .post-thumb' => array(
                //     'height' => kemet_responsive_slider( $post_image_height, 'desktop' ),
                // ), 
            );

            $parse_css = kemet_parse_css( $css_content );
            
            $css_tablet = array(
                // '.blog-layout-5 .blog-post-layout-5 .entry-header .post-thumb' => array(
                //     'height' => kemet_responsive_slider( $post_image_height, 'tablet' ),
                // ),
             );
           $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            $css_mobile = array(
                // '.blog-layout-5 .blog-post-layout-5 .entry-header .post-thumb' => array(
                //     'height' => kemet_responsive_slider( $post_image_height, 'mobile' ),
                // ),
             );
           $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}