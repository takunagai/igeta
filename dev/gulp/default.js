// @file default.js
// デフォルトタスク (`gulp`で実行)
// ★★ 'clean', ['html', 'webpack'], 'css' は buildタスクと同じ。built とするとうまく機能しないのでこう書いた
import gulp        from 'gulp';
import runSequence from 'run-sequence';

gulp.task('default', (callback) => {
    runSequence('build', ['serve', 'watch']);//'sftp'
    callback();
});
