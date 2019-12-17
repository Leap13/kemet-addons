<?php
/**
 * Mailchimp Widget.
 *
 * @package Kemet Addons
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Kemet_Social_Icons_Widget' ) ) {
    class Kemet_Create_Widget extends WP_Widget {
      // constans
      public $extra_fields = array();
      public $unique  = '';
      public $args    = array(
        'title'       => '',
        'classname'   => '',
        'description' => '',
        'width'       => '',
        'defaults'    => array(),
        'fields'      => array(),
        'class'       => '',
      );
      
    public function __construct( $key, $params , $extra_params) {
      $widget_ops  = array();
      $control_ops = array();
      $this->extra_fields = $extra_params;
      $this->unique = $key;
      $this->args   = apply_filters( "kfw_{$this->unique}_args", wp_parse_args( $params, $this->args ), $this ); 
      // Set control options
      if( ! empty( $this->args['width'] ) ) {
        $control_ops['width'] = $this->args['width'];
      }

      // Set widget options
      if( ! empty( $this->args['description'] ) ) {
        $widget_ops['description'] = $this->args['description'];
      }

      if( ! empty( $this->args['classname'] ) ) {
        $widget_ops['classname'] = $this->args['classname'];
      }

      // Set filters
      $widget_ops  = apply_filters( "kfw_{$this->unique}_widget_ops", $widget_ops, $this );
      $control_ops = apply_filters( "kfw_{$this->unique}_control_ops", $control_ops, $this );

      parent::__construct( $this->unique, $this->args['title'], $widget_ops, $control_ops );

    }

    // Register widget with WordPress
    public static function instance( $key, $params = array() , $extra_fields) {
      return new self( $key, $params , $extra_fields);
    }

    // Front-end display of widget.
    public function widget( $args, $instance ) {
      call_user_func( $this->unique, $args, $instance );
    }

    // get default value
    public function get_default( $field, $options = array() ) {

      $default = ( isset( $this->args['defaults'][$field['id']] ) ) ? $this->args['defaults'][$field['id']] : null;
      $default = ( isset( $field['default'] ) ) ? $field['default'] : $default;
      $default = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : $default;   
      
      return $default;

    }

    // Back-end widget form.
    public function form( $instance ) {  
        $defaults = '';
        if(! empty($this->extra_fields)){
            foreach($this->extra_fields as $field){
                $defaults = array(
                    $field['id'] => esc_html__($field['title'], 'kemet-addons'),
                );
            }
        }   
      $instance = wp_parse_args((array) $instance, $defaults); 
      if( ! empty( $this->args['fields'] ) ) {

        $class = ( $this->args['class'] ) ? ' '. $this->args['class'] : '';

        echo '<div class="kfw kfw-widgets kfw-fields'. $class .'">';

        foreach( $this->args['fields'] as $field ) {

          $field_value  = '';
          $field_unique = '';

          if( ! empty( $field['id'] ) ) {

            $field_value  = $this->get_default( $field, $instance );
            $field_unique = 'widget-' . $this->unique . '[' . $this->number . ']';

            if( $field['id'] === 'title' ) {
              $field['attributes']['id'] = 'widget-'. $this->unique .'-'. $this->number .'-title';
            }

          }

          KFW::field( $field, $field_value, $field_unique );

        } 
        if(! empty($this->extra_fields)){
            foreach($this->extra_fields as $field){ ?>
              <p>
                <label for="<?php echo $this->get_field_id( $field['id'] ); ?>"><?php echo esc_html__( $field['title'], 'kemet-addons' ); ?></label> 
                <input class="<?php echo $field['classname'] ?>" id="<?php echo $this->get_field_id( $field['id'] ); ?>" name="<?php echo $this->get_field_name( $field['id'] ); ?>" value="<?php echo esc_attr($instance[$field['id']]) ?>" />
            </p>
            <?php }
        } 
       echo '</div>';

      }
    }

    // Sanitize widget form values as they are saved.
    public function update( $new_instance, $old_instance ) {

      // auto sanitize
      foreach( $this->args['fields'] as $field ) {
        if( ! empty( $field['id'] ) && ( ! isset( $new_instance[$field['id']] ) || is_null( $new_instance[$field['id']] ) ) ) {
          $new_instance[$field['id']] = '';
        }
      }
      $new_instance['color'] = strip_tags( $new_instance['color'] );
      $new_instance = apply_filters( "kfw_{test}_save", $new_instance, $this->args, $this );

      do_action( "kfw_{$this->unique}_save_before", $new_instance, $this->args, $this );

      return $new_instance;

      }
    }
 
}