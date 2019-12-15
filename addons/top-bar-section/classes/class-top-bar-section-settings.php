<?php
/**
 * Top Bar Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Top_Bar_Settings')) {


    class Kemet_Top_Bar_Settings {

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
            add_action( 'customize_register', array( $this, 'customize_register' ), 5 );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
            add_filter( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
        }

		public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-topbar-header', array(
                            'title'    => __( 'Top Bar Section', 'kemet-addons' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 15,
                        )
                )
            );
            require_once KEMET_TOPBAR_DIR .'customizer/customizer-helpers.php';
            require_once KEMET_TOPBAR_DIR . 'customizer/customizer-options.php';  
        }


        function theme_defaults( $defaults ) {
            $defaults['top-section-1-html']              = '';
            $defaults['top-section-2-html']                    = '';
            $defaults['topbar-padding']         = '';
            $defaults['topbar-bg-color']    = '';
            $defaults['topbar-font-size']                  = '';
            $defaults['topbar-text-color']                  = '';
            $defaults['topbar-bg-color']             = '';
            $defaults['topbar-link-color']           = '';
            $defaults['topbar-link-h-color']           = '';
            $defaults['topbar-border-size']           = '';
            $defaults['topbar-border-bottom-color']           = '';
            $defaults['topbar-submenu-bg-color']           = '';
            $defaults['topbar-submenu-items-color']           = '';
            $defaults['topbar-submenu-items-h-color']           = '';

            return $defaults;
        }
        
        function header_classes( $classes ) {

            $search_style = kemet_get_option('top-bar-search-style');

            if ($search_style == true) {
                $classes[] = 'top-bar-' . $search_style;
            }
            $classes[] = 'header8-align-'. kemet_get_option('header8-position') ;

			return $classes;
         }
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }

    }
}
Kemet_Top_Bar_Settings::get_instance();
