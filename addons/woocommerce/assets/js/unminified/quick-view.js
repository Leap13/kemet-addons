(function($) {
  if (typeof kemet === "undefined") {
    return false;
  }
  KmtQuickView = {
    init: function() {
      this.bind();
      //   this.quickViewStyle();
    },
    bind: function() {
      // Open Quick View.
      $(document)
        .off(
          "click",
          ".kmt-quick-view , .kmt-qv-on-image, .kmt-qv-icon, .kmt-quickview-icon"
        )
        .on(
          "click",
          ".kmt-quick-view, .kmt-qv-on-image , .kmt-qv-icon, .kmt-quickview-icon",
          KmtQuickView.openModel
        );
      // Close Quick View.
      $(document)
        .off("click", ".kmt-qv-close , .kmt-close-qv")
        .on("click", ".kmt-qv-close , .kmt-close-qv", KmtQuickView.closeModel);
      $(document).on("keyup", KmtQuickView.EscKeypress);
    },
    quickViewStyle: function() {
      var sliderHeight = $("#kmt-qv-content .images").outerHeight();
      $("#kmt-qv-content").css({
        "max-width": parseFloat($(window).width()) - 120,
        "max-height": parseFloat(sliderHeight)
      });
      $("#kmt-qv-content .entry-summary").css({
        "max-height": parseFloat(sliderHeight)
      });
    },
    openModel: function(e) {
      e.preventDefault();

      var control = this,
        quickBtn = $(this),
        productId = quickBtn.data("product_id"),
        modal = $("#kmt-qv-wrap"),
        overlay = $(".kmt-qv-overlay"),
        content = $("#kmt-qv-content");

      overlay.addClass("visible");
      overlay.addClass("loading");
      $.ajax({
        url: kemet.ajax_url,
        type: "POST",
        dataType: "html",
        data: {
          action: "kemet_load_quick_view",
          product_id: productId
        },
        success: function(results) {
          var innerWidth = $("html").innerWidth();
          $("html").css("overflow", "hidden");
          var hiddenInnerWidth = $("html").innerWidth();
          $("html").css("margin-right", hiddenInnerWidth - innerWidth);
          $("html").addClass("kmt-qv-open");

          content.html(results);
          setTimeout(function() {
            KmtQuickView.quickViewStyle();
          }, 100);
          // Display modal
          modal.fadeIn();
          modal.addClass("is-visible");

          var imageSlider = content.find(".kmt-qv-image");

          if (imageSlider.find("li").length > 1) {
            imageSlider.flexslider();
          }
        }
      }).done(function() {
        overlay.removeClass("loading");
      });
    },
    closeModel: function(e) {
      e.preventDefault();

      var modal = $("#kmt-qv-wrap"),
        overlay = $(".kmt-qv-overlay"),
        content = $("#kmt-qv-content");

      $("html").css({
        overflow: "",
        "margin-right": ""
      });
      $("html").removeClass("kmt-qv-open");

      modal.fadeOut();
      modal.removeClass("is-visible");
      overlay.removeClass("visible");

      setTimeout(function() {
        content.html("");
      }, 600);
    },
    EscKeypress: function(e) {
      e.preventDefault();
      if (e.keyCode === 27) {
        KmtQuickView.closeModel(e);
      }
    }
  };

  /**
   * Initialization
   */
  $(function() {
    KmtQuickView.init();
  });
})(jQuery);
