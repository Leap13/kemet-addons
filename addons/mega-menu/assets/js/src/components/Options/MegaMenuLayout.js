import { Fragment, useState, useContext } from "react";
import OptionsContext from "../../store/options-context";
const { __ } = wp.i18n;
const { ButtonGroup, Dashicon, Tooltip, Button } = wp.components;
const { kmtEvents } = window.KmtOptionComponent;

const MegaMenuLayout = (props) => {
    const { Icons } = window.KmtOptionComponent;
    let defaultParams = {
        '6': {
            'equal': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'sixcol',
            },
            'left-six-heavy': {
                tooltip: __('Left Heavy 25/15/15/15/15/15', 'kemet'),
                icon: 'lfiveheavy',
            },
            'center-six-heavy': {
                tooltip: __('Center Heavy 15/15/20/20/15/15', 'kemet'),
                icon: 'cfiveheavy',
            },
            'right-six-heavy': {
                tooltip: __('Right Heavy 15/15/15/15/15/25', 'kemet'),
                icon: 'rfiveheavy',
            },
        },
        '5': {
            'equal': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'fivecol',
            },
            'left-five-forty': {
                tooltip: __('Left Heavy 40/15/15/15/15', 'kemet'),
                icon: 'lfiveforty',
            },
            'center-five-forty': {
                tooltip: __('Center Heavy 15/15/40/15/15', 'kemet'),
                icon: 'cfiveforty',
            },
            'right-five-forty': {
                tooltip: __('Right Heavy 15/15/15/15/40', 'kemet'),
                icon: 'rfiveforty',
            },
        },
        '4': {
            'equal': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'fourcol',
            },
            'left-forty': {
                tooltip: __('Left Heavy 40/20/20/20', 'kemet'),
                icon: 'lfourforty',
            },
            'center-forty': {
                tooltip: __('Center Heavy 10/40/40/10', 'kemet'),
                icon: 'cfourforty',
            },
            'right-forty': {
                tooltip: __('Right Heavy 20/20/20/40', 'kemet'),
                icon: 'rfourforty',
            },
        },
        '3': {
            'equal': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'threecol',
            },
            'left-half': {
                tooltip: __('Left Heavy 50/25/25', 'kemet'),
                icon: 'lefthalf',
            },
            'right-half': {
                tooltip: __('Right Heavy 25/25/50', 'kemet'),
                icon: 'righthalf',
            },
            'center-half': {
                tooltip: __('Center Heavy 25/50/25', 'kemet'),
                icon: 'centerhalf',
            },
            'center-wide': {
                tooltip: __('Wide Center 20/60/20', 'kemet'),
                icon: 'widecenter',
            },
        },
        '2': {
            'equal': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'twocol',
            },
            'left-golden': {
                tooltip: __('Left Heavy 66/33', 'kemet'),
                icon: 'twoleftgolden',
            },
            'right-golden': {
                tooltip: __('Right Heavy 33/66', 'kemet'),
                icon: 'tworightgolden',
            },
        },
        '1': {
            'row': {
                tooltip: __('Equal Width Columns', 'kemet'),
                icon: 'row',
            },
        }
    };
    const {
        label,
        row
    } = props.params;
    const { values } = useContext(OptionsContext);
    let columns = values['mega-menu-columns'] ? values['mega-menu-columns'] : 2;
    columns = parseInt(columns, 10);
    const layouts = props.params.layouts ? props.params.layouts : defaultParams;
    let defaultValue = columns !== 1 ? 'equal' : 'row';
    let value = props.value ? props.value : defaultValue;

    const [state, setState] = useState({
        value,
        columns
    });
    const HandleChange = (value) => {
        props.onChange(value);
        kmtEvents.trigger("KemetUpdateFooterColumns", row);
        setState((prevState) => ({
            ...prevState,
            value,
        }));
    };

    const controlMap = layouts[columns];

    return <Fragment>
        <span className="customize-control-title">{label}</span>
        <ButtonGroup className="kmt-radio-container-control">
            {Object.keys(controlMap).map((item) => {
                const currentValue = state.value ? state.value : '';

                return <Tooltip text={controlMap[item].tooltip}>
                    <Button
                        isTertiary
                        className={item === currentValue ? 'active-radio' : ''}
                        onClick={() => {
                            let newValue = item
                            HandleChange(newValue)
                        }}
                    >
                        {Icons.row[controlMap[item].icon] ? Icons.row[controlMap[item].icon] : item}
                    </Button>
                </Tooltip>
            })}
        </ButtonGroup>
    </Fragment>
}

export default MegaMenuLayout