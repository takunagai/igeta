// @file watch.js
import gulp              from 'gulp';
import watch             from 'gulp-watch';//gulp3のgulp.watch()はファイルの追加や削除に反応しないバグがあるため導入
import {watch as config} from '../config'; // == var config = require('../config').watch;

const watchTasks = (callback) => {

    // CSS
    watch(config.css, () => {
        gulp.start(['css']);
    });

    // // JavaScript (webpack)
    // watch(config.js, () => {
    //     gulp.start(['webpack']);
    // });

    // HTML
    watch(config.html, () => {
        gulp.start(['html']);
    });

    // PHP
    watch(config.php, () => {
        gulp.start(['php']);
    });

    // www
    // watch(config.www, () => {
    //     gulp.start(['copy']);
    // });

    // 公開ディレクトリ内のファイルを監視、更新でブラウザ自動リロードは browserSync.js に記述

    callback();
};
watchTasks.description = '監視(変更検知)'; // gulp --tasks で注釈を表示
gulp.task('watch', watchTasks);


// // gulp本体に含むwatchの場合
// const watchTasks = (callback) => {

//     // CSS
//     gulp.watch(config.styl, function () {
//         gulp.start(['stylus']);
//     });

//     // JavaScript
//     gulp.watch(config.js, function () {
//         gulp.start(['webpack']);
//     });

//     // HTML
//     gulp.watch(config.www, function () {
//         gulp.start(['copy']);
//     });
//     // Jade
//     // gulp.watch(config.jade, function() {
//     //     gulp.start(['jade']);
//     // });

//     // www
//     gulp.watch(config.www, function () {
//         gulp.start(['copy']);
//     });
// }