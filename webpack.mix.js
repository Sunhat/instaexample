let mix = require('laravel-mix')
/**
 * I decided to use Laravel Mix
 * An API that sits on top of Webpack, making it quick to setup and get going.
 * It covers most use-cases, and supports overriding its settings with
 * .webpackOptions({}) 
 * 
 * See app/helpers.php for the PHP function that accompanies this.
 * See usage in master.blade.php
 */
mix.sass('resources/sass/app.scss', 'dist')
   .js('resources/js/app.js', 'dist')