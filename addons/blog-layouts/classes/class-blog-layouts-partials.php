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
            add_action( 'wp_enqueue_scripts', array( $this, 'add_prettyPhoto_scripts'), 1 );
        }
        function kemet_blog_post_container($classes){
            $classes[] = kemet_get_option( 'blog-layouts' );
            $blog_layout = kemet_get_option('blog-layouts');

            if($blog_layout == 'blog-layout-2'){
                $classes [] = !empty(kemet_get_option( 'blog-layout-mode' )) ? kemet_get_option( 'blog-layout-mode' ) : 'fitRows';
            }
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
            $classes[] = kemet_get_option( 'overlay-image-style' ) != 'none' ? kemet_get_option( 'overlay-image-style' ) : '';

            return $classes;
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_BLOG_LAYOUTS_DIR.'assets/css/minified/blog-layouts.min.css');

        }
        function add_prettyPhoto_scripts() {
            // prettyPhoto.
			wp_enqueue_style( 'prettyPhoto-css', KEMET_THEME_URI . 'assets/prettyphoto/css/prettyPhoto.css' , null, KEMET_THEME_VERSION );
			wp_enqueue_script( 'prettyPhoto-js', KEMET_THEME_URI . 'assets/prettyphoto/js/jquery.prettyPhoto.js', array(), KEMET_THEME_VERSION, true );

        }
        public function add_scripts() {
            Kemet_Style_Generator::kmt_add_js(KEMET_BLOG_LAYOUTS_DIR.'assets/js/minified/kemet-grid.min.js');
            Kemet_Style_Generator::kmt_add_js(KEMET_BLOG_LAYOUTS_DIR.'assets/js/minified/blog-layouts.min.js');
       }
    }
}
Kemet_Blog_Layouts_Partials::get_instance();
