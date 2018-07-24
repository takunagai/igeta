// @file commons.js

/**
 * 共通のスクリプト
 *
 *
 */

// WordPress _s theme
//     バックエンドのみで必要な customizer.js は、統合せず単独で使う
// import './navigation';
import './skip-link-focus-fix';

// Vendor
// jquery は ProvidePlugin() で読み込んでいる
import StickySidebar from 'sticky-sidebar';

// 自前モジュール群
import generateTableOfContents from './components/generate-table-of-contents';
import scroll                  from './components/scroll';
import primaryMenu             from './components/primary-menu';
import browserHack             from './components/browser-hack';



document.addEventListener('DOMContentLoaded', function(){

	/**
	 * メインメニュー
	 */
	primaryMenu({});


	/**
	 * generateTableOfContents (ページコンテンツの見出しから目次を生成)
	 */
	generateTableOfContents({
		headersIntoIndex: 'article h2',// 目次にしたい見出し要素を指定。デフォルトは article h2
		displayArea: '.page-index',// 表示エリアの要素を指定。デフォルトは .page-index
		//title: '<p>タイトル</p>',// 見出し(HTMLタグも付けること)。デフォルト値はコード参照
		//isCollapse: true,// 開閉パネルにするか？
		//isFloat: false// 右フロートにするか？
	});
	scroll({ topLinkButtonID: '#move-to-page-top' }); // topへ戻るボタンのID。デフォルトは #move-to-page-top


	/**
	 * Sticky Sidebar サイドバーのスクロール追従 (jQuery非依存)
	 *     https://abouolia.github.io/sticky-sidebar/
	 * TODO: モバイル表示時は実行させない
	 */
	/* eslint no-unused-vars: 0 */
	const sidebar = new StickySidebar('.sticky-sidebar', {// #sidebar
		containerSelector: '#primary', // #main-content
		innerWrapperSelector: '.sticky-sidebar__inner', // .sidebar__inner
		minWidth: 992, // TODO: 992px付近でうまく動作しない。modernizrで分岐させても同様だった
		topSpacing: 32,
		bottomSpacing: 32
	});

	/**
	 * Browser Hack
	 */
	browserHack();

}, false);
