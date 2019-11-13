<?php
/**
 * Go Top Partials
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Go_Top_Partials')) {

    /**
     * Top Bar Section
     *
     * @since 1.0.0
     */
    class Kemet_Go_Top_Partials
    {

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
            add_action( 'customize_register', array( $this, 'customize_register_before_theme' ) );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_action( 'customize_register', array( $this, 'controls_helpers' ) );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'kemet_footer', array( $this, 'kemet_go_top_markup') );
        }

        public function kemet_go_top_markup() {
            if( kemet_get_option( 'enable-go-top' ) ){
            require_once KEMET_GOTOP_DIR . 'templates/go-top.php';
            }
        }

        /**
		 * Base on addon activation section registered.
		 *
		 * @since 1.0.0
		 * @param object $wp_customize customizer object.
		 * @return void
		 */
		public function customize_register_before_theme( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-go-top', array(
                            'title'    => __( 'Go Top Section', 'kemet' ),
                            'panel'    => 'panel-layout',
                            'section'   => 'section-footer-group',
                            'priority' => 40,
                        )
                )
            );
        }



        public function theme_defaults( $defaults ) {
            $defaults['enable-go-top']           = '1';
            $defaults['go-top-button-size']           = '';
            $defaults['go-top-icon-size']           = '';
            $defaults['go-top-border-radius']           = '';
            $defaults['go-top-icon-color']           = '';
            $defaults['go-top-icon-h-color']           = '';
            $defaults['go-top-bg-color']           = '';
            $defaults['go-top-bg-h-color']           = '';
            $defaults['go-top-responsive']           = 'all-device';

            return $defaults;
        }

       public function customize_register($wp_customize) {
           
            require_once KEMET_GOTOP_DIR . 'customizer/customizer-options.php';  
			
        }

        public function controls_helpers() {
			require_once( KEMET_GOTOP_DIR .'customizer/function-helper.php' );
		}

        public function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_GOTOP_DIR.'assets/css/minified/style.min.css');

        }
        
        public function add_scripts() {
			 Kemet_Style_Generator::kmt_add_js(KEMET_GOTOP_DIR.'assets/js/minified/go-top.min.js');
		}
        
        public function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_GOTOP_DIR . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_GOTOP_DIR . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Go_Top_Partials::get_instance();
