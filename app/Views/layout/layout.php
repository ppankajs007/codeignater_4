<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>AdminLTE 3 | Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/summernote/summernote-bs4.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url('plugins/toastr/toastr.min.css') ?>">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<!--<link href="https://livedemo.mbahcoding.com/assets/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">-->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php $session = \Config\Services::session(); ?>
<div class="wrapper">
  <!-- Navbar -->
  <?= $this->include('layout/navbar'); ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?= $this->include('layout/sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <?= $this->renderSection('content'); ?>
  <!-- /.content-wrapper -->
  <?= $this->include('layout/footer') ?>
</div>
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>

$.widget.bridge('uibutton', $.ui.button)

</script>
<script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url(); ?>/dist/js/adminlte.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url(); ?>/dist/js/pages/dashboard.js"></script>
<script src="<?= base_url(); ?>/dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

	  $(function () {

    $("#example1").DataTable({

      "responsive": true,

      "autoWidth": false,

    });

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });

  });

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

              title: '<?= $session->getFlashdata('success') ?>'

            })

        });

  <?php } ?>

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

              title: '<?= $session->getFlashdata('error') ?>'

            })

        });

  <?php } ?>

  $(document).ready(function() {

    $(document).on('click','.checkPermission',function(){

        if(!$(this).is('checked')){

          $(this).parent('.custom-switch').siblings('.checkPermissionControl').children('.checkPermissionChild').prop('checked','checked');

        }

    });

});

</script>
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



   

  $(document).ready(function(){

        $('[data-plugin="custommodalEdit"]').on('click', function(e) {

        e.preventDefault();

            var modal = new Custombox.modal({

                    content: {

                        target: jQuery(this).attr("data-open"),

                        effect: jQuery(this).attr("data-animation"),

                        },

                    overlay: {

                        color: jQuery(this).attr("data-overlayColor"),

                        close:false

                    },

                    fullscreen: true,

                    positionX: 'center',

                });

                 modal.open();

        });

    });


</script>
<?= $this->renderSection('scripts'); ?>
</body>
</html>
