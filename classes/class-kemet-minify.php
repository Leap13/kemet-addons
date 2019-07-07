<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Minify' ) ) {
    
    class Kemet_Minify{
    /**
		 * A flag for whether or not we're in a Customizer
		 * preview or not.
		 *
		 * @since 1.0
		 * @access private
		 * @var bool $_in_customizer_preview
		 */
		static private $_in_customizer_preview = false;
        
        /**
		 * Additional CSS to enqueue.
		 *
		 * @since 1.0
		 * @var array $css
		 */
		static private $css_files = array();
        
        /**
		 * Additional JS to enqueue.
		 *
		 * @since 1.0
		 * @var array $js
		 */
		static private $js_files = array();
        
        /**
		 * Instance
		 *
		 * @since 1.6.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;
        
        /**
		 * Initiator
		 *
		 * @since 1.6.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
        
        function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'merge_all_scripts'));
        }
        
        function merge_all_scripts() {
            
        }
}
    
}