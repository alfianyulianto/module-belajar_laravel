<!-- <?= var_dump($mahasiswa); ?> -->
<div class="container">
  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-4">
      <div class="col-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data mahasiswa <strong>berhasil </strong> <?= $this->session->flashdata('flash'); ?>.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row mt-4">
    <div class="col-6">
      <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah Data Mahasiswa</a>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-6">
      <form action="<?= base_url(); ?>mahasiswa" method="post">
        <div class="input-group">
          <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Cari data mahasiswa..">
          <button class="btn btn-primary" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-6">
      <h3>Daftar Mahasiswa</h3>
      <ul class="list-group">
        <?php foreach ($mahasiswa as $mhs) : ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <?= $mhs['nama']; ?>
            <span>
              <a href=" <?= base_url(); ?>mahasiswa/detail/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-primary">detail</a>
            <a href=" <?= base_url(); ?>mahasiswa/ubah/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-warning">ubah</a>
            <a href=" <?= base_url(); ?>mahasiswa/hapus/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-danger">hapus</a>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>