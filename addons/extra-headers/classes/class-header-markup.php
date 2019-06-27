<?php
/**
 * Header Pro Markup
 *
 * @package Kemet Addon
 */
// if (! class_exists('Kemet_Header_Markup')) {

//     /**
//      * Header Pro Markup Initial Setup
//      *
//      * @since 1.0.0
//      */
//     class Kemet_Header_Markup
//     {

//         /**
//          * Member Variable
//          *
//          * @var object instance
//          */
//         private static $instance;

//         /**
//          * Initiator
//          */
        
//         public static function get_instance()
//         {
//             if (! isset(self::$instance)) {
//                 self::$instance = new self();
//             }
//             return self::$instance;
//         }
//         /**
// 		 *  Constructor
// 		 */
// 		public function __construct() {
//             add_filter( 'body_class', array( $this,'kemet_body_classes' ));
//             remove_action( 'kemet_header', 'kemet_header_markup' );
//             add_action( 'kemet_header', array( $this,'html_markup_loader'));
//             add_action('kemet_pro_header_classes', array( $this,'kemet_header_pro_classes') );
//             // add_action( 'after_setup_theme', array( $this, 'refresh' ) );
//         }
        
//         function html_markup_loader() {

//             
    

//         }

//         function kemet_body_classes($classes) {
//             if(kemet_get_option ('header-layouts') == 'header-main-layout-6') {
                
//                 $classes[] = 'header-main-layout-6';
//                 $classes[] = 'kemet-addons-header6-'. kemet_get_option('header6-position') ;
//             } 
//             if(kemet_get_option ('header-layouts') == 'header-main-layout-7') {
//                 $classes[] = 'header-main-layout-7';
//                 $classes[] = 'kemet-addons-header7-'. kemet_get_option('header6-position') ;
//             }
//             return $classes;
//         }
//         public function kemet_header_pro_classes()
//         {
//                 $classes                  = array( 'site-header' );
//                 $menu_logo_location       = kemet_get_option('header-layouts');
//                 $mobile_header_alignment  = kemet_get_option('header-main-menu-align');
//                 $primary_menu_disable     = kemet_get_option('disable-primary-nav');
//                 $primary_menu_custom_item = kemet_get_option('header-main-rt-section');
//                 $logo_title_inline        = kemet_get_option('logo-title-inline');
//                 $header_transparent       = kemet_get_option('enable-transparent');
//                 $enabled_sticky           = kemet_get_option('enable-sticky');
//                 $sticky_logo              = kemet_get_option('sticky-logo');
//                 $sticky_responsive        = kemet_get_option('sticky-responsive');
//                 $header6_has_box_shadow   = kemet_get_option('header6-box-shadow');
    
//                 if ($menu_logo_location) {
//                     $classes[] = $menu_logo_location;
//                 }
    
//                 if ($primary_menu_disable) {
//                     $classes[] = 'kmt-primary-menu-disabled';
    
//                     if ('none' == $primary_menu_custom_item) {
//                         $classes[] = 'kmt-no-menu-items';
//                     }
//                 }
//                 // Add class if Inline Logo & Site Title.
//                 if ($logo_title_inline) {
//                     $classes[] = 'kmt-logo-title-inline';
//                 }
            
//                 if ($header_transparent &&  $menu_logo_location  != 'header-main-layout-5') {
//                     $classes[] = 'kmt-header-transparent';
//                 }
    
//                 if ($enabled_sticky &&  $menu_logo_location  != 'header-main-layout-6' &&  $menu_logo_location  != 'header-main-layout-7') {
//                     $classes[] = 'kmt-sticky-header';
//                 }

    
//                 if ('' !== $sticky_logo) {
//                     $classes[] = 'kmt-sticky-logo';
//                 }
//                 if ($header6_has_box_shadow == true) {
//                     $classes[] = "header6-has-box-shadow" ;
//                 }
//                 $classes[] =  $sticky_responsive;
    
//                 $classes[] = 'kmt-mobile-header-' . $mobile_header_alignment;
    
//                 $classes = array_unique(apply_filters('kemet_header_class', $classes));
    
//                 $classes = array_map('sanitize_html_class', $classes);
    
               
//                 echo 'class="' . esc_attr(join(' ', $classes)) . '"';
//         }
//         public static function defaults() {
//             // Defaults list of options.
//             return apply_filters(
//                 'kemet_theme_defaults', array(
//                 'header-layouts'                   => 'header-main-layout-5',
//                 ) 
//             );
// 		}
// 		/**
// 		 * Get theme options from static array()
// 		 *
// 		 * @return array    Return array of theme options.
// 		 */
// 		public static function get_options() {
// 			return self::$db_options;
// 		}
// 		/**
// 		 * Update theme static option array.
// 		 */
// 		public static function refresh() {
// 			self::$db_options = wp_parse_args(
// 				get_option( KEMET_THEME_SETTINGS ),
// 				self::defaults()
// 			);
// 		}


//     }
// }
// Kemet_Header_Markup::get_instance();
