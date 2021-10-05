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

/***/ "./node_modules/@babel/runtime/helpers/esm/extends.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _extends; });
function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _objectWithoutPropertiesLoose; });
function _objectWithoutPropertiesLoose(source, excluded) {
  if (source == null) return {};
  var target = {};
  var sourceKeys = Object.keys(source);
  var key, i;

  for (i = 0; i < sourceKeys.length; i++) {
    key = sourceKeys[i];
    if (excluded.indexOf(key) >= 0) continue;
    target[key] = source[key];
  }

  return target;
}

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

/***/ "./node_modules/react-spring/renderprops.js":
/*!**************************************************!*\
  !*** ./node_modules/react-spring/renderprops.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, '__esModule', { value: true });

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var _objectWithoutPropertiesLoose = _interopDefault(__webpack_require__(/*! @babel/runtime/helpers/esm/objectWithoutPropertiesLoose */ "./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js"));
var _extends = _interopDefault(__webpack_require__(/*! @babel/runtime/helpers/esm/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js"));
var React = __webpack_require__(/*! react */ "react");
var React__default = _interopDefault(React);
var ReactDOM = _interopDefault(__webpack_require__(/*! react-dom */ "react-dom"));

let bugfixes = undefined;
let applyAnimatedValues = undefined;
let colorNames = [];
let requestFrame = cb => typeof window !== 'undefined' && window.requestAnimationFrame(cb);
let cancelFrame = cb => typeof window !== 'undefined' && window.cancelAnimationFrame(cb);
let interpolation = undefined;
let now = () => Date.now();
let defaultElement = undefined;
let createAnimatedStyle = undefined;
const injectApplyAnimatedValues = (fn, transform) => applyAnimatedValues = {
  fn,
  transform
};
const injectColorNames = names => colorNames = names;
const injectBugfixes = fn => bugfixes = fn;
const injectInterpolation = cls => interpolation = cls;
const injectFrame = (raf, caf) => {
  var _ref = [raf, caf];
  requestFrame = _ref[0];
  cancelFrame = _ref[1];
  return _ref;
};
const injectNow = nowFn => now = nowFn;
const injectDefaultElement = el => defaultElement = el;
const injectCreateAnimatedStyle = factory => createAnimatedStyle = factory;

var Globals = /*#__PURE__*/Object.freeze({
  get bugfixes () { return bugfixes; },
  get applyAnimatedValues () { return applyAnimatedValues; },
  get colorNames () { return colorNames; },
  get requestFrame () { return requestFrame; },
  get cancelFrame () { return cancelFrame; },
  get interpolation () { return interpolation; },
  get now () { return now; },
  get defaultElement () { return defaultElement; },
  get createAnimatedStyle () { return createAnimatedStyle; },
  injectApplyAnimatedValues: injectApplyAnimatedValues,
  injectColorNames: injectColorNames,
  injectBugfixes: injectBugfixes,
  injectInterpolation: injectInterpolation,
  injectFrame: injectFrame,
  injectNow: injectNow,
  injectDefaultElement: injectDefaultElement,
  injectCreateAnimatedStyle: injectCreateAnimatedStyle
});

class Animated {
  attach() {}

  detach() {}

  getValue() {}

  getAnimatedValue() {
    return this.getValue();
  }

  addChild(child) {}

  removeChild(child) {}

  getChildren() {
    return [];
  }

}

const getValues = object => Object.keys(object).map(k => object[k]);

class AnimatedWithChildren extends Animated {
  constructor() {
    var _this;

    super(...arguments);
    _this = this;
    this.children = [];

    this.getChildren = () => this.children;

    this.getPayload = function (index) {
      if (index === void 0) {
        index = undefined;
      }

      return index !== void 0 && _this.payload ? _this.payload[index] : _this.payload || _this;
    };
  }

  addChild(child) {
    if (this.children.length === 0) this.attach();
    this.children.push(child);
  }

  removeChild(child) {
    const index = this.children.indexOf(child);
    this.children.splice(index, 1);
    if (this.children.length === 0) this.detach();
  }

}
class AnimatedArrayWithChildren extends AnimatedWithChildren {
  constructor() {
    super(...arguments);
    this.payload = [];

    this.getAnimatedValue = () => this.getValue();

    this.attach = () => this.payload.forEach(p => p instanceof Animated && p.addChild(this));

    this.detach = () => this.payload.forEach(p => p instanceof Animated && p.removeChild(this));
  }

}
class AnimatedObjectWithChildren extends AnimatedWithChildren {
  constructor() {
    super(...arguments);
    this.payload = {};

    this.getAnimatedValue = () => this.getValue(true);

    this.attach = () => getValues(this.payload).forEach(s => s instanceof Animated && s.addChild(this));

    this.detach = () => getValues(this.payload).forEach(s => s instanceof Animated && s.removeChild(this));
  }

  getValue(animated) {
    if (animated === void 0) {
      animated = false;
    }

    const payload = {};

    for (const key in this.payload) {
      const value = this.payload[key];
      if (animated && !(value instanceof Animated)) continue;
      payload[key] = value instanceof Animated ? value[animated ? 'getAnimatedValue' : 'getValue']() : value;
    }

    return payload;
  }

}

class AnimatedStyle extends AnimatedObjectWithChildren {
  constructor(style) {
    super();
    style = style || {};
    if (style.transform && !(style.transform instanceof Animated)) style = applyAnimatedValues.transform(style);
    this.payload = style;
  }

}

// http://www.w3.org/TR/css3-color/#svg-color
const colors = {
  transparent: 0x00000000,
  aliceblue: 0xf0f8ffff,
  antiquewhite: 0xfaebd7ff,
  aqua: 0x00ffffff,
  aquamarine: 0x7fffd4ff,
  azure: 0xf0ffffff,
  beige: 0xf5f5dcff,
  bisque: 0xffe4c4ff,
  black: 0x000000ff,
  blanchedalmond: 0xffebcdff,
  blue: 0x0000ffff,
  blueviolet: 0x8a2be2ff,
  brown: 0xa52a2aff,
  burlywood: 0xdeb887ff,
  burntsienna: 0xea7e5dff,
  cadetblue: 0x5f9ea0ff,
  chartreuse: 0x7fff00ff,
  chocolate: 0xd2691eff,
  coral: 0xff7f50ff,
  cornflowerblue: 0x6495edff,
  cornsilk: 0xfff8dcff,
  crimson: 0xdc143cff,
  cyan: 0x00ffffff,
  darkblue: 0x00008bff,
  darkcyan: 0x008b8bff,
  darkgoldenrod: 0xb8860bff,
  darkgray: 0xa9a9a9ff,
  darkgreen: 0x006400ff,
  darkgrey: 0xa9a9a9ff,
  darkkhaki: 0xbdb76bff,
  darkmagenta: 0x8b008bff,
  darkolivegreen: 0x556b2fff,
  darkorange: 0xff8c00ff,
  darkorchid: 0x9932ccff,
  darkred: 0x8b0000ff,
  darksalmon: 0xe9967aff,
  darkseagreen: 0x8fbc8fff,
  darkslateblue: 0x483d8bff,
  darkslategray: 0x2f4f4fff,
  darkslategrey: 0x2f4f4fff,
  darkturquoise: 0x00ced1ff,
  darkviolet: 0x9400d3ff,
  deeppink: 0xff1493ff,
  deepskyblue: 0x00bfffff,
  dimgray: 0x696969ff,
  dimgrey: 0x696969ff,
  dodgerblue: 0x1e90ffff,
  firebrick: 0xb22222ff,
  floralwhite: 0xfffaf0ff,
  forestgreen: 0x228b22ff,
  fuchsia: 0xff00ffff,
  gainsboro: 0xdcdcdcff,
  ghostwhite: 0xf8f8ffff,
  gold: 0xffd700ff,
  goldenrod: 0xdaa520ff,
  gray: 0x808080ff,
  green: 0x008000ff,
  greenyellow: 0xadff2fff,
  grey: 0x808080ff,
  honeydew: 0xf0fff0ff,
  hotpink: 0xff69b4ff,
  indianred: 0xcd5c5cff,
  indigo: 0x4b0082ff,
  ivory: 0xfffff0ff,
  khaki: 0xf0e68cff,
  lavender: 0xe6e6faff,
  lavenderblush: 0xfff0f5ff,
  lawngreen: 0x7cfc00ff,
  lemonchiffon: 0xfffacdff,
  lightblue: 0xadd8e6ff,
  lightcoral: 0xf08080ff,
  lightcyan: 0xe0ffffff,
  lightgoldenrodyellow: 0xfafad2ff,
  lightgray: 0xd3d3d3ff,
  lightgreen: 0x90ee90ff,
  lightgrey: 0xd3d3d3ff,
  lightpink: 0xffb6c1ff,
  lightsalmon: 0xffa07aff,
  lightseagreen: 0x20b2aaff,
  lightskyblue: 0x87cefaff,
  lightslategray: 0x778899ff,
  lightslategrey: 0x778899ff,
  lightsteelblue: 0xb0c4deff,
  lightyellow: 0xffffe0ff,
  lime: 0x00ff00ff,
  limegreen: 0x32cd32ff,
  linen: 0xfaf0e6ff,
  magenta: 0xff00ffff,
  maroon: 0x800000ff,
  mediumaquamarine: 0x66cdaaff,
  mediumblue: 0x0000cdff,
  mediumorchid: 0xba55d3ff,
  mediumpurple: 0x9370dbff,
  mediumseagreen: 0x3cb371ff,
  mediumslateblue: 0x7b68eeff,
  mediumspringgreen: 0x00fa9aff,
  mediumturquoise: 0x48d1ccff,
  mediumvioletred: 0xc71585ff,
  midnightblue: 0x191970ff,
  mintcream: 0xf5fffaff,
  mistyrose: 0xffe4e1ff,
  moccasin: 0xffe4b5ff,
  navajowhite: 0xffdeadff,
  navy: 0x000080ff,
  oldlace: 0xfdf5e6ff,
  olive: 0x808000ff,
  olivedrab: 0x6b8e23ff,
  orange: 0xffa500ff,
  orangered: 0xff4500ff,
  orchid: 0xda70d6ff,
  palegoldenrod: 0xeee8aaff,
  palegreen: 0x98fb98ff,
  paleturquoise: 0xafeeeeff,
  palevioletred: 0xdb7093ff,
  papayawhip: 0xffefd5ff,
  peachpuff: 0xffdab9ff,
  peru: 0xcd853fff,
  pink: 0xffc0cbff,
  plum: 0xdda0ddff,
  powderblue: 0xb0e0e6ff,
  purple: 0x800080ff,
  rebeccapurple: 0x663399ff,
  red: 0xff0000ff,
  rosybrown: 0xbc8f8fff,
  royalblue: 0x4169e1ff,
  saddlebrown: 0x8b4513ff,
  salmon: 0xfa8072ff,
  sandybrown: 0xf4a460ff,
  seagreen: 0x2e8b57ff,
  seashell: 0xfff5eeff,
  sienna: 0xa0522dff,
  silver: 0xc0c0c0ff,
  skyblue: 0x87ceebff,
  slateblue: 0x6a5acdff,
  slategray: 0x708090ff,
  slategrey: 0x708090ff,
  snow: 0xfffafaff,
  springgreen: 0x00ff7fff,
  steelblue: 0x4682b4ff,
  tan: 0xd2b48cff,
  teal: 0x008080ff,
  thistle: 0xd8bfd8ff,
  tomato: 0xff6347ff,
  turquoise: 0x40e0d0ff,
  violet: 0xee82eeff,
  wheat: 0xf5deb3ff,
  white: 0xffffffff,
  whitesmoke: 0xf5f5f5ff,
  yellow: 0xffff00ff,
  yellowgreen: 0x9acd32ff
};

class Interpolation {
  // Default config = config, args
  // Short config   = range, output, extrapolate
  static create(config, output, extra) {
    if (typeof config === 'function') return config;else if (interpolation && config.output && typeof config.output[0] === 'string') return interpolation(config);else if (Array.isArray(config)) return Interpolation.create({
      range: config,
      output,
      extrapolate: extra || 'extend'
    });
    let outputRange = config.output;
    let inputRange = config.range || [0, 1];

    let easing = config.easing || (t => t);

    let extrapolateLeft = 'extend';
    let map = config.map;
    if (config.extrapolateLeft !== undefined) extrapolateLeft = config.extrapolateLeft;else if (config.extrapolate !== undefined) extrapolateLeft = config.extrapolate;
    let extrapolateRight = 'extend';
    if (config.extrapolateRight !== undefined) extrapolateRight = config.extrapolateRight;else if (config.extrapolate !== undefined) extrapolateRight = config.extrapolate;
    return input => {
      let range = findRange(input, inputRange);
      return interpolate(input, inputRange[range], inputRange[range + 1], outputRange[range], outputRange[range + 1], easing, extrapolateLeft, extrapolateRight, map);
    };
  }

}

function interpolate(input, inputMin, inputMax, outputMin, outputMax, easing, extrapolateLeft, extrapolateRight, map) {
  let result = map ? map(input) : input; // Extrapolate

  if (result < inputMin) {
    if (extrapolateLeft === 'identity') return result;else if (extrapolateLeft === 'clamp') result = inputMin;
  }

  if (result > inputMax) {
    if (extrapolateRight === 'identity') return result;else if (extrapolateRight === 'clamp') result = inputMax;
  }

  if (outputMin === outputMax) return outputMin;
  if (inputMin === inputMax) return input <= inputMin ? outputMin : outputMax; // Input Range

  if (inputMin === -Infinity) result = -result;else if (inputMax === Infinity) result = result - inputMin;else result = (result - inputMin) / (inputMax - inputMin); // Easing

  result = easing(result); // Output Range

  if (outputMin === -Infinity) result = -result;else if (outputMax === Infinity) result = result + outputMin;else result = result * (outputMax - outputMin) + outputMin;
  return result;
}

function findRange(input, inputRange) {
  for (var i = 1; i < inputRange.length - 1; ++i) if (inputRange[i] >= input) break;

  return i - 1;
}

// const INTEGER = '[-+]?\\d+';
const NUMBER = '[-+]?\\d*\\.?\\d+';
const PERCENTAGE = NUMBER + '%';

function call() {
  return '\\(\\s*(' + Array.prototype.slice.call(arguments).join(')\\s*,\\s*(') + ')\\s*\\)';
}

const rgb = new RegExp('rgb' + call(NUMBER, NUMBER, NUMBER));
const rgba = new RegExp('rgba' + call(NUMBER, NUMBER, NUMBER, NUMBER));
const hsl = new RegExp('hsl' + call(NUMBER, PERCENTAGE, PERCENTAGE));
const hsla = new RegExp('hsla' + call(NUMBER, PERCENTAGE, PERCENTAGE, NUMBER));
const hex3 = /^#([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/;
const hex4 = /^#([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/;
const hex6 = /^#([0-9a-fA-F]{6})$/;
const hex8 = /^#([0-9a-fA-F]{8})$/;

/*
https://github.com/react-community/normalize-css-color

BSD 3-Clause License

Copyright (c) 2016, React Community
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

* Neither the name of the copyright holder nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
function normalizeColor(color) {
  let match;

  if (typeof color === 'number') {
    return color >>> 0 === color && color >= 0 && color <= 0xffffffff ? color : null;
  } // Ordered based on occurrences on Facebook codebase


  if (match = hex6.exec(color)) return parseInt(match[1] + 'ff', 16) >>> 0;
  if (colors.hasOwnProperty(color)) return colors[color];

  if (match = rgb.exec(color)) {
    return (parse255(match[1]) << 24 | // r
    parse255(match[2]) << 16 | // g
    parse255(match[3]) << 8 | // b
    0x000000ff) >>> // a
    0;
  }

  if (match = rgba.exec(color)) {
    return (parse255(match[1]) << 24 | // r
    parse255(match[2]) << 16 | // g
    parse255(match[3]) << 8 | // b
    parse1(match[4])) >>> // a
    0;
  }

  if (match = hex3.exec(color)) {
    return parseInt(match[1] + match[1] + // r
    match[2] + match[2] + // g
    match[3] + match[3] + // b
    'ff', // a
    16) >>> 0;
  } // https://drafts.csswg.org/css-color-4/#hex-notation


  if (match = hex8.exec(color)) return parseInt(match[1], 16) >>> 0;

  if (match = hex4.exec(color)) {
    return parseInt(match[1] + match[1] + // r
    match[2] + match[2] + // g
    match[3] + match[3] + // b
    match[4] + match[4], // a
    16) >>> 0;
  }

  if (match = hsl.exec(color)) {
    return (hslToRgb(parse360(match[1]), // h
    parsePercentage(match[2]), // s
    parsePercentage(match[3]) // l
    ) | 0x000000ff) >>> // a
    0;
  }

  if (match = hsla.exec(color)) {
    return (hslToRgb(parse360(match[1]), // h
    parsePercentage(match[2]), // s
    parsePercentage(match[3]) // l
    ) | parse1(match[4])) >>> // a
    0;
  }

  return null;
}

function hue2rgb(p, q, t) {
  if (t < 0) t += 1;
  if (t > 1) t -= 1;
  if (t < 1 / 6) return p + (q - p) * 6 * t;
  if (t < 1 / 2) return q;
  if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
  return p;
}

function hslToRgb(h, s, l) {
  const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
  const p = 2 * l - q;
  const r = hue2rgb(p, q, h + 1 / 3);
  const g = hue2rgb(p, q, h);
  const b = hue2rgb(p, q, h - 1 / 3);
  return Math.round(r * 255) << 24 | Math.round(g * 255) << 16 | Math.round(b * 255) << 8;
}

function parse255(str) {
  const int = parseInt(str, 10);
  if (int < 0) return 0;
  if (int > 255) return 255;
  return int;
}

function parse360(str) {
  const int = parseFloat(str);
  return (int % 360 + 360) % 360 / 360;
}

function parse1(str) {
  const num = parseFloat(str);
  if (num < 0) return 0;
  if (num > 1) return 255;
  return Math.round(num * 255);
}

function parsePercentage(str) {
  // parseFloat conveniently ignores the final %
  const int = parseFloat(str);
  if (int < 0) return 0;
  if (int > 100) return 1;
  return int / 100;
}

function colorToRgba(input) {
  let int32Color = normalizeColor(input);
  if (int32Color === null) return input;
  int32Color = int32Color || 0;
  let r = (int32Color & 0xff000000) >>> 24;
  let g = (int32Color & 0x00ff0000) >>> 16;
  let b = (int32Color & 0x0000ff00) >>> 8;
  let a = (int32Color & 0x000000ff) / 255;
  return `rgba(${r}, ${g}, ${b}, ${a})`;
} // Problem: https://github.com/animatedjs/animated/pull/102
// Solution: https://stackoverflow.com/questions/638565/parsing-scientific-notation-sensibly/658662


const stringShapeRegex = /[+\-]?(?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?/g; // Covers rgb, rgba, hsl, hsla
// Taken from https://gist.github.com/olmokramer/82ccce673f86db7cda5e

const colorRegex = /(#(?:[0-9a-f]{2}){2,4}|(#[0-9a-f]{3})|(rgb|hsl)a?\((-?\d+%?[,\s]+){2,3}\s*[\d\.]+%?\))/gi; // Covers color names (transparent, blue, etc.)

const colorNamesRegex = new RegExp(`(${Object.keys(colors).join('|')})`, 'g');
/**
 * Supports string shapes by extracting numbers so new values can be computed,
 * and recombines those values into new strings of the same shape.  Supports
 * things like:
 *
 *   rgba(123, 42, 99, 0.36)           // colors
 *   -45deg                            // values with units
 *   0 2px 2px 0px rgba(0, 0, 0, 0.12) // box shadows
 */

function createInterpolation(config) {
  // Replace colors with rgba
  const outputRange = config.output.map(rangeValue => rangeValue.replace(colorRegex, colorToRgba)).map(rangeValue => rangeValue.replace(colorNamesRegex, colorToRgba)); // ->
  // [
  //   [0, 50],
  //   [100, 150],
  //   [200, 250],
  //   [0, 0.5],
  // ]

  const outputRanges = outputRange[0].match(stringShapeRegex).map(() => []);
  outputRange.forEach(value => {
    value.match(stringShapeRegex).forEach((number, i) => outputRanges[i].push(+number));
  });
  const interpolations = outputRange[0].match(stringShapeRegex).map((value, i) => {
    return Interpolation.create(_extends({}, config, {
      output: outputRanges[i]
    }));
  });
  return input => {
    let i = 0;
    return outputRange[0] // 'rgba(0, 100, 200, 0)'
    // ->
    // 'rgba(${interpolations[0](input)}, ${interpolations[1](input)}, ...'
    .replace(stringShapeRegex, () => interpolations[i++](input)) // rgba requires that the r,g,b are integers.... so we want to round them, but we *dont* want to
    // round the opacity (4th column).
    .replace(/rgba\(([0-9\.-]+), ([0-9\.-]+), ([0-9\.-]+), ([0-9\.-]+)\)/gi, (_, p1, p2, p3, p4) => `rgba(${Math.round(p1)}, ${Math.round(p2)}, ${Math.round(p3)}, ${p4})`);
  };
}

class AnimatedInterpolation extends AnimatedArrayWithChildren {
  constructor(parents, _config, _arg) {
    super();

    this.getValue = () => this.calc(...this.payload.map(value => value.getValue()));

    this.updateConfig = (config, arg) => this.calc = Interpolation.create(config, arg);

    this.interpolate = (config, arg) => new AnimatedInterpolation(this, config, arg);

    this.payload = // AnimatedArrays should unfold, except AnimatedInterpolation which is taken as is
    parents instanceof AnimatedArrayWithChildren && !parents.updateConfig ? parents.payload : Array.isArray(parents) ? parents : [parents];
    this.calc = Interpolation.create(_config, _arg);
  }

}
const interpolate$1 = (parents, config, arg) => parents && new AnimatedInterpolation(parents, config, arg);

/**
 * Animated works by building a directed acyclic graph of dependencies
 * transparently when you render your Animated components.
 *
 *               new Animated.Value(0)
 *     .interpolate()        .interpolate()    new Animated.Value(1)
 *         opacity               translateY      scale
 *          style                         transform
 *         View#234                         style
 *                                         View#123
 *
 * A) Top Down phase
 * When an Animated.Value is updated, we recursively go down through this
 * graph in order to find leaf nodes: the views that we flag as needing
 * an update.
 *
 * B) Bottom Up phase
 * When a view is flagged as needing an update, we recursively go back up
 * in order to build the new value that it needs. The reason why we need
 * this two-phases process is to deal with composite props such as
 * transform which can receive values from multiple parents.
 */

function findAnimatedStyles(node, styles) {
  if (typeof node.update === 'function') styles.add(node);else node.getChildren().forEach(child => findAnimatedStyles(child, styles));
}
/**
 * Standard value for driving animations.  One `Animated.Value` can drive
 * multiple properties in a synchronized fashion, but can only be driven by one
 * mechanism at a time.  Using a new mechanism (e.g. starting a new animation,
 * or calling `setValue`) will stop any previous ones.
 */


class AnimatedValue extends AnimatedWithChildren {
  constructor(_value) {
    var _this;

    super();
    _this = this;

    this.setValue = function (value, flush) {
      if (flush === void 0) {
        flush = true;
      }

      _this.value = value;
      if (flush) _this.flush();
    };

    this.getValue = () => this.value;

    this.updateStyles = () => findAnimatedStyles(this, this.animatedStyles);

    this.updateValue = value => this.flush(this.value = value);

    this.interpolate = (config, arg) => new AnimatedInterpolation(this, config, arg);

    this.value = _value;
    this.animatedStyles = new Set();
    this.done = false;
    this.startPosition = _value;
    this.lastPosition = _value;
    this.lastVelocity = undefined;
    this.lastTime = undefined;
    this.controller = undefined;
  }

  flush() {
    if (this.animatedStyles.size === 0) this.updateStyles();
    this.animatedStyles.forEach(animatedStyle => animatedStyle.update());
  }

  prepare(controller) {
    // Values stay loyal to their original controller, this is also a way to
    // detect trailing values originating from a foreign controller
    if (this.controller === undefined) this.controller = controller;

    if (this.controller === controller) {
      this.startPosition = this.value;
      this.lastPosition = this.value;
      this.lastVelocity = controller.isActive ? this.lastVelocity : undefined;
      this.lastTime = controller.isActive ? this.lastTime : undefined;
      this.done = false;
      this.animatedStyles.clear();
    }
  }

}

class AnimatedArray extends AnimatedArrayWithChildren {
  constructor(array) {
    var _this;

    super();
    _this = this;

    this.setValue = function (value, flush) {
      if (flush === void 0) {
        flush = true;
      }

      if (Array.isArray(value)) {
        if (value.length === _this.payload.length) value.forEach((v, i) => _this.payload[i].setValue(v, flush));
      } else _this.payload.forEach((v, i) => _this.payload[i].setValue(value, flush));
    };

    this.getValue = () => this.payload.map(v => v.getValue());

    this.interpolate = (config, arg) => new AnimatedInterpolation(this, config, arg);

    this.payload = array.map(n => new AnimatedValue(n));
  }

}

function withDefault(value, defaultValue) {
  return value === undefined || value === null ? defaultValue : value;
}
function toArray(a) {
  return a !== void 0 ? Array.isArray(a) ? a : [a] : [];
}
function shallowEqual(a, b) {
  if (typeof a !== typeof b) return false;
  if (typeof a === 'string' || typeof a === 'number') return a === b;
  let i;

  for (i in a) if (!(i in b)) return false;

  for (i in b) if (a[i] !== b[i]) return false;

  return i === void 0 ? a === b : true;
}
function callProp(obj) {
  for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
    args[_key - 1] = arguments[_key];
  }

  return typeof obj === 'function' ? obj(...args) : obj;
}
function getValues$1(object) {
  return Object.keys(object).map(k => object[k]);
}
function getForwardProps(props) {
  const to = props.to,
        from = props.from,
        config = props.config,
        native = props.native,
        onStart = props.onStart,
        onRest = props.onRest,
        onFrame = props.onFrame,
        children = props.children,
        reset = props.reset,
        reverse = props.reverse,
        force = props.force,
        immediate = props.immediate,
        impl = props.impl,
        inject = props.inject,
        delay = props.delay,
        attach = props.attach,
        destroyed = props.destroyed,
        interpolateTo = props.interpolateTo,
        autoStart = props.autoStart,
        ref = props.ref,
        forward = _objectWithoutPropertiesLoose(props, ["to", "from", "config", "native", "onStart", "onRest", "onFrame", "children", "reset", "reverse", "force", "immediate", "impl", "inject", "delay", "attach", "destroyed", "interpolateTo", "autoStart", "ref"]);

  return forward;
}
function interpolateTo(props) {
  const forward = getForwardProps(props);
  const rest = Object.keys(props).reduce((a, k) => forward[k] !== void 0 ? a : _extends({}, a, {
    [k]: props[k]
  }), {});
  return _extends({
    to: forward
  }, rest);
}
function convertToAnimatedValue(acc, _ref) {
  let name = _ref[0],
      value = _ref[1];
  return _extends({}, acc, {
    [name]: new (Array.isArray(value) ? AnimatedArray : AnimatedValue)(value)
  });
}
function convertValues(props) {
  const from = props.from,
        to = props.to,
        native = props.native;
  const allProps = Object.entries(_extends({}, from, to));
  return native ? allProps.reduce(convertToAnimatedValue, {}) : _extends({}, from, to);
}
function handleRef(ref, forward) {
  if (forward) {
    // If it's a function, assume it's a ref callback
    if (typeof forward === 'function') forward(ref);else if (typeof forward === 'object') {
      // If it's an object and has a 'current' property, assume it's a ref object
      forward.current = ref;
    }
  }

  return ref;
}

const check = value => value === 'auto';

const overwrite = (width, height) => (acc, _ref) => {
  let name = _ref[0],
      value = _ref[1];
  return _extends({}, acc, {
    [name]: value === 'auto' ? ~name.indexOf('height') ? height : width : value
  });
};

function fixAuto(props, callback) {
  const from = props.from,
        to = props.to,
        children = props.children; // Dry-route props back if nothing's using 'auto' in there
  // TODO: deal with "null"

  if (!(getValues$1(to).some(check) || getValues$1(from).some(check))) return; // Fetch render v-dom

  let element = children(convertValues(props)); // A spring can return undefined/null, check against that (#153)

  if (!element) return; // Or it could be an array (#346) ...

  if (Array.isArray(element)) element = {
    type: 'div',
    props: {
      children: element
    } // Extract styles

  };
  const elementStyles = element.props.style; // Return v.dom with injected ref

  return React__default.createElement(element.type, _extends({
    key: element.key ? element.key : undefined
  }, element.props, {
    style: _extends({}, elementStyles, {
      position: 'absolute',
      visibility: 'hidden'
    }),
    ref: _ref2 => {
      if (_ref2) {
        // Once it's rendered out, fetch bounds (minus padding/margin/borders)
        let node = ReactDOM.findDOMNode(_ref2);
        let width, height;
        let cs = getComputedStyle(node);

        if (cs.boxSizing === 'border-box') {
          width = node.offsetWidth;
          height = node.offsetHeight;
        } else {
          const paddingX = parseFloat(cs.paddingLeft || 0) + parseFloat(cs.paddingRight || 0);
          const paddingY = parseFloat(cs.paddingTop || 0) + parseFloat(cs.paddingBottom || 0);
          const borderX = parseFloat(cs.borderLeftWidth || 0) + parseFloat(cs.borderRightWidth || 0);
          const borderY = parseFloat(cs.borderTopWidth || 0) + parseFloat(cs.borderBottomWidth || 0);
          width = node.offsetWidth - paddingX - borderX;
          height = node.offsetHeight - paddingY - borderY;
        }

        const convert = overwrite(width, height);
        callback(_extends({}, props, {
          from: Object.entries(from).reduce(convert, from),
          to: Object.entries(to).reduce(convert, to)
        }));
      }
    }
  }));
}

let isUnitlessNumber = {
  animationIterationCount: true,
  borderImageOutset: true,
  borderImageSlice: true,
  borderImageWidth: true,
  boxFlex: true,
  boxFlexGroup: true,
  boxOrdinalGroup: true,
  columnCount: true,
  columns: true,
  flex: true,
  flexGrow: true,
  flexPositive: true,
  flexShrink: true,
  flexNegative: true,
  flexOrder: true,
  gridRow: true,
  gridRowEnd: true,
  gridRowSpan: true,
  gridRowStart: true,
  gridColumn: true,
  gridColumnEnd: true,
  gridColumnSpan: true,
  gridColumnStart: true,
  fontWeight: true,
  lineClamp: true,
  lineHeight: true,
  opacity: true,
  order: true,
  orphans: true,
  tabSize: true,
  widows: true,
  zIndex: true,
  zoom: true,
  // SVG-related properties
  fillOpacity: true,
  floodOpacity: true,
  stopOpacity: true,
  strokeDasharray: true,
  strokeDashoffset: true,
  strokeMiterlimit: true,
  strokeOpacity: true,
  strokeWidth: true
};

const prefixKey = (prefix, key) => prefix + key.charAt(0).toUpperCase() + key.substring(1);

const prefixes = ['Webkit', 'Ms', 'Moz', 'O'];
isUnitlessNumber = Object.keys(isUnitlessNumber).reduce((acc, prop) => {
  prefixes.forEach(prefix => acc[prefixKey(prefix, prop)] = acc[prop]);
  return acc;
}, isUnitlessNumber);

function dangerousStyleValue(name, value, isCustomProperty) {
  if (value == null || typeof value === 'boolean' || value === '') return '';
  if (!isCustomProperty && typeof value === 'number' && value !== 0 && !(isUnitlessNumber.hasOwnProperty(name) && isUnitlessNumber[name])) return value + 'px'; // Presumes implicit 'px' suffix for unitless numbers

  return ('' + value).trim();
}

const attributeCache = {};
injectCreateAnimatedStyle(style => new AnimatedStyle(style));
injectDefaultElement('div');
injectInterpolation(createInterpolation);
injectColorNames(colors);
injectBugfixes(fixAuto);
injectApplyAnimatedValues((instance, props) => {
  if (instance.nodeType && instance.setAttribute !== undefined) {
    const style = props.style,
          children = props.children,
          scrollTop = props.scrollTop,
          scrollLeft = props.scrollLeft,
          attributes = _objectWithoutPropertiesLoose(props, ["style", "children", "scrollTop", "scrollLeft"]);

    if (scrollTop !== void 0) instance.scrollTop = scrollTop;
    if (scrollLeft !== void 0) instance.scrollLeft = scrollLeft; // Set textContent, if children is an animatable value

    if (children !== void 0) instance.textContent = children; // Set styles ...

    for (let styleName in style) {
      if (!style.hasOwnProperty(styleName)) continue;
      var isCustomProperty = styleName.indexOf('--') === 0;
      var styleValue = dangerousStyleValue(styleName, style[styleName], isCustomProperty);
      if (styleName === 'float') styleName = 'cssFloat';
      if (isCustomProperty) instance.style.setProperty(styleName, styleValue);else instance.style[styleName] = styleValue;
    } // Set attributes ...


    for (let name in attributes) {
      // Attributes are written in dash case
      const dashCase = attributeCache[name] || (attributeCache[name] = name.replace(/([A-Z])/g, n => '-' + n.toLowerCase()));
      if (typeof instance.getAttribute(dashCase) !== 'undefined') instance.setAttribute(dashCase, attributes[name]);
    }
  } else return false;
}, style => style);

let active = false;
const controllers = new Set();

const frameLoop = () => {
  let time = now();

  for (let controller of controllers) {
    let isDone = true;
    let noChange = true;

    for (let configIdx = 0; configIdx < controller.configs.length; configIdx++) {
      let config = controller.configs[configIdx];
      let endOfAnimation, lastTime;

      for (let valIdx = 0; valIdx < config.animatedValues.length; valIdx++) {
        let animation = config.animatedValues[valIdx]; // If an animation is done, skip, until all of them conclude

        if (animation.done) continue;
        let from = config.fromValues[valIdx];
        let to = config.toValues[valIdx];
        let position = animation.lastPosition;
        let isAnimated = to instanceof Animated;
        let velocity = Array.isArray(config.initialVelocity) ? config.initialVelocity[valIdx] : config.initialVelocity;
        if (isAnimated) to = to.getValue(); // Conclude animation if it's either immediate, or from-values match end-state

        if (config.immediate || !isAnimated && !config.decay && from === to) {
          animation.updateValue(to);
          animation.done = true;
          continue;
        } // Doing delay here instead of setTimeout is one async worry less


        if (config.delay && time - controller.startTime < config.delay) {
          isDone = false;
          continue;
        } // Flag change


        noChange = false; // Break animation when string values are involved

        if (typeof from === 'string' || typeof to === 'string') {
          animation.updateValue(to);
          animation.done = true;
          continue;
        }

        if (config.duration !== void 0) {
          /** Duration easing */
          position = from + config.easing((time - controller.startTime - config.delay) / config.duration) * (to - from);
          endOfAnimation = time >= controller.startTime + config.delay + config.duration;
        } else if (config.decay) {
          /** Decay easing */
          position = from + velocity / (1 - 0.998) * (1 - Math.exp(-(1 - 0.998) * (time - controller.startTime)));
          endOfAnimation = Math.abs(animation.lastPosition - position) < 0.1;
          if (endOfAnimation) to = position;
        } else {
          /** Spring easing */
          lastTime = animation.lastTime !== void 0 ? animation.lastTime : time;
          velocity = animation.lastVelocity !== void 0 ? animation.lastVelocity : config.initialVelocity; // If we lost a lot of frames just jump to the end.

          if (time > lastTime + 64) lastTime = time; // http://gafferongames.com/game-physics/fix-your-timestep/

          let numSteps = Math.floor(time - lastTime);

          for (let i = 0; i < numSteps; ++i) {
            let force = -config.tension * (position - to);
            let damping = -config.friction * velocity;
            let acceleration = (force + damping) / config.mass;
            velocity = velocity + acceleration * 1 / 1000;
            position = position + velocity * 1 / 1000;
          } // Conditions for stopping the spring animation


          let isOvershooting = config.clamp && config.tension !== 0 ? from < to ? position > to : position < to : false;
          let isVelocity = Math.abs(velocity) <= config.precision;
          let isDisplacement = config.tension !== 0 ? Math.abs(to - position) <= config.precision : true;
          endOfAnimation = isOvershooting || isVelocity && isDisplacement;
          animation.lastVelocity = velocity;
          animation.lastTime = time;
        } // Trails aren't done until their parents conclude


        if (isAnimated && !config.toValues[valIdx].done) endOfAnimation = false;

        if (endOfAnimation) {
          // Ensure that we end up with a round value
          if (animation.value !== to) position = to;
          animation.done = true;
        } else isDone = false;

        animation.updateValue(position);
        animation.lastPosition = position;
      } // Keep track of updated values only when necessary


      if (controller.props.onFrame || !controller.props.native) controller.animatedProps[config.name] = config.interpolation.getValue();
    } // Update callbacks in the end of the frame


    if (controller.props.onFrame || !controller.props.native) {
      if (!controller.props.native && controller.onUpdate) controller.onUpdate();
      if (controller.props.onFrame) controller.props.onFrame(controller.animatedProps);
    } // Either call onEnd or next frame


    if (isDone) {
      controllers.delete(controller);
      controller.debouncedOnEnd({
        finished: true,
        noChange
      });
    }
  } // Loop over as long as there are controllers ...


  if (controllers.size) requestFrame(frameLoop);else active = false;
};

const addController = controller => {
  if (!controllers.has(controller)) {
    controllers.add(controller);
    if (!active) requestFrame(frameLoop);
    active = true;
  }
};

const removeController = controller => {
  if (controllers.has(controller)) {
    controllers.delete(controller);
  }
};

class Controller {
  constructor(props, config) {
    if (config === void 0) {
      config = {
        native: true,
        interpolateTo: true,
        autoStart: true
      };
    }

    this.getValues = () => this.props.native ? this.interpolations : this.animatedProps;

    this.dependents = new Set();
    this.isActive = false;
    this.hasChanged = false;
    this.props = {};
    this.merged = {};
    this.animations = {};
    this.interpolations = {};
    this.animatedProps = {};
    this.configs = [];
    this.frame = undefined;
    this.startTime = undefined;
    this.lastTime = undefined;
    this.update(_extends({}, props, config));
  }

  update(props) {
    this.props = _extends({}, this.props, props);

    let _ref = this.props.interpolateTo ? interpolateTo(this.props) : this.props,
        _ref$from = _ref.from,
        from = _ref$from === void 0 ? {} : _ref$from,
        _ref$to = _ref.to,
        to = _ref$to === void 0 ? {} : _ref$to,
        _ref$config = _ref.config,
        config = _ref$config === void 0 ? {} : _ref$config,
        _ref$delay = _ref.delay,
        delay = _ref$delay === void 0 ? 0 : _ref$delay,
        reverse = _ref.reverse,
        attach = _ref.attach,
        reset = _ref.reset,
        immediate = _ref.immediate,
        autoStart = _ref.autoStart,
        ref = _ref.ref; // Reverse values when requested


    if (reverse) {
      var _ref2 = [to, from];
      from = _ref2[0];
      to = _ref2[1];
    }

    this.hasChanged = false; // Attachment handling, trailed springs can "attach" themselves to a previous spring

    let target = attach && attach(this); // Reset merged props when necessary

    let extra = reset ? {} : this.merged; // This will collect all props that were ever set

    this.merged = _extends({}, from, extra, to); // Reduces input { name: value } pairs into animated values

    this.animations = Object.entries(this.merged).reduce((acc, _ref3, i) => {
      let name = _ref3[0],
          value = _ref3[1];
      // Issue cached entries, except on reset
      let entry = !reset && acc[name] || {}; // Figure out what the value is supposed to be

      const isNumber = typeof value === 'number';
      const isString = typeof value === 'string' && !value.startsWith('#') && !/\d/.test(value) && !colorNames[value];
      const isArray = !isNumber && !isString && Array.isArray(value);
      let fromValue = from[name] !== undefined ? from[name] : value;
      let toValue = isNumber || isArray ? value : isString ? value : 1;
      let toConfig = callProp(config, name);
      if (target) toValue = target.animations[name].parent; // Detect changes, animated values will be checked in the raf-loop

      if (toConfig.decay !== void 0 || !shallowEqual(entry.changes, value)) {
        this.hasChanged = true;
        let parent, interpolation$$1;
        if (isNumber || isString) parent = interpolation$$1 = entry.parent || new AnimatedValue(fromValue);else if (isArray) parent = interpolation$$1 = entry.parent || new AnimatedArray(fromValue);else {
          const prev = entry.interpolation && entry.interpolation.calc(entry.parent.value);

          if (entry.parent) {
            parent = entry.parent;
            parent.setValue(0, false);
          } else parent = new AnimatedValue(0);

          const range = {
            output: [prev !== void 0 ? prev : fromValue, value]
          };

          if (entry.interpolation) {
            interpolation$$1 = entry.interpolation;
            entry.interpolation.updateConfig(range);
          } else interpolation$$1 = parent.interpolate(range);
        } // Set immediate values

        if (callProp(immediate, name)) parent.setValue(value, false); // Reset animated values

        const animatedValues = toArray(parent.getPayload());
        animatedValues.forEach(value => value.prepare(this));
        return _extends({}, acc, {
          [name]: _extends({}, entry, {
            name,
            parent,
            interpolation: interpolation$$1,
            animatedValues,
            changes: value,
            fromValues: toArray(parent.getValue()),
            toValues: toArray(target ? toValue.getPayload() : toValue),
            immediate: callProp(immediate, name),
            delay: withDefault(toConfig.delay, delay || 0),
            initialVelocity: withDefault(toConfig.velocity, 0),
            clamp: withDefault(toConfig.clamp, false),
            precision: withDefault(toConfig.precision, 0.01),
            tension: withDefault(toConfig.tension, 170),
            friction: withDefault(toConfig.friction, 26),
            mass: withDefault(toConfig.mass, 1),
            duration: toConfig.duration,
            easing: withDefault(toConfig.easing, t => t),
            decay: toConfig.decay
          })
        });
      } else return acc;
    }, this.animations);

    if (this.hasChanged) {
      this.configs = getValues$1(this.animations);
      this.animatedProps = {};
      this.interpolations = {};

      for (let key in this.animations) {
        this.interpolations[key] = this.animations[key].interpolation;
        this.animatedProps[key] = this.animations[key].interpolation.getValue();
      }
    } // TODO: clean up ref in controller


    for (var _len = arguments.length, start = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      start[_key - 1] = arguments[_key];
    }

    if (!ref && (autoStart || start.length)) this.start(...start);
    const onEnd = start[0],
          onUpdate = start[1];
    this.onEnd = typeof onEnd === 'function' && onEnd;
    this.onUpdate = onUpdate;
    return this.getValues();
  }

  start(onEnd, onUpdate) {
    this.startTime = now();
    if (this.isActive) this.stop();
    this.isActive = true;
    this.onEnd = typeof onEnd === 'function' && onEnd;
    this.onUpdate = onUpdate;
    if (this.props.onStart) this.props.onStart();
    addController(this);
    return new Promise(res => this.resolve = res);
  }

  stop(finished) {
    if (finished === void 0) {
      finished = false;
    }

    // Reset collected changes since the animation has been stopped cold turkey
    if (finished) getValues$1(this.animations).forEach(a => a.changes = undefined);
    this.debouncedOnEnd({
      finished
    });
  }

  destroy() {
    removeController(this);
    this.props = {};
    this.merged = {};
    this.animations = {};
    this.interpolations = {};
    this.animatedProps = {};
    this.configs = [];
  }

  debouncedOnEnd(result) {
    removeController(this);
    this.isActive = false;
    const onEnd = this.onEnd;
    this.onEnd = null;
    if (onEnd) onEnd(result);
    if (this.resolve) this.resolve();
    this.resolve = null;
  }

}

class AnimatedProps extends AnimatedObjectWithChildren {
  constructor(props, callback) {
    super();
    if (props.style) props = _extends({}, props, {
      style: createAnimatedStyle(props.style)
    });
    this.payload = props;
    this.update = callback;
    this.attach();
  }

}

function createAnimatedComponent(Component) {
  class AnimatedComponent extends React__default.Component {
    constructor(props) {
      super();

      this.callback = () => {
        if (this.node) {
          const didUpdate = applyAnimatedValues.fn(this.node, this.propsAnimated.getAnimatedValue(), this);
          if (didUpdate === false) this.forceUpdate();
        }
      };

      this.attachProps(props);
    }

    componentWillUnmount() {
      this.propsAnimated && this.propsAnimated.detach();
    }

    setNativeProps(props) {
      const didUpdate = applyAnimatedValues.fn(this.node, props, this);
      if (didUpdate === false) this.forceUpdate();
    } // The system is best designed when setNativeProps is implemented. It is
    // able to avoid re-rendering and directly set the attributes that
    // changed. However, setNativeProps can only be implemented on leaf
    // native components. If you want to animate a composite component, you
    // need to re-render it. In this case, we have a fallback that uses
    // forceUpdate.


    attachProps(_ref) {
      let forwardRef = _ref.forwardRef,
          nextProps = _objectWithoutPropertiesLoose(_ref, ["forwardRef"]);

      const oldPropsAnimated = this.propsAnimated;
      this.propsAnimated = new AnimatedProps(nextProps, this.callback); // When you call detach, it removes the element from the parent list
      // of children. If it goes to 0, then the parent also detaches itself
      // and so on.
      // An optimization is to attach the new elements and THEN detach the old
      // ones instead of detaching and THEN attaching.
      // This way the intermediate state isn't to go to 0 and trigger
      // this expensive recursive detaching to then re-attach everything on
      // the very next operation.

      oldPropsAnimated && oldPropsAnimated.detach();
    }

    shouldComponentUpdate(props) {
      const style = props.style,
            nextProps = _objectWithoutPropertiesLoose(props, ["style"]);

      const _this$props = this.props,
            currentStyle = _this$props.style,
            currentProps = _objectWithoutPropertiesLoose(_this$props, ["style"]);

      if (!shallowEqual(currentProps, nextProps) || !shallowEqual(currentStyle, style)) {
        this.attachProps(props);
        return true;
      }

      return false;
    }

    render() {
      const _this$propsAnimated$g = this.propsAnimated.getValue(),
            scrollTop = _this$propsAnimated$g.scrollTop,
            scrollLeft = _this$propsAnimated$g.scrollLeft,
            animatedProps = _objectWithoutPropertiesLoose(_this$propsAnimated$g, ["scrollTop", "scrollLeft"]);

      return React__default.createElement(Component, _extends({}, animatedProps, {
        ref: node => this.node = handleRef(node, this.props.forwardRef)
      }));
    }

  }

  return React__default.forwardRef((props, ref) => React__default.createElement(AnimatedComponent, _extends({}, props, {
    forwardRef: ref
  })));
}

const config = {
  default: {
    tension: 170,
    friction: 26
  },
  gentle: {
    tension: 120,
    friction: 14
  },
  wobbly: {
    tension: 180,
    friction: 12
  },
  stiff: {
    tension: 210,
    friction: 20
  },
  slow: {
    tension: 280,
    friction: 60
  },
  molasses: {
    tension: 280,
    friction: 120
  }
};

class Spring extends React__default.Component {
  constructor() {
    super(...arguments);
    this.state = {
      lastProps: {
        from: {},
        to: {}
      },
      propsChanged: false,
      internal: false
    };
    this.controller = new Controller(null, null);
    this.didUpdate = false;
    this.didInject = false;
    this.finished = true;

    this.start = () => {
      this.finished = false;
      let wasMounted = this.mounted;
      this.controller.start(props => this.finish(_extends({}, props, {
        wasMounted
      })), this.update);
    };

    this.stop = () => this.controller.stop(true);

    this.update = () => this.mounted && this.setState({
      internal: true
    });

    this.finish = (_ref) => {
      let finished = _ref.finished,
          noChange = _ref.noChange,
          wasMounted = _ref.wasMounted;
      this.finished = true;

      if (this.mounted && finished) {
        // Only call onRest if either we *were* mounted, or when there were changes
        if (this.props.onRest && (wasMounted || !noChange)) this.props.onRest(this.controller.merged); // Restore end-state

        if (this.mounted && this.didInject) {
          this.afterInject = convertValues(this.props);
          this.setState({
            internal: true
          });
        } // If we have an inject or values to apply after the animation we ping here


        if (this.mounted && (this.didInject || this.props.after)) this.setState({
          internal: true
        });
        this.didInject = false;
      }
    };
  }

  componentDidMount() {
    // componentDidUpdate isn't called on mount, we call it here to start animating
    this.componentDidUpdate();
    this.mounted = true;
  }

  componentWillUnmount() {
    // Stop all ongoing animtions
    this.mounted = false;
    this.stop();
  }

  static getDerivedStateFromProps(props, _ref2) {
    let internal = _ref2.internal,
        lastProps = _ref2.lastProps;
    // The following is a test against props that could alter the animation
    const from = props.from,
          to = props.to,
          reset = props.reset,
          force = props.force;
    const propsChanged = !shallowEqual(to, lastProps.to) || !shallowEqual(from, lastProps.from) || reset && !internal || force && !internal;
    return {
      propsChanged,
      lastProps: props,
      internal: false
    };
  }

  render() {
    const children = this.props.children;
    const propsChanged = this.state.propsChanged; // Inject phase -----------------------------------------------------------
    // Handle injected frames, for instance targets/web/fix-auto
    // An inject will return an intermediary React node which measures itself out
    // .. and returns a callback when the values sought after are ready, usually "auto".

    if (this.props.inject && propsChanged && !this.injectProps) {
      const frame = this.props.inject(this.props, injectProps => {
        // The inject frame has rendered, now let's update animations...
        this.injectProps = injectProps;
        this.setState({
          internal: true
        });
      }); // Render out injected frame

      if (frame) return frame;
    } // Update phase -----------------------------------------------------------


    if (this.injectProps || propsChanged) {
      // We can potentially cause setState, but we're inside render, the flag prevents that
      this.didInject = false; // Update animations, this turns from/to props into AnimatedValues
      // An update can occur on injected props, or when own-props have changed.

      if (this.injectProps) {
        this.controller.update(this.injectProps); // didInject is needed, because there will be a 3rd stage, where the original values
        // .. will be restored after the animation is finished. When someone animates towards
        // .. "auto", the end-result should be "auto", not "1999px", which would block nested
        // .. height/width changes.

        this.didInject = true;
      } else if (propsChanged) this.controller.update(this.props); // Flag an update that occured, componentDidUpdate will start the animation later on


      this.didUpdate = true;
      this.afterInject = undefined;
      this.injectProps = undefined;
    } // Render phase -----------------------------------------------------------
    // Render out raw values or AnimatedValues depending on "native"


    let values = _extends({}, this.controller.getValues(), this.afterInject);

    if (this.finished) values = _extends({}, values, this.props.after);
    return Object.keys(values).length ? children(values) : null;
  }

  componentDidUpdate() {
    // The animation has to start *after* render, since at that point the scene
    // .. graph should be established, so we do it here. Unfortunatelly, non-native
    // .. animations as well as "auto"-injects call forceUpdate, so it's causing a loop.
    // .. didUpdate prevents that as it gets set only on prop changes.
    if (this.didUpdate) this.start();
    this.didUpdate = false;
  }

}
Spring.defaultProps = {
  from: {},
  to: {},
  config: config.default,
  native: false,
  immediate: false,
  reset: false,
  force: false,
  inject: bugfixes
};

class Trail extends React__default.PureComponent {
  constructor() {
    super(...arguments);
    this.first = true;
    this.instances = new Set();

    this.hook = (instance, index, length, reverse) => {
      // Add instance to set
      this.instances.add(instance); // Return undefined on the first index and from then on the previous instance

      if (reverse ? index === length - 1 : index === 0) return undefined;else return Array.from(this.instances)[reverse ? index + 1 : index - 1];
    };
  }

  render() {
    const _this$props = this.props,
          items = _this$props.items,
          _children = _this$props.children,
          _this$props$from = _this$props.from,
          from = _this$props$from === void 0 ? {} : _this$props$from,
          initial = _this$props.initial,
          reverse = _this$props.reverse,
          keys = _this$props.keys,
          delay = _this$props.delay,
          onRest = _this$props.onRest,
          props = _objectWithoutPropertiesLoose(_this$props, ["items", "children", "from", "initial", "reverse", "keys", "delay", "onRest"]);

    const array = toArray(items);
    return toArray(array).map((item, i) => React__default.createElement(Spring, _extends({
      onRest: i === 0 ? onRest : null,
      key: typeof keys === 'function' ? keys(item) : toArray(keys)[i],
      from: this.first && initial !== void 0 ? initial || {} : from
    }, props, {
      delay: i === 0 && delay || undefined,
      attach: instance => this.hook(instance, i, array.length, reverse),
      children: props => {
        const child = _children(item, i);

        return child ? child(props) : null;
      }
    })));
  }

  componentDidUpdate(prevProps) {
    this.first = false;
    if (prevProps.items !== this.props.items) this.instances.clear();
  }

}
Trail.defaultProps = {
  keys: item => item
};

const DEFAULT = '__default';

class KeyframesImpl extends React__default.PureComponent {
  constructor() {
    var _this;

    super(...arguments);
    _this = this;
    this.guid = 0;
    this.state = {
      props: {},
      resolve: () => null,
      last: true,
      index: 0
    };

    this.next = function (props, last, index) {
      if (last === void 0) {
        last = true;
      }

      if (index === void 0) {
        index = 0;
      }

      _this.running = true;
      return new Promise(resolve => {
        _this.mounted && _this.setState(state => ({
          props,
          resolve,
          last,
          index
        }), () => _this.running = false);
      });
    };
  }

  componentDidMount() {
    this.mounted = true;
    this.componentDidUpdate({});
  }

  componentWillUnmount() {
    this.mounted = false;
  }

  componentDidUpdate(previous) {
    var _this2 = this;

    const _this$props = this.props,
          states = _this$props.states,
          f = _this$props.filter,
          state = _this$props.state;

    if (previous.state !== this.props.state || this.props.reset && !this.running || !shallowEqual(states[state], previous.states[previous.state])) {
      if (states && state && states[state]) {
        const localId = ++this.guid;
        const slots = states[state];

        if (slots) {
          if (Array.isArray(slots)) {
            let q = Promise.resolve();

            for (let i = 0; i < slots.length; i++) {
              let index = i;
              let slot = slots[index];
              let last = index === slots.length - 1;
              q = q.then(() => localId === this.guid && this.next(f(slot), last, index));
            }
          } else if (typeof slots === 'function') {
            let index = 0;
            slots( // next
            function (props, last) {
              if (last === void 0) {
                last = false;
              }

              return localId === _this2.guid && _this2.next(f(props), last, index++);
            }, // cancel
            () => requestFrame(() => this.instance && this.instance.stop()), // ownprops
            this.props);
          } else {
            this.next(f(states[state]));
          }
        }
      }
    }
  }

  render() {
    const _this$state = this.state,
          props = _this$state.props,
          resolve = _this$state.resolve,
          last = _this$state.last,
          index = _this$state.index;
    if (!props || Object.keys(props).length === 0) return null;

    let _this$props2 = this.props,
        state = _this$props2.state,
        filter = _this$props2.filter,
        states = _this$props2.states,
        config = _this$props2.config,
        Component = _this$props2.primitive,
        _onRest = _this$props2.onRest,
        forwardRef = _this$props2.forwardRef,
        rest = _objectWithoutPropertiesLoose(_this$props2, ["state", "filter", "states", "config", "primitive", "onRest", "forwardRef"]); // Arrayed configs need an index to process


    if (Array.isArray(config)) config = config[index];
    return React__default.createElement(Component, _extends({
      ref: _ref => this.instance = handleRef(_ref, forwardRef),
      config: config
    }, rest, props, {
      onRest: args => {
        resolve(args);
        if (_onRest && last) _onRest(args);
      }
    }));
  }

}

KeyframesImpl.defaultProps = {
  state: DEFAULT
};
const Keyframes = React__default.forwardRef((props, ref) => React__default.createElement(KeyframesImpl, _extends({}, props, {
  forwardRef: ref
})));

Keyframes.create = primitive => function (states, filter) {
  if (filter === void 0) {
    filter = states => states;
  }

  if (typeof states === 'function' || Array.isArray(states)) states = {
    [DEFAULT]: states
  };
  return props => React__default.createElement(KeyframesImpl, _extends({
    primitive: primitive,
    states: states,
    filter: filter
  }, props));
};

Keyframes.Spring = states => Keyframes.create(Spring)(states, interpolateTo);

Keyframes.Trail = states => Keyframes.create(Trail)(states, interpolateTo);

let guid = 0;

let get = props => {
  let items = props.items,
      keys = props.keys,
      rest = _objectWithoutPropertiesLoose(props, ["items", "keys"]);

  items = toArray(items !== void 0 ? items : null);
  keys = typeof keys === 'function' ? items.map(keys) : toArray(keys); // Make sure numeric keys are interpreted as Strings (5 !== "5")

  return _extends({
    items,
    keys: keys.map(key => String(key))
  }, rest);
};

class Transition extends React__default.PureComponent {
  componentDidMount() {
    this.mounted = true;
  }

  componentWillUnmount() {
    this.mounted = false;
  }

  constructor(prevProps) {
    super(prevProps);

    this.destroyItem = (item, key, state) => values => {
      const _this$props = this.props,
            onRest = _this$props.onRest,
            onDestroyed = _this$props.onDestroyed;

      if (this.mounted) {
        onDestroyed && onDestroyed(item);
        this.setState((_ref) => {
          let deleted = _ref.deleted;
          return {
            deleted: deleted.filter(t => t.key !== key)
          };
        });
        onRest && onRest(item, state, values);
      }
    };

    this.state = {
      first: true,
      transitions: [],
      current: {},
      deleted: [],
      prevProps
    };
  }

  static getDerivedStateFromProps(props, _ref2) {
    let first = _ref2.first,
        prevProps = _ref2.prevProps,
        state = _objectWithoutPropertiesLoose(_ref2, ["first", "prevProps"]);

    let _get = get(props),
        items = _get.items,
        keys = _get.keys,
        initial = _get.initial,
        from = _get.from,
        enter = _get.enter,
        leave = _get.leave,
        update = _get.update,
        _get$trail = _get.trail,
        trail = _get$trail === void 0 ? 0 : _get$trail,
        unique = _get.unique,
        config = _get.config;

    let _get2 = get(prevProps),
        _keys = _get2.keys,
        _items = _get2.items;

    let current = _extends({}, state.current);

    let deleted = [...state.deleted]; // Compare next keys with current keys

    let currentKeys = Object.keys(current);
    let currentSet = new Set(currentKeys);
    let nextSet = new Set(keys);
    let added = keys.filter(item => !currentSet.has(item));
    let removed = state.transitions.filter(item => !item.destroyed && !nextSet.has(item.originalKey)).map(i => i.originalKey);
    let updated = keys.filter(item => currentSet.has(item));
    let delay = 0;
    added.forEach(key => {
      // In unique mode, remove fading out transitions if their key comes in again
      if (unique && deleted.find(d => d.originalKey === key)) deleted = deleted.filter(t => t.originalKey !== key);
      const keyIndex = keys.indexOf(key);
      const item = items[keyIndex];
      const state = 'enter';
      current[key] = {
        state,
        originalKey: key,
        key: unique ? String(key) : guid++,
        item,
        trail: delay = delay + trail,
        config: callProp(config, item, state),
        from: callProp(first ? initial !== void 0 ? initial || {} : from : from, item),
        to: callProp(enter, item)
      };
    });
    removed.forEach(key => {
      const keyIndex = _keys.indexOf(key);

      const item = _items[keyIndex];
      const state = 'leave';
      deleted.push(_extends({}, current[key], {
        state,
        destroyed: true,
        left: _keys[Math.max(0, keyIndex - 1)],
        right: _keys[Math.min(_keys.length, keyIndex + 1)],
        trail: delay = delay + trail,
        config: callProp(config, item, state),
        to: callProp(leave, item)
      }));
      delete current[key];
    });
    updated.forEach(key => {
      const keyIndex = keys.indexOf(key);
      const item = items[keyIndex];
      const state = 'update';
      current[key] = _extends({}, current[key], {
        item,
        state,
        trail: delay = delay + trail,
        config: callProp(config, item, state),
        to: callProp(update, item)
      });
    }); // This tries to restore order for deleted items by finding their last known siblings

    let out = keys.map(key => current[key]);
    deleted.forEach((_ref3) => {
      let left = _ref3.left,
          right = _ref3.right,
          transition = _objectWithoutPropertiesLoose(_ref3, ["left", "right"]);

      let pos; // Was it the element on the left, if yes, move there ...

      if ((pos = out.findIndex(t => t.originalKey === left)) !== -1) pos += 1; // Or how about the element on the right ...

      if (pos === -1) pos = out.findIndex(t => t.originalKey === right); // Maybe we'll find it in the list of deleted items

      if (pos === -1) pos = deleted.findIndex(t => t.originalKey === left); // Checking right side as well

      if (pos === -1) pos = deleted.findIndex(t => t.originalKey === right); // And if nothing else helps, move it to the start ¯\_(ツ)_/¯

      pos = Math.max(0, pos);
      out = [...out.slice(0, pos), transition, ...out.slice(pos)];
    });
    return {
      first: first && added.length === 0,
      transitions: out,
      current,
      deleted,
      prevProps: props
    };
  }

  render() {
    const _this$props2 = this.props,
          initial = _this$props2.initial,
          _this$props2$from = _this$props2.from,
          _this$props2$enter = _this$props2.enter,
          _this$props2$leave = _this$props2.leave,
          _this$props2$update = _this$props2.update,
          onDestroyed = _this$props2.onDestroyed,
          keys = _this$props2.keys,
          items = _this$props2.items,
          onFrame = _this$props2.onFrame,
          onRest = _this$props2.onRest,
          onStart = _this$props2.onStart,
          trail = _this$props2.trail,
          config = _this$props2.config,
          _children = _this$props2.children,
          unique = _this$props2.unique,
          reset = _this$props2.reset,
          extra = _objectWithoutPropertiesLoose(_this$props2, ["initial", "from", "enter", "leave", "update", "onDestroyed", "keys", "items", "onFrame", "onRest", "onStart", "trail", "config", "children", "unique", "reset"]);

    return this.state.transitions.map((_ref4, i) => {
      let state = _ref4.state,
          key = _ref4.key,
          item = _ref4.item,
          from = _ref4.from,
          to = _ref4.to,
          trail = _ref4.trail,
          config = _ref4.config,
          destroyed = _ref4.destroyed;
      return React__default.createElement(Keyframes, _extends({
        reset: reset && state === 'enter',
        primitive: Spring,
        state: state,
        filter: interpolateTo,
        states: {
          [state]: to
        },
        key: key,
        onRest: destroyed ? this.destroyItem(item, key, state) : onRest && (values => onRest(item, state, values)),
        onStart: onStart && (() => onStart(item, state)),
        onFrame: onFrame && (values => onFrame(item, state, values)),
        delay: trail,
        config: config
      }, extra, {
        from: from,
        children: props => {
          const child = _children(item, state, i);

          return child ? child(props) : null;
        }
      }));
    });
  }

}
Transition.defaultProps = {
  keys: item => item,
  unique: false,
  reset: false
};

const domElements = ['a', 'abbr', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bdi', 'bdo', 'big', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'data', 'datalist', 'dd', 'del', 'details', 'dfn', 'dialog', 'div', 'dl', 'dt', 'em', 'embed', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend', 'li', 'link', 'main', 'map', 'mark', 'marquee', 'menu', 'menuitem', 'meta', 'meter', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'p', 'param', 'picture', 'pre', 'progress', 'q', 'rp', 'rt', 'ruby', 's', 'samp', 'script', 'section', 'select', 'small', 'source', 'span', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'time', 'title', 'tr', 'track', 'u', 'ul', 'var', 'video', 'wbr', // SVG
'circle', 'clipPath', 'defs', 'ellipse', 'foreignObject', 'g', 'image', 'line', 'linearGradient', 'mask', 'path', 'pattern', 'polygon', 'polyline', 'radialGradient', 'rect', 'stop', 'svg', 'text', 'tspan'];
const extendedAnimated = domElements.reduce((acc, element) => {
  acc[element] = createAnimatedComponent(element);
  return acc;
}, createAnimatedComponent);

exports.Spring = Spring;
exports.Keyframes = Keyframes;
exports.Transition = Transition;
exports.Trail = Trail;
exports.Controller = Controller;
exports.config = config;
exports.animated = extendedAnimated;
exports.interpolate = interpolate$1;
exports.Globals = Globals;


/***/ }),

/***/ "./src/common/CustomizerItem.js":
/*!**************************************!*\
  !*** ./src/common/CustomizerItem.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

var __ = wp.i18n.__;

var CustomizerItem = function CustomizerItem(props) {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    id: props.id,
    className: "option-card"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "option"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
    className: "customize-control-title kmt-control-title"
  }, props.params.label), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "description customize-control-description"
  }, props.params.description)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "option-actions"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("a", {
    className: "kmt-button",
    href: props.params.url
  }, __('Customize', 'kemet')))));
};

/* harmony default export */ __webpack_exports__["default"] = (CustomizerItem);

/***/ }),

/***/ "./src/common/SingleOption.js":
/*!************************************!*\
  !*** ./src/common/SingleOption.js ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

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





var __ = wp.i18n.__;

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
              body.append('nonce', KemetPanelData.nonce);
              body.append('option', props.id);
              body.append('value', newValue);
              console.log(props.id, newValue);
              _context.prev = 8;
              _context.next = 11;
              return fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body: body
              });

            case 11:
              response = _context.sent;

              if (!(response.status === 200)) {
                _context.next = 19;
                break;
              }

              _context.next = 15;
              return response.json();

            case 15:
              _yield$response$json = _context.sent;
              success = _yield$response$json.success;
              data = _yield$response$json.data;

              if (success && data.values) {
                console.log(data.values);
                setValue(newValue);
                props.onChange(data.values);
              }

            case 19:
              _context.next = 24;
              break;

            case 21:
              _context.prev = 21;
              _context.t0 = _context["catch"](8);
              console.log(_context.t0);

            case 24:
              setIsLoading(false);

            case 25:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[8, 21]]);
    }));

    return function handleChange() {
      return _ref.apply(this, arguments);
    };
  }();

  var btnText = value === true ? __('Deactivate', 'kemet') : __('Activate', 'kemet');
  var btnClasses = value === true ? 'secondary' : 'primary';
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    id: props.id,
    className: "option-card"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "option"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("span", {
    className: "customize-control-title kmt-control-title"
  }, props.params.label), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "description customize-control-description"
  }, props.params.description)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
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
  }, __('Customize', 'kemet')))));
};

/* harmony default export */ __webpack_exports__["default"] = (SingleOption);

/***/ }),

/***/ "./src/common/SinglePlugins.js":
/*!*************************************!*\
  !*** ./src/common/SinglePlugins.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

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
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);







var SinglePlugin = function SinglePlugin(_ref) {
  var plugin = _ref.plugin,
      slug = _ref.slug,
      status = _ref.status,
      handlePluginChange = _ref.handlePluginChange;

  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState, 2),
      loader = _useState2[0],
      setLoader = _useState2[1];

  var doAction = /*#__PURE__*/function () {
    var _ref2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee(action) {
      var body, response, _yield$response$json, success;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              if (!loader) {
                setLoader(true);
              }

              body = new FormData();
              body.append('action', action);
              body.append('nonce', KemetPanelData.plugin_manager_nonce);
              body.append('path', plugin.path);
              body.append('slug', slug);
              _context.prev = 6;
              _context.next = 9;
              return fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body: body
              });

            case 9:
              response = _context.sent;

              if (!(response.status === 200)) {
                _context.next = 16;
                break;
              }

              _context.next = 13;
              return response.json();

            case 13:
              _yield$response$json = _context.sent;
              success = _yield$response$json.success;

              if (success) {
                handlePluginChange();
                setLoader(false);
              }

            case 16:
              _context.next = 21;
              break;

            case 18:
              _context.prev = 18;
              _context.t0 = _context["catch"](6);
              alert(_context.t0);

            case 21:
              setLoader(false);

            case 22:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[6, 18]]);
    }));

    return function doAction(_x) {
      return _ref2.apply(this, arguments);
    };
  }();

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("li", {
    className: "kmt-plugin-card"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "kmt-plugin-icon"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("img", {
    src: KemetPanelData.images_url + slug + '.png'
  }), loader && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "kmt-loader"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Loading', 'kemet-addons'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "kmt-plugin-data"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("h4", {
    className: "kmt-plugin-title"
  }, plugin.name), plugin.description && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "kmt-plugin-description",
    dangerouslySetInnerHTML: {
      __html: plugin.description
    }
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "plugin-action"
  }, status === 'deactivate' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("a", {
    onClick: function onClick() {
      return doAction('kemet-deactivate-plugin');
    },
    className: "kmt-button secondary"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Deactivate', 'kemet-addons')), status === 'activate' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("a", {
    onClick: function onClick() {
      return doAction('kemet-activate-plugin');
    },
    className: "kmt-button primary"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Activate', 'kemet-addons')), status === 'install' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("a", {
    onClick: function onClick() {
      return doAction('kemet-install-plugin');
    },
    className: "kmt-button primary"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Install', 'kemet-addons'))));
};

/* harmony default export */ __webpack_exports__["default"] = (SinglePlugin);

/***/ }),

/***/ "./src/common/logo.js":
/*!****************************!*\
  !*** ./src/common/logo.js ***!
  \****************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);


var Logo = function Logo() {
  var style = '.cls-1{fill:#1a1a1a;}.cls-2{fill:#fab522;}';
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("svg", {
    id: "Layer_1",
    "data-name": "Layer 1",
    xmlns: "http://www.w3.org/2000/svg",
    width: "198",
    height: "58.04",
    viewBox: "0 0 198 58.04"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("defs", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("style", null, style)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("title", null, "kemet-logo"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M48.42,55.14h-.91l-1.79-4.76L44,55.14h-.9l-2.26-7h1.13l1.62,5.13,1.9-5.11H46l2,5.11,1.58-5.13h1.13Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M61.65,53.5a3.36,3.36,0,0,1-1.31,1.28,3.65,3.65,0,0,1-1.86.47,3.73,3.73,0,0,1-1.87-.46,3.43,3.43,0,0,1-1.3-1.29,3.82,3.82,0,0,1,0-3.67,3.36,3.36,0,0,1,1.3-1.29,3.94,3.94,0,0,1,3.73,0,3.25,3.25,0,0,1,1.31,1.29,3.61,3.61,0,0,1,.47,1.83A3.68,3.68,0,0,1,61.65,53.5Zm-.94-3.14a2.33,2.33,0,0,0-.92-.92,2.58,2.58,0,0,0-1.31-.33,2.55,2.55,0,0,0-1.32.34,2.34,2.34,0,0,0-.91.91,2.73,2.73,0,0,0,0,2.6,2.37,2.37,0,0,0,.91.92,2.64,2.64,0,0,0,1.32.33,2.58,2.58,0,0,0,1.31-.33,2.43,2.43,0,0,0,.92-.91A2.58,2.58,0,0,0,61,51.66,2.54,2.54,0,0,0,60.71,50.36Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M71.05,55.14,69.61,52.5H68.26v2.64H67.21v-7h2.63a2.27,2.27,0,0,1,1.63.62,2,2,0,0,1,.64,1.55,2.08,2.08,0,0,1-1.41,2l1.62,2.78ZM69.8,49.21H68.26v2.28H69.8a1.31,1.31,0,0,0,.91-.32,1.06,1.06,0,0,0,.34-.82,1,1,0,0,0-.35-.82A1.24,1.24,0,0,0,69.8,49.21Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M82.67,53.45a3,3,0,0,1-1.25,1.24,3.64,3.64,0,0,1-1.8.45H77.28v-7h2.34a3.71,3.71,0,0,1,1.79.44,3.2,3.2,0,0,1,1.26,1.24,3.79,3.79,0,0,1,0,3.58Zm-.94-3.06a2.27,2.27,0,0,0-.86-.88,2.58,2.58,0,0,0-1.28-.31H78.37v4.94h1.22a2.41,2.41,0,0,0,2.46-2.48A2.74,2.74,0,0,0,81.73,50.39Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M90.71,52.72H89.27v2.42h-1v-7h2.48a2.28,2.28,0,0,1,1.64.65A2.17,2.17,0,0,1,93,50.46a2.2,2.2,0,0,1-.66,1.61A2.3,2.3,0,0,1,90.71,52.72Zm0-3.5h-1.4v2.47h1.4a1.28,1.28,0,0,0,.92-.35,1.16,1.16,0,0,0,.37-.88,1.15,1.15,0,0,0-.37-.88A1.25,1.25,0,0,0,90.67,49.22Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M101.79,55.14l-1.44-2.64H99v2.64H98v-7h2.63a2.25,2.25,0,0,1,1.62.62,2,2,0,0,1,.65,1.55,2.09,2.09,0,0,1-.38,1.23,2.15,2.15,0,0,1-1,.77l1.62,2.78Zm-1.25-5.93H99v2.28h1.55a1.33,1.33,0,0,0,.91-.32,1.06,1.06,0,0,0,.34-.82,1,1,0,0,0-.35-.82A1.24,1.24,0,0,0,100.54,49.21Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M109.05,49.21v1.86h3v1h-3v2h3v1H108v-7h4.07v1Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M120.48,55a3.3,3.3,0,0,1-1.24.24,2.89,2.89,0,0,1-1.33-.3,2.18,2.18,0,0,1-.92-.86,2.37,2.37,0,0,1-.32-1.28h1.06a1.31,1.31,0,0,0,.41,1,1.51,1.51,0,0,0,1.09.38,1.57,1.57,0,0,0,1-.3.89.89,0,0,0,.39-.75.82.82,0,0,0-.1-.4.78.78,0,0,0-.26-.26.82.82,0,0,0-.22-.12l-.19-.08-.25-.07-.26-.08-.29-.06c-.46-.12-.83-.23-1.12-.33a1.63,1.63,0,0,1-1.1-1.31,1.78,1.78,0,0,1,0-.34,1.75,1.75,0,0,1,.64-1.44,2.63,2.63,0,0,1,1.73-.54,2.4,2.4,0,0,1,1.71.61,2.16,2.16,0,0,1,.63,1.65h-1a1.18,1.18,0,0,0-.37-.9,1.37,1.37,0,0,0-1-.34,1.6,1.6,0,0,0-1,.26.8.8,0,0,0-.36.66.72.72,0,0,0,.15.45,1.23,1.23,0,0,0,.41.29l.28.11A2.37,2.37,0,0,0,119,51a15.19,15.19,0,0,1,1.48.43,1.68,1.68,0,0,1,1.15,1.3,3.32,3.32,0,0,1,0,.41,2,2,0,0,1-.33,1.13A2,2,0,0,1,120.48,55Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M130.08,55a3.3,3.3,0,0,1-1.24.24,2.86,2.86,0,0,1-1.33-.3,2.13,2.13,0,0,1-.92-.86,2.37,2.37,0,0,1-.32-1.28h1.06a1.28,1.28,0,0,0,.41,1,1.48,1.48,0,0,0,1.09.38,1.59,1.59,0,0,0,1-.3.89.89,0,0,0,.39-.75.82.82,0,0,0-.1-.4.78.78,0,0,0-.26-.26.92.92,0,0,0-.23-.12l-.18-.08-.25-.07-.27-.08-.28-.06c-.46-.12-.84-.23-1.12-.33a1.62,1.62,0,0,1-1.1-1.31,1.72,1.72,0,0,1,0-.34,1.76,1.76,0,0,1,.65-1.44,2.6,2.6,0,0,1,1.72-.54,2.37,2.37,0,0,1,1.71.61,2.2,2.2,0,0,1,.64,1.65h-1a1.18,1.18,0,0,0-.36-.9,1.41,1.41,0,0,0-1-.34,1.56,1.56,0,0,0-.94.26.8.8,0,0,0-.36.66.72.72,0,0,0,.15.45,1.13,1.13,0,0,0,.41.29,1.8,1.8,0,0,0,.28.11,1.93,1.93,0,0,0,.33.09c.71.18,1.2.32,1.49.43a1.68,1.68,0,0,1,1.15,1.3,3.17,3.17,0,0,1,0,.41,2,2,0,0,1-.32,1.13A2.09,2.09,0,0,1,130.08,55Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M144.64,49.2v5.94h-1V49.2h-2v-1h5.1v1Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M155.79,55.14V52.08h-3.24v3.06H151.5v-7h1.05v2.86h3.24V48.19h1.05v7Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M163.44,49.21v1.86h3v1h-3v2h3v1h-4.05v-7h4.06v1Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M178.61,55.14l-.84-5-2.22,5h-.37l-2.22-5-.85,5H171l1.18-7h1L175.36,53l2.18-4.85h1l1.15,7Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M185.77,49.21v1.86h3v1h-3v2h3v1h-4.06v-7h4.07v1Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-2",
    d: "M1,29V45H2.59c7.46,0,12.71-7.16,14.79-20.16l.3-1.84H1v3H13.15C12,31.69,9.54,39.39,4,40.57V29Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-2",
    d: "M4,13.38A8.32,8.32,0,0,1,5.79,8.22l5.11,5.32a2.56,2.56,0,0,0,1.65,1,1.5,1.5,0,0,0,1-.39l.14-.13,5.56-5.78A8.32,8.32,0,0,1,21,13.38V14h3v-.64a11.59,11.59,0,0,0-2.72-7.46L23.9,3.15,21.64,1,19,3.82A11.43,11.43,0,0,0,6,3.82C4.54,2.22,3.4,1,3.36,1L1.1,3.15,3.72,5.92A11.59,11.59,0,0,0,1,13.38V14H4Zm8.81-8.71A8.34,8.34,0,0,1,17.1,5.85l-4.29,4.5L8.53,5.85A8.31,8.31,0,0,1,12.81,4.67Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-2",
    d: "M18,56,14.64,45.94A29.1,29.1,0,0,0,21.17,34.5,60.5,60.5,0,0,0,24,18.61L24,17H1v3H20.92c-.45,6.17-3.13,28-18.35,28H1v3H2.55a18,18,0,0,0,3.78-.4L8.14,56H1v3H24V56ZM9.64,49.58A16.43,16.43,0,0,0,12.41,48l2.67,8H11.8Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M48,21.24h1.41A2.92,2.92,0,0,0,52,20.14L60.73,8.4a3.41,3.41,0,0,1,1.36-1.16,4.63,4.63,0,0,1,1.82-.32h6.21l-11,14.23a7.06,7.06,0,0,1-2.23,2,6.4,6.4,0,0,1,1.51.87,7.32,7.32,0,0,1,1.29,1.43L71,41.61H64.6a5.3,5.3,0,0,1-1.06-.09,3.1,3.1,0,0,1-.78-.26,2.11,2.11,0,0,1-.58-.42,3.52,3.52,0,0,1-.45-.59L52.81,27.77a2.55,2.55,0,0,0-1.08-.92A4.44,4.44,0,0,0,50,26.57H48v15H40.81V6.92H48Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M81.26,12.54v8.92H92.84v5.43H81.26V36H96.14v5.61H74V6.92h22.1v5.62Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M139.75,6.92V41.61h-6.34V20.31c0-.45,0-.92,0-1.43s.07-1,.13-1.56l-9.92,18.82a2.65,2.65,0,0,1-2.51,1.55h-1a2.82,2.82,0,0,1-1.48-.39,2.79,2.79,0,0,1-1-1.16l-10-18.89c0,.56.09,1.1.12,1.61s0,1,0,1.45v21.3h-6.34V6.92h5.45l.82,0a2,2,0,0,1,.63.14,1.45,1.45,0,0,1,.5.33,2.56,2.56,0,0,1,.45.63L119,26.55c.31.56.59,1.13.85,1.72s.52,1.2.76,1.82c.24-.64.49-1.26.75-1.87s.54-1.18.85-1.74L131.88,8a2.57,2.57,0,0,1,.46-.63,1.59,1.59,0,0,1,.51-.33,2,2,0,0,1,.62-.14l.83,0Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M154.22,12.54v8.92h11.57v5.43H154.22V36h14.87v5.61H147V6.92h22.09v5.62Z",
    transform: "translate(-1 -0.98)"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
    class: "cls-1",
    d: "M199,12.71H188.86v28.9h-7.19V12.71H171.53V6.92H199Z",
    transform: "translate(-1 -0.98)"
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (Logo);

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _tabs_options__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./tabs/options */ "./src/tabs/options.js");
/* harmony import */ var _tabs_plugins__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./tabs/plugins */ "./src/tabs/plugins.js");
/* harmony import */ var _tabs_system__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./tabs/system */ "./src/tabs/system.js");
/* harmony import */ var _layout_Header__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./layout/Header */ "./src/layout/Header.js");






var __ = wp.i18n.__;
var _wp$components = wp.components,
    TabPanel = _wp$components.TabPanel,
    Panel = _wp$components.Panel,
    PanelBody = _wp$components.PanelBody;

var RendeTabs = function RendeTabs(_ref) {
  var options = _ref.options,
      values = _ref.values;
  var tabs = [{
    name: 'customizer-options',
    title: __('Customize Your Site', 'kemet'),
    className: 'customizer-options'
  }, {
    name: 'plugins',
    title: __('Recommended Plugins', 'kemet'),
    className: 'plugins'
  }, {
    name: 'system',
    title: __('System Info', 'kemet'),
    className: 'system'
  }];
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_layout_Header__WEBPACK_IMPORTED_MODULE_4__["default"], null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(TabPanel, {
    className: "kemet-dashboard-tab-panel",
    activeClass: "active-tab",
    tabs: tabs
  }, function (tab) {
    switch (tab.name) {
      case 'customizer-options':
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Panel, {
          className: "dashboard-section tab-section"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
          opened: true
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_options__WEBPACK_IMPORTED_MODULE_1__["default"], {
          "customize-options": options.customize,
          options: options.options,
          values: values.options
        })));

      case 'plugins':
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Panel, {
          className: "dashboard-section tab-section"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
          opened: true
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_plugins__WEBPACK_IMPORTED_MODULE_2__["default"], null)));

      case 'system':
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(Panel, {
          className: "dashboard-section tab-section"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
          opened: true
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_system__WEBPACK_IMPORTED_MODULE_3__["default"], null)));
    }
  }));
};

document.addEventListener('DOMContentLoaded', function () {
  if (document.getElementById('kmt-dashboard')) {
    var sidebar = document.getElementById("adminmenuwrap"),
        sidebarHeight = sidebar.offsetHeight + 'px';
    console.log(sidebarHeight);
    document.getElementById("wpbody").style.minHeight = sidebarHeight;
    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["render"])(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(RendeTabs, {
      options: KemetPanelData.options,
      values: KemetPanelData.values
    }), document.getElementById('kmt-dashboard'));
  }
});

/***/ }),

/***/ "./src/layout/Header.js":
/*!******************************!*\
  !*** ./src/layout/Header.js ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_logo__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../common/logo */ "./src/common/logo.js");


var __ = wp.i18n.__;

var Header = function Header() {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-panel-header"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "logo"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_common_logo__WEBPACK_IMPORTED_MODULE_1__["default"], null)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("a", {
    href: "#",
    className: "docs kmt-button secondary",
    target: "_blank"
  }, __('Documentation', 'kemet')));
};

/* harmony default export */ __webpack_exports__["default"] = (Header);

/***/ }),

/***/ "./src/options-component.js":
/*!**********************************!*\
  !*** ./src/options-component.js ***!
  \**********************************/
/*! exports provided: RenderStaticOptions, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "RenderStaticOptions", function() { return RenderStaticOptions; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_CustomizerItem__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./common/CustomizerItem */ "./src/common/CustomizerItem.js");
/* harmony import */ var _common_SingleOption__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./common/SingleOption */ "./src/common/SingleOption.js");




var SingleOptionComponent = function SingleOptionComponent(_ref) {
  var value = _ref.value,
      optionId = _ref.optionId,
      option = _ref.option,
      onChange = _ref.onChange;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_common_SingleOption__WEBPACK_IMPORTED_MODULE_2__["default"], {
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

var RenderStaticOptions = function RenderStaticOptions(_ref4) {
  var options = _ref4.options;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "kmt-options"
  }, Object.keys(options).map(function (optionId) {
    var option = options[optionId];
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_common_CustomizerItem__WEBPACK_IMPORTED_MODULE_1__["default"], {
      id: optionId,
      params: option
    });
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (OptionsComponent);

/***/ }),

/***/ "./src/tabs/options.js":
/*!*****************************!*\
  !*** ./src/tabs/options.js ***!
  \*****************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _options_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../options-component */ "./src/options-component.js");




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

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "customize-site-options options-section"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("h2", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
    className: "icon"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(Dashicon, {
    icon: "admin-customizer"
  })), __('Customize Your Site', 'kemet')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_options_component__WEBPACK_IMPORTED_MODULE_2__["RenderStaticOptions"], {
    options: props['customize-options']
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "advanced-options options-section"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("h2", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
    className: "icon"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(Dashicon, {
    icon: "screenoptions"
  })), __('Advanced Settings', 'kemet')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_options_component__WEBPACK_IMPORTED_MODULE_2__["default"], {
    options: options,
    values: values,
    onChange: function onChange(newVal, optionId) {
      handleChange(newVal, optionId);
    }
  })));
};

/* harmony default export */ __webpack_exports__["default"] = (OptionsTab);

/***/ }),

/***/ "./src/tabs/plugins.js":
/*!*****************************!*\
  !*** ./src/tabs/plugins.js ***!
  \*****************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

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
/* harmony import */ var _common_SinglePlugins__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../common/SinglePlugins */ "./src/common/SinglePlugins.js");
/* harmony import */ var react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-spring/renderprops */ "./node_modules/react-spring/renderprops.js");
/* harmony import */ var react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__);








var pluginsCache = KemetPanelData.plugins_cache;

var Plugins = function Plugins() {
  var plugins = KemetPanelData.plugins_data;

  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["useState"])(pluginsCache || []),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState, 2),
      pluginsStatus = _useState2[0],
      setPluginStatus = _useState2[1];

  var _useState3 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["useState"])(!pluginsCache),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState3, 2),
      isLoading = _useState4[0],
      setLoading = _useState4[1];

  var updatePluginsStatus = /*#__PURE__*/function () {
    var _ref = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee() {
      var enableLoader,
          body,
          response,
          _yield$response$json,
          success,
          data,
          _args = arguments;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              enableLoader = _args.length > 0 && _args[0] !== undefined ? _args[0] : false;

              if (enableLoader) {
                setLoading(true);
              }

              body = new FormData();
              body.append('action', 'kemet-plugins-status');
              body.append('nonce', KemetPanelData.nonce);
              _context.prev = 5;
              _context.next = 8;
              return fetch(KemetPanelData.ajaxurl, {
                method: 'POST',
                body: body
              });

            case 8:
              response = _context.sent;

              if (!(response.status === 200)) {
                _context.next = 16;
                break;
              }

              _context.next = 12;
              return response.json();

            case 12:
              _yield$response$json = _context.sent;
              success = _yield$response$json.success;
              data = _yield$response$json.data;

              if (success) {
                setPluginStatus(data);
                pluginsCache = data;
              }

            case 16:
              _context.next = 21;
              break;

            case 18:
              _context.prev = 18;
              _context.t0 = _context["catch"](5);
              alert(_context.t0);

            case 21:
              setLoading(false);

            case 22:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[5, 18]]);
    }));

    return function updatePluginsStatus() {
      return _ref.apply(this, arguments);
    };
  }();

  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["useEffect"])(function () {
    if (!pluginsCache) {
      updatePluginsStatus(!pluginsCache);
    }
  }, []);
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5__["Transition"], {
    items: isLoading,
    from: {
      opacity: 0
    },
    enter: [{
      opacity: 1
    }],
    leave: [{
      opacity: 0
    }],
    initial: null,
    config: function config(key, phase) {
      return phase === 'leave' ? {
        duration: 300
      } : {
        delay: 300,
        duration: 300
      };
    }
  }, function (isLoading) {
    if (isLoading) {
      return function (props) {
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5__["animated"].p, {
          style: props,
          className: "kmt-loading-text"
        }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("span", null), Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__["__"])('Loading Plugins Status...', 'kemet-addons'));
      };
    }

    return function (props) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(react_spring_renderprops__WEBPACK_IMPORTED_MODULE_5__["animated"].div, {
        style: props
      }, Object.keys(plugins).length > 0 && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("ul", {
        className: "kmt-plugins-list"
      }, Object.keys(plugins).map(function (plugin) {
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_common_SinglePlugins__WEBPACK_IMPORTED_MODULE_4__["default"], {
          plugin: plugins[plugin],
          slug: plugin,
          status: pluginsStatus[plugin],
          handlePluginChange: function handlePluginChange() {
            updatePluginsStatus();
          }
        });
      }))));
    };
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (Plugins);

/***/ }),

/***/ "./src/tabs/system.js":
/*!****************************!*\
  !*** ./src/tabs/system.js ***!
  \****************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);




var System = function System() {
  var _KemetPanelData = KemetPanelData,
      system_info = _KemetPanelData.system_info;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    id: "system-info"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("table", {
    className: "widefat",
    cellspacing: "0"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("thead", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("th", {
    colspan: "2"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WordPress Environment', 'kemet-addons')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tbody", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Home URL', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.home_url)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Site URL', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.site_url)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WP Version', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.version)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WP Multisite', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", {
    dangerouslySetInnerHTML: {
      __html: system_info.multisite ? '&#10004;' : '&ndash;'
    }
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WP Memory Limit', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("mark", null, system_info.memory_limit_size, " ", system_info.memory_limit < 67108864 && Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('We recommend setting wp memory at least 64MB.', 'kemet-addons')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Theme Version', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.theme_version)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WP Path', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.wp_path)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('WP Debug Mode', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", {
    dangerouslySetInnerHTML: {
      __html: system_info.debug ? '&#10004;' : '&ndash;'
    }
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Language', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.lang)))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("table", {
    className: "widefat",
    cellspacing: "0"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("thead", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("th", {
    colspan: "2"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Server Environment', 'kemet-addons')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tbody", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Server Info', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.server)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('PHP Version', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.php_version ? system_info.php_version : Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])("Couldn't determine PHP version because phpversion() doesn't exist.", 'kemet-addons'))), system_info.ini_get && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('PHP Memory Limit', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.memory_limit)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('PHP Post Max Size', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.post_max_size)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('PHP Time Limit', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("mark", null, system_info.max_execution_time, " ", system_info.memory_limit < 60 && 0 != system_info.memory_limit && Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('We recommend setting max execution time at least 60.', 'kemet-addons')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('PHP Max Input Vars', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.max_input_vars)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('SUHOSIN Installed', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", {
    dangerouslySetInnerHTML: {
      __html: system_info.suhosin ? '&#10004;' : '&ndash;'
    }
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('MySQL Version', 'kemet-addons')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, system_info.mysql_version))))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("table", {
    className: "widefat",
    cellspacing: "0"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("thead", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("th", {
    colspan: "2"
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Active Plugins', 'kemet-addons')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tbody", null, Object.keys(system_info.active_plugins).length > 0 && Object.keys(system_info.active_plugins).map(function (plugin) {
    var pluginData = system_info.active_plugins[plugin];
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", null, pluginData.PluginURI ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("a", {
      href: pluginData.PluginURI,
      target: "_blank",
      title: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Visit plugin homepage', 'kemet-addons')
    }, pluginData.name) : pluginData.name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("td", {
      dangerouslySetInnerHTML: {
        __html: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('by', 'kemet-addons') + ' - ' + pluginData.author + ' - ' + pluginData.version
      }
    }));
  }))));
};

/* harmony default export */ __webpack_exports__["default"] = (System);

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

/***/ }),

/***/ "react-dom":
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["ReactDOM"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map