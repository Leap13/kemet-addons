(function ($) {

    kemet_css('kemet-settings[header-icon-bars-logo-bg-color]', 'background-color', '.site-header .logo-menu-icon');
    kemet_css('kemet-settings[header6-border-color]', 'border-color', '.header-main-layout-6 .main-header-bar-wrap');
    kemet_css('kemet-settings[header-icon-bars-color]', 'background-color', '.icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-h-color]', 'background-color', '.icon-bars-btn:hover span, .open .icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-bg-color]', 'background-color', '.menu-icon-social .menu-icon');
    kemet_css('kemet-settings[header-icon-bars-bg-h-color]', 'background-color', '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open');
    kemet_css('kemet-settings[separator-color]', 'border=bottom-color', '.ss-wrapper #site-navigation .menu-separator>.menu-item:before');
    wp.customize('kemet-settings[header-icon-bars-border-radius]', function (setting) {
        setting.bind(function (border) {

            var dynamicStyle = '.menu-icon-social .menu-icon { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('header-icon-bars-border-radius', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[vertical-header-width]', function (setting) {
        setting.bind(function (width) {

            var dynamicStyle = '.header-main-layout-6 .main-header-bar-wrap { width: ' + (parseInt(width)) + 'px } .header-main-layout-6.kemet-main-v-header-align-right { padding-right: ' + (parseInt(width)) + 'px } .header-main-layout-6.kemet-main-v-header-align-left { padding-left: ' + (parseInt(width)) + 'px }';
            kemet_add_dynamic_css('vertical-header-width', dynamicStyle);

        });
    });
    kemet_responsive_slider('kemet-settings[header6-border-width]', '.kemet-main-v-header-align-right .header-main-layout-6 .main-header-bar-wrap', 'border-left-width');
    kemet_responsive_slider('kemet-settings[header6-border-width]', '.kemet-main-v-header-align-left .header-main-layout-6 .main-header-bar-wrap', 'border-right-width');
    kemet_responsive_spacing('kemet-settings[menu-icon-bars-space]', '.kemet-merged-header-title .site-header .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left']);

})(jQuery);
