<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-2">Daftar Komik</h1>
      <?= session()->getFlashdata('pesan'); ?>
      <a href="<?= base_url('komik/create'); ?>" class="btn btn-primary mb-3">Tambah Data Komik</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sampul</th>
            <th scope="col">Judul</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($komik as $k) :
          ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><img src="<?= base_url("img") . "/" . $k["sampul"]; ?>" alt="" class="sampul"></td>
              <td><?= $k['judul']; ?></td>
              <td>
                <a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>