import { useState } from "@wordpress/element";
const { Container } = window.KmtAdminComponents;
import OptionsComponent from '../options-component'
const { __ } = wp.i18n;
const { Dashicon } = wp.components;

const OptionsTab = (props) => {
    const options = props.options;
    const [values, setValues] = useState(props.values);

    const handleChange = (newValues) => {
        setValues(newValues)
    };
    return <Container>
        <div className='advanced-options options-section'>
            <h2 className="kmt-section-title"><span className='icon'><Dashicon icon="screenoptions" /></span>{__('Advanced Settings', 'kemet-addons')}</h2>
            <OptionsComponent options={options} values={values} onChange={(newVal, optionId) => {
                handleChange(newVal, optionId)
            }} />
        </div>
    </Container>
}


export default OptionsTab;