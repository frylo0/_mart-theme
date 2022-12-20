import path, { basename, join } from 'path';

export function dotted(pathString) {
    return '.' + path.sep + pathString;
}

export function getOutputFilename(filePath, targetFolderInDist, ext) {
    const outputFilename = basename(filePath).replace(/\.(ts|php|scss|sass)$/, ext);
    return dotted(join(targetFolderInDist, outputFilename));
}

export function mapObjectValues(obj, mapper) {
    const res = { ...obj };

    for (const prop in obj)
        res[prop] = mapper(obj[prop]);
    
    return res;
}

export function RegExpEscape(string) {
    return string.replace(/[/\-\\^$*+?.()|[\]{}]/g, '\\$&');
}
