<?php
/**
 * Kemet Compatiblity
 *
 * @package Kemet Addons
 */

define('KEMET_COMPATIBLITY_DIR', KEMET_ADDONS_DIR . 'inc/compatibility/');
define('KEMET_COMPATIBLITY_URL', KEMET_ADDONS_URL . 'inc/compatibility/');

if (! class_exists('Kemet_Addons_Compatiblity')) {
    class Kemet_Addons_Compatiblity
    {

        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        /**
         *  Initiator
         */
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         *  Constructor
         */
        
        public function __construct()
        {
            require_once KEMET_COMPATIBLITY_DIR . 'classes/kemet-addons-page-builder-compatiblity.php';
            require_once KEMET_COMPATIBLITY_DIR . 'classes/kemet-addons-advanced-posts-search.php';
        }
    }

    Kemet_Addons_Compatiblity::get_instance();
}
