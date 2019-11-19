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

mix.styles([
    'resources/css/accessible-menu.css',
    'resources/css/demi-footer.css',
    'resources/css/footer.css',
    'resources/css/global.css',
    'resources/css/gold-footer.css',
    'resources/css/header.css',
    'resources/css/main-menu.css',
    'resources/css/search-bar.css',
    'resources/css/site-logo.css',
    'resources/css/bootstrap.css'
], 'public/css/all.css');


mix.scripts([
    'resources/js/app.js',
    'resources/js/drupalSettingsLoader.js',
    'resources/js/drupal.js',
    'resources/js/drupal.init.js',
    'resources/js/header.js',
    'resources/js/jquery.min.js',
    'resources/js/jquery.once.min.js',
    'resources/js/main-menu.js',
    'resources/js/mega-menu.js',
    'resources/js/ready.min.js',
    'resources/js/search-bar.js',
    'resources/gt/js/*'
], 'public/js/all.js');

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory([
    'resources/assets',
], 'public/assets');
