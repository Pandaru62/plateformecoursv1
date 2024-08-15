(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _bootstrap_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./bootstrap.js */ "./assets/bootstrap.js");
/* harmony import */ var _bootstrap_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_bootstrap_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _javascript_method1_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./javascript/method1.js */ "./assets/javascript/method1.js");
/* harmony import */ var _javascript_method1_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_javascript_method1_js__WEBPACK_IMPORTED_MODULE_2__);

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */


// compile new JS file


/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ (() => {

// import { startStimulusApp } from '@symfony/stimulus-bundle';

// const app = startStimulusApp();
// // register any custom, 3rd party controllers here
// // app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/javascript/method1.js":
/*!**************************************!*\
  !*** ./assets/javascript/method1.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
document.addEventListener('DOMContentLoaded', function () {
  var toggles = document.querySelectorAll('main .dropdown-toggle');
  toggles.forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
      e.stopPropagation(); // Prevent the click from closing the dropdown immediately
      var menu = toggle.nextElementSibling;
      menu.classList.toggle('show');
    });
  });

  // Close dropdowns if clicking outside of them
  document.addEventListener('click', function (e) {
    toggles.forEach(function (toggle) {
      var menu = toggle.nextElementSibling;
      if (!toggle.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove('show');
      }
    });
  });
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_array_for-each_js-node_modules_core-js_modules_es_obj-7bb33f"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7OztBQUF3QjtBQUN4QjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDMEI7O0FBRTFCOzs7Ozs7Ozs7OztBQ1RBOztBQUVBO0FBQ0E7QUFDQTs7Ozs7Ozs7Ozs7OztBQ0pBQSxRQUFRLENBQUNDLGdCQUFnQixDQUFDLGtCQUFrQixFQUFFLFlBQVc7RUFDckQsSUFBTUMsT0FBTyxHQUFHRixRQUFRLENBQUNHLGdCQUFnQixDQUFDLHVCQUF1QixDQUFDO0VBRWxFRCxPQUFPLENBQUNFLE9BQU8sQ0FBQyxVQUFTQyxNQUFNLEVBQUU7SUFDN0JBLE1BQU0sQ0FBQ0osZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFVBQVNLLENBQUMsRUFBRTtNQUN6Q0EsQ0FBQyxDQUFDQyxlQUFlLENBQUMsQ0FBQyxDQUFDLENBQUM7TUFDckIsSUFBTUMsSUFBSSxHQUFHSCxNQUFNLENBQUNJLGtCQUFrQjtNQUN0Q0QsSUFBSSxDQUFDRSxTQUFTLENBQUNMLE1BQU0sQ0FBQyxNQUFNLENBQUM7SUFDakMsQ0FBQyxDQUFDO0VBQ04sQ0FBQyxDQUFDOztFQUVGO0VBQ0FMLFFBQVEsQ0FBQ0MsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFVBQVNLLENBQUMsRUFBRTtJQUMzQ0osT0FBTyxDQUFDRSxPQUFPLENBQUMsVUFBU0MsTUFBTSxFQUFFO01BQzdCLElBQU1HLElBQUksR0FBR0gsTUFBTSxDQUFDSSxrQkFBa0I7TUFDdEMsSUFBSSxDQUFDSixNQUFNLENBQUNNLFFBQVEsQ0FBQ0wsQ0FBQyxDQUFDTSxNQUFNLENBQUMsSUFBSSxDQUFDSixJQUFJLENBQUNHLFFBQVEsQ0FBQ0wsQ0FBQyxDQUFDTSxNQUFNLENBQUMsRUFBRTtRQUN4REosSUFBSSxDQUFDRSxTQUFTLENBQUNHLE1BQU0sQ0FBQyxNQUFNLENBQUM7TUFDakM7SUFDSixDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7QUFDTixDQUFDLENBQUM7Ozs7Ozs7Ozs7OztBQ3BCRiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Jvb3RzdHJhcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvamF2YXNjcmlwdC9tZXRob2QxLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcz8zZmJhIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi9ib290c3RyYXAuanMnO1xyXG4vKlxyXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXHJcbiAqXHJcbiAqIFRoaXMgZmlsZSB3aWxsIGJlIGluY2x1ZGVkIG9udG8gdGhlIHBhZ2UgdmlhIHRoZSBpbXBvcnRtYXAoKSBUd2lnIGZ1bmN0aW9uLFxyXG4gKiB3aGljaCBzaG91bGQgYWxyZWFkeSBiZSBpbiB5b3VyIGJhc2UuaHRtbC50d2lnLlxyXG4gKi9cclxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcclxuXHJcbi8vIGNvbXBpbGUgbmV3IEpTIGZpbGVcclxuaW1wb3J0ICcuL2phdmFzY3JpcHQvbWV0aG9kMS5qcyc7IiwiLy8gaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJ1bmRsZSc7XHJcblxyXG4vLyBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKCk7XHJcbi8vIC8vIHJlZ2lzdGVyIGFueSBjdXN0b20sIDNyZCBwYXJ0eSBjb250cm9sbGVycyBoZXJlXHJcbi8vIC8vIGFwcC5yZWdpc3Rlcignc29tZV9jb250cm9sbGVyX25hbWUnLCBTb21lSW1wb3J0ZWRDb250cm9sbGVyKTtcclxuIiwiZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIGZ1bmN0aW9uKCkge1xyXG4gICAgY29uc3QgdG9nZ2xlcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ21haW4gLmRyb3Bkb3duLXRvZ2dsZScpO1xyXG4gICAgXHJcbiAgICB0b2dnbGVzLmZvckVhY2goZnVuY3Rpb24odG9nZ2xlKSB7XHJcbiAgICAgICAgdG9nZ2xlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpOyAvLyBQcmV2ZW50IHRoZSBjbGljayBmcm9tIGNsb3NpbmcgdGhlIGRyb3Bkb3duIGltbWVkaWF0ZWx5XHJcbiAgICAgICAgICAgIGNvbnN0IG1lbnUgPSB0b2dnbGUubmV4dEVsZW1lbnRTaWJsaW5nO1xyXG4gICAgICAgICAgICBtZW51LmNsYXNzTGlzdC50b2dnbGUoJ3Nob3cnKTtcclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIENsb3NlIGRyb3Bkb3ducyBpZiBjbGlja2luZyBvdXRzaWRlIG9mIHRoZW1cclxuICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIHRvZ2dsZXMuZm9yRWFjaChmdW5jdGlvbih0b2dnbGUpIHtcclxuICAgICAgICAgICAgY29uc3QgbWVudSA9IHRvZ2dsZS5uZXh0RWxlbWVudFNpYmxpbmc7XHJcbiAgICAgICAgICAgIGlmICghdG9nZ2xlLmNvbnRhaW5zKGUudGFyZ2V0KSAmJiAhbWVudS5jb250YWlucyhlLnRhcmdldCkpIHtcclxuICAgICAgICAgICAgICAgIG1lbnUuY2xhc3NMaXN0LnJlbW92ZSgnc2hvdycpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxufSk7XHJcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ0b2dnbGVzIiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJ0b2dnbGUiLCJlIiwic3RvcFByb3BhZ2F0aW9uIiwibWVudSIsIm5leHRFbGVtZW50U2libGluZyIsImNsYXNzTGlzdCIsImNvbnRhaW5zIiwidGFyZ2V0IiwicmVtb3ZlIl0sInNvdXJjZVJvb3QiOiIifQ==