(function ($) {
  "use strict";
  var filterBtn = $(".kmt-woo-filter"),
    offCanvasWrap = $("#kmt-off-canvas-wrap"),
    offCanvas = $(".kmt-off-canvas-sidebar");

  $(document)
    .off("click", ".kmt-off-canvas-overlay, .kmt-close-filter")
    .on("click", ".kmt-off-canvas-overlay, .kmt-close-filter", function (e) {
      e.preventDefault();

      offCanvasWrap.removeClass("side-off-canvas-filter");
      offCanvas.removeClass("side-off-canvas-filter");
    });
  filterBtn.click(function (e) {
    e.preventDefault();

    offCanvasWrap.addClass("side-off-canvas-filter");
    offCanvas.addClass("side-off-canvas-filter");
  });


  /**
   * Custom input number
   */
  var customInputNum = function () {
    var quantity = $(
      "div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)"
    ),
      quantityInput = quantity.find(".qty");

    if (
      quantityInput.length > 0 &&
      "date" !== quantityInput.prop("type") &&
      "hidden" !== quantityInput.prop("type")
    ) {
      quantityInput.parent().addClass("buttons_added");
      quantityInput.before('<a href="javascript:void(0)" class="minus" >-</a>');
      quantityInput.after('<a href="javascript:void(0)" class="plus" >+</a>');

      $(".plus, .minus").unbind("click");

      $("form.cart , .woocommerce-cart-form").on(
        "click",
        ".plus, .minus",
        function (e) {
          e.preventDefault();
          // Get current quantity values
          var qty = $(this)
            .closest(".quantity , td.product-quantity")
            .find(".qty");
          var val = parseFloat(qty.val());
          var max = parseFloat(qty.attr("max"));
          var min = parseFloat(qty.attr("min"));
          var step = parseFloat(qty.attr("step"));

          // Fallback default values
          if (!val || "" === val || "NaN" === val) {
            val = 0;
          }
          if ("" === max || "NaN" === max) {
            max = "";
          }

          if ("" === min || "NaN" === min) {
            min = 0;
          }
          if (
            "any" === step ||
            "" === step ||
            undefined === step ||
            "NaN" === parseFloat(step)
          ) {
            step = 1;
          }
          // Change the value if plus or minus
          if ($(this).is(".plus")) {
            if (max && max <= val) {
              qty.val(max);
            } else {
              qty.val(val + step);
            }
          } else {
            if (min && min >= val) {
              qty.val(min);
            } else if (val >= 1) {
              qty.val(val - step);
            }
          }
          qty.trigger("change");
        }
      );
    }
  };

  $(window).ready(function () {
    "use strict";
    customInputNum();
  });

  $(document).ajaxComplete(function () {
    "use strict";
    customInputNum();
  });

  /**
   * Infinite Scroll
   */
  var infiniteScroll = function () {
    var paginationStyle = kemet.pagination_style,
      totalPages = parseInt(kemet.shop_infinite_total) || "",
      counter = parseInt(kemet.shop_infinite_count) || "",
      ajax_url = kemet.ajax_url || "",
      loadStatus = true,
      loader = $(".kmt-woo-infinite-scroll-dots"),
      loadMore = $(".woo-load-more-text"),
      noMoreMsg = $(".woo-infinite-scroll-end-msg"),
      shop_infinite_nonce = kemet.shop_infinite_nonce || "";
    if (kemet.woo_infinite_scroll_style == "button") {
      loader.hide();
    }

    /**
     * Get Products via AJAX
     */
    function ProductsLoader(pageNumber) {
      loader.show();
      loadMore.hide();

      var data = {
        action: "kemet_infinite_scroll",
        page_no: pageNumber,
        nonce: shop_infinite_nonce,
        query_vars: kemet.query_vars,
      };

      $.post(ajax_url, data, function (data) {
        var products = $(data),
          productContainer = $(
            "#main > .kmt-woocommerce-container ul.products"
          );
        loader.hide();
        loadMore.show();
        productContainer.append(products);

        //	Show no more msg
        if (counter > totalPages) {
          loadMore.hide();
          loader.hide();
          noMoreMsg.show();
        }
        loadStatus = true;
      });
    }

    if (typeof paginationStyle != "" && paginationStyle == "infinite-scroll") {
      var in_customizer = false;

      // check for wp.customize return boolean
      if (typeof wp !== "undefined") {
        in_customizer = typeof wp.customize !== "undefined" ? true : false;

        if (in_customizer) {
          return;
        }
      }

      if (kemet.woo_infinite_scroll_style == "dots") {
        if ($("#main").find(".product:last").length > 0) {
          var windowHeight = jQuery(window).outerHeight() / 1.25;
          $(window).scroll(function () {
            if (
              $(window).scrollTop() + windowHeight >=
              $("#main").find(".product:last").offset().top
            ) {
              if (counter > totalPages) {
                return false;
              } else {
                if (loadStatus == true) {
                  ProductsLoader(counter);
                  counter++;
                  loadStatus = false;
                }
              }
            }
          });
        }
      } else {
        $(".woo-load-more-text").click(function () {
          if (counter > totalPages) {
            return false;
          } else {
            if (loadStatus == true) {
              ProductsLoader(counter);
              counter++;
              loadStatus = false;
            }
          }
        });
      }
    }
  };
  if ($("body").hasClass("archive") && $("body").hasClass("woocommerce")) {
    infiniteScroll();
  }
  // Vertical Gallary
  var verticalSliderScroll = function () {
    var vGallary = $(".kmt-gallary-vertical"),
      slider = vGallary.find(".flex-control-nav");
    if (vGallary.length > 0) {
      if ($(window).width() > 768) {
        var imgHeight = vGallary.find(".flex-viewport").height(),
          sliderHeight = slider.height();
        if (sliderHeight > imgHeight + 50) {
          slider.css({
            "max-height": imgHeight + "px",
            "overflow-y": "scroll",
          });
        }
      } else {
        slider.css({
          "max-height": "",
          "overflow-y": "",
        });
      }
    }
  };
  verticalSliderScroll();
  $(window).on("load", function () {
    setTimeout(function () {
      verticalSliderScroll();
    }, 500);
  });
  $(window).on("resize", function () {
    verticalSliderScroll();
  });
})(jQuery);
