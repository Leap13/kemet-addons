// // /**
// //  * Generate font size in PX & REM
// //  */
//  function kemet_font_size_rem(size, with_rem, device) {

//     var css = '';

//     if (size != '') {

//         var device = (typeof device != undefined) ? device : 'desktop';

//         // font size with 'px'.
//         css = 'font-size: ' + size + 'px;';

//         // font size with 'rem'.
//         if (with_rem) {
//             var body_font_size = wp.customize('kemet-settings[font-size-body]').get();

//             body_font_size['desktop'] = (body_font_size['desktop'] != '') ? body_font_size['desktop'] : 15;
//             body_font_size['tablet'] = (body_font_size['tablet'] != '') ? body_font_size['tablet'] : body_font_size['desktop'];
//             body_font_size['mobile'] = (body_font_size['mobile'] != '') ? body_font_size['mobile'] : body_font_size['tablet'];

//             css += 'font-size: ' + (size / body_font_size[device]) + 'rem;';
//         }
//     }

//     return css;
// }

// /**
//  * Responsive Font Size CSS
//  */
// function kemet_responsive_font_size(control, selector) {

//     wp.customize(control, function (value) {
//         value.bind(function (value) {

//             if (value.desktop || value.mobile || value.tablet) {
//                 // Remove <style> first!
//                 control = control.replace('[', '-');
//                 control = control.replace(']', '');
//                 jQuery('style#' + control).remove();

//                 var fontSize = '',
//                     TabletFontSize = '',
//                     MobileFontSize = '';


//                 if ('' != value.desktop) {
//                     fontSize = 'font-size: ' + value.desktop + value['desktop-unit'];
//                 }
//                 if ('' != value.tablet) {
//                     TabletFontSize = 'font-size: ' + value.tablet + value['tablet-unit'];
//                 }
//                 if ('' != value.mobile) {
//                     MobileFontSize = 'font-size: ' + value.mobile + value['mobile-unit'];
//                 }

//                 if (value['desktop-unit'] == 'px') {
//                     fontSize = kemet_font_size_rem(value.desktop, true, 'desktop');
//                 }

//                 // Concat and append new <style>.
//                 jQuery('head').append(
//                     '<style id="' + control + '">'
//                     + selector + '	{ ' + fontSize + ' }'
//                     + '@media (max-width: 768px) {' + selector + '	{ ' + TabletFontSize + ' } }'
//                     + '@media (max-width: 544px) {' + selector + '	{ ' + MobileFontSize + ' } }'
//                     + '</style>'
//                 );

//             } else {

//                 jQuery('style#' + control).remove();
//             }

//         });
//     });
// }

// /**
//  * Responsive Spacing CSS
//  */
// function kemet_responsive_spacing(control, selector, type, side) {

//     wp.customize(control, function (value) {
//         value.bind(function (value) {
//             var sidesString = "";
//             var spacingType = "padding";
//             if (value.desktop.top || value.desktop.right || value.desktop.bottom || value.desktop.left || value.tablet.top || value.tablet.right || value.tablet.bottom || value.tablet.left || value.mobile.top || value.mobile.right || value.mobile.bottom || value.mobile.left) {
//                 if (typeof side != undefined) {
//                     sidesString = side + "";
//                     sidesString = sidesString.replace(/,/g, "-");
//                 }
//                 if (typeof type != undefined) {
//                     spacingType = type + "";
//                 }
//                 // Remove <style> first!
//                 control = control.replace('[', '-');
//                 control = control.replace(']', '');
//                 jQuery('style#' + control + '-' + spacingType + '-' + sidesString).remove();

//                 var desktopPadding = '',
//                     tabletPadding = '',
//                     mobilePadding = '';

//                 var paddingSide = (typeof side != undefined) ? side : ['top', 'bottom', 'right', 'left'];

//                 jQuery.each(paddingSide, function (index, sideValue) {
//                     if ('' != value['desktop'][sideValue]) {
//                         desktopPadding += spacingType + '-' + sideValue + ': ' + value['desktop'][sideValue] + value['desktop-unit'] + ';';
//                     }
//                 });

//                 jQuery.each(paddingSide, function (index, sideValue) {
//                     if ('' != value['tablet'][sideValue]) {
//                         tabletPadding += spacingType + '-' + sideValue + ': ' + value['tablet'][sideValue] + value['tablet-unit'] + ';';
//                     }
//                 });

//                 jQuery.each(paddingSide, function (index, sideValue) {
//                     if ('' != value['mobile'][sideValue]) {
//                         mobilePadding += spacingType + '-' + sideValue + ': ' + value['mobile'][sideValue] + value['mobile-unit'] + ';';
//                     }
//                 });

//                 // Concat and append new <style>.
//                 jQuery('head').append(
//                     '<style id="' + control + '-' + spacingType + '-' + sidesString + '">'
//                     + selector + '	{ ' + desktopPadding + ' }'
//                     + '@media (max-width: 768px) {' + selector + '	{ ' + tabletPadding + ' } }'
//                     + '@media (max-width: 544px) {' + selector + '	{ ' + mobilePadding + ' } }'
//                     + '</style>'
//                 );

//             } else {
//                 wp.customize.preview.send('refresh');
//                 jQuery('style#' + control + '-' + spacingType + '-' + sidesString).remove();
//             }

//         });
//     });
// }

// /**
//  * CSS
//  */
// function kemet_css_font_size(control, selector) {

//     wp.customize(control, function (value) {
//         value.bind(function (size) {

//             if (size) {

//                 // Remove <style> first!
//                 control = control.replace('[', '-');
//                 control = control.replace(']', '');
//                 jQuery('style#' + control).remove();

//                 var fontSize = 'font-size: ' + size;
//                 if (!isNaN(size) || size.indexOf('px') >= 0) {
//                     size = size.replace('px', '');
//                     fontSize = kemet_font_size_rem(size, true);
//                 }

//                 // Concat and append new <style>.
//                 jQuery('head').append(
//                     '<style id="' + control + '">'
//                     + selector + '	{ ' + fontSize + ' }'
//                     + '</style>'
//                 );

//             } else {

//                 jQuery('style#' + control).remove();
//             }

//         });
//     });
// }

// /**
//  * Return get_hexdec()
//  */
// function get_hexdec(hex) {
//     var hexString = hex.toString(16);
//     return parseInt(hexString, 16);
// }
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
    kemet_responsive_spacing('kemet-settings[page-title-space]', '.kmt-page-title-addon-content', 'padding', ['top', 'right', 'bottom', 'left']);
    kemet_css('kemet-settings[page-title-color]', 'color', '.kemet-page-title');
    kemet_responsive_font_size('kemet-settings[page-title-font-size]', '.kemet-page-title');

    kemet_css('kemet-settings[pagetitle-text-transform]', 'text-transform', '.kemet-page-title');
    kemet_css('kemet-settings[pagetitle-line-height]', 'line-height', '.kemet-page-title');
    //Page Title Bottom Title
    kemet_css('kemet-settings[pagetitle-bottomline-height]', 'height', '.kemet-page-title::after', 'px');
    kemet_css('kemet-settings[pagetitle-bottomline-width]', 'width', '.kemet-page-title::after', 'px');
    kemet_css('kemet-settings[pagetitle-bottomline-color]', 'background-color', '.kemet-page-title::after');
    // Breadcrumbs 
    kemet_responsive_spacing('kemet-settings[breadcrumbs-space]', '.kemet-breadcrumb-trail', 'padding', ['top', 'right', 'bottom', 'left']);
    kemet_css('kemet-settings[breadcrumbs-color]', 'color', '.kemet-breadcrumb-trail span');
    kemet_css('kemet-settings[breadcrumbs-link-color]', 'color', '.kemet-breadcrumb-trail a span');
    kemet_css('kemet-settings[breadcrumbs-link-h-color]', 'color', '.kemet-breadcrumb-trail a:hover span');


})(jQuery);