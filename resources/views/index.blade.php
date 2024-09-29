<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Original Kiripik</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('img/iconOkir.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="scroll-smooth overflow-x-hidden">

    <!-- Navbar Responsif -->
    <div class="h-screen w-screen fixed top-0 left-0 bg-[#F1E7DA] z-50 text-[#C3262E] font-sans transform translate-x-full transition duration-500 ease-in-out"
        id="navbarResponsif">
        <!-- Navbar Responsif Bagian Atas -->
        <div class="flex justify-between items-center px-8 fixed top-0 right-0 left-0 bg-[#F1E7DA] z-40 mt-3">
            <a href="#">
                <img src="{{ asset('img/logo.webp') }}" alt="Logo" class="w-20 cursor-pointer">
            </a>
            <ion-icon name="close-outline" class="text-4xl font-light cursor-pointer hover:text-koneng z-50"
                id="btnClose"></ion-icon>
        </div>

        <!-- Navbar Responsif Bagian Bawah -->
        <div class="relative h-full transition ease-linear duration-200" id="navbarResponsifBawah">
            <div class="mt-40 w-full flex flex-row justify-center items-center">
                <ul class="flex flex-col space-y-4 font-extrabold text-3xl items-center">
                    <li class="uppercase hover:text-koneng"><a href="/">home</a></li>
                    <li class="uppercase hover:text-koneng"><a href="#">tentang</a></li>
                    <li class="uppercase hover:text-koneng"><a href="#produkAtas">produk</a></li>
                    <li class="uppercase hover:text-koneng"><a href="#lokasi">lokasi</a></li>
                </ul>
            </div>

            <!-- Button Login -->
            <div class="w-full flex justify-center items-center absolute bottom-48">
                <a href="/login">
                    <button
                        class="uppercase bg-beureum text-[#F1E7DA] rounded-full text-xl font-extrabold px-8 py-3 hover:opacity-90">
                        login
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar Biasa -->
    <nav id="navbarBiasa"
        class="bg-beureum text-[#F1E8DB] uppercase flex justify-center items-center h-16 md:h-24 px-6 py-2 pb-3 fixed top-0 w-full font-sans transition ease-linear z-40">
        <div class="flex justify-between items-center max-w-[1280px] w-full relative">
            <ion-icon name="menu-outline" class="absolute right-2 top-1 text-4xl cursor-pointer block sm:hidden"
                id="btnMenu"></ion-icon>

            <div class="flex items-center">
                <a href="#" class="cursor-pointer">
                    <img src="{{ asset('img/logo.webp') }}" alt="Logo Okir" class="w-16 md:w-28 lg:w-32 h-auto">
                </a>
            </div>

            <div class="items-center justify-center flex-wrap font-black hidden sm:block text-lg">
                <ul class="md:block">
                    <a href="/">
                        <li class="inline-block mx-2">home</li>
                    </a>
                    <a href="#">
                        <li class="inline-block mx-2">tentang</li>
                    </a>
                    <a href="#produkAtas">
                        <li class="inline-block mx-2">produk</li>
                    </a>
                    <a href="#lokasi">
                        <li class="inline-block mx-2">lokasi</li>
                    </a>
                </ul>
            </div>

            <div class="flex items-center">
                <a href="/login">
                    <button
                        class="hidden sm:block font-black text-beureum bg-white cursor-pointer text-sm rounded-full px-6 py-2 lg:px-8 lg:py-3 uppercase shadow-login hover:opacity-80 md:px-9 md:py-3 md:text-base lg:text-xl">
                        login
                    </button>
                </a>
            </div>
        </div>
    </nav>

    {{-- main content wrapper --}}
    <div class="overflow-x-hidden"
        data-aos="fade"
        data-aos-easing="ease-in-sine"
        data-aos-duration="600">

        <!-- Bagian Atas -->
        <div class="bg-beureum w-full">
            <div
                class="max-w-7xl pt-40 pb-14 px-10 mx-auto font-anton uppercase text-[#F1E8DB] md:flex md:justify-center lg:pt-32">
                <div>
                    <h1 class="text-5xl lg:text-8xl">Rasakan Kerenyahan dan Keaslian Produk Kami</h1>
                    <h2 class="mt-7 text-4xl xl:text-5xl">Rasa Berkualitas dengan Kelezatan Optimal</h2>
                </div>

                <div class="w-full flex justify-center md:block md:w-auto">
                    <img src="{{ asset('img/selondok.webp') }}" alt="Foto Salah Satu Produk Kami"
                        class="max-w-80 min-w-1 h-auto mt-24 rotate-6 sm:max-w-96 md:mt-8 md:max-w-72 md:ml-16 md:mr-8 lg:max-w-80 lg:mt-0 lg:ml-5 xl:max-w-96 xl:ml-12">
                </div>
            </div>
        </div>

        <div class="w-full bg-[#F1E8DB] flex justify-center items-center" data-aos="fade-right" data-aos-offset="200"
        data-aos-duration="1000" data-aos-once="true">
        <div class="max-w-7xl w-full py-14 px-5 flex flex-col md:flex-row">
            <div class="w-full flex justify-center md:w-1/2 md:justify-start">
                <img src="{{ asset('img/singkong.webp') }}" alt="Foto Salah Satu Produk Kami"
                    class="w-full max-w-[300px] h-auto object-contain md:max-w-[400px]">
            </div>
            <div class="w-full mt-8 md:mt-0 md:w-1/2 md:pl-10">
                <h1 class="font-anton uppercase text-beureum text-4xl sm:text-5xl lg:text-6xl">
                    "Sekali
                    <span class="text-koneng">nyicip</span> ga bisa <span class="text-beureum">berhenti</span>"
                </h1>
                <p class="mt-4 font-notoSansJP text-base font-medium lg:text-lg">Temukan keunggulan produk
                    kami yang dibuat dari bahan berkualitas tinggi dan proses produksi terjamin, memenuhi standar
                    terbaik dengan rasa luar biasa.</p>
                <a href="https://id.shp.ee/1cngaba" target="_blank" class="inline-block mt-6">
                    <button
                        class="px-7 py-4 rounded-full text-[#F1E7DA] bg-beureum capitalize font-notoSansJP text-lg shadow-login">
                        Pesan Sekarang
                    </button>
                </a>
            </div>
        </div>
    </div>

        {{-- Why Choose Us --}}

        <div class="w-full flex justify-center pb-16" data-aos="fade" data-aos-offset="200" data-aos-duration="2000"
            data-aos-once="true">
            <div class="max-w-7xl">
                <h1
                    class="text-[#474747] font-notoSansJP text-2xl font-semibold text-center mt-16 sm:text-4xl xl:text-[2.50rem]">
                    Kenapa Pilih Kami?</h1>
                <div class="mx-8 mt-4 md:flex md:items-center md:flex-wrap md:gap-6 md:justify-center xl:mt-6">
                    <div class="mt-10 flex items-center flex-col md:max-w-80 lg:max-w-96 border-solid">
                        <ion-icon name="star-outline" class="text-beureum text-5xl"></ion-icon>
                        <h2 class="text-2xl text-[#474747] font-semibold text-center mt-6 sm:text-3xl xl:text-4xl">
                            Kualitas
                            Terjamin</h2>
                        <p class="text-[#474747] text-center text-lg leading-5 mt-2 sm:text-xl">Kualitas terbaik
                            denganbahan
                            segar, proses produksi terstandarisasi, dan terpercaya.</p>
                    </div>
                    <div class="mt-10 flex items-center flex-col md:max-w-80 lg:max-w-96 border-solid">
                        <ion-icon name="fast-food-outline" class="text-beureum text-5xl"></ion-icon>
                        <h2 class="text-2xl text-[#474747] font-semibold text-center mt-6 sm:text-3xl xl:text-4xl">
                            Inovasi
                            Rasa:</h2>
                        <p class="text-[#303030] text-center text-lg leading-5 mt-2 sm:text-xl">Kami terus berinovasi
                            dengan
                            varian rasa unik yang memanjakan lidah dan pengalaman baru.</p>
                    </div>
                    <div class="mt-10 flex items-center flex-col md:max-w-80 lg:max-w-96 border-solid">
                        <ion-icon name="cash-outline" class="text-beureum text-5xl"></ion-icon>
                        <h2 class="text-2xl text-[#050404] font-semibold text-center mt-6 sm:text-3xl xl:text-4xl">
                            Harga
                            Bersaing</h2>
                        <p class="text-[#303030] text-center text-lg leading-5 mt-2 sm:text-xl">Kami menyediakan produk
                            berkualitas tinggi dengan harga bersaing yang terjangkau untuk semua.</p>
                    </div>
                    <div class="mt-10 flex items-center flex-col md:max-w-80 lg:max-w-96 border-solid">
                        <ion-icon name="business-outline" class="text-beureum text-5xl"></ion-icon>
                        <h2 class="text-2xl text-[#474747] font-semibold text-center mt-6 sm:text-3xl xl:text-4xl">
                            Berpengalaman</h2>
                        <p class="text-[#303030] text-center text-lg leading-5 mt-2 sm:text-xl">Dengan pengalaman lebih
                            dari 10 tahun, kami ahli dalam menciptakan berbagai olahan makanan ringan berkualitas
                            terbaik.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- produk --}}

        {{-- bagian div untuk ke center --}}
        <div data-aos="fade" data-aos-offset="200" data-aos-duration="2000" data-aos-once="true" id="produkAtas">
            <div class="flex justify-center items-center w-full mt-10 bg-beureum">
                <div
                    class="max-w-7xl w-full p-7 min-[600px]:flex min-[600px]:justify-between min-[600px]:items-center">
                    <h1 class="font-poppinsSemiBold text-white font-extrabold text-2xl min-[600px]:font-semibold">
                        Produk
                        Kami</h1>
                    <div class="justify-center items-center gap-3 hidden min-[600px]:flex">
                        <p class="text-white text-lg font-semibold font-poppinsSemiBold mr-2">Shop</p>
                        <div id="bungkusBtnGeserKiri">
                            <button id="btnGeserKiri"
                                class=" bg-white text-beureum text-2xl rounded-full p-3 transition-all min-[600px]:text-xl min-[600px]:p-2 lg:text-2xl"><ion-icon
                                    name="chevron-back-outline" class="px-1"></ion-icon></button>
                        </div>
                        <div id="bungkusBtnGeserKanan">
                            <button id="btnGeserKanan"
                                class="bg-white text-beureum text-2xl rounded-full p-3 transition-all min-[600px]:text-xl min-[600px]:p-2 lg:text-2xl"><ion-icon
                                    name="chevron-forward-outline" class="px-1"></ion-icon></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="produk"
                class="w-full flex items-center flex-nowrap overflow-x-scroll px-10 pb-16 gap-6 lg:pt-4 bg-beureum">
                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2421.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2427.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2429.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2436.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2440.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2441.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2421.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2444.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2421.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>

                <div class="w-4/6 flex-shrink-0 cursor-pointer min-[600px]:w-3/12">
                    <img src="{{ asset('img/DSCF2446.webp') }}" alt="" class="inline-block w-full">
                    <h1 class="font-poppins font-semibold mt-3 text-white">Nama Produk</h1>
                    <p class="font-poppins text-sm text-koneng">Keterangan</p>
                    <p class="mt-2 font-semibold text-white">Rp 10.000</p>
                </div>
            </div>
        </div>

        <div data-aos="fade-left" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true"
            id="lokasi" class="pb-20">
            <h1 class="text-4xl font-bold pt-20 text-center underline decoration-[#EFCC37]">Lokasi</h1>

            <div class="w-full flex justify-center items-center mt-5 bg-white font-poppins">

                {{-- pembungkus flexbox --}}
                <div class="max-w-7xl w-full justify-center items-center px-8 pb-16 md:flex md:items-stretch md:mt-16">
                    <div>
                        <div class="flex items-center">
                            <ion-icon name="location-outline"
                                class="text-xl md:text-3xl lg:text-4xl text-beureum"></ion-icon>
                            <p class="ml-3 text-lg md:text-xl lg:text-2xl">Alamat</p>
                        </div>

                        <p class="ml-7 text-base md:text-lg md:ml-10 md:mr-7 lg:text-xl lg:ml-12">Jl. Saluyu No 165 /
                            85 RT
                            03 RW 06 Kel. Setiamanah, Kec. Cimahi Tengah, Cimahi</p>

                        <div class="flex items-center mt-4 lg:mt-6">
                            <ion-icon name="call-outline"
                                class="text-xl md:text-3xl lg:text-4xl text-beureum"></ion-icon>
                            <p class="ml-3 text-lg md:text-xl lg:text-2xl">Kontak</p>
                        </div>

                        <p class="ml-7 text-base md:text-lg md:ml-10 md:mr-7 lg:text-xl lg:ml-12">+62 123 456 7890</p>

                        <div class="flex items-center mt-4 lg:mt-6">
                            <ion-icon name="mail" class="text-xl md:text-3xl lg:text-4xl text-beureum"></ion-icon>
                            <p class="ml-3 text-lg md:text-xl lg:text-2xl">Email</p>
                        </div>

                        <p class="ml-7 text-base md:text-lg md:ml-10 md:mr-7 lg:text-xl lg:ml-12">email@example.com</p>
                    </div>

                    <div class="flex justify-center items-center mt-10 w-full h-96 md:mt-0 md:max-w">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d495.139136994427!2d107.53488770166648!3d-6.877051383406895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5e1cbb143a3%3A0x12bf10d4438361c6!2sKripik%20Singkong%20Pedas%20Okir!5e0!3m2!1sid!2sid!4v1724489080864!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <footer class="flex justify-center items-center w-full bg-beureum" data-aos="fade" data-aos-offset="200"
            data-aos-duration="2000" data-aos-once="true">
            <div class="w-full max-w-7xl px-8 pt-10 pb-24 font-poppins text-white sm:flex sm:justify-center">
                <div class="sm:w-1/3 sm:p-2">
                    <a href="/">
                        <img src="{{ asset('img/logo.webp') }}" alt="" class="max-w-28 sm:max-w-32">
                        <div class="mt-6">
                            <h1 class="font-poppinsSemiBold text-2xl text-koneng sm:text-xl md:text-2xl">Original
                                Kiripik</h1>
                    </a>
                    <p class="sm:text-xs md:text-sm">#OKIRDimanapunKapanpun</p>
                </div>
            </div>

            <div class="mt-5 sm:w-1/3 sm:p-2">
                <h1 class="font-poppinsSemiBold text-xl text-koneng md:text-2xl">Produk Kami</h1>
                <ul class="mt-1 space-y-1 sm:mt-[.45rem]">
                    <li><a href="#"
                            class="hover:underline decoration-3 hover:transition-all decoration-koneng md:text-lg">Best
                            Seller</a></li>
                    <li><a href="#"
                            class="hover:underline decoration-3 hover:transition-all decoration-koneng md:text-lg">Produk
                            Baru</a></li>
                    <li><a href="#"
                            class="hover:underline decoration-3 hover:transition-all decoration-koneng md:text-lg">Diskon
                            dan Promo</a></li>
                    <li><a href="#"
                            class="hover:underline decoration-3 hover:transition-all decoration-koneng md:text-lg">Katalog</a>
                    </li>
                </ul>

            </div>
            {{-- bagian navigasi --}}
            <div class="mt-5 sm:w-1/3 sm:p-2">
                <h1 class="font-poppinsSemiBold text-xl text-koneng md:text-2xl">Kunjungi Kami</h1>
                <ul class="mt-1 space-y-1">
                    <li>
                        <a href="https://id.shp.ee/1cngaba" target="_blank"
                            class="flex items-center hover:underline decoration-3 hover:transition-all decoration-koneng"><img
                                src="https://img.icons8.com/color/48/shopee.png" alt="shopee"
                                class="max-w-6" /><span class="mt-1 ml-3 md:text-lg">Shopee</span></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/original.kiripik" target="_blank"
                            class="flex items-center hover:underline decoration-3 hover:transition-all decoration-koneng"><ion-icon
                                name="logo-instagram" class="text-xl ml-1"></ion-icon> <span
                                class="ml-3 md:text-lg">Instagram</span></a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/@originalkiripik" target="_blank"
                            class="flex items-center hover:underline decoration-3 hover:transition-all decoration-koneng"><ion-icon
                                name="logo-tiktok" class="text-xl ml-1"></ion-icon> <span
                                class="ml-3 md:text-lg">Tiktok</span></a>
                    </li>
                </ul>
            </div>
    </div>
    </footer>

    <div class="bg-red-800 w-full py-1 text-center font-poppinsSemiBold text-koneng">
        &copy; Okir 2024 All Rights Reserved
    </div>
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>

</html>
