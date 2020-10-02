(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

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

/***/ "./resources/js/pages/SamplePage.js":
/*!******************************************!*\
  !*** ./resources/js/pages/SamplePage.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shopify_polaris__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @shopify/polaris */ "./node_modules/@shopify/polaris/dist/esm/index.js");
/* harmony import */ var _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @niveshsaharan/inertia */ "./node_modules/@niveshsaharan/inertia/dist/index.js");
/* harmony import */ var _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../functions */ "./resources/js/functions.js");
/* harmony import */ var _components_InertiaLayout__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../components/InertiaLayout */ "./resources/js/components/InertiaLayout.js");





/* harmony default export */ __webpack_exports__["default"] = (function (props) {
  //  props.token.then(res => console.log(res))
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_components_InertiaLayout__WEBPACK_IMPORTED_MODULE_4__["default"], {
    title: "Home"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Page"], {
    title: "Home",
    secondaryActions: [{
      content: 'Home',
      disabled: Object(_functions__WEBPACK_IMPORTED_MODULE_3__["route"])().current('home'),
      onAction: function onAction() {
        return _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__["Inertia"].visit(Object(_functions__WEBPACK_IMPORTED_MODULE_3__["route"])('home'));
      }
    }, {
      content: 'Settings',
      disabled: Object(_functions__WEBPACK_IMPORTED_MODULE_3__["route"])().current('setting.index'),
      onAction: function onAction() {
        return _niveshsaharan_inertia__WEBPACK_IMPORTED_MODULE_2__["Inertia"].visit(Object(_functions__WEBPACK_IMPORTED_MODULE_3__["route"])('setting.index'));
      }
    }],
    actionGroups: []
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Banner"], {
    status: "info",
    title: "You're logged in as ".concat(Object(_functions__WEBPACK_IMPORTED_MODULE_3__["config"])('shop.shopify_domain'))
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    sectioned: true
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["DisplayText"], {
    size: "extraLarge"
  }, "What a beautiful day!")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    sectioned: true,
    title: "Section name"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], null)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    sectioned: true,
    title: "Section name"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], null))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Layout"].Section, {
    secondary: true
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    title: "Section name"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], {
    lines: 2
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], {
    lines: 1
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    title: "Section name",
    subdued: true
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], {
    lines: 2
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["Card"].Section, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_shopify_polaris__WEBPACK_IMPORTED_MODULE_1__["SkeletonBodyText"], {
    lines: 2
  })))))));
});

/***/ })

}]);