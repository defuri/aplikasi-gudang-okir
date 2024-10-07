$(document).ready(function () {
    $('#TambahProduk').click(function (e) {
        e.preventDefault();

        // Ambil nilai count saat ini
        var count = $('#count').val();

        // Kirim request Ajax ke server
        $.ajax({
            url: '{{ route("count") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                count: count
            },
            success: function (response) {
                // Update div produk dengan view baru
                $('#produk').html(response.view);

                // Update count
                $('#count').val(response.count);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
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
