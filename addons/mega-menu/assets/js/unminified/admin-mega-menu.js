(function ($) {
  /**
   * convert to select2 with ajax search
   * @param {string} selector
   */
  var convertToSelect2 = function (selector) {
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
    });
  };

  var specificSelect = $(".mega-menu-field-template").find("select");
  specificSelect.each(function (index, selector) {
    convertToSelect2(selector);
  });
})(jQuery);
