<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> : <?= $role['role']; ?></h1>

  <div class="row">
    <div class="col-lg-6">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <a href="" class="btn btn-primary mb-3 addRoleModal" data-bs-toggle="modal" data-bs-target="#newRoleModal">Add New Role</a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Menu</th>
            <th scope="col">Access</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($menu as $m) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $m['menu']; ?></td>
              <td>
                <div class="form-check">
                  <input class="form-check-input check-access" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->