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
import { useBlockProps, RichText } from '@wordpress/block-editor';

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

	const { title, subtitle } = attributes;

	const blockProps = useBlockProps({
		className: 'ourTeam bg-gray-900 py-5 px-4 text-gray-500 dark--mode',
	});


	return (
		<div {...blockProps}>
			<h3 classname="mt-10">Team Members block</h3>
			<RichText
				tagName="h2"
				value={title}
				onChange={(value) => setAttributes({ title: value })}
				placeholder={__('Title Block', 'team-members')}
				keepPlaceholderOnFocus
			/>

			<RichText
				tagName="p"
				value={subtitle}
				onChange={(value) => setAttributes({ subtitle: value })}
				placeholder={__('Subtitle block', 'team-members')}
				keepPlaceholderOnFocus
			/>

			<span {...useBlockProps()}>
				{__('The members are shown from the cpt members, they are only shown in frontend, if you want to remove or add any of them go to CPT Members.', 'team-members')}
			</span>
		</div>

	);
}
