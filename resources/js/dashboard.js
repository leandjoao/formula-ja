const { default: axios } = require("axios");
window.$ = window.jQuery = require('jquery');
window.mask = require('jquery-mask-plugin');
window.Swal = require('sweetalert2');

const dropdown = document.querySelector('.dropdown');
const dropdownBtn = dropdown.querySelector('.dropdown-button');
const dropdownIcon = dropdownBtn.querySelector('i');
const dropdownContent = dropdown.querySelector('.dropdown-content');
const page = document.querySelector('.page');
const navbar = document.querySelector('.nav');
const toggleMenu = document.querySelector('.page-header-toggle');


window.addEventListener('load', function () {
    const isMenuClosed = localStorage.getItem('isClosed');
    if (JSON.parse(isMenuClosed)) {
        page.classList.add('full');
        navbar.classList.add('hidden');
    } else {
        page.classList.remove('full');
        navbar.classList.remove('hidden');
    }
})

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

toggleMenu.addEventListener('click', function () {
    page.classList.toggle('full');
    navbar.classList.toggle('hidden');

    // localStorage.removeItem('isClosed');
    localStorage.setItem('isClosed', page.classList.contains('full'));
});

const profile = document.querySelector('.profile');
if (profile) {
    const navlist = profile.querySelectorAll('.profile-navlist-item');
    const context = profile.querySelectorAll('.profile-context-section');
    const changePicture = profile.querySelector('input[type=file]');

    navlist.forEach(nav => {
        nav.addEventListener('click', function (e) {
            context.forEach(item => {
                if (e.target.classList.contains(item.id)) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            })
        });
    });

    changePicture.addEventListener('change', e => {
        e.preventDefault();
        let form = e.target.form;
        form.submit();
    });




    $('input[name=phone]').mask('(00) 0000-0000');
    $('input[name=cep]').mask('00000-000');
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


const addressForm = document.querySelector('#address');
if (addressForm) {
    const zipCode = addressForm.querySelector('input[name="cep"]');
    zipCode.addEventListener('blur', function (cep) {
        getAddress(cep.target.value).then(response => {
            if (response.data) {
                const { logradouro, localidade, bairro, uf } = response.data;
                document.querySelector('input[name="address"]').value = logradouro;
                document.querySelector('input[name="neighborhood"]').value = bairro;
                document.querySelector('input[name="city"]').value = localidade;
                document.querySelector('input[name="state"]').value = uf;
            } else {
                invalidZip();
                zipCode.value = "";
                document.querySelector('input[name="address"]').value = "";
                document.querySelector('input[name="neighborhood"]').value = "";
                document.querySelector('input[name="city"]').value = "";
                document.querySelector('input[name="state"]').value = "";
            }
        })
    });
}





/* TODO
*   SE for farmacia, funcionalidade de adicionar e remover campos
*   SE for usuário, funcionalidade de aceitar ou recusar orçamento
*/

const budget = document.querySelector('.budget');
if (budget) {
    const answer = budget.querySelector('.budget-answer');
    const answered = budget.querySelector('.budget-answered');
    if (answer) {
        console.log(answer);
    }

    if (answered) {
        console.log(answered);
    }
}

