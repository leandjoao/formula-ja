const { default: axios } = require("axios");
const { default: Swal } = require("sweetalert2");

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

