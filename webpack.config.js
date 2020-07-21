const path = require('path')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')

function resolve (dir) {
  return path.resolve(
    __dirname,
    'resources/js',
    dir
  )
}

const rawArgv = process.argv.slice(2)
const report = rawArgv.includes('--report')
let plugins = []
plugins.push(new VuetifyLoaderPlugin())
if (report) {
  plugins.push(new BundleAnalyzerPlugin({
    openAnalyzer: true,
  }))
}

module.exports = {
  resolve: {
    alias: {
      vue$: 'vue/dist/vue.esm.js',
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  module: {
    rules: [
      {
        test: /\.svg$/,
        loader: 'svg-sprite-loader',
        include: [resolve('icons')],
        options: {
          symbolId: 'icon-[name]',
        },
      },
    ],
  },
  plugins: plugins
}
