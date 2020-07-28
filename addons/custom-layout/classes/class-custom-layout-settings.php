<?php
/**
 * Custom Layout
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Custom_Layout_Settings' )) {
    /**
	 * Custom_Layout Settings
	 *
	 * @since 1.1.0
	 */
    class Kemet_Custom_Layout_Settings {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        public function __construct() {
			add_action( 'init', array( $this, 'custom_post_type' ) );
			add_filter( 'single_template', array( $this, 'get_custom_layout_template' ) );
			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_custom_layout_item' ), 1 );
			}
		}
		
		/**
		 * Custom layout template.
		 *
		 * @param  string $template Single Post template path.
		 * @return string
		 */
		public function get_custom_layout_template( $template ) {
			global $post;

			$post_id = get_the_id();
			$meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
			$layout = ( isset( $meta['layout-position'] ) ) ? $meta['layout-position'] : '';
			$action = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';

			$woocommerce_hooks     = array( 'woo-global', 'woo-shop', 'woo-product', 'woo-cart', 'woo-checkout', 'woo-distraction-checkout', 'woo-account' );
			$woocommerce_is_activated = false;

			if ( KEMET_CUSTOM_LAYOUT_POST_TYPE == $post->post_type ) {
				if ( 'hooks' === $layout ) {
					foreach ( Kemet_Custom_Layout_Partials::get_hooks() as $key => $value ) {
						if ( in_array( $key, $woocommerce_hooks ) && isset( Kemet_Custom_Layout_Partials::get_hooks()[ $key ]['hooks'][ $action ] ) ) {
							$woocommerce_is_activated = true;
						}
					}
				}

				if ( ( 'hooks' === $layout && false == $woocommerce_is_activated ) ) {
					$template = KEMET_CUSTOM_LAYOUT_DIR . 'templates/template.php';
				}
			}
			
			return $template;	
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.1.0
		 */
		public function add_custom_layout_item() {
	
			// Name
			add_submenu_page(
				'kmt-framework',
				esc_html__( 'Custom Layouts', 'kemet-addons' ),
				esc_html__( 'Custom Layouts', 'kemet-addons' ),
				'manage_options',
				'edit.php?post_type='.KEMET_CUSTOM_LAYOUT_POST_TYPE
			);
	
		}    
		/**
		 * Register post type
		 *
		 * @since 1.1.0
		 */
		public static function custom_post_type() {
	
			// Register the post type
			register_post_type( KEMET_CUSTOM_LAYOUT_POST_TYPE , apply_filters( 'kemet_custon_layouts_args', array(
					'labels' => array(
						'name'          => esc_html__( 'Custom Layouts', 'Custom Layouts General Name', 'kemet-addons' ),
						'singular_name' => esc_html__( 'Custom Layout', 'Custom Layouts Singular Name', 'kemet-addons' ),
						'search_items'  => esc_html__( 'Search Custom Layouts', 'kemet-addons' ),
						'all_items'     => esc_html__( 'All Custom Layouts', 'kemet-addons' ),
						'edit_item'     => esc_html__( 'Edit Custom Layout', 'kemet-addons' ),
						'view_item'     => esc_html__( 'View Custom Layout', 'kemet-addons' ),
						'add_new'       => esc_html__( 'Add New', 'kemet-addons' ),
						'update_item'   => esc_html__( 'Update Custom Layout', 'kemet-addons' ),
						'add_new_item'  => esc_html__( 'Add New', 'kemet-addons' ),
						'new_item_name' => esc_html__( 'New Custom Layout Name', 'kemet-addons' ),			
					),
					'public' 					=> true,
					'hierarchical'          	=> false,
					'show_ui'               	=> true,
					'show_in_menu' 				=> false,
					'show_in_nav_menus'     	=> false,
					'can_export'            	=> true,
					'exclude_from_search'   	=> true,
					'capability_type' 			=> 'post',
					'rewrite' 					=> false,
					'supports' 					=> array( 'title', 'editor', 'thumbnail', 'author', 'elementor' ),
					) 
				) 
			);

		}
    }
}
Kemet_Custom_Layout_Settings::get_instance();