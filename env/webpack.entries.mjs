import glob from 'glob';
import { basename } from 'path';
import { getOutputFilename } from './webpack.lib.mjs';

/**
 * @type {{
 *   [key: string]: {
 *     entry: string,
 *     output: {
 *       js?: string,
 *       css?: string,
 *       php?: (fileNameNoExt: string) => string,
 *     }
 *   }
 * }}
 */
export const entries = Object.fromEntries([].concat(
    glob.sync('./src/pages/*/*.ts').map(filePath => {
        const pageName = basename(filePath).replace(/\.ts$/, '');
        
        return [`page-${pageName}`, {
            entry: filePath,
            output: {
                js: getOutputFilename(filePath, './js', '.js'),
                css: getOutputFilename(filePath, './css', '.css'),
                php: () => getOutputFilename(filePath, '', '.php'),
            },
        }];
    }),
    glob.sync('./src/raw-loader.ts').map(filePath => {
        return ['raw', {
            entry: filePath,
            output: {
                js: './raw/no-output',
                php: (fileNameNoExt) => `${fileNameNoExt}.php`,
            },
        }];
    }),
    glob.sync('./src/assets-loader.ts').map(filePath => {
        return ['asset', {
            entry: filePath,
            output: {
                js: './assets/no-output',
            },
        }];
    }),
    glob.sync('./src/components/common/entry.ts').map(filePath => {
        return ['common', {
            entry: filePath,
            output: {
                js: getOutputFilename(filePath, './components/common', '.js'),
                css: getOutputFilename(filePath, './components/common', '.css'),
            },
        }];
    }),
));