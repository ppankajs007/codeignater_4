<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<?php $session = \Config\Services::session(); ?>
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
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
                     <h3 class="card-title"><?= ucfirst($users['first_name'])." ".ucfirst($users['last_name']) ?></h3>
                  </div>
                  <?php if( $users['profile'] ): ?>
                  <img src='<?= base_url($users['profile']); ?>' width="100px" height="100px" class="abc" placeholder="profile-image">
                  <?php else: ?>
                  <img src='<?= base_url("dist/img/avatar.png") ?>' style="width: 100px;height: 100px;">
                  <?php endif ?>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" action='<?= base_url("users/edit/{$users['id']}") ?>' method="post" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <input type="hidden" class="form-control" value="<?= $users['id'] ?>" name="user_id" id="exampleText">
                                 <label for="exampleInputEmail1">First Name</label>
                                 <input type="text" class="form-control" value="<?= $users['first_name'] ?>" name="first_name" id="exampleText" placeholder="First Name">
                                 <?php echo isset($session->getFlashdata('editError')['first_name'])?"<span id='exampleInputEmail1-error' class='error invalid-feedback' style='display:block;'>{$session->getFlashdata('editError')['first_name']}</span>":'' ?>
                              </div>
                              
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputlastname">Last Name</label>
                                 <input type="text" class="form-control" id="exampleInputlastname" value="<?= $users['last_name'] ?>" placeholder="Last Name" name="last_name">
                                 <?php echo isset($session->getFlashdata('editError')['last_name'])?"<span id='exampleInputEmail1-error' class='error invalid-feedback' style='display:block;'>{$session->getFlashdata('editError')['last_name']}</span>":'' ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Username</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" value="<?= $users['username'] ?>" name="username">
                                 <?php echo isset($session->getFlashdata('editError')['username'])?"<span id='exampleInputEmail1-error' class='error invalid-feedback' style='display:block;'>{$session->getFlashdata('editError')['username']}</span>":'' ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Email</label>
                                 <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= $users['email'] ?>" name="email">
                                 <?php echo isset($session->getFlashdata('editError')['email'])?"<span id='exampleInputEmail1-error' class='error invalid-feedback' style='display:block;'>{$session->getFlashdata('editError')['email']}</span>":'' ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Phone</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" value="<?= $users['phone'] ?>" name="phone">
                                 <?php echo isset($session->getFlashdata('editError')['phone'])?"<span id='exampleInputEmail1-error' class='error invalid-feedback' style='display:block;'>{$session->getFlashdata('editError')['phone']}</span>":'' ?>
                              </div>
                           </div>
                           <?php if( permissionUsers(currentUserId(),'user_edit') ): ?>
                           <?php if( currentUserId() != $users['id'] ): ?>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Role</label>
                                 <select class="form-control" name="role_id[]" multiple="multiple">
									<?php 
									$fetchroles = explode(',',$users['role_id']);
									if(!empty($roles))
									{
									foreach($roles as $role)
									{
									?>
									<option value="<?php echo $role['id'];?>" <?php if(in_array($role['id'],$fetchroles)) { ?> selected="selected" <?php } ?>><?php echo $role['group_name'];?></option>
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
                                    <label class="custom-control-label" for="<?= $perKey; ?>"><?= $perKey ?></label>
                                 </div>
                                 <?php
                                    if( !empty($perArry) ){
                                    
                                     foreach ($perArry as $perChildKey => $perChildValue) {?>
                                 <div class="custom-control custom-switch checkPermissionControl" style="display:inline-block;">
                                    <input type="checkbox" <?php if( checkAccessUsers($users['permission'],$perChildKey) ) echo 'checked'; ?> class="custom-control-input checkPermissionChild" name="permission[]" 
                                       id="<?= $perChildKey; ?>" value="<?= $perChildKey ?>">
                                    <label class="custom-control-label" for="<?= $perChildKey; ?>"><?= $perChildValue; ?>
                                    </label>
                                 </div>
                                 <?php }
                                    } ?>
                                 <?php } ?>
                              </div>
                           </div>-->
                           <?php endif; endif; ?>
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