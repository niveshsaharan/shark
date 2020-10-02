(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./resources/js/components/InertiaLayout.js":
/*!**************************************************!*\
  !*** ./resources/js/components/InertiaLayout.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return InertiaLayout; });
/* harmony import */ var _niveshsaharan_inertia_react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @niveshsaharan/inertia-react */ "./node_modules/@niveshsaharan/inertia-react/dist/index.js");
/* harmony import */ var _niveshsaharan_inertia_react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_niveshsaharan_inertia_react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function InertiaLayout(_ref) {
  var title = _ref.title,
      children = _ref.children;

  var _usePage = Object(_niveshsaharan_inertia_react__WEBPACK_IMPORTED_MODULE_0__["usePage"])(),
      flash = _usePage.flash;

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    document.title = title;
  }, [title]);
  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    if (flash.error || flash.success) {
      window.Events.$emit('flash', flash.error || flash.success, !!flash.error);
    }
  }, [flash]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, children);
}

/***/ }),

/***/ "./resources/js/pages/SampleSettingPage.js":
/*!*************************************************!*\
  !*** ./resources/js/pages/SampleSettingPage.js ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SampleSettingPage; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shopify_polaris__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @shopify/polaris */ "./node_modules/@shopify/polaris/dist/esm/index.js");
/* harmony import */ var _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @niveshsaharan/inertia */ "./node_modules/@niveshsaharan/inertia/dist/index.js");
/* harmony import */ var _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _shopify_app_bridge_react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @shopify/app-bridge-react */ "./node_modules/@shopify/app-bridge-react/index.js");
/* harmony import */ var _shopify_app_bridge_react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_shopify_app_bridge_react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../functions */ "./resources/js/functions.js");
/* harmony import */ var _components_InertiaLayout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/InertiaLayout */ "./resources/js/components/InertiaLayout.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }








var SampleSettingPage = /*#__PURE__*/function (_React$Component) {
  _inherits(SampleSettingPage, _React$Component);

  var _super = _createSuper(SampleSettingPage);

  function SampleSettingPage() {
    var _temp, _this;

    _classCallCheck(this, SampleSettingPage);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _possibleConstructorReturn(_this, (_temp = _this = _super.call.apply(_super, [this].concat(args)), _this.state = {
      settings: _this.props.settings
    }, _this.save = function () {
      _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__["Inertia"].put(Object(_functions__WEBPACK_IMPORTED_MODULE_4__["route"])('setting.update'), _this.state.settings, {
        replace: false,
        preserveState: false,
        preserveScroll: true
      });
    }, _temp));
  }

  _createClass(SampleSettingPage, [{
    key: "render",
    value: function render() {
      var _this2 = this;

      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_components_InertiaLayout__WEBPACK_IMPORTED_MODULE_5__["default"], {
        title: "Settings"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Page"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_app_bridge_react__WEBPACK_IMPORTED_MODULE_3__["TitleBar"], {
        title: "Settings",
        primaryAction: {
          content: 'Save',
          disabled: JSON.stringify(this.props.settings) === JSON.stringify(this.state.settings),
          onAction: this.save
        },
        secondaryActions: [{
          content: 'Home',
          disabled: Object(_functions__WEBPACK_IMPORTED_MODULE_4__["route"])().current('home'),
          onAction: function onAction() {
            return _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__["Inertia"].visit(Object(_functions__WEBPACK_IMPORTED_MODULE_4__["route"])('home'));
          }
        }, {
          content: 'Settings',
          disabled: Object(_functions__WEBPACK_IMPORTED_MODULE_4__["route"])().current('setting.index'),
          onAction: function onAction() {
            return _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__["Inertia"].visit(Object(_functions__WEBPACK_IMPORTED_MODULE_4__["route"])('setting.index'));
          }
        }],
        actionGroups: []
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Banner"], {
        status: "info",
        title: "You're logged in as ".concat(Object(_functions__WEBPACK_IMPORTED_MODULE_4__["config"])('shop.shopify_domain'))
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].AnnotatedSection, {
        title: "Desktop settings",
        description: "Enable or disable the app for desktop users"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SettingToggle"], {
        action: {
          content: this.state.settings.desktop_status ? 'Disable' : 'Enable',
          onAction: function onAction() {
            _this2.setState({
              settings: _objectSpread(_objectSpread({}, _this2.state.settings), {}, {
                desktop_status: !_this2.state.settings.desktop_status
              })
            });
          }
        },
        enabled: this.state.settings.desktop_status
      }, "The app is", ' ', /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["TextStyle"], {
        variation: "strong"
      }, this.state.settings.desktop_status ? 'enabled' : 'disabled'), ' ', "on desktop.")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].AnnotatedSection, {
        title: "Mobile settings",
        description: "Enable or disable the app for mobile users"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SettingToggle"], {
        action: {
          content: this.state.settings.mobile_status ? 'Disable' : 'Enable',
          onAction: function onAction() {
            _this2.setState({
              settings: _objectSpread(_objectSpread({}, _this2.state.settings), {}, {
                mobile_status: !_this2.state.settings.mobile_status
              })
            });
          }
        },
        enabled: this.state.settings.mobile_status
      }, "The app is", ' ', /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["TextStyle"], {
        variation: "strong"
      }, this.state.settings.mobile_status ? 'enabled' : 'disabled'), ' ', "on mobile.")))));
    }
  }]);

  return SampleSettingPage;
}(react__WEBPACK_IMPORTED_MODULE_0___default.a.Component);



/***/ })

}]);