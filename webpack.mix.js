const mix = require('laravel-mix');
const Chart = require('chart.js');

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
    .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/chart.js/dist/chart.js', 'public/js/chart.js/chart.js');
mix.copy('node_modules/filepond/dist/filepond.min.js', 'public/js/filepond/filepond.min.js');


mix.copy('node_modules/jspdf-autotable/dist/jspdf.plugin.autotable.min.js', 'public/js/jspdf-autotable/jspdf.plugin.autotable.min.js');



