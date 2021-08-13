<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<?php $session = \Config\Services::session(); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Roles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"> Add Role </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action='<?= base_url("roles/add") ?>' method="post" enctype="multipart/form-data">
              <input type="hidden" class="form-control" value="" name="roles_id">
              <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Role</label>
                    <input type="text" class="form-control" value="" name="group_name" id="group_name" placeholder="User Role">
                  </div>
                  <?php
				  if(!empty($modules))
				  {
				  foreach($modules as $module)
				  {
				  if(!empty($module['permissions']))
				  {
				  ?>
                  <label><?php echo $module['name'];?></label>
                  <div class="form-group">
                    <?php
				  if(!empty($module['permissions']))
				  {
				  foreach($module['permissions'] as $permission)
				  {
				  ?>
                    <div class="form-check">
                      <label class="form-check-label" for="<?php echo $permission['permission_name'];?>">
                      <input class="form-check-input" type="checkbox" id="<?php echo $permission['permission_name'];?>" value="<?php echo $permission['id'];?>" name="permissions[]">
                      <?php echo $permission['permission_name'];?></label>
                    </div>
                    <?php
				  }
				  }
				  ?>
                  </div>
                  <?php
				  }
				  }
				  }
				  ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="group_status" id="group_status">
                      <option value="Active">Active</option>
                      <option  value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
</div>
<?= $this->endSection('content') ?>
