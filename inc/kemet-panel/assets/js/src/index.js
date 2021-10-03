import OptionsTab from './tabs/options'
import Plugins from './tabs/plugins'
import System from './tabs/system'
import { render, Fragment } from '@wordpress/element'
import Header from './layout/Header';
const { __ } = wp.i18n;
const { TabPanel, Panel, PanelBody } = wp.components;

const RendeTabs = ({ options, values }) => {
    const tabs = [
        {
            name: 'customizer-options',
            title: __('Customizer & Page Options', 'kemet'),
            className: 'customizer-options',
        },
        {
            name: 'plugins',
            title: __('Plugins', 'kemet'),
            className: 'plugins',
        },
        {
            name: 'system',
            title: __('System Info', 'kemet'),
            className: 'system',
        },
    ]
    return <Fragment>
        <Header />
        <TabPanel className="kemet-dashboard-tab-panel"
            activeClass="active-tab"
            tabs={tabs}>
            {
                (tab) => {
                    switch (tab.name) {
                        case 'customizer-options':
                            return (
                                <Panel className="dashboard-section tab-section">
                                    <PanelBody
                                        opened={true}
                                    >
                                        <OptionsTab options={options.options} values={values.options} />
                                    </PanelBody>
                                </Panel>
                            );
                        case 'plugins':
                            return (
                                <Panel className="dashboard-section tab-section">
                                    <PanelBody
                                        opened={true}
                                    >
                                        <Plugins />
                                    </PanelBody>
                                </Panel>
                            );
                        case 'system':
                            return (
                                <Panel className="dashboard-section tab-section">
                                    <PanelBody
                                        opened={true}
                                    >
                                        <System />
                                    </PanelBody>
                                </Panel>
                            );
                    }
                }
            }
        </TabPanel>
    </Fragment>
};

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('kmt-dashboard')) {
        let sidebar = document.getElementById("adminmenuwrap"),
            sidebarHeight = sidebar.offsetHeight + 'px';
        console.log(sidebarHeight);

        document.getElementById("wpbody").style.minHeight = sidebarHeight
        render(<RendeTabs options={KemetPanelData.options} values={KemetPanelData.values} />, document.getElementById('kmt-dashboard'))
    }
})
