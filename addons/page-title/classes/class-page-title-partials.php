<?php
/**
 * Page Title Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Page_Title_Partials')) {

    /**
     * Page Title Section
     *
     * @since 1.0.0
     */
    class Kemet_Page_Title_Partials {

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
            add_filter( 'kemet_the_title_enabled', '__return_false' );
            add_action( 'kemet_header_after' , array( $this, 'kemet_page_title_markup' ), 9 );
            // add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
             add_action( 'customize_register', array( $this, 'customize_register_before_theme' ) );
              add_action( 'customize_register', array( $this, 'controls_helpers' ) );
             
            // add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
             add_action( 'customize_register', array( $this, 'customize_register' ) );
            // add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );

        }
        //  function kemet_page_title_template() {
            
		// 		kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
            
        // }

        function kemet_page_title_markup() {
            if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) {
            kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
            }

         }
         function page_title_displayed() {
             
            return false;
         }

         public function controls_helpers() {
			require_once( KEMET_PAGE_TITLE_DIR .'customizer/customizer-helpers.php' );
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
                    $wp_customize, 'section-page-title-header', array(
                            'title'    => __( 'Page Title', 'kemet' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 45,
                        )
                )
            );
        }


        function theme_defaults( $defaults ) {


            return $defaults;
        }

       function customize_register($wp_customize) {
          // echo 'helloo';
			require_once KEMET_PAGE_TITLE_DIR . 'customizer/customizer-options.php';  
			
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css(KEMET_PAGE_TITLE_DIR.'assets/css/minified/style.min.css');

	    }
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_PAGE_TITLE_DIR . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_PAGE_TITLE_DIR . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Page_Title_Partials::get_instance();
