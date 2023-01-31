import path, { join } from 'path';
import * as url from 'url';

import { dotted, mapObjectValues, RegExpEscape } from './env/webpack.lib.mjs';

const __filename = url.fileURLToPath(import.meta.url);
const __dirname = url.fileURLToPath(new URL('.', import.meta.url));
const __srcFolder = join(__dirname, 'src');

import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import TsconfigPathsPlugin from 'tsconfig-paths-webpack-plugin';
import PreventOutputPlugin from './utils/prevent-output-plugin.js';

import { entries } from './env/webpack.entries.mjs';


/** @returns {import('webpack').Configuration} */
const config = ({ isDevelopment, isProduction, isMode }) => ({
    entry: mapObjectValues(entries, (value) => value.entry),
    
    output: {
        filename: (pathData) => {
            /** @type string */
            const entryName = pathData.chunk.name;
            return entries[entryName].output.js;
        },
        clean: true, // Clean dist folder every build
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: (pathData) => {
                /** @type string */
                const entryName = pathData.chunk.name;
                return entries[entryName].output.css;
            },
        }),
        new PreventOutputPlugin(),
    ],
    
    resolve: {
        extensions: ['.ts', '.js'],
        alias: {
            '~assets': path.resolve(__dirname, 'src/assets/'),
            '/assets': path.resolve(__dirname, 'src/assets/'),
            '/styles': path.resolve(__dirname, 'src/styles/'),
        },
        plugins: [
            new TsconfigPathsPlugin({ silent: true }), // Allow WebPack to know about paths defined in tsconfig
        ],
    },

    module: {
        rules: [
            {
                test: /\.ts$/,
                exclude: /node_modules/,
                use: [
                    'ts-loader',
                ],
            },
            {
                test: /\.(ts|js|scss|sass)$/,
                use: 'glob-import-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.php$/,
                exclude: /node_modules/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        /**
                         * @param {string} filePath 
                         * @param {string} fileQuery 
                         */
                        name: (filePath) => {
                            // Remove abs src folder path
                            filePath = filePath
                                .replace(__srcFolder, '')
                                .replace(/^[\/\\]/, '');

                            let entryName;
                            
                            const fileNameNoExt = filePath.match(/[\\\/]([^\\\/]+)\.php$/)[1];
                            
                            if (filePath.startsWith('pages')) {
                                entryName = `page-${fileNameNoExt}`;
                            }
                            else if (filePath.startsWith('raw')) {
                                entryName = `raw`;
                            }
                            
                            const outputPath = entries[entryName]?.output?.php(fileNameNoExt);
                            const finalPath = outputPath || filePath;

                            return finalPath;
                        },
                    },
                }, {
                    loader: path.resolve('./utils/php-loader.js'),
                }],
            },
            {
                test: /\.(scss|sass)$/,
                exclude: /node_modules/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader',
                    'sass-loader',
                ],
            },
            {
                // anything in assets folder
                test: new RegExp(RegExpEscape(join(__srcFolder, 'assets') + path.sep)),
                exclude: /node_modules/,
				type: 'asset/resource', // assets are handled by webpack, check output.assetModuleFilename
				generator: {
					filename: (pathData) => { // defines where to store assets
						return pathData.filename.replace(/^src[\\\/]/, '') + '?hash=[hash]';
					},
				},
            },
        ],
    },
    
    devtool: isDevelopment && 'source-map',
});


export default function (env, argv) {
    const isMode = (mode) => env.NODE_ENV === mode || argv.mode === mode;
    
    const isDevelopment = isMode('development');
    const isProduction = isMode('production');
    
    return config({ isDevelopment, isProduction, isMode });
};
