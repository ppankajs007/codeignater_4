<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Module List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Module List</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Modules</h3>
              <?php //if( permissionUsers(currentUserId(),'user_add') ): ?>
              <a class="btn btn-success float-sm-right" href="<?= base_url('modules/add') ?>">Add Module</a>
              <?php //endif; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Permission Module</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                      if( !empty($modules) ){

                        foreach ($modules as $key => $module) { ?>
                  <tr>
                    <td><?= ucfirst($module['name']);  ?></td>
                    <td><?= $module['created_at']??'N/A';  ?></td>
                    <td>
                      <?php //if( permissionUsers(currentUserId(),'user_edit') ): ?>
                      <a class="btn" href='<?= base_url("modules/edit/{$id}") ?>'> <i class="fas fa-edit"></i> </a>
                      <?php //endif; ?>
                      <?php //if(  permissionUsers(currentUserId(),'user_delete') ): ?>
                      <a class="btn userDelete" href='<?= base_url("modules/delete/{$id}") ?>' onclick="return confirm('Are you sure you want to delete this item?');"  data-hasUI="<?= $id ?>"> <i class="fas fa-trash"></i> </a>
                      <?php //endif; ?>
                    </td>
                  </tr>
                  <?php }

                      }



                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endSection('content') ?>
