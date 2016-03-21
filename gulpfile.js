var gulp    = require('gulp'),
    elixir  = require('laravel-elixir'),
    bowerFiles = require('bower-files')(),
    del = require('del'),
    fs = require('fs');

var jss   = fs.readdirSync('resources/assets/js/'),
    jsFiles  = jss.map(function (page) { return 'resources/assets/js/' + page; }),
    outputs = jss.map(function (page) { return 'public/assets/js/' + page; });



elixir.config.js.browserify.transformers.push({
    name: 'debowerify',
    options: {}
});
elixir.config.js.browserify.plugins.push(
    {
        name: 'factor-bundle',
        options: {
            outputs: outputs
        }
    }
);

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function (mix) {

    mix.browserify(jsFiles, 'public/assets/js/common.js');
    //mix.browserify('main.js', 'public/assets/js/admin.js');

    // Compile Less
    mix.less(bowerFiles.ext(['css', 'less'])
            .match('!**/bootstrap/**')
            .relative('./resources/assets/less/')
            .files,
        'public/assets/css/vendor.css');

    mix.less('styles.less', 'public/assets/css/styles.css');

    gulp.src(bowerFiles.ext(['eot', 'woff', 'ttf', 'svg']).files)
        .pipe(gulp.dest("public/assets/fonts"));

    mix.version(['assets/css/styles.css', 'assets/css/vendor.css', 'assets/js/*.js']);
    if (elixir.config.production) {
    }
});

gulp.task('clean', function () {
    return del([
        'public/build/**/*',
        'public/assets/**/*',
        '!public/assets',
        '!public/assets/js',
        '!public/assets/js/.gitkeep',
    ]);
});