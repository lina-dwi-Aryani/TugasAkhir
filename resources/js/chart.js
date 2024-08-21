const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/chart.js', 'public/js') // Sesuaikan dengan path yang sesuai
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps();
