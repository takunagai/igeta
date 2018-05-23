// @file copy.js
// ★★途中、階層保ったまま出力するように修正すること
// ★★ BrowserSyncの改良案"連続イベントの間引き処理"参照

import gulp             from 'gulp';
import notify           from 'gulp-notify';
import print            from 'gulp-print';
import {copy as config} from '../config';


const copy = () => {
  return gulp.src(config.src, {base: config.srcRoot}) // baseオプションで階層維持
    .pipe(gulp.dest(config.dist))
    .pipe(notify({ message: 'task "copy" complete' }))
    .pipe(print(function(filepath) { return 'copy: ' + filepath; }));
};

copy.description = '静的ファイル(画像、フォント etc.)のコピー';
gulp.task('copy', copy);
