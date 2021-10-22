import { useEffect } from '@wordpress/element';

export const isDisplay = (rules, values, depth = 0) => {
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

        var settingValue = rule.setting === 'depth' ? depth : values[rule.setting];

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
    const Option = OptionComponent(option.type);
    const divider = option.divider ? 'has-divider' : '';
    return option.type && <div id={optionId} className={`customize-control-${option.type} ${divider}`}>
        <Option id={optionId} value={value} params={option} onChange={onChange} />
    </div>;
}

const Options = ({ options, onChange, values, depth }) => {
    return <div className="kmt-options">
        {Object.keys(options).map((optionId) => {
            let value = values[optionId];
            let option = options[optionId];
            let isVisible = option.context ? isDisplay(option.context, values, depth) : true;

            useEffect(() => {
                jQuery(document).mouseup(function (e) {
                    var container = jQuery(document);
                    var colorWrap = container.find('.kemet-color-picker-wrap');
                    var resetBtnWrap = container.find('.kmt-color-btn-reset-wrap');

                    // If the target of the click isn't the container nor a descendant of the container.
                    if (colorWrap.has(e.target).length === 0 && resetBtnWrap.has(e.target).length === 0) {
                        container.find('.components-button.kemet-color-icon-indicate.open').click();
                    }
                });
                if (optionId === 'column-template' && isVisible) {
                    let event = new CustomEvent("KemetInitMenuOptions");
                    document.dispatchEvent(event);
                }
            }, [values]);

            return isVisible && <SingleOptionComponent value={value} optionId={optionId} option={option} onChange={(newVal) => {
                onChange(newVal, optionId)
            }} key={optionId} />;
        })}
    </div>
}

export default Options