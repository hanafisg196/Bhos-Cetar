<script>
      document.addEventListener("DOMContentLoaded", function () {
     var options = {
       chart: {
         type: 'donut',
         height: '250px;'
       },
       series: [44, 55, 13],
       labels: ['Bantuan Hukum', 'Aksi Ham', 'Ecorretions'],
       responsive: [{
         breakpoint: 480,
         options: {
           chart: {
             width: 200,

           },
           legend: {
             position: 'bottom'
           }
         }
       }]
     };

     var chart = new ApexCharts(document.querySelector("#chart"), options);
     chart.render();
   });
</script>
