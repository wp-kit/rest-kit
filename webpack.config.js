const webpack = require('webpack'),
	path = require('path'),
	clean = require('clean-webpack-plugin'),
	extract = require("extract-text-webpack-plugin"),
	manifest = require('webpack-manifest-plugin'),
	uglify = require('uglifyjs-webpack-plugin');

const themeFolder = './';

var appCss = new extract(`${themeFolder}/admin/css/app.[hash].css`);

module.exports = {
    entry: `${themeFolder}/resources/scripts/app.js`,
    output: {
        filename: `${themeFolder}/admin/js/app.[hash:6].js`,
        path: path.resolve(__dirname, './')
    },
    resolve: {
        modules: [
        	'./node_modules'
        ]
    },
    devtool: process.env.NODE_ENV == 'dev' || ! process.env.NODE_ENV ? '#source-map' : '',
    externals: {
    	jquery: 'jQuery',
    	react: 'React'
    },
    plugins: [
	    new webpack.ProvidePlugin({
            jQuery: "jquery",
            $: 'jquery'
        }),
	    new clean([
			`${themeFolder}/admin`
		]),
		appCss,
		new manifest({
			fileName: `${themeFolder}/manifest.json`,
			writeToFileEmit: true,
			map: (file) => {
				file.path = file.path.replace(`${themeFolder}/`, '')
				return file
			}
		})
	],
	optimization: {
		minimizer: [
			new uglify()
		]
	},
    module: {
	    rules: [
		    {
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
		        loader: 'babel-loader',
		        options: {
			      plugins: ["lodash", "@babel/plugin-transform-react-jsx"],
		          presets: ['@babel/preset-env'],
		        }
			},
			{
				test: /\.(scss)$/,
				loader: appCss.extract({
					fallback: 'style-loader',
	                use: [
						{
							loader: "css-loader", // translates CSS into CommonJS
							options: {
								minimize: true
							}
						},
						{
			            	loader: "postcss-loader",
			            	options: {
				            	plugins: () => [require('autoprefixer')({ browsers: ['last 3 versions', '> 1%'] })]
			            	}
		                },
						{
							loader: "sass-loader" // compiles Sass to CSS
						}
	                ],
	            })
			},
			{
				test: /\.(css)$/,
				loader: appCss.extract({
					fallback: 'style-loader',
	                use: [
						{
							loader: "css-loader", // translates CSS into CommonJS
							options: {
								minimize: true
							}
						}
	                ],
	            })
			},
			{
				test: /\.(png|jpg|svg|gif|eot|woff|ttf|otf)$/,
				loader: 'url-loader'
			}
	    ]
    }
}
