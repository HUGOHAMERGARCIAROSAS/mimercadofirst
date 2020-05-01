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

mix
    .babel('node_modules/mprogress/mprogress.min.js', 'public/files/mprogress.js')
    .babel('node_modules/gasparesganga-jquery-loading-overlay/dist/loadingoverlay.min.js', 'public/files/loadingoverlay.js')
    .babel('node_modules/jquery-easy-loading/dist/jquery.loading.min.js', 'public/files/jquery.loading.js')
    .babel('node_modules/lazysizes/lazysizes.min.js', 'public/files/lazysizes.js')
    .babel('node_modules/jscroll/dist/jquery.jscroll.min.js', 'public/files/jquery.jscroll.js')
    .babel('resources/assets/js/main.js', 'public/assets/js/main.js')
    .babel('resources/assets/js/shopping_init.js', 'public/assets/js/shopping_init.js')
    .babel('resources/assets/js/shopping_index.js', 'public/assets/js/shopping_index.js')
    .babel('resources/assets/js/shopping_cart.js', 'public/assets/js/shopping_cart.js')
    .babel('resources/assets/js/global.js', 'public/assets/js/global.js')
    .styles('node_modules/jquery-easy-loading/dist/jquery.loading.min.css', 'public/files/jquery.loading.css')
    .styles('resources/assets/css/web/plugins.css', 'public/assets/css/plugins.css')
    .styles('resources/assets/css/web/helper.css', 'public/assets/css/helper.css')
    .styles('resources/assets/css/web/main.css', 'public/assets/css/main.css');
