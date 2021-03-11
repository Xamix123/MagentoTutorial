var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    plumber      = require('gulp-plumber'),
    notify       = require('gulp-notify'),
    minifycss    = require('gulp-clean-css'),
    livereload   = require('gulp-livereload'),
    cssmin       = require('gulp-cssmin'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglify');



var vendorName = 'Learning';
var themeName = 'MyTheme123';
var webPath = 'web/';
var rootPath = '../../../../../pub/static/frontend/' + vendorName + '/' + themeName + '/en_US/';

var config = {
    appendLiveReload: false,
    minifyCss: true,
    uglifyJs: true
};

// Sass
gulp.task('css', function() {
    var stream = gulp.src(webPath + 'scss/styles.scss')
        .pipe(plumber())
        .pipe(sass({errLogToConsole: true}))
        .on('error', function (err) {
            console.log(err.message);
            this.emit('end');
        })
        .pipe(cssmin())
        .pipe(gulp.dest(webPath + 'css'))
        .pipe(gulp.dest(rootPath + 'css'));

    if (config.minifyCss === true) {
        stream.pipe(minifycss({keepSpecialComments: '0'}))
    }

    stream.pipe(livereload());

    return stream.pipe(notify({ message: 'Sass compiled successfully'}))
});

// JS
gulp.task('js', function() {
    var scripts = [
        webPath + 'js/custom/_main.js',
    ]

    if (config.appendLiveReload === true) {
        scripts.push(webPath + 'js/livereload.js');
    }

    var stream = gulp
        .src(scripts)
        .pipe(concat('script.js'));

    if(config.uglifyJs === true) {
        stream.pipe(uglify());
    }

    stream.pipe(gulp.dest(webPath + 'js'));
    stream.pipe(gulp.dest(rootPath + 'js'));
    stream.pipe(livereload());

    return stream.pipe(notify({ message: 'Successfully compiled JavaScript' }))
});

// Images
    gulp.task('images', function() {
        return gulp
            .src(webPath + 'images/**/*')
            .pipe(gulp.dest(webPath + 'images'))
            .pipe(gulp.dest(rootPath + 'images'))
            .pipe(livereload())
            .pipe(notify({ message: 'Successfully processed image' }));
    });

// Watch
gulp.task('watch', function () {
    livereload.listen();

    // Watch .less files
    gulp.watch(webPath + 'scss/**/*.scss', gulp.series('css'));

    // Watch .js files
    gulp.watch(webPath + 'js/**/*.js', gulp.series('js'));

    // Watch image files
    gulp.watch(webPath + 'images/**/*', gulp.series('images'));

    // Create LiveRoad server
    var server = livereload();

    // Watch any files in, reload on change
    gulp.watch([webPath + 'css/style.css', webPath + 'images/!**!/!*']).on('change', function(file) {
       server.changed(file.path)
    });
})
