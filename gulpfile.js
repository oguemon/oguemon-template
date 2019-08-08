// Sass configuration
var gulp = require('gulp');
var sass = require('gulp-sass');
var closureCompiler = require('google-closure-compiler').gulp();
const browsersync = require('browser-sync');

gulp.task('sass', function() {
    return gulp.src('./sass/*.scss')
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(gulp.dest('./css'))
});

gulp.task('minifyjs', function() {
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
});

gulp.task('build-server', function (done) {
    browsersync.init({
        proxy: 'https://oguemon.localhost/',
        online: true,
    });
    done();
});

gulp.task('browser-reload', function (done){
    browsersync.reload();
    done();
});

gulp.task('watch', function() {
    gulp.watch('./**/*.php', gulp.series('browser-reload'));
    gulp.watch('./sass/*.scss', gulp.series('sass', 'browser-reload'));
    gulp.watch('./js/oguemon.ts', gulp.series('minifyjs', 'browser-reload'));

});

const defaultTasks = gulp.series('build-server', 'watch');
gulp.task('default', defaultTasks);
