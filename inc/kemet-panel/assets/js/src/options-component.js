import SingleOption from "./common/SingleOption";

const SingleOptionComponent = ({ value, optionId, option, onChange }) => {
    const { OptionComponent } = window.KmtOptionComponent;
    const Option = OptionComponent(option.type);

    return option.type && <SingleOption>
        <div id={optionId} className={`customize-control-${option.type}`}>
            <Option id={optionId} value={value} params={option} onChange={onChange} />
            <div className="description customize-control-description">{option.description}</div>
        </div>
    </SingleOption>;
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

const OptionsComponent = ({ options, onChange, values }) => {
    return <div className="kmt-options">
        <RenderOptions options={options} onChange={onChange} values={values} />
    </div>
}

export default OptionsComponent