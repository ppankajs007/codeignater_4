<?= $this->extend('layout');  ?>
<?= $this->section('content');  ?>

<div class="register-box">
  <div class="register-logo"> <a href="../../index2.html"><b>Admin</b>LTE</a> </div>
  <?php $session = \Config\Services::session(); ?>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      <form action="<?= base_url('admin/registeruser'); ?>" method="post" id="register-form" autocomplete="off">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="first_name" value="<?= old('first_name') ?>" placeholder="First Name">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-user"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?= old('last_name') ?>">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-user"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control username" name="username" placeholder="Username" autocomplete="off" value="<?= old('username') ?>">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-user-tie"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control email" name="email" placeholder="Email" autocomplete="off" value="<?= old('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-envelope"></span> </div>
          </div>
        </div>
        <?php if(ACTIVE_SMS_VERIFICATION==1)
        {
          ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control phone" name="phone" placeholder="Phone Number" value="">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-phone"></span> </div>
          </div>
          <span id="phone-errors" class="error invalid-feedback" style="display: none;">Phone no.exist</span> </div>
        <div class="input-group mb-3 otpInput" style="display: none;">
          <input type="text" class="form-control otp" name="otp" placeholder="OTP" value="">
          <div class="input-group-append">
            <div class="input-group-text"  style="padding:0 !important;"> <span class="input-group-append">
              <button type="button" class="btn btn-info btn-flat sendOtp">Send</button>
              </span> </div>
          </div>
        </div>
        <?php
        }
        ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-lock"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirmpassword" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-lock"></span> </div>
          </div>
        </div>
        <?php if(ACTIVE_CAPTCHA == 1) { ?> 
        <div class="g-recaptcha" data-sitekey="6LcfY0YaAAAAAJyIrfwrT1V8Baa0PQxI4GZuAoOY"></div>
        <?php } ?>
        <p id="RecaptchaError" class="" style="display:none;width: 100%;margin-top: .25rem;font-size: 80%;color: #dc354"> Please confirm captcha to proceed</p>
        <br>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="<?= base_url('/') ?>" class="text-center">I already have a membership</a> </div>
    <!-- /.form-box -->
  </div>
  <!-- /.card -->
</div>
<input type="hidden" name="cons" id="cons" value="<?php echo ACTIVE_SMS_VERIFICATION;?>">
<!-- /.register-box -->
<?= $this->endSection();  ?>
