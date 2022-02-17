/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useEntityProp } from '@wordpress/core-data';
import {
    AlignmentControl,
    BlockControls,
    useBlockProps
} from '@wordpress/block-editor';

registerBlockType('kemet/breadcrumbs', {
    apiVersion: 2,
    title: __('Kemet Breadcrumbs', 'wp-gb'),
    description: __('The description'),
    category: 'wp-gb',
    icon: 'smiley',

    edit: ({ attributes, setAttributes, context: { postType, postId, queryId } }) => {
        const [fullTitle] = useEntityProp('postType', postType, 'link', postId);
        const { textAlign } = attributes;
        const blockProps = useBlockProps({
            className: classnames({
                [`has-text-align-${textAlign}`]: textAlign
            }),
        });

        return (
            <>
                <BlockControls group="block">
                    <AlignmentControl
                        value={textAlign}
                        onChange={(nextAlign) => {
                            setAttributes({ textAlign: nextAlign });
                        }}
                    />
                </BlockControls>
                <div {...blockProps}>
                    <a
                        href="#home-pseudo-link"
                        onClick={(event) => event.preventDefault()}
                    >
                        {__('Home')}
                    </a>
                    <span class="breadcrumb-sep" style={{ padding: '0 .4em' }}>»</span>
                    <a
                        href="#category-pseudo-link"
                        onClick={(event) => event.preventDefault()}
                    >
                        {__('Post Terms')}
                    </a>
                    <span class="breadcrumb-sep" style={{ padding: '0 .4em' }}>»</span>
                    <span>{fullTitle || __('Post Title')}</span>
                </div>
            </>
        )
    },
});
