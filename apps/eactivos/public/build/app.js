(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_user_bids_bag_UserBids__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/user-bids-bag/UserBids */ "./assets/components/user-bids-bag/UserBids.js");

 //import '../css/app.css';


/*console.log('Hello Webpack Encore! Edit me in assets/app.js');*/

react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_components_user_bids_bag_UserBids__WEBPACK_IMPORTED_MODULE_2__["default"], null), document.getElementById('react-user-bids-container'));

/***/ }),

/***/ "./assets/components/user-bids-bag/UserBids.js":
/*!*****************************************************!*\
  !*** ./assets/components/user-bids-bag/UserBids.js ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _material_ui_core_Badge__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @material-ui/core/Badge */ "./node_modules/@material-ui/core/esm/Badge/index.js");
/* harmony import */ var _material_ui_core_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @material-ui/core/Button */ "./node_modules/@material-ui/core/esm/Button/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

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






var UserBids = /*#__PURE__*/function (_Component) {
  _inherits(UserBids, _Component);

  var _super = _createSuper(UserBids);

  function UserBids() {
    var _this;

    _classCallCheck(this, UserBids);

    _this = _super.call(this);
    _this.state = {
      userBidsCount: 0,
      loading: true
    };
    return _this;
  }

  _createClass(UserBids, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.getUserBids();
    }
  }, {
    key: "getUserBids",
    value: function getUserBids() {
      var _this2 = this;

      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/public/user/ajax-bids-count").then(function (data) {
        _this2.setState({
          userBidsCount: data.data,
          loading: false
        });
      });
    }
  }, {
    key: "render",
    value: function render() {
      var loading = this.state.loading;
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_material_ui_core_Badge__WEBPACK_IMPORTED_MODULE_2__["default"], {
        badgeContent: this.state.userBidsCount,
        color: "error"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_material_ui_core_Button__WEBPACK_IMPORTED_MODULE_3__["default"], {
        variant: "outlined"
      }, "Pujas"));
    }
  }]);

  return UserBids;
}(react__WEBPACK_IMPORTED_MODULE_0__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (UserBids);

/***/ })

},[["./assets/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9jb21wb25lbnRzL3VzZXItYmlkcy1iYWcvVXNlckJpZHMuanMiXSwibmFtZXMiOlsiUmVhY3RET00iLCJyZW5kZXIiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwiVXNlckJpZHMiLCJzdGF0ZSIsInVzZXJCaWRzQ291bnQiLCJsb2FkaW5nIiwiZ2V0VXNlckJpZHMiLCJheGlvcyIsImdldCIsInRoZW4iLCJkYXRhIiwic2V0U3RhdGUiLCJDb21wb25lbnQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtDQUVBOztBQUNBO0FBRUE7O0FBQ0FBLGdEQUFRLENBQUNDLE1BQVQsZUFBZ0IsMkRBQUMsMEVBQUQsT0FBaEIsRUFBNkJDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QiwyQkFBeEIsQ0FBN0IsRTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUNOQTtBQUNBO0FBQ0E7QUFDQTs7SUFFTUMsUTs7Ozs7QUFDRixzQkFBYztBQUFBOztBQUFBOztBQUNWO0FBQ0EsVUFBS0MsS0FBTCxHQUFhO0FBQUNDLG1CQUFhLEVBQUUsQ0FBaEI7QUFBbUJDLGFBQU8sRUFBRTtBQUE1QixLQUFiO0FBRlU7QUFHYjs7Ozt3Q0FFbUI7QUFDaEIsV0FBS0MsV0FBTDtBQUNIOzs7a0NBRWE7QUFBQTs7QUFDVkMsa0RBQUssQ0FBQ0MsR0FBTixpQ0FBMENDLElBQTFDLENBQStDLFVBQUFDLElBQUksRUFBSTtBQUNuRCxjQUFJLENBQUNDLFFBQUwsQ0FBYztBQUFDUCx1QkFBYSxFQUFFTSxJQUFJLENBQUNBLElBQXJCO0FBQTJCTCxpQkFBTyxFQUFFO0FBQXBDLFNBQWQ7QUFDSCxPQUZEO0FBR0g7Ozs2QkFFUTtBQUNMLFVBQU1BLE9BQU8sR0FBRyxLQUFLRixLQUFMLENBQVdFLE9BQTNCO0FBQ0EsMEJBQ0ksMkRBQUMsK0RBQUQ7QUFBTyxvQkFBWSxFQUFFLEtBQUtGLEtBQUwsQ0FBV0MsYUFBaEM7QUFBK0MsYUFBSyxFQUFDO0FBQXJELHNCQUNJLDJEQUFDLGdFQUFEO0FBQVEsZUFBTyxFQUFDO0FBQWhCLGlCQURKLENBREo7QUFLSDs7OztFQXZCa0JRLCtDOztBQTBCUlYsdUVBQWYsRSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgUmVhY3QgZnJvbSAncmVhY3QnO1xuaW1wb3J0IFJlYWN0RE9NIGZyb20gJ3JlYWN0LWRvbSc7XG4vL2ltcG9ydCAnLi4vY3NzL2FwcC5jc3MnO1xuaW1wb3J0IFVzZXJCaWRzIGZyb20gJy4vY29tcG9uZW50cy91c2VyLWJpZHMtYmFnL1VzZXJCaWRzJztcblxuLypjb25zb2xlLmxvZygnSGVsbG8gV2VicGFjayBFbmNvcmUhIEVkaXQgbWUgaW4gYXNzZXRzL2FwcC5qcycpOyovXG5SZWFjdERPTS5yZW5kZXIoPFVzZXJCaWRzLz4sIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdyZWFjdC11c2VyLWJpZHMtY29udGFpbmVyJykpO1xuXG4iLCJpbXBvcnQgUmVhY3QsIHtDb21wb25lbnR9IGZyb20gJ3JlYWN0JztcbmltcG9ydCBheGlvcyBmcm9tICdheGlvcyc7XG5pbXBvcnQgQmFkZ2UgZnJvbSAnQG1hdGVyaWFsLXVpL2NvcmUvQmFkZ2UnO1xuaW1wb3J0IEJ1dHRvbiBmcm9tIFwiQG1hdGVyaWFsLXVpL2NvcmUvQnV0dG9uXCI7XG5cbmNsYXNzIFVzZXJCaWRzIGV4dGVuZHMgQ29tcG9uZW50IHtcbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgc3VwZXIoKTtcbiAgICAgICAgdGhpcy5zdGF0ZSA9IHt1c2VyQmlkc0NvdW50OiAwLCBsb2FkaW5nOiB0cnVlfTtcbiAgICB9XG5cbiAgICBjb21wb25lbnREaWRNb3VudCgpIHtcbiAgICAgICAgdGhpcy5nZXRVc2VyQmlkcygpO1xuICAgIH1cblxuICAgIGdldFVzZXJCaWRzKCkge1xuICAgICAgICBheGlvcy5nZXQoYC9wdWJsaWMvdXNlci9hamF4LWJpZHMtY291bnRgKS50aGVuKGRhdGEgPT4ge1xuICAgICAgICAgICAgdGhpcy5zZXRTdGF0ZSh7dXNlckJpZHNDb3VudDogZGF0YS5kYXRhLCBsb2FkaW5nOiBmYWxzZX0pXG4gICAgICAgIH0pXG4gICAgfVxuXG4gICAgcmVuZGVyKCkge1xuICAgICAgICBjb25zdCBsb2FkaW5nID0gdGhpcy5zdGF0ZS5sb2FkaW5nO1xuICAgICAgICByZXR1cm4gKFxuICAgICAgICAgICAgPEJhZGdlIGJhZGdlQ29udGVudD17dGhpcy5zdGF0ZS51c2VyQmlkc0NvdW50fSBjb2xvcj1cImVycm9yXCI+XG4gICAgICAgICAgICAgICAgPEJ1dHRvbiB2YXJpYW50PVwib3V0bGluZWRcIj5QdWphczwvQnV0dG9uPlxuICAgICAgICAgICAgPC9CYWRnZT5cbiAgICAgICAgKTtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IFVzZXJCaWRzO1xuXG4iXSwic291cmNlUm9vdCI6IiJ9