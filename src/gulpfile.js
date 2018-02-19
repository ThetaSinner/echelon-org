const gulp = require('gulp');
const sass = require('gulp-sass');
 
const exec = require('child_process').exec;

gulp.task('index', () => {
    return gulp.src('index.php').pipe(gulp.dest('../site/'));
});

gulp.task('fragments', () => {
    return gulp.src('fragments/**').pipe(gulp.dest('../site/fragments'));
});

gulp.task('pages', () => {
    return gulp.src('pages/**').pipe(gulp.dest('../site/pages'));
});

gulp.task('blog', (cb) => {
    exec('cd blog && ruby ./build_posts.rb', (err, stdout, stderr) => {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
});

gulp.task('sass', function () {
    return gulp.src('./scss/root.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('../site/style'));
});

gulp.task('default', gulp.parallel(['index', 'blog', 'fragments', 'sass', 'pages']));
