/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "../css/app.scss";
import "../css/sb-admin-2.css";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const $ = require("jquery");
require("bootstrap");

console.log("Hello Webpack Encore! Edit me in assets/js/app.js");

// $(function () {
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
