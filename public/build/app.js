(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/css/sb-admin-2.css":
/*!***********************************!*\
  !*** ./assets/css/sb-admin-2.css ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/app.scss */ "./assets/css/app.scss");
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _css_sb_admin_2_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../css/sb-admin-2.css */ "./assets/css/sb-admin-2.css");
/* harmony import */ var _css_sb_admin_2_css__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_css_sb_admin_2_css__WEBPACK_IMPORTED_MODULE_1__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)

 // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");

console.log("Hello Webpack Encore! Edit me in assets/js/app.js"); // $(function () {
//   var showRequiredCategory = function () {};
//   showRequiredCategory(this);
//   $(".toggleDisplay").click(function (event) {
//     const getID = event.id;
//     event.classList.toggle("active");
//     const getCategory = document.querySelector(".category-" + getID);
//     getCategory.classList.toggle("showCategory");
//     getCategory.classList.toggle("hideCategory");
//   });
// });

$(document).ready(function () {
  $(".toggleDisplay").click(function () {
    $(".category-1").toggleClass("showCategory");
    $(".category-1").toggleClass("hideCategory");
  });
});

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9jc3Mvc2ItYWRtaW4tMi5jc3MiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJuYW1lcyI6WyIkIiwicmVxdWlyZSIsImNvbnNvbGUiLCJsb2ciLCJkb2N1bWVudCIsInJlYWR5IiwiY2xpY2siLCJ0b2dnbGVDbGFzcyJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUEsdUM7Ozs7Ozs7Ozs7O0FDQUEsdUM7Ozs7Ozs7Ozs7OztBQ0FBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTs7Ozs7O0FBT0E7QUFDQTtDQUdBO0FBQ0E7O0FBRUEsSUFBTUEsQ0FBQyxHQUFHQyxtQkFBTyxDQUFDLG9EQUFELENBQWpCOztBQUNBQSxtQkFBTyxDQUFDLGdFQUFELENBQVA7O0FBRUFDLE9BQU8sQ0FBQ0MsR0FBUixDQUFZLG1EQUFaLEUsQ0FFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBSCxDQUFDLENBQUNJLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVk7QUFDNUJMLEdBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CTSxLQUFwQixDQUEwQixZQUFZO0FBQ3BDTixLQUFDLENBQUMsYUFBRCxDQUFELENBQWlCTyxXQUFqQixDQUE2QixjQUE3QjtBQUNBUCxLQUFDLENBQUMsYUFBRCxDQUFELENBQWlCTyxXQUFqQixDQUE2QixjQUE3QjtBQUNELEdBSEQ7QUFJRCxDQUxELEUiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgXCIuLi9jc3MvYXBwLnNjc3NcIjtcclxuaW1wb3J0IFwiLi4vY3NzL3NiLWFkbWluLTIuY3NzXCI7XHJcblxyXG4vLyBOZWVkIGpRdWVyeT8gSW5zdGFsbCBpdCB3aXRoIFwieWFybiBhZGQganF1ZXJ5XCIsIHRoZW4gdW5jb21tZW50IHRvIGltcG9ydCBpdC5cclxuLy8gaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcclxuXHJcbmNvbnN0ICQgPSByZXF1aXJlKFwianF1ZXJ5XCIpO1xyXG5yZXF1aXJlKFwiYm9vdHN0cmFwXCIpO1xyXG5cclxuY29uc29sZS5sb2coXCJIZWxsbyBXZWJwYWNrIEVuY29yZSEgRWRpdCBtZSBpbiBhc3NldHMvanMvYXBwLmpzXCIpO1xyXG5cclxuLy8gJChmdW5jdGlvbiAoKSB7XHJcbi8vICAgdmFyIHNob3dSZXF1aXJlZENhdGVnb3J5ID0gZnVuY3Rpb24gKCkge307XHJcbi8vICAgc2hvd1JlcXVpcmVkQ2F0ZWdvcnkodGhpcyk7XHJcbi8vICAgJChcIi50b2dnbGVEaXNwbGF5XCIpLmNsaWNrKGZ1bmN0aW9uIChldmVudCkge1xyXG4vLyAgICAgY29uc3QgZ2V0SUQgPSBldmVudC5pZDtcclxuLy8gICAgIGV2ZW50LmNsYXNzTGlzdC50b2dnbGUoXCJhY3RpdmVcIik7XHJcbi8vICAgICBjb25zdCBnZXRDYXRlZ29yeSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIuY2F0ZWdvcnktXCIgKyBnZXRJRCk7XHJcbi8vICAgICBnZXRDYXRlZ29yeS5jbGFzc0xpc3QudG9nZ2xlKFwic2hvd0NhdGVnb3J5XCIpO1xyXG4vLyAgICAgZ2V0Q2F0ZWdvcnkuY2xhc3NMaXN0LnRvZ2dsZShcImhpZGVDYXRlZ29yeVwiKTtcclxuLy8gICB9KTtcclxuLy8gfSk7XHJcblxyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XHJcbiAgJChcIi50b2dnbGVEaXNwbGF5XCIpLmNsaWNrKGZ1bmN0aW9uICgpIHtcclxuICAgICQoXCIuY2F0ZWdvcnktMVwiKS50b2dnbGVDbGFzcyhcInNob3dDYXRlZ29yeVwiKTtcclxuICAgICQoXCIuY2F0ZWdvcnktMVwiKS50b2dnbGVDbGFzcyhcImhpZGVDYXRlZ29yeVwiKTtcclxuICB9KTtcclxufSk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=