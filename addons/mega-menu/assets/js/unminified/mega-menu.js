(function ($) {
  // Mega menu in principal menu
  $("#site-navigation .kemet-megamenu-item").hover(
    function () {
      var headerContainer = $(".main-header-bar .kmt-container"),
        headerWrap = headerContainer.parent(),
        containerWidth = $(this).parent(),
        Position = headerContainer.offset(),
        menuWidth = headerContainer.outerWidth();

      if ($(this).hasClass("mega-menu-full-width")) {
        menuWrapWidth = containerWidth.width();
        wrapPosition = containerWidth.offset();
      } else if ($(this).hasClass("mega-menu-container-width")) {
        menuWidth = containerWidth.width();
        Position = containerWidth.offset();
      }

      var menuItemPosition = $(this).offset(),
        positionLeft = menuItemPosition.left - Position.left;

      if (!$(this).hasClass("mega-menu-full-width")) {
        $(this)
          .find(".kemet-megamenu")
          .css({ left: "-" + positionLeft + "px", width: menuWidth });
      } else {
        $(this).find(".kemet-megamenu").css({ width: menuWidth });

        var megaMenuWrap = $(this).find(".mega-menu-full-wrap"),
          menuItemPosition = $(this).offset(),
          positionLeft = menuItemPosition.left - Position.left;

        megaMenuWrap.css({ left: "-" + positionLeft + "px", width: menuWidth });
      }
    },
    function () {
      if (!$(this).hasClass("mega-menu-full-width")) {
        $(this)
          .find(".kemet-megamenu")
          .css({ left: "-" + 999 + "em" });
      } else {
        $(this)
          .find(".mega-menu-full-wrap")
          .css({ left: "-" + 999 + "em" });
      }
    }
  );
})(jQuery);
