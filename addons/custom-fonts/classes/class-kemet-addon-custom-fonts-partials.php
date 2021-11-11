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
			add_action( 'kemet_custom_fonts', array( $this, 'add_custom_fonts_to_customizer' ) );
			add_action( 'wp_head', array( $this, 'fonts_css' ) );
			if ( is_admin() ) {
				add_action( 'enqueue_block_assets', array( $this, 'fonts_css' ) );
			}
			add_filter( 'elementor/fonts/groups', array( $this, 'register_fonts_groups' ) );
			add_filter( 'elementor/fonts/additional_fonts', array( $this, 'register_fonts_in_elementor' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'adobe_fonts_css' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'adobe_fonts_css' ), 100 );
			add_action( 'add_meta_boxes', array( $this, 'add_custom_box' ) );
			add_action( 'admin_print_scripts-post-new.php', array( $this, 'admin_scripts' ) );
			add_action( 'admin_print_scripts-post.php', array( $this, 'admin_scripts' ) );
			add_action( 'save_post', array( $this, 'save_postdata' ) );
		}

		/**
		 * save_postdata
		 *
		 * @param  int $post_id
		 */
		function save_postdata( $post_id ) {
			if ( array_key_exists( 'kemet_custom_font_options', $_POST ) ) {
				$value = json_decode( stripslashes( $_POST['kemet_custom_font_options'] ), true );
				update_post_meta(
					$post_id,
					'kemet_custom_font_options',
					$value
				);
			}
		}

		function add_custom_box() {
			add_meta_box(
				'kemet_meta',
				'Font Settings',
				array( $this, 'custom_box_html' ),
				KEMET_CUSTOM_FONTS_POST_TYPE,
				'advanced',
				'high',
				null
			);
		}

		/**
		 * custom_box_html
		 *
		 * @param  object $post
		 */
		public function custom_box_html( $post ) {
			$value = get_post_meta( $post->ID, 'kemet_custom_font_options', true );
			?>
			<div id="kmt-custom-fonts-meta">
				<input id="kmt-font-meta" type="hidden" name="kemet_custom_font_options" value='<?php echo wp_json_encode( $value ); ?>'>
				<div id="kmt-meta-box" data-id="<?php echo esc_attr( $post->ID ); ?>"></div>
			</div>
			<?php
		}

		/**
		 * admin_scripts
		 */
		public function admin_scripts() {
			global $post_type;
			if ( KEMET_CUSTOM_FONTS_POST_TYPE == $post_type ) {
				$css_prefix = '.min.css';
				$dir        = 'minified';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '.css';
					$dir        = 'unminified';
				}
				if ( is_rtl() ) {
					$css_prefix = '-rtl.min.css';
					if ( SCRIPT_DEBUG ) {
						$css_prefix = '-rtl.css';
					}
				}
				wp_enqueue_style( 'kemet-custom-fonts-css', KEMET_CUSTOM_FONTS_URL . 'assets/css/' . $dir . '/custom-fonts' . $css_prefix, false, KEMET_ADDONS_VERSION );
				wp_enqueue_script(
					'kemet-custom-font-admin-script',
					KEMET_CUSTOM_FONTS_URL . 'assets/js/build/index.js',
					array(
						'wp-edit-post',
						'wp-i18n',
						'wp-components',
						'wp-element',
						'wp-media-utils',
						'wp-block-editor',
					),
					KEMET_ADDONS_VERSION,
					true
				);

				wp_localize_script(
					'kemet-custom-font-admin-script',
					'kemetCustomFont',
					apply_filters(
						'kemet_addons_custom_font_js_localize',
						array(
							'ajax_url'   => admin_url( 'admin-ajax.php' ),
							'ajax_nonce' => wp_create_nonce( 'kemet-addons-custom-font' ),
							'options'    => Kemet_Addon_Custom_Fonts_Meta::get_instance()->get_item_fields(),
							'defaults'   => Kemet_Addon_Custom_Fonts_Meta::get_instance()->get_defaults(),
						)
					)
				);
			}
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
		 * @param array $elementor_fonts elementor fonts.
		 * @return array
		 */
		public function register_fonts_in_elementor( $elementor_fonts ) {

			$fonts = $this->get_all_fonts();

			foreach ( $fonts as $custom_font => $font_values ) {
				$font_name                     = $font_values['font-name'];
				$elementor_fonts[ $font_name ] = 'kemet-custom-fonts';
			}

			$adobe_fonts = $this->get_adobe_fonts();
			if ( ! empty( $adobe_fonts ) ) {
				foreach ( $adobe_fonts as $adobe_font => $font_values ) {
					$elementor_fonts[ $adobe_font ] = 'kemet-custom-fonts';
				}
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

				if ( ( isset( $font['font-type'] ) && 'file' == $font['font-type'] ) && ( isset( $font['font-name'] ) && ! empty( $font['font-name'] ) ) ) {
					$fonts[ $font['font-name'] . '-' . $font['font-weight'] ] = $font;
				}
			}

			return $fonts;
		}

		/**
		 * Get adobe fonts
		 *
		 * @return array
		 */
		public function get_adobe_fonts() {
			$args      = array(
				'post_type' => KEMET_CUSTOM_FONTS_POST_TYPE,
			);
			$all_fonts = get_posts( $args );
			$fonts     = array();
			foreach ( $all_fonts as $font ) {
				$font = get_post_meta( $font->ID, 'kemet_custom_font_options', true );
				if ( ( isset( $font['font-type'] ) && 'adobe-kit' == $font['font-type'] ) && ( isset( $font['adobe-project-id'] ) && ! empty( $font['adobe-project-id'] ) ) ) {
					$project_id = $font['adobe-project-id'];
					$data       = $this->get_adobe_project( $project_id );
					foreach ( $data['kit']['families'] as $font_family ) {
						$css_names     = isset( $font_family['css_names'][0] ) ? $font_family['css_names'][0] : $font_family['slug'];
						$font_fallback = isset( $font_family['css_names'] ) && is_array( $font_family['css_names'] ) ? end( $font_family['css_names'] ) : 'sans-serif';
						$variations    = $font_family['variations'];
						$weights       = array();
						foreach ( $variations as $variation ) {
							$font_variations = str_split( $variation );
							$weight          = $font_variations[1] . '00';
							if ( ! in_array( $weight, $weights ) ) {
								$weights[] = $weight;
							}
						}
						sort( $weights );
						$fonts[ $font_family['slug'] ] = array(
							'fallback' => $font_fallback,
							'weights'  => $this->change_variations( $weights ),
						);
					}
				}
			}

			return $fonts;
		}
		/**
		 * Get adobe project details
		 *
		 * @param string $project_id adobe web project id.
		 * @return array
		 */
		public function get_adobe_project( $project_id ) {
			$api_args = array(
				'timeout' => 100,
			);

			$request = wp_remote_get( 'https://typekit.com/api/v1/json/kits/' . $project_id . '/published', $api_args );

			if ( ! is_wp_error( $request ) && 200 === (int) wp_remote_retrieve_response_code( $request ) ) {
				$font_data = json_decode( wp_remote_retrieve_body( $request ), true );
				return $font_data;
			} else {
				return array();
			}
		}
		/**
		 * Add custom fonts to customizer
		 *
		 * @param array $system_fonts theme system fonts.
		 * @return array
		 */
		public function add_custom_fonts_to_customizer( $system_fonts ) {
			$fonts = $this->get_all_fonts();
			foreach ( $fonts as $custom_font => $font_values ) {
				$font_name = $font_values['font-name'];
				if ( isset( $system_fonts[ $font_name ] ) && ! in_array( $font_values['font-weight'], $system_fonts[ $font_name ]['weights'] ) ) {
					$system_fonts[ $font_name ]['weights'][] = $font_values['font-weight'];
					sort( $system_fonts[ $font_name ]['weights'] );
				} else {
					$system_fonts[ $font_name ] = array(
						'fallback' => ! empty( $font_values['font-fallback'] ) ? $font_values['font-fallback'] : 'Helvetica, Arial, sans-serif',
						'weights'  => array( $font_values['font-weight'] ),
					);
				}
				if ( isset( $system_fonts[ $font_name ]['weights'] ) ) {
					$system_fonts[ $font_name ]['weights'] = $this->change_variations( $system_fonts[ $font_name ]['weights'] );
				}
			}
			$adobe_fonts = $this->get_adobe_fonts();
			if ( ! empty( $adobe_fonts ) ) {
				$system_fonts = array_merge( $system_fonts, $adobe_fonts );
			}

			error_log( wp_json_encode( $system_fonts ) );

			return $system_fonts;
		}

		private function change_variations( $structure ) {
			$result = array();

			foreach ( $structure as $weight ) {
				$result[] = $this->get_weight( $weight );
			}

			return $result;
		}

		private function get_weight( $code ) {
			$prefix = 'n';
			$sufix  = '4';

			$value = strtolower( trim( $code ) );
			$value = str_replace( ' ', '', $value );

			// Only number.
			if ( is_numeric( $value ) && isset( $value[0] ) ) {
				$sufix  = $value[0];
				$prefix = 'n';
			}

			// Italic.
			if ( preg_match( '#italic#', $value ) ) {
				if ( 'italic' === $value ) {
					$sufix  = 4;
					$prefix = 'i';
				} else {
					$value = trim( str_replace( 'italic', '', $value ) );
					if ( is_numeric( $value ) && isset( $value[0] ) ) {
						$sufix  = $value[0];
						$prefix = 'i';
					}
				}
			}

			// Regular.
			if ( preg_match( '#regular|normal#', $value ) ) {
				if ( 'regular' === $value ) {
					$sufix  = 4;
					$prefix = 'n';
				} else {
					$value = trim( str_replace( array( 'regular', 'normal' ), '', $value ) );

					if ( is_numeric( $value ) && isset( $value[0] ) ) {
						$sufix  = $value[0];
						$prefix = 'n';
					}
				}
			}

			return "{$prefix}{$sufix}";
		}

		/**
		 * Adobe fonts css
		 *
		 * @return void
		 */
		public function adobe_fonts_css() {
			$args      = array(
				'post_type' => KEMET_CUSTOM_FONTS_POST_TYPE,
			);
			$all_fonts = get_posts( $args );
			$fonts     = array();
			foreach ( $all_fonts as $font ) {
				$custom_font = get_post_meta( $font->ID, 'kemet_custom_font_options', true );
				if ( ( isset( $custom_font['font-type'] ) && 'adobe-kit' == $custom_font['font-type'] ) && ( isset( $custom_font['adobe-project-id'] ) && ! empty( $custom_font['adobe-project-id'] ) ) ) {
					wp_enqueue_style( 'custom-typekit-' . $font->ID, sprintf( 'https://use.typekit.net/%s.css', $custom_font['adobe-project-id'] ), array(), KEMET_ADDONS_VERSION );
				}
			}
		}
		/**
		 * Fonts css
		 *
		 * @return void
		 */
		public function fonts_css() {
			$css = $this->render_fonts_css();

			printf( "<style type='text/css' class='kemet-custom-fonts'>%s</style>", $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		/**
		 * Render fonts css
		 *
		 * @return string
		 */
		public function render_fonts_css() {
			$fonts    = $this->get_all_fonts();
			$font_css = '';
			foreach ( $fonts as $custom_font => $font_values ) {
				$font_name     = $font_values['font-name'];
				$font_display  = '';
				$font_fallback = '';
				$font_weight   = '';
				$font_family   = $font_name;
				$font          = array();
				if ( ! empty( $font_values['font-fallback'] ) ) {
					$font_fallback = $font_values['font-fallback'];
				}
				if ( ! empty( $font_values['font-display'] ) ) {
					$font_display = $font_values['font-display'];
				}
				if ( ! empty( $font_values['font-weight'] ) ) {
					$font_weight                         = $font_values['font-weight'];
					$font[ $font_values['font-weight'] ] = array();
				}
				if ( ! empty( $font_values['woff-font'] ) ) {
					$font[ $font_values['font-weight'] ][0] = 'url(' . esc_url( $font_values['woff-font'] ) . ") format('woff')";
				}
				if ( ! empty( $font_values['woff2-font'] ) ) {
					$font[ $font_values['font-weight'] ][1] = 'url(' . esc_url( $font_values['woff2-font'] ) . ") format('woff2')";
				}
				if ( ! empty( $font_values['ttf-font'] ) ) {
					$font[ $font_values['font-weight'] ][2] = 'url(' . esc_url( $font_values['ttf-font'] ) . ") format('TrueType')";
				}
				if ( ! empty( $font_values['eot-font'] ) ) {
					$font[ $font_values['font-weight'] ][3] = 'url(' . esc_url( $font_values['eot-font'] ) . ") format('eot')";
				}
				if ( ! empty( $font_values['svg-font'] ) ) {
					$font[ $font_values['font-weight'] ][4] = 'url(' . esc_url( $font_values['svg-font'] ) . ") format('svg')";
				}
				if ( ! empty( $font_values['otf-font'] ) ) {
					$font[ $font_values['font-weight'] ][5] = 'url(' . esc_url( $font_values['otf-font'] ) . ") format('OpenType')";
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
