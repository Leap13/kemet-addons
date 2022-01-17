const { __ } = wp.i18n;

const SelectTemplate = ({ posts, onChange, value }) => {
    return <select className='kmt-select-input' value={value}
        onChange={() => {
            onChange(event.target.value);
        }}>
        <option value=''>{__('Select a Template', 'kemet-addons')}</option>
        {Object.keys(posts).map(postKey => {
            return <option value={postKey}>{posts[postKey]}</option>
        })}
    </select>
}

export default SelectTemplate