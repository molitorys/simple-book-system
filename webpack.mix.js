const mix = require('laravel-mix');

const assetsDir = 'resources/assets/';
const publicDir = 'public/';

mix
    .sass(assetsDir + 'sass/app.scss', publicDir + 'css')
    .js(assetsDir + 'js/app.js', publicDir + 'js')
    .extract(['jquery','bootstrap','axios','lodash'])
    .sourceMaps()
    .copyDirectory(assetsDir + 'fonts', publicDir + 'fonts')
    .copyDirectory(assetsDir + 'images', publicDir + 'images');

    if (mix.inProduction()) {
        mix.version();
    }
