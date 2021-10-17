import { Button, Modal } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import { __ } from "@wordpress/i18n";

const localSettings = {};

const SettingsModal = () => {
    const [isLoading, setIsLoading] = useState(false);
    const [isOpen, setOpen] = useState(false);
    const closeModal = () => setOpen(false);
    const [itemData, setItemData] = useState({
        itemId: null,
        depth: 0,
        values: null,
    })

    const loadItemSettings = async (itemId, depth) => {

        if (localSettings[itemId]) {
            setItemData({
                itemId,
                depth,
                values: localSettings[itemId]
            })
            return
        }
        setIsLoading(true);
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
                    values: data.values
                })
                localSettings[itemId] = data.values
            }
        }
        setIsLoading(false);
    }

    useEffect(() => {
        document.addEventListener('KemetEditMenuItem', function ({ detail: { itemId, depth } }) {
            setOpen(true);
            loadItemSettings(itemId, depth);
        })
    }, [])

    return (
        <>
            {isLoading && "Loading..."}
            {!isLoading && isOpen && (
                <Modal title={__('Menu Item Settings', 'kemet-addons')} onRequestClose={closeModal}>
                    <Button variant="secondary" onClick={closeModal}></Button>
                </Modal>
            )}
        </>
    );
}

export default SettingsModal