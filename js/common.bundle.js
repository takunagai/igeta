/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"common": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./src/js/common.js","vendor"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/common.js":
/*!**************************!*\
  !*** ./src/js/common.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\n__webpack_require__(/*! ./skip-link-focus-fix */ \"./src/js/skip-link-focus-fix.js\");\n\nvar _stickySidebar = __webpack_require__(/*! sticky-sidebar */ \"./node_modules/sticky-sidebar/src/sticky-sidebar.js\");\n\nvar _stickySidebar2 = _interopRequireDefault(_stickySidebar);\n\nvar _generateTableOfContents = __webpack_require__(/*! ./components/generate-table-of-contents */ \"./src/js/components/generate-table-of-contents.js\");\n\nvar _generateTableOfContents2 = _interopRequireDefault(_generateTableOfContents);\n\nvar _scroll = __webpack_require__(/*! ./components/scroll */ \"./src/js/components/scroll.js\");\n\nvar _scroll2 = _interopRequireDefault(_scroll);\n\nvar _primaryMenu = __webpack_require__(/*! ./components/primary-menu */ \"./src/js/components/primary-menu.js\");\n\nvar _primaryMenu2 = _interopRequireDefault(_primaryMenu);\n\nvar _browserHack = __webpack_require__(/*! ./components/browser-hack */ \"./src/js/components/browser-hack.js\");\n\nvar _browserHack2 = _interopRequireDefault(_browserHack);\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\n// 自前モジュール群\n// @file commons.js\n\n/**\n * 共通のスクリプト\n *\n *\n */\n\n// WordPress _s theme\n//     バックエンドのみで必要な customizer.js は、統合せず単独で使う\n// import './navigation';\ndocument.addEventListener('DOMContentLoaded', function () {\n\n\t/**\n  * メインメニュー\n  */\n\t(0, _primaryMenu2.default)({});\n\n\t/**\n  * generateTableOfContents (ページコンテンツの見出しから目次を生成)\n  */\n\t(0, _generateTableOfContents2.default)({\n\t\theadersIntoIndex: 'article h2', // 目次にしたい見出し要素を指定。デフォルトは article h2\n\t\tdisplayArea: '.page-index' // 表示エリアの要素を指定。デフォルトは .page-index\n\t\t//title: '<p>タイトル</p>',// 見出し(HTMLタグも付けること)。デフォルト値はコード参照\n\t\t//isCollapse: true,// 開閉パネルにするか？\n\t\t//isFloat: false// 右フロートにするか？\n\t});\n\t(0, _scroll2.default)({ topLinkButtonID: '#move-to-page-top' }); // topへ戻るボタンのID。デフォルトは #move-to-page-top\n\n\n\t/**\n  * Sticky Sidebar サイドバーのスクロール追従 (jQuery非依存)\n  *     https://abouolia.github.io/sticky-sidebar/\n  * TODO: モバイル表示時は実行させない\n  */\n\t/* eslint no-unused-vars: 0 */\n\tvar sidebar = new _stickySidebar2.default('.sticky-sidebar', { // #sidebar\n\t\tcontainerSelector: '#primary', // #main-content\n\t\tinnerWrapperSelector: '.sticky-sidebar__inner', // .sidebar__inner\n\t\tminWidth: 992, // TODO: 992px付近でうまく動作しない。modernizrで分岐させても同様だった\n\t\ttopSpacing: 32,\n\t\tbottomSpacing: 32\n\t});\n\n\t/**\n  * Browser Hack\n  */\n\t(0, _browserHack2.default)();\n}, false);\n\n// Vendor\n// jquery は ProvidePlugin() で読み込んでいる\n\n//# sourceURL=webpack:///./src/js/common.js?");

/***/ }),

/***/ "./src/js/components/browser-hack.js":
/*!*******************************************!*\
  !*** ./src/js/components/browser-hack.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nmodule.exports = function () {\n\n\t/**\n * BROWSERHACKS\n *     @link https://qiita.com/hashrock/items/189db03021b0f565ae27#2-align-itemscenter-%E3%81%AF%E3%81%BF%E5%87%BA%E3%81%99%E5%95%8F%E9%A1%8C\n *     @link http://browserhacks.com\n *     @link https://github.com/saadeghi/browser-hack-sass-mixins\n */\n\n\tvar mediaImages = document.getElementsByClassName('media__img');\n\tconsole.log(mediaImages[0]);\n\tfor (var i = 0; i < mediaImages.length; i++) {\n\t\tmediaImages[i].classList.remove('media__img');\n\t\tmediaImages[i].outerHTML = '<div class=\"media__img\">' + mediaImages[i].outerHTML + '</div>'; // = jQuery: $( \".inner\" ).wrap( \"<div class='new'></div>\" );\n\t}\n};\n\n//# sourceURL=webpack:///./src/js/components/browser-hack.js?");

/***/ }),

/***/ "./src/js/components/generate-table-of-contents.js":
/*!*********************************************************!*\
  !*** ./src/js/components/generate-table-of-contents.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("/* WEBPACK VAR INJECTION */(function($) {\n\n/**\n * 目次の生成 (目次にしたい要素が1つなら非表示、2つ以上で表示される)\n *\n * @param {String} str 目次にしたい要素。無ければデフォルト値 \"article h2\" が適用\n * Usage : テンプレートの目次を設置したい箇所に <div class=\"page-index\"></div> を設置\n * @author taku_n\n * @url TODO: https://gist.github.com/\n * 参考：http://www.jankoatwarpspeed.com/examples/table-of-contents/demo1.html\n * 発展：TODO: 開閉パネル、右フロートのパターンもパラメータでできたらいいかも\n */\nmodule.exports = function (settings) {\n\n\t// デフォルト値の設定\n\tvar displayArea = $(settings.displayArea) || $('.page-index'),\n\t    headers = $(settings.headersIntoIndex) || $('article h2'),\n\t    title = settings.title || '<p>このページの目次 <small>(クリックで移動)</small></p>';\n\t// isCollapse  = settings.isCollapse || false,\n\t// isFloat   = settings.isFloat || false;\n\n\t// 処理\n\tif (headers.length >= 2) {\n\t\tvar elm = $('<ul />');\n\t\theaders.each(function (i) {\n\t\t\tvar current = $(this);\n\t\t\tvar currentText = current.html().replace(/<(\"[^\"]*\"|'[^']*'|[^'\">])*>/g, ''); //HTMLタグを削除\n\t\t\tcurrent.attr('id', 'chapter_' + i);\n\t\t\telm.append('<li><a href=\"#chapter_' + i + '\">' + currentText + '</a></li>');\n\t\t});\n\t\tdisplayArea.append(title).append(elm);\n\t\treturn false;\n\t} else {\n\t\tdisplayArea.css('display', 'none');\n\t}\n};\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/generate-table-of-contents.js?");

/***/ }),

/***/ "./src/js/components/primary-menu.js":
/*!*******************************************!*\
  !*** ./src/js/components/primary-menu.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("/* WEBPACK VAR INJECTION */(function($) {\n\n/**\n * メインメニュー\n * primary-menu\n * @link: http://www.webopixel.net/javascript/1060.html\n */\nmodule.exports = function () {\n\n\tvar browserWindowSize = document.body.clientWidth,\n\t    // ブラウザのサイズ。スクロールバーを含めるなら outerWidth\n\tbreakpoint = 769;\n\t// alert(browserWindowSize);\n\n\tif (browserWindowSize <= breakpoint) {\n\t\t$('#primary-menu-toggle-button').click(function () {\n\t\t\t$('#primary-menu').toggleClass('primary-menu--open');\n\t\t\t$('#primary-menu-toggle-button').toggleClass('primary-menu-toggle-button--open');\n\t\t});\n\t}\n};\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/primary-menu.js?");

/***/ }),

/***/ "./src/js/components/scroll.js":
/*!*************************************!*\
  !*** ./src/js/components/scroll.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("/* WEBPACK VAR INJECTION */(function($) {\n\nvar _throttleDebounce = __webpack_require__(/*! throttle-debounce */ \"./node_modules/throttle-debounce/index.esm.js\");\n\n// { throttle, debounce }\n\n\nmodule.exports = function (setting) {\n\n\tvar myTouch = 'ontouchstart' in document ? 'touchstart' : 'click',\n\t    buttonSelector = setting.topLinkButtonID || '#move-to-page-top'; //デフォルト値\n\n\t/**\n * ページ内スムーススクロール\n *     注意：単純にアローファンクションに置き換えたら動かない\n *     http://shirusu-ni-tarazu.hatenablog.jp/entry/2016/02/15/020322\n */\n\tvar headerHeight = 54; // 固定ヘッダー等の高さ(px) TODO: うまく処理するように\n\n\t$('[href^=\"#\"]').on(myTouch, function (e) {\n\t\te.preventDefault();\n\t\tvar href = $(this).attr('href'),\n\t\t    target = $(href === '#top' || href === '#' || href === '' ? 'html' : href),\n\t\t    isSafari = /Safari/.test(navigator.userAgent);\n\n\t\t$(isSafari ? 'body' : 'html').animate({ scrollTop: target.offset().top - headerHeight }, 'slow'); //default 400, 'swing'\n\t});\n\n\t/**\n  * ページ上部へ戻るボタン\n  *     画面右下固定表示。画面の高さ以上/以下のスクロールで表示/非表示\n  *     HTML: <p id=\"move-to-page-top\"><a href=\"#top\"><i class=\"fa fa-chevron-up\"></i>このページTopへ</a></p>\n  *     throttle でスクロールでの発火頻度を抑制\n */\n\t// Setting\n\tvar topBtn = $(buttonSelector),\n\t    //ページTopに戻るボタン\n\twindowHeight = window.innerHeight || document.documentElement.clientHeight || 0; //ウインドウの高さ\n\n\t// ウインドウの高さ以上スクロールさせると表示、以下なら非表示\n\t// scrollイベントは500ミリ秒ごとに発火(依存)\n\twindow.addEventListener('scroll', (0, _throttleDebounce.throttle)(500, function () {\n\t\tvar scrollTop = window.pageYOffset || document.documentElement.scrollTop;\n\t\tif (scrollTop > windowHeight) {\n\t\t\ttopBtn.fadeIn();\n\t\t} else {\n\t\t\ttopBtn.fadeOut();\n\t\t}\n\t}), false);\n\n\t// // jQuery + lodash(Underscore.js) の throttle を使う場合\n\t// //     lodash(Underscore.js) の throttleメソッドで処理頻度を抑制\n\t// //         @link: https://gist.github.com/takunagai/457302aaa44421bbc958\n\t// //         @link: http://codepen.io/oreo3/pen/JjHDz\n\t// $(window).scroll(_.throttle(function(){\n\t//   if ($(window).scrollTop() > windowHeight){\n\t//     topBtn.fadeIn();\n\t//   }\n\t//   else {\n\t//     topBtn.fadeOut();\n\t//   }\n\t// }, 500));\n}; // @file: scroll.js\n// TODO: jQueryで生成した目次リンクがスクロール移動にならないのを直すこと\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/scroll.js?");

/***/ }),

/***/ "./src/js/skip-link-focus-fix.js":
/*!***************************************!*\
  !*** ./src/js/skip-link-focus-fix.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\n/**\n * File skip-link-focus-fix.js.\n *\n * Helps with accessibility for keyboard only users.\n *\n * Learn more: https://git.io/vWdr2\n */\n(function () {\n\tvar isIe = /(trident|msie)/i.test(navigator.userAgent);\n\n\tif (isIe && document.getElementById && window.addEventListener) {\n\t\twindow.addEventListener('hashchange', function () {\n\t\t\tvar id = location.hash.substring(1),\n\t\t\t    element;\n\n\t\t\tif (!/^[A-z0-9_-]+$/.test(id)) {\n\t\t\t\treturn;\n\t\t\t}\n\n\t\t\telement = document.getElementById(id);\n\n\t\t\tif (element) {\n\t\t\t\tif (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {\n\t\t\t\t\telement.tabIndex = -1;\n\t\t\t\t}\n\n\t\t\t\telement.focus();\n\t\t\t}\n\t\t}, false);\n\t}\n})();\n\n//# sourceURL=webpack:///./src/js/skip-link-focus-fix.js?");

/***/ })

/******/ });