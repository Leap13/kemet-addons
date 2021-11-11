<?php
/**
 * Custom fonts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Custom_Fonts_Meta' ) ) {
	/**
	 * Custom_fonts options
	 */
	class Kemet_Addon_Custom_Fonts_Meta {

		/**
		 * Instance
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
		}

		/**
		 * get_item_fields
		 *
		 * @return array
		 */
		public function get_item_fields() {
			$fields = array(
				'font-type'           => array(
					'type'    => 'kmt-select',
					'default' => 'file',
					'label'   => __( 'Font Type', 'kemet-addons' ),
					'choices' => array(
						'file'      => __( 'Upload File', 'kemet-addons' ),
						'adobe-kit' => __( 'Adobe TypeKit', 'kemet-addons' ),
					),
				),
				'adobe-project-id'    => array(
					'type'    => 'kmt-text',
					'label'   => __( 'Adobe TypeKit Project ID', 'kemet-addons' ),
					'context' => array(
						array(
							'setting' => 'font-type',
							'value'   => 'adobe-kit',
						),
					),
				),
				'adobe-project-fonts' => array(
					'type'    => 'kmt-table',
					'label'   => __( 'Adobe TypeKit Project Fonts', 'kemet-addons' ),
					'data'    => $this->typekit_fonts(),
					'context' => array(
						array(
							'setting'  => 'adobe-project-id',
							'operator' => 'not_empty',
						),
						array(
							'setting' => 'font-type',
							'value'   => 'adobe-kit',
						),
					),
				),
				'font-name'           => array(
					'type'        => 'kmt-text',
					'label'       => __( 'Font Name', 'kemet-addons' ),
					'description' => __( 'The name of the font as it appears in the customizer options.', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'font-fallback'       => array(
					'type'        => 'kmt-text',
					'label'       => __( 'Font Fallback', 'kemet-addons' ),
					'description' => __( "Add the font's fallback names with comma(,) separator. eg. Helvetica, Arial", 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'font-display'        => array(
					'type'    => 'kmt-select',
					'label'   => __( 'Font Display', 'kemet-addons' ),
					'choices' => array(
						'auto'     => __( 'Auto', 'kemet-addons' ),
						'block'    => __( 'Block', 'kemet-addons' ),
						'swap'     => __( 'Swap', 'kemet-addons' ),
						'fallback' => __( 'Fallback', 'kemet-addons' ),
						'optional' => __( 'Optional', 'kemet-addons' ),
					),
					'context' => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'font-weight'         => array(
					'type'    => 'kmt-select',
					'label'   => __( 'Font Weight', 'kemet-addons' ),
					'choices' => array(
						'inherit' => __( 'Inherit', 'kemet-addons' ),
						'100'     => __( 'Thin 100', 'kemet-addons' ),
						'200'     => __( 'Extra-Light 200', 'kemet-addons' ),
						'300'     => __( 'Light 300', 'kemet-addons' ),
						'400'     => __( 'Normal 400', 'kemet-addons' ),
						'500'     => __( 'Medium 500', 'kemet-addons' ),
						'600'     => __( 'Semi-Bold 600', 'kemet-addons' ),
						'700'     => __( 'Bold 700', 'kemet-addons' ),
						'800'     => __( 'Extra-Bold 800', 'kemet-addons' ),
						'900'     => __( 'Ultra-Bold 900', 'kemet-addons' ),
					),
					'context' => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'woff-font'           => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.woff Font file', 'kemet-addons' ),
					'fontType'    => 'woff',
					'description' => __( 'Upload .woff file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'woff2-font'          => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.woff2 Font file', 'kemet-addons' ),
					'fontType'    => 'woff2',
					'description' => __( 'Upload .woff2 file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'ttf-font'            => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.ttf Font file', 'kemet-addons' ),
					'fontType'    => 'ttf',
					'description' => __( 'Upload .ttf file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'eot-font'            => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.eot Font file', 'kemet-addons' ),
					'fontType'    => '.eot',
					'description' => __( 'Upload .eot file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'svg-font'            => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.svg Font file', 'kemet-addons' ),
					'fontType'    => 'svg',
					'description' => __( 'Upload .svg file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
				'otf-font'            => array(
					'type'        => 'kmt-upload',
					'label'       => __( '.otf Font file', 'kemet-addons' ),
					'fontType'    => 'otf',
					'description' => __( 'Upload .otf file', 'kemet-addons' ),
					'context'     => array(
						array(
							'setting' => 'font-type',
							'value'   => 'file',
						),
					),
				),
			);

			return $fields;
		}

		/**
		 * get_defaults
		 *
		 * @return void
		 */
		public function get_defaults() {
			$defaults = array(
				'font-type' => 'file',
			);

			return $defaults;
		}

		/**
		 * Adobe web project fonts table
		 */
		public function typekit_fonts() {

			if ( $this->check_post_type() ) {
				$meta = get_post_meta( $this->check_post_type(), 'kemet_custom_font_options', true );
				if ( $meta ) {
					$font_type = $meta['font-type'];
					$html      = '';
					if ( 'adobe-kit' == $font_type && ! empty( $meta['adobe-project-id'] ) ) {
						return Kemet_Addon_Custom_Fonts_Partials::get_instance()->get_adobe_project( $meta['adobe-project-id'] );
					}
				}
			}

			return array();
		}

		/**
		 * Check post type in admin
		 *
		 * @return mixed
		 */
		public function check_post_type() {
			// Global object containing current admin page.
			global $pagenow;

			// If current page is post.php and post isset than query for its post type.
			// if the post type is 'event' do something.
			if ( 'post.php' === $pagenow && isset( $_GET['post'] ) && KEMET_CUSTOM_FONTS_POST_TYPE === get_post_type( $_GET['post'] ) ) { //phpcs:ignore
				return sanitize_text_field( wp_unslash( $_GET['post'] ) );
			}
			return false;
		}
	}
}
Kemet_Addon_Custom_Fonts_Meta::get_instance();

