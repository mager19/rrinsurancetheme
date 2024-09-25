// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

const plugin = require('tailwindcss/plugin');

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files trigger a rebuild.
		'./theme/**/*.php',
		'!./node_modules/**/*.{html,js,php}',
		'./theme/blocks/src/**/*.js',
		'./theme/blocks/build/**/*.js',
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			container: {
				center: true,
			},
			colors: {
				rrRed: '#fc1a12',
				gray: {
					500: '#f9f9f9',
					900: '#343837',
				}
			},
			fontFamily: {
				base: ["Work Sans", "system-ui"]
			},
			fontSize: {
				'display-1': ['91px', { lineHeight: '1.2', tracking: '-1.5px' }],
				'display-2': ['81px', { lineHeight: '1.2', tracking: '-1.5px' }],
				'title-1': ['58px', { lineHeight: '1.2' }],
				'title-2': ['48px', { lineHeight: '1.2' }],
				'title-3': ['38px', { lineHeight: '1.2' }],
				'title-4': ['28px', { lineHeight: '1.2' }],
				'title-5': ['22px', { lineHeight: '1.4' }],
				'title-6': ['18px', { lineHeight: '1.4', letterSpacing: '-0.5px' }],
				'base': ['16px', { lineHeight: '1.6' }],
			}
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		plugin(function ({ addComponents }) {
			addComponents({
				".container": {
					maxWidth: "100%",
					"@screen sm": {
						maxWidth: "540px",
					},
					"@screen md": {
						maxWidth: "720px",
					},
					"@screen lg": {
						maxWidth: "960px",
					},
					"@screen xl": {
						maxWidth: "1280px",
					},
				},
			});
		}),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
