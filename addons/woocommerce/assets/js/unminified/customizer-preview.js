(function ($) {
    /**
	 * Sale
	 */
	wp.customize('kemet-settings[sale-style]', function (setting) {
		setting.bind(function (radius) {

			var dynamicStyle = '.woocommerce .product .onsale { border-radius: ' + (parseInt(radius)) + '% }';

				
			kemet_add_dynamic_css('sale-style', dynamicStyle);

		});
	});
	/**
	 * Image Width
	 */
	wp.customize('kemet-settings[product-image-width]', function (setting) {
		setting.bind(function (width) {

			var dynamicStyle = '.woocommerce #content .kmt-woocommerce-container div.product div.images, .woocommerce .kmt-woocommerce-container div.product div.images, .woocommerce-page #content .kmt-woocommerce-container div.product div.images, .woocommerce-page .kmt-woocommerce-container div.product div.images { width: ' + (parseInt(width)) + '% }';
			dynamicStyle += '.woocommerce #content .kmt-woocommerce-container div.product div.images, .woocommerce .kmt-woocommerce-container div.product div.images, .woocommerce-page #content .kmt-woocommerce-container div.product div.images, .woocommerce-page .kmt-woocommerce-container div.product div.images { max-width: ' + (parseInt(width)) + '% }';
				
			kemet_add_dynamic_css('product-image-width', dynamicStyle);

		});
	});
	/**
	 * Summary Width
	 */
	wp.customize('kemet-settings[product-summary-width]', function (setting) {
		setting.bind(function (width) {

			var dynamicStyle = '.woocommerce #content .kmt-woocommerce-container div.product div.summary, .woocommerce .kmt-woocommerce-container div.product div.summary, .woocommerce-page #content .kmt-woocommerce-container div.product div.summary, .woocommerce-page .kmt-woocommerce-container div.product div.summary { width: ' + (parseInt(width)) + '% }';

			dynamicStyle += '.woocommerce #content .kmt-woocommerce-container div.product div.summary, .woocommerce .kmt-woocommerce-container div.product div.summary, .woocommerce-page #content .kmt-woocommerce-container div.product div.summary, .woocommerce-page .kmt-woocommerce-container div.product div.summary { max-width: ' + (parseInt(width)) + '% }';

				
			kemet_add_dynamic_css('product-summary-width', dynamicStyle);

		});
	});

	kemet_css('kemet-settings[infinite-scroll-loader-color]', 'background-color', '.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader');
})(jQuery);
