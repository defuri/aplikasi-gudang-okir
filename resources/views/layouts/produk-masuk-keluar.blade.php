<div class="grid gap-4 sm:grid-cols-1 sm:gap-6 mt-6 mb-6">
    <div class="w-full">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Gudang
                <div class="mt-2"></div>
                <select disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ $id_gudang }}" selected>{{ $nama_gudang }}</option>
                </select>
            </label>
        </label>
    </div>
</div>

<input type="hidden" name="id_gudang" value="{{ $id_gudang }}">

<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-6 mb-6">
    {{-- produk --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk
                <div class="mt-2"></div>
                <select name="produk_id[]" required
                    class=".produk_id bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($produk as $produkSekarang)
                        <option value="{{ $produkSekarang->id }}">{{ $produkSekarang->nama }}
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
