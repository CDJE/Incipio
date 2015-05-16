'use strict';

var gulp  = require('gulp');
var batch = require('gulp-batch');
var sass  = require('gulp-sass');
var watch = require('gulp-watch');

var browserify = require('browserify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var gutil = require('gulp-util');
var watchify = require('watchify');
var assign = require('lodash.assign');

var assets_src  = 'src/FrontBundle/Resources/assets';
var assets_dest = 'web/assets';

var sass_src  = assets_src + '/scss';
var sass_dest = assets_dest;

var js_src = assets_src + '/js/app.js';
var js_dest = assets_dest;

var fonts_src = assets_src + '/fonts/**/*';
var fonts_dest = assets_dest + '/fonts';

// Copy files without any changes
gulp.task('copy', function() {

    // Copy fonts
    gulp.src(fonts_src)
        .pipe(gulp.dest(fonts_dest));
});

// Compile SASS files to CSS
gulp.task('sass', function () {
    gulp.src(sass_src + '/app.scss')
        .pipe(sass())
        .pipe(gulp.dest(sass_dest));
});

// Publish JavaScript files
// add custom browserify options here
var customOpts = {
    entries: [js_src],
    debug: true
};
var opts = assign({}, watchify.args, customOpts);
var b = watchify(browserify(opts));

gulp.task('js', bundle); // so you can run `gulp js` to build the file
b.on('update', bundle); // on any dep update, runs the bundler
b.on('log', gutil.log); // output build logs to terminal

function bundle() {
    return b.bundle()
        // log errors if they happen
        .on('error', gutil.log.bind(gutil, 'Browserify Error'))
        .pipe(source('app.js'))
        // optional, remove if you don't need to buffer file contents
        .pipe(buffer())
        // optional, remove if you dont want sourcemaps
        .pipe(sourcemaps.init({loadMaps: true})) // loads map from browserify file
        // Add transformation tasks to the pipeline here.
        .pipe(sourcemaps.write('./')) // writes .map file
        .pipe(gulp.dest(js_dest));
}

// Configure watch task
gulp.task('watch', function () {

    // Watch SCSS files
    gulp.watch(sass_src + '**/*.scss', ['sass']);
});




//
//var usemin = require('gulp-usemin');
//var uglify = require('gulp-uglify');
//var minifyHtml = require('gulp-minify-html');
//var minifyCss = require('gulp-minify-css');
//var rev = require('gulp-rev');
//
//gulp.task('usemin', function () {
//    return gulp.src('./*.html')
//        .pipe(usemin({
//            css: [minifyCss(), 'concat'],
//            html: [minifyHtml({empty: true})],
//            js: [uglify(), rev()],
//            inlinejs: [uglify()],
//            inlinecss: [minifyCss(), 'concat']
//        }))
//        .pipe(gulp.dest('build/'));
//});
