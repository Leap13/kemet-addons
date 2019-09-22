(function ($) {
    
    wp.customize('kemet-settings[header-icon-bars-logo-bg-color]', function (value) {
        value.bind(function (color) {
            if (color == '') {
                wp.customize.preview.send('refresh');
            }
            if (color) {
                var dynamicStyle = '.main-header-container.logo-menu-icon { background-color: ' + color + '; } ';
                kemet_add_dynamic_css('header-icon-bars-logo-bg-color', dynamicStyle);
            }
        });
    });
    
    wp.customize('kemet-settings[header-icon-bars-color]', function (value) {
        value.bind(function (color) {
            if (color == '') {
                wp.customize.preview.send('refresh');
            }
            if (color) {
                var dynamicStyle = '.icon-bars-btn span { background-color: ' + color + '; } ';
                kemet_add_dynamic_css('header-icon-bars-color', dynamicStyle);
            }
        });
    });
    
    wp.customize('kemet-settings[header-icon-bars-h-color]', function (value) {
        value.bind(function (color) {
            if (color == '') {
                wp.customize.preview.send('refresh');
            }
            if (color) {
                var dynamicStyle = '.icon-bars-btn:hover span, .open .icon-bars-btn span { background-color: ' + color + '; } ';
                kemet_add_dynamic_css('header-icon-bars-h-color', dynamicStyle);
            }
        });
    });
    
    wp.customize('kemet-settings[header-icon-bars-bg-color]', function (value) {
        value.bind(function (color) {
            if (color == '') {
                wp.customize.preview.send('refresh');
            }
            if (color) {
                var dynamicStyle = '.menu-icon-social .menu-icon { background-color: ' + color + '; } ';
                kemet_add_dynamic_css('header-icon-bars-bg-color', dynamicStyle);
            }
        });
    });
    
    wp.customize('kemet-settings[header-icon-bars-bg-h-color]', function (value) {
        value.bind(function (color) {
            if (color == '') {
                wp.customize.preview.send('refresh');
            }
            if (color) {
                var dynamicStyle = '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open { background-color: ' + color + '; } ';
                kemet_add_dynamic_css('header-icon-bars-bg-h-color', dynamicStyle);
            }
        });
    });
    
    wp.customize('kemet-settings[header-icon-bars-border-radius]', function (setting) {
        setting.bind(function (border) {

            var dynamicStyle = '.menu-icon-social .menu-icon { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('header-icon-bars-border-radius', dynamicStyle);

        });
    });


    

    
//   
//
//    kemet_responsive_spacing( 'kemet-settings[menu-icon-bars-space]','.main-header-container.logo-menu-icon .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left' ] );
//    
//    /**
//	 * Top Bar Header
//	 */
//    
//    kemet_css( 'kemet-settings[topbar-bg-color]', 'background-color', '.kemet-top-header' );
//    
//
//    /*
//    * Header6 Width
//    */
//    wp.customize('kemet-settings[header6-width]', function (setting) {
//        setting.bind(function (width) {
//
//            var dynamicStyle = '@media all and ( min-width: 1200px ) {';
//            dynamicStyle += '.site-header.header-main-layout-6,#sitehead.header-main-layout-7 { width: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += 'body.kemet-addons-header6-left { padding-left: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += 'body.kemet-addons-header6-right { padding-right: ' + (parseInt(width)) + 'px } ';
//            dynamicStyle += '}';
//            kemet_add_dynamic_css('header6-width', dynamicStyle);
//
//        });
//    });
    


})(jQuery);
