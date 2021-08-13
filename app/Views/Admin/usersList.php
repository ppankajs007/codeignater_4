<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
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
              <h3 class="card-title">Users</h3>
              <?php if( permissionUsers(currentUserId(),'user_add') ): ?>
              <a class="btn btn-success float-sm-right" href="<?= base_url('users/add') ?>">Add Users</a>
              <?php endif; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <!--<th>Role</th>-->
                    <th>Join</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <!--<tbody>
                  <?php 

                      if( !empty($users) ){

                        foreach ($users as $key => $usersList) { ?>
                  <tr>
                    <td><?= ucfirst($usersList['first_name'])." ".$usersList['last_name'];  ?></td>
                    <td><?= $usersList['username'];  ?></td>
                    <td><?= $usersList['email']??'N/A';  ?></td>
                    <td><?= $usersList['phone']??'N/A';  ?></td>
                    <td><?= roleName($usersList['role_id'])??'N/A';  ?></td>
                    <td><?= $usersList['created_at']??'N/A';  ?></td>
                    <td><?php $id = $usersList['userId']; ?>
                      <?php if( permissionUsers(currentUserId(),'user_edit') ): ?>
                      <a class="btn" href='<?= base_url("users/edit/{$id}") ?>'> <i class="fas fa-edit"></i> </a>
                      <?php endif; ?>
                      <?php if(  permissionUsers(currentUserId(),'user_delete') ): ?>
                      <a class="btn userDelete" href='<?= base_url("users/delete/{$id}") ?>' onclick="return confirm('Are you sure you want to delete this item?');"  data-hasUI="<?= $id ?>"> <i class="fas fa-trash"></i> </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php }

                      }



                    ?>
                </tbody>-->
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


<?= $this->section('scripts') ?>
<script>
function delfunc()
{
if(!confirm('Are you sure?')) return false;
}
$('#datatable').DataTable({
  processing: true,
  serverSide: true,
  autoWidth: false,
  order: [[1, "desc"]],   
  ajax:{
    url: '<?php echo base_url('/users/getjson');?>'
  },
  columns: [
	  {data: 'name', name: 'name'},
	  {data: 'username', name: 'username'},
	  {data: 'email', name: 'email'},
	  {data: 'phone', name: 'phone'},
	  {data: 'created_at', name: 'created_at'},
	  {data: 'action', name: 'action'}
  ]
});
</script>
<?= $this->endSection('scripts') ?>
