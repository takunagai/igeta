// TODO: Promise等をブラウザに適用するにはポリフィル導入 https://ics.media/entry/16028

const webpack = require('webpack');
const path = require('path');

module.exports = {
  mode: 'development',
  watch: true, // 対象ファイルを監視、変更があれば Webpack を実行 (実行コマンドに --watch 付けるのと同等)
  entry: {
    common: './src/js/common.js',
    // unique: './src/js/unique.js',
  },
  optimization: { // 複数のファイルで使う同じモジュールを別に vender.bundle.js に書き出す https://qiita.com/soarflat/items/1b5aa7163c087a91877d
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /node_modules/,
          name: 'vendor',
          chunks: 'initial',
        }
      }
    }
  },
  output: {
    path: path.resolve(__dirname + '/..') + '/js',
    // path: path.resolve(__dirname + '/..') + '/wordpress/wp/wp-content/themes/understrap-child/js',
    filename: '[name].bundle.js', // -> vendor.bundle.js, common.bundle.js, unique.bundle.js
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "eslint-loader", // 構文チェッカー。 .eslintrc に設定
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'babel-loader', // ES2017 -> ES5 (ブラウザ用) ※ .babelrc で変更可
            options: {
              presets: ['env'] // .babelrc に設定
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({ // 処理する全ファイルに import/require したのと同等の効果 (= 各ファイルで読み込み不要)
      $: 'jquery',
      jQuery: 'jquery',
      // 'window.jQuery': 'jquery',
    })
  ],
};
