<script>
    document.addEventListener("DOMContentLoaded", function() {
        var reportGrafik = @json($reportGrafik);

        var disPosTotal = reportGrafik.disposTotal.map(function(item) {
            return item.total;
        });
        var ditolakTotal = reportGrafik.ditolakTotal.map(function(item) {
            return item.total;
        });
        var disetujuiTotal = reportGrafik.disetujuiTotal.map(function(item) {
            return item.total;
        });
        var revisiTotal = reportGrafik.revisiTotal.map(function(item) {
            return item.total;
        });



        var disposBulan = reportGrafik.disposTotal.map(function(item) {
            return item.month
        });
        var ditolakBulan = reportGrafik.ditolakTotal.map(function (item){
            return item.month
        });
        var revisiBulan = reportGrafik.revisiTotal.map(function (item){
            return item.month
        });
        var disetujuBulan = reportGrafik.disetujuiTotal.map(function (item){
            return item.month
        });

        var allBulans = [...disetujuBulan, ...ditolakBulan, ...disetujuBulan, ...revisiBulan];
        var uniqueBulans = Array.from(new Set(allBulans));

        var options = {
            series: [{
                name: 'Revisi',
                data: revisiTotal
            }, {
                name: 'Disetujui',
                data: disetujuiTotal
            }, {
                name: 'Disposisi',
                data: disPosTotal
            }, {
                name: 'Ditolak',
                data: ditolakTotal
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    borderRadiusApplication: 'end', // 'around', 'end'
                    borderRadiusWhenStacked: 'last', // 'all', 'last'
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {

                categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                    '01/05/2011 GMT', '01/06/2011 GMT'
                ],
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        console.log(uniqueBulans);



    });
</script>
