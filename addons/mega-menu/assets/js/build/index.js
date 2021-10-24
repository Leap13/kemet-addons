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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _arrayWithoutHoles(arr) {
  if (Array.isArray(arr)) return arrayLikeToArray(arr);
}

module.exports = _arrayWithoutHoles;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/asyncToGenerator.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

module.exports = _asyncToGenerator;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

module.exports = _defineProperty;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArray.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArray.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArray(iter) {
  if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
}

module.exports = _iterableToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArrayLimit(arr, i) {
  var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"];

  if (_i == null) return;
  var _arr = [];
  var _n = true;
  var _d = false;

  var _s, _e;

  try {
    for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

module.exports = _iterableToArrayLimit;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableRest;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableSpread.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableSpread;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js");

var iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit.js */ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableRest = __webpack_require__(/*! ./nonIterableRest.js */ "./node_modules/@babel/runtime/helpers/nonIterableRest.js");

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toConsumableArray.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toConsumableArray.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithoutHoles = __webpack_require__(/*! ./arrayWithoutHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js");

var iterableToArray = __webpack_require__(/*! ./iterableToArray.js */ "./node_modules/@babel/runtime/helpers/iterableToArray.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableSpread = __webpack_require__(/*! ./nonIterableSpread.js */ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js");

function _toConsumableArray(arr) {
  return arrayWithoutHoles(arr) || iterableToArray(arr) || unsupportedIterableToArray(arr) || nonIterableSpread();
}

module.exports = _toConsumableArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./src/components/Options.js":
/*!***********************************!*\
  !*** ./src/components/Options.js ***!
  \***********************************/
/*! exports provided: isDisplay, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isDisplay", function() { return isDisplay; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _store_options_context__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../store/options-context */ "./src/store/options-context.js");
/* harmony import */ var _Tabs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Tabs */ "./src/components/Tabs.js");




var isDisplay = function isDisplay(rules, values) {
  var depth = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;

  if (!values) {
    return;
  }

  var relation = undefined != rules.relation ? rules.relation : "AND",
      isVisible = "AND" === relation ? true : false;

  _.each(rules, function (rule, ruleKey) {
    if ("relation" == ruleKey) {
      return;
    }

    var boolean = false,
        operator = undefined != rule.operator ? rule.operator : "=",
        ruleValue = rule.value;
    var settingValue = rule.setting === 'depth' ? depth : values[rule.setting];

    switch (operator) {
      case "in_array":
        boolean = ruleValue.includes(settingValue);
        break;

      case "contain":
        boolean = settingValue.includes(ruleValue);
        break;

      case ">":
        boolean = settingValue > ruleValue;
        break;

      case "<":
        boolean = settingValue < ruleValue;
        break;

      case ">=":
        boolean = settingValue >= ruleValue;
        break;

      case "<=":
        boolean = settingValue <= ruleValue;
        break;

      case "not_empty":
        boolean = typeof settingValue !== "undefined" && undefined !== settingValue && null !== settingValue && "" !== settingValue;
        break;

      case "!=":
        boolean = settingValue !== ruleValue;
        break;

      default:
        boolean = settingValue == ruleValue;
        break;
    }

    isVisible = "OR" === relation ? isVisible || boolean : isVisible && boolean;
  });

  return isVisible;
};

var SingleOptionComponent = function SingleOptionComponent(_ref) {
  var value = _ref.value,
      optionId = _ref.optionId,
      option = _ref.option,
      onChange = _ref.onChange;

  var _useContext = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useContext"])(_store_options_context__WEBPACK_IMPORTED_MODULE_1__["default"]),
      itemId = _useContext.itemId;

  var OptionComponent = window.KmtOptionComponent.OptionComponent;
  var Option = option.type === 'kmt-tabs' ? _Tabs__WEBPACK_IMPORTED_MODULE_2__["default"] : OptionComponent(option.type);
  var divider = option.divider ? 'has-divider' : '';

  if (optionId === 'column-template') {
    var event = new CustomEvent("KemetInitMenuOptions", {
      detail: {
        itemId: itemId
      }
    });
    document.dispatchEvent(event);
  }

  return option.type && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    id: optionId,
    className: "customize-control-".concat(option.type, " ").concat(divider)
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Option, {
    id: optionId,
    value: value,
    params: option,
    onChange: onChange
  }));
};

var Options = function Options(_ref2) {
  var options = _ref2.options;

  var _useContext2 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useContext"])(_store_options_context__WEBPACK_IMPORTED_MODULE_1__["default"]),
      values = _useContext2.values,
      depth = _useContext2.depth,
      _onChange = _useContext2.onChange;

  var renderOptions = function renderOptions(options) {
    return Object.keys(options).map(function (optionId) {
      var value = values[optionId];
      var option = options[optionId];
      var isVisible = option.context ? isDisplay(option.context, values, depth) : true;
      return isVisible && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SingleOptionComponent, {
        value: value,
        optionId: optionId,
        option: option,
        onChange: function onChange(newVal) {
          _onChange(newVal, optionId);
        },
        key: optionId
      });
    });
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, renderOptions(options));
};

/* harmony default export */ __webpack_exports__["default"] = (Options);

/***/ }),

/***/ "./src/components/SettingsModal.js":
/*!*****************************************!*\
  !*** ./src/components/SettingsModal.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/defineProperty.js");
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _Options__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./Options */ "./src/components/Options.js");
/* harmony import */ var _UI_SaveButton__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./UI/SaveButton */ "./src/components/UI/SaveButton.js");
/* harmony import */ var _UI_Modal__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./UI/Modal */ "./src/components/UI/Modal.js");
/* harmony import */ var _store_options_context__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../store/options-context */ "./src/store/options-context.js");






function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default()(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }







var localSettings = {};

var SettingsModal = function SettingsModal() {
  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState, 2),
      isOpen = _useState2[0],
      setOpen = _useState2[1];

  var _useState3 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["useState"])(false),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState3, 2),
      isLoading = _useState4[0],
      setIsLoading = _useState4[1];

  var _useState5 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["useState"])({}),
      _useState6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState5, 2),
      initialValue = _useState6[0],
      setInitialValue = _useState6[1];

  var _useState7 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["useState"])({
    itemId: null,
    title: null,
    depth: 0,
    values: null
  }),
      _useState8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState7, 2),
      itemData = _useState8[0],
      setItemData = _useState8[1];

  var loadItemSettings = /*#__PURE__*/function () {
    var _ref = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee(itemId, title, depth) {
      var body, response, _yield$response$json, success, data;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              setInitialValue(null);

              if (!localSettings[itemId]) {
                _context.next = 4;
                break;
              }

              setItemData(function (prevValue) {
                return _objectSpread(_objectSpread({}, prevValue), {}, {
                  itemId: itemId,
                  depth: depth,
                  title: title,
                  values: localSettings[itemId]
                });
              });
              return _context.abrupt("return");

            case 4:
              body = new FormData();
              body.append('action', 'kemet_addons_menu_item_settings');
              body.append('item_id', itemId);
              body.append('nonce', kemetMegaMenu.ajax_nonce);
              _context.next = 10;
              return fetch(kemetMegaMenu.ajax_url, {
                method: 'POST',
                body: body
              });

            case 10:
              response = _context.sent;

              if (!(response.status === 200)) {
                _context.next = 18;
                break;
              }

              _context.next = 14;
              return response.json();

            case 14:
              _yield$response$json = _context.sent;
              success = _yield$response$json.success;
              data = _yield$response$json.data;

              if (success) {
                setItemData({
                  itemId: itemId,
                  depth: depth,
                  title: title,
                  values: data.values
                });
                localSettings[itemId] = data.values;
              }

            case 18:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function loadItemSettings(_x, _x2, _x3) {
      return _ref.apply(this, arguments);
    };
  }();

  var onCloseHandler = function onCloseHandler() {
    setOpen(false);
  };

  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["useEffect"])(function () {
    document.addEventListener('KemetEditMenuItem', /*#__PURE__*/function () {
      var _ref3 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee2(_ref2) {
        var _ref2$detail, itemId, title, depth;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _ref2$detail = _ref2.detail, itemId = _ref2$detail.itemId, title = _ref2$detail.title, depth = _ref2$detail.depth;
                _context2.next = 3;
                return loadItemSettings(itemId, title, depth);

              case 3:
                setOpen(true);

              case 4:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }));

      return function (_x4) {
        return _ref3.apply(this, arguments);
      };
    }());
  }, []);

  var handleChange = function handleChange(value, optionId) {
    setInitialValue(function (prevValue) {
      return _objectSpread(_objectSpread({}, prevValue), {}, _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default()({}, optionId, value));
    });
  };

  var onSaveHandler = /*#__PURE__*/function () {
    var _ref4 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee3() {
      var body, response, _yield$response$json2, success;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              localSettings[itemData.itemId] = _objectSpread(_objectSpread({}, itemData.values), initialValue);
              setIsLoading(true);
              body = new FormData();
              body.append('action', 'kemet_addons_menu_update_item_settings');
              body.append('item_id', itemData.itemId);
              body.append('data', JSON.stringify(initialValue));
              body.append('nonce', kemetMegaMenu.ajax_nonce);
              _context3.next = 9;
              return fetch(kemetMegaMenu.ajax_url, {
                method: 'POST',
                body: body
              });

            case 9:
              response = _context3.sent;

              if (!(response.status === 200)) {
                _context3.next = 16;
                break;
              }

              _context3.next = 13;
              return response.json();

            case 13:
              _yield$response$json2 = _context3.sent;
              success = _yield$response$json2.success;

              if (success) {
                setIsLoading(false);
              }

            case 16:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    return function onSaveHandler() {
      return _ref4.apply(this, arguments);
    };
  }();

  var contextValues = {
    itemId: itemData.itemId,
    onChange: handleChange,
    depth: itemData.depth,
    values: _objectSpread(_objectSpread({}, itemData.values), initialValue)
  };
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_store_options_context__WEBPACK_IMPORTED_MODULE_9__["default"].Provider, {
    value: contextValues
  }, isOpen && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_UI_Modal__WEBPACK_IMPORTED_MODULE_8__["default"], {
    className: "kmt-item-setting-modal menu-item-".concat(itemData.itemId),
    title: itemData.title + ' - ' + Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__["__"])('Item Settings', 'kemet-addons'),
    onClose: onCloseHandler
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_Options__WEBPACK_IMPORTED_MODULE_6__["default"], {
    options: kemetMegaMenu.options
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])("div", {
    className: "modal-actions"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_UI_SaveButton__WEBPACK_IMPORTED_MODULE_7__["default"], {
    isLoading: isLoading,
    onClick: onSaveHandler
  }))));
};

/* harmony default export */ __webpack_exports__["default"] = (SettingsModal);

/***/ }),

/***/ "./src/components/Tabs.js":
/*!********************************!*\
  !*** ./src/components/Tabs.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store_options_context__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../store/options-context */ "./src/store/options-context.js");
/* harmony import */ var _Options__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./Options */ "./src/components/Options.js");






var Tabs = function Tabs(props) {
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_2__["useState"])({
    currentTab: 0
  }),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      state = _useState2[0],
      setState = _useState2[1];

  var tabs = props.params.tabs ? props.params.tabs : {};
  var currentTab = tabs[Object.keys(tabs)[state.currentTab]];
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(react__WEBPACK_IMPORTED_MODULE_2__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("ul", {
    className: "tabs"
  }, Object.keys(tabs).map(function (tab, index) {
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("li", {
      onClick: function onClick() {
        setState({
          currentTab: index
        });
      },
      className: index === state.currentTab && 'active'
    }, tabs[tab].title);
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "current-tab-options kmt-options"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_Options__WEBPACK_IMPORTED_MODULE_4__["default"], {
    options: currentTab.options
  })));
};

/* harmony default export */ __webpack_exports__["default"] = (Tabs);

/***/ }),

/***/ "./src/components/UI/Modal.js":
/*!************************************!*\
  !*** ./src/components/UI/Modal.js ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);


var Dashicon = wp.components.Dashicon;

var Backdrop = function Backdrop(props) {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-backdrop",
    onClick: props.onClose
  });
};

var ModalOverlay = function ModalOverlay(props) {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-modal ".concat(props.classes && props.classes),
    style: props.style
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-modal-header"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("h2", null, props.title), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-close-modal",
    onClick: props.onClose
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Dashicon, {
    icon: "no"
  }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-modal-content"
  }, props.children));
};

var Modal = function Modal(props) {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Backdrop, {
    onClose: props.onClose
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(ModalOverlay, {
    title: props.title,
    classes: props.className,
    style: props.style,
    onClose: props.onClose
  }, props.children));
};

/* harmony default export */ __webpack_exports__["default"] = (Modal);

/***/ }),

/***/ "./src/components/UI/SaveButton.js":
/*!*****************************************!*\
  !*** ./src/components/UI/SaveButton.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

var __ = wp.i18n.__;
var Dashicon = wp.components.Dashicon;

var SaveButton = function SaveButton(_ref) {
  var isLoading = _ref.isLoading,
      _onClick = _ref.onClick;
  var btnClasses = "kmt-button ".concat(isLoading ? 'secondary' : 'primary');
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("button", {
    className: btnClasses,
    onClick: function onClick() {
      _onClick();
    },
    disabled: isLoading
  }, isLoading ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Dashicon, {
    icon: "update"
  }) : __('Save Settings', 'kemet-addons'));
};

/* harmony default export */ __webpack_exports__["default"] = (SaveButton);

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/toConsumableArray */ "./node_modules/@babel/runtime/helpers/toConsumableArray.js");
/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_SettingsModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/SettingsModal */ "./src/components/SettingsModal.js");




window.onload = function () {
  var div = document.createElement('div');
  document.body.appendChild(div);
  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_components_SettingsModal__WEBPACK_IMPORTED_MODULE_2__["default"], null), div);
};

var settingButton = document.querySelectorAll(".kmt-menu-item-settings");

if (settingButton.length > 0) {
  for (var i = 0; i < settingButton.length; i++) {
    if ("undefined" !== typeof settingButton[i]) {
      var button = settingButton[i].querySelector('button');

      button.onclick = function (e) {
        e.preventDefault();
        var _e$target$parentEleme = e.target.parentElement.dataset,
            itemId = _e$target$parentEleme.itemId,
            navId = _e$target$parentEleme.navId;
        var title = e.target.closest('.menu-item').querySelector('.edit-menu-item-title').value;
        var depth = parseFloat(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(e.target.closest('.menu-item').classList).find(function (c) {
          return c.indexOf('menu-item-depth') > -1;
        }).replace('menu-item-depth-', ''));
        var event = new CustomEvent('KemetEditMenuItem', {
          detail: {
            itemId: itemId,
            depth: depth,
            title: title,
            navId: navId
          }
        });
        document.dispatchEvent(event);
      };
    }
  }
}

(function ($) {
  document.addEventListener('KemetInitMenuOptions', function (e) {
    var itemId = e.detail.itemId;
    /**
    * set meta value to select
    */

    var oldMetaValues = kemetMegaMenu.template_meta_value;

    if (oldMetaValues[itemId]) {
      var menuItem = $(".kmt-item-setting-modal.menu-item-" + itemId),
          templateSelect = menuItem.find(".mega-menu-field-template"),
          postID = oldMetaValues[itemId];
      $.post(kemetMegaMenu.ajax_url, {
        post_id: postID,
        action: "kemet_get_post_title",
        nonce: kemetMegaMenu.ajax_title_nonce
      }).done(function (data) {
        templateSelect.append(new Option(data, postID, false, true));
      });
    }
    /**
     * convert to select2 with ajax search
     * @param {string} selector
     */


    var convertToSelect2 = function convertToSelect2(selector) {
      if ($(selector).hasClass("select2-hidden-accessible")) {
        return;
      }

      if ($(selector).val() == "") {
        $(selector).html("");
      }

      $(selector).select2({
        placeholder: kemetMegaMenu.search,
        ajax: {
          url: kemetMegaMenu.ajax_url,
          dataType: "json",
          method: "post",
          delay: 250,
          data: function data(params) {
            return {
              query: params.term,
              // search term
              page: params.page,
              action: "kemet_ajax_get_posts_list",
              nonce: kemetMegaMenu.ajax_nonce
            };
          },
          processResults: function processResults(data) {
            return {
              results: data
            };
          },
          cache: true
        },
        minimumInputLength: 2,
        language: kemetMegaMenu.lang,
        width: "100%"
      }).on('change', function (e) {
        var value = $(e.target).val();
        e.target.dispatchEvent(new CustomEvent("onCustomChange", {
          detail: {
            value: value
          }
        }));
      });
    };

    var specificSelect = $(".mega-menu-field-template");
    specificSelect.each(function (index, selector) {
      convertToSelect2(selector);
    });
  });
})(jQuery);

/***/ }),

/***/ "./src/store/options-context.js":
/*!**************************************!*\
  !*** ./src/store/options-context.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

var OptionsContext = react__WEBPACK_IMPORTED_MODULE_0___default.a.createContext({
  values: {},
  depth: 0,
  onChange: function onChange(value, optionId) {}
});
/* harmony default export */ __webpack_exports__["default"] = (OptionsContext);

/***/ }),

/***/ "@babel/runtime/regenerator":
/*!*************************************!*\
  !*** external "regeneratorRuntime" ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["regeneratorRuntime"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["i18n"]; }());

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["React"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map