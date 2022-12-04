<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($role as $r) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $r['role']; ?></td>
              <td>
                <a href="<?= base_url('admin/roleAccess/'); ?><?= $r['id'] ?>" class="badge rounded-pill text-bg-success me-2">access</a>
                <a href="" class="badge rounded-pill text-bg-warning me-2 editRoleModal" data-bs-toggle="modal" data-bs-target="#newRoleModal" data-id="<?= $r['id'] ?>">edit</a>
                <a href="<?= base_url('admin/deleteRole/'); ?><?= $r['id'] ?>" class="badge rounded-pill text-bg-danger me-2" onclick="return confirm()">delete</a>
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

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/role'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="btnRole" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>