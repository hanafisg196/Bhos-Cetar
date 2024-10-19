<script>
   function confirmDelete(id) {
       Swal.fire({
           title: "Apa Anda Yakin?",
           text: "Data yang telah dihapus tidak bisa dikembalikan",
           icon: "warning",
           showCancelButton: true,
           confirmButtonColor: "#3085d6",
           cancelButtonColor: "#d33",
           confirmButtonText: "Ya, Hapus!",
           cancelButtonText: "Tidak"
       }).then((result) => {
           if (result.isConfirmed) {
               try {
                   document.getElementById('deleteForm').submit();
                   Swal.fire({
                       title: "Berhasil!",
                       text: "File Anda Berhasil Dihapus.",
                       icon: "success"
                   });
               } catch (error) {
                      Swal.fire({
                       title: "Error",
                       text: "File Dokumen Tidak boleh kosong, Jika anda ingin menghapus file ini, upload file baru dan coba hapus kembali file ini.",
                       icon: "error"
                   });
                  //  Swal.fire({
                  //      title: "Error",
                  //      text: "Terjadi kesalahan saat menghapus file: " + error.message,
                  //      icon: "error"
                  //  });
                  //  console.error("Error saat menghapus file: ", error);
               }
           }
       }).catch((error) => {
           Swal.fire({
               title: "Error",
               text: "Terjadi kesalahan: " + error.message,
               icon: "error"
           });
           console.error("Error dalam proses SweetAlert: ", error);
       });
   }
</script>
