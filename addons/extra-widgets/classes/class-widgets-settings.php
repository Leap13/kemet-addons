<?php
/**
 * Go Top Settings Defaults, Customizer, Customizer Preview
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Go_Top_Settings')) {

    /**
     * Go Top Section
     *
     * @since 1.0.0
     */
    class Kemet_Go_Top_Settings
    {

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
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
        }

		public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-extra-widgets', array(
                            'title'    => __( 'Go Top Section', 'kemet-addons' ),
                            'panel'    => 'panel-layout',
                            'section'   => 'section-footer-group',
                            'priority' => 40,
                        )
                )
            );
            require_once KEMET_WIDGETS_DIR . 'customizer/customizer-options.php';  
            require_once KEMET_WIDGETS_DIR .'customizer/function-helper.php';
        }



        public function theme_defaults( $defaults ) {
            $defaults['enable-extra-widgets']           = '1';
            $defaults['extra-widgets-button-size']           = '';
            $defaults['extra-widgets-icon-size']           = '';
            $defaults['extra-widgets-border-radius']           = '';
            $defaults['extra-widgets-icon-color']           = '';
            $defaults['extra-widgets-icon-h-color']           = '';
            $defaults['extra-widgets-bg-color']           = '';
            $defaults['extra-widgets-bg-h-color']           = '';
            $defaults['extra-widgets-responsive']           = 'all-device';

            return $defaults;
        }
        
        public function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_WIDGETS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_WIDGETS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			
            }
        }
    }
}
Kemet_Go_Top_Settings::get_instance();
