document.addEventListener('DOMContentLoaded', function () {
    const selectGudang = document.querySelector('#selectGudang');
    const selectRange = document.getElementById('selectRange');
    const selectProduk = document.getElementById('selectProduk');
    let chart = null;

    // Fungsi untuk mendapatkan status dark mode
    function isDarkMode() {
        return document.documentElement.classList.contains('dark');
    }

    // Fungsi untuk mendapatkan warna teks berdasarkan mode
    function getTextColor() {
        return isDarkMode() ? '#ffffff' : '#000000';
    }

    // Fungsi untuk mendapatkan warna grid berdasarkan mode
    function getGridColor() {
        return isDarkMode() ? '#424242' : '#e0e0e0';
    }

    function initializeChart() {
        const options = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false,
                },
                foreColor: getTextColor(),
                background: 'transparent'
            },
            series: [
                {
                    name: 'Produk Masuk',
                    data: []
                },
                {
                    name: 'Produk Keluar',
                    data: []
                }
            ],
            xaxis: {
                categories: [],
                title: {
                    text: 'Tanggal',
                    style: {
                        color: getTextColor()
                    }
                },
                labels: {
                    style: {
                        colors: getTextColor()
                    }
                },
                axisBorder: {
                    color: getGridColor()
                },
                axisTicks: {
                    color: getGridColor()
                },

            },
            yaxis: {
                title: {
                    text: 'Jumlah Produk',
                    style: {
                        color: getTextColor()
                    }
                },
                labels: {
                    style: {
                        colors: getTextColor()
                    }
                }
            },
            title: {
                text: 'Data Produk Masuk dan Produk Keluar',
                align: 'center',
                style: {
                    color: getTextColor()
                }
            },
            markers: {
                size: 5,
            },
            colors: ['#008FFB', '#FF4560'],
            legend: {
                labels: {
                    colors: getTextColor()
                }
            }
        };

        chart = new ApexCharts(document.querySelector("#produkMasukKeluar"), options);
        chart.render();

        // Mendengarkan perubahan dark mode
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    updateChartTheme();
                }
            });
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });
    }

    // Fungsi untuk memperbarui tema chart
    function updateChartTheme() {
        const textColor = getTextColor();
        const gridColor = getGridColor();

        chart.updateOptions({
            chart: {
                foreColor: textColor
            },
            grid: {
                borderColor: gridColor
            },
            xaxis: {
                title: {
                    style: {
                        color: textColor
                    }
                },
                labels: {
                    style: {
                        colors: textColor
                    }
                },
                axisBorder: {
                    color: gridColor
                },
                axisTicks: {
                    color: gridColor
                }
            },
            yaxis: {
                title: {
                    style: {
                        color: textColor
                    }
                },
                labels: {
                    style: {
                        colors: textColor
                    }
                }
            },
            title: {
                style: {
                    color: textColor
                }
            },
            legend: {
                labels: {
                    colors: textColor
                }
            }
        });
    }

    // Sisanya tetap sama seperti kode sebelumnya...
    function updateChartData(masukData, keluarData, tanggalData) {
        chart.updateOptions({
            series: [
                {
                    name: 'Produk Masuk',
                    data: masukData
                },
                {
                    name: 'Produk Keluar',
                    data: keluarData
                }
            ],
            xaxis: {
                categories: tanggalData
            }
        });
    }

    function fetchData() {
        const masukPromise = $.ajax({
            url: `/get-produk-masuk/${selectRange.value}/${selectGudang.value}/${selectProduk.value}`,
            type: 'GET',
            dataType: 'json'
        });

        const keluarPromise = $.ajax({
            url: `/get-produk-keluar/${selectRange.value}/${selectGudang.value}/${selectProduk.value}`,
            type: 'GET',
            dataType: 'json'
        });

        Promise.all([masukPromise, keluarPromise])
            .then(([masukResponse, keluarResponse]) => {
                const allDates = [...new Set([
                    ...masukResponse.map(item => item.created_at.split('T')[0]),
                    ...keluarResponse.map(item => item.created_at.split('T')[0])
                ])].sort();

                const masukMap = new Map(
                    masukResponse.map(item => [item.created_at.split('T')[0], item.jumlah])
                );
                const keluarMap = new Map(
                    keluarResponse.map(item => [item.created_at.split('T')[0], item.jumlah])
                );

                const masukData = allDates.map(date => masukMap.get(date) || 0);
                const keluarData = allDates.map(date => keluarMap.get(date) || 0);

                updateChartData(masukData, keluarData, allDates);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
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

            fetchData();
        } catch (error) {
            console.error('Error initializing data:', error);
        }
    }

    selectRange.addEventListener('change', fetchData);
    selectGudang.addEventListener('change', fetchData);
    selectProduk.addEventListener('change', fetchData);

    initializeData();
});
