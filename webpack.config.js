const autoprefixer = require( 'autoprefixer' );

module.exports = [{
	entry: [
		'./assets/src/css/index.scss',
		'./assets/src/js/index.js'
	],
	output: {
		path: `${__dirname}/assets/dist`,
		filename: 'bundle.js'
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: 'material-theme.css',
							outputPath: 'css',
						},
					},
					{
						loader: 'extract-loader'
					},
					{
						loader: 'css-loader'
					},
					{
						loader: 'postcss-loader',
						options: {
							plugins: () => [autoprefixer()]
						}
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require( 'sass' ),
							sassOptions: {
								includePaths: ['./node_modules']
							},
						},
					},
				]
			},
			{
				test: /\.js$/,
				loader: 'babel-loader',
				query: {
					presets: ['@babel/preset-env']
				},
			}
		]
	},
}];