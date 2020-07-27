<?php
/**
 * Custom Layout
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Custom_Layout_Partials')) {

    class Kemet_Custom_Layout_Partials {

        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        /**
         * Initiator
         */
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            add_action( 'do_meta_boxes', array( $this, 'remove_kemet_page_options' ) );
            add_filter( 'single_template', array( $this, 'get_custom_layout_template' ) );
            add_filter( 'kemet_addons_custom_layout_template', array( $this, 'default_content' ) );
            add_filter( 'wp', array( $this, 'layout' ) );
        }

        
		/**
		 * Remove Kemet Meta Box
		 */
		public function remove_kemet_page_options() {
            remove_meta_box( 'kemet_page_options', KEMET_CUSTOM_LAYOUT_POST_TYPE , 'side' );
            
        }

        /**
		 * Custom layout template.
		 *
		 * @param  string $template Single Post template path.
		 * @return string
		 */
		public function get_custom_layout_template( $template ) {

            
			$template =  KEMET_CUSTOM_LAYOUT_DIR . '/templates/template.php';
            
			return $template;
        }
        
        
		/**
		 * Empty Content area.
		 *
		 * @return void
		 */
		public function default_content() {
			$post_id = get_the_id();
			$meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
            $layout = ( isset( $meta['layout-position'] ) ) ? $meta['layout-position'] : '';
			if ( empty( $layout ) ) {
				the_content();
			}
        }
        
        /**
		 * Get layout
		 */
		public function get_layout() {
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		}


        /**
		 *  Layout Position
		 *
		 */
		function layout() {

            if ( is_singular( KEMET_CUSTOM_LAYOUT_POST_TYPE ) ) {

                $post_id  = get_the_id();

                $meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
                $layout = ( isset( $meta['layout-position'] ) ) ? $meta['layout-position'] : '';
                
                if ( $layout == 'header-layout' ) {

                    remove_action( 'kemet_header', 'kemet_header_markup' );

                    add_action( 'kemet_header', 
                    function() use ( $post_id ) {
                        echo '<header class="kmt-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
                        Kemet_Custom_Layout_Partials::get_instance()->get_layout( $post_id );
                        echo '</header>';
                    }
                 );
                }elseif($layout == 'footer-layout'){

                    remove_action( 'kemet_footer', 'kemet_footer_markup' );

                    add_action(
						'kemet_footer',
						function() use ( $post_id ) {
							echo '<footer class="kmt-custom-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">';
                            Kemet_Custom_Layout_Partials::get_instance()->get_layout();
							echo '</footer>';
						}
					);
                }

            }
            
		}
        
        /**
		 * Get location selection options.
		 *
		 * @return array
		 */
		public static function get_locations() {

			$args = array(
				'public'   => true,
				'_builtin' => true,
			);

			$post_types = get_post_types( $args, 'objects' );
			unset( $post_types['attachment'] );

			$args['_builtin'] = false;
			$custom_post_type = get_post_types( $args, 'objects' );

			$post_types = apply_filters( 'kemet_location_template_rule', array_merge( $post_types, $custom_post_type ) );

			$display_options = array(
                'global'         => array(
					'label' => __( 'Global', 'kemet-addons' ),
					'value' => array(
						'global-page'    => __( 'Entire Website', 'kemet-addons' ),
						'all-singulars' => __( 'All Singulars', 'kemet-addons' ),
						'all-archives'  => __( 'All Archives', 'kemet-addons' ),
					),
				),
                'general-pages' => array(
					'label' => __( 'General Pages', 'kemet-addons' ),
					'value' => array(
                        'general-404'    => __( '404 Page', 'kemet-addons' ),
                        'general-search' => __( 'Search Page', 'kemet-addons' ),
                        'general-blog'   => __( 'Blog / Posts Page', 'kemet-addons' ),
                        'general-front'  => __( 'Front Page', 'kemet-addons' ),
                        'general-date'   => __( 'Date Archive', 'kemet-addons' ),
                        'general-author' => __( 'Author Archive', 'kemet-addons' ),
                    ),
				),
				
			);

			if ( class_exists( 'WooCommerce' ) ) {
				$display_options['general-pages']['value']['special-woo-shop'] = __( 'WooCommerce Shop Page', 'kemet-addons' );
			}

			$args = array(
				'public' => true,
			);

			$taxonomies = get_taxonomies( $args, 'objects' );

			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $taxonomy ) {

					// skip post format taxonomy.
					if ( 'post_format' == $taxonomy->name ) {
						continue;
					}

					foreach ( $post_types as $post_type ) {

						$post_opt = self::get_post_display_rule_options( $post_type, $taxonomy );

						if ( isset( $display_options[ $post_opt['post_key'] ] ) ) {

							if ( ! empty( $post_opt['value'] ) && is_array( $post_opt['value'] ) ) {

								foreach ( $post_opt['value'] as $key => $value ) {

									if ( ! in_array( $value, $display_options[ $post_opt['post_key'] ]['value'] ) ) {
										$display_options[ $post_opt['post_key'] ]['value'][ $key ] = $value;
									}
								}
							}
						} else {
							$display_options[ $post_opt['post_key'] ] = array(
								'label' => $post_opt['label'],
								'value' => $post_opt['value'],
							);
						}
					}
				}
			}

			$display_options['specific-position'] = array(
				'label' => __( 'Specific Position', 'kemet-addons' ),
				'value' => array(
					'specifics' => __( 'Specific Pages / Posts / Taxanomies, etc.', 'kemet-addons' ),
				),
			);

			return apply_filters( 'kemet_display_on_rule', $display_options );
        }
        
        /**
		 * @since  1.0.0
		 *
		 * @param object $post_type post type parameter.
		 * @param object $taxonomy taxonomy for creating the target rule markup.
		 */
		public static function get_post_display_rule_options( $post_type, $taxonomy ) {

			$post_key    = str_replace( ' ', '-', strtolower( $post_type->label ) );
			$post_label  = ucwords( $post_type->label );
			$post_name   = $post_type->name;
			$post_option = array();

			/* translators: %s post label */
			$all_posts                          = sprintf( __( 'All %s', 'kemet-addons' ), $post_label );
			$post_option[ $post_name . '|all' ] = $all_posts;

			if ( 'pages' != $post_key ) {
				/* translators: %s post label */
				$all_archive                                = sprintf( __( 'All %s Archive', 'kemet-addons' ), $post_label );
				$post_option[ $post_name . '|all|archive' ] = $all_archive;
			}

			if ( in_array( $post_type->name, $taxonomy->object_type ) ) {
				$tax_label = ucwords( $taxonomy->label );
				$tax_name  = $taxonomy->name;

				/* translators: %s taxonomy label */
				$tax_archive = sprintf( __( 'All %s Archive', 'kemet-addons' ), $tax_label );

				$post_option[ $post_name . '|all|taxarchive|' . $tax_name ] = $tax_archive;
			}

			$post_output['post_key'] = $post_key;
			$post_output['label']    = $post_label;
			$post_output['value']    = $post_option;

			return $post_output;
        }
        
        public static function get_hooks(){

            $hooks = array(
                'head'    => array(
					'title' => __( 'Head', 'kemet-addons' ),
					'value' => array(
						'kemet_head_top' => __( 'Head Top', 'kemet-addons' ),
					),
                ),
                'header'    => array(
					'title' => __( 'Header', 'kemet-addons' ),
					'value' => array(
                        'kemet_before_header_block' => __( 'Before <header> tag', 'kemet-addons' ),
                        'kemet_header' => __( 'Main Header', 'kemet-addons' ),
                        'kemet_main_header_bar_top' => __( 'Top of Header Content', 'kemet-addons' ),
                        'kemet_sitehead_top' => __( 'Top of <header> tag', 'kemet-addons' ),
                        'kemet_sitehead' => __( 'Header Content', 'kemet-addons' ),
                        'kemet_sitehead_toggle_buttons_before' => __( 'Before Responsive Menu Toggle Button', 'kemet-addons' ),
                        'kemet_sitehead_toggle_buttons_after' => __( 'After Responsive Menu Toggle Button', 'kemet-addons' ),
                        'kemet_sitehead_bottom' => __( 'Bottom of <header> tag', 'kemet-addons' ),
                        'kemet_main_header_bar_bottom' => __( 'Bottom of Header Content', 'kemet-addons' ),
                        'kemet_after_header_block' => __( 'After <header> tag', 'kemet-addons' ),
					),
                ),
                'content'    => array(
					'title' => __( 'Content', 'kemet-addons' ),
					'value' => array(
                        'kemet_content_while_before' => __( 'Before Loop Start', 'kemet-addons' ),
                        'kemet_content_loop' => __( 'Top of Primary Content Loop', 'kemet-addons' ),
                        'kemet_content_while_after' => __( 'After Loop Start', 'kemet-addons' ),
                        'kemet_entry_before' => __( 'Before <article> Tag', 'kemet-addons' ),
                        'kemet_entry_after' => __( 'After <article> Tag', 'kemet-addons' ),
                        'kemet_entry_content_before' => __( 'Before Post Content', 'kemet-addons' ),
                        'kemet_entry_content_after' => __( 'After Post Content', 'kemet-addons' ),
                        'kemet_entry_top' => __( 'Top of <article> Tag', 'kemet-addons' ),
                        'kemet_entry_bottom' => __( 'Bottom of <article> Tag', 'kemet-addons' ),
                        'kemet_single_header_before' => __( 'Before Post Content', 'kemet-addons' ),
                        'kemet_single_header_after' => __( 'After Post Content', 'kemet-addons' ),
                        'kemet_single_header_top' => __( 'Top of Single Post Header', 'kemet-addons' ),
                        'kemet_single_header_bottom' => __( 'Bottom of Single Post Header', 'kemet-addons' ),
					),
                ),
                'sidebar'    => array(
					'title' => __( 'sidebar', 'kemet-addons' ),
					'value' => array(
                        'kemet_sidebars_before' => __( 'Before Sidebar Wrapper', 'kemet-addons' ),
                        'kemet_sidebars_after' => __( 'After Sidebar Wrapper', 'kemet-addons' ),
					),
                ),
                'footer'    => array(
					'title' => __( 'Footer', 'kemet-addons' ),
					'value' => array(
                        'kemet_footer_content_top' => __( 'Top of <footer> tag', 'kemet-addons' ),
                        'kemet_footer_content' => __( 'Top of Header Content', 'kemet-addons' ),
                        'kemet_footer_content_bottom' => __( 'Bottom of Header Content', 'kemet-addons' ),
					),
                ),
            );
            if ( class_exists( 'WooCommerce' ) ) {
                $hooks['woo-global'] = array(
                    'title' => __( 'WooCommerce - Global', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_before_main_content' => __( 'Before the WooCommerce Main Content', 'kemet-addons' ),
                        'woocommerce_after_main_content' => __( 'After the WooCommerce Main Content ', 'kemet-addons' ),
                        'woocommerce_sidebar' => __( 'WooCommerce sidebar action', 'kemet-addons' ),
                        'woocommerce_breadcrumb' => __( 'WooCommerce breadcrumb action', 'kemet-addons' ),
                        'woocommerce_before_template_part' => __( 'Before WooCommerce template part', 'kemet-addons' ),
                        'woocommerce_after_template_part' => __( 'After WooCommerce template part', 'kemet-addons' ),
					),
                );
                $hooks['woo-shop'] = array(
                    'title' => __( 'WooCommerce - Shop', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_archive_description' => __( 'archive_description action', 'kemet-addons' ),
                        'woocommerce_before_shop_loop' => __( 'before WooCommerce shop loop ', 'kemet-addons' ),
                        'woocommerce_before_shop_loop_item_title' => __( 'before WooCommerce shop loop item', 'kemet-addons' ),
                        'woocommerce_after_shop_loop_item_title' => __( 'after WooCommerce shop loop item', 'kemet-addons' ),
                        'kemet_woo_shop_category_before' => __( 'before WooCommerce shop category', 'kemet-addons' ),
                        'kemet_woo_shop_category_after' => __( 'after WooCommerce shop category ', 'kemet-addons' ),
                        'kemet_woo_shop_title_before' => __( 'before WooCommerce shop title', 'kemet-addons' ),
                        'kemet_woo_shop_title_after' => __( 'after WooCommerce shop title', 'kemet-addons' ),
                        'kemet_woo_shop_price_before' => __( 'before WooCommerce shop price', 'kemet-addons' ),
                        'kemet_woo_shop_price_after' => __( 'after WooCommerce shop price', 'kemet-addons' ),
                        'kemet_woo_shop_rating_before' => __( 'before WooCommerce shop rating ', 'kemet-addons' ),
                        'kemet_woo_shop_rating_after' => __( 'after WooCommerce shop rating', 'kemet-addons' ),
                        'kemet_woo_shop_short_description_before' => __( 'before WooCommerce short description', 'kemet-addons' ),
                        'kemet_woo_shop_short_description_after' => __( 'after WooCommerce short description', 'kemet-addons' ),
                        'kemet_woo_shop_add_to_cart_before' => __( 'before WooCommerce shop cart', 'kemet-addons' ),
                        'kemet_woo_shop_add_to_cart_after' => __( 'after WooCommerce shop cart ', 'kemet-addons' ),
                        'woocommerce_after_shop_loop' => __( 'after WooCommerce shop loop', 'kemet-addons' ),
					),
                );
                $hooks['woo-product'] = array(
                    'title' => __( 'WooCommerce - Product', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_before_single_product' => __( 'before WooCommerce single product', 'kemet-addons' ),
                        'woocommerce_before_single_product_summary' => __( 'before WooCommerce single product summary', 'kemet-addons' ),
                        'woocommerce_single_product_summary' => __( 'on WooCommerce single product summary action', 'kemet-addons' ),
                        'woocommerce_after_single_product_summary' => __( 'after WooCommerce single product summary', 'kemet-addons' ),
                        'woocommerce_simple_add_to_cart' => __( 'on simple add to cart action', 'kemet-addons' ),
                        'woocommerce_before_add_to_cart_form' => __( 'before WooCommerce add to cart form ', 'kemet-addons' ),
                        'woocommerce_before_add_to_cart_button' => __( 'before WooCommerce add to cart button', 'kemet-addons' ),
                        'woocommerce_before_add_to_cart_quantity' => __( 'before WooCommerce add to cart quantity', 'kemet-addons' ),
                        'woocommerce_after_add_to_cart_quantity' => __( 'after WooCommerce add to cart quantity', 'kemet-addons' ),
                        'woocommerce_after_add_to_cart_button' => __( 'after WooCommerce add to cart button', 'kemet-addons' ),
                        'woocommerce_after_add_to_cart_form' => __( 'after WooCommerce add to cart form ', 'kemet-addons' ),
                        'woocommerce_product_meta_start' => __( 'on WooCommerce product meta start action', 'kemet-addons' ),
                        'woocommerce_product_meta_end' => __( 'on WooCommerce product meta end action', 'kemet-addons' ),
                        'woocommerce_share' => __( 'on share action', 'kemet-addons' ),
                        'woocommerce_after_single_product' => __( 'after WooCommerce single product', 'kemet-addons' ),
					),
                );
                $hooks['woo-cart'] = array(
                    'title' => __( 'WooCommerce - Cart', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_check_cart_items' => __( 'on check cart items action', 'kemet-addons' ),
                        'woocommerce_cart_reset' => __( 'on cart reset', 'kemet-addons' ),
                        'woocommerce_cart_updated' => __( 'on cart update', 'kemet-addons' ),
                        'woocommerce_cart_is_empty' => __( 'on check cart is empty', 'kemet-addons' ),
                        'woocommerce_before_calculate_totals' => __( 'before WooCommerce calculate totals', 'kemet-addons' ),
                        'woocommerce_cart_calculate_fees' => __( 'on cart calculate fees ', 'kemet-addons' ),
                        'woocommerce_after_calculate_totals' => __( 'after WooCommerce calculate totals', 'kemet-addons' ),
                        'woocommerce_before_cart' => __( 'before WooCommerce cart', 'kemet-addons' ),
                        'woocommerce_before_cart_table' => __( 'before WooCommerce cart table', 'kemet-addons' ),
                        'woocommerce_before_cart_contents' => __( 'before WooCommerce cart contents', 'kemet-addons' ),
                        'woocommerce_cart_contents' => __( 'on cart contents ', 'kemet-addons' ),
                        'woocommerce_after_cart_contents' => __( 'after WooCommerce cart contents', 'kemet-addons' ),
                        'woocommerce_cart_coupon' => __( 'on cart coupon', 'kemet-addons' ),
                        'woocommerce_cart_actions' => __( 'on cart actions', 'kemet-addons' ),
                        'woocommerce_after_cart_table' => __( 'after WooCommerce cart table', 'kemet-addons' ),
                        'woocommerce_cart_collaterals' => __( 'on cart collaterals', 'kemet-addons' ),
                        'woocommerce_before_cart_totals' => __( 'before WooCommerce cart totals', 'kemet-addons' ),
                        'woocommerce_cart_totals_before_order_total' => __( 'before WooCommerce order total', 'kemet-addons' ),
                        'woocommerce_cart_totals_after_order_total' => __( 'after WooCommerce order total', 'kemet-addons' ),
                        'woocommerce_proceed_to_checkout' => __( 'on proceed to checkout action ', 'kemet-addons' ),
                        'woocommerce_after_cart_totals' => __( 'after WooCommerce cart totals', 'kemet-addons' ),
                        'woocommerce_after_cart' => __( 'after WooCommerce cart', 'kemet-addons' ),
					),
                );

                $hooks['woo-checkout'] = array(
                    'title' => __( 'WooCommerce - Checkout', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_before_checkout_form' => __( 'before WooCommerce checkout form', 'kemet-addons' ),
                        'woocommerce_checkout_before_customer_details' => __( 'before WooCommerce customer details', 'kemet-addons' ),
                        'woocommerce_checkout_after_customer_details' => __( 'after WooCommerce customer details', 'kemet-addons' ),
                        'woocommerce_checkout_billing' => __( 'on checkout billing', 'kemet-addons' ),
                        'woocommerce_before_checkout_billing_form' => __( 'before WooCommerce checkout billing form', 'kemet-addons' ),
                        'woocommerce_after_checkout_billing_form' => __( 'after WooCommerce checkout billing form', 'kemet-addons' ),
                        'woocommerce_before_order_notes' => __( 'before WooCommerce order notes', 'kemet-addons' ),
                        'woocommerce_after_order_notes' => __( 'after WooCommerce order notes', 'kemet-addons' ),
                        'woocommerce_checkout_shipping' => __( 'on checkout shipping action', 'kemet-addons' ),
                        'woocommerce_checkout_before_order_review' => __( 'before WooCommerce checkout order review', 'kemet-addons' ),
                        'woocommerce_checkout_order_review' => __( 'on checkout order review action ', 'kemet-addons' ),
                        'woocommerce_review_order_before_cart_contents' => __( 'before WooCommerce review order cart contents', 'kemet-addons' ),
                        'woocommerce_review_order_after_cart_contents' => __( 'after WooCommerce review order cart contents', 'kemet-addons' ),
                        'woocommerce_review_order_before_order_total' => __( 'before WooCommerce review order total', 'kemet-addons' ),
                        'woocommerce_review_order_after_order_total' => __( 'after WooCommerce review order total', 'kemet-addons' ),
                        'woocommerce_review_order_before_payment' => __( 'before WooCommerce order payment', 'kemet-addons' ),
                        'woocommerce_review_order_before_submit' => __( 'before WooCommerce order submit', 'kemet-addons' ),
                        'woocommerce_review_order_after_submit' => __( 'after WooCommerce order submit', 'kemet-addons' ),
                        'woocommerce_review_order_after_payment' => __( 'after WooCommerce order payment', 'kemet-addons' ),
                        'woocommerce_checkout_after_order_review' => __( 'after WooCommerce checkout order review ', 'kemet-addons' ),
                        'woocommerce_after_checkout_form' => __( 'after WooCommerce checkout form', 'kemet-addons' ),
					),
                );

                $hooks['woo-account'] = array(
                    'title' => __( 'WooCommerce - Account', 'kemet-addons' ),
                    'value' => array(
                        'woocommerce_before_account_navigation' => __( 'before WooCommerce account navigation', 'kemet-addons' ),
                        'woocommerce_account_navigation' => __( 'on WooCommerce account navigation ', 'kemet-addons' ),
                        'woocommerce_after_account_navigation' => __( 'after WooCommerce account navigation', 'kemet-addons' ),
					),
                );

            }
            
            return apply_filters('kemet_custom_layout_hooks' , $hooks);
        }
        
    }
}
Kemet_Custom_Layout_Partials::get_instance();
