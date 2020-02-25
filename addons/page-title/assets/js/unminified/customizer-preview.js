/**
	 * Page Title customizer preview
	 */
(function ($) {

    /**
	 * Page Title background
	 */
    wp.customize('kemet-settings[page-title-bg-obj]', function (value) {
        value.bind(function (bg_obj) {
            var dynamicStyle = ' .kmt-page-title-addon-content, .kemet-merged-header-title { {{css}} }';
            kemet_background_obj_css(wp.customize, bg_obj, 'header-bg-obj', dynamicStyle);
        });
    });
    wp.customize('kemet_breadcrumb_separator', function (value) {
        value.bind(function (newval) {
            $('.kemet-breadcrumbs-trail ul li .breadcrumb-sep').text(newval);
        });
    });
    wp.customize('kemet-settings[page_title_alignment]', function (value) {
        value.bind(function (align) {
            $('.kmt-page-title.page-title-layout-1').css('text-align' , align);
        });
    });

    kemet_responsive_spacing('kemet-settings[page-title-space]', '.kmt-page-title-addon-content', 'padding', ['top', 'right', 'bottom', 'left']);
    kemet_css('kemet-settings[page-title-color]', 'color', '.kemet-page-title');
    kemet_responsive_slider('kemet-settings[page-title-font-size]', '.kemet-page-title' , 'font-size');
    kemet_responsive_slider('kemet-settings[page-title-letter-spacing]', '.kemet-page-title' , 'letter-spacing');
    kemet_responsive_slider('kemet-settings[breadcrumbs-font-size]', '.kemet-breadcrumb-trail' , 'font-size');
    kemet_css('kemet-settings[page-title-border-right-color]', 'border-color', '.page-title-layout-3 .kmt-page-title-wrap');
    kemet_css('kemet-settings[pagetitle-text-transform]', 'text-transform', '.kemet-page-title');
    kemet_css('kemet-settings[pagetitle-line-height]', 'line-height', '.kemet-page-title');
    //Page Title Bottom Title
    kemet_css('kemet-settings[pagetitle-bottomline-height]', 'height', '.kemet-page-title::after', 'px');
    kemet_css('kemet-settings[pagetitle-bottomline-width]', 'width', '.kemet-page-title::after', 'px');
    kemet_css('kemet-settings[pagetitle-bottomline-color]', 'background-color', '.kemet-page-title::after');
    // Breadcrumbs 
    kemet_responsive_spacing('kemet-settings[breadcrumbs-space]', '.kemet-breadcrumb-trail', 'padding', ['top', 'right', 'bottom', 'left']);
    kemet_css('kemet-settings[breadcrumbs-color]', 'color', '.kemet-breadcrumb-trail li > span , .kemet-breadcrumb-trail li > span > span');
    kemet_css('kemet-settings[breadcrumbs-link-color]', 'color', '.kemet-breadcrumb-trail a span');
    kemet_css('kemet-settings[breadcrumbs-link-h-color]', 'color', '.kemet-breadcrumb-trail a:hover span');

    kemet_responsive_slider('kemet-settings[breadcrumbs-letter-spacing]', '.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)', 'letter-spacing');
    kemet_responsive_slider('kemet-settings[breadcrumbs-font-size]', '.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)', 'font-size');
    kemet_css('kemet-settings[breadcrumbs-text-transform]', 'text-transform', '.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)');
    kemet_css('kemet-settings[breadcrumbs-line-height]', 'line-height', '.kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)');
})(jQuery);