require('./bootstrap');
window.Swal = require('sweetalert2');

const navbar = document.querySelector('.nav')
const menuToggle = navbar.querySelector('.nav-navbar-toggle');
const mobileMenu = navbar.querySelector('.nav-navbar-links');
const toTop = document.querySelector('.to-top');
const modal = document.querySelector('.modal');

window.addEventListener('scroll', function () {
    if (window.scrollY != 0) {
        navbar.classList.add('fixed');
        toTop.style.opacity = 1;
    } else {
        navbar.classList.remove('fixed');
        toTop.style.opacity = 0;
    }
});

toTop.addEventListener('click', function () {
    window.scrollTo({top: 0, behavior: 'smooth'});
});


menuToggle.addEventListener('click', function (e) {
    e.preventDefault();
    menuToggle.classList.toggle('open');
    mobileMenu.classList.toggle('open');
    if (!navbar.classList.contains('fixed')) {
        navbar.classList.toggle('fixed');
    }
});

window.toggleModal = function() {
    modal.classList.toggle('hidden');
}

const parceiros = new Swiper('.parceiros-slider', {
    direction: "horizontal",
    loop: true,
    slidesPerView: 4,
    centeredSlides: true,
    spaceBetween: 30,
    keyboard: true,
    navigation: {
        nextEl: ".parceiros-next",
        prevEl: ".parceiros-prev",
    }
});

parceiros.init();

const depoimentos = new Swiper('.depoimentos-slider', {
    direction: "horizontal",
    loop: true,
    slidesPerView: 2,
    centeredSlides: true,
    pagination: {
        el: ".depoimentos-pagination",
        clickable: true,
      },
});

depoimentos.init();
