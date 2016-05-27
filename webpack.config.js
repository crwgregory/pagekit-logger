
var path = require('path');

module.exports = [
  {
    entry: {
      "index": "./app/vue/entry/index.js",
      "settings": "./app/vue/entry/settings.js"
    },
    output: {
      path: path.join(__dirname, 'app/bundle'),
      publicPath: 'scripts/',
      filename: '[name].bundle.js',
      chunkFilename: '[id].bundle.js'
    },

    module: {
      loaders: [
        {test: /\.vue$/, loader: "vue"}
      ]
    }
  }
];