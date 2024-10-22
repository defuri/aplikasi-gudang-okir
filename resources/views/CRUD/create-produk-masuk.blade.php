@extends($user->id_hak === 1 ? 'layouts.owner' : 'layouts.gudang')

@section('namaHalaman', 'Produk Masuk')
@section('namaOperator', $user->id_hak === 1 ? 'Owner' : 'Admin Gudang')
@section('judul', 'Masukkan Data Produk Masuk')

@section('content')
    @include('layouts.breadcrumb')
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <section class="-mt-14 bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white mt-10">Tambah Data</h2>
            <form action="{{ route('produk-masuk.store') }}" method="POST">
                @csrf
                @include('layouts.produk-masuk-keluar');
            </form>
        </div>
    </section>

    <script src="{{ asset('js/createProdukMasuk.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@endsection
