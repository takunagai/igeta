// @file sftp.js
// @link: https://www.npmjs.com/package/gulp-sftp
// プロジェクトをまるごとアップロードするタスク
// ★★各タスクに含ませ、更新ファイルのみアップロードさせるようにする http://qiita.com/nekoneko-wanwan/items/847f2240a5dd1cd6e96c
import gulp             from 'gulp';
import notifier         from 'node-notifier';
import sftp             from 'gulp-sftp';
import {sftp as config} from '../config'; // == var config = require('../config').sftp;

// SFTPでアップロード
const sftpTask = () => {
	return gulp.src(config.dist)
		.pipe(sftp({
			host: config.host,
			remotePath: config.remotePath,
			port: config.port,
			user: config.user,
			//pass: config.pass, // ★★ 未設定だと /.ssh/id_dsa または /.ssh/id_rsa の秘密鍵を読みに行く →　★★パスワードやport未設定の場合も想定し修正
			key: config.key,
			callback: notifyCompletion
		}));
}

// 通知
const notifyCompletion = () => {
	notifier.notify('task "sftp" complete');
}

// メイン
sftpTask.description = 'SFTPでサーバーにアップロード';
gulp.task('sftp', sftpTask);
