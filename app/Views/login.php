<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="login-box">
  <div class="login-logo"> <a href="../../index2.html"><b>Admin</b>LTE</a> </div>
  <?php $session = \Config\Services::session(); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="<?= base_url('admin/login'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-envelope"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-lock"></span> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember"> Remember Me </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <?php if(ACTIVE_REGISTER == 1){ ?> 
      <p class="mb-0"> <a href="<?= base_url('register') ?>" class="text-center">Register a new membership</a> </p>
    <?php } ?>
      <p class="mb-0"> <a href="<?= base_url('admin/forgetpassword') ?>" class="text-center">Forget Password</a> </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<?= $this->endSection('content') ?>
