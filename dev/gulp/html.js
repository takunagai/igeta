import util from 'util';
import DefaultRegistry from 'undertaker-registry';
import htmlmin from 'gulp-htmlmin';


function html() {
  DefaultRegistry.call(this);
}
util.inherits(html, DefaultRegistry);

html.prototype.init = function(gulp) {
  gulp.task('html', function() {
    return gulp.src('test.html')
      .pipe(htmlmin({collapseWhitespace: true}))
      .pipe(gulp.dest('test'));
  });
  // // 複数タスクの登録も可能
  // gulp.task('clean', function(done) {
  //   done();
  // });
};

module.exports = new html();


// // 旧ファイルの内容
// import gulp             from 'gulp';
// import cache            from 'gulp-cached';
// import htmlmin          from 'gulp-htmlmin';
// import htmlhint         from 'gulp-htmlhint';
// import gulpif           from 'gulp-if';
// import newer            from 'gulp-newer';
// import notify           from 'gulp-notify';
// import plumber          from 'gulp-plumber';
// import print            from 'gulp-print';
// import {html as config} from '../config'; // == var config = require('../config').html;

// const html = (callback) => {
//   return gulp.src(config.src) //第二引数に { base: 'src' } でディレクトリ構造維持できる
//     .pipe(newer(config.dist))//変更があったファイルのみ処理(タイムスタンプで比較)
//     .pipe(plumber({errorHandler: (error) => { notify('html', error);}}))
//     .pipe(cache('html_cache'))
//     .pipe(htmlhint())
//     .pipe(htmlhint.failReporter()) //.pipe(htmlhint.reporter())
//     .pipe(gulpif(config.minify, htmlmin({collapseWhitespace: config.collapseWhitespace})))//必要ならminify
//     .pipe(plumber.stop())
//     .pipe(gulp.dest(config.dist))
//     //.pipe(notify({ message: 'task "html" complete' }));
//     .pipe(print(function(filepath) { return 'html: ' + filepath; }));
//   callback();
// };
// html.description = 'HTML(htmlhint, htmlmin)';
// gulp.task('html', html);


// const html_watch = (callback) => {
//   gulp.watch(config.src, ['html']);
//   callback();
// };
// html_watch.description = '監視：HTML';
// gulp.task('html_watch', html_watch);
