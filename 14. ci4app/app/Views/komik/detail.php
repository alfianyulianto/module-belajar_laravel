<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <h2 class="mt-2">Detail Komik</h2>
  <div class="card my-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="<?= base_url('img') . '/' . $komik['sampul'] ?> " class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?= $komik['judul']; ?></h5>
          <p class="card-text"><b>Penulis : </b><?= $komik['penulis']; ?></p>
          <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $komik['penerbit']; ?></small></p>

          <a href="<?= base_url('/komik/edit') . '/' . $komik['slug']; ?>" class="btn btn-warning">Edit</a>
          <form action="<?= base_url('/komik') . '/' . $komik['id'] ?>" method="post" class="d-inline">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?')">Delete</button>
          </form>
          <br><br>
          <a href="<?= base_url('komik'); ?>">Kembali ke daftar komik</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>