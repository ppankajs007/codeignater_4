<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action='<?= base_url("users/add") ?>' method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" class="form-control" value="<?= old('first_name') ?>" name="first_name" id="exampleText" placeholder="First Name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputlastname">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputlastname" value="<?= old('last_name') ?>" placeholder="Last Name" name="last_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" value="<?= old('username') ?>" name="username">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= old('email') ?>" name="email">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" value="<?= old('phone') ?>" name="phone">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Password" value="" name="password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Role</label>
                      <select class="form-control" name="role_id[]" multiple="multiple">
									<?php 
									if(!empty($roles))
									{
									foreach($roles as $role)
									{
									?>
									<option value="<?php echo $role['id'];?>"><?php echo $role['group_name'];?></option>
                                    <?php
									}
									}
									?>
                                 </select>
                    </div>
                  </div>
                  <!--<div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Permissions</label>
                      <?php

                            foreach (USER_PERMISSIONS as $perKey => $perArry) { ?>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input checkPermission" id="<?= $perKey; ?>">
                        <label class="custom-control-label" for="<?= $perKey; ?>">
                        <?= $perKey ?>
                        </label>
                      </div>
                      <?php

                           if( !empty($perArry) ){

                             foreach ($perArry as $perChildKey => $perChildValue) {?>
                      <div class="custom-control custom-switch checkPermissionControl" style="display:inline-block;">
                        <input type="checkbox"  class="custom-control-input checkPermissionChild" name="permission[]" 

                                    id="<?= $perChildKey; ?>" value="<?= $perChildKey; ?>">
                        <label class="custom-control-label" for="<?= $perChildKey; ?>">
                        <?= $perChildValue; ?>
                        </label>
                      </div>
                      <?php }

                          } ?>
                      <?php } ?>
                    </div>
                  </div>-->
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Profile</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="profile" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <?php if(  permissionUsers(currentUserId(),'user_add') ): ?>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <?php endif; ?>
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
