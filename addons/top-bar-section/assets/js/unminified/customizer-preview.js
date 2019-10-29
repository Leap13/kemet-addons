(function ($) {

    /**
      * Top Bar Header
      */

    kemet_css('kemet-settings[topbar-bg-color]', 'background-color', '.kemet-top-header');

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
