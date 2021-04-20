<?php
/**
 * Custom Fonts
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Custom_Fonts_Partials' ) ) {
	/**
	 * Custom_Layout Partials
	 */
	class Kemet_Addon_Custom_Fonts_Partials {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
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
			add_filter( 'upload_mimes', array( $this, 'allow_font_mimes' ) );
			add_filter( 'mime_types', array( $this, 'allow_font_mimes' ) );
			add_filter( 'wp_check_filetype_and_ext', array( $this, 'update_mime_types' ), 10, 3 );
			add_action( 'kemet_render_fonts', array( $this, 'render_fonts' ) );
			add_action( 'kemet_system_fonts', array( $this, 'add_custom_fonts_to_customizer' ) );
			add_action( 'wp_head', array( $this, 'fonts_css' ) );
			if ( is_admin() ) {
				add_action( 'enqueue_block_assets', array( $this, 'fonts_css' ) );
			}
			add_filter( 'elementor/fonts/groups', array( $this, 'register_fonts_groups' ) );
			add_filter( 'elementor/fonts/additional_fonts', array( $this, 'register_fonts_in_elementor' ) );
		}

		/**
		 * Add custom fonts to elementor
		 *
		 * @param array $font_groups elementor fonts groups.
		 * @return array
		 */
		public function register_fonts_groups( $font_groups ) {
			$new_group                       = array();
			$new_group['kemet-custom-fonts'] = __( 'Kemet Fonts', 'kemet-addons' );

			return array_merge( $new_group, $font_groups );
		}

		/**
		 * Add custom fonts to elementor fonts
		 *
		 * @param array $fonts elementor fonts.
		 * @return array
		 */
		public function register_fonts_in_elementor( $elementor_fonts ) {

			$fonts = $this->get_all_fonts();

			foreach ( $fonts as $font_name => $values ) {
				$elementor_fonts[ $font_name ] = 'kemet-custom-fonts';
			}

			return $elementor_fonts;
		}

		/**
		 * Render in theme fonts
		 *
		 * @param array $theme_fonts kemet theme fonts.
		 * @return array
		 */
		public function render_fonts( $theme_fonts ) {
			$fonts = $this->get_all_fonts();

			foreach ( $theme_fonts  as $font_name => $font ) {
				if ( array_key_exists( $font_name, $fonts ) ) {
					unset( $theme_fonts[ $font_name ] );
				}
			}
			return $theme_fonts;
		}

		/**
		 * Allow Upload font ext
		 *
		 * @param array $mimes array of mimes.
		 * @return array
		 */
		public function allow_font_mimes( $mimes ) {
			// New allowed mime types.
			$mimes['woff']  = 'application/x-font-woff';
			$mimes['woff2'] = 'application/x-font-woff2';
			$mimes['ttf']   = 'application/x-font-ttf';
			$mimes['svg']   = 'image/svg+xml';
			$mimes['eot']   = 'application/vnd.ms-fontobject';
			$mimes['otf']   = 'font/otf';

			return $mimes;
		}

		/**
		 * Update mimes types
		 *
		 * @param array  $types types.
		 * @param string $file file.
		 * @param string $filename file name.
		 * @param object $mimes mimes.
		 * @return object
		 */
		public function update_mime_types( $types, $file, $filename ) {
			if ( 'ttf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
				$types['type'] = 'application/x-font-ttf';
				$types['ext']  = 'ttf';
			}

			if ( 'otf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
				$types['type'] = 'application/x-font-otf';
				$types['ext']  = 'otf';
			}

			return $types;
		}

		/**
		 * Get all custom fonts
		 *
		 * @return array
		 */
		public function get_all_fonts() {
			$args      = array(
				'post_type' => KEMET_CUSTOM_FONTS_POST_TYPE,
			);
			$all_fonts = get_posts( $args );
			$fonts     = array();
			foreach ( $all_fonts as $font ) {
				$font = get_post_meta( $font->ID, 'kemet_custom_font_options', true );
				if ( isset( $font['font-name'] ) && ! empty( $font['font-name'] ) ) {
					$fonts[ $font['font-name'] ] = $font;
				}
			}

			return $fonts;
		}

		/**
		 * Add custom fonts to customizer
		 *
		 * @param array $system_fonts theme system fonts.
		 * @return array
		 */
		public function add_custom_fonts_to_customizer( $system_fonts ) {
			$fonts = $this->get_all_fonts();

			foreach ( $fonts as $font_name => $values ) {
				$system_fonts[ $font_name ] = array(
					'fallback' => ! empty( $values['font-fallback'] ) ? $values['font-fallback'] : 'Helvetica, Arial, sans-serif',
					'weights'  => array( $values['font-weight'] ),
				);
			}

			return $system_fonts;
		}

		/**
		 * Fonts css
		 *
		 * @return void
		 */
		public function fonts_css() {
			$css = $this->render_fonts_css();

			printf( "<style type='text/css' class='kemet-custom-fonts'>%s</style>", $css );
		}
		/**
		 * Render fonts css
		 *
		 * @return string
		 */
		public function render_fonts_css() {
			$fonts    = $this->get_all_fonts();
			$font_css = '';
			foreach ( $fonts as $font_name => $values ) {
				$font_display  = '';
				$font_fallback = '';
				$font_weight   = '';
				$font_family   = $font_name;
				$font          = array();
				if ( ! empty( $values['font-fallback'] ) ) {
					$font_fallback = $values['font-fallback'];
				}
				if ( ! empty( $values['font-display'] ) ) {
					$font_display = $values['font-display'];
				}
				if ( ! empty( $values['font-weight'] ) ) {
					$font_weight                    = $values['font-weight'];
					$font[ $values['font-weight'] ] = array();
				}
				if ( ! empty( $values['woff-font'] ) ) {
					$font[ $values['font-weight'] ][0] = 'url(' . esc_url( $values['woff-font'] ) . ") format('woff')";
				}
				if ( ! empty( $values['woff2-font'] ) ) {
					$font[ $values['font-weight'] ][1] = 'url(' . esc_url( $values['woff2-font'] ) . ") format('woff2')";
				}
				if ( ! empty( $values['ttf-font'] ) ) {
					$font[ $values['font-weight'] ][2] = 'url(' . esc_url( $values['ttf-font'] ) . ") format('TrueType')";
				}
				if ( ! empty( $values['eot-font'] ) ) {
					$font[ $values['font-weight'] ][3] = 'url(' . esc_url( $values['eot-font'] ) . ") format('eot')";
				}
				if ( ! empty( $values['svg-font'] ) ) {
					$font[ $values['font-weight'] ][4] = 'url(' . esc_url( $values['svg-font'] ) . ") format('svg')";
				}
				if ( ! empty( $values['otf-font'] ) ) {
					$font[ $values['font-weight'] ][5] = 'url(' . esc_url( $values['otf-font'] ) . ") format('OpenType')";
				}

				foreach ( $font as $key => $value ) {
					$font_css      .= '@font-face {';
					$font_css      .= 'font-family: "' . $font_family . '";';
					$font_css      .= 'font-display: ' . $font_display . ';';
					$font_css      .= 'font-fallback: ' . $font_fallback . ';';
					$font_css      .= 'font-weight: ' . $key . ';';
					$font_src_array = array();
					foreach ( $value as $font_file ) {
						array_push( $font_src_array, $font_file );
					}

					$font_css .= 'src: ' . implode( ', ', $font_src_array ) . ';';

					$font_css .= '} ';
				}
			}

			return $font_css;
		}
	}
}
Kemet_Addon_Custom_Fonts_Partials::get_instance();
