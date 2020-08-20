(function ($) {

    // Mega menu in principal menu
    $('#site-navigation .kemet-megamenu-item .kemet-megamenu').fadeOut();
    $('#site-navigation .kemet-megamenu-item').hover(
        function () {

            var headerContainer = $('.main-header-bar .kmt-container'),
                headerWidth = headerContainer.width(),
                headerPosition = headerContainer.offset(),
                menuItemPosition = $(this).offset(),
                positionLeft = menuItemPosition.left - headerPosition.left + 1;

            $(this).find('.kemet-megamenu').css({ 'left': '-' + positionLeft + 'px', 'width': headerWidth });
            $(this).find('.kemet-megamenu').fadeIn(500);
        },
        function () {
            $(this).find('.kemet-megamenu').fadeOut(500);
        }
    );

})(jQuery);