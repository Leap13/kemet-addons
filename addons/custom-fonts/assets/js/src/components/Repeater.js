import { Panel, PanelBody, PanelRow, Button } from '@wordpress/components';
import { __ } from "@wordpress/i18n";
import { SingleOptionComponent } from './Options';
import { useContext } from '@wordpress/element';
import OptionsContext from '../store/options-context';
import { useState, Fragment } from '@wordpress/element';

const RenderOptions = ({ values, options, onChange, index }) => {
    return <div className="kmt-options">
        {Object.keys(options).map((optionId) => {
            let value = values[optionId];
            let option = options[optionId];

            return <SingleOptionComponent value={value} optionId={optionId} option={option} onChange={(newVal) => {
                onChange(newVal, optionId, index)
            }} key={optionId} />;
        })}
    </div>
}

const Repeater = props => {
    const { label, options } = props.params;
    const { values, onChange: onChangeVariation } = useContext(OptionsContext);
    const getDefaultValues = () => {
        const obj = {};
        Object.keys(options).map(optionKey => {
            const { default: defaultValue } = options[optionKey];
            obj[optionKey] = defaultValue ? defaultValue : '';
        })

        return obj;
    }
    const defaults = getDefaultValues();
    const fontVariations = values.variations ? values.variations : [];
    const [fontVariationsList, setFontVariationsList] = useState(fontVariations);

    const addVariationHandler = () => {
        const updatedList = [...fontVariationsList];
        updatedList.push(defaults)
        setFontVariationsList(updatedList);
    }

    const onChange = (value, optionId, index) => {
        const updatedList = [...fontVariationsList];
        updatedList[index][optionId] = value;
        setFontVariationsList(updatedList);
        onChangeVariation(updatedList, 'variations');
    };

    const deleteVariation = (index) => {
        const updatedList = [...fontVariationsList];
        updatedList.splice(index, 1);
        setFontVariationsList(updatedList);
        onChangeVariation(updatedList, 'variations');

    }

    const checkProperties = (obj) => {
        for (var key in obj) {
            if (obj[key] !== null && obj[key] != "" && key.includes('-font'))
                return false;
        }
        return true;
    }

    return <Fragment>
        <p className='kmt-control-title' style={{ marginTop: "0" }}>{label}</p>
        <Panel header={false}>
            {fontVariationsList && fontVariationsList.map((variation, index) => {
                const weight = `${variation['font-weight']}00`;
                const style = variation['font-style'] === 'n' ? __('Normal', 'kemet-addons') : __('Italic', 'kemet-addons');
                return <PanelBody title={`${__('Weight', 'kemet-addons')}: ${weight}, ${__('Style', 'kemet-addons')}: ${style}`} initialOpen={checkProperties(variation)} key={index}>
                    <PanelRow><RenderOptions options={options} onChange={onChange} values={variation} index={index} /></PanelRow>
                    <PanelRow><Button style={{ marginLeft: "auto" }} isDestructive={true} onClick={() => deleteVariation(index)}>
                        {__("Delete", 'kemet-addons')}
                    </Button></PanelRow>
                </PanelBody>
            })}
        </Panel>
        <Button className='repeater-action' isLarge={true} isPrimary={true} onClick={addVariationHandler}>{__('Add Font Variation', 'kemet-addons')}</Button>
    </Fragment>
}

export default Repeater