const btnMenu = document.getElementById("btnMenu");
const btnClose = document.getElementById("btnClose");
const navbarResponsif = document.getElementById("navbarResponsif");

btnMenu.addEventListener("click", () => {
    navbarResponsif.classList.remove("translate-x-full");
    navbarResponsif.classList.add("translate-x-0", "transition-transform", "duration-500", "ease-in-out");
    document.body.classList.add("overflow-x-hidden");
});

btnClose.addEventListener("click", () => {
    navbarResponsif.classList.remove("translate-x-0");
    navbarResponsif.classList.add("translate-x-full");
    document.body.classList.remove("overflow-x-hidden");
});

let lastScrollTop = 0;
const navbar = document.getElementById('navbarBiasa');
window.addEventListener('scroll', function () {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        navbar.style.transform = 'translateY(-100%)';
    } else {
        navbar.style.transform = 'translateY(0)';
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

const produk = document.getElementById('produk');
const btnGeserKiri = document.getElementById('btnGeserKiri');
const btnGeserKanan = document.getElementById('btnGeserKanan');

btnGeserKiri.addEventListener('click', () => {
    produk.scrollTo({
        left: produk.scrollLeft - 400,
        behavior: 'smooth',
    });
});

btnGeserKanan.addEventListener('click', () => {
    produk.scrollTo({
        left: produk.scrollLeft + 400,
        behavior: 'smooth',
    });
});

let lastScrollLeft = 0;

function cekScrollLeft() {
    if (produk.scrollLeft !== lastScrollLeft) {
        lastScrollLeft = produk.scrollLeft;
    }
}

setInterval(cekScrollLeft, 100);

window.addEventListener('resize', () => {
});

window.addEventListener('load', () => {
});
