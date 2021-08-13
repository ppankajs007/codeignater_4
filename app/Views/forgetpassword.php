<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="login-box">

  <div class="login-logo">

    <a href="<?= base_url('/') ?>"><b>Admin</a>

  </div>

  <!-- /.login-logo -->

  <div class="card">

    <div class="card-body login-card-body">

      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>



      <form action="<?= base_url('admin/forgetpassword') ?>" method="post">

        <div class="input-group mb-3">

          <input type="email" class="form-control email forgetEmail" placeholder="Email" name="email">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-envelope"></span>

            </div>

          </div>

        </div>

        <div class="mb-3">

          <p>OR</p>

        </div>

        <div class="input-group mb-3">

          <input type="text" class="form-control phone forgetPhone" placeholder="phone" name="phone">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-phone"></span>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-12">

            <button type="submit" class="btn btn-primary btn-block">Request new password</button>

          </div>

          <!-- /.col -->

        </div>

      </form>



      <p class="mt-3 mb-1">

        <a href="<?= base_url('/') ?>">Login</a>

      </p>

      <p class="mb-0">

        <a href="<?= base_url('register') ?>" class="text-center">Register a new membership</a>

      </p>

    </div>

    <!-- /.login-card-body -->

  </div>

</div>

<?= $this->endSection() ?>

