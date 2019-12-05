<?php

/**
 * Meta Box
 */
if ( ! class_exists( 'Kemet_Addon_Meta_Box_Helper' ) ) {

	/**
	 * Meta Box
	 */
	class Kemet_Addon_Meta_Box_Helper {

		/**
		 * Instance
		 *
		 * @var $instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp', array( $this, 'meta_options_hooks' ) );
		}
         
		/**
		 * Metabox Hooks
		 */
		function meta_options_hooks() {

			if ( is_singular() ) {
				add_action( 'wp_head', array( $this, 'primary_header' ) );
				add_filter( 'kemet_header_class', array( $this, 'add_header_class' ) );
				add_filter( 'kemet_the_title_enabled', array( $this, 'post_title' ) );
				add_filter ( 'kemet_the_page_title_enabled', array( $this, 'post_title' ));
				add_filter( 'kemet_page_breadcrumbs_enabled', array( $this, 'breadcrumbs_display' ) );
				add_filter( 'kemet_featured_image_enabled', array( $this, 'featured_img' ) );
                add_filter( 'kemet_main_footer_disable', array($this, 'kemet_footer_display') );  
                add_filter( 'kmt_footer_copyright_layout_disable', array($this, 'kemet_copyright_display'));
              
			}
           
        }
        
        /**
		 * Transparent Header Option
		 */
        
        function add_header_class($classes, $default='') {
			
			$enable_trans_header = kemet_get_option( 'enable-transparent' );
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
		    $trans_meta_option = (isset( $meta['kemet-meta-enable-header-transparent'] ) ) ? $meta['kemet-meta-enable-header-transparent'] : $default;

			if ( ('enabled' === $trans_meta_option && $enable_trans_header) || 'enabled' === $trans_meta_option  ) {
				
				$classes[] = 'kmt-header-transparent';
			} elseif ( 'disabled' === $trans_meta_option && $enable_trans_header ) {
				if (in_array('kmt-header-transparent', $classes)) {
                    unset( $classes[array_search('kmt-header-transparent', $classes)] );
                  }
			}
			
            return $classes;
            }
           
        

		/**
		 * Disable Primary Header
		 */
		function primary_header() {
            
        $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true); 
         
        $display_header = ( isset( $meta['kemet-main-header-display'] ) && $meta['kemet-main-header-display'] ) ? $meta['kemet-main-header-display'] : 'default';

			if ( '1' == $display_header ) {
				remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
				remove_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader' ));
			}
		}

		/**
		 * Disable Post / Page Title
		 *
		 */
		function post_title( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $title = ( isset( $meta['site-post-title'] ) && $meta['site-post-title'] ) ? $meta['site-post-title'] : 'default';

			if ( '1' == $title ) {
			$defaults = false;
			}

			return $defaults;
		}

		/**
		 * Disable Post / Page Featured Image
		 *
		 */
		function featured_img( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $featured_img = ( isset( $meta['kmt-featured-img'] ) && $meta['kmt-featured-img'] ) ? $meta['kmt-featured-img'] : 'default';

			if ( '1' == $featured_img ) {
				$defaults = false;
			}

			return $defaults;
		}
        
        /**
		 * Disable Post / Page Footer Widgets
		 *
		 */
        function kemet_footer_display( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $footer_display =  ( isset( $meta['kemet-footer-display'] ) && $meta['kemet-footer-display'] ) ? $meta['kemet-footer-display'] : 'default';
            
			if ( '1' == $footer_display ) {
                return;
            }

			return $defaults;
        }
        
        /**
		 * Disable Post / Page CopyRight
		 *
		 */
        function kemet_copyright_display( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $copyright_display =  ( isset( $meta['copyright-footer-layout'] ) && $meta['copyright-footer-layout'] ) ? $meta['copyright-footer-layout'] : 'default';

			if ( '1' == $copyright_display ) {
				$defaults = true;
			}

			return $defaults;
        }
        
        /**
		 * Post / Page Sidebar Display
		 *
		 */       
        function single_page_layout( $defaults ) {
            $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
            $sidebar_layout_meta = $meta['site-sidebar-layout'];

			if ( '1' == $sidebar_layout_meta ) {
				$defaults = false;
			}

			return $defaults;
		}
           
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Addon_Meta_Box_Helper::get_instance();