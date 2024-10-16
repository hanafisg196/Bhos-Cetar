<script>
   function filterEmployees() {
       var selectedValue = document.getElementById('opdSelect').value;
       window.location.href = `{{ route('admin.dashboard.rule.form') }}?code=${selectedValue}`;
   }
</script>
