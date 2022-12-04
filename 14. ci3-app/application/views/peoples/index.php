<!-- <?= var_dump($peoples); ?> -->
<div class="container">
  <h3>List of Peoples</h3>
  <div class="row mt-4">
    <div class="col-6">
      <form action="<?= base_url(); ?>peoples" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search keyword.." autofocus>
          <input class="btn btn-primary" type="submit" name="submit" id="submit">
        </div>
      </form>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-10">
      <h5>Result : <?= $total_rows; ?></h5>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peoples as $people) : ?>
            <tr>
              <th><?= ++$start; ?></th>
              <td><?= $people['name']; ?></td>
              <td><?= $people['email']; ?></td>
              <td>
                <a href="#" class="badge rounded-pill text-bg-primary">detail</a>
                <a href="#" class="badge rounded-pill text-bg-warning">ubah</a>
                <a href="#" class="badge rounded-pill text-bg-danger">hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>
</div>