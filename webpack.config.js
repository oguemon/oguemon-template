const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

const config = {
    // モード値を production に設定すると最適化された状態で、
    // development に設定するとソースマップ有効でJSファイルが出力される
    mode: 'development',

    // メインとなるJavaScriptファイル（エントリーポイント）
    entry: {
      scss_common: './sass/common.scss',
      scss_edit: './sass/editor-style.scss',
      scss_embed: './sass/embed.scss',
      ts: './ts/main.ts',
    },
    output: {
        path: __dirname,
        filename: (pathData) => {
          return pathData.chunk.name === 'ts' ? 'js/oguemon.js' : '[name].js'
        },
    },
    module: {
      rules: [
        {
          // 拡張子 .ts の場合
          test: /\.ts$/,
          // TypeScript をコンパイルする
          use: 'ts-loader',
        },
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: {
                url: false,
              },
            },
            'sass-loader',
          ],
        },
      ],
    },
    plugins: [
      new RemoveEmptyScriptsPlugin(),
      new MiniCssExtractPlugin({
        filename: (pathData) => {
          switch (pathData.chunk.name) {
            case 'scss_common':
              return './css/common.css'
            case 'scss_edit':
              return './css/editor-style.css'
            case 'scss_embed':
              return './css/embed.css'
          }
          return './css/[name].css'
        },
      }),
    ],
    // import 文で .ts ファイルを解決するため
    // これを定義しないと import 文で拡張子を書く必要が生まれる。
    // フロントエンドの開発では拡張子を省略することが多いので、
    // 記載したほうがトラブルに巻き込まれにくい。
    resolve: {
      // 拡張子を配列で指定
      extensions: [
        '.ts', '.js',
      ],
    },
    // バンドルを除外するライブラリ
    externals: {
    },
};

module.exports = (env, argv) => {
  if (argv.mode === 'development') {
    config.devtool = 'source-map'
  }

  return config
}
