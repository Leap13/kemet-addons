<?php
/**
 * Blog Layouts
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Blog_Layouts_Partials')) {

    class Kemet_Blog_Layouts_Partials {
        private static $instance;
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action('kemet_blog_post_content', array( $this, 'kemet_addons_get_blog_post_content'),1);
            add_action('kemet_blog_post_thumbnail', array( $this,'kemet_addons_get_blog_post_thumbnail'),1);
            add_action('kemet_blog_post_title_meta', array( $this, 'kemet_addons_get_blog_post_title_meta'),1);
            add_filter( 'post_class', array( $this, 'kemet_post_class_blog_grid') );
            add_filter( 'body_class', array( $this, 'kemet_blog_body_classes') );
            add_filter( 'excerpt_length', array( $this, 'kemet_custom_excerpt_length') );
        }
        
        function kemet_custom_excerpt_length( $length ) {
            return 15;
        }
        
       /**
         * Adds custom classes to the array of body classes.
         */
        function kemet_blog_body_classes( $classes ) {

            $blog_layout = kemet_get_option('blog-layouts');
            $classes[] = $blog_layout;

            return $classes;
        }
        
        /**
         * Adds custom classes to the array of post grid classes.
         *
         * @since 1.0
         * @param array $classes Classes for the post element.
         * @return array
         */
        function kemet_post_class_blog_grid( $classes ) {
            $blog_layout = kemet_get_option('blog-layouts');

            if($blog_layout == 'blog-layout-2'){
                $classes[] = 'kmt-col-lg-4';
            }

            if ( is_archive() || is_home() || is_search() ) {
                $classes[] = 'kmt-col-sm-12';
                $classes[] = 'kmt-article-post';
            }

            return $classes;
        }

        /**
         * Blog Post Content
         */
        function kemet_addons_get_blog_post_content() { 
            
            ?>
            
            <div class="entry-content clear" itemprop="text">

                <?php kemet_entry_content_before(); ?>

                <?php kemet_the_excerpt(); ?>

                <?php kemet_entry_content_after(); ?>

                <?php
                    wp_link_pages(
                        array(
                            'before'      => '<div class="page-links">' . esc_html( kemet_theme_strings( 'string-blog-page-links-before', false ) ),
                            'after'       => '</div>',
                            'link_before' => '<span class="page-link">',
                            'link_after'  => '</span>',
                        )
                    );
                ?>
            </div><!-- .entry-content .clear -->
        <?php 
        remove_action('kemet_blog_post_content','kemet_get_blog_post_content');
        }

        /**
         * Blog Post Thumbnail
         */
        function kemet_addons_get_blog_post_thumbnail() {
            $blog_layout = kemet_get_option('blog-layouts');

            if($blog_layout == 'blog-layout-2'){
                kemet_get_post_thumbnail( '<div class="kmt-blog-featured-section post-thumb">', '</div>' );
            }else{
                kemet_get_post_thumbnail( '<div class="kmt-blog-featured-section post-thumb kmt-col-md-12">', '</div>' );
            }

            remove_action('kemet_blog_post_thumbnail','kemet_get_blog_post_thumbnail');
        }
                    
        /**
         * Blog Post Title & Meta Order
         */
        function kemet_addons_get_blog_post_title_meta() {

            // Blog Post Title and Blog Post Meta.
            do_action( 'kemet_archive_entry_header_before' );
            ?>
            <header class="entry-header">
                <?php

                    do_action( 'kemet_archive_post_title_before' );
                    
                    /* translators: 1: Current post link, 2: Current post id */
                    kemet_the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>', get_the_id() );

                    do_action( 'kemet_archive_post_title_after' );

                ?>
                <?php

                    do_action( 'kemet_archive_post_meta_before' );

                    kemet_blog_get_post_meta();

                    do_action( 'kemet_archive_post_meta_after' );

                ?>
            </header><!-- .entry-header -->
            <?php

            do_action( 'kemet_archive_entry_header_after' );
            remove_action('kemet_blog_post_title_meta','kemet_get_blog_post_title_meta');
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR.'assets/css/minified/blog-layouts.min.css');

	    }
    }
}
Kemet_Blog_Layouts_Partials::get_instance();
