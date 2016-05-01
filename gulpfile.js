var gulp    = require('gulp'),
    elixir  = require('laravel-elixir');



/**
 * Default gulp is to run this elixir stuff
 */
elixir(function (mix) {

});

gulp.task('clean', function () {
    return del([
        'public/build/**/*',
        'public/assets/**/*',
        '!public/assets',
        '!public/assets/js',
        '!public/assets/js/.gitkeep'
    ]);
});