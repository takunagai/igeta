// @file build.js
import gulp        from 'gulp';
import runSequence from 'run-sequence';

const build = (callback) => {
    runSequence('clean', 'copy', ['html', 'php'], 'css'); // [] 内にあった 'webpack' は直接実行させるようにしている
    callback();
};

build.description = 'ビルド'; // gulp --tasks で注釈を表示
gulp.task('build', build);


// runSequenceは、直列処理、並列処理を操作
// ※？？？HTMLタスクをCSSタスクよりも前に(uncssタスクがビルド済のHTMLを参照するため)
// 'clean' → ('main_css', 'main_js', 'bower') → 'plugin_js' → 'watch' → 'webserver'

// gulp v4では、標準APIの gulp.series, gulp.parallel に置き換わる
// gulp.task('default', gulp.series(
// 	task_1,
// 	gulp.parallel(task_2A, task_2B, task_2C),
// 	task_3
// ));
