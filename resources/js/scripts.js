require('./bootstrap')

const navbar = document.querySelector('.nav')
const menuToggle = navbar.querySelector('.nav-navbar-toggle');
const mobileMenu = navbar.querySelector('.nav-navbar-links');



window.addEventListener('scroll', function () {
    if (window.scrollY != 0) {
        navbar.classList.add('fixed');
    } else {
        navbar.classList.remove('fixed');
    }
})


menuToggle.addEventListener('click', function (e) {
    e.preventDefault();
    menuToggle.classList.toggle('open');
    mobileMenu.classList.toggle('open');

    if (menuToggle.classList.contains('open')) {
        navbar.style.backgroundColor = 'white';
    } else {
        navbar.style.backgroundColor = 'transparent';
    }
})
