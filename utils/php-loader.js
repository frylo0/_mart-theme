const { basename } = require("path");
const fs = require('fs');
const path = require('path');

const tsconfig = JSON.parse(fs.readFileSync(path.resolve(__dirname, './../tsconfig.json')).toString().replace(/\/\*.*?\*\//g, '').replace(/\/\/.*/g, ''));
const baseUrl = tsconfig.compilerOptions.baseUrl;
const distBaseUrl = (fileName, isPage) => {
	if (isPage) {
		return '';
	} else {
		const dirName = path.dirname(fileName);
		const distBase = path.resolve(__dirname, '..', baseUrl);
		const relDistBase = path.relative(dirName, distBase);
		
		return relDistBase;
	}
};


function aliases(content) {
	content = content.replace(/<\?php(.|\n)+?\?>/g, (phpBlock) => {
		return phpBlock
			.replace(/'~assets/g, `URL_ROOT . '/assets`)
			.replace(/~assets/g, `$URL_ROOT/assets`);
	});
	
	content = content
		.replace(/~assets/g, `<?= URL_ROOT ?>/assets`);
	
	return content;
}


function imports(content) {
	let prependsString = '';

	const fileName = this.resource;
	const hash = (new Date().toLocaleDateString('en-uk', {
		day: '2-digit', month: '2-digit', year: '2-digit',
		hour: '2-digit', minute: '2-digit', second: '2-digit'
	})).replace(/[ ,\/]/g, '-');
	
	const isPage = /[\\\/]pages[\\\/].*?[\\\/].*?\.php$/.test(fileName);

	// if page
	if (isPage) {
		const pageName = basename(fileName).replace(/\.php$/, '');

		prependsString += [
			`insert_to_page([`,
			`	'head' => [ 'styles' => [`,
			`		'/components/common/entry.css',`,
			`		'/css/${pageName}.css',`,
			`	]],`,
			`	'body' => [ 'scripts' => [`,
			`		'/components/common/entry.js',`,
			`		'/js/${pageName}.js',`,
			`	]],`,
			`], '${hash}');`,
		].map(str => str + '\n').join('');
	}

	const bundleFile = fileName.replace(/\.php$/, '.ts');
	
	// Exit if no bundle script file provided
	if (!fs.existsSync(bundleFile)) {
		return content;
	}

	const bundleContent = fs.readFileSync(bundleFile).toString();
	const bundleImports = bundleContent.match(/^import\s+.*?$/gm)
		.filter(importString => { // filter invalid imports
			const isImportFrom = /^import\s+?.*?\s+?from/.test(importString);
			return !isImportFrom;
		});

	const requirements = [];

	if (isPage) {
		requirements.push(`components/common/entry.php`);
	}

	for (const importString of bundleImports) {
		const quote = importString.match(/import\s+(['"])/)[1];
		const endsWithExt = new RegExp(String.raw`\.\w+?${quote};?`).test(importString);
		const endsWithPhp = new RegExp(String.raw`\.php${quote};?`).test(importString);

		let importPath = importString
			.replace(/^import\s+/, '')
			.replace(new RegExp('^' + quote), '')
			.replace(new RegExp(quote + ';.*$'), '');
		
		const allowed = /^(components|pages|\.|\.\.)\//.test(importPath);

		if (!endsWithExt && allowed) { // if is imported ts file - possible dependency
			if (/^\w/.test(importPath)) { // if starts with letter, not relative import
				importPath = path.join(distBaseUrl(fileName, isPage), importPath);
			}

			importPath += '.php';
			requirements.push(importPath);
		}
		else if (endsWithPhp) { // if import of php file
			if (/^\w/.test(importPath)) { // if starts with letter, not relative import
				importPath = path.join(distBaseUrl(fileName, isPage), importPath);
				requirements.push(importPath);
			}
		}
	}

	if (requirements.length > 0) {
		let requirementsString = '';

		for (const importPath of requirements)
			requirementsString += `require_once __DIR__ . '/${importPath}';\n`;
		
		if (prependsString !== '') { // if there are some imports before
			requirementsString += '\n';
			prependsString = requirementsString + prependsString;
		} else { // if only requirements
			prependsString = requirementsString;
		}
	}

	if (prependsString !== '') {
		content = '<?php\n' + prependsString + '?>\n\n' + content;
	}

	return content;
}


module.exports = function (content) {
	content = aliases.bind(this)(content);
	content = imports.bind(this)(content);
	
	return content;
};
