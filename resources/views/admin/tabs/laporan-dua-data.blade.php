<script>
   document.addEventListener("DOMContentLoaded", function() {
      var test = @json($test);

      var count = test.map(function(item) {
            return item.count;
        });
        var nama = test.map(function(item) {
            return item.nama;
        });
      const colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#3F51B5', '#546E7A', '#D4526E'];
      var options = {
       series: [{
          name: 'Total',
          data: count
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
               // alert("Hello! I am an alert box!!");
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: nama,
          labels: {
            style: {
              colors: colors,
              fontSize: '12px'
            }
          }
        }
        };
        var chart = new ApexCharts(document.querySelector("#chartDua"), options);
        chart.render();
   });
</script>
