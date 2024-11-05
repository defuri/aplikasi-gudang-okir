// Mobile menu functionality
const btnMenu = document.getElementById("btnMenu");
const btnClose = document.getElementById("btnClose");
const navbarResponsif = document.getElementById("navbarResponsif");
const navbar = document.getElementById('navbarBiasa');

const toggleMobileMenu = (show) => {
    navbarResponsif.classList.toggle("translate-x-full", !show);
    navbarResponsif.classList.toggle("translate-x-0", show);
    document.body.classList.toggle("overflow-x-hidden", show);
};

btnMenu?.addEventListener("click", () => toggleMobileMenu(true));
btnClose?.addEventListener("click", () => toggleMobileMenu(false));

// Navbar scroll animation
let lastScrollTop = 0;
let ticking = false;

const handleScroll = () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop && currentScroll > navbar.offsetHeight) {
        // Scrolling down & past navbar height - hide navbar
        navbar.style.transform = 'translateY(-100%)';
    } else {
        // Scrolling up or at top - show navbar
        navbar.style.transform = 'translateY(0)';
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    ticking = false;
};

window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            handleScroll();
        });
        ticking = true;
    }
});

// Product scroll functionality
const produk = document.getElementById('produk');
const btnGeserKiri = document.getElementById('btnGeserKiri');
const btnGeserKanan = document.getElementById('btnGeserKanan');

const scrollProducts = (direction) => {
    if (!produk) return;

    // Menggunakan lebar container sebagai dasar perhitungan
    const containerWidth = produk.offsetWidth;
    // Scroll sebesar 80% dari lebar container
    const scrollAmount = containerWidth * 0.8;

    // Tambahkan class untuk smooth scrolling jika belum ada
    if (!produk.classList.contains('smooth-scroll')) {
        produk.classList.add('smooth-scroll');
    }

    const newScrollPosition = produk.scrollLeft + (direction * scrollAmount);

    produk.scrollTo({
        left: newScrollPosition,
        behavior: 'smooth'
    });
};

btnGeserKiri?.addEventListener('click', () => scrollProducts(-1));
btnGeserKanan?.addEventListener('click', () => scrollProducts(1));

// Tambahkan event listener untuk mengupdate status tombol
produk?.addEventListener('scroll', () => {
    if (!btnGeserKiri || !btnGeserKanan) return;

    // Update status tombol berdasarkan posisi scroll
    btnGeserKiri.classList.toggle('opacity-50', produk.scrollLeft <= 0);
    btnGeserKanan.classList.toggle('opacity-50',
        produk.scrollLeft >= produk.scrollWidth - produk.offsetWidth);
});

// Optional: Monitor product scroll position
if (produk) {
    let lastScrollLeft = produk.scrollLeft;
    const checkScrollPosition = () => {
        if (produk.scrollLeft !== lastScrollLeft) {
            lastScrollLeft = produk.scrollLeft;
            // Add any additional logic here if needed
        }
    };

    setInterval(checkScrollPosition, 100);
}

// Handle window events
const handleResize = () => {
    // Add resize logic here if needed
};

const handleLoad = () => {
    // Add load logic here if needed
};

window.addEventListener('resize', handleResize);
window.addEventListener('load', handleLoad);
