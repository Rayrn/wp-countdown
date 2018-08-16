const webpack = require('webpack');
const path = require('path');

// Variables
const isProduction = process.argv.indexOf('-p') >= 0 || process.env.NODE_ENV === 'production';
const sourcePath = path.join(__dirname, './assets');
const outPath = path.join(__dirname, './dist');

// Plugins
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    context: sourcePath,
    entry: {
        js: ['./js/wp-countdown.ts']
    },
    output: {
        path: outPath,
        filename: 'js/wp-countdown.js',
        publicPath: '/'
    },
    target: 'web',
    resolve: {
        extensions: ['.ts', '.js'],
        mainFields: ['module', 'browser', 'main'],
        alias: {
            js: path.resolve(__dirname, './assets/js')
        }
    },
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new ForkTsCheckerWebpackPlugin({
            tsconfig: path.resolve(__dirname, './assets/tsconfig.json'),
            tslint: path.resolve(__dirname, './assets/tslint.json')
        }),
        new MiniCssExtractPlugin({
            filename: 'css/wp-countdown.css'
        })
    ],
    node: {
        fs: 'empty',
        net: 'empty'
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                loader: 'ts-loader',
                options: {
                    configFile: path.resolve(__dirname, './assets/tsconfig.json'),
                    transpileOnly: true,
                    experimentalWatchApi: true
                },
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: 'css-loader',
                        query: {
                            modules: false,
                            sourceMap: !isProduction
                        }
                    }
                ],
            },
            {
                test: /\.(sc|sa)ss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: 'css-loader',
                        query: {
                            modules: true,
                            sourceMap: !isProduction,
                            importLoaders: 1
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            ident: 'postcss',
                            plugins: [
                                require('postcss-import')({ addDependecyTo: webpack }),
                                require('postcss-url')(),
                                require('postcss-preset-env')(),
                                require('postcss-reporter')(),
                                require('postcss-browser-reporter')({ disabled: isProduction })
                            ]
                        }
                    },
                    {
                        loader: 'resolve-url-loader',
                        options: {
                            sourceMap: !isProduction
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: !isProduction
                        }
                    }
                ]
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/,
                loader: 'image-webpack-loader',
                enforce: 'pre'
            },
            {
                test: /\.(jpe?g|png|gif)$/,
                loader: 'url-loader',
                options: {
                    limit: 10000
                }
            },
            {
                test: /\.svg$/,
                loader: 'svg-url-loader',
                options: {
                    limit: 10000,
                    noquotes: true
                }
            }
        ]
    }
};
