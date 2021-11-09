<?php
/**
 * Woocommerce
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Woocommerce_Partials' ) ) {

	/**
	 * Woocommerce Partials
	 *
	 * @since 1.0.3
	 */
	class Kemet_Addon_Woocommerce_Partials {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @return object
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
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'wp_ajax_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
			add_action( 'wp_footer', array( $this, 'quick_view_html' ) );
			add_action( 'kemet_woo_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'kemet_woo_qv_product_image', array( $this, 'qv_product_images_markup' ), 20 );
			add_filter( 'kemet_theme_js_localize', array( $this, 'woocommerce_js_localize' ) );
			add_action( 'wp_ajax_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
			add_action( 'wp_ajax_nopriv_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
			add_filter( 'body_class', array( $this, 'shop_layout' ) );
			add_action( 'wp', array( $this, 'init_woocommerce' ) );
			add_action( 'widgets_init', array( $this, 'kemet_register_off_canvas' ) );
			add_action( 'wp_ajax_nopriv_kemet_list_post_ajax', array( $this, 'ajax_product_list_style' ) );
			add_action( 'wp_ajax_kemet_list_post_ajax', array( $this, 'ajax_product_list_style' ) );
			add_action( 'wp_ajax_nopriv_kemet_hover_style_post_ajax', array( $this, 'ajax_product_hover_style' ) );
			add_action( 'wp_ajax_kemet_hover_style_post_ajax', array( $this, 'ajax_product_hover_style' ) );
			add_action( 'wp_ajax_nopriv_kemet_product_default_style', array( $this, 'ajax_product_default_style' ) );
			add_action( 'wp_ajax_kemet_product_default_style', array( $this, 'ajax_product_default_style' ) );

			if ( class_exists( 'Kemet_Woocommerce' ) ) {
				$kemet_woocommerce_instance = Kemet_Woocommerce::get_instance();
				add_action( 'ajax_product_layout_style', array( $kemet_woocommerce_instance, 'shop_customization' ) );
				add_action( 'ajax_product_layout_style', array( $kemet_woocommerce_instance, 'woocommerce_init' ) );
				add_action( 'kemet_infinite_scroll', array( $kemet_woocommerce_instance, 'shop_customization' ) );
				add_action( 'kemet_infinite_scroll', array( $kemet_woocommerce_instance, 'woocommerce_init' ) );
			}

			add_action( 'ajax_product_layout_style', array( $this, 'init_woocommerce' ) );
			add_filter( 'kemet_shop_layout_style', array( $this, 'kemet_get_shop_layout_cookie' ) );
			add_action( 'kemet_infinite_scroll', array( $this, 'init_woocommerce' ) );
			add_action( 'wp_ajax_kemet_infinite_scroll', array( $this, 'kemet_infinite_scroll' ) );
			add_action( 'wp_ajax_nopriv_kemet_infinite_scroll', array( $this, 'kemet_infinite_scroll' ) );
			add_filter( 'kemet_shop_layout_style', array( $this, 'related_posts_layout' ) );
		}

		/**
		 * Shop Layout
		 *
		 * @param array $classes body classes.
		 * @return array
		 */
		public function shop_layout( $classes ) {
			$layout_style = apply_filters( 'kemet_shop_layout_style', kemet_get_option( 'woo-shop-layout' ) );
			if ( in_array( 'shop-grid', $classes ) ) {
				$layout_class = array_search( 'shop-grid', $classes );
				unset( $classes[ $layout_class ] );
				$classes[] = $layout_style;
			}

			return $classes;
		}

		/**
		 * Related Post Layout
		 *
		 * @param string $layout shop layout.
		 * @return string
		 */
		public function related_posts_layout( $layout ) {
			if ( ! ( is_shop() || is_product_taxonomy() ) ) {
				$layout = kemet_get_option( 'woo-shop-layout' );
				ob_start();

				setcookie( 'kemet_single_product_layout', $layout, 0.1, '/' );

				ob_clean();
			}

			return $layout;
		}

		/**
		 * Infinite Scroll
		 *
		 * @return void
		 */
		public function kemet_infinite_scroll() {
			check_ajax_referer( 'kmt-shop-load-more-nonce', 'nonce' );

			if ( isset( $_COOKIE['kemet_shop_layout'] ) ) {
				add_filter(
					'kemet_shop_layout_style',
					function () {
						return sanitize_text_field( wp_unslash( $_COOKIE['kemet_shop_layout'] ) );
					}
				);
			}

			do_action( 'kemet_infinite_scroll' );

			$query_vars                   = isset( $_POST['query_vars'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query_vars'] ) ), true ) : '';
			$query_vars['paged']          = isset( $_POST['page_no'] ) ? absint( wp_unslash( $_POST['page_no'] ) ) : 1;
			$query_vars['post_status']    = 'publish';
			$posts_per_page               = kemet_get_option( 'woo-shop-no-of-products' );
			$query_vars['posts_per_page'] = kemet_slider( $posts_per_page );
			$query_vars                   = array_merge( $query_vars, wc()->query->get_catalog_ordering_args() );

			$posts = new WP_Query( $query_vars );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					/**
					 * Woocommerce: woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}

			wp_reset_query();

			wp_die();
		}

		/**
		 * Infinite scroll pagination
		 *
		 * @return void
		 */
		public function infinite_pagination() {
			global $wp_query;

			if ( $wp_query->max_num_pages <= 1 ) {
				return;
			}

			$end_text        = kemet_get_option( 'woo-shop-infinite-scroll-last-text' );
			$msg             = esc_html( $end_text );
			$load_more_style = kemet_get_option( 'woo-shop-load-more-style' );
			$load_more_text  = esc_html( kemet_get_option( 'woo-shop-load-more-text' ) );
			?>
			<div class="kmt-woo-infinite-scroll-loader">
				<div class="kmt-woo-infinite-scroll-dots">
					<span class="kmt-woo-loader"></span>
					<span class="kmt-woo-loader"></span>
					<span class="kmt-woo-loader"></span>
					<span class="kmt-woo-loader"></span>
				</div>
			<?php if ( 'button' == $load_more_style ) { ?>
				<div class="kmt-woo-load-more">
					<button class="button woo-load-more-text"><?php echo esc_html( $load_more_text ); ?></button>
				</div>
			<?php } ?>
				<p class="woo-infinite-scroll-end-msg"><?php echo esc_attr( $msg ); ?></p>
			</div>
			<?php
		}

		/**
		 * Get Shop Layout Cookie
		 *
		 * @param string $default default shop layout from cookies.
		 * @return string
		 */
		public function kemet_get_shop_layout_cookie( $default ) {
			global $wp_customize;

			if ( isset( $_COOKIE['kemet_shop_layout'] ) && ! isset( $wp_customize ) ) {
				return sanitize_text_field( wp_unslash( $_COOKIE['kemet_shop_layout'] ) );
			} elseif ( isset( $_COOKIE['kemet_shop_layout'] ) && isset( $wp_customize ) ) {
				ob_start();

				setcookie( 'kemet_shop_layout', kemet_get_option( 'woo-shop-layout' ), 0.1, '/' );

				ob_clean();
			}

			return $default;
		}

		/**
		 * Load shop list style by ajax
		 *
		 * @return void
		 */
		public function ajax_product_list_style() {
			check_ajax_referer( 'shop-load-layout-style-nonce', 'nonce' );

			add_filter(
				'kemet_shop_layout_style',
				function () {
					return 'shop-list';
				}
			);

			do_action( 'ajax_product_layout_style' );

			// prepare our arguments for the query.
			$args = isset( $_POST['query'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ), true ) : '';

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					/**
					 * Woocommerce: woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}
			wp_reset_query();

			wp_die();
		}

		/**
		 * Load shop simple style by ajax
		 *
		 * @return void
		 */
		public function ajax_product_hover_style() {
			check_ajax_referer( 'shop-load-layout-style-nonce', 'nonce' );

			add_filter(
				'kemet_shop_layout_style',
				function () {
					return 'hover-style';
				}
			);

			do_action( 'ajax_product_layout_style' );

			// prepare our arguments for the query.
			$args = isset( $_POST['query'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ), true ) : '';

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					/**
					 * Woocommerce: woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}
			wp_reset_query();

			wp_die();
		}

		/**
		 * Load shop boxed style by ajax
		 *
		 * @return void
		 */
		public function ajax_product_default_style() {
			check_ajax_referer( 'shop-load-layout-style-nonce', 'nonce' );

			add_filter(
				'kemet_shop_layout_style',
				function () {
					return 'shop-grid';
				}
			);

			do_action( 'ajax_product_layout_style' );

			// prepare our arguments for the query.
			$args = isset( $_POST['query'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ), true ) : '';

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					/**
					 * Woocommerce: woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}

			wp_reset_query();

			wp_die();
		}

		/**
		 * Kemet addons Init Woocommerce
		 *
		 * @return void
		 */
		public function init_woocommerce() {

			/**
			 * Init Quick View
			 */
			$qv_enable  = kemet_get_option( 'woo-shop-enable-quick-view' );
			$qv_style   = apply_filters( 'kemet_quick_view_style', kemet_get_option( 'woo-shop-quick-view-style' ) );
			$shop_style = apply_filters( 'kemet_shop_layout_style', kemet_get_option( 'woo-shop-layout' ), 2 );

			if ( $qv_enable && 'shop-grid' == $shop_style ) {
				if ( 'on-image' === $qv_style ) {
					add_action( 'kemet_product_list_image_bottom', array( $this, 'quick_view_on_image' ), 1 );
				} elseif ( 'after-summary' === $qv_style ) {
					add_action( 'kemet_woo_shop_summary_wrap_bottom', array( $this, 'quick_view_button' ), 3 );
				} elseif ( 'qv-icon' === $qv_style ) {
					add_action( 'kemet_product_list_details_bottom', array( $this, 'quick_view_icon' ), 1 );
				}
			} elseif ( $qv_enable && 'hover-style' == $shop_style ) {
				add_action( 'kemet_woo_shop_add_to_cart_after', array( $this, 'quick_view_with_group' ), 1 );
			} elseif ( $qv_enable && 'shop-list' == $shop_style ) {
				add_action( 'kemet_woo_shop_add_to_cart_after', array( $this, 'quick_view_list_style' ), 1 );
			}

			if ( 'shop-list' === $shop_style ) {
				/**
				 * Woocommerce shop/product details div tag
				 *
				 * @return void
				 */
				function kemet_addons_product_list_details() {
					echo '<div class="product-list-details">';
					echo '<a href="' . esc_url( get_the_permalink() ) . '" class="kmt-loop-product__link">';
					do_action( 'kemet_product_list_details_top' );
				}
				/**
				 * Woocommerce shop/product details div close tag
				 *
				 * @return void
				 */
				function kemet_addons_after_shop_loop_item_title() {
					do_action( 'kemet_product_list_details_bottom' );
					echo '</a>';
					echo '</div>';
				}

				/**
				 * Show the product title in the product loop. By default this is an H2
				 *
				 * @return void
				 */
				function kemet_addons_woo_woocommerce_shop_product_content() {
					$shop_structure = kemet_get_option( 'woo-shop-list-product-structure' );

					if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {
						do_action( 'kemet_woo_shop_before_summary_wrap' );
						echo '<div class="kemet-shop-summary-wrap">';
						do_action( 'kemet_woo_shop_summary_wrap_top' );

						foreach ( $shop_structure as $value ) {
							switch ( $value ) {
								case 'title':
									/**
									 * Add Product Title on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_title_before' );
									kemet_woo_shop_products_title();
									do_action( 'kemet_woo_shop_title_after' );
									break;
								case 'price':
									/**
									 * Add Product Price on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_price_before' );
									woocommerce_template_loop_price();
									do_action( 'kemet_woo_shop_price_after' );
									break;
								case 'ratings':
									/**
									 * Add rating on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_rating_before' );
									woocommerce_template_loop_rating();
									do_action( 'kemet_woo_shop_rating_after' );
									break;

								case 'short_desc':
									do_action( 'kemet_woo_shop_short_description_before' );
									kemet_woo_shop_product_short_description();
									do_action( 'kemet_woo_shop_short_description_after' );
									break;
								case 'add_cart':
									do_action( 'kemet_woo_shop_add_to_cart_before' );
									printf( '<div class="%s">', esc_attr( 'add-to-cart-group' ) );
									woocommerce_template_loop_add_to_cart();
									printf( '</div>' );
									do_action( 'kemet_woo_shop_add_to_cart_after' );
									break;
								case 'category':
									/**
									 * Add and/or Remove Categories from shop archive page.
									 */
									do_action( 'kemet_woo_shop_category_before' );
									kemet_woo_shop_parent_category();
									do_action( 'kemet_woo_shop_category_after' );
									break;
								default:
									break;
							}
						}

						do_action( 'kemet_woo_shop_summary_wrap_bottom' );
						echo '</div>';
						do_action( 'kemet_woo_shop_after_summary_wrap' );
					}
				}

				add_action( 'woocommerce_before_shop_loop_item', 'kemet_addons_product_list_details', 8 );
				add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_after_shop_loop_item_title', 1 );
				add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_woo_woocommerce_shop_product_content', 2 );

				remove_action( 'woocommerce_before_shop_loop_item', 'product_list_details', 8 );
				remove_action( 'woocommerce_after_shop_loop_item', 'after_shop_loop_item_title', 1 );
				remove_action( 'woocommerce_after_shop_loop_item', 'kemet_woo_woocommerce_shop_product_content', 2 );
			} elseif ( 'hover-style' == $shop_style ) {
				/**
				 * Woocommerce shop/product details div tag
				 *
				 * @return void
				 */
				function kemet_addons_product_list_details() {
					echo '<div class="product-top">';
					do_action( 'kemet_product_list_details_top' );
					echo '<a href="' . esc_url( get_the_permalink() ) . '" class="kmt-loop-product__link">';
				}
				/**
				 * Woocommerce shop/product details div close tag
				 *
				 * @return void
				 */
				function kemet_addons_after_shop_loop_item_title() {
					echo '</a>';
					echo '<div class="product-btn-group">';
					$out_of_stock = get_post_meta( get_the_ID(), '_stock_status', true );
					do_action( 'kemet_woo_shop_add_to_cart_before' );
					echo '<div class="add-to-cart-group">';
					if ( 'outofstock' === $out_of_stock ) {
						?>
						<a href="javascript:void(0)" class="kmt-out-of-stock button disabled"><?php esc_html_e( 'Out Of Stock', 'kemet-addons' ); ?></a>
						<?php
					} else {
						woocommerce_template_loop_add_to_cart();
					}
					echo '</div>';
					do_action( 'kemet_woo_shop_add_to_cart_after' );

					echo '</div>';
					do_action( 'kemet_product_list_details_bottom' );
					echo '</div>';
				}

				/**
				 * Show the product title in the product loop. By default this is an H2
				 *
				 * @return void
				 */
				function kemet_addons_woo_woocommerce_shop_product_content() {
					$shop_structure = kemet_get_option( 'woo-shop-simple-product-structure' );

					if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {
						do_action( 'kemet_woo_shop_before_summary_wrap' );
						echo '<div class="kemet-shop-summary-wrap">';
						do_action( 'kemet_woo_shop_summary_wrap_top' );

						foreach ( $shop_structure as $value ) {
							switch ( $value ) {
								case 'title':
									/**
									 * Add Product Title on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_title_before' );
									kemet_woo_shop_products_title();
									do_action( 'kemet_woo_shop_title_after' );
									break;
								case 'price':
									/**
									 * Add Product Price on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_price_before' );
									woocommerce_template_loop_price();
									do_action( 'kemet_woo_shop_price_after' );
									break;
								case 'ratings':
									/**
									 * Add rating on shop page for all products.
									 */
									do_action( 'kemet_woo_shop_rating_before' );
									woocommerce_template_loop_rating();
									do_action( 'kemet_woo_shop_rating_after' );
									break;

								case 'short_desc':
									do_action( 'kemet_woo_shop_short_description_before' );
									kemet_woo_shop_product_short_description();
									do_action( 'kemet_woo_shop_short_description_after' );
									break;
								case 'category':
									/**
									 * Add and/or Remove Categories from shop archive page.
									 */
									do_action( 'kemet_woo_shop_category_before' );
									kemet_woo_shop_parent_category();
									do_action( 'kemet_woo_shop_category_after' );
									break;
								default:
									break;
							}
						}

						do_action( 'kemet_woo_shop_summary_wrap_bottom' );
						echo '</div>';
						do_action( 'kemet_woo_shop_after_summary_wrap' );
					}
				}

				add_action( 'woocommerce_before_shop_loop_item', 'kemet_addons_product_list_details', 8 );
				add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_after_shop_loop_item_title', 1 );
				add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_woo_woocommerce_shop_product_content', 2 );
				add_action( 'kemet_woo_shop_add_to_cart_before', array( Kemet_Woocommerce::get_instance(), 'kemet_get_wishlist' ) );

				remove_action( 'kemet_woo_shop_add_to_cart_after', array( Kemet_Woocommerce::get_instance(), 'kemet_get_wishlist' ) );
				remove_action( 'woocommerce_before_shop_loop_item', 'product_list_details', 8 );
				remove_action( 'woocommerce_after_shop_loop_item', 'after_shop_loop_item_title', 1 );
				remove_action( 'woocommerce_after_shop_loop_item', 'kemet_woo_woocommerce_shop_product_content', 2 );
				remove_action( 'woocommerce_shop_loop_item_title', 'kemet_woo_shop_out_of_stock', 8 );
			} elseif ( 'shop-grid' == $shop_style ) {
				add_action( 'woocommerce_before_shop_loop_item', 'product_list_details', 8 );
				add_action( 'woocommerce_after_shop_loop_item', 'after_shop_loop_item_title', 1 );
				add_action( 'woocommerce_after_shop_loop_item', 'kemet_woo_woocommerce_shop_product_content', 2 );

				remove_action( 'woocommerce_before_shop_loop_item', 'kemet_addons_product_list_details', 8 );
				remove_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_after_shop_loop_item_title', 1 );
				remove_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_woo_woocommerce_shop_product_content', 2 );
			}

			/**
			 * Init Off Canvas Sidebar
			 */
			$off_canvas_enable = kemet_get_option( 'woo-shop-enable-filter-button' );

			if ( $off_canvas_enable ) {
				add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_filter_button' ), 15 );
				add_action( 'wp_footer', array( $this, 'off_canvas_filter_sidebar' ) );
			}

			/**
			 * Infinite Scroll
			 */
			$pagination_style = kemet_get_option( 'woo-shop-pagination-style' );

			if ( 'infinite-scroll' == $pagination_style && ( is_shop() || is_product_taxonomy() ) ) {
				remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				add_action( 'woocommerce_after_shop_loop', array( $this, 'infinite_pagination' ), 10 );
			}

			add_action( 'woocommerce_before_shop_loop', array( $this, 'start_tool_bar_div' ) );
			if ( is_shop() || is_product_taxonomy() ) {
				add_action( 'woocommerce_before_shop_loop', array( $this, 'toolbar_buttons' ), 20 );
			}
			add_action( 'woocommerce_before_shop_loop', array( $this, 'end_tool_bar_div' ), 40 );
		}

		/**
		 * Start Tool bar tag
		 *
		 * @return void
		 */
		public function start_tool_bar_div() {
			echo "<div class='kmt-toolbar'>";
		}

		/**
		 * End Tool Bar tag
		 *
		 * @return void
		 */
		public function end_tool_bar_div() {
			echo '</div>';
		}

		/**
		 * Tool Bar Button
		 *
		 * @return void
		 */
		public function toolbar_buttons() {
			$shop_style = kemet_get_option( 'woo-shop-layout' );
			$html       = '<div class="shop-list-style">';
			$html      .= '<span>View As: </span>';
			$html      .= '<a href="#" class="kmt-grid-style" data-layout= ' . $shop_style . '><span class="dashicons dashicons-screenoptions"></span></a>';
			$html      .= '<a href="#" class="kmt-list-style" data-layout="shop-list"><span class="dashicons dashicons-editor-ul"></span></a>';
			$html      .= '</div>';
			$html_args  = kemet_allowed_html( array( 'div', 'a', 'span' ) );

			echo wp_kses(
				$html,
				$html_args
			);
		}

		/**
		 * Register Off Canvas Filter
		 *
		 * @return void
		 */
		public function kemet_register_off_canvas() {
			register_sidebar(
				apply_filters(
					'kemet_off_canvas_filter_widget',
					array(
						'name'          => esc_html__( 'Off Canvas Filter', 'kemet-addons' ),
						'id'            => 'off-canvas-filter-widget',
						'description'   => 'This sidebar will show product filters on Shop page. Check "Enable Filter Button" option from `Customizer > Layout > Woocommerce > Shop` to enable this on Shop page.',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="widget-head"><div class="title"><h4 class="widget-title">',
						'after_title'   => '</h4></div></div>',
					)
				)
			);
		}

		/**
		 * Sale badge content
		 *
		 * @return string
		 */
		public function kemet_sale_flash_content() {
			global $product;

			if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
				$product_price = $product->get_regular_price();
				$sale_price    = $product->get_sale_price();
				$percent       = round( ( ( floatval( $product_price ) - floatval( $sale_price ) ) / floatval( $product_price ) ) * 100 );
			} elseif ( $product->is_type( 'variable' ) ) {
				$available_variations = $product->get_available_variations();
				$maximumper           = 0;
				$counter              = count( $available_variations );
				for ( $i = 0; $i < $counter; ++$i ) {
					$variation_id     = $available_variations[ $i ]['variation_id'];
					$variable_product = new WC_Product_Variation( $variation_id );

					if ( ! $variable_product->is_on_sale() ) {
						continue;
					}

					$product_price = $variable_product->get_regular_price();
					$sale_price    = $variable_product->get_sale_price();
					$percent       = round( ( ( floatval( $product_price ) - floatval( $sale_price ) ) / floatval( $product_price ) ) * 100 );

					if ( $percent > $maximumper ) {
						$maximumper = $percent;
					}
				}

				$percent = sprintf( esc_html( '%s' ), $maximumper );
			} else {
				$percent = '<span class="onsale">' . esc_html__( 'Sale!', 'kemet-addons' ) . '</span>';
				return $percent;
			}

			$value = '-' . esc_html( $percent ) . '%';

			return '<span class="onsale">' . esc_html( $value ) . '</span>';
		}

		/**
		 * Add off canvas filter button
		 *
		 * @return void
		 */
		public function off_canvas_filter_button() {
			$label     = kemet_get_option( 'woo-shop-off-canvas-filter-label' );
			$button    = '<a href="#" class="kmt-woo-filter">' . $label . '</a>';
			$html_args = kemet_allowed_html( array( 'a' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Add off canvas filter sidebar
		 *
		 * @return void
		 */
		public function off_canvas_filter_sidebar() {
			echo '<div id="kmt-off-canvas-wrap">';
			echo '<div class="kmt-off-canvas-sidebar">';
			echo '<a href="javascript:void(0)" class="kmt-close-filter"><span class="dashicons dashicons-no-alt"></span></a>';
			echo kemet_get_custom_widget( 'off-canvas-filter' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
			echo '<div class="kmt-off-canvas-overlay"></div>';
			echo '</div>';
		}



		/**
		 * Single Product add to cart ajax request
		 *
		 * @return void
		 */
		public function kemet_add_cart_single_product() {
			add_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

			if ( is_callable( array( 'WC_AJAX', 'get_refreshed_fragments' ) ) ) {
				WC_AJAX::get_refreshed_fragments();
			}

			die();
		}

		/**
		 * Footer markup
		 *
		 * @return void
		 */
		public function qv_product_images_markup() {
			kemetaddons_get_template( 'woocommerce/templates/quick-view-product-image.php' );
		}

		/**
		 * Quick view html
		 *
		 * @return void
		 */
		public function quick_view_html() {
			$this->quick_view_dependent_data();

			kemetaddons_get_template( 'woocommerce/templates/quick-view-model.php' );
		}

		/**
		 * Quick view dependent data
		 *
		 * @return void
		 */
		public function quick_view_dependent_data() {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'flexslider' );
		}

		/**
		 * Quick view button
		 *
		 * @return void
		 */
		public function quick_view_button() {
			global $product;

			$product_id = $product->get_id();

			// Get label.
			$label     = __( 'Quick View', 'kemet-addons' );
			$button    = '<div class="kmt-qv-btn-wrap">';
			$button   .= '<a href="#" class="button kmt-quick-view" data-product_id="' . $product_id . '">' . $label . '</a>';
			$button   .= '</div>';
			$html_args = kemet_allowed_html( array( 'div', 'a' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Quick view on image
		 *
		 * @return void
		 */
		public function quick_view_on_image() {
			global $product;

			$product_id = $product->get_id();

			$button    = '<a href="#" class="kmt-qv-on-image" data-product_id="' . $product_id . '">' . __( 'Quick View', 'kemet-addons' ) . '</a>';
			$html_args = kemet_allowed_html( array( 'a' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Quick view on image
		 *
		 * @return void
		 */
		public function quick_view_list_style() {
			global $product;

			$product_id = $product->get_id();

			$button    = '<a href="#" class="kmt-qv-on-list button" data-product_id="' . $product_id . '"><span class="kmt-quick-view-icon"></span></a>';
			$html_args = kemet_allowed_html( array( 'a', 'span' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Quick view Icon
		 *
		 * @return void
		 */
		public function quick_view_icon() {
			global $product;

			$product_id = $product->get_id();

			$button    = '<a href="#" class="kmt-qv-icon" data-product_id="' . $product_id . '"><span class="kemet-view"><svg data-name="Layer 1" viewBox="0 0 90 71.1" xmlns="http://www.w3.org/2000/svg">
			<path transform="translate(-2.5 -12)" d="M79.2,25.6C73.7,20.5,62.2,12,47.5,12S21.3,20.6,15.8,25.6C7.9,32.8,2.5,41.8,2.5,47.5S7.9,62.2,15.8,69.4c5.5,5.1,17,13.7,31.7,13.7s26.2-8.6,31.7-13.6C87,62.3,92.5,53.3,92.5,47.6S87.1,32.8,79.2,25.6ZM47.5,78.1C25.6,78.1,7.4,55.9,7.4,47.5S25.6,16.9,47.5,16.9,87.6,39.1,87.6,47.5,69.4,78.1,47.5,78.1Z"/>
			<path transform="translate(-2.5 -12)" d="m47.5 28.5a19 19 0 1 0 19 19 19 19 0 0 0-19-19zm0 33.1a14.1 14.1 0 1 1 14.1-14.1 14.08 14.08 0 0 1-14.1 14.1z"/>
			</svg></span></a>';
			$html_args = kemet_allowed_html( array( 'a', 'span', 'svg' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Quick view Icon
		 *
		 * @return void
		 */
		public function quick_view_with_group() {
			global $product;

			$product_id = $product->get_id();

			$button    = '<a href="#" class="button kmt-quickview-icon" data-product_id="' . $product_id . '"></a>';
			$html_args = kemet_allowed_html( array( 'a' ) );

			echo wp_kses(
				$button,
				$html_args
			);
		}

		/**
		 * Theme Js Localize
		 *
		 * @param object $localize localize vars.
		 * @return object
		 */
		public function woocommerce_js_localize( $localize ) {
			global $wp_query;
			$single_ajax_add_to_cart = kemet_get_option( 'enable-single-ajax-add-to-cart' );
			$pagination_style        = kemet_get_option( 'woo-shop-pagination-style' );

			if ( is_singular( 'product' ) ) {
				$product = wc_get_product( get_the_id() );
				if ( false !== $product && $product->is_type( 'external' ) ) {
					$single_ajax_add_to_cart = false;
				}
			}
			$check_page                            = is_shop() || is_product_taxonomy() ? true : false;
			$localize['ajax_url']                  = admin_url( 'admin-ajax.php' );
			$localize['is_cart']                   = is_cart();
			$localize['is_single_product']         = is_product();
			$localize['view_cart']                 = esc_attr__( 'View cart', 'kemet-addons' );
			$localize['cart_url']                  = apply_filters( 'kemet_woocommerce_add_to_cart_redirect', wc_get_cart_url() );
			$localize['single_ajax_add_to_cart']   = $single_ajax_add_to_cart;
			$localize['query_vars']                = wp_json_encode( $wp_query->query_vars );
			$localize['shop_load_layout_style']    = wp_create_nonce( 'shop-load-layout-style-nonce' );
			$localize['in_customizer']             = is_customize_preview() ? true : false;
			$localize['shop_infinite_count']       = 2;
			$localize['shop_infinite_total']       = $wp_query->max_num_pages;
			$localize['pagination_style']          = $pagination_style;
			$localize['shop_infinite_nonce']       = wp_create_nonce( 'kmt-shop-load-more-nonce' );
			$localize['is_shop']                   = apply_filters( 'kemet_woocommerce_styles_enable', $check_page );
			$localize['woo_infinite_scroll_style'] = kemet_get_option( 'woo-shop-load-more-style' );

			return $localize;
		}

		/**
		 * Quick view ajax
		 *
		 * @return void
		 */
		public function kemet_quick_view_ajax() {
			if ( ! isset( $_REQUEST['product_id'] ) ) {
				die();
			}

			$product_id = intval( $_REQUEST['product_id'] );

			// wp_query for the product.
			wp( 'p=' . $product_id . '&post_type=product' );

			ob_start();

			// load content template.
			kemetaddons_get_template( 'woocommerce/templates/quick-view-product.php' );

			echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			die();
		}

		/**
		 * Enqueues scripts for Woocommerce
		 *
		 * @return void
		 */
		public function add_scripts() {
			$js_prefix = '.min.js';
			$dir       = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix = '.js';
				$dir       = 'unminified';
			}
			$single_ajax_add_to_cart = kemet_get_option( 'enable-single-ajax-add-to-cart' );
			$shop_style              = apply_filters( 'kemet_shop_layout_style', kemet_get_option( 'woo-shop-layout' ) );
			$qv_enable               = kemet_get_option( 'woo-shop-enable-quick-view' );
			$qv_style                = apply_filters( 'kemet_quick_view_style', kemet_get_option( 'woo-shop-quick-view-style' ) );

			if ( $qv_enable ) {
				Kemet_Style_Generator::kmt_add_js( KEMET_WOOCOMMERCE_DIR . 'assets/js/' . $dir . '/quick-view' . $js_prefix );
			}
			if ( $single_ajax_add_to_cart || $qv_enable ) {
				Kemet_Style_Generator::kmt_add_js( KEMET_WOOCOMMERCE_DIR . 'assets/js/' . $dir . '/single-product-ajax-cart' . $js_prefix );
			}

			Kemet_Style_Generator::kmt_add_js( KEMET_WOOCOMMERCE_DIR . 'assets/js/' . $dir . '/woocommerce' . $js_prefix );
		}

		/**
		 * Enqueues styles for Woocommerce
		 *
		 * @return void
		 */
		public function add_styles() {
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
			Kemet_Style_Generator::kmt_add_css( KEMET_WOOCOMMERCE_DIR . 'assets/css/' . $dir . '/style' . $css_prefix );
		}
	}
}
Kemet_Addon_Woocommerce_Partials::get_instance();
