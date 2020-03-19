<?php
/**
 * Woocommerce
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Woocommerce_Partials')) {

    /**
     * Woocommerce
     *
     * @since 1.0.3
     */
    class Kemet_Woocommerce_Partials
    {

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
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'wp_ajax_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
			add_action( 'wp_footer', array( $this, 'quick_view_html' ) );
			add_action( 'kemet_woo_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'kemet_woo_qv_product_image', array( $this, 'qv_product_images_markup' ), 20 );
			add_filter( 'kemet_theme_js_localize', array( $this, 'wooCommerce_js_localize' ) );
			add_action( 'wp_ajax_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
			add_action( 'wp_ajax_nopriv_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
			add_filter( 'body_class', array( $this, 'shop_layout' ) );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_product_args' ) );
			add_action( 'wp', array( $this, 'init_woocommerce' ) );
			add_action( 'widgets_init', array( $this,'kemet_register_off_canvas' ) );
			add_filter( 'post_class', array( $this, 'product_classes' ) );
        }
		
		/**
		 * Product Classes
		 */
		function product_classes( $classes ){
			$gallay_style = kemet_get_option('product-gallary-style');

			if ( post_type_exists( 'product' ) ) {
				$classes[] = 'kmt-gallary-' . $gallay_style; 
			}

			return $classes;
		}
		/**
		 * Init Woocommerce
		 */
		function init_woocommerce(){
			/**
			 * Init Quick View
			 */
			$qv_enable = kemet_get_option('enable-quick-view');

			if( $qv_enable != 'disabled' ){
				if( $qv_enable === 'on-image' ){
					add_action( 'kemet_product_list_details_bottom', array( $this, 'quick_view_on_image' ) , 1);
				}else if( $qv_enable === 'after-summary' ){
					add_action( 'kemet_woo_shop_summary_wrap_bottom', array( $this, 'quick_view_button' ), 3 );
				}else if( $qv_enable === 'qv-icon' ){
					add_action( 'kemet_product_list_details_bottom', array( $this, 'quick_view_icon' ), 1 );
				}
			}

			if(kemet_get_option( 'shop-layout' ) == 'shop-list'){
			/**
			 * Woocommerce shop/product details div tag.
			 */
			function kemet_addons_product_list_details() {

				echo '<div class="product-list-details">';
				do_action( 'kemet_product_list_details_top' );
				echo '<a href="' . esc_url( get_the_permalink() ) . '" class="kmt-loop-product__link">';
			}
			add_action( 'woocommerce_before_shop_loop_item', 'kemet_addons_product_list_details' , 8);
			/**
			 * Woocommerce shop/product details div close tag.
			 */      
			function kemet_addons_after_shop_loop_item_title() {
				echo '</a>';
				do_action( 'kemet_product_list_details_bottom' );
				echo '</div>';
				
			}
			add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_after_shop_loop_item_title' ,1);

			/**
			 * Show the product title in the product loop. By default this is an H2.
			 */
			function kemet_addons_woo_woocommerce_shop_product_content() {

				$shop_structure = kemet_get_option( 'shop-list-product-structure' );

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
								kemet_woo_woocommerce_template_loop_product_title();
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
								woocommerce_template_loop_add_to_cart();
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
			add_action( 'woocommerce_after_shop_loop_item', 'kemet_addons_woo_woocommerce_shop_product_content' , 2);

			remove_action( 'woocommerce_before_shop_loop_item', 'product_list_details' , 8);
			remove_action( 'woocommerce_after_shop_loop_item', 'after_shop_loop_item_title' ,1);
			remove_action( 'woocommerce_after_shop_loop_item', 'kemet_woo_woocommerce_shop_product_content' ,2);
			}
			/**
			 * Disable Related Products.
			 */
			$disable_related_products = kemet_get_option('disable-related-products');

			if($disable_related_products){
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}

			/**
			 * Init Off Canvas Sidebar
			 */
			$off_canvas_enable = kemet_get_option('enable-filter-button');

			if($off_canvas_enable){
				add_action( 'woocommerce_before_shop_loop', array( $this, 'off_canvas_filter_button' ), 10 );
				add_action( 'wp_footer', array( $this, 'off_canvas_filter_sidebar' ) );
			}

			/**
			 * Sale badge content
			 */
			$sale_content = kemet_get_option('enable-filter-button');

			if($sale_content == 'percent'){
				add_filter( 'woocommerce_sale_flash', array( $this, 'kemet_sale_flash_content' ), 10, 3 );
			}
		}
		
		/**
		 * Register Off Canvas Filter
		 */
		function kemet_register_off_canvas(){
			register_sidebar(
				apply_filters(
						'kemet_off_canvas_filter_widget', array(
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
		 */
		function kemet_sale_flash_content() {
			global $product;

			if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {

				$product_price 	= $product->get_regular_price();
				$sale_price 	= $product->get_sale_price();
				$percent 	= round( ( ( floatval( $product_price ) - floatval( $sale_price ) ) / floatval( $product_price ) ) * 100 );

			} else if ( $product->is_type( 'variable' ) ) {

				$available_variations = $product->get_available_variations();
				$maximumper           = 0;

				for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
					$variation_id     = $available_variations[ $i ]['variation_id'];
					$variable_product = new WC_Product_Variation( $variation_id );

					if ( ! $variable_product->is_on_sale() ) {
						continue;
					}

					$product_price 	= $variable_product->get_regulaproduct_price();
					$sale_price    = $variable_product->get_sale_price();
					$percent 	= round( ( ( floatval( $product_price ) - floatval( $sale_price ) ) / floatval( $product_price ) ) * 100 );

					if ( $percent > $maximumper ) {
						$maximumper = $percent;
					}
				}

				$percent = sprintf( __( '%s', 'kemet-addons' ), $maximumper );

			} else {

				$percent = '<span class="onsale">' . __( 'Sale!', 'kemet-addons' ) . '</span>';
				return $percent;

			}

			$value = '-' . esc_html( $percent ) . '%';

			return '<span class="onsale">' . esc_html( $value ) . '</span>';
		}
		/**
		 * Add off canvas filter button.
		 */
		function off_canvas_filter_button() {

			$label = kemet_get_option('off-canvas-filter-label');
			$button = '<a href="#" class="kmt-woo-filter">'. $label . '</a>';

			echo $button;
		}

		/**
		 * Add off canvas filter sidebar.
		 */
		function off_canvas_filter_sidebar() {

			echo '<div id="kmt-off-canvas-wrap">';
			echo '<div class="kmt-off-canvas-sidebar">';
			echo '<a href="#" class="kmt-close-filter"><span class="dashicons dashicons-no-alt"></span></a>';
			echo kemet_get_custom_widget( 'off-canvas-filter' );
			echo '</div>';
			echo '<div class="kmt-off-canvas-overlay"></div>';
			echo '</div>';
		}

		/**
		 * related product arguments.
		 */
		function related_product_args() {

			global $product, $orderby, $related;

			// Related posts per page
			$products_per_page = kemet_get_option('related-products-count');
			$products_per_page = $products_per_page ? $products_per_page : '3';

			// Related columns
			$columns = kemet_get_option('related-products-colunms');
			$columns = $columns ? $columns : '3';

			$args = array(
				'posts_per_page' => $products_per_page,
				'columns'        => $columns,
			);

			return $args;

		}

		/**
		 * Shop Layout
		 */
		function shop_layout($classes){
			$layout_style = kemet_get_option('shop-layout');
			$content_alignment = kemet_get_option('product-content-alignment');
			$classes[] = 'content-align-' .  $content_alignment;
			if(in_array('shop-grid' , $classes)){
				$layout_class = array_search('shop-grid', $classes);
				unset($classes[$layout_class]);
			}
			
			$classes[] = $layout_style;
			
			
			return $classes;
		}
		/**
		 * Single Product add to cart ajax request
		 */
		function kemet_add_cart_single_product() {
			add_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

			if ( is_callable( array( 'WC_AJAX', 'get_refreshed_fragments' ) ) ) {
				WC_AJAX::get_refreshed_fragments();
			}

			die();
		}
        /**
		 * Footer markup.
		 */
		function qv_product_images_markup() {

			kemetaddons_get_template( 'woocommerce/templates/quick-view-product-image.php' );
		}
        /**
		 * Quick view html
		 */
		function quick_view_html() {

			$this->quick_view_dependent_data();

			kemetaddons_get_template( 'woocommerce/templates/quick-view-model.php' );
        }
        
        /**
		 * Quick view dependent data
		 */
		function quick_view_dependent_data() {

			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'flexslider' );
        }
        
        /**
		 * Quick view button
		 */
        function quick_view_button(){
            global $product;

			$product_id = $product->get_id();

			// Get label.
			$label = __( 'Quick View', 'kemet-addon' );
			$button = '<div class="kmt-qv-btn-wrap">';
			$button .= '<a href="#" class="button kmt-quick-view" data-product_id="' . $product_id . '">' . $label . '</a>';
			$button .= '</div>';

			echo $button;
		}
		/**
		 * Quick view on image
		 */
        function quick_view_on_image(){
            global $product;

			$product_id = $product->get_id();

			$button = '<a href="#" class="kmt-qv-on-image" data-product_id="' . $product_id . '"></a>';

			echo $button;
		}
		/**
		 * Quick view Icon
		 */
        function quick_view_icon(){
            global $product;

			$product_id = $product->get_id();

			$button = '<a href="#" class="kmt-qv-icon" data-product_id="' . $product_id . '"><span class="dashicons dashicons-visibility"></span></a>';

			echo $button;
        }
        /**
		 * Theme Js Localize
		 */
        function wooCommerce_js_localize( $localize ) {

			$single_ajax_add_to_cart = kemet_get_option( 'enable-single-ajax-add-to-cart' );

			if ( is_singular( 'product' ) ) {
				$product = wc_get_product( get_the_id() );
				if ( false !== $product && $product->is_type( 'external' ) ) {
					$single_ajax_add_to_cart = false;
				}
			}
			$localize['ajax_url'] 						 = admin_url( 'admin-ajax.php' );
			$localize['is_cart']                         = is_cart();
			$localize['is_single_product']               = is_product();
			$localize['view_cart']                       = esc_attr__( 'View cart', 'kemet-addons' );
			$localize['cart_url']                        = apply_filters( 'kemet_woocommerce_add_to_cart_redirect', wc_get_cart_url() );
			$localize['single_ajax_add_to_cart'] 	     = $single_ajax_add_to_cart;

            return $localize;
        }
        /**
		 * Quick view ajax
		 */
		function kemet_quick_view_ajax() {

			if ( ! isset( $_REQUEST['product_id'] ) ) {
				die();
			}

            $product_id = intval( $_REQUEST['product_id'] );
            
			// wp_query for the product.
			wp( 'p=' . $product_id . '&post_type=product' );
            
            ob_start();
            
            // load content template.
            kemetaddons_get_template( 'woocommerce/templates/quick-view-product.php' );
            
			echo ob_get_clean();

			die();
        }
        
        public function add_scripts() {
            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}
			$single_ajax_add_to_cart = kemet_get_option( 'enable-single-ajax-add-to-cart' );
			if(kemet_get_option('enable-quick-view') != 'disabled'){
				Kemet_Style_Generator::kmt_add_js(KEMET_WOOCOMMERCE_DIR.'assets/js/'. $dir .'/quick-view' . $js_prefix);
			}
			if($single_ajax_add_to_cart || kemet_get_option('enable-quick-view') != 'disabled'){
			 	Kemet_Style_Generator::kmt_add_js(KEMET_WOOCOMMERCE_DIR.'assets/js/'. $dir .'/single-product-ajax-cart' . $js_prefix);
			}
			Kemet_Style_Generator::kmt_add_js(KEMET_WOOCOMMERCE_DIR.'assets/js/'. $dir .'/woocommerce' . $js_prefix);
        }
        
        function add_styles() {

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
            Kemet_Style_Generator::kmt_add_css( KEMET_WOOCOMMERCE_DIR . 'assets/css/'. $dir  .'/style' . $css_prefix);

	    }
    }
}
Kemet_Woocommerce_Partials::get_instance();
