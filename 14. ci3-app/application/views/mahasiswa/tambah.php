<!-- <?= var_dump(
        $_POST
      ); ?> -->
<div class="container">
  <div class="row mt-4">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          Form Tambah Data Mahasiswa
        </div>
        <div class="card-body">
          <form action="<?= base_url(); ?>mahasiswa/tambah" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control <?= (form_error('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= set_value('nama') ?>">
              <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control <?= (form_error('nim')) ? 'is-invalid' : '' ?>" id=" nim" name="nim" value="<?= set_value('nim') ?>">
              <?= form_error('nim', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" id=" email" name="email">
              <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <select class="form-select" name="jurusan">
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Manajemen">Manajemen</option>
                <option value="Akutansi">Akutansi</option>
              </select>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>