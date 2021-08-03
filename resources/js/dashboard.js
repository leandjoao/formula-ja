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
