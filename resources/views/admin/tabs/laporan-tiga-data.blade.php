<script>
   document.addEventListener("DOMContentLoaded", function() {
      var disPos = @json($disposReport);

      var disPosTotal = disPos.disposTotal.map(function(item) {
            return item.total;
        });

      var options = {
          series: [{
          name: 'Revisi',
          data: [44, 55, 41, 67, 22, 43]
        }, {
          name: 'Desetujui',
          data: [13, 23, 20, 8, 13, 27]
        }, {
          name: 'Disposisi',
          data: disPosTotal
        }, {
          name: 'Ditolak',
          data: [21, 7, 25, 13, 22, 8]
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

        var chart = new ApexCharts(document.querySelector("#chartTiga"), options);
        chart.render();
        console.log(disPosTotal);

   });
</script>
