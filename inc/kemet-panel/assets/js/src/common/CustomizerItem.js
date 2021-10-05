const { __ } = wp.i18n;
const CustomizerItem = (props) => {
    return <div id={props.id} className='option-card'>
        <div className='option'>
            <label>
                <span className="customize-control-title kmt-control-title">{props.params.label}</span>
                <div className="description customize-control-description">{props.params.description}</div>
            </label>
            <div className="option-actions">
                <a className='kmt-button' href={props.params.url}>{__('Customize', 'kemet')}</a>
            </div>
        </div>
    </div>
}

export default CustomizerItem