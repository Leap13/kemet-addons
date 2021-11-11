const { __ } = wp.i18n;

const Table = props => {
    const { label, data } = props.params;
    const value = props.value ? props.value : '';
    let labelContent = label ? <span className="customize-control-title kmt-control-title">{label}</span> : null;

    return <>
        {labelContent}
        <div className="customize-control-content">
            <table className="wp-list-table widefat striped">
                <thead>
                    <tr>
                        <td>{__('Fonts', 'kemet-addons')}</td>
                        <td>{__('Variations', 'kemet-addons')}</td>
                    </tr>
                </thead>
                <tbody>
                    {data.kit.families.map(font => {
                        return <tr>
                            <td>{font.name}</td>
                            <td>{Object.keys(font.variations).map(key => {
                                const fontType = 'n' == font.variations[key][0] ? '' : 'italic'
                                const variation = font.variations[key][1] + '00' + fontType;
                                return variation;
                            }).join(", ")}</td>
                        </tr>
                    })}
                </tbody>
            </table>
        </div>
    </>
}

export default Table