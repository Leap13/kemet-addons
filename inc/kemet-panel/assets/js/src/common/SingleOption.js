import { useState } from "react";
import Card from "./Card";

const { __ } = wp.i18n;
const { Dashicon } = wp.components;
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
    const btnClasses = value === true ? 'secondary' : 'primary';
    return <Card id={props.id}>
        <label>
            <span className="customize-control-title kmt-control-title">{props.params.label}</span>
            <div className="description customize-control-description">{props.params.description}</div>
            {isLoading && (
                <Dashicon icon='update' />
            )}
        </label>
        <div className="option-actions">
            <button className={`kmt-button ${btnClasses}`} onClick={() => {
                handleChange()
            }} disabled={isLoading}>{btnText}</button>
            {value && props.params.url && <a className='kmt-button' href={props.params.url}>{__('Customize', 'kemet')}</a>}
        </div>
    </Card>
}

export default SingleOption