<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <div class="row">
    <div class="col-6">
      <h1 class="mt-2">Daftar Orang</h1>
      <form action="" method="get">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukan keyword pencarian" name="keyword">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <!-- <table class="table" id="table_id"> -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($orang as $o) :
          ?>
            <tr>
              <td><?= $o['nama']; ?></td>
              <td><?= $o['alamat']; ?></td>
              <td>
                <a href="" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $pager->links('orang', 'orang_pagination'); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>