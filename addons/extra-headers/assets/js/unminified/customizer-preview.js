(function ($) {

    kemet_css('kemet-settings[header-icon-bars-logo-bg-color]', 'background-color', '.site-header .logo-menu-icon');
    kemet_css('kemet-settings[header-main-sep-color]', 'border-color', '.kemet-main-v-header-align-right .main-header-bar-wrap , .kemet-main-v-header-align-left .main-header-bar-wrap');
    kemet_css('kemet-settings[header-icon-bars-color]', 'background-color', '.icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-h-color]', 'background-color', '.icon-bars-btn:hover span, .open .icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-bg-color]', 'background-color', '.menu-icon-social .menu-icon');
    kemet_css('kemet-settings[header-icon-bars-bg-h-color]', 'background-color', '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open');
    wp.customize('kemet-settings[header-icon-bars-border-radius]', function (setting) {
        setting.bind(function (border) {

            var dynamicStyle = '.site-header .menu-icon-social .menu-icon { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('header-icon-bars-border-radius', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[mini-vheader-width]', function (setting) {
        setting.bind(function (width) {

            var dynamicStyle = '.header-main-layout-8 .main-header-bar-wrap { width: ' + (parseInt(width)) + 'px } .header-main-layout-8.kemet-main-v-header-align-right { padding-right: ' + (parseInt(width)) + 'px } .header-main-layout-8.kemet-main-v-header-align-left { padding-left: ' + (parseInt(width)) + 'px }';
            kemet_add_dynamic_css('mini-vheader-width', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[vertical-header-width]', function (setting) {
        setting.bind(function (width) {

            var dynamicStyle = '.header-main-layout-6 .main-header-bar-wrap { width: ' + (parseInt(width)) + 'px } .header-main-layout-6.kemet-main-v-header-align-right { padding-right: ' + (parseInt(width)) + 'px } .header-main-layout-6.kemet-main-v-header-align-left { padding-left: ' + (parseInt(width)) + 'px }';
            kemet_add_dynamic_css('vertical-header-width', dynamicStyle);

        });
    });

	wp.customize('kemet-settings[header-icon-label]', function (setting) {
		setting.bind(function (label) {
            if (label != '') {
                $('.menu-icon-social .menu-icon .header-icon-label').text(label);
            }else{
                $('.menu-icon-social .menu-icon .header-icon-label').text('');
            }
		});
	});
    kemet_responsive_slider('kemet-settings[header-main-sep]', '.kemet-main-v-header-align-right .main-header-bar-wrap', 'border-left-width');
    kemet_responsive_slider('kemet-settings[header-main-sep]', '.kemet-main-v-header-align-left .main-header-bar-wrap', 'border-right-width');
    kemet_responsive_spacing('kemet-settings[menu-icon-bars-space]', '.site-header .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left']);

})(jQuery);
