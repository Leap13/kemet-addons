<?php
/**
 * Woocommerce
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Woocommerce_Partials')) {

    /**
     * Woocommerce
     *
     * @since 1.0.3
     */
    class Kemet_Woocommerce_Partials
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
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
        }

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
            Kemet_Style_Generator::kmt_add_css( KEMET_WOOCOMMERCE_DIR . 'assets/css/'. $dir  .'/style' . $css_prefix);

	    }
    }
}
Kemet_Woocommerce_Partials::get_instance();
