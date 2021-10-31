import { Fragment, useContext, useEffect } from '@wordpress/element';
import OptionsContext from '../store/options-context';
import Tabs from './Tabs';
import CreatePostButton from './UI/CreatePostButton';

export const isDisplay = (rules, values, depth = 0) => {
    if (!values) {
        return;
    }
    const { parent } = useContext(OptionsContext);
    var relation = undefined != rules.relation ? rules.relation : "AND",
        isVisible = "AND" === relation ? true : false;
    _.each(rules, function (rule, ruleKey) {
        if ("relation" == ruleKey) {
            return;
        }
        var boolean = false,
            operator = undefined != rule.operator ? rule.operator : "=",
            ruleValue = rule.value;

        var settingValue = rule.setting === 'depth' ? depth : values[rule.setting];
        settingValue = rule.operator === 'parent' ? parent.values[rule.setting] : settingValue;
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
    const { itemId, values } = useContext(OptionsContext);
    const { OptionComponent } = window.KmtOptionComponent;
    const Option = option.type === 'kmt-tabs' ? Tabs : OptionComponent(option.type);
    const divider = option.divider ? 'has-divider' : '';

    if (optionId === 'column-template') {
        const postType = values['item-content'];
        if (kemetMegaMenu.posts_count[postType] === 0) {
            return <CreatePostButton type={postType} />
        }
        const contentTemplateChoices = kemetMegaMenu.posts[postType];
        option.choices = contentTemplateChoices;
    }

    useEffect(() => {
        if (optionId === 'column-template') {
            let event = new CustomEvent("KemetInitMenuOptions", { detail: { itemId } });
            document.dispatchEvent(event);
        }
    }, []);

    return option.type && <div id={optionId} className={`customize-control-${option.type} ${divider}`}>
        <Option id={optionId} value={value} params={option} onChange={onChange} />
    </div>;
}

const Options = ({ options }) => {
    const { values, depth, onChange } = useContext(OptionsContext);

    const renderOptions = (options) => {
        return Object.keys(options).map((optionId) => {
            let value = values[optionId];
            let option = options[optionId];
            let isVisible = option.context ? isDisplay(option.context, values, depth) : true;

            return isVisible && <SingleOptionComponent value={value} optionId={optionId} option={option} onChange={(newVal) => {
                onChange(newVal, optionId)
            }} key={optionId} />;
        })
    }

    return <Fragment>
        {renderOptions(options)}
    </Fragment>

}

export default Options