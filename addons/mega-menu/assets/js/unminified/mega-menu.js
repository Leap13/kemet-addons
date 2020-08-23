(function($) {
  // Mega menu in principal menu
  $("#site-navigation .kemet-megamenu-item").hover(
    function() {
      var headerContainer = $(".main-header-bar .kmt-container"),
        headerWrap = headerContainer.parent(),
        containerWidth = $(this).parent(),
        Position = headerContainer.offset(),
        menuWidth = headerContainer.width();

      if ($(this).hasClass("mega-menu-full-width")) {
        menuWidth = headerWrap.width();
        Position = headerWrap.offset();
      } else if ($(this).hasClass("mega-menu-container-width")) {
        menuWidth = containerWidth.width();
        Position = containerWidth.offset();
      }

      var menuItemPosition = $(this).offset(),
        positionLeft = menuItemPosition.left - Position.left;

      $(this)
        .find(".kemet-megamenu")
        .css({ left: "-" + positionLeft + "px", width: menuWidth });
    },
    function() {
      $(this)
        .find(".kemet-megamenu")
        .css({ left: "-" + 999 + "em" });
    }
  );
})(jQuery);
