const { default: axios } = require('axios');
const { default: Swal } = require('sweetalert2');

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
            dropdownIcon.classList.add('fa-caret-down');
            dropdownIcon.classList.remove('fa-caret-up');
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


window.getAddress = async (address) => {
    const cep = address.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            await axios.get(`https://viacep.com.br/ws/${cep}/json`).then((response) => {
                const { logradouro, bairro, localidade, uf } = response.data;
                document.getElementById('street').value = logradouro;
                document.getElementById('city').value = localidade;
                document.getElementById('neighborhood').value = bairro;
                document.getElementById('state').value = uf;
            });
        } else {
            document.getElementById('street').value = '';
            document.getElementById('city').value = '';
            document.getElementById('neighborhood').value = '';
            document.getElementById('state').value = '';
            document.getElementById('zipCode').value = '';
            Swal.fire({
                text: "Ops! CEP Inválido",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'bottom-end'
            });
        }
    } else {
        document.getElementById('zipCode').value = '';
        Swal.fire({
            text: "Ops! CEP Inválido",
            icon: "error",
            toast: true,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'bottom-end'
        });
    }
}

const steps = document.querySelector('.enviar-container-steps');
if (steps) {
    const start = 1;
    const end = document.querySelectorAll('.enviar-container-steps-step').length;
    let currentStep = 1;

    const next = document.querySelector('.next');
    const previous = document.querySelector('.previous');

    next.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentStep < end) {
            document.getElementById(`passo-${currentStep}`).classList.toggle('inativo');
            document.getElementById(`passo-${currentStep} input`).setAttribute('disabled', true);
            currentStep++
            document.getElementById(`passo-${currentStep}`).classList.toggle('inativo');
            document.getElementById(`passo-${currentStep} input`).removeAttribute('disabled');
        };
    });

    previous.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentStep > start) {
            document.getElementById(`passo-${currentStep}`).classList.toggle('inativo');
            document.getElementById(`passo-${currentStep} input`).setAttribute('disabled', true);
            currentStep--
            document.getElementById(`passo-${currentStep}`).classList.toggle('inativo');
            document.getElementById(`passo-${currentStep} input`).removeAttribute('disabled');
        };
    });
}
