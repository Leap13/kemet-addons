/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

import './style.scss';

/**
 * Internal dependencies
 */
import json from './block.json';
import edit from './edit';

const { name } = json;

registerBlockType(name, {
    apiVersion: 2,
    title: __('Kemet Breadcrumbs', 'wp-gb'),
    description: __('The description'),
    category: 'wp-gb',
    icon: 'smiley',
    edit,
});

