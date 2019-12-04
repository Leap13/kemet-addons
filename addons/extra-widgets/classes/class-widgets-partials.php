<?php
/**
 * Go Top Partials
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Extra_Widgets_Partials')) {

    class Kemet_Extra_Widgets_Partials {

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
           // add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
          //  add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
           require_once( KEMET_WIDGETS_DIR .'classes/helper.php' );
            add_action( 'widgets_init', array( $this, 'kemet_extra_widgets_markup'), 10 );
            add_action( 'widgets_init', array( $this, 'register_kemet_widgets'));
           
        }

        public static function kemet_extra_widgets_markup() {

            // Define array of custom widgets for the theme
            $widgets = apply_filters( 'kemet_custom_widgets', array(
                'mailchimp',
            ) );

            // Loop through widgets and load their files
            if ( $widgets && is_array( $widgets ) ) {
                foreach ( $widgets as $widget ) {
                    $file = KEMET_WIDGETS_DIR . 'widgets/' . $widget .'.php';
                    if ( file_exists ( $file ) ) {
                        require_once( $file );
                    }
                }
            }
        }

        function register_kemet_widgets() {
			register_widget( 'Kemet_MailChimp_Widget' );
		}


        public function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_WIDGETS_DIR.'assets/css/minified/style.min.css');

        }
        
        public function add_scripts() {
             Kemet_Style_Generator::kmt_add_js(KEMET_WIDGETS_DIR.'assets/js/minified/extra-widgets.min.js');
             Kemet_Style_Generator::kmt_add_js(KEMET_WIDGETS_DIR.'assets/js/unminified/mailchimp.js');
		}
        
    }
}
Kemet_Extra_Widgets_Partials::get_instance();
