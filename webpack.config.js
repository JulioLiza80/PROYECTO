const Encore = require('@symfony/webpack-encore');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const WebpackObfuscator = require('webpack-obfuscator');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addEntry('paypal', './assets/js/paypal.js')
    .addEntry('bootstrap', './assets/js/bootstrap.js')
    .addStyleEntry('styles', './assets/styles/app.css') // add this line to load app.css
    .enablePostCssLoader() // make sure PostCSS loader is enabled
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel(() => {
        return {
            presets: [['@babel/preset-env', {
                modules: false,
                useBuiltIns: 'usage',
                corejs: '3.38',
            }]],
        };
    })
    .configureDevServerOptions(options => {
        options.port = 8080;
        options.hot = true;
        options.devMiddleware = {
            publicPath: '/build/',
        };
    })
    .addPlugin(new BrowserSyncPlugin({
        host: 'localhost',
        port: 3000,
        proxy: 'http://localhost:8000',
        files: [
            'templates/**/*.twig',
            'public/build/**/*.js',
            'public/build/**/*.css',
        ],
    }, {
        reload: false,
    }))
    .addPlugin(new WebpackObfuscator({}, ['excluded_bundle_name.js'])); // Exclude any files you don't want obfuscated

module.exports = Encore.getWebpackConfig();
