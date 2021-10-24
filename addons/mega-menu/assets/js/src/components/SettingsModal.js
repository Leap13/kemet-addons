import { useState, useEffect, useMemo } from '@wordpress/element';
import { __ } from "@wordpress/i18n";
import Options from './Options';
import SaveButton from './UI/SaveButton';
import Modal from './UI/Modal'
import OptionsContext from '../store/options-context';

const localSettings = {};

const SettingsModal = () => {
    const [isOpen, setOpen] = useState(false);
    const [isLoading, setIsLoading] = useState(false);
    const [initialValue, setInitialValue] = useState({});
    const [itemData, setItemData] = useState({
        itemId: null,
        title: null,
        depth: 0,
        values: null,
    })

    const loadItemSettings = async (itemId, title, depth) => {
        setInitialValue(null);
        if (localSettings[itemId]) {
            setItemData((prevValue) => ({
                ...prevValue,
                itemId,
                depth,
                title,
                values: localSettings[itemId]
            }))
            return
        }

        const body = new FormData()
        body.append('action', 'kemet_addons_menu_item_settings')
        body.append('item_id', itemId);
        body.append('nonce', kemetMegaMenu.ajax_nonce)
        const response = await fetch(kemetMegaMenu.ajax_url, {
            method: 'POST',
            body,
        })
        if (response.status === 200) {
            const { success, data } = await response.json()
            if (success) {
                setItemData({
                    itemId,
                    depth,
                    title,
                    values: data.values,
                })
                localSettings[itemId] = data.values;
            }
        }
    }
    const onCloseHandler = () => {
        setOpen(false);
    }
    useEffect(() => {
        document.addEventListener('KemetEditMenuItem', async function ({ detail: { itemId, title, depth } }) {
            await loadItemSettings(itemId, title, depth);
            setOpen(true);
        })
    }, [])

    const handleChange = (value, optionId) => {
        setInitialValue((prevValue) => ({
            ...prevValue,
            [optionId]: value
        }));
    }

    const onSaveHandler = async () => {
        localSettings[itemData.itemId] = { ...itemData.values, ...initialValue };
        setIsLoading(true);

        const body = new FormData()
        body.append('action', 'kemet_addons_menu_update_item_settings')
        body.append('item_id', itemData.itemId);
        body.append('data', JSON.stringify(initialValue));
        body.append('nonce', kemetMegaMenu.ajax_nonce)
        const response = await fetch(kemetMegaMenu.ajax_url, {
            method: 'POST',
            body,
        })
        if (response.status === 200) {
            const { success } = await response.json()
            if (success) {
                setIsLoading(false);
            }
        }
    }

    const contextValues = {
        itemId: itemData.itemId,
        onChange: handleChange,
        depth: itemData.depth,
        values: { ...itemData.values, ...initialValue }
    }
    return (
        <OptionsContext.Provider value={contextValues}>
            {isOpen && (
                <Modal className={`kmt-item-setting-modal menu-item-${itemData.itemId}`} title={itemData.title + ' - ' + __('Item Settings', 'kemet-addons')} onClose={onCloseHandler}>
                    {<Options options={kemetMegaMenu.options} />}
                    <div className='modal-actions'>
                        <SaveButton isLoading={isLoading} onClick={onSaveHandler} />
                    </div>
                </Modal>
            )}
        </OptionsContext.Provider>
    );
}

export default SettingsModal