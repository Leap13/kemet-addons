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
        let parentItemID;
        const { itemId, navId } = e.target.parentElement.dataset;
        const title = e.target.closest('.menu-item').querySelector('.edit-menu-item-title').value
        const depth = parseFloat(
            [...e.target.closest('.menu-item').classList]
                .find((c) => c.indexOf('menu-item-depth') > -1)
                .replace('menu-item-depth-', '')
        );
        if (depth > 0) {
            const parentItem = $(e.target).parents('.menu-item').prevAll(".menu-item-depth-0");
            parentItemID = parseFloat(parentItem.attr("id").replace('menu-item-', ''));
        }
        var event = new CustomEvent('KemetEditMenuItem', {
            detail: {
                itemId,
                depth,
                title,
                navId,
                parent: parentItemID
            }
        });
        document.dispatchEvent(event);
    })
    document.addEventListener('KemetInitMenuOptions', function (e) {
        var specificSelect = $(".mega-menu-field-template");
        specificSelect.select2({
            placeholder: 'Select a Template',
        }).on('change', function (e) {
            var value = $(e.target).val();
            e.target.dispatchEvent(new CustomEvent("onCustomChange", {
                detail: {
                    value,
                },
            }));
        });;
    })

})(jQuery);