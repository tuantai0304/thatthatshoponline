var elixir = require('laravel-elixir');

require('laravel-elixir-livereload');

elixir.config.assetsPath = 'themes/responsiv-flat/assets/';
elixir.config.publicPath = 'themes/responsiv-flat/assets/compiled/';


elixir(function (mix) {

    mix.less('less/theme.less');

    mix.scripts([
        'jquery.min.js',
        'app.js',
        'html5shiv.js',
        'respond.min.js',
        'porfolio.js',
        'ui-elements.js'
    ])
});