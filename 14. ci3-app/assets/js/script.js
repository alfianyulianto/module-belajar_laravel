$(function () {
  // sweet alert
  $(".hapusDataMahasiswa").on("click", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete record",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      // console.log(result);
      if (result.isConfirmed) {
        // jika menekan tombol konfirmasi
        Swal.fire({
          icon: "success",
          title: "Successfull!",
          showConfirmButton: false,
          timer: 1500,
        }).then((result) => {
          // console.log(result);
          if (result.isDismissed) {
            // jika timer sudah berhenti
            window.location = $(this).attr("href");
          }
        });
      }
    });
  });

  // // ubah data
  $(".tampilModalTambah").on("click", function () {
    $("#judulModalLabel").html("Tambah Data Mahasiswa");
    $(".modal-footer button[type=submit]").html("Tambah Data");
  });
  $(".tampilModalUbah").on("click", function () {
    $("#judulModalLabel").html("Ubah Data Mahasiswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/phpmvc2/public/mahasiswa/ubah"
    );
    // mengambil data dengan ajax
    const idMhs = $(this).data("id");
    $.ajax({
      url: "http://localhost:8080/phpmvc2/public/mahasiswa/getUbah",
      data: { id: idMhs },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#nama").val(data.nama);
        $("#nim").val(data.nim);
        $("#email").val(data.email);
        $("#jurusan").val(data.jurusan);
        $("#id ").val(data.id);
      },
    });
  });
});
