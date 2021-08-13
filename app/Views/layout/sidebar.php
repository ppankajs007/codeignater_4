<?php 

  $db       = \Config\Database::connect();

  $builder  = $db->table('users')->where('id',getUserData()['userId'])->get()->getRowArray(); 

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  
  <a href="<?= base_url('/') ?>" class="brand-link">
  <?php 

      $img = 'dist/img/avatar.png';

      if( $builder['profile'] ):

        $img = $builder['profile']; 

      endif; ?>
  <img src="<?= base_url('dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"

           style="opacity: .8"> <span class="brand-text font-weight-light">Admin</span> </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image"> <img src="<?= base_url($img); ?>" class="img-circle elevation-2" alt="User Image"> </div>
      <div class="info"> <a href="<?= base_url('users/edit')."/".getUserData()['userId'] ?>" class="d-block">
        <?= ucfirst($builder['first_name'])." ".$builder['last_name'] ?>
        </a> </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open"> <a href="<?= base_url('/') ?>" class="nav-link <?= activeMenu(base_url(uri_string()),'dashboard') ?>"> <i class="nav-icon fas fa-tachometer-alt"></i>
          <p> Dashboard </p>
          </a> </li>
        <?php if( isSuperAdmin() || permissionUsers(currentUserId(),'user_view') ): ?>
        <li class="nav-item"> <a href="<?= base_url('users'); ?>" class="nav-link <?= activeMenu(base_url(uri_string()),'users') ?>"> <i class="far fa-circle nav-icon"></i>
          <p>Users</p>
          </a> </li>
        <?php endif; ?>
        <!--<li class="nav-item has-treeview"> <a href="<?= base_url('permission') ?>" class="nav-link <?= activeMenu(base_url(uri_string()),'permission') ?>"> <i class="nav-icon fas fa-badge-sheriff"></i>
          <p> Permission Modules </p>
          </a> </li>-->
        <li class="nav-item has-treeview"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-th"></i>
          <p> Permissions <i class="right fas fa-angle-left"></i> </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item"> <a href="<?= base_url('modules'); ?>" class="nav-link"> <i class="far fa-circle nav-icon"></i>
              <p>Modules</p>
              </a> </li>
            <li class="nav-item"> <a href="<?= base_url('permissions'); ?>" class="nav-link"> <i class="far fa-circle nav-icon"></i>
              <p>Permissions</p>
              </a> </li>
            <li class="nav-item"> <a href="<?= base_url('roles'); ?>" class="nav-link"> <i class="far fa-circle nav-icon"></i>
              <p>User Roles</p>
              </a> </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
