(function ($) {

    kemet_responsive_font_size('kemet-settings[sticky-header-icon-size]', '.kmt-sticky-header-link', 'px');
    kemet_css('kemet-settings[sticky-header-icon-color]', 'color', '.kmt-sticky-header-link');
    kemet_css('kemet-settings[sticky-header-icon-h-color]', 'color', '.kmt-sticky-header-link:hover');
    kemet_css('kemet-settings[sticky-header-bg-color]', 'color', '.kmt-sticky-header-link');
    kemet_css('kemet-settings[sticky-header-bg-h-color]', 'color', '.kmt-sticky-header-link:hover');
    wp.customize('kemet-settings[sticky-header-border-radius]', function (setting) {
        setting.bind(function (border) {
            var dynamicStyle = '.kmt-sticky-header-link { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('sticky-header-border-radius', dynamicStyle);
        });
    });
    wp.customize('kemet-settings[sticky-header-button-size]', function (setting) {
        setting.bind(function (width) {
            var dynamicStyle = '.kmt-sticky-header-link { width: ' + width + 'px  ; height: ' + width + 'px ; line-height: ' + width + 'px } ';
            kemet_add_dynamic_css('sticky-header-button-size', dynamicStyle);
        });
    });
    wp.customize('kemet-settings[sticky-logo-width]', function (setting) {
        setting.bind(function (sticky_logo_width) {
            if (sticky_logo_width['desktop'] != '' || sticky_logo_width['tablet'] != '' || sticky_logo_width['mobile'] != '') {
                var dynamicStyle = '#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img { max-width: ' + sticky_logo_width['desktop'] + 'px;}  @media( max-width: 768px ) { #sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img { max-width: ' + sticky_logo_width['tablet'] + 'px;}  } @media( max-width: 544px ) { .kmt-header-break-point #sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img { max-width: ' + sticky_logo_width['mobile'] + 'px;} }';
                kemet_add_dynamic_css('sticky-logo-width', dynamicStyle);
            }
            else {
                wp.customize.preview.send('refresh');
            }
        });
    });

})(jQuery);