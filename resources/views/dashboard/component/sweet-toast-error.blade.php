@if (session()->has('error'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3000
    });
</script>
@endif
