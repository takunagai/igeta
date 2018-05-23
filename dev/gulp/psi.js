// @file: psi.js (Google PageSpeed Insights V2)
// psi- npm https://www.npmjs.com/package/psi
// グローバルにインストールしたら、コマンド操作もできる

// サンプル：https://github.com/addyosmani/psi-gulp-sample/blob/master/gulpfile.js
import gulp            from 'gulp';
import {output as psi} from 'psi'; // == var psi = require('psi').output;
import {psi as config} from '../config'; // == var config = require('../config').css;
//const googleDeveloperApiKey = ''; //Google Developer APIキー(psi使う頻度高いなら設定した方がいい http://goo.gl/RkN0vE)




// web-starter-kit-0.6.0 より
// Run PageSpeed Insights
const psi_task = (callback) => {
	psi(config.url, {
		strategy: 'mobile',
		locale: 'ja_JP'
		// key: googleDeveloperApiKey //API設定した場合に有効化
	}, callback)
}
psi_task.description = 'Google PageSpeed Insights V2(パフォーマンス測定)';
gulp.task('psi', psi_task);


// Sample A
// Please feel free to use the `nokey` option to try out PageSpeed
// Insights as part of your build process. For more frequent use,
// we recommend registering for your own API key. For more info:
// https://developers.google.com/speed/docs/insights/v2/getting-started

// gulp.task('psi-mobile', function () {
//     return psi(url, {
//         // key: key
//         nokey: 'true',
//         locale: 'ja_JP',
//         strategy: 'mobile',
//     }).then(function (data) {
//         console.log('Speed score: ' + data.ruleGroups.SPEED.score);
//         console.log('Usability score: ' + data.ruleGroups.USABILITY.score);
//     });
// });

// gulp.task('psi-desktop', function () {
//     return psi(url, {
//         nokey: 'true',
//         locale: 'ja_JP',
//         // key: key,
//         strategy: 'desktop',
//     }).then(function (data) {
//         console.log('Speed score: ' + data.ruleGroups.SPEED.score);
//     });
// });

// // ターミナルでフォーマットされた形式で表示
// gulp.task('psi', function () {
// 	return psi(url).then(function () {
// 	  console.log('done');
// 	});
// });



// // Sample B
// // @link: https://www.npmjs.com/package/psi

// var gulp = require('gulp');
// var psi = require('psi');

// // get the PageSpeed Insights report
// psi('theverge.com').then(function (data) {
//   console.log(data.ruleGroups.SPEED.score);
//   console.log(data.pageStats);
// });

// // output a formatted report to the terminal
// psi.output('theverge.com').then(function () {
//   console.log('done');
// });

// // Supply options to PSI and get back speed and usability scores
// // 第二引数にオプション
// psi('theverge.com', { nokey: 'true', strategy: 'mobile' }).then(function (data) {
//   console.log('Speed score: ' + data.ruleGroups.SPEED.score);
//   console.log('Usability score: ' + data.ruleGroups.USABILITY.score);
// });
