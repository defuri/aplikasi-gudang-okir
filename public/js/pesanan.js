$(document).ready(function () {
    let productsArray = [];

    $.ajax({
        url: '/get-products',
        type: 'GET',
        success: function (data) {
            productsArray = data;

            let checkboxes = productsArray.map(product => document.querySelector(`#CheckboxProduk${product.id}`));
            let jumlahs = productsArray.map(product => document.querySelector(`#JumlahProduk${product.id}`));

            const updateJumlahVisibility = () => {
                checkboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        jumlahs[index].classList.remove('hidden');
                        jumlahs[index].required = true;
                    } else {
                        jumlahs[index].classList.add('hidden');
                        jumlahs[index].required = false;
                    }
                });
            };

            setInterval(updateJumlahVisibility, 100);
        },
        error: function (xhr, status, error) {
            console.log('Terjadi kesalahan: ' + error);
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('defaultModal');
    const closeButton = modal.querySelector('[data-modal-toggle="defaultModal"]');
    const form = document.getElementById('pesananForm');

    closeButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        form.reset();
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
            form.reset();
        }
    });
});
