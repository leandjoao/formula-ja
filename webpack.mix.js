const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js');
mix.sass('resources/scss/style.scss', 'public/css');

mix.options({
    processCssUrls: false
});

mix.browserSync('localhost:8000');
mix.disableNotifications();
