<div class="lg:flex items-center justify-between">
    <h1 class="text-2xl font-bold dark:text-white">Dashboard<small
            class="ms-2 font-semibold text-gray-500 dark:text-gray-400">{{ now()->format('d-m-Y') }}</small></h1>

    <div class="mt-3 lg:flex lg:mt-0">
        <div class="flex justify-between items-center">
            <label for="selectGudang"
                class="whitespace-nowrap block text-sm font-medium text-gray-900 dark:text-white lg:hidden">Pilih
                gudang:</label>
            <select id="selectGudang"
                class="block w-full max-w-56 ml-4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <div class="flex justify-between items-center mt-4 lg:mt-0">
            <label for="selectProduk"
                class="whitespace-nowrap block text-sm font-medium text-gray-900 dark:text-white lg:hidden">Pilih
                produk:</label>
            <select id="selectProduk"
                class="block w-full max-w-56 ml-4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <div class="flex justify-between items-center mt-4 lg:mt-0">
            <label for="selectRange"
                class="whitespace-nowrap block text-sm font-medium text-gray-900 dark:text-white lg:hidden">Pilih
                waktu:</label>
            <select id="selectRange"
                class="block w-full max-w-56 ml-4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="bulan" selected>Bulan Ini</option>
                <option value="minggu">Minggu Ini</option>
                <option value="hari">Hari Ini</option>
            </select>
        </div>
    </div>

</div>

<div id="produkMasukKeluar" class="mt-8"></div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
    <script src="{{ asset('js/produkMasukKeluar.js') }}"></script>
@endpush
