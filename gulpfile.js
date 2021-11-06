/**
 * Gulp File.
 *
 * Concatène et minifie les fichiers CSS et JS.
 *
 * Pré-requis: Installer node/npm
 * Installation: npm install
 * Compilation: gulp
 * Auto-compilation: gulp watch
 *
 * Notes:
 *   - Syntaxe ES6
 */

const gulp = require('gulp');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const minifyCss = require('gulp-clean-css');
const rebaseUrls = require('gulp-css-url-rebase');
const plumber = require('gulp-plumber');
const { watch, parallel } = require('gulp');

var jsFiles = [
    // 'assets/js/jquery-3.4.1.min.js',
    'assets/js/jquery-3.6.0.min.js',
    'assets/js/jquery.multi-select.js',
    'assets/js/jquery.datetimepicker.full.min.js',
    'assets/js/tether-1.3.3.min.js',
    'assets/js/bootstrap.4.0.0-alpha.4.min.js',
    // 'assets/js/bootstrap.4.0.0.min.js',
    'assets/js/script.js'
];
var cssFiles = [
    'assets/css/multi-select.css',
    'assets/css/jquery.datetimepicker.min.css',
    'assets/css/bootstrap.4.0.0-alpha.4.min.css',
    // 'assets/css/bootstrap.4.0.0.min.css',
    'assets/css/tether-1.3.3.min.css',
    'assets/css/font-awesome.5.14.4.min.css',
    'assets/css/style.css'
];

// minification des fichiers javascript
function minify12pJs() {
  var jsDest = 'assets/js';
  return gulp.src(jsFiles)
        .pipe(plumber())
        .pipe(concat('12parfait.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('script.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
}

// minification des fichiers css
function minify12pCss() {
  var cssDest = 'assets/css';
  return gulp.src(cssFiles)
        .pipe(plumber())
        .pipe(rebaseUrls({root: cssDest}))
        .pipe(concat('12parfait.css'))
        .pipe(gulp.dest(cssDest))
        .pipe(rename('style.min.css'))
        .pipe(minifyCss())
        .pipe(gulp.dest(cssDest));
}

// tâche par défault
exports.default = parallel(minify12pJs, minify12pCss);

// surveille les changements
exports.watch = function() {
  watch(jsFiles, minify12pJs);
  watch(cssFiles, minify12pCss);
}
