(function ($) {
  document.addEventListener('KemetInitMenuOptions', function () {
    /**
   * set meta value to select
   */
    var oldMetaValues = kemetAddons.template_meta_value;

    if (typeof oldMetaValues == "object" && oldMetaValues != null) {
      $.each(oldMetaValues, function (id, value) {
        var menuItem = $(".kmt-item-setting-modal.menu-item-" + id),
          templateSelect = menuItem.find(".mega-menu-field-template"),
          postID = value;

        $.post(kemetAddons.ajax_url, {
          post_id: postID,
          action: "kemet_get_post_title",
          nonce: kemetAddons.ajax_title_nonce
        }).done(function (data) {
          templateSelect.append(new Option(data, postID, false, true));
        });
      });
    }

    /**
     * convert to select2 with ajax search
     * @param {string} selector
     */
    var convertToSelect2 = function (selector) {
      if ($(selector).hasClass("select2-hidden-accessible")) {
        return;
      }
      if ($(selector).val() == "") {
        $(selector).html("");
      }

      $(selector).select2({
        placeholder: kemetAddons.search,

        ajax: {
          url: kemetAddons.ajax_url,
          dataType: "json",
          method: "post",
          delay: 250,
          data: function (params) {
            return {
              query: params.term, // search term
              page: params.page,
              action: "kemet_ajax_get_posts_list",
              nonce: kemetAddons.ajax_nonce
            };
          },
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        minimumInputLength: 2,
        language: kemetAddons.lang,
        width: "100%"
      }).on('change', function (e) {
        var value = $(e.target).val();
        e.target.dispatchEvent(new CustomEvent("onCustomChange", {
          detail: {
            value,
          },
        }));
      });
    };

    var specificSelect = $(".mega-menu-field-template");

    specificSelect.each(function (index, selector) {
      convertToSelect2(selector);
    });
  })

})(jQuery);
