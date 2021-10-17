import { createElement, render } from '@wordpress/element'
import SettingsModal from './components/SettingsModal'

window.onload = function () {
    const div = document.createElement('div')
    document.body.appendChild(div)

    render(<SettingsModal />, div)
};

const settingButton = document.querySelectorAll(".kmt-menu-item-settings");
if (settingButton.length > 0) {
    for (let i = 0; i < settingButton.length; i++) {
        if ("undefined" !== typeof settingButton[i]) {
            const button = settingButton[i].querySelector('button');
            button.onclick = (e) => {
                e.preventDefault();
                const { itemId, navId, depth } = e.target.parentElement.dataset;
                var event = new CustomEvent('KemetEditMenuItem', {
                    detail: {
                        itemId,
                        depth,
                        navId
                    }
                });
                document.dispatchEvent(event);
            }
        }
    }
}