import {
    createElement,
    Fragment,
    Component,
    useCallback,
    useRef,
    useEffect,
    useState,
} from '@wordpress/element'
import { registerPlugin, withPluginContext } from '@wordpress/plugins'
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post'
import { withSelect, withDispatch } from '@wordpress/data'
import { compose } from '@wordpress/compose'
import { IconButton, Button } from '@wordpress/components'
const { __ } = wp.i18n;

const kemetPageOptions = (props) => {
    console.log("From custom post type");
    return (
        <Fragment>

        </Fragment>
    )
}

const KemetOptionsComposed = compose(
    withSelect((select) => {
        console.log("From custom post type");
        const postMeta = select('core/editor').getEditedPostAttribute('meta');
        const oldPostMeta = select('core/editor').getCurrentPostAttribute('meta');
        return {
            meta: { ...oldPostMeta, ...postMeta },
            oldMeta: oldPostMeta,
            // options: KemetMetaData.options
        };
    }),
    withDispatch((dispatch) => ({
        onChange: (value, field) => dispatch('core/editor').editPost(
            { meta: { [field]: value } }
        ),
    })),
)(kemetPageOptions);

registerPlugin('kemet', {
    render: () => <KemetOptionsComposed name="kemet" />,
})