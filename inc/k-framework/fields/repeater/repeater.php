<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: repeater
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'KFW_Field_repeater' ) ) {
  class KFW_Field_repeater extends KFW_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'max'          => 0,
        'min'          => 0,
        'button_title' => '<i class="fa fa-plus-circle"></i>',
      ) );

      $fields    = $this->field['fields'];
      $unique_id = ( ! empty( $this->unique ) ) ? $this->unique : $this->field['id'];

      if ( $this->parent && preg_match( '/'. preg_quote( '['. $this->field['id'] .']' ) .'/', $this->parent ) ) {

        echo '<div class="kfw-notice kfw-notice-danger">'. esc_html__( 'Error: Nested field id can not be same with another nested field id.', 'kfw' ) .'</div>';

      } else {

        echo $this->field_before();

        echo '<div class="kfw-repeater-item kfw-repeater-hidden">';
        echo '<div class="kfw-repeater-content">';
        foreach ( $fields as $field ) {

          $field_parent  = $this->parent .'['. $this->field['id'] .']';
          $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';

          KFW::field( $field, $field_default, '_nonce', 'field/repeater', $field_parent );

        }
        echo '</div>';
        echo '<div class="kfw-repeater-helper">';
        echo '<div class="kfw-repeater-helper-inner">';
        echo '<i class="kfw-repeater-sort fa fa-arrows-alt"></i>';
        echo '<i class="kfw-repeater-clone fa fa-clone"></i>';
        echo '<i class="kfw-repeater-remove kfw-confirm fa fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'kfw' ) .'"></i>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="kfw-repeater-wrapper kfw-data-wrapper" data-unique-id="'. esc_attr( $this->unique ) .'" data-field-id="['. esc_attr( $this->field['id'] ) .']" data-max="'. esc_attr( $args['max'] ) .'" data-min="'. esc_attr( $args['min'] ) .'">';

        if ( ! empty( $this->value ) && is_array( $this->value ) ) {

          $num = 0;

          foreach ( $this->value as $key => $value ) {

            echo '<div class="kfw-repeater-item">';

            echo '<div class="kfw-repeater-content">';
            foreach ( $fields as $field ) {

              $field_parent = $this->parent .'['. $this->field['id'] .']';
              $field_unique = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .']['. $num .']' : $this->field['id'] .'['. $num .']';
              $field_value  = ( isset( $field['id'] ) && isset( $this->value[$key][$field['id']] ) ) ? $this->value[$key][$field['id']] : '';

              KFW::field( $field, $field_value, $field_unique, 'field/repeater', $field_parent );

            }
            echo '</div>';

            echo '<div class="kfw-repeater-helper">';
            echo '<div class="kfw-repeater-helper-inner">';
            echo '<i class="kfw-repeater-sort fa fa-arrows-alt"></i>';
            echo '<i class="kfw-repeater-clone fa fa-clone"></i>';
            echo '<i class="kfw-repeater-remove kfw-confirm fa fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'kfw' ) .'"></i>';
            echo '</div>';
            echo '</div>';

            echo '</div>';

            $num++;

          }

        }

        echo '</div>';

        echo '<div class="kfw-repeater-alert kfw-repeater-max">'. esc_html__( 'You can not add more than', 'kfw' ) .' '. esc_attr( $args['max'] ) .'</div>';
        echo '<div class="kfw-repeater-alert kfw-repeater-min">'. esc_html__( 'You can not remove less than', 'kfw' ) .' '. esc_attr( $args['min'] ) .'</div>';

        echo '<a href="#" class="button button-primary kfw-repeater-add">'. wp_kses_post( $args['button_title'] ) .'</a>';

        echo $this->field_after();

      }

    }

    public function enqueue() {

      if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
      }

    }

  }
}
