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
            add_action( 'kemet_after_header_block' , array( $this, 'kemet_page_title_markup' ), 9 );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'customize_register', array( $this, 'customize_register_before_theme' ) );
            add_action( 'customize_register', array( $this, 'controls_helpers' ) );
             
             add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
             add_action( 'customize_register', array( $this, 'customize_register' ) );
            // add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
            // Advanced Header with Merge header action.
			add_action( 'kemet_before_header_block', array( $this, 'header_merged_with_title' ) );

        }
        //  function kemet_page_title_template() {
            
		// 		kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
            
        // }

        function kemet_page_title_markup() {
            if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) {
            kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
            }
            $header_merged_title = kemet_get_option('merge-with-header');
            if( $header_merged_title == '1') {
                echo '</div>';
            }
         }

         function page_title_displayed() {
             
            return false;
         }

         public function controls_helpers() {
			require_once( KEMET_PAGE_TITLE_DIR .'customizer/customizer-helpers.php' );
        }
        
        public function header_merged_with_title() {
            $header_merged_title = kemet_get_option("merge-with-header");
            if( $header_merged_title == '1') {
                $combined = 'kemet-merged-header-title';
            printf(
				'<div class="%1$s">',
				$combined
            );
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
                    $wp_customize, 'section-page-title-header', array(
                            'title'    => __( 'Page Title', 'kemet' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 45,
                        )
                )
            );

            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-breadcrumbs', array(
                            'title'    => __( 'Breadcrumbs', 'kemet' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 50,
                        )
                )
            );
        }


        function theme_defaults( $defaults ) {
            // Page title Options
            $defaults['page-title-layouts']                 = 'page-title-layout-1';
            $defaults['page-title-alignmrent']              = 'align-center';
            $defaults['page-title-bg-obj']                  = array(
				'background-color'      => '#eaeaea',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
            );
            $defaults['merge-with-header']                  = '';
            $defaults['page-title-space']                   = '';
            $defaults['page-title-color']                   = '';
            $defaults['page-title-font-size']                   = '';
            $defaults['page-title-font-family']             = 'inherit';
            $defaults['pagetitle-font-weight']              = '';
            $defaults['pagetitle-text-transform']           = '';
            $defaults['pagetitle-line-height']              = '';
            $defaults['page-title-responsive']              = 'all-devices';
            $defaults['pagetitle-bottomline-width']         = '';
            $defaults['page-title-bottom-line-color']       = '';
            // Breadcrumbs Defaults
            $defaults['kemet_has_breadcrumbs']              = '';
            $defaults['show-item-title']                    = '';
            $defaults['kemet-breadcrumb-separator']         = '';
            $defaults['kemet-breadcrumb-posts-taxonomy']    = '';
            return $defaults;
        }

       function customize_register($wp_customize) {
          // echo 'helloo';
			require_once KEMET_PAGE_TITLE_DIR . 'customizer/customizer-options.php';  
			
        }

        function add_styles() {
            Kemet_Style_Generator::kmt_add_css( KEMET_PAGE_TITLE_DIR.'assets/css/minified/style.min.css');

	    }
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Page_Title_Partials::get_instance();
