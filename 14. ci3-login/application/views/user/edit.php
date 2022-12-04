<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg-8">
      <!-- multipart ini pasti menggunakan method post -->
      <?php echo form_open_multipart('user/edit'); ?>
      <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" autocomplete="on">
          <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
      </div>
      <div class="mb-3 row">
        <div class="col-sm-2">Picture</div>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3">
              <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class=" img-thumbnail">
            </div>
            <div class="col-sm">
              <div class="mb-3">
                <input class="form-control" type="file" id="image" name="image">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3 row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->