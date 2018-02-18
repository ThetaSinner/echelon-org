const gulp = require('gulp');

const exec = require('child_process').exec;

gulp.task('index', () => {
    return gulp.src('index.php').pipe(gulp.dest('../site/'));
});

gulp.task('blog', (cb) => {
    exec('cd blog && ruby ./build_posts.rb', (err, stdout, stderr) => {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
});

gulp.task('default', gulp.parallel(['index', 'blog']));
