const mix = require('laravel-mix');

mix.js('resources/js/dashboard.js', 'public/js');
mix.sass('resources/scss/dashboard.scss', 'public/css');

mix.options({
    processCssUrls: false
});

mix.browserSync('localhost:8000');
mix.disableNotifications();
