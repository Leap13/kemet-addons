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
            add_action( 'wp_enqueue_scripts', array( $this, 'add_carousel_scripts'), 1 );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
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

            if(!is_single()){
                return;
            }
            $term_tax = kemet_get_option('related-posts-taxonomy') ? kemet_get_option('related-posts-taxonomy') :'category';
            $posts_number = kemet_get_option('related-posts-number');
            $post_terms     = wp_get_post_terms( get_the_ID(), 'post_tag' );
            $post_terms_ids = array();
            foreach( $post_terms as $post_term ) {
                $post_terms_ids[] = $post_term->term_id;
            }
            $grid_classes = kemet_get_option('related-posts-row-num');
            // Query
            $args = array(
                'posts_per_page' => 16,
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
                echo '<div class="kmt-related-posts owl-carousel owl-theme">';
                foreach( $related_posts_query->posts as $post ) : setup_postdata( $post );
                    $related_posts_query->the_post(); ?>
                        <div class="post"><?php the_title(); ?></div>
                    
            <?php endforeach;
            }
            echo '</div>';
        }

        // Owl Carousel.
        function add_carousel_scripts() {

			wp_enqueue_style( 'owl-carousel-css', KEMET_SINGLE_POST_URL . 'assets/css/unminified/owl.carousel.css' , null, KEMET_ADDONS_VERSION );
			wp_enqueue_script( 'owl-carousel-js', KEMET_SINGLE_POST_URL . 'assets/js/unminified/owl.carousel.js', array(), KEMET_ADDONS_VERSION, true );

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
        public function add_scripts() {

			$js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}

			Kemet_Style_Generator::kmt_add_js(KEMET_SINGLE_POST_DIR.'assets/js/'. $dir .'/single-post' . $js_prefix);

		}
    }
}
Kemet_Single_Post_Partials::get_instance();
