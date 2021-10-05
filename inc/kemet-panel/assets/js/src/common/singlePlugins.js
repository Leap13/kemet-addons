import { useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

const SinglePlugin = ({ plugin, slug, status, handlePluginChange }) => {
    const [loader, setLoader] = useState(false)
    const doAction = async (action) => {
        if (!loader) {
            setLoader(true);
        }
        const body = new FormData()
        body.append('action', action)
        body.append('nonce', KemetPanelData.plugin_manager_nonce)
        body.append('path', plugin.path)
        body.append('slug', slug)

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
            alert(e);
        }

        setLoader(false);
    }
    return <li className='kmt-plugin-card'>
        <div className='kmt-plugin-icon'>
            <img src={KemetPanelData.images_url + slug + '.png'} />
            {loader && <div className="kmt-loader">{__('Loading', 'kemet-addons')}</div>}
        </div>
        <div className='kmt-plugin-data'>
            <h4 className="kmt-plugin-title">{plugin.name}</h4>
            {plugin.description && (
                <div className="kmt-plugin-description" dangerouslySetInnerHTML={{
                    __html: plugin.description
                }}>
                </div>
            )}
        </div>
        <div className="plugin-action">
            {status === 'deactivate' && (
                <a
                    onClick={() => doAction('kemet-deactivate-plugin')}
                    className="kmt-button secondary">
                    {__('Deactivate', 'kemet-addons')}
                </a>
            )}

            {status === 'activate' && (
                <a
                    onClick={() => doAction('kemet-activate-plugin')}
                    className="kmt-button primary">
                    {__('Activate', 'kemet-addons')}
                </a>
            )}

            {status === 'install' &&
                <a
                    onClick={() => doAction('kemet-install-plugin')}
                    className="kmt-button primary">
                    {__('Install', 'kemet-addons')}
                </a>
            }
        </div>
    </li>
}

export default SinglePlugin;