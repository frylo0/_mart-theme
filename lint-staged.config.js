module.exports = {
	'**/*.(ts)': (filenames) => [
		// Check TS files for no errors
		'yarn tsc --noEmit',

		// Lint and format TS and JS files
		`yarn eslint --fix ${filenames.join(' ')}`,
		`yarn prettier --write ${filenames.join(' ')}`,
	],
};
