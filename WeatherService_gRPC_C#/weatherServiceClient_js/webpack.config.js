const path = require('path');

module.exports = {
  entry: './src/client.js',
  output: {
    filename: 'client.js',
    path: path.resolve(__dirname, 'dist'),
    library: 'client',
    libraryTarget: 'umd',
    umdNamedDefine: true,
    globalObject: 'this',
  },
  mode: 'production',
  resolve: {
    extensions: ['.js'],
  },
};