(function ($) {
    kemet_css('kemet-settings[sticky-menu-link-color]', 'color', '.kmt-is-sticky .main-header-menu a');
    kemet_css('kemet-settings[sticky-menu-link-h-color]', 'color', '.kmt-is-sticky .main-header-menu li:hover a,.kmt-is-sticky .main-header-menu li.current_page_item a');
    kemet_css('kemet-settings[sticky-submenu-link-h-color]', 'color', '.kmt-is-sticky .main-header-menu .sub-menu li:hover > a');
    kemet_css('kemet-settings[sticky-submenu-bg-color]', 'background-color', '.kmt-is-sticky .main-header-menu ul.sub-menu');
    kemet_css('kemet-settings[sticky-border-bottom-color]', 'border-bottom-color', '.kmt-is-sticky .main-header-bar');
    /**
	 * Sticky Header background
	 */
	wp.customize( 'kemet-settings[sticky-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {
			var dynamicStyle = ' body:not(.kmt-header-break-point) .kmt-is-sticky .main-header-bar { {{css}} }';	
			kemet_background_obj_css( wp.customize, bg_obj, 'sticky-bg-obj', dynamicStyle );
		} );
	} );

    wp.customize('sticky-submenu-link-color]', function (value) {
		value.bind(function (color) {
			jQuery('.kmt-is-sticky .main-header-menu .sub-menu li a').css('color', color);
			jQuery('.kmt-is-sticky .main-header-menu .sub-menu li a').css('border-bottom-color', color);
		});
	});
    /*
	 * Site Identity Logo Width
	 */
	kemet_responsive_slider( 'kemet-settings[sticky-logo-width]', '#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img , kmt-is-sticky .kemet-logo-svg' , 'width');
})(jQuery);