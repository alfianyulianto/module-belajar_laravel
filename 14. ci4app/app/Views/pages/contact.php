<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <div class="row">
    <div class="col">
      <h2>Contact Us</h2>
      <?php foreach ($alamat as $a) : ?>
        <ul>
          <li><?= $a['tipe']; ?></li>
          <li><?= $a['alamat']; ?></li>
          <li><?= $a['kota']; ?></li>
        </ul>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>