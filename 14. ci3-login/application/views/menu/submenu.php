<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg">
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          New submenu not been added!
        </div> 
      <?php endif; ?> 
      <?= $this->session->flashdata('message'); ?> </div>
    </div>
    <div class="row">
      <div class="col-lg">
        <a href="" class="btn btn-primary mb-3 addSubmenuModal" data-bs-toggle="modal" data-bs-target="#newSubmenuModal">Add New Submenu</a>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Menu</th>
              <th scope="col">Url</th>
              <th scope="col">Icon</th>
              <th scope="col">Active</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($submenu as $sm) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $sm['title']; ?></td>
                <td><?= $sm['menu']; ?></td>
                <td><?= $sm['url']; ?></td>
                <td><?= $sm['icon']; ?></td>
                <td><?= $sm['is_active']; ?></td>
                <td>
                  <a href="" class="badge rounded-pill text-bg-warning me-2 editSubmenuModal" data-bs-toggle="modal" data-bs-target="#newSubmenuModal" data-id="<?= $sm['id'] ?>">edit</a>
                  <a href="<?= base_url('menu/deleteSubmenu/'); ?><?= $sm['id'] ?>" class="badge rounded-pill text-bg-danger me-2" onclick="return confirm()">delete</a>
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
<div class="modal fade" id="newSubmenuModal" tabindex="-1" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuModalLabel">Add New Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title name">
          </div>
          <div class="mb-3">
            <select class="form-select" id="menu_id" name="menu_id">
              <option value="" id="1">Open this select menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="url" name="url" placeholder="Url name">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon name">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">
              Active?
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="btnSubmenu" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>