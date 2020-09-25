const path = require('path'),
settings = require('./settings');

module.exports = {
  entry: {
    App: './wp-content/themes/fictional-university theme/js/scripts.js'
  },
  output: {
    path: path.resolve(__dirname, './wp-content/themes/fictional-university theme/js/'),
    filename: "scripts-bundled.js"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
  },
  mode: 'development'
}