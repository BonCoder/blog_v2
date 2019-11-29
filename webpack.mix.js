let mix = require('laravel-mix');
let rm = require('rimraf');

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
const buildRoot = 'public/js';

rm(buildRoot, err => {
    if (err) throw err
    console.log("清空编译文件夹\n\n")
});

mix.js('resources/assets/js/app.js', buildRoot).extract(['vue']).version()
   .sass('resources/assets/sass/app.scss', 'public/css');
// mix.js('resources/js/app.js', buildRoot).extract(['vue']).version()
//     .sass('resources/sass/app.scss', 'public/css')
//     .autoload({jquery: ['$', 'jQuery', 'jquery'],});
if (mix.inProduction()) {
    mix.version();
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/[id].[hash].js'
        },
    });
}



