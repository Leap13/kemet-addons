const { __ } = wp.i18n;

const SaveButton = ({ isLoading, onClick }) => {

    return <button className={`kmt-button primary`} onClick={() => {
        onClick()
    }} disabled={isLoading}>{__('Save Settings', 'kemet-addons')}</button>
}

export default SaveButton