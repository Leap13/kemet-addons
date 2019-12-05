<?php
/**
 * Page Title Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Page_Title_settings')) {

    /**
     * Page Title Section
     *
     * @since 1.0.0
     */
    class Kemet_Page_Title_settings {

        private static $instance;
        
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
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
        }

        public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-page-title-header', array(
                            'title'    => __( 'Page Title', 'kemet-addons' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 45,
                        )
                )
            );

            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-breadcrumbs', array(
                            'title'    => __( 'Breadcrumbs', 'kemet-addons' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 50,
                        )
                )
            );
            require_once KEMET_PAGE_TITLE_DIR . 'customizer/customizer-options.php';  
            require_once KEMET_PAGE_TITLE_DIR .'customizer/customizer-helpers.php';
        }
        
        function theme_defaults( $defaults ) {
            // Page title Options
            $defaults['page-title-layouts']                 = 'page-title-layout-1';
            $defaults['page_title_alignment']              = 'align-center';
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
            $defaults['pagetitle-bottomline-height']        = '';
            $defaults['pagetitle-bottomline-width']         = '40';
            $defaults['pagetitle-bottomline-color']       = '';
            // Breadcrumbs Defaults
            $defaults['kemet_has_breadcrumbs']              = '';
            $defaults['show-item-title']                    = '';
            $defaults['kemet-breadcrumb-separator']         = '';
            $defaults['kemet-breadcrumb-posts-taxonomy']    = '';
            $defaults['breadcrumbs-space']                  = '';
            $defaults['breadcrumbs-color']                  = '';
            $defaults['breadcrumbs-link-color']             = '';
            $defaults['breadcrumbs-link-h-color']           = '';
            return $defaults;
        }
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-pagetitle-customize-preview-js', KEMET_PAGE_TITLE_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }


    }
}
Kemet_Page_Title_settings::get_instance();
