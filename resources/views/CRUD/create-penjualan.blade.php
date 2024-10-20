<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

<section class="-mt-14 bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white mt-10">Tambah Data</h2>
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            {{-- date picker --}}
            <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                <div class="col-span-1">
                    <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        tanggal</label>

                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" required name="tanggal" id="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 mt-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Pilih tanggal">
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-6 mb-6">
                {{-- produk --}}
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk
                            <div class="mt-2"></div>
                            <select name="produk[]" required
                                class=".produk bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih Produk</option>
                                @foreach ($produk as $currentProduk)
                                    <option value="{{ $currentProduk->id }}">{{ $currentProduk->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </label>
                </div>

                {{-- jumlah --}}
                <div>
                    <label for="jumlah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" name="jumlah[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukan jumlah" required="" min="1">
                </div>
            </div>

            <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">

            {{-- div input dinamis --}}
            <div id="containerInputDinamis"></div>

            <div class="flex justify-end">
                <p class="select-none text-sm text-gray-900 dark:text-white cursor-pointer" id="teksTambahTransaksi">
                    Tambah Transaksi
                </p>
            </div>


            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Simpan Data
            </button>
        </form>
    </div>
</section>

<script src="{{ asset('js/createDetailPenjualan.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
