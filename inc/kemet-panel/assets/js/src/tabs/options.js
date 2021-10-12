import { Fragment, useState } from "@wordpress/element";
import Container from "../common/Container";
import OptionsComponent, { RenderStaticOptions } from '../options-component'
const { __ } = wp.i18n;
const { Dashicon } = wp.components;

const OptionsTab = (props) => {
    const options = props.options;
    const [values, setValues] = useState(props.values);

    const handleChange = (newValues) => {
        setValues(newValues)
    };
    return <Fragment>
        <Container>
            <div className='customize-site-options options-section'>
                <h2><span className='icon'><Dashicon icon="admin-customizer" /></span>{__('Customize Your Site', 'kemet')}</h2>
                <RenderStaticOptions options={props['customize-options']} />
            </div>
        </Container>
        <hr />
        <Container>
            <div className='advanced-options options-section'>
                <h2><span className='icon'><Dashicon icon="screenoptions" /></span>{__('Advanced Settings', 'kemet')}</h2>
                <OptionsComponent options={options} values={values} onChange={(newVal, optionId) => {
                    handleChange(newVal, optionId)
                }} />
            </div>
        </Container>
    </Fragment>
}


export default OptionsTab;