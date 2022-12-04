<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- $data['title'] yd dikirim ke view akan diekstrak dan diambil keynya untuk dijadikan variabel -->
  <title><?= $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <!-- My Script -->
  <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">

  <!-- Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">






</head>

<body>

  <?= $this->include('layout/partial/navbar'); ?>
  <!-- untuk memanggil komponen navbar -->


  <?= $this->renderSection('content'); ?>
  <!--  bagian ini kita akan mencetak sebuah section yang nanti sectionnya akan kita ambil dari halaman yang memanggil tamplate ini -->

  <!-- JQuery -->
  <script src="<?= base_url('/js/jquery-3.6.0.min.js'); ?>"></script>

  <!-- Data Tables -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <!-- My Script -->
  <script src="<?= base_url('/js/my-script.js'); ?>"></script>

</body>

</html>