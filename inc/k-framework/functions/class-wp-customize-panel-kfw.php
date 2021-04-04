<?php
/**
 * WP Customize custom panel
 *
 * @package Kemet Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'WP_Customize_Panel_KFW' ) && class_exists( 'WP_Customize_Panel' ) ) {

	/**
	 *
	 * WP Customize custom panel
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Panel_KFW extends WP_Customize_Panel {

		/**
		 * Type
		 *
		 * @var string
		 */
		public $type = 'kfw';
	}
}

if ( ! class_exists( 'WP_Customize_Section_KFW' ) && class_exists( 'WP_Customize_Section' ) ) {

	/**
	 *
	 * WP Customize custom section
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Section_KFW extends WP_Customize_Section {

		/**
		 * Type
		 *
		 * @var string
		 */
		public $type = 'kfw';
	}
}

if ( ! class_exists( 'WP_Customize_Control_KFW' ) && class_exists( 'WP_Customize_Control' ) ) {

	/**
	 *
	 * WP Customize custom control
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Control_KFW extends WP_Customize_Control {

		/**
		 * Type
		 *
		 * @var string
		 */
		public $type = 'kfw';

		/**
		 * Field
		 *
		 * @var string
		 */
		public $field = '';

		/**
		 * Key
		 *
		 * @var string
		 */
		public $unique = '';

		/**
		 * Render content
		 *
		 * @return void
		 */
		protected function render() {

			$depend = '';
			$hidden = '';

			if ( ! empty( $this->field['dependency'] ) ) {
				$hidden  = ' kfw-dependency-control hidden';
				$depend .= ' data-controller="' . $this->field['dependency'][0] . '"';
				$depend .= ' data-condition="' . $this->field['dependency'][1] . '"';
				$depend .= ' data-value="' . $this->field['dependency'][2] . '"';
			}

			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control customize-control-' . $this->type . $hidden;

			echo wp_kses( '<li id="' . $id . '" class="' . $class . '"' . $depend . '>', kfw_allowed_html( array( 'li' ) ) );
			$this->render_content();
			echo wp_kses( '</li>', kfw_allowed_html( array( 'li' ) ) );

		}

		/**
		 * Render content
		 *
		 * @return void
		 */
		public function render_content() {

			$complex = array(
				'checkbox',
				'switcher',
				'text',
				'systeminfo',
				'group',
			);

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$custom     = ( ! empty( $this->field['customizer'] ) ) ? true : false;
			$is_complex = ( in_array( $this->field['type'], $complex ) ) ? true : false;
			$class      = ( $is_complex || $custom ) ? ' kfw-customize-complex' : '';
			$atts       = ( $is_complex || $custom ) ? ' data-unique-id="' . $this->unique . '" data-option-id="' . $field_id . '"' : '';

			if ( ! $is_complex && ! $custom ) {
				$this->field['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
			}

			$this->field['name'] = $this->settings['default']->id;

			$this->field['dependency'] = array();

			echo wp_kses( '<div class="kfw-customize-field' . $class . '"' . $atts . '>', kfw_allowed_html( array( 'div' ) ) );

			KFW::field( $this->field, $this->value(), $this->unique, 'customize' );

			echo wp_kses( '</div>', kfw_allowed_html( array( 'div' ) ) );

		}

	}
}
