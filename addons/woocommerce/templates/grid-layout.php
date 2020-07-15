<?php
/**
 * Woocommerce shop/product details div tag.
 */
function kemet_addons_product_list_details() {

    echo '<div class="product-top">';
    do_action( 'kemet_product_list_details_top' );
    echo '<a href="' . esc_url( get_the_permalink() ) . '" class="kmt-loop-product__link">';
    
}
add_action( 'woocommerce_before_shop_loop_item', 'kemet_addons_product_list_details' , 8);
/**
 * Woocommerce shop/product details div close tag.
 */      
function kemet_addons_after_shop_loop_item_title() {
    echo '</a>';
    echo '<div class="product-btn-group">';

    if ( class_exists( 'TInvWL_Wishlist' ) ) {
        echo '<div class="button woo-wishlist-btn">'. do_shortcode( '[ti_wishlists_addtowishlist]' ) .'</div>';
    }

    do_action( 'kemet_woo_shop_add_to_cart_before' );
    woocommerce_template_loop_add_to_cart();
    do_action( 'kemet_woo_shop_add_to_cart_after' );
    
    echo "</div>";
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