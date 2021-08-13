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
      <?php $uri = new \CodeIgniter\HTTP\URI; ?>
      <form action='<?= base_url("admin/resetByPhone/{$phone}") ?>' method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control phonePass" placeholder="phone" name="phone" readonly value="<?= hex2bin($phone); ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control otpPass" placeholder="OTP" name="otp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="passwordInput">
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block forgetPassByPhone">Request new password</button>
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
