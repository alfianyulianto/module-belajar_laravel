<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <div class="row">
    <div class="col">
      <h1>Hello World!</h1>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>