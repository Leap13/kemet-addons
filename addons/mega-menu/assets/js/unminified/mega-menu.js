(function($) {
  // Mega menu in principal menu
  var kemetMegMenu = function() {
    $(
      "body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item"
    ).hover(
      function() {
        var headerContainer = $("header .main-header-bar .kmt-container"),
          headerWrap = headerContainer.parents(".main-header-bar"),
          containerWidth = $(this).parent(),
          Position = headerContainer.offset(),
          menuWidth = headerContainer.outerWidth();

        if ($(this).hasClass("mega-menu-full-width")) {
          menuWrapWidth = headerWrap.outerWidth();
          wrapPosition = headerWrap.offset();
          console.log(headerWrap);
        } else if ($(this).hasClass("mega-menu-container-width")) {
          menuWidth = containerWidth.width();
          Position = containerWidth.offset();
        }

        var menuItemPosition = $(this).offset(),
          positionLeft = menuItemPosition.left - Position.left,
          positionLeft =
            positionLeft < 0
              ? Math.abs(positionLeft) + "px"
              : "-" + positionLeft + "px";
        if (!$(this).hasClass("mega-menu-full-width")) {
          $(this)
            .find(".kemet-megamenu")
            .css({ left: positionLeft, width: menuWidth });
        } else {
          $(this)
            .find(".kemet-megamenu")
            .css({ width: menuWidth });

          var megaMenuWrap = $(this).find(".mega-menu-full-wrap"),
            menuItemPosition = $(this).offset(),
            positionLeft = menuItemPosition.left - wrapPosition.left,
            positionLeft =
              positionLeft < 0
                ? Math.abs(positionLeft) + "px"
                : "-" + positionLeft + "px";
          megaMenuWrap.css({
            left: positionLeft,
            width: menuWrapWidth
          });
        }
      },
      function() {
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
  };

  if (
    !$("header").is(
      ".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
    )
  ) {
    kemetMegMenu();
  }

  $(window).resize(function() {
    if (
      !$("header").is(
        ".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
      )
    ) {
      kemetMegMenu();
    }
  });
})(jQuery);
