import path from 'path';
import del from 'del';

import gulp from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import concat from 'gulp-concat';

import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
// import replace from 'gulp-replace';

/* postcss */
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import cssDeclarationSorter from 'css-declaration-sorter';
import cssMqpacker from 'css-mqpacker';
// import doiuse from 'doiuse';
// import postcssUncss from 'postcss-uncss';
// import postcssStyleGuide from 'postcss-style-guide';

import imagemin from 'gulp-imagemin';



/**
 * import tasks
 */
// html (gulp.registry を使ってファイルを分割するサンプル)
const html = require('./gulp/html.js');
// const css = require('./gulp/css.js');
gulp.registry(html);



/**
 * Paths
 */
// このプロジェクトディレクトリの絶対パスを取得。__dirname には、現在実行中のこのファイルが格納されているディレクトリパスが格納
const rootDir = path.resolve(__dirname + '/..'),
	srcDir = rootDir + '/dev/src';



const paths = {
	del: [ // TODO：ディレクトリとその中のファイルの両方が削除対象なのが気持ち悪い→修正
		rootDir + '/**',
		'!' + rootDir,
		'!' + rootDir + '/dev',
		'!' + rootDir + '/dev/**'
	],
	copy: {
		srcRoot: srcDir,
		src: [
			// src + '/favicon.ico', // WordPressのカスタマイザーでアップロード
			// src + '/**/*.php', // task php で処理
			// srcDir + '/img/**', // task images で処理
			// rootDir + '/dev/node_modules/open-iconic/font/fonts',
			srcDir + '/languages/**',
			srcDir + '/font/**',
			srcDir + '/js/vendor/**',
			srcDir + '/**/*.txt',
			srcDir + '/**/*.md',
			srcDir + '/screenshot.png',
			srcDir + '/js/customizer.js',
			srcDir + '/editor-style.css',
			// srcDir + '/editor-style.css', // task css で処理する場合
		],
		dest: rootDir
	},
	css: {
		src: [ // この順に連結。かつ監視対象
			srcDir + '/scss/wp-comment-header.css',
			rootDir + '/dev/node_modules/normalize.css/normalize.css',
			srcDir + '/style.scss',
		],
		outputFile: 'style.css',
		dest: rootDir,
		watchSrc: [ // 追加の監視対象
			srcDir + '/scss/**'
		]
	},
	php: {
		srcRoot: srcDir,
		src: srcDir + '/**/*.php',
		dest: rootDir
	},
	images: {
		src: srcDir + '/img/**/*',// *.{jpg,jpeg,png}
		dest: rootDir + '/img/'
	}
};


/**
 * php
 *   説明
 */
export function php() {
	return gulp.src(paths.php.src, {base: paths.php.srcRoot, since: gulp.lastRun(php)}) //第二引数 { base: 'src' } でディレクトリ構造維持
		.pipe(plumber({errorHandler: (error) => { notify('php', error);}}))
		.pipe(gulp.dest(paths.php.dest));
}



/**
 * Clean
 *   dev ディレクトリ以外を全削除
 */
export const clean = () => del(
	paths.del,
	{
		force: true, // カレントディレクトリ以上を対象にするなら必要
		// dryRun: true
	}
).then(paths => {
	// eslint-disable-next-line no-console
	console.log('Files and folders that would be deleted:\n', paths.join('\n'));
});


/**
 * Copy
 *   コピー
 */
export function copy() {
	return gulp.src(paths.copy.src, {base: srcDir, since: gulp.lastRun(php)}) // baseオプションで階層維持
		.pipe(gulp.dest(paths.copy.dest));
	// .pipe(notify({ message: 'task "copy" complete' }));
}

copy.description = '静的ファイル(画像、フォント etc.)のコピー';
gulp.task('copy', copy);




/*
 * CSS
 */
export function css() {
	return gulp.src(paths.css.src)
		// .pipe(notify(paths.css.dest)) // Test
		.pipe(plumber({ // .pipe(plumber.stop()) でその箇所で停止できる
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))
		.pipe(sourcemaps.init()) // sourcemap がずれたら gulp-sass のcompressでなく gulp-minify-css を使うとよいらしい
		.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError)) //'compressed', 'expanded'
		.pipe(concat(paths.css.outputFile))
		// .pipe(replace('../font/', './font/')) // Webフォント open-iconic のパスを合わせる
		.pipe(postcss([
			// doiuse({
			//   browsers: [// 解説：https://parashuto.com/rriver/tools/using-custom-data-for-autoprefixer#default-queries
			//     'ie >= 10',
			//     '> 1% in JP',
			//     'last 2 versions',
			//     'Firefox ESR'
			//     //確認：http://browserl.ist/?q=%3E+1%25%2C+last+2+versions%2C+Firefox+ESR
			//     //サンプル：https://github.com/browserslist/browserslist#queries
			//   ],
			//   ignore: ['rem'],
			//   ignoreFiles: ['./node_modules/bootstrap/scss/*'],
			//   // onFeatureUsage: function (usageInfo) {
			//   //   console.log(usageInfo.message);
			//   // }
			// }),
			// postcssUncss({
			//   html: [rootDir + '/*.html'], // ※ php は対象ファイルとできないので、WordPress なら公開ページのURLを対象とすること
			//   // ignore: ['.fade']
			// }),
			autoprefixer({ grid: true }),
			cssMqpacker(),
			cssDeclarationSorter({order: 'smacss'}),
			// postcssStyleGuide({
			//   project: 'Project name',
			//   dest: '../styleguide/index.html',
			//   showCode: false,
			// }),
		]))
		.pipe(sourcemaps.write('.'))
		// .pipe(rename({
		//   basename: 'main',
		//   suffix: '.min'
		// }))
		.pipe(gulp.dest(paths.css.dest));
}
css.description = '変換：SCSS → CSS'; // gulp --tasks で注釈を表示


/**
 * Images 画像最適化
 */
export function images() {
	return gulp.src(paths.images.src, {since: gulp.lastRun(images)}) // lastRun は Task run time で判断。gulp-changed, gulp-newer など使う手も
		.pipe(imagemin(/*[
			imagemin.gifsicle({interlaced: true}),
			imagemin.jpegtran({progressive: true}),
			imagemin.optipng({optimizationLevel: 5}),
			imagemin.svgo({
				plugins: [
					{removeViewBox: true},
					{cleanupIDs: false}
				]
			})
		]*/))
		.pipe(gulp.dest(paths.images.dest));
}




/*
 * Watch 監視
 */
export function watch() {
	gulp.watch(paths.php.src, php);
	gulp.watch(paths.css.src, css);
	gulp.watch(paths.css.watchSrc, css);
	gulp.watch(paths.images.src, images);
}




/**
 * タスクのツリーを表示
 */
export function tree(cb) {
	// eslint-disable-next-line no-console
	console.log(gulp.tree({ deep: true }));
	cb();
}
// // eslint-disable-next-line no-console
// export const tree = () => console.log(gulp.tree({ deep: true }));



/*
 * Build
 */
const build = gulp.series(css, watch); // 並列処理の例：gulp.series(clean, gulp.parallel(styles, scripts));
gulp.task('build', build);
// function build(cb) {
//   gulp.series(css, tree);
//   cb();
// }
// export { build as build };



/*
 * Export a default task
 */
export default build;
