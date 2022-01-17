/******/ (function (modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if (installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
      /******/
}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
      /******/
};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
    /******/
}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function (exports, name, getter) {
/******/ 		if (!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
      /******/
}
    /******/
};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function (exports) {
/******/ 		if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
      /******/
}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
    /******/
};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function (value, mode) {
/******/ 		if (mode & 1) value = __webpack_require__(value);
/******/ 		if (mode & 8) return value;
/******/ 		if ((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if (mode & 2 && typeof value != 'string') for (var key in value) __webpack_require__.d(ns, key, function (key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
    /******/
};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function (module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
    /******/
};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function (object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
  /******/
})
/************************************************************************/
/******/({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function (module, exports) {

      function _arrayLikeToArray(arr, len) {
        if (len == null || len > arr.length) len = arr.length;

        for (var i = 0, arr2 = new Array(len); i < len; i++) {
          arr2[i] = arr[i];
        }

        return arr2;
      }

      module.exports = _arrayLikeToArray;
      module.exports["default"] = module.exports, module.exports.__esModule = true;

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function (module, exports) {

      function _arrayWithHoles(arr) {
        if (Array.isArray(arr)) return arr;
      }

      module.exports = _arrayWithHoles;
      module.exports["default"] = module.exports, module.exports.__esModule = true;

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/asyncToGenerator.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function (module, exports) {

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

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function (module, exports) {

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

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function (module, exports) {

      function _nonIterableRest() {
        throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
      }

      module.exports = _nonIterableRest;
      module.exports["default"] = module.exports, module.exports.__esModule = true;

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function (module, exports, __webpack_require__) {

      var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js");

      var iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit.js */ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

      var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

      var nonIterableRest = __webpack_require__(/*! ./nonIterableRest.js */ "./node_modules/@babel/runtime/helpers/nonIterableRest.js");

      function _slicedToArray(arr, i) {
        return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
      }

      module.exports = _slicedToArray;
      module.exports["default"] = module.exports, module.exports.__esModule = true;

      /***/
}),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function (module, exports, __webpack_require__) {

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

      /***/
}),

/***/ "./src/common/SingleOption.js":
/*!************************************!*\
  !*** ./src/common/SingleOption.js ***!
  \************************************/
/*! exports provided: default */
/***/ (function (module, __webpack_exports__, __webpack_require__) {

      "use strict";
      __webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_4__);





      var Card = window.KmtAdminComponents.Card;
      var __ = wp.i18n.__;
      var Dashicon = wp.components.Dashicon;

      var SingleOption = function SingleOption(props) {
        var _useState = Object(react__WEBPACK_IMPORTED_MODULE_4__["useState"])(props.value),
          _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState, 2),
          value = _useState2[0],
          setValue = _useState2[1];

        var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_4__["useState"])(false),
          _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState3, 2),
          isLoading = _useState4[0],
          setIsLoading = _useState4[1];

        var handleChange = /*#__PURE__*/function () {
          var _ref = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee() {
            var newValue, body, response, _yield$response$json, success, data;

            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    setIsLoading(true);
                    newValue = !value;
                    body = new FormData();
                    body.append('action', 'kemet-panel-update-option');
                    body.append('nonce', KemetAddonsPanelData.nonce);
                    body.append('option', props.id);
                    body.append('value', newValue);
                    _context.prev = 7;
                    _context.next = 10;
                    return fetch(KemetAddonsPanelData.ajaxurl, {
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

                    if (success && data.values) {
                      setValue(newValue);
                      props.onChange(data.values);
                    }

                  case 18:
                    _context.next = 23;
                    break;

                  case 20:
                    _context.prev = 20;
                    _context.t0 = _context["catch"](7);
                    console.log(_context.t0);

                  case 23:
                    setIsLoading(false);

                  case 24:
                  case "end":
                    return _context.stop();
                }
              }
            }, _callee, null, [[7, 20]]);
          }));

          return function handleChange() {
            return _ref.apply(this, arguments);
          };
        }();

        var btnText = value === true ? __('Deactivate', 'kemet-addons') : __('Activate', 'kemet-addons');
        var btnClasses = value === true ? 'secondary' : 'primary';
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(Card, {
          id: props.id
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("span", {
          className: "customize-control-title kmt-control-title"
        }, props.params.label), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
          className: "description customize-control-description"
        }, props.params.description), isLoading && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(Dashicon, {
          className: "kmt-loading",
          icon: "update"
        })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
          className: "option-actions"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("button", {
          className: "kmt-button ".concat(btnClasses),
          onClick: function onClick() {
            handleChange();
          },
          disabled: isLoading
        }, btnText), value && props.params.url && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("a", {
          className: "kmt-button",
          href: props.params.url
        }, __('Customize', 'kemet-addons'))));
      };

/* harmony default export */ __webpack_exports__["default"] = (SingleOption);

      /***/
}),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function (module, __webpack_exports__, __webpack_require__) {

      "use strict";
      __webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tabs_options__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tabs/options */ "./src/tabs/options.js");

      var kmtEvents = window.KmtOptionComponent.kmtEvents;
      var __ = wp.i18n.__;
      kmtEvents.on('kmt:dashboard:customtabs', function (_ref) {
        var tabs = _ref.detail;
        tabs.push({
          name: 'kemet-addons',
          title: __('Kemet Addons', 'kemet-addons'),
          className: 'kemet-addons',
          priority: 10,
          data: {
            Component: _tabs_options__WEBPACK_IMPORTED_MODULE_0__["default"],
            props: {
              options: KemetAddonsPanelData.options,
              values: KemetAddonsPanelData.values
            }
          }
        });
      });

      /***/
}),

/***/ "./src/options-component.js":
/*!**********************************!*\
  !*** ./src/options-component.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function (module, __webpack_exports__, __webpack_require__) {

      "use strict";
      __webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_SingleOption__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./common/SingleOption */ "./src/common/SingleOption.js");



      var SingleOptionComponent = function SingleOptionComponent(_ref) {
        var value = _ref.value,
          optionId = _ref.optionId,
          option = _ref.option,
          onChange = _ref.onChange;
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_common_SingleOption__WEBPACK_IMPORTED_MODULE_1__["default"], {
          id: optionId,
          value: value,
          params: option,
          onChange: onChange
        });
      };

      var RenderOptions = function RenderOptions(_ref2) {
        var options = _ref2.options,
          values = _ref2.values,
          _onChange = _ref2.onChange;
        return Object.keys(options).map(function (optionId) {
          var value = values[optionId];
          var option = options[optionId];
          return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SingleOptionComponent, {
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

      var OptionsComponent = function OptionsComponent(_ref3) {
        var options = _ref3.options,
          onChange = _ref3.onChange,
          values = _ref3.values;
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
          className: "kmt-options"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(RenderOptions, {
          options: options,
          onChange: onChange,
          values: values
        }));
      };

/* harmony default export */ __webpack_exports__["default"] = (OptionsComponent);

      /***/
}),

/***/ "./src/tabs/options.js":
/*!*****************************!*\
  !*** ./src/tabs/options.js ***!
  \*****************************/
/*! exports provided: default */
/***/ (function (module, __webpack_exports__, __webpack_require__) {

      "use strict";
      __webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _options_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../options-component */ "./src/options-component.js");



      var Container = window.KmtAdminComponents.Container;

      var __ = wp.i18n.__;
      var Dashicon = wp.components.Dashicon;

      var OptionsTab = function OptionsTab(props) {
        var options = props.options;

        var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(props.values),
          _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
          values = _useState2[0],
          setValues = _useState2[1];

        var handleChange = function handleChange(newValues) {
          setValues(newValues);
        };

        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(Container, null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
          className: "advanced-options options-section"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("h2", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
          className: "icon"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(Dashicon, {
          icon: "screenoptions"
        })), __('Advanced Settings', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_options_component__WEBPACK_IMPORTED_MODULE_2__["default"], {
          options: options,
          values: values,
          onChange: function onChange(newVal, optionId) {
            handleChange(newVal, optionId);
          }
        })));
      };

/* harmony default export */ __webpack_exports__["default"] = (OptionsTab);

      /***/
}),

/***/ "@babel/runtime/regenerator":
/*!*************************************!*\
  !*** external "regeneratorRuntime" ***!
  \*************************************/
/*! no static exports found */
/***/ (function (module, exports) {

      (function () { module.exports = window["regeneratorRuntime"]; }());

      /***/
}),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function (module, exports) {

      (function () { module.exports = window["wp"]["element"]; }());

      /***/
}),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/*! no static exports found */
/***/ (function (module, exports) {

      (function () { module.exports = window["React"]; }());

      /***/
})

  /******/
});
//# sourceMappingURL=index.js.map