const { default: axios } = require("axios");
const { replace, parseInt } = require("lodash");
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


    $('input[name=phone]').mask('(00) 90000 0000');
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

const budget = document.querySelector('.budget');
if (budget) {

    const answer = budget.querySelector('.budget-answer');
    const answered = budget.querySelector('.budget-answered');
    if (answer) {

        const add = answer.querySelector('.add');
        const remove = answer.querySelector('.remove');
        const sendButton = answer.querySelector('.sendBudget');

        setInterval(() => {
            calculateTotal();
        }, 1000);

        $('.money').mask('0000000.00', { reverse: true });

        add.addEventListener('click', function () {
            calculateTotal();

            var $div = $('div[id^="item-"]:last');
            var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;

            const div = `<div class="form-group" id="item-${num}">
            <div class="form-input">
            <input type="text" name="answer[${num}][item]" id="answer-${num}-item" required />
            <label for="answer-${num}-item">Item</label>
            </div>
            <div class="form-input">
            <input type="text" class="money" name="answer[${num}][price]" id="answer-${num}-price" required />
            <label for="answer-${num}-price">Preço</label>
            </div>
            </div>`
            $('.form').append(div);

            $('.money').mask('0000000.00', { reverse: true });
        });

        remove.addEventListener('click', function () {
            var $div = $('div[id^="item-"]:last');
            if ($div.prop('id') !== 'item-0') {
                $div.remove();
            }

            calculateTotal();
        });

        sendButton.addEventListener('click', function () {
            $.ajax({
                url: $('form').attr('action'),
                data: $('form').serialize(),
                method: $('form').attr('method'),
            }).then((response) => {
                Swal.fire({
                    text: response.text,
                    icon: response.icon,
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    position: 'bottom-end',
                    didClose: () => {
                        window.location = response.redirect
                    }
                });
            });

            clearInterval();
        });
    }

    function calculateTotal() {
        const allInputs = answer.querySelectorAll('.money');
        let total = [];
        let sum = 0;

        allInputs.forEach(value => {
            total.push(parseFloat(parseFloat(value.value).toFixed(2)));
        });

        for (let i = 0; i < total.length; i++) {
            sum += total[i];
        }

        $('#budgetSummary').text(sum.toFixed(2));
    }
}

$("#pharmacy").on('change', function (e) {
    if (e.target.value == 3) {
        $('.partnerName').show();
        $('#partnerName').prop('required', true);
    } else {
        $('.partnerName').hide();
        $('#partnerName').attr('required', false);
   }
});
