<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg-6 alert">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <a href="" class="btn btn-primary mb-3 addMenuModal" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New Menu</a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Menu</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="menu">
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="btnMenu" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>