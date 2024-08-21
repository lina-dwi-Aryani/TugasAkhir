import './bootstrap';
import Chart from 'chart.js/auto';
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/chart.js', 'public/js') // Tambahkan ini
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps();
