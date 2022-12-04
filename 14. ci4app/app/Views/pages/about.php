<?= $this->extend('layout/tamplate'); ?>
<!--  digunakan untuk memberi tahu kita menggunakan sebuah tamplate -->

<?= $this->section('content'); ?>
<!--  digunakan untuk memberitahu awal sebuah section -->

<div class="container">
  <div class="row">
    <div class="col">
      <h1>About Me</h1>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet, obcaecati, dolores similique, laborum ex aut officiis asperiores quaerat perferendis illo quia harum aliquid ipsam numquam accusamus! Rerum provident nulla delectus.</p>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>