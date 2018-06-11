// @file: scroll.js
// TODO: jQueryで生成した目次リンクがスクロール移動にならないのを直すこと
import { throttle } from 'throttle-debounce';// { throttle, debounce }


module.exports = function(setting) {

	const myTouch = ('ontouchstart' in document) ? 'touchstart' : 'click',
		buttonSelector = setting.topLinkButtonID || '#move-to-page-top';//デフォルト値

	/**
	* ページ内スムーススクロール
	*     注意：単純にアローファンクションに置き換えたら動かない
	*     http://shirusu-ni-tarazu.hatenablog.jp/entry/2016/02/15/020322
	*/
	const headerHeight = 54; // 固定ヘッダー等の高さ(px) TODO: うまく処理するように

	$('[href^="#"]').on(myTouch, function(e) {
		e.preventDefault();
		const href= $(this).attr('href'),
			target = $(href === '#top' || href === '#' || href === '' ? 'html' : href),
			isSafari = /Safari/.test(navigator.userAgent);

		$(isSafari ? 'body' : 'html').animate({scrollTop: target.offset().top - headerHeight}, 'slow');//default 400, 'swing'
	});


	/**
	 * ページ上部へ戻るボタン
	 *     画面右下固定表示。画面の高さ以上/以下のスクロールで表示/非表示
	 *     HTML: <p id="move-to-page-top"><a href="#top"><i class="fa fa-chevron-up"></i>このページTopへ</a></p>
	 *     throttle でスクロールでの発火頻度を抑制
	*/
	// Setting
	const topBtn = $(buttonSelector),//ページTopに戻るボタン
		windowHeight = (window.innerHeight || document.documentElement.clientHeight || 0);//ウインドウの高さ

	// ウインドウの高さ以上スクロールさせると表示、以下なら非表示
	// scrollイベントは500ミリ秒ごとに発火(依存)
	window.addEventListener('scroll', throttle(500, function() {
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		if (scrollTop > windowHeight){
			topBtn.fadeIn();
		}
		else {
			topBtn.fadeOut();
		}
	}), false);

	// // jQuery + lodash(Underscore.js) の throttle を使う場合
	// //     lodash(Underscore.js) の throttleメソッドで処理頻度を抑制
	// //         @link: https://gist.github.com/takunagai/457302aaa44421bbc958
	// //         @link: http://codepen.io/oreo3/pen/JjHDz
	// $(window).scroll(_.throttle(function(){
	//   if ($(window).scrollTop() > windowHeight){
	//     topBtn.fadeIn();
	//   }
	//   else {
	//     topBtn.fadeOut();
	//   }
	// }, 500));

};
