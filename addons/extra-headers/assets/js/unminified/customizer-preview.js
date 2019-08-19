(function ($) {
    
	kemet_css( 'kemet-settings[header-5-icon-color]', 'background-color', '.icon-bars-btn span' );
//    wp.customize('kemet-settings[header-5-icon-color]', function (value) {
//        value.bind(function (color) {
//            if (color == '') {
//                wp.customize.preview.send('refresh');
//            }
//            if (color) {
//                var dynamicStyle = '.icon-bars-btn span { background-color: ' + color + '; } ';
//                kemet_add_dynamic_css('header-5-icon-color', dynamicStyle);
//            }
//        });
//    });
//
//    wp.customize('kemet-settings[header-5-icon-h-color]', function (value) {
//        value.bind(function (color) {
//            if (color == '') {
//                wp.customize.preview.send('refresh');
//            }
//            if (color) {
//                var dynamicStyle = '.kemet-addons-header5 .animated-icon:hover span,.kemet-addons-header7 .animated-icon:hover span { background-color: ' + color + '; } ';
//                kemet_add_dynamic_css('header-5-icon-h-color', dynamicStyle);
//            }
//        });
//    });
//
//    wp.customize('kemet-settings[header-5-icon-bg-color]', function (value) {
//        value.bind(function (color) {
//            if (color == '') {
//                wp.customize.preview.send('refresh');
//            }
//            if (color) {
//                var dynamicStyle = '.kemet-addons-header5 .animated-icon,.kemet-addons-header7 .animated-icon { background-color: ' + color + '; } ';
//                kemet_add_dynamic_css('header-5-icon-bg-color', dynamicStyle);
//            }
//        });
//    });
//
//    wp.customize('kemet-settings[header-5-icon-bg-h-color]', function (value) {
//        value.bind(function (color) {
//            if (color == '') {
//                wp.customize.preview.send('refresh');
//            }
//            if (color) {
//                var dynamicStyle = '.kemet-addons-header5 .animated-icon:hover,.kemet-addons-header7 .animated-icon:hover{ background-color: ' + color + '; } ';
//                kemet_add_dynamic_css('header-5-icon-bg-h-color', dynamicStyle);
//            }
//        });
//    });
//
//    wp.customize('kemet-settings[header-5-icon-border-radius]', function (setting) {
//        setting.bind(function (border) {
//
//            var dynamicStyle = '.kemet-addons-header5 .animated-icon,.kemet-addons-header7 .animated-icon { border-radius: ' + (parseInt(border)) + 'px } ';
//            kemet_add_dynamic_css('header-5-icon-border-radius', dynamicStyle);
//
//        });
//    });
//
//    /*
//    * Header6 Width
//    */
//    wp.customize('kemet-settings[header6-width]', function (setting) {
//        setting.bind(function (width) {
//
//            var dynamicStyle = '@media all and ( min-width: 1200px ) {';
//            dynamicStyle += '#sitehead.header-main-layout-6,#sitehead.header-main-layout-7 { width: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += 'body.kemet-addons-header6-left { padding-left: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += 'body.kemet-addons-header6-right { padding-right: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += '}';
//            kemet_add_dynamic_css('header6-width', dynamicStyle);
//
//        });
//    });
//
//    wp.customize('kemet-settings[header6-border-width]', function (value) {
//        value.bind(function (border) {
//
//            var dynamicStyle = '.kemet-addons-header6-right #sitehead.header-main-layout-6,.kemet-addons-header7-right #sitehead.header-main-layout-7 { border-left-width: ' + border + 'px }';
//            dynamicStyle += '.kemet-addons-header6-left #sitehead.header-main-layout-6,.kemet-addons-header7-left #sitehead.header-main-layout-7 { border-right-width: ' + border + 'px }';
//            dynamicStyle += '}';
//
//            kemet_add_dynamic_css('header6-border-width', dynamicStyle);
//
//        });
//    });
//    kemet_css('kemet-settings[header6-border-style', 'border-left-style', '.kemet-addons-header6-right #sitehead.header-main-layout-6,.kemet-addons-header7-right #sitehead.header-main-layout-7');
//    kemet_css('kemet-settings[header6-border-style', 'border-right-style', '.kemet-addons-header6-left #sitehead.header-main-layout-6,.kemet-addons-header7-left #sitehead.header-main-layout-7');
//    /**
//     * widget Title Border color
//     */
//    wp.customize('kemet-settings[header6-border-color]', function (value) {
//        value.bind(function (color) {
//            if (color == '') {
//                wp.customize.preview.send('refresh');
//            }
//            if (color) {
//                var dynamicStyle = '#sitehead.header-main-layout-6,#sitehead.header-main-layout-7 { border-color: ' + color + '; } ';
//                kemet_add_dynamic_css('header6-border-color', dynamicStyle);
//            }
//        });
//    });
})(jQuery);
