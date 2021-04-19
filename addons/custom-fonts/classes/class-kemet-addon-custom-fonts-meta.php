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
			$prefix_page_opts = 'kemet_custom_font_options';
			$this->create_custom_fonts_meta( $prefix_page_opts );
		}

		/**
		 * Create Meta
		 *
		 * @param string $prefix meta prefix.
		 * @return void
		 */
		public function create_custom_fonts_meta( $prefix ) {

			KFW::create_metabox(
				$prefix,
				array(
					'title'     => __( 'Kemet Custom Font options', 'kemet-addons' ),
					'priority'  => 'high',
					'post_type' => array( KEMET_CUSTOM_FONTS_POST_TYPE ),
					'data_type' => 'serialize',
					'theme'     => 'light',
				)
			);

			KFW::create_section(
				$prefix,
				array(
					'priority_num' => 1,
					'fields'       => array(
						array(
							'id'    => 'font-name',
							'type'  => 'text',
							'title' => __( 'Font Name', 'kemet-addons' ),
						),
						array(
							'id'    => 'font-fallback',
							'type'  => 'text',
							'title' => __( 'Font Fallback', 'kemet-addons' ),
						),
						array(
							'id'      => 'font-display',
							'type'    => 'select',
							'title'   => __( 'Font Display', 'kemet-addons' ),
							'default' => 'auto',
							'options' => array(
								'auto'     => __( 'Auto', 'kemet-addons' ),
								'block'    => __( 'Block', 'kemet-addons' ),
								'swap'     => __( 'Swap', 'kemet-addons' ),
								'fallback' => __( 'Fallback', 'kemet-addons' ),
								'optional' => __( 'Optional', 'kemet-addons' ),
							),
						),
						array(
							'id'      => 'font-weight',
							'type'    => 'select',
							'title'   => __( 'Font Weight', 'kemet-addons' ),
							'default' => '400',
							'options' => array(
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
						),
						array(
							'id'    => 'woff-font',
							'type'  => 'upload',
							'title' => __( '.woff Font file', 'kemet-addons' ),
						),
						array(
							'id'    => 'woff2-font',
							'type'  => 'upload',
							'title' => __( '.woff2 Font file', 'kemet-addons' ),
						),
						array(
							'id'    => 'ttf-font',
							'type'  => 'upload',
							'title' => __( '.ttf Font file', 'kemet-addons' ),
						),
						array(
							'id'    => 'eot-font',
							'type'  => 'upload',
							'title' => __( '.eot Font file', 'kemet-addons' ),
						),
						array(
							'id'    => 'svg-font',
							'type'  => 'upload',
							'title' => __( '.svg Font file', 'kemet-addons' ),
						),
						array(
							'id'    => 'otf-font',
							'type'  => 'upload',
							'title' => __( '.otf Font file', 'kemet-addons' ),
						),
					),
				)
			);
		}
	}
}
Kemet_Addon_Custom_Fonts_Meta::get_instance();

