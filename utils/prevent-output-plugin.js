class PreventOutputPlugin {
    constructor() { }

    apply(compiler) {
        compiler.hooks.thisCompilation.tap('PreventOutputPlugin', compilation => {
            compilation.hooks.processAssets.tap(
                {
                    name: 'PreventOutputPluginInner',
                    stage: compilation.PROCESS_ASSETS_STAGE_PRE_PROCESS,
                },
                (assets) => {
                    Object.keys(assets).forEach((asset) => {
                        if (asset.match(/no-output$/)) {
                            delete assets[asset];
                        }
                    });
                }
            );
        });
    }
}

module.exports = PreventOutputPlugin;