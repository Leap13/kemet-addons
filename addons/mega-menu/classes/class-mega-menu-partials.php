<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Mega_Menu_Partials')) {

    class Kemet_Mega_Menu_Partials {

        /**
		 * Member Variable
		 *
		 * @var string
		 */
        private static $mega_menu_style = '';
        
        /**
         * Member Variable
         *
         * @var object instance
         */
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
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'admin_enqueue_scripts',  array($this, 'admin_script' ) );
            add_filter( 'wp_nav_menu_args', array( $this, 'nav_menu_args' ) );
            add_filter( 'wp_footer', array( $this, 'megamenu_style' ) );
        }

        function nav_menu_args( $args ) {

            if ( 'primary' == $args['theme_location'] ) {
				$args['walker'] = new Mega_Menu_Walker_Nav_Menu();
			}

			return $args;
        }

        function admin_script(){

            wp_enqueue_style( 'kemet-addons-mega-menu-css', KEMET_MEGA_MENU_URL . 'assets/css/unminified/mega-menu.css', KEMET_ADDONS_VERSION );
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
 
			Kemet_Style_Generator::kmt_add_css( KEMET_MEGA_MENU_DIR.'assets/css/'. $dir .'/style' . $css_prefix );
        }
        
        /**
		 * Append CSS style to class variable.
		 *
		 * @since 1.0.10
		 * @param string $style Inline style string.
		 * @return void
		 */
		public static function add_css( $style ) {
			self::$mega_menu_style .= $style;
		}

		/**
		 * Print inline CSS to footer.
		 *
		 * @since 1.0.10
		 * @return void
		 */
		public function megamenu_style() {
           
			if ( '' != self::$mega_menu_style ) {
				echo "<style type='text/css' class='kemet-megamenu-inline-style'>";
				echo self::$mega_menu_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</style>';
			}
        }
        
        public function add_scripts() {

            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
            }
            
            Kemet_Style_Generator::kmt_add_js( KEMET_MEGA_MENU_DIR.'assets/js/' . $dir . '/mega-menu' . $js_prefix );
        }
    }
}
Kemet_Mega_Menu_Partials::get_instance();
