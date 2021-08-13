<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Role List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Role List</li>
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
              <h3 class="card-title">Roles</h3>
              <?php //if( permissionUsers(currentUserId(),'user_add') ): ?>
              <a class="btn btn-success float-sm-right" href="<?= base_url('roles/add') ?>">Add Role</a>
              <?php //endif; ?>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Group Name</th>
					<th>Group Status</th>
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

<!-- /.modal -->
<?= $this->endSection('content') ?>
<?= $this->section('scripts') ?>
<script>
function editFunc(id)
{
var data = {id: id};
$.ajax({
type: "POST",
url: "<?php echo base_url('/roles/fetch');?>",
data: data,
success: function(data)
{
var res = JSON.parse(data);
$('#modal-Role .modal-title').text('Edit Permission Role');
$('#roles_id').val(res.id);
$('#name').val(res.name);
$('#modal-Role').modal('show');
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
  order: [[1, "desc"]],   
  ajax:{
    url: '<?php echo base_url('/roles/getjson');?>'
  },
  columns: [
	  {data: 'group_name', name: 'group_name'},
	  {data: 'group_status', name: 'group_status'},
	  {data: 'created_at', name: 'created_at'},
	  {data: 'action', name: 'action'}
  ]
});
</script>
<?= $this->endSection('scripts') ?>
