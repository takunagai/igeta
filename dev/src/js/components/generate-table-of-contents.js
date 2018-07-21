/**
 * 目次の生成 (目次にしたい要素が1つなら非表示、2つ以上で表示される)
 *
 * @param {String} str 目次にしたい要素。無ければデフォルト値 "article h2" が適用
 * Usage : テンプレートの目次を設置したい箇所に <div class="page-index"></div> を設置
 * @author taku_n
 * @url TODO: https://gist.github.com/
 * 参考：http://www.jankoatwarpspeed.com/examples/table-of-contents/demo1.html
 * 発展：TODO: 開閉パネル、右フロートのパターンもパラメータでできたらいいかも
 */
module.exports = function(settings) {

	// デフォルト値の設定
	const displayArea = $(settings.displayArea) || $('.page-index'),
		headers   = $(settings.headersIntoIndex) || $('article h2'),
		title     = settings.title || '<p>このページの目次 <small>(クリックで移動)</small></p>';
		// isCollapse  = settings.isCollapse || false,
		// isFloat   = settings.isFloat || false;

	// 処理
	if(headers.length >= 2) {
		const elm = $('<ul />');
		headers.each(function(i) {
			const current = $(this);
			const currentText = current.html().replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'');//HTMLタグを削除
			current.attr('id', 'chapter_' + i);
			elm.append('<li><a href="#chapter_' + i + '">' + currentText + '</a></li>');
		});
		displayArea
			.append(title)
			.append(elm);
		return false;
	}
	else {
		displayArea.css('display', 'none');
	}

};
