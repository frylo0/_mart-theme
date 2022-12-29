/**
 * @type {import('eslint').Linter.Config}
 */
module.exports = {
	'env': {
		'browser': true,
		'es2021': true,
	},
	'extends': [
		'eslint:recommended',
		'plugin:@typescript-eslint/recommended',
		'plugin:prettier/recommended',
	],
	'overrides': [],
	'parser': '@typescript-eslint/parser',
	'parserOptions': {
		'ecmaVersion': 'latest',
		'sourceType': 'module',
	},
	'plugins': [
		'@typescript-eslint',
	],
	'ignorePatterns': [
		'utils',
		'postcss.config.js',
		'.eslintrc.js',
		'webpack.config.mjs',
		'webpack.reload.mjs',
		'lint-staged.config.js',
		'env',
	],
	'rules': {
		'prettier/prettier': 'error',
	}
};
