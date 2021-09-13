const { OptionComponent } = window.KmtOptionComponent

const RenderOptions = ({ options }) => {
    console.log(options);
    return Object.keys(options).map((optionId) => {
        let optionData = options[optionId];
        const Option = OptionComponent(optionData.type);
        return optionData.type && <div id={optionId} className={`customize-control-${optionData.type}`}>
            <Option id={optionId} value='' params={optionData} onChange={(value) => {
                console.log(value);
            }} />
        </div>
    })
};


import { render } from '@wordpress/element'

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('kmt-dashboard')) {
        render(<RenderOptions options={KemetPanelData.options.options} />, document.getElementById('kmt-dashboard'))
    }
})
