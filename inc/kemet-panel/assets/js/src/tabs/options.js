import { useState } from "@wordpress/element";
import OptionsComponent from '../options-component'

const OptionsTab = (props) => {
    const options = props.options;
    const [values, setValues] = useState(props.values);

    const handleChange = async (value, optionId) => {
        const body = new FormData()
        body.append('action', 'kemet-panel-update-option')
        body.append('nonce', KemetPanelData.nonce)
        body.append('option', optionId)
        body.append('value', value)

        try {
            const response = await fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body,
            })
            if (response.status === 200) {
                const { success, data } = await response.json()
                if (success && data.values) {
                    setValues(data.values)
                }
            }
        } catch (e) {
            console.log(e);
        }
    };
    return <OptionsComponent options={options} values={values} onChange={(newVal, optionId) => {
        handleChange(newVal, optionId)
    }} />
}


export default OptionsTab;