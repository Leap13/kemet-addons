import OptionsTab from './tabs/options'
const { kmtEvents } = window.KmtOptionComponent;
const { __ } = wp.i18n;

kmtEvents.on('kmt:dashboard:customtabs', function ({ detail: tabs }) {
    tabs.push({
        name: 'kemet-addons',
        title: __('Kemet Addons', 'kemet-addons'),
        className: 'kemet-addons',
        priority: 10,
        data: {
            Component: OptionsTab,
            props: { options: KemetAddonsPanelData.options, values: KemetAddonsPanelData.values },
        }
    });
})