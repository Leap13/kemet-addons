import { useState } from '@wordpress/element';
import { __ } from "@wordpress/i18n";
import Options from './Options';
import OptionsContext from '../store/options-context';

const MetaOptions = (props) => {
    const metaInput = document.getElementById('kmt-font-meta');
    let metaValue = JSON.parse(metaInput.value);
    metaValue = metaValue ? metaValue : {};
    const [values, setValues] = useState({ ...kemetCustomFont.defaults, ...metaValue });

    const handleChange = (value, optionId) => {
        let updatedValues = { ...values };

        updatedValues[optionId] = value;
        setValues((prevValue) => ({
            ...prevValue,
            [optionId]: value
        }));
        metaInput.value = JSON.stringify(updatedValues);
    }

    const contextValues = {
        onChange: handleChange,
        values: values,
    }

    return (
        <OptionsContext.Provider value={contextValues}>
            <Options options={props.options} />
        </OptionsContext.Provider>
    );
}

export default MetaOptions