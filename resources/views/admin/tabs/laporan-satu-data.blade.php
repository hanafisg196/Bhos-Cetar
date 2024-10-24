<script>
    document.addEventListener("DOMContentLoaded", function() {
        var report = @json($report);

        var lbhTotal = report.total_lbh.map(function(item) {
            return item.total;
        });
        var lahTotal = report.total_lah.map(function(item) {
            return item.total;
        });
        var ecorTotal = report.total_ecor.map(function(item) {
            return item.total;
        });

        var lbhBulan = report.total_lbh.map(function(item) {
            return item.month;
        });
        var lahBulan = report.total_lah.map(function(item) {
            return item.month;
        });
        var ecorBulan = report.total_ecor.map(function(item) {
            return item.month;
        });
        var allBulans = [...lbhBulan, ...lahBulan, ...ecorBulan];
        var uniqueBulans = Array.from(new Set(allBulans));

        var options = {
            series: [{
                name: 'Bantuan Hukum',
                data: lbhTotal
            }, {
                name: 'Aksi Ham',
                data: lahTotal
            }, {
                name: 'Ecorrections',
                data: ecorTotal
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: uniqueBulans,
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
     console.log(allBulans);
    });
</script>
