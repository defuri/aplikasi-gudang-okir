document.addEventListener('DOMContentLoaded', function () {
    const selectGudang = document.querySelector('#selectGudang');
    const selectRange = document.getElementById('selectRange');
    const selectProduk = document.getElementById('selectProduk');
    let chart = null;

    function initializeChart() {
        const options = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false,
                }
            },
            series: [{
                name: 'Jumlah Produk Masuk',
                data: []
            }],
            xaxis: {
                categories: [],
                title: {
                    text: 'Tanggal'
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Produk'
                }
            },
            title: {
                text: 'Data Produk Masuk',
                align: 'center'
            }
        };

        chart = new ApexCharts(document.querySelector("#produkMasukKeluar"), options);
        chart.render();
    }

    function updateChartData(produkMasukData, tanggalData) {
        chart.updateOptions({
            series: [{
                name: 'Jumlah Produk Masuk',
                data: produkMasukData
            }],
            xaxis: {
                categories: tanggalData
            }
        });
    }

    function fetchDataProdukMasuk() {
        $.ajax({
            url: `/get-produk-masuk/${selectRange.value}/${selectGudang.value}/${selectProduk.value}`,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                const produkMasukData = response.map(item => item.jumlah);
                const tanggalData = response.map(item => item.created_at.split('T')[0]);
                updateChartData(produkMasukData, tanggalData);
            },
            error: function (error) {
                console.log('Error fetching data: ', error.status, error.responseText);
            }
        });
    }

    async function initializeData() {
        try {
            initializeChart();

            await Promise.all([
                new Promise((resolve) => {
                    $.ajax({
                        url: '/get-gudang',
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            selectGudang.innerHTML = '';
                            response.forEach(gudang => {
                                const option = document.createElement('option');
                                option.value = gudang.id;
                                option.textContent = gudang.nama;
                                selectGudang.appendChild(option);
                            });
                            resolve();
                        }
                    });
                }),
                new Promise((resolve) => {
                    $.ajax({
                        url: '/get-products',
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            selectProduk.innerHTML = '';
                            response.forEach(produk => {
                                const option = document.createElement('option');
                                option.value = produk.id;
                                option.textContent = produk.nama;
                                selectProduk.appendChild(option);
                            });
                            resolve();
                        }
                    });
                })
            ]);

            fetchDataProdukMasuk();
        } catch (error) {
            console.error('Error initializing data:', error);
        }
    }

    selectRange.addEventListener('change', fetchDataProdukMasuk);
    selectGudang.addEventListener('change', fetchDataProdukMasuk);
    selectProduk.addEventListener('change', fetchDataProdukMasuk);

    initializeData();
});
