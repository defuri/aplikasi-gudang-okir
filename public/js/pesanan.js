document.getElementById('TambahProduk').addEventListener('click', function () {
    const newProductDiv = document.createElement('div');
    newProductDiv.classList.add('grid', 'gap-4', 'mb-2', 'sm:grid-cols-2');

    const selectProduk = document.createElement('select');
    selectProduk.name = "produk_id[]";
    selectProduk.required = true;
    selectProduk.classList.add('bg-gray-50', 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg', 'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'p-2.5', 'dark:bg-gray-700', 'dark:border-gray-600', 'dark:placeholder-gray-400', 'dark:text-white', 'dark:focus:ring-blue-500', 'dark:focus:border-blue-500');

    const optionDefault = document.createElement('option');
    optionDefault.value = '';
    optionDefault.disabled = true;
    optionDefault.selected = true;
    optionDefault.textContent = 'Pilih produk';
    selectProduk.appendChild(optionDefault);

    produk.forEach(function(item) {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nama;
        selectProduk.appendChild(option);
    });

    // Buat elemen input jumlah
    const inputJumlah = document.createElement('input');
    inputJumlah.type = 'number';
    inputJumlah.name = 'jumlah[]';
    inputJumlah.min = 1;
    inputJumlah.required = true;
    inputJumlah.classList.add('bg-gray-50', 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg', 'focus:ring-primary-600', 'focus:border-primary-600', 'block', 'w-full', 'p-2.5', 'dark:bg-gray-700', 'dark:border-gray-600', 'dark:placeholder-gray-400', 'dark:text-white', 'dark:focus:ring-primary-500', 'dark:focus:border-primary-500');
    inputJumlah.placeholder = 'Masukan jumlah';

    inputJumlah.setAttribute('oninput', "this.value = this.value.replace(/[^0-9]/g, '')");

    newProductDiv.innerHTML = `
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih produk:</label>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah:</label>
        </div>
    `;

    newProductDiv.children[0].appendChild(selectProduk);
    newProductDiv.children[1].appendChild(inputJumlah);

    document.getElementById('tambahan').appendChild(newProductDiv);
});


// * bagian untuk membersihkan isi modal

const modal = document.getElementById('defaultModal');
const closeButton = document.querySelector('[data-modal-toggle="defaultModal"]');
const form = modal.querySelector('form');
const productContainer = document.getElementById('tambahan');

function resetModal() {
    form.reset();

    productContainer.innerHTML = '';
}

closeButton.addEventListener('click', resetModal);

window.addEventListener('click', function (event) {
    if (event.target === modal) {
        form.reset();
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
        resetModal();
    }
});
