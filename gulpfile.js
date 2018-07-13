// Sass configuration
var gulp = require('gulp');
var sass = require('gulp-sass');
var minifyjs = require("gulp-closurecompiler");

gulp.task('sass', function() {
    gulp.src('./sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./css'))
});
gulp.task('minifyjs', function() {
    gulp.src('./js/oguemon.js')
        .pipe(minifyjs({
            compilerPath: 'node_modules/closurecompiler/compiler/closure-compiler-v20180610.jar',
            fileName: 'oguemon.min.js'
        }))
        .pipe(gulp.dest('./js'));
});
gulp.task('default', ['sass', 'minifyjs'], function() {
    gulp.watch('./sass/*.scss', ['sass']);
    gulp.watch('./js/oguemon.js', ['minifyjs']);
})