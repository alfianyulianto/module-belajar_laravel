<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- $data['judul'] yd dikirim ke view akan diekstrak dan diambil keynya untuk dijadikan variabel -->
  <title><?= $judul; ?></title>
  <!-- Bootstrap Css -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
  <!-- My Css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url(); ?>">CI APP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link <?= ($judul == 'Halaman Home') ? 'active' : '' ?>" href="<?= base_url(); ?>">Home</a>
          <a class="nav-link <?= ($judul == 'Daftar Mahasiswa') ? 'active' : '' ?>" href="<?= base_url(); ?>mahasiswa">Mahasiswa</a>
          <a class="nav-link <?= ($judul == 'List of Peoples') ? 'active' : '' ?>" href="<?= base_url(); ?>peoples">Peoples</a>
          <a class="nav-link <?= ($judul == 'Halaman About') ? 'active' : '' ?>" href="<?= base_url(); ?>about">About</a>
        </div>
      </div>
    </div>
  </nav>