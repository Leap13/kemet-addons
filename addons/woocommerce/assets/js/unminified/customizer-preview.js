(function ($) {
    /**
	 * Sale
	 */
	wp.customize('kemet-settings[sale-style]', function (setting) {
		setting.bind(function (radius) {

			var dynamicStyle = '.woocommerce ul.products li.product .onsale { border-radius: ' + (parseInt(radius)) + '% }';

				
			kemet_add_dynamic_css('sale-style', dynamicStyle);

		});
	});
})(jQuery);
