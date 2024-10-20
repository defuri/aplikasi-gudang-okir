document.addEventListener("DOMContentLoaded", function () {
    const containerInputDinamis = document.getElementById('containerInputDinamis');
    const teksTambahTransaksi = document.getElementById('teksTambahTransaksi');

    // Initialize select2 for existing elements
    initSelect2();

    let bahanBakuData = [];

    fetch('/api/bahan-baku')
    .then(response => response.json())
    .then(data => {
        bahanBakuData = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Function to get currently selected bahan baku values
    function getSelectedBahanBaku() {
        const selectedValues = [];
        document.querySelectorAll('select[name="bahanBaku[]"]').forEach(select => {
            if (select.value) {
                selectedValues.push(select.value);
            }
        });
        return selectedValues;
    }

    // Function to update available options in all dropdowns
    function updateAvailableOptions() {
        const selectedValues = getSelectedBahanBaku();
        const allDropdowns = document.querySelectorAll('select[name="bahanBaku[]"]');

        allDropdowns.forEach(dropdown => {
            const currentValue = dropdown.value;

            // Store the current selection
            const currentSelection = dropdown.value;

            // Clear and rebuild options
            dropdown.innerHTML = '<option value="">Pilih bahan baku</option>';

            // Add back all options, but disable those that are selected in other dropdowns
            bahanBakuData.forEach(item => {
                const isSelected = selectedValues.includes(item.id.toString());
                if (!isSelected || item.id.toString() === currentSelection) {
                    const option = new Option(item.nama, item.id);
                    option.disabled = isSelected && item.id.toString() !== currentSelection;
                    dropdown.add(option);
                }
            });

            // Restore the current selection
            dropdown.value = currentSelection;
        });

        // Reinitialize Select2 after updating options
        initSelect2();
    }

    teksTambahTransaksi.addEventListener('click', function () {
        const jumlahInputSekarang = document.querySelectorAll('select[name="bahanBaku[]"]').length;

        if (jumlahInputSekarang >= bahanBakuData.length) {
            var notyf = new Notyf();
            notyf.error('Jumlah bahan baku tercapai. Tidak bisa menambah.');
            return;
        }

        let satuanOptions = '';
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
                            <option value="">Pilih bahan baku</option>
                        </select>
                    </label>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
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
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
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
        newInputWrapper.innerHTML = newInputTemplate;

        // Append the new wrapper to container
        containerInputDinamis.appendChild(newInputWrapper);

        // Update available options in all dropdowns
        updateAvailableOptions();
    });

    // Add change event listener to the container for handling dynamic elements
    containerInputDinamis.addEventListener('change', function(e) {
        if (e.target.matches('select[name="bahanBaku[]"]')) {
            updateAvailableOptions();
        }
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
