<?php
/**
 * Extra Headers
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Extra_Headers_Partials' )) {
    /**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
    class Kemet_Extra_Headers_Partials {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        /**
		 *  Constructor
		 */
		public function __construct() {
            
			add_filter( 'body_class', array( $this,'kemet_body_classes' ));
			add_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader'), 1);
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_filter( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
        }
        

        function html_markup_loader() {

            ?>
    
            <header itemtype="https://schema.org/WPHeader" itemscope="itemscope" id="sitehead" <?php kemet_header_classes();?> role="banner">
    
                <?php kemet_sitehead_top(); ?>
    
                <?php kemet_sitehead(); ?>
    
                <?php kemet_sitehead_bottom(); ?>
    
            </header><!-- #sitehead -->
            <?php
		}
		
       function sitehead_markup_loader() {
            
			$kemet_header_layout = kemet_get_option( 'header-layouts' );
			$options = get_option( 'kmt_framework' );
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true); 
			$display_header = ( isset( $meta['kemet-main-header-display'] ) && $meta['kemet-main-header-display'] ) ? $meta['kemet-main-header-display'] : 'default';

			if ( '1' == $display_header ) {

				remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
				remove_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader' ));
				
			} else if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout && 'header-main-layout-4' !== $kemet_header_layout  ) {
				add_action( 'kemet_header', array( $this,'html_markup_loader'));	
				remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
				kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
				
			} else if ( 1 !== ( $options['extra-headers'] ) ) {
				
				 add_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
           	 }          
		}

        function kemet_body_classes($classes) {
            $options = get_option( 'kmt_framework' );
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true); 
			$display_header = ( isset( $meta['kemet-main-header-display'] ) && $meta['kemet-main-header-display'] ) ? $meta['kemet-main-header-display'] : 'default';

            if((kemet_get_option ('header-layouts') == 'header-main-layout-6') && ( '1' !== $display_header )) {
                
                $classes[] = 'header-main-layout-6';
                $classes[] = 'kemet-main-header6-align-'. kemet_get_option('header6-position') ;
			} 
			if((kemet_get_option ('header-layouts') == 'header-main-layout-8') && ( '1' !== $display_header )) {
                
                $classes[] = 'header-main-layout-8';
                $classes[] = 'kemet-main-header8-align-'. kemet_get_option('header8-position') ;
            }
            return $classes;
		}
		
        function header_classes( $classes ) {
			if((kemet_get_option ('header-layouts') == 'header-main-layout-8') && ( '1' !== $display_header )) {
				$header8_has_box_shadow   = kemet_get_option('header8-box-shadow');

				if ($header8_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				$classes[] = 'header8-align-'. kemet_get_option('header8-position') ;
			}
			if((kemet_get_option ('header-layouts') == 'header-main-layout-6') && ( '1' !== $display_header )) {
				$header6_has_box_shadow   = kemet_get_option('header6-box-shadow');
				if ($header6_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				$classes[] = 'header6-align-'. kemet_get_option('header6-position') ;
			}
			return $classes;
         }
        
        
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {

			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/extra-header-layouts.min.css');
			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.min.css');
		}

		public function add_scripts() {
			 Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/extra-header-layouts.min.js');
			 Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/simple-scrollbar.min.js');

		}
    }
}
Kemet_Extra_Headers_Partials::get_instance();