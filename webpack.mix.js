let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css');

mix.copyDirectory('node_modules/jquery', 'public/js/node_modules/jquery')
	.copyDirectory('node_modules/sweetalert2', 'public/js/node_modules/sweetalert2')
	.copyDirectory('node_modules/autosize', 'public/js/node_modules/autosize')
	.copyDirectory('node_modules/jquery-tags-input', 'public/js/node_modules/jquery-tags-input')
	.copyDirectory('node_modules/jquery-validation', 'public/js/node_modules/jquery-validation');
