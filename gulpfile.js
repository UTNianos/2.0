var gulp    = require('gulp'),
    elixir  = require('laravel-elixir'),
    bowerFiles = require('bower-files')(),
    del = require('del');



elixir.config.js.browserify.transformers.push({
    name: 'debowerify',
    options: {}
});

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function (mix) {

    // Combine scripts
/*
    mix.browserify(bowerFiles.ext('js').relative('./resources/assets/js/').files,
        'public/assets/js/vendor.js'
        );
*/

    mix.browserify('main.js', 'public/assets/js/main.js');
    //mix.browserify('main.js', 'public/assets/js/admin.js');

    // Compile Less
    // bootstrap lo compilo aparte con los estilos de la aplicacion, asi podemos customizarlo
    mix.less(bowerFiles.ext(['css', 'less'])
            .match('!**/bootstrap/**')
            .relative('./resources/assets/less/')
            .files,
        'public/assets/css/vendor.css');

    mix.less('styles.less', 'public/assets/css/styles.css');

    gulp.src(bowerFiles.ext(['eot', 'woff', 'ttf', 'svg']).files)
        .pipe(gulp.dest("public/assets/fonts"));

    mix.version(['assets/css/styles.css', 'assets/css/vendor.css', 'assets/js/*.js']);
});

gulp.task('clean', function () {
    return del([
        'public/assets/**/*',
        'public/build/**/*'
    ]);
});