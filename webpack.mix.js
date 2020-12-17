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

mix.copyDirectory('node_modules/@material/chips/dist/mdc.chips.min.css', 'public/css/mdc.chips.min.css')
   .copyDirectory('node_modules/@material/chips/dist/mdc.chips.min.js', 'public/js/mdc.chips.min.js')
   .copyDirectory('node_modules/jquery', 'public/js/node_modules/jquery')
   .copyDirectory('node_modules/sweetalert2', 'public/js/node_modules/sweetalert2')
   .copyDirectory('node_modules/autosize', 'public/js/node_modules/autosize')
   .copyDirectory('node_modules/jquery-tags-input', 'public/js/node_modules/jquery-tags-input')
   .copyDirectory('node_modules/jquery-validation', 'public/js/node_modules/jquery-validation')
   //.copyDirectory('node_modules/croppie', 'public/js/node_modules/croppie');
   .copyDirectory('node_modules/cropperjs', 'public/js/node_modules/cropperjs');
