<?php
if ( !defined( 'ABSPATH' ) ) {
    die( 'No direct access allowed' );
}

if ( !class_exists( 'kmt_Widget_Attributes' ) ) {

    class kmt_Widget_Attributes {

        /**
         * Initialize plugin
         */
        public static function setup() {
            // Insert attributes into widget markup
            add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) ); 
        }

        /**
         * Insert attributes into widget markup
         *
         * @filter dynamic_sidebar_params
         *
         * @param array $params Widget parameters
         *
         * @return Array
         */
        public static function _insert_attributes( $params ) {
            global $wp_registered_widgets;
            
            $widget_id  = $params[ 0 ][ 'widget_id' ];

            $widget_style = kemet_get_option( 'widgets-style' );

            
            $kmt_widget_class = '';
            if ( !empty( $widget_style ) ) {
                $kmt_widget_class = 'kmt-widget-' . $widget_style;
            }

            //Footer Custom Style
            $kmt_footet_widget_class = '';
            $footer_widget_style = kemet_get_option( 'footer-widgets-style' );

            if ( (!empty( $footer_widget_style )) && (strpos($params[ 0 ]['id'], 'main-footer-widget') !== false || strpos($params[ 0 ]['id'], 'copyright-widget') !== false)) {
                $kmt_widget_class = 'kmt-widget-' . $footer_widget_style;
            }
            
            if ( !empty( $kmt_widget_class )) {
                $params[0] = array_replace($params[0], array('before_widget' => str_replace("widget ", "widget " . $kmt_widget_class . ' ', $params[0]['before_widget'])));
            }

            return $params;
        }

    }

}

add_action( 'widgets_init', array( 'kmt_Widget_Attributes', 'setup' ) );