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

$(document).ready(function () {
  $(".toggleDisplay-1").click(function () {
    $(".category-1").toggleClass("showCategory");
    $(".category-1").toggleClass("hideCategory");
    $(".toggleDisplay-1").toggleClass("active");
  });
});

$(document).ready(function () {
  $(".toggleDisplay-2").click(function () {
    $(".category-2").toggleClass("showCategory");
    $(".category-2").toggleClass("hideCategory");
    $(".toggleDisplay-2").toggleClass("active");
  });
});

$(document).ready(function () {
  $(".toggleDisplay-3").click(function () {
    $(".category-3").toggleClass("showCategory");
    $(".category-3").toggleClass("hideCategory");
    $(".toggleDisplay-3").toggleClass("active");
  });
});
