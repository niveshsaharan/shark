const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

mix.webpackConfig({
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
        },
    },
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    }
});

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

mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/guest.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });

mix.sass('resources/sass/polaris.scss', 'public/css')

mix.version();
