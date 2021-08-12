/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/dashboard.js ***!
  \***********************************/
var dropdown = document.querySelector('.dropdown');
var dropdownBtn = dropdown.querySelector('.dropdown-button');
var dropdownIcon = dropdownBtn.querySelector('i');
var dropdownContent = dropdown.querySelector('.dropdown-content');
var page = document.querySelector('.page');
var navbar = document.querySelector('.nav');
var toggleMenu = document.querySelector('.page-header-toggle');
window.addEventListener('load', function () {
  var isMenuClosed = localStorage.getItem('isClosed');

  if (JSON.parse(isMenuClosed)) {
    page.classList.add('full');
    navbar.classList.add('hidden');
  } else {
    page.classList.remove('full');
    navbar.classList.remove('hidden');
  }
});
window.addEventListener('click', function (e) {
  if (!dropdown.contains(e.target)) {
    dropdownContent.style.display = 'none';
    dropdownIcon.classList.add('fa-caret-down');
    dropdownIcon.classList.remove('fa-caret-up');
  }
});
dropdownBtn.addEventListener('click', function (e) {
  if (dropdownContent.style.display === 'flex') {
    dropdownContent.style.display = 'none';
    dropdownIcon.classList.add('fa-caret-down');
    dropdownIcon.classList.remove('fa-caret-up');
  } else {
    dropdownContent.style.display = 'flex';
    dropdownIcon.classList.add('fa-caret-up');
    dropdownIcon.classList.remove('fa-caret-down');
  }
});
toggleMenu.addEventListener('click', function () {
  page.classList.toggle('full');
  navbar.classList.toggle('hidden'); // localStorage.removeItem('isClosed');

  localStorage.setItem('isClosed', page.classList.contains('full'));
});
/******/ })()
;