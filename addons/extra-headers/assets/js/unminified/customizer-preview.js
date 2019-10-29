(function ($) {

    kemet_css('kemet-settings[header-icon-bars-logo-bg-color]', 'background-color', '.main-header-container.logo-menu-icon');
    kemet_css('kemet-settings[header-icon-bars-color]', 'background-color', '.icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-h-color]', 'background-color', '.icon-bars-btn:hover span, .open .icon-bars-btn span');
    kemet_css('kemet-settings[header-icon-bars-bg-color]', 'background-color', '.menu-icon-social .menu-icon');
    kemet_css('kemet-settings[header-icon-bars-bg-h-color]', 'background-color', '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open');
    wp.customize('kemet-settings[header-icon-bars-border-radius]', function (setting) {
        setting.bind(function (border) {

            var dynamicStyle = '.menu-icon-social .menu-icon { border-radius: ' + (parseInt(border)) + 'px } ';
            kemet_add_dynamic_css('header-icon-bars-border-radius', dynamicStyle);

        });
    });

   kemet_responsive_spacing( 'kemet-settings[menu-icon-bars-space]','.main-header-container.logo-menu-icon .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left' ] );
   
   /**
	 * Top Bar Header
	 */
   
   kemet_css( 'kemet-settings[topbar-bg-color]', 'background-color', '.kemet-top-header' );
    /**
      * Top Bar Header background
      */
    // wp.customize('kemet-settings[topbar-bg-color]', function (value) {
    //     value.bind(function (bg_obj) {

    //         var dynamicStyle = '.kemet-top-header  { {{css}} }';

    //         kemet_background_obj_css(wp.customize, bg_obj, 'topbar-bg-color', dynamicStyle);
    //     });
    // });

	/**
     * Top Bar Header Spacing
     */
    kemet_responsive_spacing('kemet-settings[topbar-padding]', '.kemet-top-header ', 'padding', ['top', 'bottom', 'right', 'left']);

	/**
	 * Top Bar Header Link Color
	 */
    kemet_css('kemet-settings[topbar-link-color]', 'color', '.kemet-top-header a');
    kemet_css('kemet-settings[topbar-link-h-color]', 'color', '.kemet-top-header a:hover');
    kemet_css('kemet-settings[topbar-text-color]', 'color', '.kemet-top-header');
    kemet_css('kemet-settings[topbar-submenu-items-color]', 'color', '.top-navigation ul.sub-menu li a');
    kemet_css('kemet-settings[topbar-submenu-items-h-color]', 'color', '.top-navigation ul.sub-menu li:hover a');

    wp.customize('kemet-settings[topbar-border-bottom-size]', function (value) {
        value.bind(function (border) {
            var dynamicStyle = '.kemet-top-header{ border-width: ' + border + 'px }';
            kemet_add_dynamic_css('topbar-border-bottom-size', dynamicStyle);
        });
    });

    wp.customize('kemet-settings[topbar-border-bottom-color]', function (value) {
        value.bind(function (border_color) {
            jQuery('.kemet-top-header').css('border-color', border_color);
        });
    });

})(jQuery);
