document.addEventListener("DOMContentLoaded", function () {
    const containerInputDinamis = document.getElementById('containerInputDinamis');
    const teksTambahTransaksi = document.getElementById('teksTambahTransaksi');

    teksTambahTransaksi.addEventListener('click', () => {
        const template = `
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-6 mt-6">
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Bahan Baku
                        <select name="bahan_baku_id[]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 mt-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            ${Array.from(document.querySelector('select[name="bahan_baku_id[]"]').options)
                .map(opt => opt.outerHTML)
                .join('')}
                        </select>
                    </label>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jumlah
                        <input type="number" name="jumlah[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mt-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan jumlah" required min="1">
                    </label>
                </div>

                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Satuan
                        <select name="satuan[]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 mt-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled>Pilih satuan</option>
                            ${Array.from(document.querySelector('select[name="satuan[]"]').options)
                .map(opt => opt.outerHTML)
                .join('')}
                        </select>
                    </label>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Harga
                        <input type="number" name="harga[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mt-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan harga" required min="1">
                    </label>
                </div>
            </div>

            <hr class="h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
        `;

        containerInputDinamis.insertAdjacentHTML('beforeend', template);
    });

});

$(document).ready(function () {
    $('.bahan_baku').select2({
        placeholder: "Pilih bahan baku",
        allowClear: false,
        selectionCssClass: 'bg-gray-50 dark:bg-gray-700',
        dropdownCssClass: 'bg-gray-50 dark:bg-gray-700'
    });

    $('.satuan').select2({
        placeholder: "Pilih satuan",
        allowClear: false,
        selectionCssClass: 'bg-gray-50 dark:bg-gray-700',
        dropdownCssClass: 'bg-gray-50 dark:bg-gray-700'
    })
});
