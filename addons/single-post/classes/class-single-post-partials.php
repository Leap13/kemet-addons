<?php
/**
 * Single Post Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Single_Post_Partials')) {

    /**
     * Single Post Section
     *
     * @since 1.0.0
     */
    class Kemet_Single_Post_Partials
    {

        private static $instance;

        /**
         * Initiator
         */
        
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
            add_filter( 'body_class', array( $this,'kemet_body_classes' ));
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_entry_content_single', array( $this, 'kemet_single_post_template_loader') , 1);
            add_action( 'kemet_entry_after', array( $this, 'kemet_related_posts') , 10);
            add_filter( 'kemet_the_title_enabled', array( $this, 'enable_page_title_in_content' ) );
        }
        public function kemet_single_post_template_loader() {
            remove_action( 'kemet_entry_content_single', 'kemet_entry_content_single_template' );
            kemetaddons_get_template( 'single-post/templates/single-post-layout.php' );  
        }
        function kemet_body_classes($classes) {
            
            $prev_next_links = kemet_get_option('prev-next-links');

			if($prev_next_links == true){
				$classes[] = 'hide-nav-links';
			}
            return $classes;
        }
        
        function enable_page_title_in_content($default){
            if(is_single()){
                $default = kemet_get_option('enable-page-title-content-area');
            } 
            return $default;      
        }
        /**
		  * Related Posts
		 */
        function kemet_related_posts(){
            $term_tax = kemet_get_option('related-posts-taxonomy') ? kemet_get_option('related-posts-taxonomy') :'category';
            $posts_number = kemet_get_option('related-posts-number');
            $post_terms     = wp_get_post_terms( get_the_ID(), 'post_tag' );
            $post_terms_ids = array();
            foreach( $post_terms as $post_term ) {
                $post_terms_ids[] = $post_term->term_id;
            }
            //var_dump($post_terms_ids);
            // Query
            $args = array(
                'posts_per_page' => $posts_number,
                'orderby'        => 'rand',
                'post__not_in'   => array( get_the_ID() ),
                'no_found_rows'  => true,
                'tax_query'      => array (
                    'relation'  => 'AND',
                    array (
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-quote', 'post-format-link' ),
                        'operator' => 'NOT IN',
                    ),
                ),
            );
            switch($term_tax){
                case 'tag':
                    $args['tag__in'] = $post_terms_ids;
                    break;
                case 'category':
                    $args['category__in'] = $post_terms_ids;
                    break;    
            }

            $related_posts_query = new WP_Query( $args );
            
            if($related_posts_query->have_posts()){
                foreach( $related_posts_query->posts as $post ) : setup_postdata( $post );
                    the_title();
                endforeach;
            }
        }
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {
            $css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
            Kemet_Style_Generator::kmt_add_css(KEMET_SINGLE_POST_DIR.'assets/css/'. $dir .'/style' . $css_prefix);
		}

    }
}
Kemet_Single_Post_Partials::get_instance();
