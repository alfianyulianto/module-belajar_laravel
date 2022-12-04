<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-4">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                  <?= $this->session->flashdata('message'); ?>
                </div>
                <form class="user" action="<?= base_url('auth'); ?>" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter Email Address..." autofocus>
                    <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user <?= (form_error('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
                    <?= form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>