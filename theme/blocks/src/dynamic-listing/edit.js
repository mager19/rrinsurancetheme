/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls, RichText, MediaPlaceholder, useInnerBlocksProps } from '@wordpress/block-editor';

import { PanelBody, SelectControl, RangeControl, ToggleControl, PanelRow, Button } from '@wordpress/components';


import { useSelect } from '@wordpress/data';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(props) {

	const { attributes, setAttributes } = props;

	const { selectedPostType, postsToShow, showHeader, headerText, showCta } = attributes;

	const onChangePostsToShow = (newPostsToShow) => {
		setAttributes({ postsToShow: newPostsToShow });
	};

	const _postTypes = useSelect((select) => {
		const query = select('core').getEntitiesByKind('postType');
		const items = query ?? [];

		const data = items.filter(
			(element) => 'product' == element.name || 'post' == element.name
		);

		return data.map((element) => ({
			value: element.name,
			label: element.label,
		}));

	});

	const blockProps = useBlockProps({
		className: 'p-4',
		style: {
			border: '2px solid red',
			color: '#000'
		},
	});

	const innerBlocksProps = useInnerBlocksProps({
	}, {
		template: [
			[
				"core/button",
			]
		],
		templateLock: true
	});

	/**
	 * Set attribute on select image
	 */
	const onSelectImage = (image) => {
		return props.setAttributes({
			image: {
				id: image.id,
				url: image.url,
				alt: image.alt
			}
		});
	};

	/**
	 * Set attribute on remove image
	 */
	const onRemoveImage = () => {
		return props.setAttributes({
			image: {
				id: '',
				url: '',
				alt: ''
			}
		});
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Dynamic Listing Settings')} initialOpen="true">
					<SelectControl
						label={__('Post Type:')}
						value={selectedPostType}
						onChange={(selectedPostType) => {
							setAttributes({ selectedPostType });
						}}
						options={[{ label: 'Select post type', value: '' }].concat(_postTypes)}
					/>

					<RangeControl
						label={__('Number of Posts to Show', 'text-domain')}
						value={postsToShow}
						onChange={onChangePostsToShow}
						min={1}
						max={10}
					/>

					<ToggleControl
						label={__('Show Header')}
						checked={showHeader}
						onChange={(showHeader) => setAttributes({ showHeader })}
					/>

					<ToggleControl
						label={__('Show Cta')}
						checked={showCta}
						onChange={(showCta) => setAttributes({ showCta })}
					/>
				</PanelBody>
			</InspectorControls>


			<div {...blockProps}>
				{showHeader &&
					<>
						<RichText
							className='mt-0 text-4xl text-black'
							tagName="h3"
							value={headerText}
							onChange={(headerText) => setAttributes({ headerText })}
							placeholder="Your title here"
						/>
					</>
				}

				<div className="opacity-75">
					Post: {selectedPostType}
					<br />
					Posts to show: {postsToShow}
				</div>
			</div>
		</>
	);
}
