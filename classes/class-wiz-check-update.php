<?php
/**
 * Loader Functions
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Wiz_Update' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Wiz_Update {
        /**
		 * The single class instance.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private static $_instance = null;

		/**
		 * Premium themes.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
        private static $themes = array();
        
        /**
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
        private $access_token;
        
        /**
		 *
		 * @since 1.0.0
		 * @static
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		/**
		 * Constructor
		 */
		public function __construct() {
            $this->set_access_token();
            // Check for theme & plugin updates.
			add_filter( 'http_request_args', array( $this, 'update_check' ), 5, 2 );
            // Inject theme updates into the response array.
			add_filter( 'pre_set_site_transient_update_themes', array( $this, 'update_themes' ), 1, 99999 );
            add_filter( 'pre_set_transient_update_themes', array( $this, 'update_themes' ), 1, 99999 );
            // @codeCoverageIgnoreEnd
			// Deferred Download.
			add_action( 'upgrader_package_options', array( $this, 'maybe_deferred_download' ), 9 );
        }
        
        private function set_access_token(){
            $refresh_token = get_option('wiz_refresh_token');
            $api_args = array(
                    'Content-Type' => 'application/json',
                    'timeout' => 100,
				);
            $data = array("token" => $refresh_token);
            $request = wp_remote_get( trailingslashit( 'https://demos.thenomadgeek.com/activation' ) . "?" . http_build_query($data) , $api_args );
            
            if ( 200 == (int) wp_remote_retrieve_response_code( $request ) ) {
                $access_token = json_decode(wp_remote_retrieve_body( $request ),true);
				$this->access_token = $access_token['access_token'];
			}
        }

        public function get_access_token(){
            return $this->access_token;
        }

        /**
		 * Defers building the API download url until the last responsible moment to limit file requests.
		 *
		 * Filter the package options before running an update.
		 *
		 * @param array $options {
		 *     Options used by the upgrader.
		 *
		 * @type string $package Package for update.
		 * @type string $destination Update location.
		 * @type bool   $clear_destination Clear the destination resource.
		 * @type bool   $clear_working Clear the working resource.
		 * @type bool   $abort_if_destination_exists Abort if the Destination directory exists.
		 * @type bool   $is_multi Whether the upgrader is running multiple times.
		 * @type array  $hook_extra Extra hook arguments.
		 * }
		 * @since 1.0.0
		 */
		public function maybe_deferred_download( $options ) {
            $this->set_access_token();
			$package = $options['package'];
			if ( false !== strrpos( $package, 'deferred_download' ) && false !== strrpos( $package, 'item_id' ) ) {
				parse_str( parse_url( $package, PHP_URL_QUERY ), $vars );
				if ( $vars['item_id'] ) {
					$args               = array(
                        'headers' => array(
                            'Authorization' => 'Bearer ' . $this->get_access_token(),
                        ),
                    );
					$options['package'] = $this->download( $vars['item_id'], $args );
				}
			}

			return $options;
        }
        
        /**
		 * Get the item download.
		 *
		 * @since 1.0.0
		 *
		 * @param  int   $id The item ID.
		 * @param  array $args The arguments passed to `wp_remote_get`.
		 * @return bool|array The HTTP response.
		 */
		public function download( $id, $args = array() ) {
			if ( empty( $id ) ) {
				return false;
			}

			$url      = 'https://api.envato.com/v2/market/buyer/download?item_id=' . $id . '&shorten_url=true';
			$response = $this->request( $url, $args );

			// @todo Find out which errors could be returned & handle them in the UI.
			if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) ) {
				return false;
			}

			if ( ! empty( $response['wordpress_theme'] ) ) {
				return $response['wordpress_theme'];
			}

			return false;
        }
        
        /**
		 * Disables requests to the wp.org repository for premium themes.
		 *
		 * @since 1.0.0
		 *
		 * @param array  $request An array of HTTP request arguments.
		 * @param string $url The request URL.
		 * @return array
		 */
		public function update_check( $request, $url ) {

			// Theme update request.
			if ( false !== strpos( $url, '//api.wordpress.org/themes/update-check/1.1/' ) ) {

				/**
				 * Excluded theme slugs that should never ping the WordPress API.
				 * We don't need the extra http requests for themes we know are premium.
				 */
				self::set_themes();
				$installed = self::$themes['installed'];

				// Decode JSON so we can manipulate the array.
				$data = json_decode( $request['body']['themes'] );

				// Remove the excluded themes.
				foreach ( $installed as $slug => $id ) {
					unset( $data->themes->$slug );
				}

				// Encode back into JSON and update the response.
				$request['body']['themes'] = wp_json_encode( $data );
			}

			return $request;
        }
        

        /**
		 * Inject update data for premium themes.
		 *
		 * @since 1.0.0
		 *
		 * @param object $transient The pre-saved value of the `update_themes` site transient.
		 * @return object
		 */
		public function update_themes( $transient ) {
			// Process premium theme updates.
			if ( isset( $transient->checked ) ) {
				self::set_themes( true );
				$installed = array_merge( self::$themes['active'], self::$themes['installed'] );
				foreach ( $installed as $slug => $premium ) {
					$theme = wp_get_theme( $slug );
					if ( $theme->exists() && version_compare( $theme->get( 'Version' ), $premium['version'], '<' ) ) {
						$transient->response[ $slug ] = array(
							'theme'       => $slug,
							'new_version' => $premium['version'],
							'url'         => $premium['url'],
							'package'     => $this->deferred_download( $premium['id'] ),
						);
					}
				}
			}

			return $transient;
        }
        
        /**
		 * Deferred item download URL.
		 *
		 * @since 1.0.0
		 *
		 * @param int $id The item ID.
		 * @return string.
		 */
		public function deferred_download( $id ) {
			if ( empty( $id ) ) {
				return '';
			}

			$args = array(
				'deferred_download' => true,
				'item_id'           => $id,
			);
			return add_query_arg( $args, esc_url( admin_url() ) );
        }
        
        /**
		 * Set the list of themes
		 *
		 * @since 1.0.0
		 *
		 * @param bool $forced Forces an API request. Default is 'false'.
		 * @param bool $use_cache Attempts to rebuild from the cache before making an API request.
		 */
		public function set_themes( $forced = false ) {

			self::$themes = get_site_transient( 'wiz_theme_update' );

			if ( false === self::$themes || true === $forced ) {
				$request_args = array(
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $this->get_access_token(),
                    ),
                );
                $request      = $this->item( '11975026', $request_args );
                if ( false !== $request ) {
                    $themes[] = $request;
                }
                if(!empty($themes)){
                    self::process_themes( $themes );
                }
			}
        }
        
        /**
		 * Get an item by ID and type.
		 *
		 * @since 1.0.0
		 *
		 * @param  int   $id The item ID.
		 * @param  array $args The arguments passed to `wp_remote_get`.
		 * @return array The HTTP response.
		 */
		public function item( $id, $args = array() ) {
			$url      = 'https://api.envato.com/v2/market/catalog/item?id=' . $id;
			$response = $this->request( $url, $args );

			if ( is_wp_error( $response ) || empty( $response ) ) {
				return false;
			}

			if ( ! empty( $response['wordpress_theme_metadata'] ) ) {
				return $this->normalize_theme( $response );
			}

			return false;
        }
        
        /**
		 * Normalize a theme.
		 *
		 * @since 1.0.0
		 *
		 * @param  array $theme An array of API request values.
		 * @return array A normalized array of values.
		 */
		public function normalize_theme( $theme ) {
			$normalized_theme = array(
				'id'            => $theme['id'],
				'name'          => ( ! empty( $theme['wordpress_theme_metadata']['theme_name'] ) ? $theme['wordpress_theme_metadata']['theme_name'] : '' ),
				'author'        => ( ! empty( $theme['wordpress_theme_metadata']['author_name'] ) ? $theme['wordpress_theme_metadata']['author_name'] : '' ),
				'version'       => ( ! empty( $theme['wordpress_theme_metadata']['version'] ) ? $theme['wordpress_theme_metadata']['version'] : '' ),
				'description'   => self::remove_non_unicode( strip_tags( $theme['wordpress_theme_metadata']['description'] ) ),
				'url'           => ( ! empty( $theme['url'] ) ? $theme['url'] : '' ),
				'author_url'    => ( ! empty( $theme['author_url'] ) ? $theme['author_url'] : '' ),
				'thumbnail_url' => ( ! empty( $theme['thumbnail_url'] ) ? $theme['thumbnail_url'] : '' ),
				'rating'        => ( ! empty( $theme['rating'] ) ? $theme['rating'] : '' ),
				'landscape_url' => '',
			);

			// No main thumbnail in API response, so we grab it from the preview array.
			if ( empty( $normalized_theme['thumbnail_url'] ) && ! empty( $theme['previews'] ) && is_array( $theme['previews'] ) ) {
				foreach ( $theme['previews'] as $possible_preview ) {
					if ( ! empty( $possible_preview['landscape_url'] ) ) {
						$normalized_theme['landscape_url'] = $possible_preview['landscape_url'];
						break;
					}
				}
			}
			if ( empty( $normalized_theme['thumbnail_url'] ) && ! empty( $theme['previews'] ) && is_array( $theme['previews'] ) ) {
				foreach ( $theme['previews'] as $possible_preview ) {
					if ( ! empty( $possible_preview['icon_url'] ) ) {
						$normalized_theme['thumbnail_url'] = $possible_preview['icon_url'];
						break;
					}
				}
			}

			return $normalized_theme;
        }
        
        /**
		 * Remove all non unicode characters in a string
		 *
		 * @since 1.0.0
		 *
		 * @param string $retval The string to fix.
		 * @return string
		 */
		static private function remove_non_unicode( $retval ) {
			return preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $retval );
        }
        
        /**
		 * Process the themes and save the transient.
		 *
		 * @since 1.0.0
		 *
		 * @param array $purchased The purchased themes array.
		 */
		private function process_themes( $purchased ) {
			if ( is_wp_error( $purchased ) ) {
				$purchased = array();
			}

			$current   = wp_get_theme()->get_template();
			$active    = array();
			$installed = array();
			$install   = $purchased;

			if ( ! empty( $purchased ) ) {
				foreach ( wp_get_themes() as $theme ) {

					/**
					 * WP_Theme object.
					 *
					 * @var WP_Theme $theme
					 */
					$template = $theme->get_template();
					$title    = $theme->get( 'Name' );
					$author   = $theme->get( 'Author' );

					foreach ( $install as $key => $value ) {
						if ( $this->normalize( $value['name'] ) === $this->normalize( $title ) && $this->normalize( $value['author'] ) === $this->normalize( $author ) ) {
							$installed[ $template ] = $value;
							unset( $install[ $key ] );
						}
					}
				}
			}

			if ( isset( $installed[ $current ] ) ) {
				$active[ $current ] = $installed[ $current ];
				unset( $installed[ $current ] );
			}

			self::$themes['purchased'] = array_unique( $purchased, SORT_REGULAR );
			self::$themes['active']    = array_unique( $active, SORT_REGULAR );
			self::$themes['installed'] = array_unique( $installed, SORT_REGULAR );
			self::$themes['install']   = array_unique( array_values( $install ), SORT_REGULAR );

			set_site_transient( 'wiz_theme_update', self::$themes, DAY_IN_SECONDS );
        }
        
        /**
		 * Normalizes a string to do a value check against.
		 *
		 * Strip all HTML tags including script and style & then decode the
		 * HTML entities so `&amp;` will equal `&` in the value check and
		 * finally lower case the entire string. This is required becuase some
		 * themes & plugins add a link to the Author field or ambersands to the
		 * names, or change the case of their files or names, which will not match
		 * the saved value in the database causing a false negative.
		 *
		 * @since 1.0.0
		 *
		 * @param string $string The string to normalize.
		 * @return string
		 */
		public function normalize( $string ) {
			return strtolower( html_entity_decode( wp_strip_all_tags( $string ) ) );
        }
        
        /**
		 * Query the Envato API.
		 *
		 * @uses wp_remote_get() To perform an HTTP request.
		 *
		 * @since 1.0.0
		 *
		 * @param  string $url API request URL, including the request method, parameters, & file type.
		 * @param  array  $args The arguments passed to `wp_remote_get`.
		 * @return array|WP_Error  The HTTP response.
		 */
		public function request( $url, $args = array() ) {
            global $wp_version;
			$defaults = array(
				'headers' => array(
					'Authorization' => 'Bearer ' . $this->get_access_token(),
					'User-Agent'    => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() ),
				),
				'timeout' => 14,
			);
			$args     = wp_parse_args( $args, $defaults );

			$token = trim( str_replace( 'Bearer', '', $args['headers']['Authorization'] ) );
			if ( empty( $token ) ) {
				return new WP_Error( 'api_token_error', __( 'An API token is required.', 'kemet' ) );
			}

			$debugging_information = [
				'request_url' => $url,
			];

			// Make an API request.
			$response = wp_remote_get( esc_url_raw( $url ), $args );

			// Check the response code.
			$response_code    = wp_remote_retrieve_response_code( $response );
			$response_message = wp_remote_retrieve_response_message( $response );

			$debugging_information['response_code']   = $response_code;
			$debugging_information['response_cf_ray'] = wp_remote_retrieve_header( $response, 'cf-ray' );
			$debugging_information['response_server'] = wp_remote_retrieve_header( $response, 'server' );

			if ( ! empty( $response->errors ) && isset( $response->errors['http_request_failed'] ) ) {
				// API connectivity issue, inject notice into transient with more details.
				$option = envato_market()->get_options();
				if ( empty( $option['notices'] ) ) {
					$option['notices'] = [];
				}
				$option['notices']['http_error'] = current( $response->errors['http_request_failed'] );
				envato_market()->set_options( $option );
				return new WP_Error( 'http_error', esc_html( current( $response->errors['http_request_failed'] ) ), $debugging_information );
			}

			if ( 200 !== $response_code && ! empty( $response_message ) ) {
				return new WP_Error( $response_code, $response_message, $debugging_information );
			} elseif ( 200 !== $response_code ) {
				return new WP_Error( $response_code, __( 'An unknown API error occurred.', 'kemet' ), $debugging_information );
			} else {
				$return = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( null === $return ) {
					return new WP_Error( 'api_error', __( 'An unknown API error occurred.', 'kemet' ), $debugging_information );
				}
				return $return;
			}
		}

	}
    Wiz_Update::instance();
	
}
