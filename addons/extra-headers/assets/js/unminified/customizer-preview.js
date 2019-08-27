(function ($) {
    
    kemet_css( 'kemet-settings[header-icon-bars-logo-bg-color]', 'background-color', '.main-header-container.logo-menu-icon' );
    kemet_css( 'kemet-settings[header-icon-bars-color]', 'background-color', '.icon-bars-btn span' );
    kemet_css( 'kemet-settings[header-icon-bars-h-color]', 'background-color', '.icon-bars-btn:hover span, .open .icon-bars-btn span' );
    kemet_css( 'kemet-settings[header-icon-bars-bg-color]', 'background-color', '.menu-icon-social .menu-icon' );
    kemet_css( 'kemet-settings[header-icon-bars-bg-h-color]', 'background-color', '.menu-icon-social .menu-icon:hover, .menu-icon-social .menu-icon.open' );
    kemet_css( 'kemet-settings[header-icon-bars-border-radius]', 'border-radius', '.menu-icon-social .menu-icon', 'px' );

    kemet_responsive_spacing( 'kemet-settings[menu-icon-bars-space]','.main-header-container.logo-menu-icon .menu-icon-social', 'margin', ['top', 'right', 'bottom', 'left' ] );


})(jQuery);
