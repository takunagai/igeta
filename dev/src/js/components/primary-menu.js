/**
 * メインメニュー
 * primary-menu
 * @link: http://www.webopixel.net/javascript/1060.html
 */
module.exports = function() {

	const browserWindowSize = document.body.clientWidth, // ブラウザのサイズ。スクロールバーを含めるなら outerWidth
		breakpoint = 769;
	// alert(browserWindowSize);

	if ( browserWindowSize <= breakpoint ) {
		$('#primary-menu-toggle-button').click(function() {
			$('#primary-menu').toggleClass('primary-menu--open');
			$('#primary-menu-toggle-button').toggleClass('primary-menu-toggle-button--open');
		});
	}
};
