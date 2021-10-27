import { createElement, render } from '@wordpress/element'
import SettingsModal from './components/SettingsModal'

window.onload = function () {
    const div = document.createElement('div')
    document.body.appendChild(div)

    render(<SettingsModal />, div)
};

(function ($) {
    $(document).on('click', '.kmt-menu-item-settings button', (e) => {
        e.preventDefault();
        const { itemId, navId } = e.target.parentElement.dataset;
        const title = e.target.closest('.menu-item').querySelector('.edit-menu-item-title').value
        const depth = parseFloat(
            [...e.target.closest('.menu-item').classList]
                .find((c) => c.indexOf('menu-item-depth') > -1)
                .replace('menu-item-depth-', '')
        );
        var event = new CustomEvent('KemetEditMenuItem', {
            detail: {
                itemId,
                depth,
                title,
                navId
            }
        });
        document.dispatchEvent(event);
    })
    document.addEventListener('KemetInitMenuOptions', function (e) {
        var itemId = e.detail.itemId;
        /**
       * set meta value to select
       */
        var oldMetaValues = kemetMegaMenu.template_meta_value;

        if (oldMetaValues[itemId]) {
            var menuItem = $(".kmt-item-setting-modal.menu-item-" + itemId),
                templateSelect = menuItem.find(".mega-menu-field-template"),
                postID = oldMetaValues[itemId];

            $.post(kemetMegaMenu.ajax_url, {
                post_id: postID,
                action: "kemet_get_post_title",
                nonce: kemetMegaMenu.ajax_title_nonce
            }).done(function (data) {
                templateSelect.append(new Option(data, postID, false, true));
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
                placeholder: kemetMegaMenu.search,

                ajax: {
                    url: kemetMegaMenu.ajax_url,
                    dataType: "json",
                    method: "post",
                    delay: 250,
                    data: function (params) {
                        return {
                            query: params.term, // search term
                            page: params.page,
                            action: "kemet_ajax_get_posts_list",
                            nonce: kemetMegaMenu.select2_ajax_nonce
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
                language: kemetMegaMenu.lang,
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