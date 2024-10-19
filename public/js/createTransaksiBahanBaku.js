document.addEventListener("DOMContentLoaded", function () {
    const containerInputDinamis = document.getElementById('containerInputDinamis');
    const teksTambahTransaksi = document.getElementById('teksTambahTransaksi');

    // Initialize select2 for existing elements
    initSelect2();

    teksTambahTransaksi.addEventListener('click', function () {
        // Cek dan ambil opsi dari elemen yang sudah ada
        let bahanBakuOptions = '';
        let satuanOptions = '';

        const firstBahanBaku = document.querySelector('select[name="bahanBaku[]"]');
        if (firstBahanBaku) {
            bahanBakuOptions = Array.from(firstBahanBaku.options)
                .map(opt => `<option value="${opt.value}">${opt.text}</option>`)
                .join('');
        }

        const firstSatuan = document.querySelector('select[name="satuan[]"]');
        if (firstSatuan) {
            satuanOptions = Array.from(firstSatuan.options)
                .map(opt => `<option value="${opt.value}">${opt.text}</option>`)
                .join('');
        }

        // Template HTML untuk input dinamis
        const newInputTemplate = `
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-6 mb-6">
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Bahan Baku
                        <div class="mt-2"></div>
                        <select name="bahanBaku[]" required
                            class="bahanBaku bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            ${bahanBakuOptions}
                        </select>
                    </label>
                </div>

                <div>
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                        <div class="mt-2"></div>
                        <input type="number" name="jumlah[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan jumlah" required="" min="1">
                    </label>
                </div>

                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Satuan
                        <div class="mt-2"></div>
                        <select name="satuan[]" required
                            class="bahanBaku bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            ${satuanOptions}
                        </select>
                    </label>
                </div>

                <div>
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                    <div class="mt-2"></div>
                    <input type="number" name="harga[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukan harga" required="" min="1">
                    </label>
                </div>
            </div>

            <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
        `;

        // Create wrapper div for new elements
        const newInputWrapper = document.createElement('div');
        newInputWrapper.className = 'dynamic-input-wrapper';

        // Add the template to the new wrapper
        newInputWrapper.innerHTML = newInputTemplate;

        // Append the new wrapper to container
        containerInputDinamis.appendChild(newInputWrapper);

        // Initialize Select2 on new elements
        initSelect2(); // Inisialisasi ulang Select2 setelah elemen baru ditambahkan
    });
});

function initSelect2() {
    $('.bahan_baku').select2({
        placeholder: "Pilih bahan baku",
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });
}
