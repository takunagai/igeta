// @file clean.js
import gulp     from 'gulp';
import rimraf   from 'rimraf';
import notifier from 'node-notifier';
import config   from '../config';

const clean = (callback) => {
    rimraf(config.dist, callback); // ★★gitファイルも除外 rimraf でなく del を使用 '!dist/.git'
    notifier.notify('task "clean" complete');
}
clean.description = '公開ディレクトリ(/dist)の削除'; // gulp --tasks で注釈を表示
gulp.task('clean', clean);


// 参考記事：
//   http://qiita.com/shinnn/items/bd7ad79526eff37cebd0 delによる複数ファイル(ディレクトリ)削除の解説もあり
