var webpack = require('webpack');
var ExtractPlugin = require('extract-text-webpack-plugin');
var BowerWebpackPlugin = require('bower-webpack-plugin');


module.exports = {
    entry:  './resources/assets/js/entrypoints',
    output: {
        path:     'public/assets/js',
        filename: 'bundle.js',
        publicPath: 'public/',
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name:      'main', // Move dependencies to our main file
            children:  true, // Look for common dependencies in all children,
            minChunks: 2, // How many times a dependency must come up before being extracted
        }),
        new webpack.ResolverPlugin(
            new webpack.ResolverPlugin.DirectoryDescriptionFilePlugin("bower.json", ["main"])
        ),
        new ExtractPlugin('bundle.css'),
        new BowerWebpackPlugin({
            excludes: /.*\.(scss)/
        }),
        new webpack.ProvidePlugin({
            $:      "jquery",
            jQuery: "jquery",
            'window.jQuery': 'jquery'
        }),
    ],
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel',
                query: {
                    presets: ['es2015']
                }
            },
            {
                test:   /\.(less)/,
                loader: ExtractPlugin.extract('style', 'css!less'),
            },
            {
                test:   /\.(css)/,
                loader: ExtractPlugin.extract('style', 'css'),
            },
            {
                test:   /\.html/,
                loader: 'html',
            },
            {
                test:   /\.(png|gif|jpe?g|svg)$/i,
                loader: 'url?limit=10000',
            },
            {
                test: /\.(woff|svg|ttf|eot)([\?]?.*)$/,
                loader: "file-loader?name=[name].[ext]"
            }
        ],
    }
};