<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'kfw_array_search' ) ) {
	function kfw_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {
				 $results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, kfw_array_search( $sub_array, $key, $value ) );
			}
		}

		return $results;

	}
}

/**
 *
 * Getting POST Var
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'kfw_get_var' ) ) {
	function kfw_get_var( $var, $default = '' ) {

		if ( isset( $_POST[ $var ] ) ) {
			return $_POST[ $var ];
		}

		if ( isset( $_GET[ $var ] ) ) {
			return $_GET[ $var ];
		}

		return $default;

	}
}

/**
 *
 * Getting POST Vars
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'kfw_get_vars' ) ) {
	function kfw_get_vars( $var, $depth, $default = '' ) {

		if ( isset( $_POST[ $var ][ $depth ] ) ) {
			return $_POST[ $var ][ $depth ];
		}

		if ( isset( $_GET[ $var ][ $depth ] ) ) {
			return $_GET[ $var ][ $depth ];
		}

		return $default;

	}
}

/**
 *
 * Between Microtime
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'kfw_microtime' ) ) {
	function kfw_timeout( $timenow, $starttime, $timeout = 30 ) {

		return ( ( $timenow - $starttime ) < $timeout ) ? true : false;

	}
}

/**
 *
 * Check for wp editor api
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'kfw_wp_editor_api' ) ) {
	function kfw_wp_editor_api() {

		global $wp_version;

		return version_compare( $wp_version, '4.8', '>=' );

	}
}

if ( ! function_exists( 'kfw_allowed_html' ) ) {
	/**
	 * Allowed HTML
	 *
	 * @param string $allowed_elements .
	 * @return mixed
	 */
	function kfw_allowed_html( $allowed_elements = '' ) {

		// bail early if parameter is empty.
		if ( empty( $allowed_elements ) ) {
			return array();
		}

		if ( is_string( $allowed_elements ) ) {
			$allowed_elements = explode( ',', $allowed_elements );
		}

		$allowed_html = array();

		$allowed_tags          = wp_kses_allowed_html( 'post' );
		$default_attrs         = array(
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'class'            => true,
			'id'               => true,
			'style'            => true,
			'title'            => true,
			'role'             => true,
			'data-*'           => true,
		);
		$allowed_tags['input'] = array_merge(
			$default_attrs, array(
				'disabled'     => array(),
				'name'         => array(),
				'readonly'     => array(),
				'value'        => array(),
				'autocomplete' => array(),
				'placeholder'  => array(),
				'type'         => array(),
				'checked'      => array(),
			)
		);
		$allowed_tags['form']  = array_merge(
			$default_attrs, array(
				'name'         => array(),
				'method'       => array(),
				'action'       => array(),
				'enctype'      => array(),
				'autocomplete' => array(),
			)
		);

		if ( 'all' == $allowed_elements ) {
			return $allowed_tags;
		}
		
		foreach ( $allowed_elements as $element ) {
			$element = trim( $element );
			if ( array_key_exists( $element, $allowed_tags ) ) {
				$allowed_html[ $element ] = $allowed_tags[ $element ];
			}
		}
		return $allowed_html;
	}
}

