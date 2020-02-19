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
            $overlay_bg_color     = kemet_get_option( 'overlay-image-bg-color' );
			$overlay_icon_color    = kemet_get_option( 'overlay-icon-color' );
			$overlay_icon_hover_color  = kemet_get_option( 'overlay-icon-h-color' );
			$overlay_icon_bg_color = kemet_get_option( 'overlay-icon-bg-color' );
            $overlay_icon_bg_hover_color = kemet_get_option( 'overlay-icon-bg-h-color' );
            
            $css_content = array( 
                '.blog-layout-2 .blog-post-layout-2 , .blog-layout-4 .blog-post-layout-4 .post-content' => array(
                    'border-width' => kemet_get_css_value( $posts_border_size , 'px' ),
                    'border-color' => esc_attr($posts_border_color),
                    'border-style' => 'solid',
                ), 
                '.blog-layout-4 .blog-post-layout-4 .entry-content' => array(
                    'border-color' => esc_attr($title_meta_border_color),
                    'border-width' => kemet_get_css_value( $title_meta_border_size , 'px' ),
                    'border-style' => 'solid',
                ), 
                '.squares .overlay-image .overlay-color .section-1:before ,.squares .overlay-image .overlay-color .section-1:after ,.squares .overlay-image .overlay-color .section-2:before ,.squares .overlay-image .overlay-color .section-2:after , .bordered .overlay-color ,.framed .overlay-color' =>  array(
					'background-color'  => esc_attr ( $overlay_bg_color ),
				),
				'.overlay-image .post-details a' =>  array(
					'color'  => esc_attr ( $overlay_icon_color ),
					'background-color'  => esc_attr ( $overlay_icon_bg_color ),
				),
				'.overlay-image .post-details a:hover' =>  array(
					'color'  => esc_attr ( $overlay_icon_hover_color ),
					'background-color'  => esc_attr ( $overlay_icon_bg_hover_color ),
				),
            );

            $parse_css = kemet_parse_css( $css_content );
            
        //     $css_tablet = array(

        //      );
        //    $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
        //     $css_mobile = array(
               
        //      );
        //    $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}