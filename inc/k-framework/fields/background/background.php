<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'KFW_Field_background' ) ) {
  class KFW_Field_background extends KFW_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args                             = wp_parse_args( $this->field, array(
        'background_color'              => true,
        'background_image'              => true,
        'background_position'           => true,
        'background_repeat'             => true,
        'background_attachment'         => true,
        'background_size'               => true,
        'background_origin'             => false,
        'background_clip'               => false,
        'background_blend_mode'         => false,
        'background_gradient'           => false,
        'background_gradient_color'     => true,
        'background_gradient_direction' => true,
        'background_image_preview'      => true,
        'background_auto_attributes'    => false,
        'background_image_library'      => 'image',
        'background_image_placeholder'  => esc_html__( 'No background selected', 'kemet-addons' ),
      ) );

      $default_value                    = array(
        'background-color'              => '',
        'background-image'              => '',
        'background-position'           => '',
        'background-repeat'             => '',
        'background-attachment'         => '',
        'background-size'               => '',
        'background-origin'             => '',
        'background-clip'               => '',
        'background-blend-mode'         => '',
        'background-gradient-color'     => '',
        'background-gradient-direction' => '',
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $this->value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="kfw--background-colors">';

      //
      // Background Color
      if ( ! empty( $args['background_color'] ) ) {

        echo '<div class="kfw--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="kfw--title">'. esc_html__( 'From', 'kemet-addons' ) .'</div>' : '';

        KFW::field( array(
          'id'      => 'background-color',
          'type'    => 'color',
          'default' => $default_value['background-color'],
        ), $this->value['background-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Color
      if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="kfw--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="kfw--title">'. esc_html__( 'To', 'kemet-addons' ) .'</div>' : '';

        KFW::field( array(
          'id'      => 'background-gradient-color',
          'type'    => 'color',
          'default' => $default_value['background-gradient-color'],
        ), $this->value['background-gradient-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Direction
      if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="kfw--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="kfw---title">'. esc_html__( 'Direction', 'kemet-addons' ) .'</div>' : '';

        KFW::field( array(
          'id'          => 'background-gradient-direction',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Gradient Direction', 'kemet-addons' ),
            'to bottom' => esc_html__( '&#8659; top to bottom', 'kemet-addons' ),
            'to right'  => esc_html__( '&#8658; left to right', 'kemet-addons' ),
            '135deg'    => esc_html__( '&#8664; corner top to right', 'kemet-addons' ),
            '-135deg'   => esc_html__( '&#8665; corner top to left', 'kemet-addons' ),
          ),
        ), $this->value['background-gradient-direction'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '</div>';

      //
      // Background Image
      if ( ! empty( $args['background_image'] ) ) {

        echo '<div class="kfw--background-image">';

        KFW::field( array(
          'id'          => 'background-image',
          'type'        => 'media',
          'class'       => 'kfw-assign-field-background',
          'library'     => $args['background_image_library'],
          'preview'     => $args['background_image_preview'],
          'placeholder' => $args['background_image_placeholder'],
          'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
        ), $this->value['background-image'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      $auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' kfw--auto-attributes' : '';
      $hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' kfw--attributes-hidden' : '';

      echo '<div class="kfw--background-attributes'. esc_attr( $auto_class . $hidden_class ) .'">';

      //
      // Background Position
      if ( ! empty( $args['background_position'] ) ) {

        KFW::field( array(
          'id'              => 'background-position',
          'type'            => 'select',
          'options'         => array(
            ''              => esc_html__( 'Background Position', 'kemet-addons' ),
            'left top'      => esc_html__( 'Left Top', 'kemet-addons' ),
            'left center'   => esc_html__( 'Left Center', 'kemet-addons' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'kemet-addons' ),
            'center top'    => esc_html__( 'Center Top', 'kemet-addons' ),
            'center center' => esc_html__( 'Center Center', 'kemet-addons' ),
            'center bottom' => esc_html__( 'Center Bottom', 'kemet-addons' ),
            'right top'     => esc_html__( 'Right Top', 'kemet-addons' ),
            'right center'  => esc_html__( 'Right Center', 'kemet-addons' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'kemet-addons' ),
          ),
        ), $this->value['background-position'], $this->field_name(), 'field/background' );

      }

      //
      // Background Repeat
      if ( ! empty( $args['background_repeat'] ) ) {

        KFW::field( array(
          'id'          => 'background-repeat',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Background Repeat', 'kemet-addons' ),
            'repeat'    => esc_html__( 'Repeat', 'kemet-addons' ),
            'no-repeat' => esc_html__( 'No Repeat', 'kemet-addons' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'kemet-addons' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'kemet-addons' ),
          ),
        ), $this->value['background-repeat'], $this->field_name(), 'field/background' );

      }

      //
      // Background Attachment
      if ( ! empty( $args['background_attachment'] ) ) {

        KFW::field( array(
          'id'       => 'background-attachment',
          'type'     => 'select',
          'options'  => array(
            ''       => esc_html__( 'Background Attachment', 'kemet-addons' ),
            'scroll' => esc_html__( 'Scroll', 'kemet-addons' ),
            'fixed'  => esc_html__( 'Fixed', 'kemet-addons' ),
          ),
        ), $this->value['background-attachment'], $this->field_name(), 'field/background' );

      }

      //
      // Background Size
      if ( ! empty( $args['background_size'] ) ) {

        KFW::field( array(
          'id'        => 'background-size',
          'type'      => 'select',
          'options'   => array(
            ''        => esc_html__( 'Background Size', 'kemet-addons' ),
            'cover'   => esc_html__( 'Cover', 'kemet-addons' ),
            'contain' => esc_html__( 'Contain', 'kemet-addons' ),
            'auto'    => esc_html__( 'Auto', 'kemet-addons' ),
          ),
        ), $this->value['background-size'], $this->field_name(), 'field/background' );

      }

      //
      // Background Origin
      if ( ! empty( $args['background_origin'] ) ) {

        KFW::field( array(
          'id'            => 'background-origin',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Origin', 'kemet-addons' ),
            'padding-box' => esc_html__( 'Padding Box', 'kemet-addons' ),
            'border-box'  => esc_html__( 'Border Box', 'kemet-addons' ),
            'content-box' => esc_html__( 'Content Box', 'kemet-addons' ),
          ),
        ), $this->value['background-origin'], $this->field_name(), 'field/background' );

      }

      //
      // Background Clip
      if ( ! empty( $args['background_clip'] ) ) {

        KFW::field( array(
          'id'            => 'background-clip',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Clip', 'kemet-addons' ),
            'border-box'  => esc_html__( 'Border Box', 'kemet-addons' ),
            'padding-box' => esc_html__( 'Padding Box', 'kemet-addons' ),
            'content-box' => esc_html__( 'Content Box', 'kemet-addons' ),
          ),
        ), $this->value['background-clip'], $this->field_name(), 'field/background' );

      }

      //
      // Background Blend Mode
      if ( ! empty( $args['background_blend_mode'] ) ) {

        KFW::field( array(
          'id'            => 'background-blend-mode',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Blend Mode', 'kemet-addons' ),
            'normal'      => esc_html__( 'Normal', 'kemet-addons' ),
            'multiply'    => esc_html__( 'Multiply', 'kemet-addons' ),
            'screen'      => esc_html__( 'Screen', 'kemet-addons' ),
            'overlay'     => esc_html__( 'Overlay', 'kemet-addons' ),
            'darken'      => esc_html__( 'Darken', 'kemet-addons' ),
            'lighten'     => esc_html__( 'Lighten', 'kemet-addons' ),
            'color-dodge' => esc_html__( 'Color Dodge', 'kemet-addons' ),
            'saturation'  => esc_html__( 'Saturation', 'kemet-addons' ),
            'color'       => esc_html__( 'Color', 'kemet-addons' ),
            'luminosity'  => esc_html__( 'Luminosity', 'kemet-addons' ),
          ),
        ), $this->value['background-blend-mode'], $this->field_name(), 'field/background' );

      }

      echo '</div>';

      echo $this->field_after();

    }

    public function output() {

      $output    = '';
      $bg_image  = array();
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

      // Background image and gradient
      $background_color        = ( ! empty( $this->value['background-color']              ) ) ? $this->value['background-color']              : '';
      $background_gd_color     = ( ! empty( $this->value['background-gradient-color']     ) ) ? $this->value['background-gradient-color']     : '';
      $background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
      $background_image        = ( ! empty( $this->value['background-image']['url']       ) ) ? $this->value['background-image']['url']       : '';


      if ( $background_color && $background_gd_color ) {
        $gd_direction   = ( $background_gd_direction ) ? $background_gd_direction .',' : '';
        $bg_image[] = 'linear-gradient('. $gd_direction . $background_color .','. $background_gd_color .')';
        unset( $this->value['background-color'] );
      }

      if ( $background_image ) {
        $bg_image[] = 'url('. $background_image .')';
      }

      if ( ! empty( $bg_image ) ) {
        $output .= 'background-image:'. implode( ',', $bg_image ) . $important .';';
      }

      // Common background properties
      $properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

      foreach ( $properties as $property ) {
        $property = 'background-'. $property;
        if ( ! empty( $this->value[$property] ) ) {
          $output .= $property .':'. $this->value[$property] . $important .';';
        }
      }

      if ( $output ) {
        $output = $element .'{'. $output .'}';
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}