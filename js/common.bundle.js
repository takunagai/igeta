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
/******/
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
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./skip-link-focus-fix */ \"./src/js/skip-link-focus-fix.js\");\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var sticky_sidebar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! sticky-sidebar */ \"./node_modules/sticky-sidebar/src/sticky-sidebar.js\");\n/* harmony import */ var _components_generate_table_of_contents__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/generate-table-of-contents */ \"./src/js/components/generate-table-of-contents.js\");\n/* harmony import */ var _components_generate_table_of_contents__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_components_generate_table_of_contents__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _components_scroll__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/scroll */ \"./src/js/components/scroll.js\");\n/* harmony import */ var _components_primary_menu__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/primary-menu */ \"./src/js/components/primary-menu.js\");\n/* harmony import */ var _components_primary_menu__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_components_primary_menu__WEBPACK_IMPORTED_MODULE_4__);\n/* harmony import */ var _components_browser_hack__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/browser-hack */ \"./src/js/components/browser-hack.js\");\n/* harmony import */ var _components_browser_hack__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_components_browser_hack__WEBPACK_IMPORTED_MODULE_5__);\n// @file commons.js\n\n/**\n * 共通のスクリプト\n *\n * - メインメニュー\n */\n// WordPress _s theme\n//     バックエンドのみで必要な customizer.js は、統合せず単独で使う\n// import './navigation';\n // Vendor\n// jquery は ProvidePlugin() で読み込んでいる\n\n // 自前モジュール群\n\n\n\n\n\ndocument.addEventListener('DOMContentLoaded', function () {\n  /**\n   * メインメニュー\n   */\n  _components_primary_menu__WEBPACK_IMPORTED_MODULE_4___default()({});\n  /**\n   * generateTableOfContents (ページコンテンツの見出しから目次を生成)\n   */\n\n  _components_generate_table_of_contents__WEBPACK_IMPORTED_MODULE_2___default()({\n    headersIntoIndex: 'article h2',\n    // 目次にしたい見出し要素を指定。デフォルトは article h2\n    displayArea: '.page-index' // 表示エリアの要素を指定。デフォルトは .page-index\n    //title: '<p>タイトル</p>',// 見出し(HTMLタグも付けること)。デフォルト値はコード参照\n    //isCollapse: true,// 開閉パネルにするか？\n    //isFloat: false// 右フロートにするか？\n\n  });\n  Object(_components_scroll__WEBPACK_IMPORTED_MODULE_3__[\"default\"])({\n    topLinkButtonID: '#move-to-page-top'\n  }); // topへ戻るボタンのID。デフォルトは #move-to-page-top\n\n  /**\n   * Sticky Sidebar サイドバーのスクロール追従 (jQuery非依存)\n   *     https://abouolia.github.io/sticky-sidebar/\n   * TODO: モバイル表示時は実行させない\n   */\n\n  /* eslint no-unused-vars: 0 */\n\n  var sidebar = document.getElementsByClassName('sticky-sidebar');\n\n  if (sidebar.length) {\n    var mainAreaHeight = document.getElementById('primary__inner').clientHeight,\n        sidebarHeight = document.getElementsByClassName('sticky-sidebar__inner')[0].clientHeight;\n\n    if (mainAreaHeight > sidebarHeight) {\n      // メインエリアの高さがサイドバーよりも低い場合にチラつく減少を防止するため\n      var _sidebar = new sticky_sidebar__WEBPACK_IMPORTED_MODULE_1__[\"default\"]('.sticky-sidebar', {\n        // #sidebar\n        containerSelector: '#primary',\n        // #main-content\n        innerWrapperSelector: '.sticky-sidebar__inner',\n        // .sidebar__inner\n        minWidth: 992,\n        // TODO: 992px付近でうまく動作しない。modernizrで分岐させても同様だった\n        topSpacing: 32,\n        bottomSpacing: 32 // ,resizeSensor: true, // Default: true\n        // stickyClass: 'is-affixed', // Default: is-affixed\n\n      });\n    }\n  }\n  /**\n   * Browser Hack\n   */\n\n\n  _components_browser_hack__WEBPACK_IMPORTED_MODULE_5___default()();\n}, false);\n\n//# sourceURL=webpack:///./src/js/common.js?");

/***/ }),

/***/ "./src/js/components/browser-hack.js":
/*!*******************************************!*\
  !*** ./src/js/components/browser-hack.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = function () {\n  /**\n  * BROWSERHACKS\n  *     @link https://qiita.com/hashrock/items/189db03021b0f565ae27#2-align-itemscenter-%E3%81%AF%E3%81%BF%E5%87%BA%E3%81%99%E5%95%8F%E9%A1%8C\n  *     @link http://browserhacks.com\n  *     @link https://github.com/saadeghi/browser-hack-sass-mixins\n  */\n  var mediaImages = document.getElementsByClassName('media__img');\n\n  if (typeof mediaImages == 'undefined') {\n    for (var i = 0; i < mediaImages.length; i++) {\n      mediaImages[i].classList.remove('media__img');\n      mediaImages[i].outerHTML = '<div class=\"media__img\">' + mediaImages[i].outerHTML + '</div>'; // = jQuery: $( \".inner\" ).wrap( \"<div class='new'></div>\" );\n    }\n  }\n};\n\n//# sourceURL=webpack:///./src/js/components/browser-hack.js?");

/***/ }),

/***/ "./src/js/components/generate-table-of-contents.js":
/*!*********************************************************!*\
  !*** ./src/js/components/generate-table-of-contents.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("/* WEBPACK VAR INJECTION */(function($) {/**\n * 目次の生成\n *     目次にしたい要素が1つなら非表示、2つ以上で表示される\n *     手動で目次を入れた場合はヘッダーのID付加しかしない\n *\n * @param {String} str 目次にしたい要素。無ければデフォルト値 \"article h2\" が適用\n * Usage : テンプレートの目次を設置したい箇所に <div class=\"page-index\"></div> を設置\n * @author taku_n\n * @url TODO: https://gist.github.com/\n * 参考：http://www.jankoatwarpspeed.com/examples/table-of-contents/demo1.html\n * 発展：TODO: 開閉パネル、右フロートのパターンもパラメータでできたらいいかも\n */\nmodule.exports = function (settings) {\n  // if ( document.querySelector('.page-index ul') != null ) {\n  if ($('.page-index')[0]) {\n    // デフォルト値の設定\n    var displayArea = $(settings.displayArea) || $('.page-index'),\n        headers = $(settings.headersIntoIndex) || $('article h2'),\n        title = settings.title || '<p>このページの目次 <small>(クリックで移動)</small></p>'; // isCollapse  = settings.isCollapse || false,\n    // isFloat   = settings.isFloat || false;\n    // 処理\n\n    if (headers.length >= 2) {\n      if (!$('.page-index ul')[0]) {\n        var elm = $('<ul />');\n        headers.each(function (i) {\n          var current = $(this);\n          var currentText = current.html().replace(/<(\"[^\"]*\"|'[^']*'|[^'\">])*>/g, ''); //HTMLタグを削除\n\n          current.attr('id', 'chapter_' + i);\n          elm.append('<li><a href=\"#chapter_' + i + '\">' + currentText + '</a></li>');\n        });\n        displayArea.append(title).append(elm);\n        return false;\n      } else {\n        headers.each(function (i) {\n          var current = $(this);\n          current.attr('id', 'chapter_' + i);\n        });\n        return false;\n      }\n    } else {\n      displayArea.css('display', 'none');\n    }\n  }\n};\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/generate-table-of-contents.js?");

/***/ }),

/***/ "./src/js/components/primary-menu.js":
/*!*******************************************!*\
  !*** ./src/js/components/primary-menu.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("/* WEBPACK VAR INJECTION */(function($) {/**\n * メインメニュー\n * primary-menu\n * @link: http://www.webopixel.net/javascript/1060.html\n */\nmodule.exports = function () {\n  var browserWindowSize = document.body.clientWidth,\n      // ブラウザのサイズ。スクロールバーを含めるなら outerWidth\n  breakpoint = 769; // alert(browserWindowSize);\n\n  if (browserWindowSize <= breakpoint) {\n    $('#primary-menu-toggle-button').click(function () {\n      $('#primary-menu').toggleClass('primary-menu--open');\n      $('#primary-menu-toggle-button').toggleClass('primary-menu-toggle-button--open');\n    });\n  }\n};\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/primary-menu.js?");

/***/ }),

/***/ "./src/js/components/scroll.js":
/*!*************************************!*\
  !*** ./src/js/components/scroll.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var throttle_debounce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! throttle-debounce */ \"./node_modules/throttle-debounce/dist/index.esm.js\");\n// @file: scroll.js\n// TODO: jQueryで生成した目次リンクがスクロール移動にならないのを直すこと\n // { throttle, debounce }\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (setting) {\n  // module.exports = function(setting) {\n  var myTouch = 'ontouchstart' in document ? 'touchstart' : 'click',\n      buttonSelector = setting.topLinkButtonID || '#move-to-page-top'; //デフォルト値\n\n  /**\n  * ページ内スムーススクロール\n  *     注意：単純にアローファンクションに置き換えたら動かない\n  *     http://shirusu-ni-tarazu.hatenablog.jp/entry/2016/02/15/020322\n  */\n\n  var headerHeight = 54; // 固定ヘッダー等の高さ(px) TODO: うまく処理するように\n\n  $('[href^=\"#\"]').on(myTouch, function (e) {\n    e.preventDefault();\n    var href = $(this).attr('href'),\n        target = $(href === '#top' || href === '#' || href === '' ? 'html' : href),\n        isSafari = /Safari/.test(navigator.userAgent);\n    $(isSafari ? 'body' : 'html').animate({\n      scrollTop: target.offset().top - headerHeight\n    }, 'slow'); //default 400, 'swing'\n  });\n  /**\n   * ページ上部へ戻るボタン\n   *     画面右下固定表示。画面の高さ以上/以下のスクロールで表示/非表示\n   *     HTML: <p id=\"move-to-page-top\"><a href=\"#top\"><i class=\"fa fa-chevron-up\"></i>このページTopへ</a></p>\n   *     throttle でスクロールでの発火頻度を抑制\n  */\n  // Setting\n\n  var topBtn = $(buttonSelector),\n      //ページTopに戻るボタン\n  windowHeight = window.innerHeight || document.documentElement.clientHeight || 0; //ウインドウの高さ\n  // ウインドウの高さ以上スクロールさせると表示、以下なら非表示\n  // scrollイベントは500ミリ秒ごとに発火(依存)\n\n  window.addEventListener('scroll', Object(throttle_debounce__WEBPACK_IMPORTED_MODULE_0__[\"throttle\"])(500, function () {\n    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;\n\n    if (scrollTop > windowHeight) {\n      topBtn.fadeIn();\n    } else {\n      topBtn.fadeOut();\n    }\n  }), false); // // jQuery + lodash(Underscore.js) の throttle を使う場合\n  // //     lodash(Underscore.js) の throttleメソッドで処理頻度を抑制\n  // //         @link: https://gist.github.com/takunagai/457302aaa44421bbc958\n  // //         @link: http://codepen.io/oreo3/pen/JjHDz\n  // $(window).scroll(_.throttle(function(){\n  //   if ($(window).scrollTop() > windowHeight){\n  //     topBtn.fadeIn();\n  //   }\n  //   else {\n  //     topBtn.fadeOut();\n  //   }\n  // }, 500));\n});\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./src/js/components/scroll.js?");

/***/ }),

/***/ "./src/js/skip-link-focus-fix.js":
/*!***************************************!*\
  !*** ./src/js/skip-link-focus-fix.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * File skip-link-focus-fix.js.\n *\n * Helps with accessibility for keyboard only users.\n *\n * Learn more: https://git.io/vWdr2\n */\n(function () {\n  var isIe = /(trident|msie)/i.test(navigator.userAgent);\n\n  if (isIe && document.getElementById && window.addEventListener) {\n    window.addEventListener('hashchange', function () {\n      var id = location.hash.substring(1),\n          element;\n\n      if (!/^[A-z0-9_-]+$/.test(id)) {\n        return;\n      }\n\n      element = document.getElementById(id);\n\n      if (element) {\n        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {\n          element.tabIndex = -1;\n        }\n\n        element.focus();\n      }\n    }, false);\n  }\n})();\n\n//# sourceURL=webpack:///./src/js/skip-link-focus-fix.js?");

/***/ })

/******/ });