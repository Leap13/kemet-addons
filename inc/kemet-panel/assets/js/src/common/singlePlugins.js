import { useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import Card from "./Card";
const { Dashicon } = wp.components;
const SinglePlugin = ({ plugin, slug, status, handlePluginChange }) => {
    const [isLoading, setIsLoading] = useState(false)
    const doAction = async (action) => {
        if (!isLoading) {
            setIsLoading(true);
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
                    setIsLoading(false);
                }
            }
        } catch (e) {
            alert(e);
        }

        setIsLoading(false);
    }
    return <Card id={slug}>
        <div className='kmt-plugin-icon'>
            <img src={KemetPanelData.images_url + slug + '.png'} />
            {isLoading && (
                <Dashicon icon='update' />
            )}
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
    </Card>
}

export default SinglePlugin;