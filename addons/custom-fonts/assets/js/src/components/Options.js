import { Fragment, useContext } from '@wordpress/element';
import OptionsContext from '../store/options-context';
import Uploader from './Uploader';

export const isDisplay = (rules) => {
    const { values, defaults } = useContext(OptionsContext);
    if (!values) {
        return;
    }
    var relation = undefined != rules.relation ? rules.relation : "AND",
        isVisible = "AND" === relation ? true : false;
    _.each(rules, function (rule, ruleKey) {
        if ("relation" == ruleKey) {
            return;
        }
        var boolean = false,
            operator = undefined != rule.operator ? rule.operator : "=",
            ruleValue = rule.value;
        var settingValue = values[rule.setting] ? values[rule.setting] : defaults[rule.setting];

        switch (operator) {
            case "in_array":
                boolean = ruleValue.includes(settingValue);
                break;

            case "contain":
                boolean = settingValue.includes(ruleValue);
                break;

            case ">":
                boolean = settingValue > ruleValue;
                break;

            case "<":
                boolean = settingValue < ruleValue;
                break;

            case ">=":
                boolean = settingValue >= ruleValue;
                break;

            case "<=":
                boolean = settingValue <= ruleValue;
                break;

            case "not_empty":
                boolean =
                    typeof settingValue !== "undefined" &&
                    undefined !== settingValue &&
                    null !== settingValue &&
                    "" !== settingValue;
                break;

            case "!=":
                boolean = settingValue !== ruleValue;
                break;

            default:
                boolean = settingValue == ruleValue;
                break;
        }
        isVisible =
            "OR" === relation ? isVisible || boolean : isVisible && boolean;
    });

    return isVisible;
};

const SingleOptionComponent = ({ value, optionId, option, onChange }) => {
    const { OptionComponent } = window.KmtOptionComponent;
    const Option = option.type === 'kmt-upload' ? Uploader : OptionComponent(option.type);
    const divider = option.divider ? ' has-divider' : '';

    return option.type && <div id={optionId} className={`customize-control-${option.type}${divider}`}>
        <Option id={optionId} value={value} params={option} onChange={onChange} />
    </div>;
}

const Options = ({ options }) => {
    const { values, onChange } = useContext(OptionsContext);

    const renderOptions = (options) => {
        return Object.keys(options).map((optionId) => {
            let value = values[optionId];
            let option = options[optionId];
            let isVisible = option.context ? isDisplay(option.context) : true;

            return isVisible && <SingleOptionComponent value={value} optionId={optionId} option={option} onChange={(newVal) => {
                onChange(newVal, optionId)
            }} key={optionId} />;
        })
    }

    return <div className="kmt-options">
        {renderOptions(options)}
    </div>

}

export default Options