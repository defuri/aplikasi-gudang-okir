document.addEventListener('DOMContentLoaded', async function() {
    // Wait a moment to ensure ApexCharts is fully loaded
    await new Promise(resolve => setTimeout(resolve, 100));

    // Initialize selects
    const gudangSelect = document.getElementById('selectGudang');
    const produkSelect = document.getElementById('selectProduk');
    const rangeSelect = document.getElementById('selectRange');

    // Chart instance variable
    let chart = null;

    // Load gudang options first
    async function loadGudangOptions() {
        try {
            const response = await fetch('/get-gudang');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();

            gudangSelect.innerHTML = data.map(gudang =>
                `<option value="${gudang.id}">${gudang.nama}</option>`
            ).join('');

            return data;
        } catch (error) {
            console.error('Error loading gudang:', error);
            gudangSelect.innerHTML = '<option value="">Error loading gudang</option>';
            throw error;
        }
    }

    // Load produk options
    async function loadProdukOptions() {
        try {
            const response = await fetch('/get-products');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();

            produkSelect.innerHTML = data.map(produk =>
                `<option value="${produk.id}">${produk.nama}</option>`
            ).join('');

            return data;
        } catch (error) {
            console.error('Error loading products:', error);
            produkSelect.innerHTML = '<option value="">Error loading products</option>';
            throw error;
        }
    }

    function createChart() {
        try {
            // Ensure the chart element exists
            const chartElement = document.querySelector("#produkMasukKeluar");
            if (!chartElement) {
                throw new Error('Chart element not found');
            }

            // Basic chart configuration
            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [2, 2],
                    curve: 'smooth'
                },
                series: [
                    {
                        name: 'Produk Masuk',
                        data: [0]
                    },
                    {
                        name: 'Produk Keluar',
                        data: [0]
                    }
                ],
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'],
                        opacity: 0.5
                    }
                },
                xaxis: {
                    categories: ['Loading...']
                },
                yaxis: {
                    title: {
                        text: 'Jumlah'
                    }
                }
            };

            // Create new ApexCharts instance
            return new ApexCharts(chartElement, options);
        } catch (error) {
            console.error('Error creating chart:', error);
            return null;
        }
    }

    // Format date helper
    function formatDate(date) {
        return new Date(date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    // Update chart data
    async function updateChart() {
        if (!chart) {
            console.error('Chart not initialized');
            return;
        }

        const gudangId = gudangSelect.value;
        const produkId = produkSelect.value;
        const rentang = rangeSelect.value;

        if (!gudangId || !produkId || !rentang) return;

        try {
            const [masukData, keluarData] = await Promise.all([
                fetch(`/get-produk-masuk/${rentang}/${gudangId}/${produkId}`).then(r => r.json()),
                fetch(`/get-produk-keluar/${rentang}/${gudangId}/${produkId}`).then(r => r.json())
            ]);

            const allDates = [...new Set([
                ...masukData.map(item => item.created_at),
                ...keluarData.map(item => item.created_at)
            ])].sort();

            if (allDates.length === 0) {
                chart.updateOptions({
                    xaxis: { categories: ['No Data'] },
                    series: [
                        { name: 'Produk Masuk', data: [0] },
                        { name: 'Produk Keluar', data: [0] }
                    ]
                });
                return;
            }

            const masukSeries = allDates.map(date => {
                const item = masukData.find(m => m.created_at === date);
                return item ? item.jumlah : 0;
            });

            const keluarSeries = allDates.map(date => {
                const item = keluarData.find(k => k.created_at === date);
                return item ? item.jumlah : 0;
            });

            chart.updateOptions({
                xaxis: {
                    categories: allDates.map(formatDate)
                },
                series: [
                    { name: 'Produk Masuk', data: masukSeries },
                    { name: 'Produk Keluar', data: keluarSeries }
                ]
            });

        } catch (error) {
            console.error('Error updating chart:', error);
            chart.updateOptions({
                xaxis: { categories: ['Error'] },
                series: [
                    { name: 'Produk Masuk', data: [0] },
                    { name: 'Produk Keluar', data: [0] }
                ]
            });
        }
    }

    // Initialize everything
    try {
        // First load the data
        await Promise.all([loadGudangOptions(), loadProdukOptions()]);

        // Create chart
        chart = createChart();
        if (!chart) {
            console.error('Chart failed to initialize.');
            throw new Error('Failed to create chart');
        }


        // Render chart
        await chart.render();

        // Set up event listeners
        gudangSelect.addEventListener('change', updateChart);
        produkSelect.addEventListener('change', updateChart);
        rangeSelect.addEventListener('change', updateChart);

        // Initial chart update
        await updateChart();

    } catch (error) {
        console.error('Initialization error:', error);
    }
});
