<?php
/**
 * WooCommerce - Product Images
 *
 * @package Kemet Addons
 */

?>
<div id="kmt-qv-wrap">
	<div class="kmt-qv-container">
		<div class="kmt-qv-content-wrap">
			<div class="kmt-qv-content-inner">
				<a href="#" class="kmt-qv-close">
					<?php
					echo wp_kses(
						Kemet_Svg_Icons::get_icons( 'close' ),
						kemet_allowed_html( array( 'svg', 'span' ) )
					);
					?>
				</a>
				<div id="kmt-qv-content" class="woocommerce single-product"></div>
			</div>
		</div>
	</div>
	<div class="kmt-close-qv"></div>
</div>
<div class="kmt-qv-overlay"></div>
