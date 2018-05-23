// @file hmtl.js
// @link: https://www.npmjs.com/package/gulp-htmlmin
// @link: https://www.npmjs.com/package/gulp-htmlhint
import gulp             from 'gulp';
import cache            from 'gulp-cached';
// import phplint          from 'gulp-phplint';
// import gulpif           from 'gulp-if';
import newer            from 'gulp-newer';
import notify           from 'gulp-notify';
import plumber          from 'gulp-plumber';
import print            from 'gulp-print';
import {php as config}  from '../config'; // == var config = require('../config').php;

const php = () => {
  return gulp.src(config.src) //第二引数に { base: 'src' } でディレクトリ構造維持できる
    .pipe(newer(config.dist))//変更があったファイルのみ処理(タイムスタンプで比較)
    .pipe(plumber({errorHandler: (error) => { notify('php', error);}}))
    .pipe(cache('php_cache'))
    .pipe(plumber.stop())
    .pipe(gulp.dest(config.dist))
    //.pipe(notify({ message: 'task "php" complete' }))
    .pipe(print(function(filepath) { return 'php: ' + filepath; }));
};
php.description = 'PHP(★★現在コピーのみ。後で構文チェックなど追加？)';
gulp.task('php', php);


const php_watch = (callback) => {
  gulp.watch(config.src, ['php']);
  callback();
};
php_watch.description = '監視：PHP';
gulp.task('php_watch', php_watch);

// // phplint
// .pipe(phplint('',opts))
// .pipe(phplint.reporter(function(file){
//   var report = file.phplintReport || {};
//   if (report.error) { console.error(report.message+' on line '+report.line+' of '+report.filename); }
// }));
