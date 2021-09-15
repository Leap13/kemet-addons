import OptionsTab from './tabs/options'
import { render } from '@wordpress/element'
const { __ } = wp.i18n;
const { TabPanel, Panel, PanelBody, PanelRow, Button } = wp.components;

const RendeTabs = ({ options, values }) => {
    const tabs = [
        {
            name: 'customizer-options',
            title: __( 'Customizer & Page Options', 'kemet' ),
            className: 'customizer-options',
        },
        {
            name: 'plugins',
            title: __( 'Plugins', 'kemet' ),
            className: 'plugins',
        },
    ]
    return <TabPanel className="kemet-dashboard-tab-panel"
            activeClass="active-tab"
            tabs={ tabs }>
            {
                ( tab ) => {
                    switch ( tab.name ) {
                        case 'customizer-options':
                            return (
                                <Panel className="dashboard-section tab-section">
                                    <PanelBody
                                        opened={ true }
                                    >
                                        <OptionsTab options={options.options} values={values.options} />
                                    </PanelBody>
                                </Panel>
                            );
                            break;
                    }
                }
            }
        </TabPanel>
};

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('kmt-dashboard')) {
        render(<RendeTabs options={KemetPanelData.options} values={KemetPanelData.values} />, document.getElementById('kmt-dashboard'))
    }
})
