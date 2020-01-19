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
            if ( is_admin() ) {
                // Add necessary input on widget configuration form
                add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );

                // Save widget attributes
                add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );

                // https://core.trac.wordpress.org/ticket/25809
                // Enqueue widgets admin scripts
                add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 10 );

                // Enqueue widgets admin scripts
                add_action( 'admin_footer-widgets.php', array( __CLASS__, 'print_scripts' ), 9999 );
            } else {
                // Insert attributes into widget markup
                add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
            }
        }

        /**
         * Enqueue widgets admin scripts
         * @param string $hook_suffix
         */
        public static function enqueue_scripts( $hook_suffix ) {
            if ( 'widgets.php' !== $hook_suffix ) {
                return;
            }

            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( 'underscore' );
        }

        /**
         * Enqueue widgets admin scripts
         */
        public static function print_scripts() {
            ?>
            <style type="text/css">
                .wp-picker-container {
                    clear: both;
                    width: 100%;
                }
            </style>
            <script type="text/javascript">
                ( function ( $ ) {
                    function initColorPicker( widget ) {
                        widget.find( '.color-picker' ).wpColorPicker( {
                            change: _.throttle( function () { // For Customizer
                                $( this ).trigger( 'change' );
                            }, 3000 )
                        } );
                    }

                    function onFormUpdate( event, widget ) {
                        initColorPicker( widget );
                    }

                    $( document ).on( 'widget-added widget-updated', onFormUpdate );

                    $( document ).ready( function () {
                        $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
                            initColorPicker( $( this ) );
                        } );
                    } );
                }( jQuery ) );
            </script>
            <?php
        }
        public function get_default( $field, $options = array() ) {

        $default = ( isset( $field['default'] ) ) ? $field['default'] : $default;
        $default = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : $default;   
        
        return $default;
    
        }
        /**
         * Inject input fields into widget configuration form
         *
         * @since 0.1
         * @wp_hook action in_widget_form
         *
         * @param object $widget Widget object
         *
         * @return NULL
         */
        public static function _input_fields( $widget, $return, $instance ) {
            $instance = self::_get_attributes( $instance );
            
            $fields = array(
                array(
                    'id'          => $widget->get_field_name( 'widget-style' ),
                    'type'        => 'select',
                    'title'       => 'Style',
                    'field_name'  => 'widget-style', 
                    'options'     => array(
                      ''  => 'Default', 
                      'style1'  => 'Style 1',
                      'style2'  => 'Style 2',
                      'style3'  => 'Style 3',
                      'style4'  => 'Style 4',
                      'style5'  => 'Style 5',
                      'style6'  => 'Style 6',
                      'style7'  => 'Style 7',
                      'style8'  => 'Style 8',
                      'style9'  => 'Style 9',
                      'style10'  => 'Style 10', 
                    ),
                    'default'     => ''
                  ),
                  array(
                    'id'    => $widget->get_field_name( 'widget-style-color' ),
                    'field_name'  => 'widget-style-color',
                    'type'  => 'color',
                    'title' => 'Style Color',
                ),
                array(
                    'id'    => $widget->get_field_name( 'widget-icon' ),
                    'field_name'  => 'widget-icon', 
                    'type'  => 'icon',
                    'title' => 'Icon',
                ),
            );
            echo '<div class="kfw kfw-widgets kfw-fields">';
            foreach($fields as $field){
                $field_unique = '';
                $field_value  = $instance[ $field['field_name'] ];
                KFW::field($field , $field_value, $field_unique );
            }
            echo '</div>';


            ?>

            <?php
            return null;
        }

        /**
         * Get default attributes
         *
         * @since 0.1
         *
         * @param array $instance Widget instance configuration
         *
         * @return array
         */
        private static function _get_attributes( $instance ) {
            $instance = wp_parse_args(
            $instance, array(
                'widget-style'         => '',
                'widget-style-color'   => '',
                'widget-icon'          => '',
            )
            );

            return $instance;
        }

        /**
         * Save attributes upon widget saving
         *
         * @since 0.1
         * @wp_hook filter widget_update_callback
         *
         * @param array  $instance     Current widget instance configuration
         * @param array  $new_instance New widget instance configuration
         * @param array  $old_instance Old Widget instance configuration
         * @param object $widget       Widget object
         *
         * @return array
         */
        public static function _save_attributes( $instance, $new_instance,
                                                 $old_instance, $widget ) {
            $instance[ 'widget-style' ]         = $instance[ 'widget-style-color' ]   = $instance[ 'widget-icon' ]          = '';


            // Style
            $instance[ 'widget-style' ] = (in_array( $new_instance[ 'widget-style' ], array( '', 'style1', 'style2', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10' ) )) ? $new_instance[ 'widget-style' ] : '';

            if ( !empty( $new_instance[ 'widget-style-color' ] ) ) {
                $instance[ 'widget-style-color' ] = sanitize_hex_color( $new_instance[ 'widget-style-color' ] );
            }

            // Icon
            $instance[ 'widget-icon' ] = $new_instance[ 'widget-icon' ];

            return $instance;
        }

        /**
         * Insert attributes into widget markup
         *
         * @since 0.1
         * @filter dynamic_sidebar_params
         *
         * @param array $params Widget parameters
         *
         * @return Array
         */
        public static function _insert_attributes( $params ) {
            global $wp_registered_widgets;

            $widget_id  = $params[ 0 ][ 'widget_id' ];
            $widget_obj = $wp_registered_widgets[ $widget_id ];
            
            if (
            !isset( $widget_obj[ 'callback' ][ 0 ] ) || !is_object( $widget_obj[ 'callback' ][ 0 ] )
            ) {
                return $params;
            }

            $widget_options = get_option( $widget_obj[ 'callback' ][ 0 ]->option_name );
            if ( empty( $widget_options ) )
                return $params;

            $widget_num = $widget_obj[ 'params' ][ 0 ][ 'number' ];
            if ( empty( $widget_options[ $widget_num ] ) )
                return $params;

            $instance = $widget_options[ $widget_num ];

            $widget_style = kemet_get_option( 'widgets-style' );
            if ( !empty( $instance[ 'widget-style' ] ) ) {
                $widget_style = $instance[ 'widget-style' ];
            }

            ob_start();


            if ( $widget_style == 'style1' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style2' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            background-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                    #<?php echo $widget_id ?> .widget-head {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            border-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style3' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                            border-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style4' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                    #<?php echo $widget_id ?> .widget-content {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            border-bottom-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style5' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-head {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            background-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style6' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-head {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            background-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style7' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                    #<?php echo $widget_id ?> .widget-head {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            border-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
            <?php } elseif ( $widget_style == 'style8' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title {
                <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                            border-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>

                    }
                    #<?php echo $widget_id ?> .widget-title:before {
                        <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            border-bottom-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
                <?php } elseif ( $widget_style == 'style9' ) { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?>.widget {
                <?php if ( !empty( $instance[ 'widget-style-color' ] ) ) { ?>
                            background-color: <?php echo $instance[ 'widget-style-color' ]; ?> !important;
                <?php } ?>
                    }
                </style>
                <?php } elseif ($widget_style == 'style10') { ?>
                <style type="text/css" scoped>
                    #<?php echo $widget_id ?> .widget-title:after {
                        <?php if (!empty($instance['widget-style-color'])) { ?>
                            background-color: <?php echo $instance['widget-style-color']; ?> !important;
                        <?php } ?>
                    }
                </style>
                <?php
            }
            ?>
            <?php
            $widget_styles = ob_get_contents();
            ob_end_clean();

            if ( empty( $widget_styles ) ) {
                $widget_styles = '';
            }

            $kmt_widget_class = '';
            if ( !empty( $widget_style ) ) {
                $kmt_widget_class .= 'kmt-widget-' . $widget_style;
            }

            if ( !empty( $kmt_widget_class ) ) {
                $params[ 0 ][ 'before_widget' ] = '<div id="kmt-' . $widget_id . '" class ="' . $kmt_widget_class . '">' . $widget_styles . $params[ 0 ][ 'before_widget' ];
                $params[ 0 ][ 'after_widget' ]  = $params[ 0 ][ 'after_widget' ] . '</div>';
            }

            return $params;
        }

    }

}

add_action( 'widgets_init', array( 'kmt_Widget_Attributes', 'setup' ) );
