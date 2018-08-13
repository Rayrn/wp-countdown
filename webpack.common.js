const webpack = require('webpack');
const path = require('path');

// Variables
const isProduction = process.argv.indexOf('-p') >= 0 || process.env.NODE_ENV === 'production';
const sourcePath = path.join(__dirname, './src');
const outPath = path.join(__dirname, './dist');

// Plugins
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    context: sourcePath,
    entry: {
        app: ['./app/app.tsx', 'webpack-hot-middleware/client'],
        vendor: ['react', 'react-dom']
    },
    output: {
        path: outPath,
        filename: 'bundle.js',
        chunkFilename: '[chunkhash].js',
        publicPath: '/'
    },
    target: 'web',
    resolve: {
        extensions: ['.tsx', '.ts', '.js'],
        mainFields: ['module', 'browser', 'main'],
        alias: {
            app: path.resolve(__dirname, './src/app')
        }
    },
    devServer: {
        contentBase: sourcePath,
        hot: true,
        inline: true,
        historyApiFallback: {
            disableDotRule: true
        },
        stats: 'minimal',
        clientLogLevel: 'warning'
    },
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new ForkTsCheckerWebpackPlugin({
            tsconfig: path.resolve(__dirname, './src/tsconfig.json'),
            tslint: path.resolve(__dirname, './src/tslint.json')
        }),
        new HtmlWebpackPlugin({
            title: 'Zen Aero Site [Web]',
            template: path.resolve(__dirname, './src/assets/index.html')
        }),
        new webpack.HotModuleReplacementPlugin(),
        new MiniCssExtractPlugin({
            filename: '[contenthash].css',
            disable: !isProduction
        })
    ],
    node: {
        fs: 'empty',
        net: 'empty'
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: [
                    !isProduction && {
                        loader: 'babel-loader',
                        options: { plugins: ['react-hot-loader/babel'] }
                    },
                    {
                        loader: 'ts-loader',
                        options: {
                            configFile: path.resolve(__dirname, './src/tsconfig.json'),
                            transpileOnly: true,
                            experimentalWatchApi: true
                        }
                    }
                ].filter(Boolean),
                exclude: /node_modules/
            },
            {
                test: /\.scss$/,
                use: [
                    isProduction ? MiniCssExtractPlugin : 'style-loader',
                    {
                        loader: 'css-loader',
                        query: {
                            modules: true,
                            sourceMap: !isProduction,
                            importLoaders: 1,
                            localIdentName: isProduction ? '[hash:base64:5]' : '[local]__[hash:base64:5]'
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
