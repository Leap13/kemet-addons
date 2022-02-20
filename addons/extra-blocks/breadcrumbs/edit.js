/**
 * External dependencies
 */
import classnames from 'classnames';

/**
* WordPress dependencies
*/
import { useEntityProp, store as coreStore } from '@wordpress/core-data';
import {
    AlignmentControl,
    BlockControls,
    useBlockProps
} from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes, context: { postType, postId } }) {
    const [fullTitle] = useEntityProp('postType', postType, 'title', postId);
    const selectedTerm = useSelect(
        (select) => {
            const { getTaxonomy } = select(coreStore);
            const taxonomy = getTaxonomy('category');
            return taxonomy?.visibility?.publicly_queryable ? taxonomy : {};
        },
        ['category']
    );
    const templateType = useSelect((select) => {
        if (!select('core/edit-site')) {
            return;
        }
        const { getEditedPostType, getEditedPostId } = select('core/edit-site');
        const {
            getEditedEntityRecord,
        } = select(coreStore);
        const getEntityArgs = [
            'postType',
            getEditedPostType(),
            getEditedPostId(),
        ];
        const entityRecord = getEditedEntityRecord(...getEntityArgs);
        const type = entityRecord?.area || entityRecord?.slug;
        return type;
    }, []);
    const { postTerms, hasPostTerms } = usePostTerms({
        postId,
        postType,
        term: selectedTerm,
    });
    const categoryName = hasPostTerms ? postTerms[0].name : __('Post Category');
    const { textAlign } = attributes;
    const blockProps = useBlockProps({
        className: classnames({
            [`has-text-align-${textAlign}`]: textAlign
        }),
    });
    const type = templateType || postType;
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
                {(type === 'post' || type === 'single') && <>
                    <a
                        href="#category-pseudo-link"
                        onClick={(event) => event.preventDefault()}
                    >
                        {categoryName}
                    </a>
                    <span class="breadcrumb-sep" style={{ padding: '0 .4em' }}>»</span>
                </>}
                <span>{fullTitle || __('Post Title')}</span>
            </div>
        </>
    )
}

export function usePostTerms({ postId, postType, term }) {
    const { rest_base: restBase, slug } = term;
    const [termIds] = useEntityProp('postType', postType, restBase, postId);
    return useSelect(
        (select) => {
            const visible = term?.visibility?.publicly_queryable;
            if (!visible) {
                return {
                    postTerms: [],
                    _isLoading: false,
                    hasPostTerms: false,
                };
            }
            if (!termIds) {
                // Waiting for post terms to be fetched.
                return { isLoading: term?.postTerms?.includes(postType) };
            }
            if (!termIds.length) {
                return { isLoading: false };
            }
            const { getEntityRecords, isResolving } = select(coreStore);
            const taxonomyArgs = [
                'taxonomy',
                slug,
                {
                    include: termIds,
                    context: 'view',
                },
            ];
            const terms = getEntityRecords(...taxonomyArgs);
            const _isLoading = isResolving('getEntityRecords', taxonomyArgs);
            return {
                postTerms: terms,
                isLoading: _isLoading,
                hasPostTerms: !!terms?.length,
            };
        },
        [termIds, term?.visibility?.publicly_queryable]
    );
}
