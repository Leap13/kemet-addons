<?php
/**
 * Top Bar Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Top_Bar_Partials')) {

    /**
     * Top Bar Section
     *
     * @since 1.0.0
     */
    class Kemet_Top_Bar_Partials
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
            add_action( 'kemet_sitehead_top' , array( $this, 'kemet_top_header_template' ), 9 );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'customize_register', array( $this, 'customize_register_before_theme' ), 5 );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );

        }

        public function kemet_top_header_template() {
            
           // $enable_top_header = kemet_get_option('enable-top-header');
            
           // if ('1'  == $enable_top_header)  {
				kemetaddons_get_template( 'top-bar-section/templates/topbar-layout.php' );
			//	return true;
          //  }
            
        }

        /**
		 * Base on addon activation section registered.
		 *
		 * @since 1.0.0
		 * @param object $wp_customize customizer object.
		 * @return void
		 */
		function customize_register_before_theme( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-topbar-header', array(
                            'title'    => __( 'Top Bar Section', 'kemet' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 15,
                        )
                )
            );
        }


        function theme_defaults( $defaults ) {


            return $defaults;
        }

       function customize_register($wp_customize) {
			require_once KEMET_TOPBAR_DIR . 'customizer/customizer-options.php';  
			
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_TOPBAR_DIR.'assets/css/minified/style.min.css');

	    }
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_DIR . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_DIR . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Top_Bar_Partials::get_instance();
