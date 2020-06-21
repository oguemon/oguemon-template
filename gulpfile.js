// Sass configuration
var gulp = require('gulp');
var sass = require('gulp-sass');
var closureCompiler = require('google-closure-compiler').gulp();
const browsersync = require('browser-sync');

function compileSass () {
    return gulp.src('./sass/*.scss')
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(gulp.dest('./css'))
}

function minifyJs () {
    return gulp.src('./js/oguemon.js')
            .pipe(closureCompiler({
                compilation_level: 'SIMPLE',
                warning_level: 'QUIET',
                language_in: 'ECMASCRIPT_2015',
                language_out: 'ECMASCRIPT_2015',
                js_output_file: 'oguemon.min.js'
                }, {
                platform: ['native', 'java', 'javascript']
                }))
            .pipe(gulp.dest('./js'));
}

function buildServer (done) {
    browsersync.init({
        proxy: 'https://oguemon.localhost/',
        open:"external",
        online: true,
    });
    done();
}

function browserReload (done){
    browsersync.reload();
    done();
}

function watch () {
    gulp.watch('./**/*.php', gulp.series(browserReload));
    gulp.watch('./sass/*.scss', gulp.series(compileSass, browserReload));
    gulp.watch('./js/oguemon.js', gulp.series(minifyJs, browserReload));
}

exports.default = gulp.series(buildServer, watch);
