import { useContext } from "@wordpress/element"
import OptionsContext from "../store/options-context"
const { __ } = wp.i18n;
const { Dashicon } = wp.components;

const ModalActions = () => {
    const { onSave, isLoading, onClose } = useContext(OptionsContext);
    const btnClasses = `kmt-button ${isLoading ? 'secondary' : 'primary'}`;
    return <div className='modal-actions'>
        <button className='kmt-button secondary' onClick={onClose}>{__('Close', 'kemet-addons')}</button>
        <button className={btnClasses} onClick={onSave} disabled={isLoading}>{isLoading ? <Dashicon icon='update' /> : __('Save Settings', 'kemet-addons')}</button>
    </div>
}

export default ModalActions