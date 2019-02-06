let mix = require('laravel-mix');

mix.sass('resources/sass/kontour.scss', 'resources/css/kontour.css')
  .setPublicPath('resources/css');
