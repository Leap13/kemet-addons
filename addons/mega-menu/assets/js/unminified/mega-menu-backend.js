(function ($) {
  //Mega Menu Dependency
  var megaMenuDependency = function (show) {
    var subMenus = $(".menu-item-depth-1"),
      show = true;

    subMenus.each(function (index, val) {
      var $this = $(this),
        parentItem = $this.prevAll(".menu-item-depth-0"),
        parentItemID = parentItem.attr("id"),
        megaMenu = $("#" + parentItemID).find(
          ".enable-mega-menu .kfw--switcher"
        );

      if (megaMenu.hasClass("kfw--active")) {
        $this
          .find(
            ".kfw-nav-menu-options .column-heading , .kfw-nav-menu-options .disable-item-label , .kfw-nav-menu-options .mega-menu-field-template"
          )
          .show();
      } else {
        $this
          .find(
            ".kfw-nav-menu-options .column-heading , .kfw-nav-menu-options .disable-item-label , .kfw-nav-menu-options .mega-menu-field-template"
          )
          .hide();
      }
    });
  };

  megaMenuDependency();

  var enableMegaMenu = $(".enable-mega-menu").find("input");

  enableMegaMenu.on("change input", function () {
    megaMenuDependency();
  });
})(jQuery);
