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
            add_action( 'post_class', array( $this, 'kemet_post_class_blog_grid' ) );
            add_filter( 'excerpt_length', array( $this, 'kemet_custom_excerpt_length' ));
            add_filter( 'kemet_blog_post_container', array( $this, 'kemet_blog_post_container' ));
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) , 1);
        }
        function kemet_blog_post_container($classes){
            $classes[] = kemet_get_option( 'blog-layouts' );
            $blog_layout = kemet_get_option('blog-layouts');

            if($blog_layout == 'blog-layout-2'){
                $classes [] = !empty(kemet_get_option( 'blog-layout-mode' )) ? kemet_get_option( 'blog-layout-mode' ) : 'fitRows';
            }
            $classes[] = kemet_get_option( 'overlay-image-style' ) != 'none' ? kemet_get_option( 'overlay-image-style' ) : '';
            $classes[]  = kemet_get_option( 'hover-image-effect' )!= 'none' ? kemet_get_option( 'hover-image-effect' ) : '';
            $classes[]  = kemet_get_option('post-image-position') == 'left' ? 'kmt-img-left' : 'kmt-img-right';
            return $classes;
        }
        function kemet_custom_excerpt_length(){
            $excerpt_length = !empty(kemet_get_option('blog-excerpt-length')) ? kemet_get_option('blog-excerpt-length') : 50;

            return $excerpt_length;
        }
        function kemet_post_class_blog_grid( $classes ) {
            $blog_layout = kemet_get_option('blog-layouts');
            $blog_grids = kemet_get_option('blog-grids');
            
            if($blog_layout == 'blog-layout-2'){
                if ( is_archive() || is_home() || is_search() ) {
                    if(in_array('kmt-col-sm-12' , $classes)){
                        $overlay_enabled = array_search('kmt-col-sm-12', $classes);
                        unset($classes[$overlay_enabled]);
                    }
                    $desktop_columns = !empty($blog_grids['desktop']) ? ' kmt-col-md-' . strval(12 / $blog_grids['desktop']) : '';
                    $tablet_columns = !empty($blog_grids['tablet']) ? ' kmt-col-sm-' . strval(12 / $blog_grids['tablet']) : ' kmt-col-sm-12';
                    $mobile_columns = !empty($blog_grids['mobile']) ? ' kmt-col-xs-' . strval(12 / $blog_grids['mobile']) : ' kmt-col-xs-12';
                    $classes[] = $desktop_columns . $tablet_columns . $mobile_columns;
                }
            }

            return $classes;
        }

        /**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {
            wp_enqueue_script( 'kemet-isotope', KEMET_BLOG_LAYOUTS_URL . 'assets/js/unminified/isotope.pkgd.js', array( 'jquery' ), KEMET_ADDONS_VERSION, true );
        }
        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR.'assets/css/minified/blog-layouts.min.css');

        }
        public function add_scripts() {
            Kemet_Style_Generator::kmt_add_js(KEMET_BLOG_LAYOUTS_DIR.'assets/js/minified/blog-layouts.min.js');
       }
    }
}
Kemet_Blog_Layouts_Partials::get_instance();
