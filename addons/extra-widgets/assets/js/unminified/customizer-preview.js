(function ($) {
    wp.customize('kemet-settings[kemet-widget-style-color]', function (setting) {
        setting.bind(function (color) {

            var dynamicStyle = '.kmt-widget-style3 .widget-content,.kmt-widget-style6 div.title .widget-title,.kmt-widget-style6 div.title .widget-title:before { border-bottom-color: '+ color +' } ';
            dynamicStyle += '.kmt-widget-style3 .widget-content , .kmt-widget-style5.widget { border-color: '+ color +' } ';
            dynamicStyle += '.kmt-widget-style2 .widget-title ,.kmt-widget-style4 .widget-head ,.kmt-widget-style7 div.title .widget-title:after { background-color: '+ color +' } ';
            kemet_add_dynamic_css('kemet-widget-style-color', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[kemet-footer-widget-style-color]', function (setting) {
        setting.bind(function (color) {

            var dynamicStyle = '.kemet-footer .kmt-widget-style3 .widget-content,.kemet-footer .kmt-widget-style6 div.title .widget-title,.kemet-footer .kmt-widget-style6 div.title .widget-title:before  , .kmt-footer-copyright .kmt-widget-style3 .widget-content,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title:before { border-bottom-color: '+ color +' } ';
            dynamicStyle += '.kemet-footer .kmt-widget-style3 .widget-content ,.kemet-footer .kmt-widget-style5.widget , .kmt-footer-copyright .kmt-widget-style3 .widget-content ,.kmt-footer-copyright .kmt-widget-style5.widget { border-color: '+ color +' } ';
            dynamicStyle += '.kemet-footer .kmt-widget-style2 .widget-title ,.kemet-footer .kmt-widget-style4 .widget-head ,.kemet-footer .kmt-widget-style7 div.title .widget-title:after ,  .kmt-footer-copyright .kmt-widget-style2 .widget-title ,.kmt-footer-copyright .kmt-widget-style4 .widget-head ,.kmt-footer-copyright .kmt-widget-style7 div.title .widget-title:after { background-color: '+ color +' } ';
            kemet_add_dynamic_css('kemet-footer-widget-style-color', dynamicStyle);

        });
    });

})(jQuery);
