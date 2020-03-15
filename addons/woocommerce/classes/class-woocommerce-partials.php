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
            add_filter( 'kemet_theme_js_localize', array( $this, 'wooCommerce_js_localize' ) );
			add_action( 'wp_ajax_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
            add_action( 'wp_ajax_nopriv_kemet_load_quick_view', array( $this, 'kemet_quick_view_ajax' ) );
            add_action( 'kemet_woo_shop_summary_wrap_bottom', array( $this, 'quick_view_button' ), 3 );
            add_action( 'wp_footer', array( $this, 'quick_view_html' ) );
			add_action( 'kemet_woo_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'kemet_woo_qv_product_image', array( $this, 'qv_product_images_markup' ), 20 );
			add_action( 'wp_ajax_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
			add_action( 'wp_ajax_nopriv_kemet_add_cart_single_product', array( $this, 'kemet_add_cart_single_product' ) );
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

			$button = '<a href="#" class="kmt-quick-view" data-product_id="' . $product_id . '">' . $label . '</a>';

			echo $button;
        }
        /**
		 * Theme Js Localize
		 */
        function wooCommerce_js_localize( $localize ) {
			$localize['ajax_url'] = admin_url( 'admin-ajax.php' );
			$localize['is_cart']                         = is_cart();
			$localize['is_single_product']               = is_product();
			$localize['view_cart']                       = esc_attr__( 'View cart', 'kemet-addons' );
			$localize['cart_url']                        = apply_filters( 'kemet_woocommerce_add_to_cart_redirect', wc_get_cart_url() );

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

			 Kemet_Style_Generator::kmt_add_js(KEMET_WOOCOMMERCE_DIR.'assets/js/'. $dir .'/quick-view' . $js_prefix);
			 Kemet_Style_Generator::kmt_add_js(KEMET_WOOCOMMERCE_DIR.'assets/js/'. $dir .'/single-product-ajax-cart' . $js_prefix);
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
