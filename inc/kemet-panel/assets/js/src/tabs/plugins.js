import { useState, useEffect, Fragment } from "@wordpress/element";
import SinglePlugin from '../common/singlePlugins'
import { Transition, animated } from "react-spring/renderprops"
import { __ } from "@wordpress/i18n";
let pluginsCache = null;

const Plugins = () => {
    const plugins = KemetPanelData.plugins_data;
    const [pluginsStatus, setPluginStatus] = useState(pluginsCache || []);
    const [isLoading, setLoading] = useState(!pluginsCache)
    const updatePluginsStatus = async (enableLoader = false) => {
        if (enableLoader) {
            setLoading(true)
        }
        const body = new FormData()
        body.append('action', 'kemet-plugins-status')
        body.append('nonce', KemetPanelData.nonce)

        try {
            const response = await fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body,
            })

            if (response.status === 200) {
                const { success, data } = await response.json()
                if (success) {
                    setPluginStatus(data)
                    pluginsCache = data
                }
            }
        } catch (e) {
            alert(e);
        }
        setLoading(false)
    }

    useEffect(() => {
        updatePluginsStatus(!pluginsCache)
    }, [])

    return (
        <div>
            <Transition
                items={isLoading}
                from={{ opacity: 0 }}
                enter={[{ opacity: 1 }]}
                leave={[{ opacity: 0 }]}
                initial={null}
                config={(key, phase) => {
                    return phase === 'leave'
                        ? {
                            duration: 300,
                        }
                        : {
                            delay: 300,
                            duration: 300,
                        }
                }}>
                {(isLoading) => {
                    if (isLoading) {
                        return (props) => (
                            <animated.p
                                style={props}
                                className="kmt-loading-text">
                                <span />
                                {__('Loading Plugins Status...', 'kemet-addons')}
                            </animated.p>
                        )
                    }

                    return (props) => (
                        <animated.div style={props}>
                            {Object.keys(plugins).length > 0 && (
                                <Fragment>
                                    <ul className="kmt-plugins-list">
                                        {Object.keys(plugins).map((plugin) => {
                                            return <SinglePlugin plugin={plugins[plugin]} slug={plugin} status={pluginsStatus[plugin]} handlePluginChange={() => {
                                                updatePluginsStatus()
                                            }} />
                                        })}
                                    </ul>
                                </Fragment>
                            )}
                        </animated.div>
                    )
                }}
            </Transition>
        </div>
    )

}

export default Plugins;