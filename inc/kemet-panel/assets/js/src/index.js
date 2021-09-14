const { OptionComponent } = window.KmtOptionComponent
import OptionsTab from './tabs/options'

const RendeTabs = ({ options, values }) => {

    return <OptionsTab options={options.options} values={values.options} />
};


import { render } from '@wordpress/element'

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('kmt-dashboard')) {
        render(<RendeTabs options={KemetPanelData.options} values={KemetPanelData.values} />, document.getElementById('kmt-dashboard'))
    }
})
