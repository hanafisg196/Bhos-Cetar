@if (session()->has('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3000
    });
</script>
@endif
