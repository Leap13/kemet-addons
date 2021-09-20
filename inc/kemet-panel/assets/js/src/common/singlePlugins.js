import { useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

const SinglePlugin = ({ plugin, status, handlePluginChange }) => {
    const [loader, setLoader] = useState(false)
    const doAction = async (action) => {
        if (!loader) {
            setLoader(true);
        }
        const body = new FormData()
        body.append('action', action)
        body.append('nonce', KemetPanelData.nonce)
        body.append('path', plugin.path)

        try {
            const response = await fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body,
            })

            if (response.status === 200) {
                const { success } = await response.json()

                if (success) {
                    handlePluginChange();
                    setLoader(false);
                }
            }
        } catch (e) {
            console.log(e);
        }
    }
    return <li>
        <h4 className="plugin-title">{plugin.name}</h4>
        {plugin.description && (
            <div className="kmt-plugin-description" dangerouslySetInnerHTML={{
                __html: plugin.description
            }}>
            </div>
        )}
        <div className="plugin-action">
            {status === 'deactivate' && (
                <a
                    onClick={() => doAction('kemet-deactivate-plugin')}
                    className="kmt-button">
                    {__('Deactivate', 'kemet-addons')}
                </a>
            )}

            {status === 'activate' && (
                <a
                    onClick={() => doAction('kemet-activate-plugin')}
                    className="kmt-button-primary">
                    {__('Activate', 'kemet-addons')}
                </a>
            )}

            {status === 'install' &&
                <a
                    // onClick={}
                    className="kmt-button">
                    {__('Install', 'kemet-addons')}
                </a>
            }
        </div>
    </li>
}

export default SinglePlugin;