document.getElementById('TambahProduk').addEventListener('click', function () {
    console.log('tambah produk di klik');
    // Buat elemen baru untuk input produk
    const newProductDiv = document.createElement('div');
    newProductDiv.classList.add('grid', 'gap-4', 'sm:grid-cols-2');

    // Tambahkan input produk
    newProductDiv.innerHTML = `
        <div>
            <label for="id_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih produk:</label>
            <select name="id_produk[]" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <div class="grid gap-4 mb-4 sm:grid-cols-1">
            <div>
                <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah:</label>
                <input type="number" name="jumlah[]" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Masukan jumlah" required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
        </div>
    `;

    // Ambil elemen select yang baru dibuat
    const selectElement = newProductDiv.querySelector('select[name="id_produk[]"]');

    // Tambahkan opsi produk ke dalam select
    produk.forEach(dataProduk => {
        const option = document.createElement('option');
        option.value = dataProduk.id;
        option.textContent = dataProduk.nama;
        selectElement.appendChild(option);
    });

    // Tambahkan elemen baru ke dalam div 'TempatProduk'
    document.getElementById('TempatProduk').appendChild(newProductDiv);
});
