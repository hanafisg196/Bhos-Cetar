<script>
   document.addEventListener("DOMContentLoaded", function() {
      const loader = document.getElementById('loaderPage');
      const page = document.getElementById('page');
      var timeout = 100;
      window.addEventListener('load', function() {
         setTimeout(() => {
            loader.style.display = 'none';
            page.style.display = 'block';
         }, timeout);
      });
   });
</script>
