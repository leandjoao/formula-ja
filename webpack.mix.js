const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js');
mix.sass('resources/scss/style.scss', 'public/css');

mix.js('resources/js/dashboard.js', 'public/js');
mix.sass('resources/scss/dashboard.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js');

mix.options({
    processCssUrls: false
});

// mix.browserSync('localhost:8000');
mix.browserSync('127.0.0.1:8000');
mix.disableNotifications();
