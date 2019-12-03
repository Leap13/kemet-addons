(function ($) {

    kemet_css('kemet-settings[header-icon-bars-logo-bg-color]', 'background-color', '.main-header-container.logo-menu-icon');
    kemet_css('kemet-settings[header-icon-bars-color]', 'background-color', '.icon-bars-btn span');
    kemet_css('kemet-settings[search-btn-bg-color]', 'background-color', '.kmt-search-menu-icon .search-submit');
    kemet_css('kemet-settings[search-btn-h-bg-color]', 'background-color', '.kmt-search-menu-icon .search-submit:hover');
    kemet_css('kemet-settings[search-btn-color]', 'color', '.kmt-search-menu-icon .search-submit');
    kemet_css('kemet-settings[header-icon-bars-h-color]', 'background-color', '.icon-bars-btn:hover span, .open .icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-bg-color]', 'background-color', '.menu-icon-social .menu-icon');
    kemet_css('kemet-settings[header-icon-bars-bg-h-color]', 'background-color', '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open');
    wp.customize('kemet-settings[header-icon-bars-border-radius]', function (setting) {
        setting.bind(function (border) {

            var dynamicStyle = '.menu-icon-social .menu-icon { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('header-icon-bars-border-radius', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[search-border-size]', function (setting) {
		setting.bind(function (border) {
			var dynamicStyle = '.search-box #site-navigation .kmt-search-menu-icon .search-form { border-width: ' + border + 'px } .top-bar-search-box .kemet-top-header-section .kmt-search-menu-icon .search-form { border-width: ' + border + 'px }';

			kemet_add_dynamic_css('search-border-size', dynamicStyle);
		});
	});
   kemet_responsive_spacing( 'kemet-settings[menu-icon-bars-space]','.main-header-container.logo-menu-icon .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left' ] );

})(jQuery);
