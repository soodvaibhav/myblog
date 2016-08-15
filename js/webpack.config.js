module.exports = {
  entry: './admin/app.js',
  output: {
    path: __dirname + '/build',
    filename: 'bundle.js'
  },
  module: {
      loaders: [
          {
            test: /\.css$/,
            loader: "style-loader!css-loader"
          },
          {
            test: require.resolve("blueimp-file-upload"),
            loader: "imports?define=>false"
          },
          {
            test: require.resolve("medium-editor-insert-plugin"),
            loader: "imports?define=>false"
          }
      ]
  },
  resolve: {
      extensions: ['', '.js','.css']
  },
  devtool: "#inline-source-map"
};
