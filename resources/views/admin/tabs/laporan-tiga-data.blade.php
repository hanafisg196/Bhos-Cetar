<script>
   document.addEventListener("DOMContentLoaded", function() {
      var statReport = @json($statReport);

        var disPosTotal = statReport.disposTotal.map(function(item) {
            return item.total;
        });
        var ditolakTotal = statReport.ditolakTotal.map(function(item) {
            return item.total;
        });
        var disetujuiTotal = statReport.disetujuiTotal.map(function(item) {
            return item.total;
        });
        var revisiTotal = statReport.revisiTotal.map(function(item) {
            return item.total;
        });

        var disposBulan = statReport.disposTotal.map(function(item) {
            return item.month
        });
        var ditolakBulan = statReport.ditolakTotal.map(function (item){
            return item.month
        });
        var revisiBulan = statReport.revisiTotal.map(function (item){
            return item.month
        });
        var disetujuBulan = statReport.disetujuiTotal.map(function (item){
            return item.month
        });

         var allBulans = [...disetujuBulan, ...ditolakBulan, ...disetujuBulan, ...revisiBulan];
         var uniqeBulans = Array.from(new Set(allBulans));




      var options = {
          series: [{
          name: 'Revisi',
          data: revisiTotal
        }, {
          name: 'Desetujui',
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
          type: 'datetime',
          categories: uniqeBulans,
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
        };

        var chart = new ApexCharts(document.querySelector("#chartTiga"), options);
        chart.render();
        console.log(uniqeBulans);

   });
</script>
