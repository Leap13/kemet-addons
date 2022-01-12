<?php
/**
 * WooCommerce
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Woocommerce_Partials' ) ) {

	/**
	 * WooCommerce Partials
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

			if ( class_exists( 'Kemet_Woocommerce' ) ) {
				$kemet_woocommerce_instance = Kemet_Woocommerce::get_instance();
				add_action( 'kemet_infinite_scroll', array( $kemet_woocommerce_instance, 'shop_customization' ) );
				add_action( 'kemet_infinite_scroll', array( $kemet_woocommerce_instance, 'woocommerce_init' ) );
			}

			add_action( 'kemet_infinite_scroll', array( $this, 'init_woocommerce' ) );
			add_action( 'wp_ajax_kemet_infinite_scroll', array( $this, 'kemet_infinite_scroll' ) );
			add_action( 'wp_ajax_nopriv_kemet_infinite_scroll', array( $this, 'kemet_infinite_scroll' ) );
			add_action( 'kemet_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Add Google Fonts
		 */
		public function add_fonts() {
			$typography = kemet_get_option( 'woo-shop-product-button-typography' );
			Kemet_Fonts::add_font_form_typography( $typography );
		}

		/**
		 * Shop Layout
		 *
		 * @param array $classes body classes.
		 * @return array
		 */
		public function shop_layout( $classes ) {
			$layout_style = apply_filters( 'kemet_shop_layout_style', kemet_get_option( 'woo-shop-layout' ) );
			if ( in_array( 'woo-style1', $classes ) ) {
				$layout_class = array_search( 'woo-style1', $classes );
				unset( $classes[ $layout_class ] );
				$classes[] = $layout_style;
			}

			return $classes;
		}

		/**
		 * Infinite Scroll
		 *
		 * @return void
		 */
		public function kemet_infinite_scroll() {
			check_ajax_referer( 'kmt-shop-load-more-nonce', 'nonce' );

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
					 * WooCommerce: woocommerce_shop_loop hook.
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
		 * Kemet addons Init WooCommerce
		 *
		 * @return void
		 */
		public function init_woocommerce() {
			// Init Quick View.
			$qv_enable  = kemet_get_option( 'woo-shop-enable-quick-view' );
			$qv_style   = apply_filters( 'kemet_quick_view_style', kemet_get_option( 'woo-shop-quick-view-style' ) );
			$shop_style = apply_filters( 'kemet_shop_layout_style', kemet_get_option( 'woo-shop-layout' ), 2 );

			if ( $qv_enable ) {
				add_action( 'kemet_woo_shop_add_to_cart_after', array( $this, 'quick_view_with_group' ), 1 );
			}

			// Styles hooks.
			if ( 'woo-style2' == $shop_style ) {
				add_action( 'woocommerce_after_shop_loop_item', array( $this, 'woo_woocommerce_shop_product_content' ) );
				add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'filter_add_to_cart_link_link' ), 9, 3 );

				remove_filter( 'woocommerce_product_loop_start', array( Kemet_Woocommerce::get_instance(), 'add_filter_for_add_to_cart_link' ) );
				remove_action( 'woocommerce_before_shop_loop_item', 'product_list_details', 8 );
				remove_action( 'woocommerce_after_shop_loop_item', 'after_shop_loop_item_title', 1 );
				remove_action( 'woocommerce_shop_loop_item_title', 'kemet_woo_woocommerce_shop_product_content', 2 );
				remove_action( 'woocommerce_shop_loop_item_title', 'kemet_woo_shop_out_of_stock', 8 );
			}

			// Init Off Canvas Sidebar.
			$off_canvas_enable = kemet_get_option( 'woo-shop-enable-filter-button' );

			if ( $off_canvas_enable ) {
				add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_filter_button' ), 15 );
				add_action( 'wp_footer', array( $this, 'off_canvas_filter_sidebar' ) );
			}

			// Infinite Scroll.
			$pagination_style = kemet_get_option( 'woo-shop-pagination-style' );

			if ( 'infinite-scroll' == $pagination_style && ( is_shop() || is_product_taxonomy() ) ) {
				remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				add_action( 'woocommerce_after_shop_loop', array( $this, 'infinite_pagination' ), 10 );
			}

			add_action( 'woocommerce_before_shop_loop', array( $this, 'start_tool_bar_div' ) );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'end_tool_bar_div' ), 40 );
		}

		/**
		 * woo_woocommerce_shop_product_content
		 *
		 * @return void
		 */
		function woo_woocommerce_shop_product_content() {
			$button_style = kemet_get_option( 'woo-shop-button-style', 'text' );

			echo '<div class="product-summary" data-style="' . esc_attr( $button_style ) . '">';

			echo '<div class="product-info">';
			kemet_shop_loop_item_structure();
			echo '</div>';

			do_action( 'kemet_woo_shop_before_product_buttons' );
			echo '<div class="kemet-shop-product-buttons">';
			do_action( 'kemet_woo_shop_product_buttons_top' );

			do_action( 'kemet_woo_shop_add_to_cart_before' );
			woocommerce_template_loop_add_to_cart();
			do_action( 'kemet_woo_shop_add_to_cart_after' );

			do_action( 'kemet_woo_shop_product_buttons_bottom' );
			echo '</div>';
			do_action( 'kemet_woo_shop_after_product_buttons' );

			echo '</div>';
		}

		/**
		 * Adds filter to add svgs to add to cart link for product archives.
		 *
		 * @param string $html the html to start a loop.
		 * @return string $html the html to start a loop.
		 */
		public function add_filter_for_add_to_cart_link( $html ) {
			add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'filter_add_to_cart_link_link' ), 9, 3 );
			return $html;
		}

		/**
		 * Adds Arrow to add to cart button.
		 *
		 * @param string $button Current classes.
		 * @param object $product Product object.
		 * @param array  $args The Product args.
		 */
		public function filter_add_to_cart_link_link( $button, $product, $args = array() ) {
			$button_style  = kemet_get_option( 'woo-shop-button-style', 'text' );
			$args['class'] = explode( ' ', $args['class'] );
			if ( 'button' === $args['class'][0] && 'text' === $button_style ) {
				unset( $args['class'][0] );
			}
			$button = sprintf(
				'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? implode( ' ', $args['class'] ) : 'button' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				esc_html( $product->add_to_cart_text() )
			);
			return $button;
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
						'description'   => 'This sidebar will show product filters on Shop page. Check "Enable Filter Button" option from `Customizer > Layout > WooCommerce > Shop` to enable this on Shop page.',
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
			$button    = '<a href="#" class="kmt-woo-filter">' . Kemet_Svg_Icons::get_icons( 'menu' ) . $label . '</a>';
			$html_args = kemet_allowed_html( array( 'a', 'svg', 'span' ) );

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
			echo Kemet_Builder_Helper::get_custom_widget( 'off-canvas-filter-widget' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
		 * Quick view Icon
		 *
		 * @return void
		 */
		public function quick_view_with_group() {
			global $product;

			$product_id = $product->get_id();

			$button    = '<a href="#" class="kmt-quickview-icon" data-product_id="' . $product_id . '">' . Kemet_Svg_Icons::get_icons( 'view' ) . '</a>';
			$html_args = kemet_allowed_html( array( 'a', 'svg', 'span' ) );

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
		 * Enqueues scripts for WooCommerce
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
		 * Enqueues styles for WooCommerce
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
