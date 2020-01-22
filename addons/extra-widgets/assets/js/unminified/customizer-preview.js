(function ($) {
    wp.customize('kemet-settings[kemet-widget-style-color]', function (setting) {
        setting.bind(function (color) {

            var dynamicStyle = '.kmt-widget-style3 .widget-title ,.kmt-widget-style4 .widget-content,.kmt-widget-style8 div.title .widget-title,.kmt-widget-style8 div.title .widget-title:before { border-bottom-color: '+ color +' } ';
            dynamicStyle += '.kmt-widget-style4 .widget-content , .kmt-widget-style7 .widget { border-color: '+ color +' } ';
            dynamicStyle += '.kmt-widget-style2 .widget-title ,.kmt-widget-style5 .widget-head ,.kmt-widget-style6 .widget-head,.kmt-widget-style9 div.title .widget-title:after { background-color: '+ color +' } ';
            kemet_add_dynamic_css('kemet-widget-style-color', dynamicStyle);

        });
    });
    wp.customize('kemet-settings[kemet-footer-widget-style-color]', function (setting) {
        setting.bind(function (color) {

            var dynamicStyle = '.kemet-footer .kmt-widget-style3 .widget-title ,.kemet-footer .kmt-widget-style4 .widget-content,.kemet-footer .kmt-widget-style8 div.title .widget-title,.kemet-footer .kmt-widget-style8 div.title .widget-title:before  , .kmt-footer-copyright .kmt-widget-style3 .widget-title ,.kmt-footer-copyright .kmt-widget-style4 .widget-content,.kmt-footer-copyright .kmt-widget-style8 div.title .widget-title,.kmt-footer-copyright .kmt-widget-style8 div.title .widget-title:before { border-bottom-color: '+ color +' } ';
            dynamicStyle += '.kemet-footer .kmt-widget-style4 .widget-content ,.kemet-footer .kmt-widget-style7 .widget , .kmt-footer-copyright .kmt-widget-style4 .widget-content ,.kmt-footer-copyright .kmt-widget-style7 .widget { border-color: '+ color +' } ';
            dynamicStyle += '.kemet-footer .kmt-widget-style2 .widget-title ,.kemet-footer .kmt-widget-style5 .widget-head ,.kemet-footer .kmt-widget-style6 .widget-head,.kemet-footer .kmt-widget-style9 div.title .widget-title:after ,  .kmt-footer-copyright .kmt-widget-style2 .widget-title ,.kmt-footer-copyright .kmt-widget-style5 .widget-head ,.kmt-footer-copyright .kmt-widget-style6 .widget-head,.kmt-footer-copyright .kmt-widget-style9 div.title .widget-title:after { background-color: '+ color +' } ';
            kemet_add_dynamic_css('kemet-footer-widget-style-color', dynamicStyle);

        });
    });

})(jQuery);
