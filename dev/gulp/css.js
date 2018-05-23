/**
 * CSS関連のタスク (css, css2, css_watch)
 * 注意：uncss がdist内のhtmlファイルを参照するので、htmlタスクの後に実行されるようにすること
 * 参考：@link: http://blog.flup.jp/2015/02/17/gulp_webpack_stylus/
 * ★★TODO: パーシャルの編集保存時、CSSタスクは実行されると出るが、実際は再変換していないのを修正
 * もしsourcemapがずれたらgulp-sassのcompressでなくgulp-minify-cssを使うとよい
 * ※ soucemapsはuncss非対応なのでソースマップが正常に生成されない → 解決案：分岐で本番用はsoucemapを無効、uncssを有効、開発はその逆
 */
import path from 'path';
import util from 'util';
import DefaultRegistry from 'undertaker-registry';

import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

/* postcss */
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import doiuse from 'doiuse';
import cssDeclarationSorter from 'css-declaration-sorter';
import cssMqpacker from 'css-mqpacker';
// import postcssUncss from 'postcss-uncss';
// import postcssStyleGuide from 'postcss-style-guide';







function css() {
  DefaultRegistry.call(this);
}
util.inherits(css, DefaultRegistry);

css.prototype.init = function(gulp) {

  const rootdir = path.resolve(__dirname + '/..');

  const paths = {
    css: {
      src: './src/style.scss', // 'src/styles/**/*.sass',
      dest: rootdir // + 'assets/styles/'
    }
  };

  gulp.task('css', function() {

    return gulp.src(paths.css.src)
      .pipe(sourcemaps.init())
      .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
      .pipe(postcss([
        doiuse({
          browsers: [// 解説：https://parashuto.com/rriver/tools/using-custom-data-for-autoprefixer#default-queries
            'ie >= 10',
            '> 1% in JP',
            'last 2 versions',
            'Firefox ESR'
            //確認：http://browserl.ist/?q=%3E+1%25%2C+last+2+versions%2C+Firefox+ESR
            //サンプル：https://github.com/browserslist/browserslist#queries
          ],
          ignore: ['rem'],
          // ignoreFiles: ['**/normalize.css'],
          // onFeatureUsage: function (usageInfo) {
          //   console.log(usageInfo.message);
          // }
        }),
        // postcssUncss({
        //   html: [rootdir + '/*.html'], // ※ php は対象ファイルとできないので、WordPress なら公開ページのURLを対象とすること
        //   // ignore: ['.fade']
        // }),
        autoprefixer(),
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

  });
  // // 複数タスクの登録も可能
  // gulp.task('clean', function(done) {
  //   done();
  // });
};

module.exports = new css();
