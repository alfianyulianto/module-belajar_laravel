function previewImg() {
  const sampul = document.querySelector("#sampul");
  const imgPreview = document.querySelector(".img-preview");

  // ambil file yang diupload
  const fileSampul = new FileReader();
  // ambil alamat penyimpanannya ambil nama file
  fileSampul.readAsDataURL(sampul.files[0]);
  // ubah img-preview
  fileSampul.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}
$(document).ready(function () {
  $("#table_id").DataTable();
  $("#example").dataTable({
    renderer: "bootstrap",
  });
});
