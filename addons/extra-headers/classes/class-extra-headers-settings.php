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
			//add_action( 'customize_controls_print_scripts', array( $this, 'headers_controls_scripts' ) );
        } 
        
		/**
		 * Customizer Controls
		 *
		 * @return void
		 */
		// function headers_controls_scripts() {

		// 	$js_prefix  = '.min.js';
		// 	$css_prefix = '.min.css';
		// 	$dir        = 'minified';
		// 	if ( SCRIPT_DEBUG ) {
		// 		$js_prefix  = '.js';
		// 		$dir        = 'unminified';
		// 	}

		// 	// Customizer Core.
		// 	wp_enqueue_script( 'kemet-customizer-controls-toggle-js', KEMET_EXTRA_HEADERS_URL . 'assets/js/' . $dir . '/extra-headers-controls-toggle' . $js_prefix, array(), KEMET_ADDONS_VERSION, true );

		// }
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

			if ( apply_filters( 'kemet_primary_header_enabled', true ) ) {
				if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout && 'header-main-layout-4' !== $kemet_header_layout  ) {
					add_action( 'kemet_header', array( $this,'html_markup_loader'));	
					remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
					kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
					
				} else if ( 1 !== ( $options['extra-headers'] ) ) {
					add_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
					}  
			}        
		}

        function kemet_body_classes($classes) {
            $kemet_header_layout = kemet_get_option( 'header-layouts' );
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true);

            if('header-main-layout-6' == $kemet_header_layout) {
                
                $classes[] = 'header-main-layout-6';
                $classes[] = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position') ;
			} 
			if('header-main-layout-8' == $kemet_header_layout) {
                
                $classes[] = 'header-main-layout-8';
                $classes[] = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if ( is_singular() ) {
				if(isset($meta['kemet-main-header-display']) && $meta['kemet-main-header-display'] == '1'){
					$header_align_class = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position');
					if(in_array($header_align_class , $classes)){
						$align_header = array_search($header_align_class, $classes);
						unset($classes[$align_header]);
					}
				}
			}
            return $classes;
		}
		
        function header_classes( $classes ) {
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true);
			$kemet_header_layout = kemet_get_option( 'header-layouts' );
			$vheader_has_box_shadow   = kemet_get_option('vheader-box-shadow');
			if('header-main-layout-8' == $kemet_header_layout || 'header-main-layout-6' == $kemet_header_layout){
				if(in_array('kmt-header-transparent' , $classes)){
					$overlay_enabled = array_search('kmt-header-transparent', $classes);
					unset($classes[$overlay_enabled]);
				}
			}
			if('header-main-layout-8' == $kemet_header_layout) {
				if ($vheader_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				$classes[] = 'v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if( 'header-main-layout-6' == $kemet_header_layout ) {

				if ($vheader_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				
				$classes[] = 'v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if ( is_singular() ) {
				if(isset($meta['kemet-main-header-display']) && $meta['kemet-main-header-display'] == '1'){
					$header_align_class = 'v-header-align-'. kemet_get_option('v-headers-position');
					if(in_array($header_align_class , $classes)){
						$align_header = array_search($header_align_class, $classes);
						unset($classes[$align_header]);
					}
				}	
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