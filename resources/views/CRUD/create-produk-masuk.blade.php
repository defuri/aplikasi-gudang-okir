<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

<section class="-mt-14 bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white mt-10">Tambah Data</h2>
        <form action="{{ route('ProdukMasuk.store') }}" method="POST">
            @csrf
            @include('layouts.produk-masuk-keluar');
        </form>
    </div>
</section>

<script src="{{ asset('js/createProdukMasuk.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
