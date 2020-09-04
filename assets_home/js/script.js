const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('.navs-header4 ul');

menuToggle.addEventListener('click', function() {
    nav.classList.toggle('slide');
});