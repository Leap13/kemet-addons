<?php

/**
 * Extra Headers - Defaults &Customizer.
 *
 * @package Kemet Addons
 * @since 1.0.0
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
            
          //  add_action( 'customize_register', array( $this, 'customize_register' ) );
            
			
           // add_filter( 'kemet_theme_defaults', array( $this, 'addons_defaults' ) );
            
			//add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			
			//add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			//add_action( 'customize_register', array( $this, 'headers_customize_register' ), 2 );

            remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template');
			add_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader' ));
			add_filter( 'body_class', array( $this,'kemet_body_classes' ));
			add_filter( 'kemet_sitehead' , array( $this, 'kemet_top_header_template' ), 9 );
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );

       
        }
        

         
       function sitehead_markup_loader() {
            
            $kemet_header_layout = kemet_get_option( 'header-layouts' );
                    $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true); 
         
        $display_header = ( isset( $meta['kemet-main-header-display'] ) && $meta['kemet-main-header-display'] ) ? $meta['kemet-main-header-display'] : 'default';

			

           
            if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout && 'header-main-layout-4' !== $kemet_header_layout  || '1' !== $display_header)  {

                kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
                } else {
                    
                get_template_part( 'templates/header/header-main-layout' );
            }          
		}
        
        
        public function kemet_top_header_template() {
            
            $enable_top_header = kemet_get_option('enable-top-header');
            
            if ($enable_top_header)  {
                kemetaddons_get_template( 'extra-headers/templates/topbar/topbar-layout.php' );
            }
            
        }
        

	/**
	 * Function to get top section Left/Right Header
	 *
	 * @param string $section   Sections of Small Footer.
	 * @return mixed            Markup of sections.
	 */
	public static function kemet_get_top_section( $option ) {

		 $output  = '';
		 $section = kemet_get_option( $option );   
		  if ( is_array( $section ) ) {
			
			foreach ( $section as $sectionnn ) {

				switch ( $sectionnn ) {

			case 'search':
					$output .= kemet_get_search();
				break;

            case 'menu':
					$output .= kemet_get_top_menu();
				break;

			case 'widget':
					$output .= kemet_get_custom_widget($option);
			break;

			case 'text-html':
					$output .= kemet_get_custom_html( $option . '-html' );
			break;
			}
		}
			return $output;			
	}
	}

        function kemet_body_classes($classes) {
            if(kemet_get_option ('header-layouts') == 'header-main-layout-6') {
                
                $classes[] = 'header-main-layout-6';
                $classes[] = 'kemet-addons-header6-'. kemet_get_option('header6-position') ;
            } 
            if(kemet_get_option ('header-layouts') == 'header-main-layout-7') {
                $classes[] = 'header-main-layout-7';
                $classes[] = 'kemet-addons-header7-'. kemet_get_option('header6-position') ;
            }
            return $classes;
        }
        // public function kemet_extra_headers_classes()
        // {
        //         $classes                  = array( 'site-header' );
        //         $menu_logo_location       = kemet_get_option('header-layouts');
        //         $mobile_header_alignment  = kemet_get_option('header-main-menu-align');
        //         $primary_menu_disable     = kemet_get_option('disable-primary-nav');
        //         $primary_menu_custom_item = kemet_get_option('header-main-rt-section');
        //         $logo_title_inline        = kemet_get_option('logo-title-inline');
        //         $header_transparent       = kemet_get_option('enable-transparent');
        //         $enabled_sticky           = kemet_get_option('enable-sticky');
        //         $sticky_logo              = kemet_get_option('sticky-logo');
        //         $sticky_responsive        = kemet_get_option('sticky-responsive');
        //         $header6_has_box_shadow   = kemet_get_option('header6-box-shadow');
    
        //         if ($menu_logo_location) {
        //             $classes[] = $menu_logo_location;
        //         }
    
        //         if ($primary_menu_disable) {
        //             $classes[] = 'kmt-primary-menu-disabled';
    
        //             if ('none' == $primary_menu_custom_item) {
        //                 $classes[] = 'kmt-no-menu-items';
        //             }
        //         }
        //         // Add class if Inline Logo & Site Title.
        //         if ($logo_title_inline) {
        //             $classes[] = 'kmt-logo-title-inline';
        //         }
            
        //         if ($header_transparent &&  $menu_logo_location  != 'header-main-layout-5') {
        //             $classes[] = 'kmt-header-transparent';
        //         }
    
        //         if ($enabled_sticky &&  $menu_logo_location  != 'header-main-layout-6' &&  $menu_logo_location  != 'header-main-layout-7') {
        //             $classes[] = 'kmt-sticky-header';
        //         }

    
        //         if ('' !== $sticky_logo) {
        //             $classes[] = 'kmt-sticky-logo';
        //         }
        //         if ($header6_has_box_shadow == true) {
        //             $classes[] = "header6-has-box-shadow" ;
        //         }
        //         $classes[] =  $sticky_responsive;
    
        //         $classes[] = 'kmt-mobile-header-' . $mobile_header_alignment;
    
        //         $classes = array_unique(apply_filters('kemet_header_class', $classes));
    
        //         $classes = array_map('sanitize_html_class', $classes);
    
               
        //         echo 'class="' . esc_attr(join(' ', $classes)) . '"';
        // }

        

		// /**
		//  * Get theme options from static array()
		//  *
		//  * @return array    Return array of theme options.
		//  */
		// public static function get_options() {
		// 	return self::$db_options;
		// }
		/**
		 * Update theme static option array.
		 */
		// public static function refresh() {
		// 	self::$db_options = wp_parse_args(
		// 		get_option( KEMET_THEME_SETTINGS ),
		// 		self::defaults()
		// 	);
		// }
        
        
        
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {
			$uri = KEMET_EXTRA_HEADERS_URL . 'assets/css';
			$path = KEMET_EXTRA_HEADERS_DIR . 'assets/css';
			$rtl = '';
			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'KEMET_THEME_HTTP2' ) && KEMET_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			//Kemet_Minify::add_css( $gen_path . 'extra-header-layouts.min.css' );

			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/extra-header-layouts.min.css');
			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.min.css');
			//Kemet_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
			//Kemet_Minify::add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/unminified/style.css');
           // Kemet_Minify::add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.css');
		}

		public function add_scripts() {
			 Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/extra-header-layouts.min.js');
			 Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/simple-scrollbar.min.js');
			//wp_enqueue_script( 'script', KEMET_EXTRA_HEADERS_URL.'assets/js/minified/extra-header-layouts.min.js',array ( 'jquery' ), KEMET_ADDONS_VERSION, true);

		}
        
        // public static function refresh() {
		// 	self::$db_options = wp_parse_args(
		// 		get_option( KEMET_THEME_SETTINGS ),
		// 		self::defaults()
		// 	);
		// }
    }
}
Kemet_Extra_Headers_Partials::get_instance();