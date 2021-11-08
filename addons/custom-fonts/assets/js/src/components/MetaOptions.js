import { useState, useEffect, Fragment } from '@wordpress/element';
import { __ } from "@wordpress/i18n";
import Options from './Options';
import OptionsContext from '../store/options-context';
import SaveButton from './UI/SaveButton';

const MetaOptions = (props) => {
    const [values, setValues] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const loadItemSettings = async () => {
        const body = new FormData()
        body.append('action', 'kemet_addons_get_custom_font_settings')
        body.append('post_id', props.id);
        body.append('nonce', kemetCustomFont.ajax_nonce)
        const response = await fetch(kemetCustomFont.ajax_url, {
            method: 'POST',
            body,
        })
        if (response.status === 200) {
            const { success, data } = await response.json()
            if (success) {
                console.log(data.values);
                setValues(data.values);
            }
        }
    }

    const onSaveHandler = async () => {
        setIsLoading(true);

        const body = new FormData()
        body.append('action', 'kemet_addons_update_font_settings')
        body.append('post_id', props.id);
        body.append('data', JSON.stringify({ ...kemetCustomFont.defaults, ...values }));
        body.append('nonce', kemetCustomFont.ajax_nonce)
        const response = await fetch(kemetCustomFont.ajax_url, {
            method: 'POST',
            body,
        })
        if (response.status === 200) {
            const { success } = await response.json()
            if (success) {
                setIsLoading(false);
            }
        }
    }

    useEffect(() => {
        loadItemSettings();
    }, [])

    const handleChange = (value, optionId) => {
        setValues((prevValue) => ({
            ...prevValue,
            [optionId]: value
        }));
    }

    const contextValues = {
        onChange: handleChange,
        values: { ...kemetCustomFont.defaults, ...values },
    }

    return (
        <OptionsContext.Provider value={contextValues}>
            {values && <Fragment>
                <Options options={props.options} />
                <SaveButton isLoading={isLoading} onClick={onSaveHandler} />
            </Fragment>}
        </OptionsContext.Provider>
    );
}

export default MetaOptions