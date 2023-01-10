const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin')


module.exports = {
    entry: './index.js',
    mode: "development",
    output: {
      path:path.resolve(__dirname, 'bin'),
      filename: 'bundle.js'
    },
    plugins: [
        new HtmlWebpackPlugin({  
            filename: 'index.html',
            template: './index.html'
        })
    ]
  }