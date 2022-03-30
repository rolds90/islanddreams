const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/assets/js', 'public/js')
    .copyDirectory('resources/assets/fonts', 'public/fonts')
    .copyDirectory('resources/assets/line-awesome', 'public/line-awesome')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/assets/css', 'public/css')
    .copyDirectory('resources/assets/font-awesome', 'public/font-awesome')
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}