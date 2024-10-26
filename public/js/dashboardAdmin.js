var options = {
    chart: {
        height: 350,
        type: 'bar',
    },
    dataLabels: {
        enabled: false
    },
    series: [],
    title: {
        text: 'Ajax Example',
    },
    noData: {
        text: 'Loading...'
    }
}

var chart = new ApexCharts(
    document.querySelector("#stok"),
    options
);

chart.render();

var url = 'http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly';

$.getJSON(url, function(response) {
  chart.updateSeries([{
    name: 'Sales',
    data: response
  }])
});
