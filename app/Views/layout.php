<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="base_url" content="<?= base_url('/') ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="<?= base_url('plugins/toastr/toastr.min.css') ?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="hold-transition register-page">
  <?php $session = \Config\Services::session(); ?>

<?= $this->renderSection('content'); ?>

<script src="<?= base_url('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->

<script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

<script src="<?= base_url('js/custom.js') ?>"></script>

<script type="text/javascript">

  <?php if( $session->getFlashdata('registerError') ){
        foreach ($session->getFlashdata('registerError') as $key => $value) { ?>
          $(document).ready(function(){
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            })
          Toast.fire({
              icon: 'error',
              title: '<?= $value ?>'
            })
      });
   <?php }
  } ?>

<?php if( $session->getFlashdata('error') ){ ?>
  $(document).ready(function(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    })

    Toast.fire({
        icon: 'error',
        title: '<?= $session->getFlashdata('error'); ?>'
      })
  });

<?php } ?>

<?php if( $session->getFlashdata('success') ){ ?>
  $(document).ready(function(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    })

    Toast.fire({
        icon: 'success',
        title: '<?= $session->getFlashdata('success'); ?>'
      })
  });
<?php } ?>

<?php if( $session->getFlashdata('otpWrong') ){ ?>
          $(document).ready(function(){
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            })
          Toast.fire({
              icon: 'error',
              title: '<?= $session->getFlashdata('otpWrong') ?>'
            })
      });
   <?php
  } ?>
</script>

</body>
</html>