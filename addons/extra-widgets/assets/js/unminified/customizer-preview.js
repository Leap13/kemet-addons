(function ($) {

    kemet_responsive_font_size('kemet-settings[extra-widgets-icon-size]', '.kmt-extra-widgets-link:before', 'px');
    kemet_css('kemet-settings[extra-widgets-icon-color]', 'color', ' .kmt-extra-widgets-link');
    kemet_css('kemet-settings[extra-widgets-icon-h-color]', 'color', ' .kmt-extra-widgets-link:hover');
    kemet_css('kemet-settings[extra-widgets-bg-color]', 'color', '.kmt-extra-widgets-link');
    kemet_css('kemet-settings[extra-widgets-bg-h-color]', 'color', '.kmt-extra-widgets-link:hover');
    wp.customize('kemet-settings[extra-widgets-border-radius]', function (setting) {
        setting.bind(function (border) {
            var dynamicStyle = '.kmt-extra-widgets-link { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('extra-widgets-border-radius', dynamicStyle);
        });
    });
    wp.customize('kemet-settings[extra-widgets-button-size]', function (setting) {
        setting.bind(function (width) {
            var dynamicStyle = '.kmt-extra-widgets-link { width: ' + width + 'px  ; height: ' + width + 'px ; line-height: ' + width + 'px } ';
            kemet_add_dynamic_css('extra-widgets-button-size', dynamicStyle);
        });
    });

})(jQuery);