(function ($) {

    kemet_responsive_font_size('kemet-settings[go-top-icon-size]', '.kmt-go-top-link:before', 'px');
    kemet_css('kemet-settings[go-top-icon-color]', 'color', ' .kmt-go-top-link');
    kemet_css('kemet-settings[go-top-icon-h-color]', 'color', ' .kmt-go-top-link:hover');
    kemet_css('kemet-settings[go-top-bg-color]', 'color', '.kmt-go-top-link');
    kemet_css('kemet-settings[go-top-bg-h-color]', 'color', '.kmt-go-top-link:hover');
    wp.customize('kemet-settings[go-top-border-radius]', function (setting) {
        setting.bind(function (border) {
            var dynamicStyle = '.kmt-go-top-link { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('go-top-border-radius', dynamicStyle);
        });
    });
    wp.customize('kemet-settings[go-top-button-size]', function (setting) {
        setting.bind(function (width) {
            var dynamicStyle = '.kmt-go-top-link { width: ' + width + 'px  ; height: ' + width + 'px ; line-height: ' + width + 'px } ';
            kemet_add_dynamic_css('go-top-button-size', dynamicStyle);
        });
    });

})(jQuery);