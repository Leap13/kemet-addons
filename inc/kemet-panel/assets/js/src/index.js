import OptionsTab from './tabs/options'
const { kmtEvents } = window.KmtOptionComponent;
const { __ } = wp.i18n;

let tabs = {
    tabs: [
        {
            name: 'kemet-addons',
            title: __('Kemet Addons', 'kemet'),
            className: 'kemet-addons',
            priority: 10,
        },
    ],
    data: {
        'kemet-addons': { Component: OptionsTab, props: { options: KemetAddonsPanelData.options, values: KemetAddonsPanelData.values } },
    }
};
kmtEvents.trigger('kmt:dashboard:customtabs', tabs);
