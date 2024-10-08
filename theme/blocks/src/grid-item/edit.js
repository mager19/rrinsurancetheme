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
import { useBlockProps, useInnerBlocksProps, RichText } from '@wordpress/block-editor';

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

	const { title, content } = attributes;

	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: 'w-full grid__item',
		},
		{
			template: [
				["core/image", { className: "w-full" }],

			],
			templateLock: true,
			allowedBlocks: ["core/image"],
		}
	);

	return (
		<>
			<div {...blockProps}>
				<div className="container mx-auto">
					<div {...innerBlocksProps} />
					<RichText
						tagName="h3"
						value={title}
						onChange={(title) => setAttributes({ title })}
						placeholder={__('Add Service Item', 'rrinsurance')}
						className="mt-4 text-2xl font-bold"
					/>
					<RichText
						tagName="p"
						value={content}
						onChange={(content) => setAttributes({ content })}
						placeholder={__('Add Content', 'rrinsurance')}
						className="mt-2"
					/>
				</div>
			</div>
		</>
	);
}
