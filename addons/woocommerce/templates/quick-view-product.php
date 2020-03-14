<?php
/**
 * WooCommerce - Quick View Product
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
while ( have_posts() ) :
	the_post(); 
	?>
<div class="kmt-woo-product">
	<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
		<?php do_action( 'kemet_woo_qv_product_image' ); ?>
		<div class="summary entry-summary">
			<div class="summary-content">
				<?php do_action( 'kemet_woo_quick_view_product_summary' ); ?>
			</div>
		</div>
	</div>
</div>
	<?php
endwhile; // end of the loop.
