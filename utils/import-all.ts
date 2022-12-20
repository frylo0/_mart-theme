export default function importAll(r: __WebpackModuleApi.RequireContext) {
    const cache: {[key: string]: any} = {};

    r.keys().forEach((key) => (cache[key] = r(key)));
    
    return cache;
}