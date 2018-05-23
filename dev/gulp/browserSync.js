// @file serve.js (Web Server Task)

// ★★ webpackの監視→リロードをコメントアウトしてある

import gulp             from 'gulp';
import browserSync      from 'browser-sync';
import watch            from 'gulp-watch';//gulp3のgulp.watch()はファイルの追加や削除に反応しないバグがあるため導入
import {browserSync as config} from '../config'; // == var config = require('../config').browserSync;

browserSync.create();

// 画像ファイル
const imgFiles = [
    config.baseDir + '/**/*.jpg',
    config.baseDir + '/**/*.jpeg',
    config.baseDir + '/**/*.gif',
    config.baseDir + '/**/*.png',
    config.baseDir + '/**/*.svg'
];

// // ★★改良
// // http://qiita.com/nekoneko-wanwan/items/f947e8f505aa3869447b once: 同じ処理を何度もしない の項を参照
// let timer; // タイマーIDを入れる変数
// const aaa = () => {
//     clearTimeout(timer);
//     timer = setTimeout(function () {
//         browserSync.reload;
//     }, 200); // 連続イベントの間引き処理。200ミリ秒以内(必要に応じて調整)で再度発生した場合は無視
// }

// // webpackタスクが完了してからブラウザをリロードさせるためのタスク
// gulp.task('webpack-watch', ['webpack'], browserSync.reload);

gulp.task('serve', function() { // 元：gulp.task('serve', ['webpack'], function() {
    // Webサーバー (公開ディレクトリをルートとする)
    browserSync.init({
        proxy: config.proxy // server: { baseDir: config.baseDir }
    });

    // 公開ディレクトリを監視、更新があればブラウザをリロード
    watch(config.baseDir + '/**/*.html', ['html']).on('change', browserSync.reload);
    watch(config.baseDir + '/**/*.css', ['css']).on('change', browserSync.reload);
    // watch(config.baseDir + '/**/*.js', ['webpack-watch']).on('change', browserSync.reload);
    watch(config.baseDir + '/**/*.php').on('change', browserSync.reload);
    watch(imgFiles).on('change', browserSync.reload);
});


// コンパイル後のファイルを監視、更新されたタイミングでブラウザを更新
// const browser_sync = (done) => {
//     browserSync({
//         server: { baseDir: "src" }
//     })

//     gulp.watch(["./src/html/**/!(_)"], () => {
//         browserSync.reload();
//     });
// }
// gulp.task('browser_sync', browser_sync);


// 参考記事：
//   https://www.browsersync.io/docs/gulp/
//   https://www.npmjs.com/package/gulp-htmlhint
