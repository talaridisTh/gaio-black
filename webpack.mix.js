const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/plugins/checked', 'public/js/plugin')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/css/plugin.css')
    .copy('resources/plugin/', 'public/plugin');
mix.browserSync('127.0.0.1:8000');
// .postCss('resources/css/dashboard/theme/theme.css', 'public/css' )
if (mix.inProduction()) {
    mix.version();
}
