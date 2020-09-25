/******/ (function(modules) { // webpackBootstrap
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
/******/ 	return __webpack_require__(__webpack_require__.s = "./wp-content/themes/fictional-university theme/js/scripts.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./wp-content/themes/fictional-university theme/js/modules/MobileMenu.js":
/*!*******************************************************************************!*\
  !*** ./wp-content/themes/fictional-university theme/js/modules/MobileMenu.js ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\nvar MobileMenu = /*#__PURE__*/function () {\n  function MobileMenu() {\n    _classCallCheck(this, MobileMenu);\n\n    this.menu = document.querySelector(\".site-header__menu\");\n    this.openButton = document.querySelector(\".site-header__menu-trigger\");\n    this.events();\n  }\n\n  _createClass(MobileMenu, [{\n    key: \"events\",\n    value: function events() {\n      var _this = this;\n\n      this.openButton.addEventListener(\"click\", function () {\n        return _this.openMenu();\n      });\n    }\n  }, {\n    key: \"openMenu\",\n    value: function openMenu() {\n      this.openButton.classList.toggle(\"fa-bars\");\n      this.openButton.classList.toggle(\"fa-window-close\");\n      this.menu.classList.toggle(\"site-header__menu--active\");\n    }\n  }]);\n\n  return MobileMenu;\n}();\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (MobileMenu);\n\n//# sourceURL=webpack:///./wp-content/themes/fictional-university_theme/js/modules/MobileMenu.js?");

/***/ }),

/***/ "./wp-content/themes/fictional-university theme/js/scripts.js":
/*!********************************************************************!*\
  !*** ./wp-content/themes/fictional-university theme/js/scripts.js ***!
  \********************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _modules_MobileMenu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/MobileMenu */ \"./wp-content/themes/fictional-university theme/js/modules/MobileMenu.js\");\n// import '../css/style.css';\n//Our modules / classes\n // import HeroSlider from './modules/HeroSlider';\n// // Instantiate a new object using our modules/classes\n\nvar mobileMenu = new _modules_MobileMenu__WEBPACK_IMPORTED_MODULE_0__[\"default\"](); // var heroSlider = new HeroSlider();\n// Allow new JS and CSS to load in browser without a traditional page refresh\n\nif (false) {}\n\nalert('this is it');\n\n//# sourceURL=webpack:///./wp-content/themes/fictional-university_theme/js/scripts.js?");

/***/ })

/******/ });