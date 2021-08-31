(function ($) {
  document.addEventListener('KemetInitOptionsMeta', function () {
    var container = $(document).find(".kmt-post-options");
    /**
     * Set options Descriptions
     */
    var descriptions = kemetAddons.hooks_descriptions,
      hooksSelect = container.find(".kmt-hooks-select"),
      hookValue = hooksSelect.val(),
      descriptionDiv = container.find(".kmt-hooks-select .kfw-text-desc");

    if (
      descriptions[hookValue] != "" &&
      typeof descriptions[hookValue] != "undefined"
    ) {
      descriptionDiv.html(
        "Action to add your content or snippet " + descriptions[hookValue] + "."
      );
    }
    hooksSelect.change(function () {
      var $this = $(this),
        value = $this.val(),
        desc = descriptions[value];

      if (
        descriptions[value] != "" &&
        typeof descriptions[value] != "undefined"
      ) {
        descriptionDiv.html(
          "Action to add your content or snippet " + desc + "."
        );
      } else {
        descriptionDiv.html("");
      }
    });

    /**
     * set meta value to select
     * @param {string} selector
     * @param {array} values
     */

    var setValues = function (selector, values) {
      $.each(values, function (index, post_id) {
        var specificSelect = selector;
        postID = post_id.toString();

        if (postID.includes(",")) {
          var idsObj = postID.split(",");

          $.each(idsObj, function (x, id) {
            $.post(kemetAddons.ajax_url, {
              post_id: id,
              action: "kemet_get_post_title",
              nonce: kemetAddons.ajax_title_nonce
            }).done(function (data) {
              specificSelect.append(new Option(data, id, false, true));
            });
          });
        } else {
          $.post(kemetAddons.ajax_url, {
            post_id: postID,
            action: "kemet_get_post_title",
            nonce: kemetAddons.ajax_title_nonce
          }).done(function (data) {
            specificSelect.append(new Option(data, postID, false, true));
          });
        }
      });
    };

    var displayOldValues =
      kemetAddons.display_old_value != "" ? kemetAddons.display_old_value : "",
      hideOldValues =
        kemetAddons.hide_old_value != "" ? kemetAddons.hide_old_value : "";

    if (typeof displayOldValues == "object" && displayOldValues != null) {
      var displaySelector = container.find(".kmt-display-on-specifics-select");
      setValues(displaySelector, displayOldValues);
    }

    if (typeof hideOldValues == "object" && hideOldValues != null) {
      var hideSelector = container.find(".kmt-hide-on-specifics-select");
      setValues(hideSelector, hideOldValues);
    }

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
      }).on('change', function (e) {
        var value = $(e.target).val();
        e.target.dispatchEvent(new CustomEvent("onCustomChange", {
          detail: {
            value,
          },
        }));
      });
    };

    var specificSelect = container.find(
      ".kmt-hide-on-specifics-select , .kmt-display-on-specifics-select"
    );
    specificSelect.each(function (index, selector) {
      convertToSelect2(selector);
    });

    var displaySelects = container.find(".display-on-rule , .hide-on-rule");
    displaySelects.select2({
      width: "100%",
    }).on('change', function (e) {
      var value = $(e.target).val();
      e.target.dispatchEvent(new CustomEvent("onCustomChange", {
        detail: {
          value,
        },
      }));
    });

    displaySelects.each(function (index, selector) {
      var value = $(this).val();

      if (value != null && value.includes("specifics-location")) {
        if ($(selector).hasClass('display-on-rule')) {
          container.find("#display-on-specifics-location").css("display", "block");
        } else {
          container.find("#hide-on-specifics-location").css("display", "block");
        }
      } else {
        if ($(selector).hasClass('display-on-rule')) {
          container.find("#display-on-specifics-location").css("display", "block");
        } else {
          container.find("#hide-on-specifics-location").css("display", "block");
        }
      }
    });
    displaySelects.on('change', function () {
      var value = $(this).val(),
        selector = $(this);
      if (value != null && value.includes("specifics-location")) {
        if ($(selector).hasClass('display-on-rule')) {
          container.find("#display-on-specifics-location").css("display", "block");
        } else {
          container.find("#hide-on-specifics-location").css("display", "block");
        }
      } else {
        if ($(selector).hasClass('display-on-rule')) {
          container.find("#display-on-specifics-location").css("display", "block");
        } else {
          container.find("#hide-on-specifics-location").css("display", "block");
        }
      }
    });
    container.find(".kmt-user-rules")
      .select2({
        width: "100%"
      }).on('change', function (e) {
        var value = $(e.target).val();
        e.target.dispatchEvent(new CustomEvent("onCustomChange", {
          detail: {
            value,
          },
        }));
      });
    /**
     * Enable Code Editor
     */
    var codeEditorSwitcher = $(".enable-code-editor").find("input"),
      kemetMeta = $("#kemet_code_editor");

    var setSwitcherValue = function () {
      var url = window.location.href;

      if (
        url.indexOf("&code_editor") > -1 ||
        (codeEditorSwitcher.val() == 1 && url.indexOf("&wordpress_editor") == -1)
      ) {
        codeEditorSwitcher.parent().addClass("kfw--active");
        $("body").addClass("kemet-code-editor");
        codeEditorSwitcher.val(1);
      } else if (
        url.indexOf("&wordpress_editor") > -1 ||
        codeEditorSwitcher.val() == 0 ||
        url.indexOf("&code_editor") == -1
      ) {
        if ($("body").hasClass("kemet-code-editor")) {
          $("body").removeClass("kemet-code-editor");
        }
        codeEditorSwitcher.parent().removeClass("kfw--active");
        codeEditorSwitcher.val(0);
      } else {
        codeEditorSwitcher.val(0);
      }
    };
    setSwitcherValue();
    codeEditorSwitcher.change(function () {
      var value = $(this).val(),
        url = window.location.href;

      if (value == 1) {
        if (url.indexOf("&wordpress_editor") > -1) {
          url = url.replace("&wordpress_editor", "");
        }
        window.location.replace(url + "&code_editor");
      } else {
        if (url.indexOf("&code_editor") > -1) {
          url = url.replace("&code_editor", "");
        }

        url = url + "&wordpress_editor";

        window.location.replace(url);
      }
    });
  })
})(jQuery);
