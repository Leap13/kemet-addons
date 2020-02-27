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
            $theme_color      = kemet_get_option( 'theme-color' );
            $global_border_color      = kemet_get_option( 'global-border-color' );
            $global_bg_color      = kemet_get_option( 'global-background-color' );
            $text_meta_color      = kemet_get_option( 'text-meta-color' );
            $posts_border_color         = kemet_get_option( 'blog-posts-border-color' , $global_border_color);
            $posts_border_size         = kemet_get_option( 'blog-posts-border-size' );
            $title_meta_border_color         = kemet_get_option( 'blog-title-meta-border-color' , $global_border_color);
            $title_meta_border_size         = kemet_get_option( 'blog-title-meta-border-size' );
            $post_image_height         = kemet_get_option( 'post-image-height' );
            $overlay_bg_color     = kemet_get_option( 'overlay-image-bg-color' , $theme_color );
			$overlay_icon_color    = kemet_get_option( 'overlay-icon-color' );
            $post_inner_spacing = kemet_get_option( 'blog-container-inner-spacing' );
            $css_content = array( 
                '.blog-layout-2 .blog-post-layout-2 , .blog-layout-4 .blog-post-layout-4 .post-content' => array(
                    'border-width' => kemet_get_css_value( $posts_border_size , 'px' ),
                    'border-color' => esc_attr($posts_border_color),
                    'border-style' => 'solid',
                ),
                '.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
                    'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'desktop' ),
                    'padding-right' => kemet_responsive_spacing( $post_inner_spacing, 'right', 'desktop' ),
                    'padding-left'  => kemet_responsive_spacing( $post_inner_spacing, 'left', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'desktop' ),
                ), 
                '.blog-layout-4 .blog-post-layout-4 .entry-content , .blog-layout-3 .kmt-article-post .post-content , .blog-layout-3 .kmt-article-post .entry-content' => array(
                    'border-color' => esc_attr($title_meta_border_color),
                    'border-width' => kemet_get_css_value( $title_meta_border_size , 'px' ),
                    'border-style' => 'solid',
                ), 
                '.squares .overlay-image .overlay-color .section-1:before ,.squares .overlay-image .overlay-color .section-1:after ,.squares .overlay-image .overlay-color .section-2:before ,.squares .overlay-image .overlay-color .section-2:after , .bordered .overlay-color ,.framed .overlay-color' =>  array(
					'background-color'  => esc_attr ( $overlay_bg_color ),
				),
				'.overlay-image .post-details a:before , .overlay-image .post-details a:after' =>  array(
					'background-color'  => esc_attr ( $overlay_icon_color ),
                ),
                '.blog-layout-3 .kmt-article-post.has-post-thumbnail .post-content' =>  array(
					'background-color'  => esc_attr ( $global_bg_color ),
                ),
                '.blog-layout-4 .blog-post-layout-4 .entry-header .kmt-default-featured-section' =>  array(
					'background-color'  => esc_attr ( kemet_color_brightness($global_bg_color , 0.94 , 'dark') ),
                ),
                '.blog-layout-4 .blog-post-layout-4 .entry-header .kmt-default-featured-section:before' =>  array(
                    'background-color'  => esc_attr ( $global_bg_color ),
                    'color'  => esc_attr ( kemet_color_brightness($global_bg_color , 0.94 , 'dark') ),
                ),
                '.bordered .overlay-color .color-section-1 .color-section-2:after, .bordered .overlay-color .color-section-1 .color-section-2:before' => array(
                    'border-color' => esc_attr(kemet_color_brightness($global_border_color , 0.3 , 'dark')),
                ),
            );

            $parse_css = kemet_parse_css( $css_content );
            
            $css_tablet = array(
                '.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
                    'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'tablet' ),
                    'padding-right' => kemet_responsive_spacing( $post_inner_spacing, 'right', 'tablet' ),
                    'padding-left'  => kemet_responsive_spacing( $post_inner_spacing, 'left', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'tablet' ),
                ), 
             );
           $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            $css_mobile = array(
                '.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div' => array(
                    'padding-top'    => kemet_responsive_spacing( $post_inner_spacing, 'top', 'mobile' ),
                    'padding-right' => kemet_responsive_spacing( $post_inner_spacing, 'right', 'mobile' ),
                    'padding-left'  => kemet_responsive_spacing( $post_inner_spacing, 'left', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $post_inner_spacing, 'bottom', 'mobile' ),
                ), 
             );
           $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}