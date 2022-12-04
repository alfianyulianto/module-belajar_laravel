<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-8">
      <h2 class="my-2">Form Tambah Data Komik</h2>
      <form action="<?= base_url('komik/save'); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <?= $validation->listErrors(); ?>
        <div class="mb-3 row">
          <label for="judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('judul'); ?>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('penulis'); ?>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('penerbit'); ?>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
          <div class="col-sm-2">
            <img src="<?= base_url('/img/default.png'); ?>" alt="" class="img-thumbnail img-preview" width="100px" height="120px">
          </div>
          <div class="col-sm-8">
            <input class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('sampul'); ?>
            </div>
          </div>
        </div>
        <div class="mb-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Tambah Komik</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>