<?php
/**
* Kemet Sites Helper
*
* @since  0.0.1
* @package Kemet Sites
*/

if ( ! defined( 'ABSPATH' ) ) exit;
// Exit if directory accessed directly

if ( ! class_exists( 'Kemet_Sites_Helper' ) ) {

    /**
    * Kemet_Sites_Helper
    *
    * @since 1.0.0
    */

    class Kemet_Sites_Helper {

        /**
        * Instance
        *
        * @access private
        * @var object Instance
        * @since 1.0.0
        */
        private static $instance;

        /**
        * Initiator
        *
        * @since 1.0.0
        * @return object initialized object of class.
        */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
        * Constructor
        *
        * @since 1.0.0
        */

        public function __construct() {
            //add_filter( 'wie_import_data', array( $this, 'custom_menu_widget' ) );
           // add_filter( 'wp_prepare_attachment_for_js', array( $this, 'add_svg_image_support' ), 10, 3 );
        }




        /**
        * Downloads an image from the specified URL.
        *
        * Taken from the core media_sideload_image() function and
        * modified to return an array of data instead of html.
        *
        * @since 1.0.10
        *
        * @param string $file The image file path.
        * @return array An array of image data.
        */
        static public function _sideload_image( $file ) {
            $data = new stdClass();

            if ( ! function_exists( 'media_handle_sideload' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
            }

            if ( ! empty( $file ) ) {

                // Set variables for storage, fix file filename for query strings.
                preg_match( '/[^\?]+\.(jpe?g|jpe|svg|gif|png)\b/i', $file, $matches );
                $file_array         = array();
                $file_array['name'] = basename( $matches[0] );

                // Download file to temp location.
                $file_array['tmp_name'] = download_url( $file );

                // If error storing temporarily, return the error.
                if ( is_wp_error( $file_array['tmp_name'] ) ) {
                    return $file_array['tmp_name'];
                }

                // Do the validation and storage stuff.
                $id = media_handle_sideload( $file_array, 0 );

                // If error storing permanently, unlink.
                if ( is_wp_error( $id ) ) {
                    unlink( $file_array['tmp_name'] );
                    return $id;
                }

                // Build the object to return.
                $meta                = wp_get_attachment_metadata( $id );
                $data->attachment_id = $id;
                $data->url           = wp_get_attachment_url( $id );
                $data->thumbnail_url = wp_get_attachment_thumb_url( $id );
                $data->height        = $meta['height'];
                $data->width         = $meta['width'];
            }

            return $data;
        }

        /**
        * Checks to see whether a string is an image url or not.
        *
        * @since 1.0.10
        *
        * @param string $string The string to check.
        * @return bool Whether the string is an image url or not.
        */
        static public function _is_image_url( $string = '' ) {
            if ( is_string( $string ) ) {

                if ( preg_match( '/\.(jpg|jpeg|png|gif)/i', $string ) ) {
                    return true;
                }
            }

            return false;
        }

    }

    /**
    * Kicking this off by calling 'get_instance()' method
    */
    Kemet_Sites_Helper::get_instance();

}