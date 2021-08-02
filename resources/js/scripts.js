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

const dropdown = document.querySelector('.dropdown');
if (dropdown) {
    const dropdownBtn = dropdown.querySelector('.dropdown-button');
    const dropdownIcon = dropdownBtn.querySelector('i');
    const dropdownContent = dropdown.querySelector('.dropdown-content');

    window.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    })

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
}

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
    centeredSlides: true,
    spaceBetween: 30,
    keyboard: true,
    navigation: {
        nextEl: ".parceiros-next",
        prevEl: ".parceiros-prev",
    },
    breakpoints: {
        "@0.00": {
            slidesPerView: 2,
        },
        "@0.75": {
            slidesPerView: 4,
        },
        "@1.00": {
            slidesPerView: 5,
        },
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
    breakpoints: {
        "@0.00": {
            slidesPerView: 1,
        },
        "@0.75": {
            slidesPerView: 2,
        },
    }
});

depoimentos.init();

