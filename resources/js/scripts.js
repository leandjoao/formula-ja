const { default: axios } = require('axios');
const { default: Swal } = require('sweetalert2');

require('./bootstrap');
window.Swal = require('sweetalert2');
window.mask = require('jquery-mask-plugin');
window.$ = window.jQuery = require('jquery');

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


const collapsible = document.querySelectorAll('.collapsible');
if (collapsible) {
    collapsible.forEach(item => {
        const title = item.querySelectorAll('.collapsible-content-title');
        const body = item.querySelectorAll('.collapsible-content-text');
        let i;
        for (i = 0; i < title.length; i++) {
            title[i].addEventListener('click', function () {
                title.forEach(obj => {
                    obj.classList.remove('active');
                });

                body.forEach(item => {
                    item.style.display = "none";
                });

                this.classList.add('active');

                let content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    })

}

const invalidZip = () => {
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

const getAddress = async (address) => {
    const cep = address.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            return await axios.get(`https://viacep.com.br/ws/${cep}/json`);
        }
        return {data: false};
    }
    return {data: false};
}

const steps = document.querySelector('.enviar-container-steps');
if (steps) {
    const sameInfo = document.querySelector('#sameInfo');
    const zipCode = document.querySelector('#zipCode');
    const shippingZipCode = document.querySelector('#shippingZipCode');
    const cards = document.querySelectorAll('.enviar-container-steps-step-inputs-cards');

    if (zipCode) {
        zipCode.addEventListener('blur', function (cep) {
            getAddress(cep.target.value).then(function (response) {
                if (response.data) {
                    const { logradouro, localidade, bairro, uf } = response.data;
                    document.getElementById('street').value = logradouro
                    document.getElementById('city').value = localidade
                    document.getElementById('neighborhood').value = bairro
                    document.getElementById('state').value = uf
                } else {
                    invalidZip();
                    document.getElementById('street').value = "";
                    document.getElementById('zipCode').value = "";
                    document.getElementById('city').value = "";
                    document.getElementById('neighborhood').value = "";
                    document.getElementById('state').value = "";
                }
            });
        })
    }

    if (sameInfo) {
        sameInfo.addEventListener('change', function (event) {
            if (event.target.checked) {
                getAddress(document.getElementById('zipCode').value).then(function (response) {
                    const { logradouro, localidade, bairro, uf } = response.data;
                    document.getElementById('shippingName').value = document.getElementById('name').value;
                    document.getElementById('shippingPhone').value = document.getElementById('phone').value;
                    document.getElementById('shippingZipCode').value = document.getElementById('zipCode').value;
                    document.getElementById('shippingStreet').value = logradouro
                    document.getElementById('shippingNeighborhood').value = bairro
                    document.getElementById('shippingCity').value = localidade
                    document.getElementById('shippingState').value = uf
                    document.getElementById('shippingNumber').value = document.getElementById('number').value;
                    document.getElementById('shippingComplement').value = document.getElementById('complement').value;
                    document.getElementById('shippingReference').value = document.getElementById('reference').value;
                });
            } else {
                document.getElementById('shippingName').value = "";
                document.getElementById('shippingPhone').value = "";
                document.getElementById('shippingZipCode').value = "";
                document.getElementById('shippingStreet').value = "";
                document.getElementById('shippingNeighborhood').value = "";
                document.getElementById('shippingCity').value = "";
                document.getElementById('shippingState').value = "";
                document.getElementById('shippingNumber').value = "";
                document.getElementById('shippingComplement').value = "";
                document.getElementById('shippingReference').value = "";
            }
        });
    }

    if (shippingZipCode) {
        shippingZipCode.addEventListener('blur', function (cep) {
            getAddress(cep.target.value).then(function (response) {
                if (response.data) {
                    const { logradouro, localidade, bairro, uf } = response.data;
                    document.getElementById('shippingStreet').value = logradouro
                    document.getElementById('shippingNeighborhood').value = bairro
                    document.getElementById('shippingCity').value = localidade
                    document.getElementById('shippingState').value = uf
                } else {
                    invalidZip();
                    document.getElementById('shippingStreet').value = "";
                    document.getElementById('shippingNeighborhood').value = "";
                    document.getElementById('shippingCity').value = "";
                    document.getElementById('shippingState').value = "";
                }
            });
        })
    }

    if (cards) {
        cards.forEach(card => {
            card.addEventListener('click', function (e) {
                e.preventDefault();
                axios.post(window.location.origin + `/changeAddress/${this.getAttribute('id')}`).then(() => {
                    window.location.reload();
                });
            });
        })
    }

}
