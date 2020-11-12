(function(e, a) { for(var i in a) e[i] = a[i]; }(window, /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/view/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _arrayWithoutHoles(arr) {\n  if (Array.isArray(arr)) {\n    for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) {\n      arr2[i] = arr[i];\n    }\n\n    return arr2;\n  }\n}\n\nmodule.exports = _arrayWithoutHoles;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArray.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArray.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _iterableToArray(iter) {\n  if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === \"[object Arguments]\") return Array.from(iter);\n}\n\nmodule.exports = _iterableToArray;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/iterableToArray.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableSpread.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _nonIterableSpread() {\n  throw new TypeError(\"Invalid attempt to spread non-iterable instance\");\n}\n\nmodule.exports = _nonIterableSpread;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/nonIterableSpread.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toConsumableArray.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toConsumableArray.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var arrayWithoutHoles = __webpack_require__(/*! ./arrayWithoutHoles */ \"./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js\");\n\nvar iterableToArray = __webpack_require__(/*! ./iterableToArray */ \"./node_modules/@babel/runtime/helpers/iterableToArray.js\");\n\nvar nonIterableSpread = __webpack_require__(/*! ./nonIterableSpread */ \"./node_modules/@babel/runtime/helpers/nonIterableSpread.js\");\n\nfunction _toConsumableArray(arr) {\n  return arrayWithoutHoles(arr) || iterableToArray(arr) || nonIterableSpread();\n}\n\nmodule.exports = _toConsumableArray;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/toConsumableArray.js?");

/***/ }),

/***/ "./src/view/index.js":
/*!***************************!*\
  !*** ./src/view/index.js ***!
  \***************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/toConsumableArray */ \"./node_modules/@babel/runtime/helpers/toConsumableArray.js\");\n/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/dom-ready */ \"@wordpress/dom-ready\");\n/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./style.scss */ \"./src/view/style.scss\");\n/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_style_scss__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _patterns_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./patterns.scss */ \"./src/view/patterns.scss\");\n/* harmony import */ var _patterns_scss__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_patterns_scss__WEBPACK_IMPORTED_MODULE_3__);\n\n\n/**\n * WordPress dependencies\n */\n\n/**\n * Internal dependencies\n */\n\n\n\n\nvar values = function values(object) {\n  return Object.keys(object).map(function (key) {\n    return object[key];\n  });\n};\n\nvar performXHRequest = function performXHRequest(_ref) {\n  var url = _ref.url,\n      data = _ref.data;\n  var XHR = new XMLHttpRequest();\n  XHR.open('POST', url);\n  XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');\n  var encodedData = Object.keys(data).map(function (key) {\n    return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);\n  }).join('&').replace(/%20/g, '+');\n  XHR.send(encodedData);\n};\n\nvar getCookies = function getCookies() {\n  return document.cookie.split('; ').reduce(function (acc, cookieStr) {\n    var cookie = cookieStr.split('=');\n    acc[cookie[0]] = cookie[1];\n    return acc;\n  }, {});\n};\n\nvar processFormData = function processFormData(data, formElement) {\n  Object.keys(data).forEach(function (key) {\n    var value = data[key];\n\n    if (value === '${formFields[email]}') {\n      var inputEl = formElement.querySelector('[name=\"email\"]');\n\n      if (inputEl) {\n        value = inputEl.value;\n      }\n    }\n\n    if (value === 'CLIENT_ID( newspack-cid )' || value === 'CLIENT_ID(newspack-cid)') {\n      value = getCookies()['newspack-cid'];\n    }\n\n    data[key] = value;\n  });\n  return data;\n};\n\nvar manageAnalytics = function manageAnalytics() {\n  var ampAnalytics = _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(document.querySelectorAll('amp-analytics'));\n\n  ampAnalytics.forEach(function (ampAnalyticsElement) {\n    var _JSON$parse = JSON.parse(ampAnalyticsElement.children[0].innerText),\n        requests = _JSON$parse.requests,\n        triggers = _JSON$parse.triggers;\n\n    if (triggers && requests) {\n      var endpoint = requests.event;\n      values(triggers).forEach(function (trigger) {\n        if (trigger.on === 'amp-form-submit-success') {\n          var element = document.querySelector(trigger.selector);\n\n          if (element) {\n            element.addEventListener('submit', function () {\n              performXHRequest({\n                url: endpoint,\n                data: processFormData(trigger.extraUrlParams, element)\n              });\n            });\n          }\n        }\n      });\n    }\n  });\n};\n\nvar manageForms = function manageForms(container) {\n  var forms = _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(container.querySelectorAll('form.popup-action-form'));\n\n  forms.forEach(function (form) {\n    form.addEventListener('submit', function (event) {\n      var inputs = _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(form.querySelectorAll('input'));\n\n      var data = inputs.reduce(function (acc, input) {\n        acc[input.name] = input.value;\n        return acc;\n      }, {});\n      performXHRequest({\n        url: form.attributes['action-xhr'].value,\n        data: processFormData(data, form)\n      });\n      event.preventDefault();\n    });\n  });\n};\n\nif (typeof window !== 'undefined') {\n  _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1___default()(function () {\n    manageAnalytics();\n    var campaignArray = [].concat(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(document.querySelectorAll('.newspack-lightbox')), _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(document.querySelectorAll('.newspack-inline-popup')));\n    campaignArray.forEach(function (campaign) {\n      manageForms(campaign);\n    });\n  });\n}\n\n//# sourceURL=webpack:///./src/view/index.js?");

/***/ }),

/***/ "./src/view/patterns.scss":
/*!********************************!*\
  !*** ./src/view/patterns.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./src/view/patterns.scss?");

/***/ }),

/***/ "./src/view/style.scss":
/*!*****************************!*\
  !*** ./src/view/style.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./src/view/style.scss?");

/***/ }),

/***/ "@wordpress/dom-ready":
/*!*******************************************!*\
  !*** external {"this":["wp","domReady"]} ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = this[\"wp\"][\"domReady\"]; }());\n\n//# sourceURL=webpack:///external_%7B%22this%22:%5B%22wp%22,%22domReady%22%5D%7D?");

/***/ })

/******/ })));