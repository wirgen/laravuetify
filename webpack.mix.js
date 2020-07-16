const path = require('path')
const config = require('./webpack.config')
const mix = require('laravel-mix')
require('laravel-mix-eslint')

function resolve (dir) {
  return path.join(
    __dirname,
    '/resources/js',
    dir
  )
}

global.Mix.listen('configReady', webpackConfig => {
  // Add "svg" to image loader test
  const imageLoaderConfig = webpackConfig.module.rules.find(
    rule =>
      String(rule.test) ===
      String(/(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/)
  )
  imageLoaderConfig.exclude = resolve('icons')
})

mix.webpackConfig(config)

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// noinspection JSUnresolvedFunction
mix
  .js('resources/js/app.js', 'public/js')
  .extract([
    'axios',
    'vue',
    'vue-router',
  ])
  .options({
    processCssUrls: false,
  })
  .sass('resources/sass/app.scss', 'public/css/app.css', {
    implementation: require('sass'),
    sassOptions: {
      fiber: require('fibers'),
    },
  })

if (mix.inProduction()) {
  // set build number
  const fs = require('fs')
  const metadata = JSON.parse(fs.readFileSync('package.json').toString())
  const dt = new Date()
  metadata.build = dt.getFullYear() +
    (dt.getMonth() + 1).toString().padStart(2, '0') +
    dt.getDate().toString().padStart(2, '0') +
    dt.getHours().toString().padStart(2, '0') +
    dt.getMinutes().toString().padStart(2, '0') +
    dt.getSeconds().toString().padStart(2, '0')
  fs.writeFileSync('package.json', JSON.stringify(metadata, null, 2))

  // noinspection JSUnresolvedFunction
  mix.version()
} else {
  if (process.env.LARAVEL_USE_ESLINT === 'true') {
    // noinspection JSUnresolvedFunction
    mix.eslint()
  }

  // Development settings
  mix
    .sourceMaps()
    .webpackConfig({
      devtool: 'cheap-eval-source-map', // Fastest for development
    })
}
