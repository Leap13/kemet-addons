import CustomizerItem from "./common/CustomizerItem";
import SingleOption from "./common/SingleOption";

const SingleOptionComponent = ({ value, optionId, option, onChange }) => {
    return <SingleOption id={optionId} value={value} params={option} onChange={onChange} />
        ;
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

export const RenderStaticOptions = ({ options }) => {
    return <div className="kmt-options">
        {Object.keys(options).map((optionId) => {
            const option = options[optionId];
            return <CustomizerItem id={optionId} params={option} />;
        })}
    </div>
}
export default OptionsComponent