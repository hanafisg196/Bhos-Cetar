<script>
    function confirmDelete(id) {
          Swal.fire({
              title: "Apa Anda Yakin?",
              text: "Data yang telah dihapus tidak bisa di kembalikan",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, Hapus !",
              cancelButtonText:"Tidak"
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('deleteForm').submit();
                  Swal.fire({
                      title: "Deleted!",
                      text: "Your file has been deleted.",
                      icon: "success"
                  });
              }
          });
      }
  </script>
