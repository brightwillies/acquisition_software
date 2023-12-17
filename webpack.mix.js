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

 mix.js('resources/js/super/app.js', 'public/vuejs/super.js')
     .vue()

 mix.js('resources/js/purchaser/app.js', 'public/vuejs/purchaser.js')
     .vue()

 mix.js('resources/js/hod/app.js', 'public/vuejs/hod.js')
     .vue()

