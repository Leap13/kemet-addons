import {
    useEffect, useState
} from '@wordpress/element'


const SingleOptionComponent = ({ value, optionId, option, onChange }) => {
    const { OptionComponent } = window.KmtOptionComponent;
    const Option = OptionComponent(option.type);

    return option.type && <div id={optionId} className={`customize-control-${option.type}`}>
        <Option id={optionId} value={value} params={option} onChange={onChange} />
    </div>;
}

const RenderOptions = ({ options, values, onChange }) => {
    return Object.keys(options).map((optionId) => {
        let value = values[optionId];
        let option = options[optionId];

        return <SingleOptionComponent value={value} optionId={optionId} option={option} onChange={(newVal) => {
            onChange(newVal, optionId)
        }} key={optionId} />;
    })
}

export default RenderOptions