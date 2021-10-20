const { __ } = wp.i18n;
const { Dashicon } = wp.components;

const SaveButton = ({ isLoading, onClick }) => {
    const btnClasses = `kmt-button ${isLoading ? 'secondary' : 'primary'}`;
    return <button className={btnClasses} onClick={() => {
        onClick()
    }} disabled={isLoading}>{isLoading ? <Dashicon icon='update' /> : __('Save Settings', 'kemet-addons')}</button>
}

export default SaveButton