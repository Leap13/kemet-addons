import { useState } from "@wordpress/element";
import OptionsComponent from '../options-component'

const OptionsTab = (props) => {
    const options = props.options;
    const [values, setValues] = useState(props.values);

    const handleChange = (newValues) => {
        setValues(newValues)
    };
    return <OptionsComponent options={options} values={values} onChange={(newVal, optionId) => {
        handleChange(newVal, optionId)
    }} />
}


export default OptionsTab;