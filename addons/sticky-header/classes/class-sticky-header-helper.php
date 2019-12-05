<?php


/**
 * Customizer Partials
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Kemet_Sticky_Header_Helper' ) ) {

	/**
	 * Customizer Partials initial setup
	 */
	class Kemet_Sticky_Header_Helper {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() { }

		/**
		 * Render Stickt Header Custom Logo
		 */
		function _sticky_header() {
			$sticky_logo          = kemet_get_option( 'sticky-logo' );

			if ( '' !== $sticky_logo ) {
			$custom_logo_id = attachment_url_to_postid( $sticky_logo );
			$html           .= sprintf(
                    '<a href="%1$s" class="sticky-custom-logo-link" rel="home" itemprop="url">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    wp_get_attachment_image(
                        $custom_logo_id, 'full', false, array(
                            'class' => 'custom-logo',
                        )
                    )
                );
            }
            $header_transparent       = kemet_get_option( 'enable-transparent' );
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo              = kemet_get_option( 'sticky-logo' );
            $sticky_responsive        = kemet_get_option('sticky-responsive');
            if( $enabled_sticky ) {
			$classes[] = 'kmt-sticky-header';
            }

            if ( '' !== $sticky_logo ) {
                $classes[] = 'kmt-sticky-logo';
            }

            $classes[] =  $sticky_responsive;

            function kmt_dep_sticky() {
                if ( kemet_get_option( 'enable-sticky' ) ) {
                    return true;
                } else {
                    return false;
                }
            }



           // return $html;

		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Sticky_Header_Helper::get_instance();
