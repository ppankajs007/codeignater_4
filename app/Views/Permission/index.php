<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Permission List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Permission List</li>
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
              <h3 class="card-title">Permissions</h3>
              <?php //if( permissionUsers(currentUserId(),'user_add') ): ?>
              <!--<a class="btn btn-success float-sm-right" href="<?= base_url('permissions/add') ?>">Add Permission</a>-->
              <?php //endif; ?>
              <button type="button" class="btn btn-success float-sm-right" data-toggle="modal" data-target="#modal-Permission"> <i class="fa fa-plus"></i> Add Permission </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
				  	<th>Module Name</th>
                    <th>Permission Name</th>
					<th>Permission Key</th>
                    <th>Added On</th>
                    <th>Action</th>
                  </tr>
                </thead>
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
<div class="modal fade" id="modal-Permission">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Permission</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form action="<?= base_url('permissions/add') ?>" method="post">
        <input type="hidden" name="permissions_id" class="permissions_id" id="permissions_id" value="">
        <div class="modal-body">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Permission Name</label>
            <div class="col-sm-12">
              <input type="text" class="form-control pmodule_name" id="permission_name" placeholder="Permission Name" name="permission_name" autocomplete="off" >
            </div>
          </div>
		  <div class="form-group row">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Permission Key</label>
            <div class="col-sm-12">
              <input type="text" class="form-control pmodule_name" id="permission_key" placeholder="Permission Key" name="permission_key" autocomplete="off" >
            </div>
          </div>
		  <div class="form-group row">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Permission Module</label>
            <div class="col-sm-12">
              <select class="form-control pmodule_name" id="module_id" name="module_id">
			  <option value="">--Permission Module--</option>
			  <?php
			  if(!empty($modules))
			  {
			  foreach($modules as $module)
			  {
			  ?>
			  <option value="<?php echo $module['id'];?>"><?php echo $module['name'];?></option>
			  <?php
			  }
			  }
			  ?>
			  </select>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection('content') ?>
<?= $this->section('scripts') ?>
<script>
function editFunc(id)
{
var data = {id: id};
$.ajax({
type: "POST",
url: "<?php echo base_url('/permissions/fetch');?>",
data: data,
success: function(data)
{
var res = JSON.parse(data);
$('#modal-Permission .modal-title').text('Edit Permission Permission');
$('#permissions_id').val(res.id);
$('#permission_name').val(res.permission_name);
$('#permission_key').val(res.permission_key);
$('#module_id').val(res.module_id);
$('#modal-Permission').modal('show');
},
error: function(err)
{
alert(JSON.stringify(err));
}
});
}
function delfunc()
{
if(!confirm('Are you sure?')) return false;
}
</script>
<script>
$('#datatable').DataTable({
  processing: true,
  serverSide: true,
  autoWidth: false,
  stateSave: true,
  searching: false,
  order: [[3, "desc"]],   
  ajax:{
    url: '<?php echo base_url('/permissions/getjson');?>'
  },
  columns: [
  	  {data: 'module_name', name: 'module_name'},
	  {data: 'permission_name', name: 'permission_name'},
	  {data: 'permission_key', name: 'permission_key'},
	  {data: 'created_at', name: 'created_at'},
	  {data: 'action', name: 'action'}
  ]
});
</script>
<?= $this->endSection('scripts') ?>
