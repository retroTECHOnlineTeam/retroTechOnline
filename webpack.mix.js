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
    'resources/css/site-logo.css'
], 'public/css/all.css');


mix.scripts([
    'public/js/app.js',
    'public/js/bootstrap.js',
    'public/js/drupal.init.js',
    'public/js/drupal.js',
    'public/js/drupalSettingsLoader.js',
    'public/js/header.js',
    'public/js/jquery.min.js',
    'public/js/jquery.once.min.js',
    'public/js/main-menu.js',
    'public/js/mega-menu.js',
    'public/js/ready.min.js',
    'public/js/search-bar.js'
], 'public/js/all.js');

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/assets', 'public/assets');
