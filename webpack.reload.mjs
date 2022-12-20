import { join } from 'path';
import chokdair from 'chokidar';
import c from 'chalk';
import * as url from 'url';
import { sync as touchSync } from 'touch';

const __filename = url.fileURLToPath(import.meta.url);
const __dirname = url.fileURLToPath(new URL('.', import.meta.url));

/**
 * @type {{
 *   folderToWatch: string;
 *   touch: string;
 * }}
 */
const config = [
    {
        folderToWatch: './src/raw',
        touch: './src/raw-loader.ts',
    },
    {
        folderToWatch: './src/assets',
        touch: './src/assets-loader.ts',
    },
    {
        folderToWatch: './src/components/common',
        touch: './src/components/common/entry.ts',
    },
];

const watcher = chokdair.watch([], { persistent: true });

for (let { folderToWatch } of config) {
    folderToWatch = join(__dirname, folderToWatch);
    
    watcher.add(folderToWatch);
}

watcher.on('all', (event, filepath) => {
    for (const { folderToWatch, touch } of config) {
        let folderToWatchAbs = join(__dirname, folderToWatch);
        
        if (filepath.startsWith(folderToWatchAbs)) {
            const touchAbs = join(__dirname, touch);
            const filename = filepath.replace(folderToWatchAbs, folderToWatch);
            
            console.log(`${c.bold(event.toUpperCase())} ${filename}` + c.grey(` - Touching '${touch}'`));
            touchSync(touchAbs);
            
            break;
        }
    }
});