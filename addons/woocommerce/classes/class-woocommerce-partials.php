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
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'kemet_shop_template_loader' ) , 1);
            add_action( 'woocommerce_before_shop_loop_item', array( $this, 'product_list_details' ) , 8);
            add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'after_shop_loop_item_title' ) , 10);
        }

        
        function product_list_details() {
            echo '<div class="product-list-details">';
        }

       
        function after_shop_loop_item_title() {

            kemet_woo_woocommerce_template_loop_product_title();
            echo '</div>';
        }

        public function kemet_shop_template_loader() {
            remove_action( 'woocommerce_after_shop_loop_item', 'kemet_woo_woocommerce_shop_product_content' );
            $shop_structure = apply_filters( 'kemet_woo_shop_product_structure', kemet_get_option( 'shop-product-structure' ) );

            if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {

                do_action( 'kemet_woo_shop_before_summary_wrap' );
                echo '<div class="kemet-shop-summary-wrap">';
                do_action( 'kemet_woo_shop_summary_wrap_top' );
                foreach ( $shop_structure as $value ) {

                    switch ( $value ) {
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
