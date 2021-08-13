<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>AdminLTE 3 | Recover Password</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- icheck bootstrap -->

  <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo">

    <a href="<?= base_url() ?>"><b>Admin</a>

  </div>

  <?php $session = \Config\Services::session(); ?>

  <!-- /.login-logo -->

  <?php if( $session->getFlashdata('error') ){ ?>

            <p class="alert alert-error"><?= $session->getFlashdata('error') ?></p>

  <?php } ?>

  <div class="card">

    <div class="card-body login-card-body">

      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>



      <form action='<?= base_url("admin/resetpassword/{$emailhas}") ?>' method="post">

        <input type="hidden" name="emailhas" value="<?= $emailhas; ?>">

        <div class="input-group mb-3">

          <input type="password" class="form-control" placeholder="Password" name="new_password">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-12">

            <button type="submit" class="btn btn-primary btn-block">Change password</button>

          </div>

          <!-- /.col -->

        </div>

      </form>



      <p class="mt-3 mb-1">

        <a href="<?= base_url('/') ?>">Login</a>

      </p>

    </div>

    <!-- /.login-card-body -->

  </div>

</div>

<!-- /.login-box -->



<!-- jQuery -->

<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->

<script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>



</body>

</html>

