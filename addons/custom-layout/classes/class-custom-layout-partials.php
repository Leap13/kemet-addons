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
		 * page data
		 *
		 * @var $page_data
		 */
        private static $page_data = array();
        
        /**
		 * page type
		 * @var $current_page_type
		 */
        private static $c_page_type = null;
        
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
            add_filter( 'kemet_addons_custom_layout_hook', array( $this, 'default_content' ) );
            add_filter( 'the_content', array( $this, 'custom_layout_content' ) );
            add_filter( 'wp', array( $this, 'layout' ) );
			add_filter( 'wp', array( $this, 'get_markup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts',  array($this, 'admin_script' ) ,1 );
			add_action( 'wp_ajax_kemet_ajax_get_posts_list', array( $this, 'kemet_ajax_get_posts_list' ) );
			add_action( 'wp_ajax_kemet_get_post_title', array( $this, 'ajax_get_post_title' ) );
        }


		/**
		 * Empty Content area.
		 *
		 * @return void
		 */
		public function default_content() {
			$post_id = get_the_id();
			$meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
            $layout = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';
            
			if ( empty( $layout ) ) {
				the_content();
			}
        }
        
        public function get_markup() {
            
            $all_posts = self::kemet_get_posts( KEMET_CUSTOM_LAYOUT_POST_TYPE );
			
            foreach ( $all_posts as $post_id => $post_data ) {
                $post_type = get_post_type();
				
				if ( KEMET_CUSTOM_LAYOUT_POST_TYPE != $post_type ) {

                    $meta = get_post_meta( $post_id, 'kemet_custom_layout_options', true ); 
                    $action = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';
                    $priority = ( isset( $meta['hook-priority'] ) ) ? $meta['hook-priority'] : 10;
                    
                    // Add Action.
                    add_action(
                        $action,
                        function() use ( $post_id ) {
                            self::render_content( $post_id );
                        },
                        $priority
                    );
                }
            }

        }

        /**
		 * Render content for post.
		 *
		 * @param int $post_id Post id.
		 *
		 */
		public function render_content( $post_id ) {

			$meta = get_post_meta( $post_id, 'kemet_custom_layout_options', true ); 
			$action = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';

			$header_footer_hooks = array( 'kemet_head_top', 'wp_head', 'kemet_body_bottom', 'wp_footer' );
			$enable_wrapper          = ! in_array( $action, $header_footer_hooks );

			$spacing_top = ( isset( $meta['spacing-top'] ) && !empty($meta['spacing-top'])) ? 'padding-top:'.$meta['spacing-top'].'px;' : '';
			$spacing_bottom = ( isset( $meta['spacing-bottom'] ) && !empty($meta['spacing-bottom'])) ? 'padding-bottom:'.$meta['spacing-bottom'].'px;' : '';
			$style = $spacing_top.$spacing_bottom;
			$style .= 'border: 0;';
			if ( $enable_wrapper ) {
				echo '<div id="kemet-addons-template-' . esc_attr( $post_id ) . '" style="'.$style.'">';
			}
			if ( class_exists( 'Custom_Layout_Page_Builder_Compatiblity' ) ) {
				$custom_layout_compat = Custom_Layout_Page_Builder_Compatiblity::get_instance();
				
				$custom_layout_compat->render_content( $post_id );
			}
			if ( $enable_wrapper ) {
				echo '</div>';
			}
		}
		
		/**
		 * Add Scripts
		 */
		public function enqueue_scripts() {

			$all_posts = self::kemet_get_posts( KEMET_CUSTOM_LAYOUT_POST_TYPE );

			foreach ( $all_posts as $post_id => $post_data ) {
				if ( class_exists( 'Custom_Layout_Page_Builder_Compatiblity' ) ) {
					$custom_layout_compat = Custom_Layout_Page_Builder_Compatiblity::get_instance();
					$custom_layout_compat->enqueue_scripts( $post_id );
				}
			}
		}

        /**
		 *
		 * @param  html $content the_content markup.
		 * @return html
		 */
		public function custom_layout_content( $content ) {
			if ( is_singular( KEMET_CUSTOM_LAYOUT_POST_TYPE ) ) {
				$post_id = get_the_id();
                $meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true ); 
                $action = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';

                $header_footer_hooks = array( 'kemet_head_top', 'wp_head', 'kemet_body_bottom', 'wp_footer' );
				$enable_wrapper          = ! in_array( $action, $header_footer_hooks );

				$spacing_top = ( isset( $meta['spacing-top'] ) && !empty($meta['spacing-top'])) ? 'padding-top:'.$meta['spacing-top'].'px;' : '';
				$spacing_bottom = ( isset( $meta['spacing-bottom'] ) && !empty($meta['spacing-bottom'])) ? 'padding-bottom:'.$meta['spacing-bottom'].'px;' : '';
				$style = $spacing_top.$spacing_bottom;

				if ( $enable_wrapper ) {
					$content = '<div class="kemet-addons-template-' . $post_id . '" style="'.$style.'">' . $content . '</div>';
				}
			}
			return $content;
        }
        
        /**
		 * Get layout
		 */
		public function get_post_layout() {
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
                $action = ( isset( $meta['hook-action'] ) ) ? $meta['hook-action'] : '';
                $priority = ( isset( $meta['hook-priority'] ) ) ? $meta['hook-priority'] : '';

                
				$exclude_wrapper_hooks = array('kemet_head_top', 'wp_head', 'wp_footer' );
				if ( in_array( $action, $exclude_wrapper_hooks )) {
					remove_filter( 'the_content', 'wpautop' );
                }
                
                $hooks = self::get_hooks_options();
				
                if ( isset( $hooks['content']['value'][ $action ] ) || isset( $hooks['sidebar']['value'][ $action ] ) ) {
					
					$action = 'kemet_addons_custom_layout_hook';
                }
				if ( 'kemet_addons_custom_layout_hook' == $action ) {
                    
					remove_action( 'kemet_addons_custom_layout_hook', array( $this, 'default_content' ) );
                    add_action( 'kemet_addons_custom_layout_hook', 'the_content' );
                    
				} else {
					add_action(
						$action,
						function() use ( $post_id ) {

							self::get_post_layout();

						},
						$priority
					);
				}

            }
            
		}
                
        /**
		 * Get location selection options.
		 *
		 * @return array
		 */
		public static function get_location_options() {

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
                        '404-page'    => __( '404 Page', 'kemet-addons' ),
                        'general-search' => __( 'Search Page', 'kemet-addons' ),
                        'general-blog'   => __( 'Blog / Posts Page', 'kemet-addons' ),
                        'general-front'  => __( 'Front Page', 'kemet-addons' ),
                        'general-date'   => __( 'Date Archive', 'kemet-addons' ),
                        'general-author' => __( 'Author Archive', 'kemet-addons' ),
                    ),
				),
				
			);

			if ( class_exists( 'WooCommerce' ) ) {
				$display_options['general-pages']['value']['global-woo-shop'] = __( 'WooCommerce Shop Page', 'kemet-addons' );
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
					'specifics-location' => __( 'Specific Pages / Posts / Taxanomies, etc.', 'kemet-addons' ),
				),
			);

			return apply_filters( 'kemet_display_on_rule', $display_options );
        }
		
		public static function get_user_rules_options() {
			global $wp_roles;
			
			$options = array(
				'global'    => array(
					'title' => __( 'Global', 'kemet-addons' ),
					'value' => array(
						'all'        => __( 'All', 'kemet-addons' ),
						'logged-in'  => __( 'Logged In', 'kemet-addons' ),
						'logged-out' => __( 'Logged Out', 'kemet-addons' ),
					),
				),
				'general' => array(
					'title' => __( 'General', 'kemet-addons' ),
					'value' => array(),
				),
			);
			$all_roles = $wp_roles->roles;
			$editable_roles = apply_filters('editable_roles', $all_roles);
			
			foreach ( $editable_roles as $slug => $data ) {
				$options['general']['value'][ $slug ] = __( $data['name'], 'kemet-addons' );
			}

			return $options;
		}


        /**
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
        
        public static function get_hooks_options(){

            $hooks = array(
                'head'    => array(
					'title' => __( 'Head', 'kemet-addons' ),
					'value' => array(
						'kemet_html_before' => __( 'before the opening of <html> tag', 'kemet-addons' ),
						'kemet_head_top' => __( 'top of <head> tag', 'kemet-addons' ),
						'kemet_head_bottom' => __( 'custom style, script and meta at the bottom of <head> tag', 'kemet-addons' ),
						'wp_head' => __( 'Head Top', 'kemet-addons' ),
					),
                ),
                'header'    => array(
					'title' => __( 'Header', 'kemet-addons' ),
					'value' => array(
						'kemet_body_top' => __( 'Top of <body> tag', 'kemet-addons' ),
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
						'kemet_content_before' => __( 'Before main content', 'kemet-addons' ),
                        'kemet_content_top' => __( 'Top of main content', 'kemet-addons' ),
                        'kemet_content_while_before' => __( 'Before Loop Start', 'kemet-addons' ),
                        'kemet_content_loop' => __( 'Top of Primary Content Loop', 'kemet-addons' ),
						'kemet_content_while_after' => __( 'After Loop Start', 'kemet-addons' ),
						'kemet_primary_content_top' => __( 'Top of Primary Content', 'kemet-addons' ),
						'kemet_template_parts_content_none' => __( 'Top of the primary content', 'kemet-addons' ),
						'kemet_template_parts_content_top' => __( 'Top of the primary template content', 'kemet-addons' ),
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
						'kemet_template_parts_content_bottom' => __( 'Bottom of the primary template content', 'kemet-addons' ),
						'kemet_primary_content_bottom' => __( 'Bottom of Primary Content', 'kemet-addons' ),
						'kemet_content_bottom' => __( 'Bottom of main content', 'kemet-addons' ),
						'kemet_content_after' => __( 'After main content', 'kemet-addons' ),
					),
				),
				'comment'    => array(
					'title' => __( 'Comment', 'kemet-addons' ),
					'value' => array(
                        'kemet_comments_before' => __( 'Before Opening of Comment Start', 'kemet-addons' ),
                        'kemet_comments_after' => __( 'After Closing of Comment Wrapper', 'kemet-addons' ),
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
						'kemet_footer_before' => __( 'Before of <footer> tag', 'kemet-addons' ),
                        'kemet_footer_content_top' => __( 'Top of <footer> tag', 'kemet-addons' ),
						'kemet_footer_content' => __( 'Top of Footer Content', 'kemet-addons' ),
						'kemet_footer_inside_container_top' => __( 'Top of footer container', 'kemet-addons' ),
						'kemet_footer_inside_container_bottom' => __( 'Bottom of footer container', 'kemet-addons' ),
						'kemet_footer_content_bottom' => __( 'Bottom of Footer Content', 'kemet-addons' ),
						'kemet_footer_after' => __( 'After of <footer> tag', 'kemet-addons' ),
						'kemet_body_bottom' => __( 'Bottom of <body> tag', 'kemet-addons' ),
						'wp_footer' => __( 'End of the document', 'kemet-addons' ),
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
        
        /**
		 * Get Posts
		 *
		 * @since  1.1.0
		 * @param  string $post_type Post Type.
		 * @param  array  $options meta option name.
		 *
		 * @return object  Posts.
		 */
		public function kemet_get_posts( $post_type ) {

			global $wpdb;
			global $post;

			$post_type = $post_type ? esc_sql( $post_type ) : esc_sql( $post->post_type );

			if ( is_array( self::$page_data ) && isset( self::$page_data[ $post_type ] ) ) {
				return apply_filters( 'kemet_addons_get_display_posts', self::$page_data[ $post_type ], $post_type );
			}

			$c_page_type = $this->kemet_get_page_type();
            
			self::$page_data[ $post_type ] = array();

			$option = array();

			$options['post_id'] = self::$page_data['ID'];

            $c_post_type = esc_sql( get_post_type() );
            $post_id   = false;
            $query_obj     = get_queried_object();
            
            $location = esc_sql( 'kemet_custom_layout_options' );
            
            $query = "SELECT posts.ID, postmeta.meta_value FROM {$wpdb->postmeta} as postmeta
                        INNER JOIN {$wpdb->posts} as posts ON postmeta.post_id = posts.ID
                        WHERE postmeta.meta_key = '{$location}'
                        AND posts.post_type = '{$post_type}'
                        AND posts.post_status = 'publish'";

            $orderby = ' ORDER BY posts.post_date DESC';

            /* Entire Website */

            $meta_args = " postmeta.meta_value LIKE '%\"global-page\"%'";

            switch ( $c_page_type ) {
                case 'is_404':
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"404-page\"%'";
                    break;
                case 'is_search':
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"general-search\"%'";
                    break;
                case 'is_archive':
                case 'is_tax':
                case 'is_date':
                case 'is_author':
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"all-archives\"%'";
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"{$c_post_type}|all|archive\"%'";

                    if ( 'is_tax' == $c_page_type && ( is_category() || is_tag() || is_tax() ) ) {

                        if ( is_object( $query_obj ) ) {
                            $meta_args .= " OR postmeta.meta_value LIKE '%\"{$c_post_type}|all|taxarchive|{$query_obj->taxonomy}\"%'";
                            $meta_args .= " OR postmeta.meta_value LIKE '%\"tax-{$query_obj->term_id}\"%'";
                        }
                    } elseif ( 'is_date' == $c_page_type ) {
                        $meta_args .= " OR postmeta.meta_value LIKE '%\"general-date\"%'";
                    } elseif ( 'is_author' == $c_page_type ) {
                        $meta_args .= " OR postmeta.meta_value LIKE '%\"general-author\"%'";
                    }
                    break;
                case 'is_home':
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"general-blog\"%'";
                    break;
                case 'is_front_page':
                    $this_id      = esc_sql( get_the_id() );
					$post_id = $this_id;
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"general-front\"%'";
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"{$c_post_type}|all\"%'";
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"post-{$this_id}\"%'";
                    break;
                case 'is_singular':
                    $this_id = esc_sql( get_the_id() );

                    if ( class_exists( 'SitePress' ) ) {
                        $default_language = wpml_get_default_language();
                        $this_id       = icl_object_id( $this_id, $c_post_type, true, $default_language );
                    }

                    $post_id = $this_id;
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"all-singulars\"%'";
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"{$c_post_type}|all\"%'";
                    $meta_args      .= " OR postmeta.meta_value LIKE '%\"post-{$this_id}\"%'";

                    $taxonomies = get_object_taxonomies( $query_obj->post_type );
                    $terms      = wp_get_post_terms( $query_obj->ID, $taxonomies );

                    foreach ( $terms as $key => $term ) {
                        $meta_args .= " OR postmeta.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                    }
                    
                    break;
                case 'is_woo_shop_page':
                    $meta_args .= " OR postmeta.meta_value LIKE '%\"global-woo-shop\"%'";
                    break;
                case '':
                    $post_id = get_the_id();
                    break;
            }

            apply_filters( 'kemet_addons_get_display_posts_query', $meta_args, $query_obj, $post_id );
			
            // Ignore the PHPCS warning about constant declaration.
            // @codingStandardsIgnoreStart
            $posts  = $wpdb->get_results( $query . ' AND (' . $meta_args . ')' . $orderby );
            
            
            // @codingStandardsIgnoreEnd

            foreach ( $posts as $local_post ) {
                self::$page_data[ $post_type ][ $local_post->ID ] = array(
                    'id'       => $local_post->ID,
                    'location' => maybe_unserialize( $local_post->meta_value ),
				);
				
            }

            $options['post_id'] = $post_id;
            
            $this->remove_hidden_posts_from_list( $post_type, $options );
			$this->remove_hidden_users_from_list( $post_type, $options );

			return apply_filters( 'kemet_addons_get_display_posts', self::$page_data[ $post_type ], $post_type );
        }
        
        /**
		 * rmove hidden posts from array.
		 *
		 * @param  string $post_type Post Type.
		 * @param  array  $option meta option name.
		 */
		public function remove_hidden_posts_from_list( $post_type, $option ) {

            $post_id = isset( $option['post_id'] ) ? $option['post_id'] : false;
            
			foreach ( self::$page_data[ $post_type ] as $c_post_id => $c_data ) {

				$rules_meta = get_post_meta( $c_post_id, 'kemet_custom_layout_options', true );
				$hide_on_group = $rules_meta['hide-on-group'] ? $rules_meta['hide-on-group'] : '';
				$is_hidden      = $this->check_post_display( $post_id, $hide_on_group );
				$specific 		= $this->check_specific_post_display($post_id, $hide_on_group );
				if ( $is_hidden ) {
					unset( self::$page_data[ $post_type ][ $c_post_id ] );
				}
				if( $specific ){
					unset( self::$page_data[ $post_type ][ $c_post_id ] );
				}
			}
        }
        
        /**
		 * Get page type
		 * @return string Page Type.
		 */
		public function kemet_get_page_type() {

			if ( null === self::$c_page_type ) {

				$page_type  = '';
				$page_id = false;

				if ( is_404() ) {
					$page_type = 'is_404';
				} elseif ( is_search() ) {
					$page_type = 'is_search';
				} elseif ( is_archive() ) {
					$page_type = 'is_archive';

					if ( is_category() || is_tag() || is_tax() ) {
						$page_type = 'is_tax';
					} elseif ( is_date() ) {
						$page_type = 'is_date';
					} elseif ( is_author() ) {
						$page_type = 'is_author';
					} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
						$page_type = 'is_woo_shop_page';
					}
				} elseif ( is_home() ) {
					$page_type = 'is_home';
				} elseif ( is_front_page() ) {
					$page_type  = 'is_front_page';
					$page_id = get_the_id();
				} elseif ( is_singular() ) {
					$page_type  = 'is_singular';
					$page_id = get_the_id();
				} else {
					$page_id = get_the_id();
				}

				self::$page_data['ID'] = $page_id;
				self::$c_page_type       = $page_type;
			}

			return self::$c_page_type;
        }
        
        /**
		 * Check display
		 *
		 * @param  int   $post_id Current post ID.
		 * @param  array $rules   Array of rules Display on | Hide on.
		 *
		 * @return boolean Returns true or false.
		 */
		public function check_post_display( $post_id, $rules ) {

			$display           = false;
			$current_post_type = get_post_type( $post_id );
            
			if ( isset( $rules['hide-on-rule'] ) && is_array( $rules['hide-on-rule'] ) && ! empty( $rules['hide-on-rule'] ) ) {
                
				foreach ( $rules['hide-on-rule'] as $key => $rule ) {
					
					if ( strrpos( $rule, 'all' ) !== false ) {
						$rule_case = 'all';
					} else {
						$rule_case = $rule;
					}
					switch ( $rule_case ) {
						case 'global-page':
							$display = true;
							break;

						case 'all-singulars':
							if ( is_singular() ) {
								$display = true;
							}
							break;

						case 'all-archives':
							if ( is_archive() ) {
								$display = true;
							}
							break;

						case '404-page':
							if ( is_404() ) {
								$display = true;
							}
							break;

						case 'general-search':
							if ( is_search() ) {
								$display = true;
							}
							break;

						case 'general-blog':
							if ( is_home() ) {
								$display = true;
							}
							break;

						case 'general-front':
							if ( is_front_page() ) {
								$display = true;
							}
							break;

						case 'general-date':
							if ( is_date() ) {
								$display = true;
							}
							break;

						case 'general-author':
							if ( is_author() ) {
								$display = true;
							}
							break;

						case 'general-woo-shop':
							if ( function_exists( 'is_shop' ) && is_shop() ) {
								$display = true;
							}
							break;

						case 'all':
							$rule_data = explode( '|', $rule );

							$post_type     = isset( $rule_data[0] ) ? $rule_data[0] : false;
							$archieve_type = isset( $rule_data[2] ) ? $rule_data[2] : false;
							$taxonomy      = isset( $rule_data[3] ) ? $rule_data[3] : false;
							if ( false === $archieve_type ) {

								$current_post_type = get_post_type( $post_id );

								if ( false !== $post_id && $current_post_type == $post_type ) {

									$display = true;
								}
							} else {

								if ( is_archive() ) {

									$current_post_type = get_post_type();
									if ( $current_post_type == $post_type ) {
										if ( 'archive' == $archieve_type ) {
											$display = true;
										} elseif ( 'taxarchive' == $archieve_type ) {

											$obj              = get_queried_object();
											$current_taxonomy = '';
											if ( '' !== $obj && null !== $obj ) {
												$current_taxonomy = $obj->taxonomy;
											}

											if ( $current_taxonomy == $taxonomy ) {
												$display = true;
											}
										}
									}
								}
							}
							break;

						default:
							break;
					}

					if ( $display ) {
						break;
					}
				}
			}

			return $display;
        }
		
		/**
		 * Check display
		 *
		 * @param  int   $post_id Current post ID.
		 * @param  array $rules   Array of rules Display on | Hide on.
		 *
		 * @return boolean Returns true or false.
		 */
		function check_specific_post_display($post_id, $rules){

			$display = false;
			
			if(isset( $rules['hide-on-specifics-location'] ) && is_array( $rules['hide-on-specifics-location'] ) && ! empty( $rules['hide-on-specifics-location'] )){

				$specifics = $rules['hide-on-specifics-location'];

				foreach ( $specifics as $specific_page ) {

					$specific_data = explode( '-', $specific_page );

					$specific_post_type = isset( $specific_data[0] ) ? $specific_data[0] : false;
					$specific_post_id   = isset( $specific_data[1] ) ? $specific_data[1] : false;
					if ( 'post' == $specific_post_type ) {
						if ( $specific_post_id == $post_id ) {
							$display = true;
						}
					} elseif ( isset( $specific_data[2] ) && ( 'single' == $specific_data[2] ) && 'tax' == $specific_post_type ) {

						if ( is_singular() ) {
							$term_details = get_term( $specific_post_id );

							if ( isset( $term_details->taxonomy ) ) {
								$has_term = has_term( (int) $specific_post_id, $term_details->taxonomy, $post_id );

								if ( $has_term ) {
									$display = true;
								}
							}
						}
					} elseif ( 'tax' == $specific_post_type ) {
						$tax_id = get_queried_object_id();
						if ( $specific_post_id == $tax_id ) {
							$display = true;
						}
					}
				}
			}

			return $display;
		}
		/**
		 * Remove user rule posts.
		 *
		 * @param  int   $post_type Post Type.
		 * @param  array $option meta option name.
		 */
		public function remove_hidden_users_from_list( $post_type, $option ) {

			$users           = isset( $option['users'] ) ? $option['users'] : '';
			$post_id 		 = isset( $option['post_id'] ) ? $option['post_id'] : false;

			foreach ( self::$page_data[ $post_type ] as $c_post_id => $c_data ) {

				$rules_meta = get_post_meta( $c_post_id, 'kemet_custom_layout_options', true );
				$rules		= isset($rules_meta['user-rules']) ? $rules_meta['user-rules'] : '';
				$is_user      = $this->check_user_display( $post_id, $rules );

				if ( ! $is_user ) {
					unset( self::$page_data[ $post_type ][ $c_post_id ] );
				}
			}
		}

		/**
		 * Check user role.
		 *
		 * @param  int   $post_id Post ID.
		 * @param  Array $rules   Current user rules.
		 *
		 * @return boolean
		 */
		public function check_user_display( $post_id, $rules_array ) {

			$show = true;
			
			if ( is_array( $rules_array ) && ! empty( $rules_array ) ) {
				$show = false;

				foreach ( $rules_array as $i => $rule ) {

					switch ( $rule ) {
						case '':
						case 'all':
							$show = true;
							break;

						case 'logged-in':
							if ( is_user_logged_in() ) {
								$show = true;
							}
							break;

						case 'logged-out':
							if ( ! is_user_logged_in() ) {
								$show = true;
							}
							break;

						default:
							if ( is_user_logged_in() ) {

								$current_user = wp_get_current_user();

								if ( isset( $current_user->roles )
										&& is_array( $current_user->roles )
										&& in_array( $rule, $current_user->roles )
									) {

									$show = true;
								}
							}
							break;
					}

					if ( $show ) {
						break;
					}
				}
			}

			return $show;
		}

		/**
		 * Ajax handeler to return the posts based on the search query.
		 * When searching for the post/pages only titles are searched for.
		 *
		 */
		public function kemet_ajax_get_posts_list() {

			check_ajax_referer( 'kemet-addons-ajax-get-post', 'nonce' );

			$search_query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : ''; 
			$data          = array();
			$result        = array();

			$args = array(
				'public'   => true,
				'_builtin' => false
			);
			
			$output = 'names'; // 'names' or 'objects' (default: 'names')
			$operator = 'and'; // 'and' or 'or' (default: 'and')
			
			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';

			foreach ( $post_types as $key => $post_type ) {

				$data = array();

				add_filter( 'posts_search', array( $this, '__search_by_title_only' ), 500, 2 );

				$query = new WP_Query(
					array(
						's'              => $search_query,
						'post_type'      => $post_type,
						'posts_per_page' => - 1,
					)
				);

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$title  = get_the_title();
						$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
						$id     = get_the_id();
						$data[] = array(
							'id'   => 'post-' . $id,
							'text' => $title,
						);
					}
				}
				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $key,
						'children' => $data,
					);
				}
			}

			$data = array();

			wp_reset_postdata();

			$args = array(
				'public' => true,
			);

			$output     = 'objects'; // names or objects, note names is the default.
			$operator   = 'and'; // also supports 'or'.
			$taxonomies = get_taxonomies( $args, $output, $operator );

			foreach ( $taxonomies as $taxonomy ) {
				$terms = get_terms(
					$taxonomy->name,
					array(
						'orderby'    => 'count',
						'hide_empty' => 0,
						'name__like' => $search_query,
					)
				);

				$data = array();

				$label = ucwords( $taxonomy->label );

				if ( ! empty( $terms ) ) {

					foreach ( $terms as $term ) {

						$term_taxonomy_name = ucfirst( str_replace( '_', ' ', $taxonomy->name ) );

						$data[] = array(
							'id'   => 'tax-' . $term->term_id,
							'text' => $term->name . ' archive page',
						);

						$data[] = array(
							'id'   => 'tax-' . $term->term_id . '-single-' . $taxonomy->name,
							'text' => 'All singulars from ' . $term->name,
						);

					}
				}

				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $label,
						'children' => $data,
					);
				}
			}

			// return the result in json.
			wp_send_json( $result );
		}

		/**
		 *
		 * @param  (string)   $search   Search SQL for WHERE clause.
		 * @param  (WP_Query) $wp_query The current WP_Query object.
		 *
		 * @return (string) The Modified Search SQL for WHERE clause.
		 */
		function __search_by_title_only( $search,$wp_query )
		{
			global $wpdb;
			if(empty($search)) {
				return $search; // skip processing - no search term in query
			}
			$q = $wp_query->query_vars;
			$n = !empty($q['exact']) ? '' : '%';
			$search =
			$searchand = '';
			foreach ((array)$q['search_terms'] as $term) {
				$term = esc_sql($wpdb->esc_like($term));
				$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
				$searchand = ' AND ';
			}
			if (!empty($search)) {
				$search = " AND ({$search}) ";
				if (!is_user_logged_in())
					$search .= " AND ($wpdb->posts.post_password = '') ";
			}
			return $search;
		}

		function ajax_get_post_title(){

			check_ajax_referer( 'kemet-addons-ajax-get-title', 'nonce' );
			
			$post_id = isset( $_POST['post_id'] ) ? explode("-", $_POST['post_id'])[1] : ''; 
			if(!empty($post_id)){
				$name = !empty(get_the_title( $post_id )) ? get_the_title( $post_id ) : get_term( $post_id )->name  ;
				echo $name;
			}
			wp_die();
		}

		function admin_script(){
				wp_enqueue_script( 'kemet-addons-select2', KEMET_CUSTOM_LAYOUT_URL . 'assets/js/unminified/select2.js', array( 'jquery' ), KEMET_ADDONS_VERSION, true );

				$wordpress_lang  = get_locale();
				$lang = '';
				if ( '' !== $wordpress_lang ) {

					$select2_lang = array(
						''               => 'en',
						'hi_IN'          => 'hi',
						'mr'             => 'mr',
						'af'             => 'af',
						'ar'             => 'ar',
						'ary'            => 'ar',
						'as'             => 'as',
						'azb'            => 'az',
						'az'             => 'az',
						'bel'            => 'be',
						'bg_BG'          => 'bg',
						'bn_BD'          => 'bn',
						'bo'             => 'bo',
						'bs_BA'          => 'bs',
						'ca'             => 'ca',
						'ceb'            => 'ceb',
						'cs_CZ'          => 'cs',
						'cy'             => 'cy',
						'da_DK'          => 'da',
						'de_CH'          => 'de',
						'de_DE'          => 'de',
						'de_DE_formal'   => 'de',
						'de_CH_informal' => 'de',
						'dzo'            => 'dz',
						'el'             => 'el',
						'en_CA'          => 'en',
						'en_GB'          => 'en',
						'en_AU'          => 'en',
						'en_NZ'          => 'en',
						'en_ZA'          => 'en',
						'eo'             => 'eo',
						'es_MX'          => 'es',
						'es_VE'          => 'es',
						'es_CR'          => 'es',
						'es_CO'          => 'es',
						'es_GT'          => 'es',
						'es_ES'          => 'es',
						'es_CL'          => 'es',
						'es_PE'          => 'es',
						'es_AR'          => 'es',
						'et'             => 'et',
						'eu'             => 'eu',
						'fa_IR'          => 'fa',
						'fi'             => 'fi',
						'fr_BE'          => 'fr',
						'fr_FR'          => 'fr',
						'fr_CA'          => 'fr',
						'gd'             => 'gd',
						'gl_ES'          => 'gl',
						'gu'             => 'gu',
						'haz'            => 'haz',
						'he_IL'          => 'he',
						'hr'             => 'hr',
						'hu_HU'          => 'hu',
						'hy'             => 'hy',
						'id_ID'          => 'id',
						'is_IS'          => 'is',
						'it_IT'          => 'it',
						'ja'             => 'ja',
						'jv_ID'          => 'jv',
						'ka_GE'          => 'ka',
						'kab'            => 'kab',
						'km'             => 'km',
						'ko_KR'          => 'ko',
						'ckb'            => 'ku',
						'lo'             => 'lo',
						'lt_LT'          => 'lt',
						'lv'             => 'lv',
						'mk_MK'          => 'mk',
						'ml_IN'          => 'ml',
						'mn'             => 'mn',
						'ms_MY'          => 'ms',
						'my_MM'          => 'my',
						'nb_NO'          => 'nb',
						'ne_NP'          => 'ne',
						'nl_NL'          => 'nl',
						'nl_NL_formal'   => 'nl',
						'nl_BE'          => 'nl',
						'nn_NO'          => 'nn',
						'oci'            => 'oc',
						'pa_IN'          => 'pa',
						'pl_PL'          => 'pl',
						'ps'             => 'ps',
						'pt_BR'          => 'pt',
						'pt_PT_ao90'     => 'pt',
						'pt_PT'          => 'pt',
						'rhg'            => 'rhg',
						'ro_RO'          => 'ro',
						'ru_RU'          => 'ru',
						'sah'            => 'sah',
						'si_LK'          => 'si',
						'sk_SK'          => 'sk',
						'sl_SI'          => 'sl',
						'sq'             => 'sq',
						'sr_RS'          => 'sr',
						'sv_SE'          => 'sv',
						'szl'            => 'szl',
						'ta_IN'          => 'ta',
						'te'             => 'te',
						'th'             => 'th',
						'tl'             => 'tl',
						'tr_TR'          => 'tr',
						'tt_RU'          => 'tt',
						'tah'            => 'ty',
						'ug_CN'          => 'ug',
						'uk'             => 'uk',
						'ur'             => 'ur',
						'uz_UZ'          => 'uz',
						'vi'             => 'vi',
						'zh_CN'          => 'zh',
						'zh_TW'          => 'zh',
						'zh_HK'          => 'zh',
					);

					if ( isset( $select2_lang[ $wordpress_lang ] ) && file_exists( KEMET_CUSTOM_LAYOUT_DIR . 'assets/js-unminified/i18n/' . $select2_lang[ $wordpress_lang ] . '.js' ) ) {

						$ast_lang = $select2_lang[ $wordpress_lang ];
						wp_enqueue_script(
							'kemet-addons-select2-lang',
							KEMET_CUSTOM_LAYOUT_URL . 'assets/js/minified/i18n/' . $select2_lang[ $wordpress_lang ] . '.js',
							array(
								'jquery',
								'kemet-addons-select2',
							),
							KEMET_ADDONS_VERSION,
							true
						);
					}
				}

			wp_enqueue_style( 'kemet-addons-select2', KEMET_CUSTOM_LAYOUT_URL . 'assets/css/unminified/select2.css', KEMET_ADDONS_VERSION );

			$js_prefix  = '.min.js';
			$css_prefix  = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix  = '.css';
				$dir        = 'unminified';
			}

			$hooks = Kemet_Custom_Layout_Partials::get_hooks_options();
			$description_array = array();
			foreach($hooks as $key => $value){
				foreach($value['value'] as $val => $decription){
					$description_array[$val] = __( $decription , 'kemet-addons');
				}
			}

			wp_enqueue_script( 'kemet-addons-custom-layout-js', KEMET_CUSTOM_LAYOUT_URL . 'assets/js/' . $dir . '/custom-layout' . $js_prefix, array(
				'jquery',
				'kemet-addons-select2',
			), KEMET_ADDONS_VERSION, true );
			
			wp_enqueue_style( 'kemet-addons-custom-layout-css', KEMET_CUSTOM_LAYOUT_URL . 'assets/css/' . $dir . '/style' . $css_prefix , '', KEMET_ADDONS_VERSION );

			$meta = get_post_meta( get_the_ID(), 'kemet_custom_layout_options', true );
			$all_display = isset($meta['display-on-group']['display-on-specifics-location']) ? $meta['display-on-group']['display-on-specifics-location'] : '';
			$all_hide = isset($meta['hide-on-group']['hide-on-specifics-location']) ? $meta['hide-on-group']['hide-on-specifics-location'] : '';

			$display_positions = array(); 
			$hide_positions = array();
			if(is_array($all_display)){
				foreach($all_display as $position){
					$display_positions[] = $position;
				}
			}
			if(is_array($all_hide)){
				foreach($all_hide as $position){
					$hide_positions[] = $position;
				}
			}

			wp_localize_script(
			'kemet-addons-custom-layout-js', 'kemetAddons', apply_filters(
				'kemet_addons_admin_js_localize', array(
					'hooks_descriptions'      => $description_array,
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'lang'      => $lang,
					'search'        => __( 'Search pages / post / categories', 'kemet-addons' ),
					'ajax_nonce'    => wp_create_nonce( 'kemet-addons-ajax-get-post' ),
					'ajax_title_nonce' => wp_create_nonce( 'kemet-addons-ajax-get-title' ),
					'display_old_value'			=> $display_positions,
					'hide_old_value'			=> $hide_positions,
					)
				)
			);
	
		}
    }
}
Kemet_Custom_Layout_Partials::get_instance();
