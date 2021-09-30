import { useState } from "react";

const { __ } = wp.i18n;
const { Button } = wp.components;
const SingleOption = (props) => {
    const [value, setValue] = useState(props.value);
    const [isLoading, setIsLoading] = useState(false);

    const handleChange = async () => {
        setIsLoading(true);
        let newValue = !value
        const body = new FormData()
        body.append('action', 'kemet-panel-update-option')
        body.append('nonce', KemetPanelData.nonce)
        body.append('option', props.id)
        body.append('value', newValue)
        console.log(props.id, newValue);
        try {
            const response = await fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body,
            })
            if (response.status === 200) {
                const { success, data } = await response.json()
                if (success && data.values) {
                    console.log(data.values);
                    setValue(newValue);
                    props.onChange(data.values);
                }
            }
        } catch (e) {
            console.log(e);
        }
        setIsLoading(false)
    };

    let btnText = value === true ? __('Deactivate', 'kemet') : __('Activate', 'kemet')
    return <div className='option-card'>
        <div className="icon"></div>
        <div className='option'>
            <label>
                <span className="customize-control-title kmt-control-title">{props.params.label}</span>
                <div className="description customize-control-description">{props.params.description}</div>
            </label>
            <div className="option-actions">
                <Button isPrimary={!value} isSecondary={value} disabled={isLoading} onClick={() => {
                    handleChange()
                }}>{btnText}</Button>
            </div>
        </div>
    </div>
}

export default SingleOption