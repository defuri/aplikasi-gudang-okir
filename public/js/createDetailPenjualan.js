document.addEventListener("DOMContentLoaded", function () {
    const containerInputDinamis = document.getElementById('containerInputDinamis');
    const teksTambahTransaksi = document.getElementById('teksTambahTransaksi');

    // Initialize select2 for existing elements
    initSelect2();

    let produkData = [];

    // Fetch produk data from your API endpoint
    fetch('/get-products')
    .then(response => response.json())
    .then(data => {
        produkData = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Function to get currently selected produk values
    function getSelectedProduk() {
        const selectedValues = [];
        document.querySelectorAll('select[name="produk[]"]').forEach(select => {
            if (select.value) {
                selectedValues.push(select.value);
            }
        });
        return selectedValues;
    }

    // Function to update available options in all dropdowns
    function updateAvailableOptions() {
        const selectedValues = getSelectedProduk();
        const allDropdowns = document.querySelectorAll('select[name="produk[]"]');

        allDropdowns.forEach(dropdown => {
            const currentValue = dropdown.value;

            // Store the current selection
            const currentSelection = dropdown.value;

            // Clear and rebuild options
            dropdown.innerHTML = '<option value="">Pilih produk</option>';

            // Add back all options, but disable those that are selected in other dropdowns
            produkData.forEach(item => {
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
        const jumlahInputSekarang = document.querySelectorAll('select[name="produk[]"]').length;

        if (jumlahInputSekarang >= produkData.length) {
            var notyf = new Notyf();
            notyf.error('Jumlah produk tercapai. Tidak bisa menambah.');
            return;
        }

        // Template HTML untuk input dinamis
        const newInputTemplate = `
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-6 mb-6">
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk
                            <div class="mt-2"></div>
                            <select name="produk[]" required
                                class=".produk bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih Produk</option>
                            </select>
                        </label>
                    </label>
                </div>

                <div>
                    <label for="jumlah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" name="jumlah[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukan jumlah" required="" min="1">
                </div>
            </div>

            <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
        `;

        const newInputWrapper = document.createElement('div');
        newInputWrapper.className = 'dynamic-input-wrapper';
        newInputWrapper.innerHTML = newInputTemplate;

        containerInputDinamis.appendChild(newInputWrapper);

        updateAvailableOptions();
    });

    // Add change event listener to the container for handling dynamic elements
    containerInputDinamis.addEventListener('change', function(e) {
        if (e.target.matches('select[name="produk[]"]')) {
            updateAvailableOptions();
        }
    });
});

function initSelect2() {
    $('.produk').select2({
        placeholder: "Pilih produk",
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });
}
